<?php

namespace NC\decorators;

use Attribute;
use NC\routing\{
	Route,
	Router
};
use PhpLib\decorators\Attribute as AttributeBase;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class Json extends AttributeBase {
	public function process(): void {
		$router = new Router();
		foreach ($router->routes() as $_ => $routes) {
			$router->routes()[$_] = array_map(function (Route $c) {
				if (
					$c->getTarget() === $this->getTarget()
					&& $c->getMethod() === $this->getMethod()
				) {
					$c->isJson(true);
				}
				return $c;
			}, $routes);
		}
	}
}