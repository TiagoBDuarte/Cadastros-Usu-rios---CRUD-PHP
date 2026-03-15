

<div>

<h2>Lista de Usuários</h2>

<table>

<thead>

<tr>
<th>Nome</th>
<th>Email</th>
<th>Naturalidade</th>
<th>RG</th>
<th>Profissão</th>
<th>Ações</th>
</tr>

</thead>

<tbody>

<?php while($row = pg_fetch_assoc($result)){?>
<tr>

<td><?php echo $row['nome']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['naturalidade']; ?></td>
<td><?php echo $row['rg'];?></td>
<td><?php echo $row['profissao'];?></td>

<td class="acoes">

<!--Excluir-->
<a href="index.php?delete=<?php echo $row['id'];?>">
    <button class="excluir">Excluir</button>
</a>
<!------------------------------------->


<!--Editar-->

<a href="index.php?edit=<?php echo $row['id']?>">
    <button class="editar">Editar</button>
</a>
<!------------------------------------->



</td>

</tr>

<?php }?>

</tbody>

</table>

</div>