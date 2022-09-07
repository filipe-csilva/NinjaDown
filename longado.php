<!DOCTYPE php>
<?php

    include "admin\database\consulta.php";

    $title = $regtitle['title'];
	
	
	//Inicialização de sessão
	if(!isset($_SESSION)) {
    	session_start();
	}

	$nome = $_SESSION['nome'];
	$classe = $_SESSION['classe'];

    if(!isset($_SESSION['id'])){
        //die("Você não pode acessar está pagina porque não está longado.");
        header("Location: index.php");
    };
	
	//Ativação da area administrativa no menu principal
    $userlog = "não";

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="admin\css\style-home.css">
        <link rel="icon" type="image/x-icon" href="admin\imagens\favicon\favicon.ico">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <table class="principal">
            <tr>
                <th>
                    <table class="logo">
                        <tr>
                            <th class="logoesq">&nbsp;</th>
                            <th class="logoprin"><a href="longado.php"><img class="logo" src="admin\imagens\logo\logo.png"></a></th>
                            <th class="logodir">
                                <table class="users2" align="right">
                                    <tr>
                                        <th class="log" align="left" >Olá, <?php echo $nome ?></th>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                    </tr>
									<tr>
                                        <th class="log" align="left" ><a href="">MINHA CONTA</a></th>
                                    </tr>
									<?php
										
										if($classe == 3){
											echo "<tr><th class=log align=left ><a href='admin/index.php'>AREA ADMINISTRATIVA</a></th></tr>";
										}else if($classe == 2){
											echo "<tr><th class=log align=left ><a href='admin/index.php'>AREA MODERATIVA</a></th></tr>";
										}else if($classe == 1){
											echo "<tr><th class=log align=left ><a href='admin/index.php'>AREA SUPORTE</a></th></tr>";
										};
	
									?>
									<tr>
                                        <th class="log" align="left" ><a href="logout.php">SAIR</a></th>
                                    </tr>									
                                </table>
                            </th>
                        </tr>
                    </table>
                </th>
            </tr>
            <tr>
                <th align="center" class="menu">
                    <table class="menu">
                        <tr>
                            <?php
                            
                                while($itemmenu = mysqli_fetch_array($resultmenu)){
                                    $menu = $itemmenu['nome'];
                                    $link = $itemmenu['link'];
                                    $target = "";
                                    if ($menu == "TOP MAIS"){
                                        $link = "paginas/$link";
                                        $target = "target=frame1";
                                    }elseif ($menu == "SOBRE"){
                                            $link = "paginas/$link";
                                            $target = "target=frame1";
                                    }elseif($menu != "INÍCIO"){
                                        $link = "paginas/consulta.php?consulta=$link";
                                        $target = "target=frame1";
                                    };
                                    ?>
                                    <th class='botao' valign="middle"><a href="<?php echo $link; ?>" <?php echo $target; ?>><?php echo $menu; ?></a></th>
                                    <?php
                                };
                                if($userlog == "teste"){
                                    ?><th class='botao' valign="middle"><a href="admin/index.php">ADMINISTRAÇÃO</a></th><?php
                                };
                            ?>
                        </tr>
                    </table>
                </th>
            </tr>
            <tr>
                <th align="center">
                    <table class="frame">
                        <tr>
                            <th><iframe class="frame1" name="frame1" src="paginas\principal.php" scrolling="no"></iframe></th>
                        </tr>
                    </table>
                </th>
            </tr>
            <tr>
                <th class="fim">© COPYRIGHT 2022 - RAIONET-INFORMÁTICA, TODOS OS DIREITOS RESERVADOS</th>
            </tr>
        </table>
    </body>
</html>