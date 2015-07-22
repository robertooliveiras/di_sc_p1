
<form name="fornecedor" id="fornecedor" action="fornecedor.controle.php" 
	contenteditable="true" method="post" tabindex="1" title="Cadastro de Fornecedores"
	target="">
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
			<td>Nome do Fornecedor:</td> 
			<td><input type="text" alt="Nome" id="nome_fornecedor" maxlength="200" name="nome_fornecedor" size="60" width="60" /></td>
		</tr>
		<tr>
			<td>E-mail do Fornecedor:</td> 
			<td><input type="text" alt="E-mail" id="email_fornecedor" maxlength="200" name="email_fornecedor" size="60" width="60" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" alt="Adicionar Fornecedor" name="Adicionar" id="Adicionar" />
			</td>
		</tr>
	</table>

</form>
