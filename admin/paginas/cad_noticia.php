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

	$cadnoticia = false;
	$cadresult = false;
	$cadtexto = false;

	if(isset($_POST['noticia']) || isset($_POST['noticia'])){
		if(strlen($_POST['noticia']) == 0){
			$cadnoticia = "O campo notícia não está preenchido!";
		}
		elseif(strlen($_POST['texto']) == 0){
			$cadtexto = "O campo do texto está vazio";
		}
		else
		{
			$cad_materia = filter_input(INPUT_POST, 'noticia', FILTER_DEFAULT);

			//separador de nome com acao de deixar minusculo
			$extensao = strtolower(substr($_FILES['imagem']['name'], -4));
			
			//alterador de nome
			$newnameimg = md5(time()) . $extensao;

			//diretorio das imagens
			$diretorio = "..\imagens\upload/";

			//realocando a imagem com o novo nome
			move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$newnameimg);

			//introdução ao banco de dados
			$cad_noticia = "INSERT INTO tb_noticia (materia, foto, data, situacao) VALUES ('$cad_materia', '$newnameimg', NOW(), '1')";

			//checador de inserção no banco de dados
			$resultado_noticia = mysqli_query($mysqli, $cad_noticia);

			if(mysqli_insert_id($mysqli)){
				$cadresult = "A notícia $cadnoticia foi cadastrada com sucesso!";
			}else{
				$cadresult = "Erro ao cadastrar Úsuario!";
			}
		}
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
				<th class="titulo" colspan="2">CADASTRO DE NOTÍCIAS</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<form method="POST" action="" enctype="multipart/form-data">
			<tr>
				<th class="inf">NOTÍCIA:</th>
				<th class="campo"><input type="text" name="noticia" size="40" required><?php echo "&nbsp; $cadnoticia"; ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">IMAGEM:</th>
				<th class="campo"><input type="file" name="imagem" size="40"></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">TEXTO:</th>
				<th class="campo"><textarea name="texto" rows="12" cols="40" required></textarea><?php echo "&nbsp; $cadtexto"; ?></th>
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