<?php

namespace NC\controllers\errors;

use PhpLib\decorators\ErrorRoute;
use PhpLib\routing\Router;

#[ErrorRoute(Router::BAD_REQUEST)]
class BadRequest extends HttpError {
	public function get(): void {
		echo $this->message;
	}
}