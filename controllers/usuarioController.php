<?php

# =========================================================
# BLOCO 1: VARIAVEIS INICIAIS
# =========================================================
# Essas variaveis guardam os valores do formulario.
# Elas comecam vazias para:
# - evitar erro de variavel indefinida
# - permitir preencher o formulario ao editar um usuario

$nome = "";
$email = "";
$naturalidade = "";
$rg = "";
$profissao = "";
$id = "";

# =========================================================
# BLOCO 2: TRATAMENTO DO FORMULARIO (POST)
# =========================================================
# Este trecho roda quando o formulario e enviado com method="POST".
# Ele serve tanto para cadastrar quanto para atualizar um usuario.

if($_SERVER['REQUEST_METHOD'] === "POST"){

    # Tenta capturar o ID enviado pelo formulario.
    # Se existir um ID inteiro valido, entendemos que e edicao.
    # Se nao existir, entendemos que e um novo cadastro.
    $id = isset($_POST['id']) ? filter_var($_POST['id'], FILTER_VALIDATE_INT) : false;

    # Captura os dados digitados pelo usuario no formulario.
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $naturalidade = $_POST['naturalidade'];
    $rg = $_POST['rg'];
    $profissao = $_POST['profissao'];

    # ---------------------------------------------------------
    # PARTE 2.1: UPDATE
    # ---------------------------------------------------------
    # Se o ID for valido, atualizamos o registro existente.
    if($id !== false && $id !== null){

        # pg_query_params envia os valores separados da SQL.
        # Isso ajuda a proteger contra SQL Injection.
        pg_query_params(
            $conexao,
            "UPDATE usuarios
             SET nome=$1, email=$2, naturalidade=$3, rg=$4, profissao=$5
             WHERE id=$6",
            [$nome, $email, $naturalidade, $rg, $profissao, $id]
        );

    } else {

        # ---------------------------------------------------------
        # PARTE 2.2: INSERT
        # ---------------------------------------------------------
        # Se nao existir ID valido, criamos um novo usuario.
        pg_query_params(
            $conexao,
            "INSERT INTO usuarios (nome, email, naturalidade, rg, profissao)
             VALUES ($1, $2, $3, $4, $5)",
            [$nome, $email, $naturalidade, $rg, $profissao]
        );
    }

    # Limpa as variaveis para o formulario nao continuar preenchido
    # com dados antigos depois da operacao.
    $nome = "";
    $email = "";
    $naturalidade = "";
    $rg = "";
    $profissao = "";
    $id = "";

    # Redireciona para a pagina principal.
    # Isso evita reenviar o formulario ao atualizar a pagina.
    header("Location: index.php");
    exit;
}

# =========================================================
# BLOCO 3: DELETE
# =========================================================
# Este trecho roda quando a URL vem com ?delete=ID.
# Ele exclui o usuario correspondente ao ID informado.

if(isset($_GET['delete'])){

    # Valida o ID recebido pela URL.
    # Somente numeros inteiros validos sao aceitos.
    $id = filter_var($_GET['delete'], FILTER_VALIDATE_INT);

    # So executa o DELETE se o ID for realmente valido.
    if($id !== false){
        pg_query_params(
            $conexao,
            "DELETE FROM usuarios WHERE id = $1",
            [$id]
        );
    }

    # Redireciona apos a tentativa de exclusao para limpar a URL
    # e evitar repetir a acao se a pagina for recarregada.
    header("Location: index.php");
    exit;
}

# =========================================================
# BLOCO 4: EDIT
# =========================================================
# Este trecho roda quando a URL vem com ?edit=ID.
# Ele busca os dados do usuario no banco para preencher o formulario.

if(isset($_GET['edit'])){

    # Valida o ID recebido pela URL.
    $id = filter_var($_GET['edit'], FILTER_VALIDATE_INT);

    if($id !== false){
        # Busca no banco o usuario com esse ID.
        $result_edit = pg_query_params(
            $conexao,
            "SELECT * FROM usuarios WHERE id = $1",
            [$id]
        );

        # Transforma o resultado da consulta em um array associativo.
        $dados = pg_fetch_assoc($result_edit);

        if($dados){
            # Copia os dados encontrados para as variaveis.
            # Essas variaveis sao usadas no formulario para mostrar
            # os valores atuais do usuario durante a edicao.
            $nome = $dados['nome'];
            $email = $dados['email'];
            $naturalidade = $dados['naturalidade'];
            $rg = $dados['rg'];
            $profissao = $dados['profissao'];
        }
    }
}

# =========================================================
# BLOCO 5: LISTAGEM DE USUARIOS
# =========================================================
# Busca todos os usuarios cadastrados no banco.
# O resultado sera usado na tabela da pagina.

$result = pg_query($conexao, "SELECT * FROM usuarios");

?>
