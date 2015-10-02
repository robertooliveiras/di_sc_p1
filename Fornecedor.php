<?php 

class Fornecedor {
	
	private $db;
	private $table = "fornecedores";
	
	public function __construct(ConexaoInterface $conexao){
		$this->db = $conexao->connect();
	}
	
	public function listar() {
		$query = "select * from {$this->table}";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function inserir(Array $dados) {
		$query = "insert into {$this->table} (id, nome, email)
			Values ( :id, :nome, :email )";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $this->pegarProximoIdF());
		$stmt->bindParam(':nome', $dados["nome_fornecedor"]);
		$stmt->bindParam(':email', $dados["email_fornecedor"]);
		
		return $stmt->execute();
	}
	
	public function pegarProximoIdF(){
		$query = "select max(id) + 1 as id from fornecedor";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		return intval($retorno[0]["id"]);
	}
	
	public function verificarId($id){

		$query = "select count(0) as qt from {$this->table} where id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		return intval($retorno[0]["qt"]);
	}
	
	public function verificarNome($nome){

		$query = "select count(0) as qt from {$this->table} where nome ILIKE :nome";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':nome', $nome);
		$stmt->execute();
		$retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		return intval($retorno[0]["qt"]);
	}
	
	public function tratarDados(Array $dados){
		if ( empty($dados["nome_fornecedor"]) || empty($dados["email_fornecedor"])){
			throw new Exception("Dados requisitados não foram informados");
		}
		if($this->verificarNome($dados["nome_fornecedor"]) > 0){
			throw new Exception("já existe fornecedor com este nome");
		}
		foreach ($dados as $key => $value) {
			if ( $key != "nome_fornecedor" && $key != "email_fornecedor") {
				unset($dados[$key]);
			};
		}
		return $dados;
	}
}