<?php

namespace NC\controllers\api;

use PhpLib\{
	decorators\Route as RouteAttribute,
	injection\Injector,
	ORM\Model,
	routing\exceptions\NotFoundException
};
use NC\{
	decorators\Json,
	models\User as UserModel,
	routing\Route
};

#[RouteAttribute('/api/user')]
class User {
	use Injector;

	public function __construct(
		private UserModel $user
	) {}

	#[
		Json,
		RouteAttribute(
			uri: '/api/user/{id}',
			httpMethod: Route::GET,
			params: [ 'id' => Route::NUMBER ]
		)
	]
	public function get(?int $id = null): Model|array {
		$request = $this->user->select('id, firstname, lastname, email, created_at, updated_at');
		if (is_null($id)) {
			return $request->get();
		}
		$request->where('id', $id);
		if ($request->count() === 0) {
			throw new NotFoundException("user width id $id not exists", 404);
		}
		return $request->get();
	}
}