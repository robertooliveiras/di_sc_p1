
<table border="1"> 
	<?php if (!empty($produtos) ): ?>
	<tr>
		<td>ID</td>
		<td>Nome do produto</td>
		<td>quantidade em estoque</td>
		<td>unidade de medida</td>
		<td>id do fornecedor</td>
		<td>fornecedor</td>
		<td>email fornecedor</td>
		<td>ação</td>
	</tr>
	<?php foreach ($produtos as $produto): ?>
	<tr>
		<td><?php echo $produto["id_produto"]; ?></td>
		<td><?php echo $produto["nome_produto"]; ?></td>
		<td><?php echo $produto["quantidade"]; ?></td>
		<td><?php echo $produto["unidade"]; ?></td>
		<td><?php echo $produto["id_fornecedor"]; ?></td>
		<td><?php echo $produto["nome_fornecedor"]; ?></td>
		<td><?php echo $produto["email"]; ?></td>
		<td align="center">-</td>
	</tr>
	<?php endforeach;?>
	<?php else:?>
	<?php if (!empty($_POST) ): ?>
	<tr>
		<td>
				Nenhum resultado encontrado
		</td>
	</tr>
	<?php endif;?>
	<?php endif;?>
</table>