<?php

namespace NC\controllers\errors;

abstract class HttpError {
	public function __construct(
		protected string $message,
		protected int $code,
		protected array $stackTrace
	) {
		http_response_code($code);
	}

	abstract public function get();
}