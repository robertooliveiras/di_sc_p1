<?php
//listagem e insersao de clientes
error_reporting(E_ALL);
ini_set('display_errors','On');

require_once "Conexao.php";
require_once 'Produtos.php';
require_once 'Fornecedor.php';
 
$conexao = new Conexao("localhost", "projeto1", "root", "th1nk1ng0utl0ud");

// $objFornecedores = new Fornecedor($conexao);
// $fornecedores = $objFornecedores->listar();
// require_once 'fornecedores.list.php';
require_once 'produtos.find.php';
$produtos = array();
if(!empty($_POST)){
	$objProdutos = new Produtos($conexao);
	$produtos = $objProdutos->listar($_POST);
}
require_once 'produtos.list.php';

//closing connections
$conexao = null;
$conexaoDSN = null;
?>

