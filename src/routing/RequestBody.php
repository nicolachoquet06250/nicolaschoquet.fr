<?php


namespace NC\routing;


use JetBrains\PhpStorm\Pure;
use PhpLib\ORM\Model;

class RequestBody {
	public function __construct(
		private array $body
	) {}

	public function get(string $key): mixed {
		return $this->body[$key] ?? null;
	}

	public function has(string $key): bool {
		return isset($this->body[$key]);
	}

	#[Pure]
	public function isModel(string $model): bool {
		/** @var Model $model */
		$fields = $model::getFields();
		$fieldsName = array_keys($fields);

		foreach ($this->body as $key => $value) {
			if (!in_array($key, $fieldsName, true)) {
				return false;
			}
		}
		return true;
	}

	public function getModel(string $model): ?Model {
		return $this->isModel($model) ? (function() use ($model): Model {
			$modelObj = new $model();
			foreach ($this->body as $key => $value) {
				$modelObj->$key = $value;
			}
			return $modelObj;
		})() : null;
	}
}