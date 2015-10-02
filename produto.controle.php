<?php
// error_reporting(E_ALL);
// ini_set('display_errors','On');
require_once "config.php";
require_once "Conexao.php";
require_once 'Produtos.php';
	
try {
	$conexao = new Conexao($GLOBALS['myHost'], $GLOBALS['myDb'], $GLOBALS['myUsr'], $GLOBALS['myPwd']);
	$objProdutos = new Produtos($conexao);
	$dados = $objProdutos->tratarDados($_POST);
	$objProdutos->inserir($dados);
	header("location:produto.form.php?e=sussa");
} catch (Exception $e) {
	header("location:produto.form.php?e={$e->getMessage()}");
}


