<!DOCTYPE php>
<?php

    include "admin\database\consulta.php";
	
    $title = $regtitle['title'];

	if(isset($_POST['email']) || isset($_POST['senha'])){
		if(strlen($_POST['email']) == 0){
			echo "Preencha o seu E-mail";
		}else if(strlen($_POST['senha']) == 0){
			echo "Preencha a sua Senha";
		}else{
			$email = $mysqli->real_escape_string($_POST['email']);
			$senha = $mysqli->real_escape_string($_POST['senha']);

            $senha = base64_encode($senha);
			
			$sql_code = ("SELECT * FROM tb_users WHERE email = '$email' AND senha = '$senha'");
			$resultuser = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
			
			$quantidade = $resultuser->num_rows;
			
			if($quantidade == 1){
				
				$usuario = $resultuser->fetch_assoc();
				
				if(!isset($_SESSION)) {
					session_start();
				}
				
				$_SESSION['id'] = $usuario['id'];
				$_SESSION['nome'] = $usuario['nome'];
				$_SESSION['classe'] = $usuario['classe'];
				$_SESSION['pts'] = $usuario['pts'];
				
				
				
				header("location: longado.php");
				
			}else{
				echo "Falha ao logar! E-mail ou senha incorreto!";
			}
		}
	}

?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="admin\imagens\favicon\favicon.ico">
        <link rel="stylesheet" type="text/css" href="admin\css\style-home.css">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <table class="principal">
            <tr>
                <th>
                    <table class="logo">
                        <tr>
                            <th class="logoesq">&nbsp;</th>
                            <th class="logoprin"><a href="index.php"><img class="logo" src="admin\imagens\logo\logo.png"></a></th>
                            <th class="logodir">
								<form action="" method="post">
                                <table class="users" align="right">
									<tr>
										<th class="acess" colspan="3">Acesse sua conta:</th>
									</tr>
                                    <tr>
										<th class="espaco" colspan="3">&nbsp;</th>
									</tr>
									<tr>
										<th>Úsuario:</th>
										<th colspan="2"><input type="text" name="email" size="20"></th>
									</tr>
									<tr>
										<th>Senha:</th>
										<th colspan="2"><input type="password" name="senha" size="20"></th>
									</tr>
									<tr>
										<th>&nbsp;</th>
										<th><button type="reset">Limpar</button></th>
										<th><button type="submit">Enviar</button></th>
									</tr>
								</form>
                                    <tr>
										<th class="espaco" colspan="3">&nbsp;</th>
									</tr>
									<tr>
										<th colspan="3">Cadastre-se aqui!</th>
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