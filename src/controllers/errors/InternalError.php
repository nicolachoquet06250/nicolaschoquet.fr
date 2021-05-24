<?php

namespace NC\controllers\errors;

use PhpLib\decorators\ErrorRoute;
use PhpLib\routing\Router;

#[ErrorRoute(Router::INTERNAL_ERROR)]
class InternalError extends HttpError {
	public function get(): void {
		echo $this->message;
		var_dump($this->stackTrace);
	}
}