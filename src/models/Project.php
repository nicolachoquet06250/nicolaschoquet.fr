<?php


namespace NC\models;


use PhpLib\ORM\decorators\{
	AutoIncrement, Column,
	DBConf, DefaultValue,
	Entity, PrimaryKey,
	types\DateTime,
	types\Integer,
	types\NotNull,
	types\Text,
	types\Varchar
};
use PhpLib\ORM\Model;

#[
	DBConf,
	Entity('projects')
]
class Project extends Model {

	#[
		Column,
		Integer,
		AutoIncrement,
		PrimaryKey
	]
	public int $id;

	#[
		Column,
		Varchar,
		NotNull
	]
	public string $name;

	#[
		Column,
		Text,
		DefaultValue(null)
	]
	public string $description;

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

	public function getId(?int &$id = 0): int|Project {
		if (is_null($id)) {
			$id = $this->id;
			return $this;
		}
		return $this->id;
	}

	public function getName(?string &$name = ''): string|Project {
		if (is_null($name)) {
			$name = $this->name;
			return $this;
		}
		return $this->name;
	}

	public function getDescription(?string &$description = ''): string|Project {
		if (is_null($description)) {
			$description = $this->description;
			return $this;
		}
		return $this->description;
	}

	public function getCreatedAt(?string &$createdAt = ''): string|Project {
		if (is_null($createdAt)) {
			$createdAt = $this->created_at;
			return $this;
		}
		return $this->created_at;
	}

	public function getUpdatedAt(?string &$updatedAt = ''): string|Project {
		if (is_null($updatedAt)) {
			$updatedAt = $this->updated_at;
			return $this;
		}
		return $this->updated_at;
	}
}