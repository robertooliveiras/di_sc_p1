<?php 
$objFornecedores = new Fornecedor($conexao);
$fornecedores = $objFornecedores->listar();
?>

<form name="produtos" id="produtos" action="index.php" 
	contenteditable="true" method="post" tabindex="1" title="Pesquisa de Produtos"
	target="">
	<table>
		<tr>
			<td colspan="2" align="right">
				<input type="button" alt="novo fornecedor" name="nf" id="nf" value="Novo fornecedor" onclick="javascript:document.location.href='fornecedor.form.php'" />
				<input type="button" alt="novo produto" name="np" id="np" value="Novo produto" onclick="javascript:document.location.href='produto.form.php'" />
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
			<?php if (isset($_GET["e"])): ?>
				<p style="color:red;"><?php echo $_GET["e"]; ?></p>
			<?php endif; ?>
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