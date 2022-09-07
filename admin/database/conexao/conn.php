<!DOCTYPE php>

<?php

    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $database = "db_njdown";

    $mysqli = new mysqli($host, $usuario, $senha, $database);

	if($mysqli->error) {
    	die("Falha ao conectar ao banco de dados: " . $mysqli->error);
	}

?>