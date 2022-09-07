<!DOCTYPE php>
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

	$sql = "SELECT * FROM tb_users ORDER BY id DESC";

	$result = $mysqli->query($sql);

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="..\css\style-editor.css">
	<link href="../css/bootstrappes.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<div class="m-5">
		<table class="table text-white table-bg">
			<thead>
				<tr>
				<th scope="col">#</th>
				<th scope="col">Nome</th>
				<th scope="col">Email</th>
				<th scope="col">Senha</th>
				<th scope="col">Criado</th>
				<th scope="col">Pontos</th>
				<th scope="col">Bans</th>
				<th scope="col">Situação</th>
				<th scope="col">Classe</th>
				<th scope="col">...</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
					while($user_data = mysqli_fetch_assoc($result)){
						echo "<tr>";
						echo "<td>".$user_data['id']."</td>";
						$cons_id = base64_encode($user_data['id']);
						echo "<td>".$user_data['nome']."</td>";
						echo "<td>".$user_data['email']."</td>";
						$senha = base64_decode($user_data['senha']);
						echo "<td>".$senha."</td>";
						echo "<td>".$user_data['criado']."</td>";
						echo "<td>".$user_data['pts']."</td>";
						echo "<td>".$user_data['bans']."</td>";
						if($user_data['bans'] == 0){
							$situacao = "Liberado";
						}
						echo "<td>".$situacao."</td>";
						if($user_data['classe'] == 3){
							$classe = "Administrador";
						}elseif($user_data['classe'] == 2){
							$classe = "Moderador";
						}elseif($user_data['classe'] == 1){
							$classe = "Suporte";
						}else{
							$classe = "Padrão";
						}
						echo "<td>".$classe."</td>";
						echo "<td>
								<a class='btn btn-sm btn-primary' href='edit_usuario.php?id=$cons_id'>
									<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg>
								</a>
								<a class='btn btn-sm btn-danger' href='delet_usuario.php?id=$cons_id'>
									<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'><path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/></svg>
								</a>
							  </td>";
						echo "</tr>";
						
					}

				?>
			</tbody>
		</table>
	</div>
</body>
</html>