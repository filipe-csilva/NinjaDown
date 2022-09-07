<!DOCTYPE php>
<?php

    include "admin\database\conexao\conn.php";
    
    //Consulta do titulo da pagina
    $sql_code = ("SELECT * FROM tb_title WHERE id = 1");
    $resulttitle = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
    $regtitle = mysqli_fetch_array($resulttitle);
    
    //Consulta do menu da pagina
    $sql_code = ("SELECT * FROM tb_menu WHERE situacao = 1 ORDER BY posicao ");
    $resultmenu = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);


?>