<?php
/*Arquivo principal que irá incluir toda a estrutura*/


    include "config/config.php";

    #Esta em controllers/usuarioController.php

    include "controllers/usuarioController.php";
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


<?php
#formulario de preenchimento esta na pasta views/formulario.php
    include "views/formulario.php";

#formulario de preenchimento esta na pasta views/tabela.php
    include"views/tabela.php";

?>