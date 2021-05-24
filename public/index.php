<?php
ini_set('display_errors', 'on');

require __DIR__ . '/../vendor/autoload.php';

use NC\helpers\ModelContainer;
use NC\models\User as UserModel;
use PhpLib\ORM\DBConf;
use PhpLib\interfaces\routing\{
    Router as RouterInterface,
    Context as ContextInterface
};
use PhpLib\injection\InjectionContainer;
use PhpLib\routing\Context;

use NC\routing\Router;
use NC\controllers\{
	api\Home,
	errors\NotFound,
	errors\BadRequest,
	errors\InternalError
};

define('__ROOT__', dirname(__DIR__));

(new DBConf())->use(
	engine: 'mysql',
	host: 'db-host',
	dbname: 'db-name',
	username: 'root', password: 'root'
);

(new ModelContainer())
	->use(UserModel::class)
	->initializeTables();

(new InjectionContainer())
    ->use(RouterInterface::class, Router::class)
    ->use(ContextInterface::class, Context::class)
	->use( UserModel::class, static fn() => new UserModel());

(new Router())->use([
    'routes' => [ Home::class ],
    'errors' => [ NotFound::class, BadRequest::class, InternalError::class ]
])->run();
