<?php

namespace NC\controllers\api;

use PhpLib\{
	decorators\Route as RouteAttribute,
	injection\Injector,
	ORM\Model,
	routing\exceptions\NotFoundException
};
use NC\decorators\Json;
use NC\models\User;
use NC\routing\Route;

#[
	RouteAttribute('/'),
	RouteAttribute('/api/home')
]
class Home {
	use Injector;

	public function __construct(
		private User $user
	) {}

	#[
		Json,
		RouteAttribute(
			uri: '/{id}',
			httpMethod: Route::GET,
			params: [
				'id' => Route::NUMBER
			]
		),
		RouteAttribute(
			uri: '/api/home/{id}',
			httpMethod: Route::GET,
			params: [
				'id' => Route::NUMBER
			]
		)
	]
	public function get(?int $id = null): Model|array {
		$request = $this->user->select('id, firstname, lastname, email, created_at, updated_at');
		if (is_null($id)) {
			return $request->get();
		}
		$request = $request->where('id', $id);
		if ($request->count() === 0) {
			throw new NotFoundException("user $id not exists", 404);
		}
		return $request->get();
	}
}