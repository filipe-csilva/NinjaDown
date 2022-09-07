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
        header("Location: index.php");
    };

	$cadmod = false;
	$cadresult = false;

	if(isset($_POST['modalidade'])){
		if(strlen($_POST['modalidade']) == 0){
			$cadmod = "O campo nome não está preenchido!";
			$con1 = 0;
		}else{
			$con1 = 1;
		};

		if($con1 == 1){
			$cad_mod = filter_input(INPUT_POST, 'modalidade', FILTER_DEFAULT);

			$cad_modalidade = "INSERT INTO tb_modalidade (modalidade) VALUES ('$cad_mod')";
		
			//checador de inserção no banco de dados
			$resultado_modalidade = mysqli_query($mysqli, $cad_modalidade);

			if(mysqli_insert_id($mysqli)){
				$cadresult = "A modalidade $cadmod foi cadastrada com sucesso!";
			}else{
				$cadresult = "Erro ao cadastrar Úsuario!";
			};
		
		};
	};

?>

<!doctype php>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="..\css\padrao.css">
	</head>
	<body>
		<table class="cad" align="center">
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="titulo" colspan="2">CADASTRO DE MODALIDADE</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<form method="POST" action="" enctype="multipart/form-data">
			<tr>
				<th class="inf">NOME:</th>
				<th class="campo"><input type="text" name="modalidade" size="40" required><?php echo "&nbsp; $cadmod"; ?></th>
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