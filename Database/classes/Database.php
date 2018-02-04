<?php

	class Database {
		private $host	= "localhost";
		private $user	= "root";
		private $pwd	= "Rodger120201";
		private $dbName	= "myblog";

		// database handler
		private $dbh;
		private $err;
		// statement
		private $stmt;

		public function __construct() {
			// set dsn (no spaces)
			$dsn = "mysql:host=$this->host;dbname=$this->dbName;";

			// set options
			$options = array(
				PDO::ATTR_PERSISTENT	=> true,
				PDO::ATTR_ERRMODE		=> PDO::ERRMODE_EXCEPTION
			);

			// create new PDO
			try {
				$this->dbh = new PDO($dsn, $this->user, $this->pwd, $options);
			} catch(PDOEception $e) {
				$this->err = $e->getMessage();
			}

		}

		public function query($query) {
			$this->stmt = $this->dbh->prepare($query);
		}

		public function bind($param, $val, $type=null) {
			if(is_null($type)) {
				switch(true) {
					case is_int($val):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($val):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($val):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}
			$this->stmt->bindValue($param, $val, $type);
		}

		public function execute() {
			return $this->stmt->execute();
		}

		public function lastInsertId() {
			return $this->dbh->lastInsertId();
		}

		public function resultSet() {
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}

?>