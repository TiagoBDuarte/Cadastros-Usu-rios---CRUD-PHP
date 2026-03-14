<?php

$conexao = pg_connect("host=localhost dbname=usuarios  user=postgres  password=1928");

if(!$conexao){
    echo "Erro na conexão com o banco <br>";
}

$nome = "";
$email = "";
$naturalidade = "";
$rg = "";
$profissao = "";

if($_SERVER['REQUEST_METHOD'] === "POST"){/*estudar*/

$id = $_POST['id'] ?? "";/*estudar*/

$nome = $_POST['nome'];/*estudar*/
$email = $_POST['email'];/*estudar*/
$naturalidade = $_POST['naturalidade'];/*estudar*/
$rg = $_POST['rg'];/*estudar*/
$profissao = $_POST['profissao'];/*estudar*/

if($id != ""){/*estudar*/
/*estudar*/
$query = "
UPDATE usuarios SET
nome='$nome',
email='$email',
naturalidade='$naturalidade',
rg='$rg',
profissao='$profissao'
WHERE id=$id
";
/*estudar*/
}else{
/*estudar*/
$query = "
INSERT INTO usuarios(
nome,
email,
naturalidade,
rg,
profissao
)
VALUES('$nome','$email','$naturalidade','$rg','$profissao')
";

}

pg_query($conexao,$query);
/*limpa os campos após o insert*/
$nome = "";
$email = "";
$naturalidade = "";
$rg = "";
$profissao = "";
$id = "";

}


$result = pg_query($conexao,"SELECT * FROM usuarios");

/*Função para excluir*/
if(isset($_GET['delete'])){
$id = $_GET['delete'];
$query = "DELETE FROM usuarios WHERE id = $id";
pg_query($conexao,$query);

}


/*Função para editar*/
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $query = "SELECT * FROM usuarios WHERE id= $id";
    $result_edit = pg_query($conexao,$query);
    $dados = pg_fetch_assoc($result_edit);

    $nome = $dados['nome'];
    $email = $dados['email'];
    $naturalidade = $dados['naturalidade'];
    $rg = $dados['rg'];
    $profissao = $dados['profissao'];

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Cadastro de Usuários</title>

<link rel="stylesheet" href="templates/index.css">

</head>
<body>

<div class="container">

<h1>Cadastro de Usuários</h1>

<form action="" method="POST" class="formulario">
        <input type="hidden" name="id" value="<?php echo $id ?? ''; ?>"><!--estudar-->

    <label>Nome</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required>

    <label>Email</label>
         <input type="email" name="email" value="<?php echo $email; ?>" required>

    <label>Naturalidade</label>
        <input type="text" name="naturalidade" value="<?php echo $naturalidade; ?>" required>

    <label>RG</label>
        <input type="text" name="rg" value="<?php echo $rg;?>"required>

    <label>Profissão</label>
        <input type="text" name="profissao" value="<?php echo $profissao; ?>" required>

<button type="submit" class="botao-cadastrar">
Cadastrar
</button>

</form>


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

</body>
</html>