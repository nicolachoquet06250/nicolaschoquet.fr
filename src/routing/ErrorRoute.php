<?php


namespace NC\routing;

use PhpLib\injection\InjectionContainer;
use PhpLib\routing\ErrorRoute as ErrorRouteBase;

class ErrorRoute extends ErrorRouteBase {
	protected bool $isJson;
	protected string $jsonRegex;

	public function setJson(bool $json, string $regex = '/.+'): void {
		$this->isJson = $json;
		$this->jsonRegex = $regex;
	}

	public function isJson(): bool {
		return $this->isJson;
	}

	public function getJsonRegex(): string {
		$regex = $this->jsonRegex;

		$regex = str_replace('/', "\/", $regex);

		$regex = "/$regex\$/D";

		return $regex;
	}

	public function matchWithJson(): bool {
		if ($this->isJson()) {
			preg_match($this->getJsonRegex(), $_SERVER['REQUEST_URI'], $matches);
			return !empty($matches);
		}
		return false;
	}

	public function resolve() {
		$class = $this->getTarget();
		$injectionContainer = new InjectionContainer();
		$controller = $injectionContainer->inject($class, params: [$this->getMessage(), $this->getCode(), $this->getStackTrace()]);
		$errorResult = $injectionContainer->inject($controller, $this->getMethod(), params: [$this->getMessage(), $this->getCode(), $this->getStackTrace()]);
		if ($this->matchWithJson()) {
			header('Content-Type: application/json;charset=utf8');
			echo json_encode(
				[
					'error' => $this->getCode(),
					'message' => $errorResult
				]
			);
		} else {
			if (is_string($errorResult)) {
				echo $errorResult;
			} else {
				if (function_exists('dump')) {
					dump($errorResult);
				} else {
					var_dump($errorResult);
				}
			}
		}
	}
}