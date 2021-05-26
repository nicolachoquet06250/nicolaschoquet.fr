<?php


namespace NC\interfaces;


use NC\routing\RequestBody;

interface Request {
	public function getBody(): RequestBody;
}