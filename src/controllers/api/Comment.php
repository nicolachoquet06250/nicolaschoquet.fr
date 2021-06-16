<?php


namespace NC\controllers\api;

use JetBrains\PhpStorm\ArrayShape;
use NC\decorators\Json;
use NC\models\Comment as CommentModel;
use NC\routing\Request;
use NC\routing\Route;
use PhpLib\decorators\Route as RouteAttribute;
use PhpLib\routing\exceptions\BadMethodException;

class Comment
{
    public function __construct(
        private CommentModel $comment,
        private Request $request
    ) {}

    #[
        Json,
        RouteAttribute(
            uri: '/api/comment/{projectId}',
            httpMethod: Route::GET,
            params: [ 'projectId' => Route::NUMBER ]
        )
    ]
    public function get(int $projectId): array {
        $comments = $this->comment->select()->where('project', $projectId);
        if ($comments->count() === 1) {
            return [ $comments->get() ];
        }
        return $comments->get();
    }

    #[
        Json,
        RouteAttribute(
            uri: '/api/comment/{projectId}',
            httpMethod: Route::POST,
            params: [ "projectId" => Route::NUMBER ]
        )
    ]
    public function post(int $projectId): array {
        $result = $this->request->getBody()->getModel(CommentModel::class)->insert()->set('project', $projectId)->build();
        if (!$result) {
            throw new BadMethodException('l\'object envoyé ne correspond pas à un "comment"', 400);
        }
        return [ $result ];
    }

    #[
        ArrayShape(['deleted' => "bool"]),
        Json,
        RouteAttribute(
            uri: '/api/comment/{id}',
            httpMethod: Route::DELETE,
            params: [ "id" => Route::NUMBER ]
        )
    ]
    public function delete(int $id): array {
        return [ 'deleted' => CommentModel::findOne($id)?->delete()->save() ];
    }
}