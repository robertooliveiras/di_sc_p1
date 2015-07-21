<?php 

class Produtos {
	
	private $db;
	private $table = "produtos";
	
	public function __construct(ConexaoInterface $conexao){
		$this->db = $conexao->connect();
	}
	
	public function listar(Array $where = null) {
		$query = "select fp.id_produto, p.nome as nome_produto, fp.quantidade, 
				p.unidade, fp.id_fornecedor, f.nome as nome_fornecedor, f.email 
				from projeto1.fornecedor_produto fp
				inner join projeto1.fornecedores f ON f.id = fp.id_fornecedor
				inner join projeto1.produtos p ON p.id = fp.id_produto";
		
		$where = $this->tratarDadosFind($where);
		if (!empty($where)) {
			$query .= " where 1 = 1";
			foreach ($where as $key => $value) {
				if ($key == "nome_produto") {
					$key = "p.nome";
				}
				$query .= " and {$key} LIKE '{$value}'";
			}
		}
		$query .= " order by nome_produto, nome_fornecedor";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function verificarId($id){

		$query = "select count(0) as qt from {$this->table} where id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		return intval($retorno[0]["qt"]);
	}
	
	public function inserir(Array $dados) {

		if($this->verificarNome($dados["nome_produto"]) == 0){
			$query = "insert into {$this->table} (id, nome, unidade)
				Values ( :id, :nome, :unidade ) ";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(':id', $dados["id_produto"]);
			$stmt->bindParam(':nome', $dados["nome_produto"]);
			$stmt->bindParam(':unidade', $dados["unidade"]);
			$stmt->execute();
		}
		
		$query2 = "insert into fornecedor_produto (id, id_fornecedor, id_produto, quantidade)
				Values ( :id, :idf, :idp, :qt ) ";
		$stmt2 = $this->db->prepare($query2);
		$stmt2->bindParam(':id', $this->pegarProximoIdFP());
		$stmt2->bindParam(':idf', $dados["id_fornecedor"]);
		$stmt2->bindParam(':idp', $dados["id_produto"]);
		$stmt2->bindParam(':qt', $dados["quantidade"]);
		return $stmt2->execute();
	}
	
	public function pegarProximoIdFP(){
		$query = "select max(id) + 1 as id from fornecedor_produto";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		return intval($retorno[0]["id"]);
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
		if (empty($dados["id_fornecedor"]) || empty($dados["id_produto"]) || 
				empty($dados["nome_produto"]) || empty($dados["quantidade"]) || 
				empty($dados["unidade"])){
			throw new Exception("Dados requisitados não foram informados");
		}
		if (!is_numeric($dados["id_fornecedor"]) || !is_numeric($dados["id_produto"]) || !is_numeric($dados["quantidade"])) {
			throw new Exception("campo só pode receber valor numérico");
		}
		if($this->verificarId($dados["id_produto"]) > 0){
			throw new Exception("id do produto ja existe");
		}
		
		foreach ($dados as $key => $value) {
			if ($key != "id_fornecedor" && $key != "id_produto" && $key != "nome_produto"
					&& $key != "quantidade" && $key != "unidade") {
				unset($dados[$key]);
			};
		}
		return $dados;
	}
	
	public function tratarDadosFind(Array $dadosfind){
		if (!isset($dadosfind["id_produto"]) && !isset($dadosfind["nome_produto"]) && !isset($dadosfind["id_fornecedor"])){
			$dadosfind = array();
		}
		if (isset($dadosfind["id_produto"]) && !is_numeric($dadosfind["id_produto"])) {
			unset($dadosfind["id_produto"] );
		}
		if (isset($dadosfind["id_fornecedor"]) && !is_numeric($dadosfind["id_fornecedor"])) {
			unset($dadosfind["id_fornecedor"] );
		}
		
		if (isset($dadosfind["nome_produto"]) && trim($dadosfind["nome_produto"]) == "") {
			unset($dadosfind["nome_produto"] );
		}
		foreach ($dadosfind as $key => $value) {
			if ($key != "id_produto" && $key != "nome_produto" && $key != "id_fornecedor") {
				unset($dadosfind[$key]);
			};
		}
		return $dadosfind;
	}
}