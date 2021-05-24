<?php

namespace NC\controllers\errors;

use PhpLib\decorators\ErrorRoute;
use PhpLib\routing\Router;

#[ErrorRoute(Router::NOT_FOUND)]
class NotFound extends HttpError {
	public function get(): void {
		echo $this->message;
	}
}