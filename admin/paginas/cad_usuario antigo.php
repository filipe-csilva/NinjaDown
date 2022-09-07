<!doctype php>
<?php

    include "..\database\consultas.php";
	include "..\database\conexao\conn.php";
	
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
	
	//..\database\processos\cad_usuario_processa.php

	$cadnome = "";
	$cademail = "";
	$cadsenha = "";
	$cadresenha = "";
	$cadresult = "";

	if(isset($_POST['nome']) || isset($_POST['email']) || isset($_POST['senha']) || isset($_POST['resenha'])){
		if(strlen($_POST['nome']) == 0){
			$cadnome = "Preencha o seu nome completo";
			$con1 = 0;
		}else{
			$con1 = 1;
		};
		if(strlen($_POST['email']) == 0){
			$cademail = "Preencha o seu E-mail";
			$con2 = 0;
		}else{
			$cons_email = $mysqli->real_escape_string($_POST['email']);
			$sql_code = ("SELECT email FROM tb_users WHERE email = '$cons_email'");
			$resultuser = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
			$quantidade = $resultuser->num_rows;
			if($quantidade != 0){
				$cademail = "Email já Cadastrado em nossa base";
				$con2 = 0;
			}else{
			$con2 = 1;
			}
		};
		if(strlen($_POST['senha']) == 0){
			$cadsenha = "Preencha a sua senha";
			$con3 = 0;
		}else{
			$con3 = 1;
		};
		if(strlen($_POST['resenha']) == 0){
			$cadresenha = "Preencha a confirmação da senha";
			$con4 = 0;
		}else{
			$con4 = 1;
		};
		if(strlen($_POST['senha']) != strlen($_POST['resenha'])){
			if(strlen($_POST['resenha']) == 0){
				$cadresenha = "Preencha a confirmação da senha";
				$con5 = 0;
			}else{
			$cadresenha = "A senha e a confirmação de senha não são iguais";
			$con5 = 0;
			};
		}else{
			$con5 = 1;
		};
		if($con1 && $con2 && $con3 && $con4 && $con5 == 1){
			//header("Location: ..\database\processos\cad_usuario_processa.php");
			$cad_nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
			$cad_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$cad_senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

			$cad_senha = base64_encode($cad_senha);

			$cad_usuario = "INSERT INTO tb_users (nome, email, senha, criado, pts, classe) VALUES ('$cad_nome', '$cad_email', '$cad_senha', NOW(), '0', '0')";
	
			$resultado_usuario = mysqli_query($mysqli, $cad_usuario);
			
			if(mysqli_insert_id($mysqli)){
				$cadresult = "Úsuario com email $cad_email cadastrado com sucesso!";
			}else{
				$cadresult = "Erro ao cadastrar Úsuario!";
			}

		};
	};

?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="..\css\padrao.css">
	</head>
	<body>
		<form method="POST" action="">
		<table class="cad" align="center">
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="titulo" colspan="2">CADASTRO DE NOVO ÚSUARIO</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">NOME COMPLETO:</th>
				<th class="campo"><input type="text" name="nome" size="40" required><?php echo "&nbsp; $cadnome"; ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">E-MAIL:</th>
				<th class="campo"><input type="text" name="email" size="40" required><?php echo "&nbsp; $cademail"; ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">SENHA:</th>
				<th class="campo"><input type="password" name="senha" size="20" required><?php echo "&nbsp; $cadsenha"; ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">CONFIRME SENHA:</th>
				<th class="campo"><input type="password" name="resenha" size="20" required><?php echo "&nbsp; $cadresenha"; ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">&nbsp;</th>
				<th class="campo"><button type="reset">LIMPAR</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit">ENVIAR</button></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="resultado" colspan="2"><?php echo $cadresult; ?></th>
			</tr>
			</form>
		</table>
	</body>
</html>