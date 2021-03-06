<?php


namespace NC\models;

use PhpLib\ORM\decorators\{AutoIncrement,
	Column,
	DBConf,
	DefaultValue,
	Entity,
	PrimaryKey,
	Validator,
	types\DateTime,
	types\Integer,
	types\Varchar};
use PhpLib\ORM\Model;

#[
	DBConf(),
	Entity('users')
]
class User extends Model {
	protected static string $table = '';
	protected static array $fields = [];

	#[
		Column,
		Integer,
		AutoIncrement,
		PrimaryKey
	]
	public int $id;

	#[
		Column,
		Varchar
	]
	public string $firstname;

	#[
		Column,
		Varchar
	]
	public string $lastname;

	#[
		Column,
		Varchar
	]
	public string $email;

	#[
		Column,
		Varchar,
		Validator('/[a-zA-Z0-9\!\?\;]+/D')
	]
	public string $password;

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

	public function getId(?int &$id = 0): int|User {
		if (is_null($id)) {
			$id = $this->id;
			return $this;
		}
		return $this->id;
	}

	public function getFirstname(?string &$firstName = ''): string|User {
		if (is_null($firstName)) {
			$firstName = $this->firstname;
			return $this;
		}
		return $this->firstname;
	}

	public function getLastname(?string &$lastName = ''): string|User {
		if (is_null($lastName)) {
			$lastName = $this->lastname;
			return $this;
		}
		return $this->lastname;
	}

	public function getEmail(?string &$email = ''): string|User {
		if (is_null($email)) {
			$email = $this->email;
			return $this;
		}
		return $this->email;
	}

	public function getPassword(?string &$password = ''): string|User {
		if (is_null($password)) {
			$password = $this->password;
			return $this;
		}
		return $this->password;
	}

	public function getCreatedAt(?string &$createdAt = ''): string|User {
		if (is_null($createdAt)) {
			$createdAt = $this->created_at;
			return $this;
		}
		return $this->created_at;
	}

	public function getUpdatedAt(?string &$updatedAt = ''): string|User {
		if (is_null($updatedAt)) {
			$updatedAt = $this->updated_at;
			return $this;
		}
		return $this->updated_at;
	}
}