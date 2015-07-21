
<table> 
	<tr>
		<td>ID</td>
		<td>Nome do fornecedor</td>
		<td>email fornecedor</td>
	</tr>
	<?php foreach ($fornecedores as $fornecedor): ?>
	<tr>
		<td><?php echo $fornecedor["id"]; ?></td>
		<td><?php echo $fornecedor["nome"]; ?></td>
		<td><?php echo $fornecedor["email"]; ?></td>
	</tr>
	<?php endforeach;?>
</table>