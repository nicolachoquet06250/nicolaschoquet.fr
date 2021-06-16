<?php

namespace NC\controllers\errors;

use NC\decorators\ErrorJson;
use PhpLib\decorators\ErrorRoute;
use PhpLib\routing\Router;

#[
	ErrorJson('/api/(.*)'),
	ErrorRoute(Router::NOT_FOUND)
]
class NotFound extends HttpError {
	public function get(): string {
		return $this->message;
	}
}