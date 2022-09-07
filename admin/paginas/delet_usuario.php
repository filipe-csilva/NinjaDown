<?php

    include "..\database\conexao\conn.php";
        
    //Inicialização de sessão
    if(!isset($_SESSION)) {
        session_start();
    };

    $nome = $_SESSION['nome'];
    $classe = $_SESSION['classe'];

    if(!isset($_SESSION['id'])){
        //die("Você não pode acessar está pagina porque não está longado.");
        header("Location: index.php");
    };

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];

        $id = base64_decode($id);

        $sqlSelect = "SELECT *  FROM tb_users WHERE id=$id";

        $result = $mysqli->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM tb_users WHERE id=$id";
            $resultDelete = $mysqli->query($sqlDelete);
        }
    }
    header('Location: cons_usuario.php');
   
?>