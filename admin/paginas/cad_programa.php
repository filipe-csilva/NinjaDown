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

	$cadnome = false;
	$cadmdesc = false;
	$caddesc = false;
	$cadresult = false;

	if(isset($_POST['nome']) || isset($_POST['mdesc']) || isset($_POST['desc'])){
		if(strlen($_POST['nome']) == 0){
			$cadnome = "O campo nome não está preenchido!";
			$con1 = 0;
		}else{
			$con1 = 1;
		};		
		if(strlen($_POST['mdesc']) == 0){
			$cadmdesc = "O campo mini-descrição não está preenchido!";
			$con2 = 0;
		}else{
			$con2 = 1;
		};
		if(strlen($_POST['desc']) == 0){
			$caddesc = "O campo descrição não está preenchido!";
			$con3 = 0;
		}else{
			$con3 = 1;
		};

		if($con1 && $con2 && $con3 == 1){
			$cad_nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
			$cad_mdesc = filter_input(INPUT_POST, 'mdesc', FILTER_DEFAULT);
			$cad_desc = filter_input(INPUT_POST, 'desc', FILTER_DEFAULT);
			$cad_sist = filter_input(INPUT_POST, 'sistema', FILTER_DEFAULT);
			$cad_vers = filter_input(INPUT_POST, 'versao', FILTER_DEFAULT);
			$cad_catg = filter_input(INPUT_POST, 'categoria', FILTER_DEFAULT);
			$cad_modl = filter_input(INPUT_POST, 'modalidade', FILTER_DEFAULT);

			//separador de nome com acao de deixar minusculo
			$extensao = strtolower(substr($_FILES['imagem']['name'], -4));

			//alterador de nome
			$newnameimg = md5(time()) . $extensao;

			//diretorio das imagens
			$diretorio = "..\imagens\programas/";

			//realocando a imagem com o novo nome
			move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$newnameimg);

			$cad_programa = "INSERT INTO tb_programas (nome, mdesc, descricao, foto, situacao) VALUES ('$cad_nome', '$cad_mdesc', '$cad_desc', '$newnameimg', '1')";
		
			//checador de inserção no banco de dados
			$resultado_programa = mysqli_query($mysqli, $cad_programa);

			if(mysqli_insert_id($mysqli)){
				$cadresult = "A notícia $cadnome foi cadastrada com sucesso!";
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
				<th class="titulo" colspan="2">CADASTRO DE PROGRAMA</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<form method="POST" action="" enctype="multipart/form-data">
			<tr>
				<th class="inf">NOME:</th>
				<th class="campo"><input type="text" name="nome" size="40" required><?php echo "&nbsp; $cadnome"; ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">MINI-DESCRIÇÃO:</th>
				<th class="campo"><input type="text" name="mdesc" size="40" required><?php echo "&nbsp; $cadmdesc"; ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">DESCRIÇÃO:</th>
				<th class="campo"><textarea name="desc" rows="12" cols="40" required></textarea><?php echo "&nbsp; $caddesc"; ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<th class="inf">SISTEMA:</th>
				<th class="campo2">
					<input type="radio" id="sistema-windows" name="sistema" value="1"><label for="sistema-windows"><img class="fotosistema" src="..\imagens\sistema\windows.png">&nbsp;WINDOWS</label><br>
					<input type="radio" id="sistema-linux" name="sistema" value="2"><label for="sistema-linux"><img class="fotosistema" src="..\imagens\sistema\linux.png">&nbsp;LINUX</label><br>
					<input type="radio" id="sistema-android" name="sistema" value="3"><label for="sistema-android"><img class="fotosistema" src="..\imagens\sistema\android.png">&nbsp;ANDROID</label>
				</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">VERSÃO:</th>
				<th class="campo"><input type="text" name="versao" size="7" required><?php echo "&nbsp; $cadnome"; ?></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<th class="inf">CATÉGORIA:</th>
				<th class="campo2">
				<select name="categoria" required>
						<option value="1" selected>GRÁTIS</option>
						<option value="2">30 DIAS</option>
						<option value="3">PAGO</option>
					</select>
				</th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th class="inf">MODALIDADE:</th>
				<th class="campo">
					<select name="modalidade" required>
						<?php

							while($itemmodalidade = mysqli_fetch_array($resultmodalidade)){
								$idmod = $itemmodalidade['id'];
								$nomemod = $itemmodalidade['modalidade'];

								?>

									<option value="<?php echo $idmod; ?>"><?php echo $nomemod; ?></option>

								<?php

							};
						?>
					</select>
				</th>
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