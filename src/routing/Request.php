<?php


namespace NC\routing;


use JsonException;
use NC\interfaces\Request as RequestInterface;
use PhpLib\injection\Injector;
use RuntimeException;

class Request implements RequestInterface {
	use Injector;

	public function getBody(): RequestBody {
		$body = file_get_contents('php://input');
		try {
			return new RequestBody(json_decode($body, true, 512, JSON_THROW_ON_ERROR));

		} catch (JsonException $e) {
			throw new RuntimeException('bad json format for request');
		}
	}
}