<?php 
$objFornecedores = new Fornecedor($conexao);
$fornecedores = $objFornecedores->listar();
?>

<form name="produtos" action="index.php" method="post" >
	<table>
		<tr>
			<td colspan="2" align="center">
			<?php if (isset($_GET["e"])): ?>
				<p style="color:red;"><?php echo $_GET["e"]; ?></p>
			<?php endif; ?>&nbsp;
			</td>
		</tr>
		<tr>
			<td>ID do Produto:</td> 
			<td><input type="text" alt="ID" id="id_produto" maxlength="5" name="id_produto" size="20" width="20" /></td>
		</tr>
		<tr>
			<td>Nome do Produto:</td> 
			<td><input type="text" alt="Nome" id="nome_produto" maxlength="200" name="nome_produto" size="60" width="60" /></td>
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
			<td colspan="2" align="center">
				<input type="submit" alt="Pesquisar Produto" name="Pesquisar" id="Pesquisar" value="Pesquisar" />
			</td>
		</tr>
	</table>

</form>