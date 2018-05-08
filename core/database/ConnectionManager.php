<?php 
	namespace App\Core\Database;

	use PDO;
	/**
	* This class provides a connection to the database
	* It creates one if there's no previous connection or returns the an existing connection
	*/
	class ConnectionManager 
	{
		// This will provide the instance of PDO to getConnection
		private $pdo;
		private static $instance;

		// hidden constructor, can only be called by the class itself
		private function __construct($config = [])
		{
			// connect to the DDBB
			try {
				$this->pdo = new PDO($config['database']['connection'].';dbname='.$config['database']['name'],$config['database']['username'],$config['database']['password'],$config['database']['options']);
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}

		/**
		*	Crete an instance if it hasn't be created already
		*	Then return the instance of this class
		*/
		public static function getConnectionManager($config = [])
		{
			if ( !self::$instance ) {
				self::$instance = new self($config);
			}
			return self::$instance;
		}

		public function getConnection()
		{
			return $this->pdo;
		}

		// to make sure this instance class cannot be clonned
		private function __clone(){}
	}