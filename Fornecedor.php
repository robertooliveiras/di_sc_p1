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
		$stmt->bindParam(':id', $dados["id_fornecedor"]);
		$stmt->bindParam(':nome', $dados["nome_fornecedor"]);
		$stmt->bindParam(':email', $dados["email_fornecedor"]);
		
		return $stmt->execute();
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

		$query = "select count(0) as qt from {$this->table} where nome LIKE :nome";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':nome', $nome);
		$stmt->execute();
		$retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		return intval($retorno[0]["qt"]);
	}
	
	public function tratarDados(Array $dados){
		if (empty($dados["id_fornecedor"]) || empty($dados["nome_fornecedor"]) || empty($dados["email_fornecedor"])){
			throw new Exception("Dados requisitados não foram informados");
		}
		if (!is_numeric($dados["id_fornecedor"])) {
			throw new Exception("id do fornecedor precisa ser um número inteiro");
		}
		if($this->verificarId($dados["id_fornecedor"]) > 0){
			throw new Exception("id do fornecedor ja existe");
		}
		if($this->verificarNome($dados["nome_fornecedor"]) > 0){
			throw new Exception("já existe fornecedor com este nome");
		}
		foreach ($dados as $key => $value) {
			if ($key != "id_fornecedor" && $key != "nome_fornecedor" && $key != "email_fornecedor") {
				unset($dados[$key]);
			};
		}
		return $dados;
	}
}