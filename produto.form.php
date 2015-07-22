<?php 
error_reporting(E_ALL);
ini_set('display_errors','On');

require_once "Conexao.php";
require_once 'Fornecedor.php';
 
$conexao = new Conexao("localhost", "projeto1", "root", "th1nk1ng0utl0ud");

$objFornecedores = new Fornecedor($conexao);
$fornecedores = $objFornecedores->listar();
?>

<form name="produto" id="produto" action="produto.controle.php" 
	contenteditable="true" method="post" tabindex="1" title="Cadastro de Produtos">
	<table>
		<tr>
			<td colspan="2" align="right">
				<input type="button" alt="Produtos" name="nf" id="nf" value="Produtos" onclick="javascript:document.location.href='index.php'" />
			</td>
		</tr>
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
				<input type="submit" alt="Adicionar produto" name="Adicionar" id="Adicionar" />
			</td>
		</tr>
	</table>

</form>
