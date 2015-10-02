<?php
// error_reporting(E_ALL);
// ini_set('display_errors','On');
require_once "config.php";
require_once "Conexao.php";
require_once "Fornecedor.php";
require_once "Produtos.php";

try {
	$conexao = new Conexao($GLOBALS['myHost'], $GLOBALS['myDb'], $GLOBALS['myUsr'], $GLOBALS['myPwd']);
	$objFornecedor = new Fornecedor($conexao);
	
	$dados = $objFornecedor->tratarDados($_POST);
	$objFornecedor->inserir($dados);
	header("location:fornecedor.form.php?e=sussa");
} catch (Exception $e) {
// 	echo($e->getMessage());
// 	echo '<br /><input type="button" onclick="javascript:history.back();" value="voltar" alt="voltar" name="voltar" id="voltar" />';
	header("location:fornecedor.form.php?e={$e->getMessage()}");
}


