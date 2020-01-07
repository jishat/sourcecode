<?php
 namespace Jishat\Db;

 use \PDO;


class Db
{
	private $dbhost ='localhost';
	private $dbname = 'goshare';
	private $dbuser = 'root';
	private $dbpass = '';

	public function connect(){
		try{
			$conn = new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname, $this->dbuser, $this->dbpass);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		}catch(PDOException $e){
			echo "Connected Fail".$e->getMessage();
		}
	}
}