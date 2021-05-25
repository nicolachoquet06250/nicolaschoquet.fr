<?php


namespace NC\orm\conf;

use PhpLib\ORM\DBConf as DBConfBase;
use RuntimeException;


class DBConf extends DBConfBase {
	public static function useConf(string $jsonFilePath) {
		if (!file_exists($jsonFilePath)) {
			throw new RuntimeException("conf file $jsonFilePath expected");
		}
		$fileContent = file_get_contents($jsonFilePath);

		$jsonContent = json_decode($fileContent, true);

		if (json_last_error() !== JSON_ERROR_NONE) {
			throw new RuntimeException("conf file $jsonFilePath format is not valid");
		}

		$conf = new DBConf();

		foreach ($jsonContent as $confName => $confData) {
			[$engine, $host, $dbname, $username, $password] = [
				$confData['engine'],
				$confData['host'],
				$confData['dbname'],
				$confData['username'],
				$confData['password'],
			];
			$conf->use(
				engine: $engine,
				host: $host,
				dbname: $dbname,
				username: $username,
				password: $password
			);
		}
	}
}