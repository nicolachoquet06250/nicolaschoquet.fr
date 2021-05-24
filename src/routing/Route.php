<?php


namespace NC\routing;

use JsonException;
use ReflectionException;
use PhpLib\routing\Route as RouteBase;

class Route extends RouteBase {
	private bool $isJson = false;

	public function isJson(?bool $isJson = null): ?bool {
		if (is_null($isJson)) {
			return $this->isJson;
		}
		$this->isJson = $isJson;
		return null;
	}

	/**
	 * @throws ReflectionException
	 * @throws JsonException
	 */
	public function resolve(): array|string|null {
		$result = parent::resolve();

		if ($this->isJson()) {
			if (is_array($result) || is_object($result)) {
				header('Content-Type: application/json;charset=utf-8');
				echo json_encode($result, JSON_THROW_ON_ERROR);
			} elseif (is_string($result)) {
				header('Content-Type: application/json;charset=utf-8');
				echo json_encode([
					'message' => $result
				], JSON_THROW_ON_ERROR);
			}
		} else if ( is_array($result) || is_object($result)) {
			var_dump($result);
		} else {
			echo $result;
		}
		return null;
	}
}