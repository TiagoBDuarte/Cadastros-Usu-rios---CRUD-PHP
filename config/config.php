<?php

$conexao = pg_connect("host=localhost dbname=usuarios  user=postgres  password=1928");

if(!$conexao){
    echo "Erro na conexão com o banco <br>";
}

?>