<?php

namespace NC\controllers\api;

use NC\decorators\Json;
use PhpLib\{decorators\Route as RouteAttribute, injection\Injector, ORM\Model};
use NC\models\User;

#[
	RouteAttribute('/'),
	RouteAttribute('/api/home')
]
class Home {
	use Injector;

	public function __construct(
		private User $user
	) {}

	#[Json]
	public function get(): Model/*string*/ {
		return $this->user->select()->where('id', 2)->get();
		//return 'api test';
	}
}