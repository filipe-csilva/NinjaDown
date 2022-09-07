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

	if(!empty($_GET['id'])){

		$id=$_GET['id'];

		$id = base64_decode($id);

		$sqlSelect = "SELECT * FROM tb_users WHERE id=$id";

		$result = $mysqli->query($sqlSelect);

		if($result->num_rows > 0){
			while($user_data = mysqli_fetch_assoc($result)){
				$res_nome = $user_data['nome'];
				$res_email = $user_data['email'];
				$res_senha = base64_decode($user_data['senha']);

			};
		}else{
			header('Location: cons_usuario.php');
		}
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
			$con2 = 1;
		};
		if(strlen($_POST['senha']) == 0){
			$cadresult = "Preencha a sua senha";
			$fontcolor = "#FF0033";
			$con3 = 0;
		}else{
			$con3 = 1;
		};
		if($con1 && $con2 && $con3 == 1){
			//header("Location: ..\database\processos\cad_usuario_processa.php");
			$cad_nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
			$cad_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$cad_senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

			$cad_senha = base64_encode($cad_senha);

			$up_usuario = "UPDATE tb_users SET nome='$cad_nome', email='$cad_email', senha='$cad_senha' WHERE id='$id'";
	
			$resultado_usuario = $mysqli->query($up_usuario);

			header('Location: cons_usuario.php');

		}else{
			$cadresult = "Erro ao atualizar o Úsuario!";
			$fontcolor = "#FF0033";
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
						<input type="text" name="nome" id="nome" value="<?php echo $res_nome; ?>" class="inputUser" required>
						<label for="nome" class="labelInput">Nome Completo</label>
					</div>
					<br><br>
					<div class="inputBox">
						<input type="text" name="email" id="email" value="<?php echo $res_email; ?>" class="inputUser" required>
						<label for="email" class="labelInput">Email</label>
					</div>
					<br><br>
					<div class="inputBox">
						<input type="text" name="senha" id="senha" value="<?php echo $res_senha; ?>" class="inputUser" required>
						<label for="senha" class="labelInput">Senha</label>
					</div>
					<br><br>
					<input type="submit" name="update" id="update" class="submit">
				</fieldset>
			</form>
		</div>
	</body>
</html>