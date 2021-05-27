<?php


namespace NC\controllers\api;

use PhpLib\{decorators\Route as RouteAttribute,
	injection\Injector,
	routing\exceptions\BadMethodException,
	routing\exceptions\NotFoundException};
use NC\{
	decorators\Json,
	interfaces\Request,
	models\Project as ProjectModel,
	routing\Route
};
use RuntimeException;

#[RouteAttribute('/api/project')]
class Project {
	use Injector;

	public function __construct(
		private ProjectModel $project,
		private Request $request
	) {}

	#[Json]
	public function get(): array {
		$projects = $this->project->select();
		if ($projects->count() === 1) {
			return [ $projects->get() ];
		}
		return $projects->get();
	}

	#[
		Json,
		RouteAttribute(
			uri: '/api/project/{id}',
			httpMethod: Route::GET,
			params: [ 'id' => Route::NUMBER ]
		)
	]
	public function getOne(int $id): array {
		$request = $this->project->select()->where('id', $id);

		if ($request->count() === 0) {
			throw new NotFoundException("project $id not exists", 404);
		}

		return $request->get();
	}

	#[Json]
	public function post(): array {
		if ($this->request->getBody()->isModel(ProjectModel::class)) {
			$model = $this->request->getBody()->getModel(ProjectModel::class);
			$insertion = $model?->insert();
			foreach ($model as $key => $value) {
				$insertion->set($key, $value);
			}
			$model = $insertion->build();
			if (!$model) {
				throw new RuntimeException('un problème est survenue lors de l\'enrgistrement');
			}
			return [ $model ];
		}
		throw new RuntimeException('class ' . ProjectModel::class . ' is not a model');
	}

	#[Json]
	public function put(int $id): array {
		if ($this->project->select()->where('id', $id)->count() === 0) {
			throw new NotFoundException("project with id $id not found", 404);
		}

		if ($this->request->getBody()->isModel(ProjectModel::class)) {
			/** @var ProjectModel|null $model */
			$model = $this->project->select()->where('id', $id)->get()[0];
			if (!$model) {
				throw new NotFoundException("project with id $id not found", 404);
			}

			$updater = $model->update()->where('id', $id);
			foreach ($this->request->getBody()->getModel(ProjectModel::class) as $key => $value) {
				$updater->set($key, $value);
			}
			$model = $updater->addObject($model)->save();
			if (!$model) {
				throw new RuntimeException( 'Une erreur est survenue lors de la modification du projet' );
			}
			return [ $model ];
		}
		throw new BadMethodException('bad format of body', 400);
	}

	#[Json]
	public function delete(int $id): array {
		/** @var ProjectModel[] $projectToDelete */
		$projectToDelete = $this->project->select()->where('id', $id)->get();
		if (isset($projectToDelete[0])) {
			$projectToDelete = $projectToDelete[0];
			$result = $projectToDelete->delete()->where('id', $id)->save();

			if ($result) {
				return [
					'deleted' => true,
					'deleted_id' => $projectToDelete->id
				];
			}
			http_response_code(500);
			return [
				'error' => 500,
				'deleted' => false,
				'message' => 'une erreur est survenue lors de la suppression du projet'
			];
		}
		throw new NotFoundException("project with id $id not found", 404);
	}
}