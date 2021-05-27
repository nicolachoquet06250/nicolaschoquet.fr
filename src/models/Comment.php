<?php


namespace NC\models;


use PhpLib\ORM\decorators\{AutoIncrement,
	Column,
	DBConf,
	DefaultValue,
	Entity,
	PrimaryKey,
	types\DateTime,
	types\Integer,
	types\Model as ORMModel,
	types\NotNull,
	types\Text
};
use PhpLib\ORM\Model;

#[
	DBConf,
	Entity('comments')
]
class Comment extends Model {
	#[
		Column,
		Integer,
		PrimaryKey,
		AutoIncrement
	]
	public int $id;

	#[
		Column,
		Text,
		NotNull
	]
	public string $comment;

	#[
		Column,
		NotNull,
		ORMModel(User::class)
	]
	public int|User $user;

	#[
		Column,
		NotNull,
		ORMModel(Project::class)
	]
	public int|Project $project;

	#[
		Column,
		DateTime,
		DefaultValue('NOW()')
	]
	public string $created_at;

	#[
		Column,
		DateTime,
		DefaultValue('NOW()')
	]
	public string $updated_at;
}