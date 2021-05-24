<?php


namespace NC\helpers;


use Exception;
use PhpLib\ORM\Model;

class ModelContainer {
	/**
	 * @var Model[] $models
	 */
	private static array $models = [];

	private function isModel(string $class): bool {
		$rc = new \ReflectionClass($class);
		if ($rc->getParentClass()) {
			if ($rc->getParentClass()->getName() === Model::class) {
				return true;
			}
			return $this->isModel($rc->getParentClass()->getName());
		}
		return false;
	}

	public function use(string $modelClass): ModelContainer {
		if ($this->isModel($modelClass)) {
			static::$models[] = $modelClass;
		}
		return $this;
	}

	/**
	 * @throws Exception
	 */
	public function initializeTables(): void {
		foreach (static::$models as $model) {
			$model::create();
		}
	}
}