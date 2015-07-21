<?php
// error_reporting(E_ALL);
// ini_set('display_errors','On');
require_once "Conexao.php";
require_once 'Fornecedor.php';
require_once 'Produtos.php';

try {
	$conexao = new Conexao("localhost", "projeto1", "root", "th1nk1ng0utl0ud");
	$objFornecedor = new Fornecedor($conexao);
	
	$dados = $objFornecedor->tratarDados($_POST);
	$objFornecedor->inserir($dados);
	header("location:fornecedor.form.php?e=sussa");
} catch (Exception $e) {
// 	echo($e->getMessage());
// 	echo '<br /><input type="button" onclick="javascript:history.back();" value="voltar" alt="voltar" name="voltar" id="voltar" />';
	header("location:fornecedor.form.php?e={$e->getMessage()}");
}


