<?php

namespace NC\controllers\errors;

use NC\decorators\ErrorJson;
use PhpLib\decorators\ErrorRoute;
use PhpLib\routing\Router;

#[
	ErrorJson('/api/(.*)'),
	ErrorRoute(Router::INTERNAL_ERROR)
]
class InternalError extends HttpError {
	public function get(): array {
		return [
			'message' => $this->message,
			'trace' => $this->stackTrace
		];
	}
}