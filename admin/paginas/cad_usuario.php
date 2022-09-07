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

	$cadresult = "";

	if(isset($_POST['nome']) || isset($_POST['email']) || isset($_POST['senha']) || isset($_POST['resenha'])){
		if(strlen($_POST['nome']) == 0){
			$cadresult = "Preencha o seu nome completo";
			$fontcolor = "#FF0033";
			$con1 = 0;
		}else{
			$con1 = 1;
		};
		if(strlen($_POST['email']) == 0){
			$cadresult = "Preencha o seu E-mail";
			$fontcolor = "#FF0033";
			$con2 = 0;
		}else{
			$cons_email = $mysqli->real_escape_string($_POST['email']);
			$sql_code = ("SELECT email FROM tb_users WHERE email = '$cons_email'");
			$resultuser = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
			$quantidade = $resultuser->num_rows;
			if($quantidade != 0){
				$cadresult = "Email já Cadastrado em nossa base";
				$fontcolor = "#FF0033";
				$con2 = 0;
			}else{
			$con2 = 1;
			}
		};
		if(strlen($_POST['senha']) == 0){
			$cadresult = "Preencha a sua senha";
			$fontcolor = "#FF0033";
			$con3 = 0;
		}else{
			$con3 = 1;
		};
		if(strlen($_POST['resenha']) == 0){
			$cadresult = "Preencha a confirmação da senha";
			$fontcolor = "#FF0033";
			$con4 = 0;
		}else{
			$con4 = 1;
		};
		if(strlen($_POST['senha']) != strlen($_POST['resenha'])){
			if(strlen($_POST['resenha']) == 0){
				$cadresult = "Preencha a confirmação da senha";
				$fontcolor = "#FF0033";
				$con5 = 0;
			}else{
			$cadresult = "A senha e a confirmação de senha não são iguais";
			$fontcolor = "#FF0033";
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
				$fontcolor = "#00be00";
			}else{
				$cadresult = "Erro ao cadastrar Úsuario!";
				$fontcolor = "#FF0033";
			}

		};
	};

?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="..\css\style-forms.css">
	</head>
	<body>
		<?php
			if($cadresult != false){
				?>
					<div class="result" style="color: <?php echo $fontcolor; ?>;">
						<b><?php echo $cadresult; ?></b>
					</div>
				<?php
			}
		?>
		<div class="box">
			<form method="POST" action="">
				<fieldset>
					<legend><b>Formulário de Cadastro</b></legend>
					<br>
					<div class="inputBox">
						<input type="text" name="nome" id="nome" class="inputUser" required>
						<label for="nome" class="labelInput">Nome Completo</label>
					</div>
					<br><br>
					<div class="inputBox">
						<input type="text" name="email" id="email" class="inputUser" required>
						<label for="email" class="labelInput">Email</label>
					</div>
					<br><br>
					<div class="inputBox">
						<input type="password" name="senha" id="senha" class="inputUser" required>
						<label for="senha" class="labelInput">Senha</label>
					</div>
					<br><br>
					<div class="inputBox">
						<input type="password" name="resenha" id="resenha" class="inputUser" required>
						<label for="resenha" class="labelInput">Confirmação de senha</label>
					</div>
					<br><br>
					<input type="submit" name="submit" class="submit">
				</fieldset>
			</form>
		</div>
	</body>
</html>