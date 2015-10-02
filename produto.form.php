<?php 
error_reporting(E_ALL);
ini_set('display_errors','On');
require_once "config.php";
require_once "Conexao.php";
require_once 'Fornecedor.php';

$conexao = new Conexao($GLOBALS['myHost'], $GLOBALS['myDb'], $GLOBALS['myUsr'], $GLOBALS['myPwd']);

$objFornecedores = new Fornecedor($conexao);
$fornecedores = $objFornecedores->listar();
require_once 'topo.php';
?>

<form name="produto" action="produto.controle.php" method="post">
	<table>
		<tr>
			<td colspan="2" align="center" style="color:red;">
			<?php if (isset($_GET["e"])): ?>
				<?php echo $_GET["e"]; ?>
			<?php endif; ?>&nbsp;
			</td>
		</tr>
		<tr>
			<td>Fornecedor:</td> 
			<td>
				<select id="id_fornecedor" name="id_fornecedor">
					<option value="">selecione...</option>
					<?php foreach ($fornecedores as $fornecedor): ?>
					<option value="<?php echo $fornecedor["id"]; ?>"><?php echo $fornecedor["nome"]; ?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nome do Produto:</td> 
			<td><input type="text" alt="Nome" id="nome_produto" maxlength="200" name="nome_produto" size="60" width="60" /></td>
		</tr>
		<tr>
			<td>Quantidade do Produto:</td> 
			<td><input type="text" alt="Nome" id="quantidade" maxlength="200" name="quantidade" size="60" width="60" /></td>
		</tr>
		<tr>
			<td>Unidade de medida:</td> 
			<td><input type="text" alt="E-mail" id="unidade" maxlength="200" name="unidade" size="60" width="60" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" value="Adicionar produto" name="Adicionar" id="Adicionar" />
			</td>
		</tr>
	</table>

</form>

<?php
require_once 'footer.php';