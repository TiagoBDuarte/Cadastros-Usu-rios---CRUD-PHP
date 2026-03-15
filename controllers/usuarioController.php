<?php

#codigo parte 1 : requisitando o metodo
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

#codigo parte 2 : Atualizar
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

#codigo parte 3 :limpar para adicionar novos campos
$nome = "";
$email = "";
$naturalidade = "";
$rg = "";
$profissao = "";
$id = "";

/*redireciona para evitar repost*/
header("Location: index.php");
exit;

}


$result = pg_query($conexao,"SELECT * FROM usuarios");

/*codigo parte 54:Função para excluir*/
if(isset($_GET['delete'])){
$id = $_GET['delete'];
$query = "DELETE FROM usuarios WHERE id = $id";
pg_query($conexao,$query);

}


/*codigo parte 5 :Função para editar*/
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
