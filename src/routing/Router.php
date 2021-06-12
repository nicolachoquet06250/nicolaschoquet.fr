<?php

namespace NC\routing;

use Exception;
use NC\decorators\ErrorJson;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;
use NC\decorators\Json;
use PhpLib\decorators\{
	ErrorRoute as ErrorRouteAttribute,
	Route as RouteAttribute,
	Attribute
};
use PhpLib\routing\{
	exceptions\BadMethodException,
	exceptions\NotFoundException,
	Router as ParentRouter
};

class Router extends ParentRouter {
    private function generateUpToDateMimeArray(string $url = APACHE_MIME_TYPES_URL): array {
        $s = array();

        foreach(explode("\n", @file_get_contents($url)) as $x)
            if(isset($x[0]) && $x[0] !== '#' && preg_match_all('#([^\s]+)#', $x,$out) && isset($out[1]) && ($c = count($out[1])) > 1)
                for($i = 1; $i < $c; $i++)
                    $s[$out[1][$i]] = $out[1][0];

        return $s;
    }

    public function mime_content_type(string $filename) {
        return $this->generateUpToDateMimeArray()[explode('.', $filename)[1]];
    }

	protected function resolve(): ?Route {
		if (isset($_GET['q'])) {
			$_SERVER['REQUEST_URI'] = $_GET['q'];
		}

		define('APACHE_MIME_TYPES_URL','http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types');

        if (strstr($_SERVER['REQUEST_URI'], '.')) {
		    if (file_exists(__DIR__ . '/../../public' . $_SERVER['REQUEST_URI'])) {
                header("Content-Type: " . $this->mime_content_type($_SERVER['REQUEST_URI']));
		        exit(file_get_contents(__DIR__ . '/../../public' . $_SERVER['REQUEST_URI']));
            } else {
                throw new NotFoundException('file '. __DIR__ . '/../../public' . $_SERVER['REQUEST_URI'] . ' not found', 404);
            }
        }

		$currentUri = $_SERVER['REQUEST_URI'];
		[$currentUri] = explode('?', $currentUri);
		$currentHttpMethod = strtolower($_SERVER['REQUEST_METHOD']);

		$expectedHttpMethod = null;
		$givenHttpMethod = null;

		if (isset($this->routes()[$currentHttpMethod])) {
			$route =  array_reduce(
				array_values($this->routes()[$currentHttpMethod]),
				static fn (?Route $r, Route $c) => $c->match() ? $c : $r,
				null
			);

			if (!is_null($route)) {
				return $route;
			}
		}

		$matches = 0;
		foreach ($this->routes() as $httpMethod => $_route) {
			if ($httpMethod !== $currentHttpMethod) {
				$match = array_reduce(
					array_values($this->routes()[$httpMethod]),
					static fn(Route|bool $r, Route $c) => $c->match() ? true : $r,
					false
				);

				if ($match) {
					$expectedHttpMethod = $httpMethod;
					$givenHttpMethod = $currentHttpMethod;

					$matches++;
				}
			}
		}

		if ($matches > 0) {
			throw new BadMethodException("uri $currentUri expected $expectedHttpMethod http method, $givenHttpMethod given", 400);
		}
		throw new NotFoundException("page $currentUri not found", 404);
	}

	/**
	 * @return array<ErrorRoute>
	 */
	public function errors(): array {
		return static::$errorRoutes;
	}

	/**
	 * @throws ReflectionException
	 */
	private function processJsonRoutes(): void {
		foreach ( $this->routes() as $routes ) {
			foreach ( $routes as $route ) {
				[$target, $method] = [
					$route->getTarget(),
					$route->getMethod()
				];
				$rc = new ReflectionClass($target);
				$rm = $rc->getMethod($method);

				$attrs = $rm->getAttributes(Json::class);
				if (!empty($attrs)) {
					/** @var Attribute $attr */
					$attr = $attrs[0]->newInstance();
					$attr->setTarget($target);
					$attr->setMethod($method);
					$attr->process();
				}
			}
		}
	}

	private function transformRoutes(): void {
		/** @var Route $route */
		foreach ($this->routes() as $httpMethod => $routes) {
			foreach ($routes as $path => $route) {
				[$target, $method, $uri, $params] = [
					$route->getTarget(),
					$route->getMethod(),
					$route->getUri(false),
					$route->getParams()
				];
				$_route = new Route($uri, $target, $method);
				if (!isset(static::$routes[$httpMethod])) {
					static::$routes[$httpMethod] = [];
				}

				foreach ($params as $k => $r) {
					$_route->with($k, $r);
				}

				static::$routes[$httpMethod][$path] = $_route;
			}
		}
	}

	/**
	 * @throws ReflectionException
	 */
	private function processErrors(): void {
		foreach ($this->routesProvider['errors'] as $error) {
			$this->resolveRoute($error, ErrorRouteAttribute::class);
		}
	}

	/**
	 * @throws ReflectionException
	 */
	private function processRoutes(): void {
		foreach ($this->routesProvider['routes'] as $route) {
			$this->resolveRoute($route, RouteAttribute::class);
		}
	}

	protected function resolveError(string $errorName, string $message, int $code, array $stackTrace): ?ErrorRoute {
		$errorResolved = parent::resolveError($errorName, $message, $code, $stackTrace);

		[$target, $method,] = [
			$errorResolved?->getTarget(),
			$errorResolved?->getMethod()
		];

		$rc = new ReflectionClass($target);

		$attrs = $rc->getAttributes(ErrorJson::class);
		if (!empty($attrs)) {
			/** @var Attribute $attr */
			$attr = $attrs[0]->newInstance();
			$attr->setTarget($target);
			$attr->setMethod($method);
			$attr->process();
		}

		/** @var ErrorRoute $errorResolved */
		$errorResolved = parent::resolveError($errorName, $message, $code, $stackTrace);
		return $errorResolved;
	}


	public static function error(string $errorType, string $target, string $method): ErrorRoute {
		static::$errorRoutes[$errorType] = new ErrorRoute($errorType, $target, $method);
		return static::$errorRoutes[$errorType];
	}

	public function run(): void {
	    try {
			$this->processErrors();
			$this->processRoutes();

			$this->transformRoutes();
			$this->processJsonRoutes();

			$this->resolve()?->resolve();
		} catch (NotFoundException $e) {
			$this->resolveError(
				static::NOT_FOUND,
				$e->getMessage(),
				$e->getCode(),
				$e->getTrace()
			)?->resolve();
		} catch (BadMethodException $e) {
			$this->resolveError(
				static::BAD_REQUEST,
				$e->getMessage(),
				$e->getCode(),
				$e->getTrace()
			)?->resolve();
		} catch (ReflectionException|Exception $e) {
			$this->resolveError(
				static::INTERNAL_ERROR,
				$e->getMessage(),
				500,
				$e->getTrace()
			)?->resolve();
		}
	}
}