<?php
	if ( !class_exists ('DB') ) {
		class DB {
		    public $results;
		    public $connection;
			public function __construct() {
				$mysqli = new mysqli('cpsc498.c4gfuryc8w4w.us-east-1.rds.amazonaws.com', 'WillAdmin', 'C@pstone498', 'accounts');
				
				if ($mysqli->connect_errno) {
					printf("Connect failed %s\n", $mysqli->connect_error);
					exit();
				}
				
				$this->connection =  $mysqli;
			}
			
			public function insert($query) {				
				$result = $this->connection->query($query);
				
				return $result;
			}
			
			public function update($query) {
				$result = $this->connection->query($query);
				
				return $result;
			}
			
			public function select($query) {							
				$result = $this->connection->query($query);
				
				if ( !$result ) {
					return false;
				}

				while ( $obj = $result->fetch_object() ) {
					$results[] = $obj;
				}
				
				return $this->results;
			}
		}
	}
	
	$db = new DB;
