<?php

namespace NC\routing;

use Exception;
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
	protected function resolve(): ?Route {
		if (isset($_GET['q'])) {
			$_SERVER['REQUEST_URI'] = $_GET['q'];
		}

		/** @var Route $result */
		$result = parent::resolve();
		if (is_null($result)) {
			return null;
		}
		return $result;
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