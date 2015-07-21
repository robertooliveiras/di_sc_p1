<?php 

require_once 'ConexaoInterface.php';

class Conexao implements ConexaoInterface {
	
	
	private $host;
	private $database;
	private $user;
	private $password; 
	
	public function __construct($h, $d, $u, $p) {
		$this->host 	= $h;
		$this->database = $d;
		$this->user 	= $u;
		$this->password = $p;
	}
	
	public function connect() {
		return new \PDO("mysql:host={$this->host};dbname={$this->database}", 
			$this->user, 
			$this->password);
	}
}
