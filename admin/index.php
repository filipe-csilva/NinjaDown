<!DOCTYPE php>
<?php
	//Inicialização de sessão
	if(!isset($_SESSION)) {
    	session_start();
	}

    if(!isset($_SESSION['id'])){
        //die("Você não pode acessar está pagina porque não está longado.");
        header("Location: ../index.php");
    };
	
	if($_SESSION['classe'] == 0){
        //die("Você não pode acessar está pagina porque não está longado.");
        header("Location: ../longado.php");
    };

	$classe = $_SESSION['classe'];

?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css\style-painel.css">
        <meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="imagens\favicon\favicon.ico">
        <title>Area Administrativa</title>
    </head>
    <body>
        <table class="principal" border="1">
            <tr>
                <th class="menu">
                    <img class="img" src="imagens\logo\logo.png">
                    <table class="botao">
                        <?php if($classe >= 2){ echo "<tr><th class='botao'><a href='paginas/dash.php' target='frame1'>DRASHBOARD</a></th></tr>";} ?>
                        <?php if($classe >= 1){ echo "<tr><th class='botao'><a href='paginas/usuarios.php' target='frame1'>ÚSUARIOS</a></th></tr>";} ?>
						<?php if($classe == 3){ echo "<tr><th class='botao'><a href='paginas/menus.php' target='frame1'>MENUS</a></th></tr>";} ?>
						<?php if($classe >= 1){ echo "<tr><th class='botao'><a href='paginas/noticias.php' target='frame1'>NOTÍCIAS</a></th></tr>";} ?>
                        <?php if($classe >= 1){ echo "<tr><th class='botao'><a href='paginas/programas.php' target='frame1'>PROGRAMAS</a></th></tr>";} ?>
                        <?php if($classe == 3){ echo "<tr><th class='botao'><a href='paginas/titulo.php' target='frame1'>TÍTULO</a></th></tr>";} ?>
                    </table>
                </th>
                <th class="frame"><iframe class="frame1" name="frame1" src="paginas\dash.php" scrolling="no"></iframe></th>
            </tr>
            <tr>
                <th class="fim" colspan="2">© COPYRIGHT 2021 - FILIPE PAULO, TODOS OS DIREITOS RESERVADOS</th>
            </tr>
        </table>
    </body>
</html>