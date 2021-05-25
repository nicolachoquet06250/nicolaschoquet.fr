<?php


namespace NC\decorators;

use Attribute;
use Error;
use NC\routing\ErrorRoute;
use NC\routing\Router;

#[Attribute(Attribute::TARGET_CLASS)]
class ErrorJson extends Json {
	public function __construct(
		private string $forUri = '/.+'
	) {}

	public function process(): void {
		$router = new Router();
		foreach ($router->errors() as $errorName => $error) {
			$_error = new ErrorRoute($errorName, $error->getTarget(), $error->getMethod());
			try {
				$_error->setCode($error->getCode());
			} catch (Error) {
				$_error->setCode(0);
			}
			try {
				$_error->setMessage($error->getMessage());
			} catch (Error) {
				$_error->setMessage('');
			}
			try {
				$_error->setStackTrace($error->getStackTrace());
			} catch (Error) {
				$_error->setStackTrace([]);
			}

			Router::error($errorName, $_error->getTarget(), $_error->getMethod());

			$error = $router->errors()[$errorName];

			if (
				$error->getTarget() !== $this->getTarget()
				&& $error->getMethod() !== $this->getMethod()
			) {
				continue;
			}
			$error->setJson(true, $this->forUri);
		}
	}
}