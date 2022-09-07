<!DOCTYPE php>
<?php

    include "conexao\conn.php";

    //Consulta do menu das noticias
    $sql_code = ("SELECT * FROM tb_noticia WHERE situacao = 1 ORDER BY id DESC LIMIT 10");
    $resultnoticia = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    //Consulta dos programas novos
    $sql_code = ("SELECT * FROM tb_programas WHERE situacao = 1 ORDER BY id DESC LIMIT 4");
    $resultprognov = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    //Consulta das modalidades
    $sql_code = ("SELECT * FROM tb_modalidade ORDER BY modalidade");
    $resultmodalidade = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
?>