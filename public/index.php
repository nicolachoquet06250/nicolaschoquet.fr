<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

use PhpLib\interfaces\routing\{
    Router as RouterInterface,
    Context as ContextInterface
};
use PhpLib\injection\InjectionContainer;
use PhpLib\routing\Context;

use NC\interfaces\Request as RequestInterface;
use NC\orm\conf\DBConf;
use NC\helpers\ModelContainer;
use NC\routing\{
	Request,
	Router
};
use NC\models\{Comment as CommentModel, User as UserModel, Project as ProjectModel};
use NC\controllers\{api\User as UserController,
    api\Project as ProjectController,
    errors\NotFound,
    errors\BadRequest,
    errors\InternalError,
    front\DocLayout as DocLayoutController,
    front\Home as HomeController
};

define('APACHE_MIME_TYPES_URL', 'http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types');

try {
    DBConf::useConf(__DIR__ . '/../db-conf.json');

    (new ModelContainer())
        ->use(UserModel::class)
        ->use(ProjectModel::class)
        ->use( CommentModel::class)
        ->initializeTables();

    (new InjectionContainer())
        ->use(RouterInterface::class, Router::class)
        ->use(ContextInterface::class, Context::class)
        ->use( RequestInterface::class, Request::class)
        ->use( UserModel::class, static fn() => new UserModel())
        ->use( ProjectModel::class, static fn() => new ProjectModel())
        ->use( CommentModel::class, static fn() => new CommentModel());

    (new Router())->use([
        'routes' => [ UserController::class, ProjectController::class, DocLayoutController::class, HomeController::class ],
        'errors' => [ NotFound::class, BadRequest::class, InternalError::class ]
    ])->run();
} catch (TypeError $e) {
    dump($e->getMessage(), $e->getFile(), $e->getLine(), $e->getTrace());
}

