<!DOCTYPE php>
<?php

    include "..\admin\database\consultas.php";

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="..\admin\css\style-principal.css">
		<!-- BootStrap -->
		<!--css-->
		<link href="..\admin\css\bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<!--css-->
		<!--JS-->
		<script src="..\admin\js\bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<!--JS-->
		<!-- BootStrap -->
		
    </head>
    <body>
        <table class="principal" border="1">
            <tr>
                <th class="destaque">
					<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
					  <div class="carousel-indicators">
						<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
						<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
						<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
					  </div>
					  <div class="carousel-inner">
						<div class="carousel-item active">
						  <img src="../admin/imagens/slide/slide01.jpg" height="280" class="d-block w-100" alt="...">
						  <div class="carousel-caption d-none d-md-block">
							<h5>First slide label</h5>
							<p>Some representative placeholder content for the first slide.</p>
						  </div>
						</div>
						<div class="carousel-item">
						  <img src="../admin/imagens/slide/slide02.jpg" height="280" class="d-block w-100" alt="...">
						  <div class="carousel-caption d-none d-md-block">
							<h5>Second slide label</h5>
							<p>Some representative placeholder content for the second slide.</p>
						  </div>
						</div>
						<div class="carousel-item">
						  <img src="../admin/imagens/slide/slide03.jpg" height="280" class="d-block w-100" alt="...">
						  <div class="carousel-caption d-none d-md-block">
							<h5>Third slide label</h5>
							<p>Some representative placeholder content for the third slide.</p>
						  </div>
						</div>
					  </div>
					  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					  </button>
					  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					  </button>
					</div>
				</th>
				<th width="2%">&nbsp;</th>
                <th class="add">
                    <?php

                        $ip = 1;
                        $if = 1;

                        while($itemprognov = mysqli_fetch_array($resultprognov)){
                            $idprognov = $itemprognov['id'];
                            $fotoprognov = $itemprognov['foto'];
                            $nomeprognov = $itemprognov['nome'];
                            $mdescprognov = $itemprognov['mdesc'];
                            $sistprognov = $itemprognov['sistema'];
                            $versaoprognov = $itemprognov['versao'];
                            $modalidadeprognov = $itemprognov['modalidade'];

                            if($ip <= 3){
                                $pulo = "<font size=0px> &nbsp </font>";
                            }else{
                                $pulo = "";
                            };

                            if($if <= 1){
                                $inf = "<tr>
                                            <th class=if colspan=4 align=left>Adicionado Recentemente:</th>
                                        </tr>";
                            }else{
                                $inf = "";
                            };

                            if($sistprognov == 1){
                                $logosistema = "windows.png";
                                $sistprognov = "Windows";
                            }elseif($sistprognov == 2){
                                $logosistema = "android.png";
                                $sistprognov = "Android";
                            }elseif($sistprognov == 3){
                                $logosistema = "linux.png";
                                $sistprognov = "Linux";
                            };

                            if($modalidadeprognov == 1){
                                $modalidadeprognov = "Grátis";
                                $modalidadecolor = "#00dc00";
                            }elseif($modalidadeprognov == 2){
                                $modalidadeprognov = "30 Dias";
                                $modalidadecolor = "#0064ff";
                            }elseif($modalidadeprognov == 3){
                                $modalidadeprognov = "Pago";
                                $modalidadecolor = "#ff0000";
                            };

                            ?>
                            <table class="programas">
                                <?php echo $inf ?>
                                <tr>
                                    <th class="progfoto" rowspan="3"><img class="fotoprog" src="..\admin\imagens\programas\<?php echo $fotoprognov; ?>"></th>
                                    <th class="prognome" colspan="3" align="left">&nbsp;<?php echo $nomeprognov; ?></th>
                                </tr>
                                <tr>
                                    <th class="progdesc" colspan="3" align="left">&nbsp;<?php echo $mdescprognov; ?></th>
                                </tr>
                                <tr>
                                    <th class="proginf"><img class="fotosist" src="..\admin\imagens\sistema\<?php echo $logosistema; ?>"> <?php echo $sistprognov; ?></th>
                                    <th class="proginf">Versão: <?php echo $versaoprognov; ?></th>
                                    <th class="proginf"><font color="<?php echo $modalidadecolor; ?>"><?php echo $modalidadeprognov; ?></font></th>
                                </tr>
                            </table>
                            <?php
                            echo $pulo;
                            $ip = $ip+1;
                            $if = $if+1;
                        };
                    ?>
                </th>
				<!--<th width="1%">&nbsp;</th>-->
                <th class="banner" rowspan="6">
                <!-- Início do código HTML Cursos 24 Horas -->
                    <div style="text-align:center;"><a target="_blank" href="https://www.cursos24horas.com.br/parceiro.asp?cod=promocao21828" rel="nofollow"><img alt="Cursos Online - Cursos 24 Horas" style="border:none;" width="100%" height= "720" src="https://www.cursos24h.net.br/banners/gif8/160x600.gif" /></a><br /></div>
                <!-- Fim do código HTML Cursos 24 Horas -->
</th>
            </tr>
            <tr>
                <th colspan="3" align="center">
                    <table class="noticia">
                        <tr>
                            <th colspan="3">
                                <!-- Início do código HTML Cursos 24 Horas -->
                                <div style="text-align:center; margin:15px;"><a target="_blank" href="https://www.cursos24horas.com.br/parceiro.asp?cod=promocao21828" rel="nofollow"><img style="border:none;" width="70%" height= "2%" src="http://www.cursos24h.net.br/banners/gif5/728x90.gif" /></a></div>
                                <!-- Fim do código HTML Cursos 24 Horas -->
                            </th>
                        </tr>
                        <tr>
                            <th class="if" colspan="3" align="left">Ultimas Notícias:</th>
                        </tr>
                        <tr>
                            <th class="not1">
                                <?php

                                $i = 1;

                                $matnoticia[$i] = "&nbsp;";

                                while($itemnoticia = mysqli_fetch_array($resultnoticia)){
                                    $idnoticia[$i] = $itemnoticia['id'];
                                    $matnoticia[$i] = $itemnoticia['materia'];
                                    $matdata[$i] = $itemnoticia['data'];
                                    $i = $i+1;

                                };
                                ?>
                                <table class="noticia">
                                    <tr>
                                        <th class="notinterior" align="left"> &#149; [<?php echo $matdata[1] ?>] - <?php echo $matnoticia[1] ?></th>
                                    </tr>
                                    <tr>
                                        <th class="notinterior" align="left"> &#149; [<?php echo $matdata[2] ?>] - <?php echo $matnoticia[2] ?></th>
                                    </tr>
                                    <tr>
                                        <th class="notinterior" align="left"> &#149; [<?php echo $matdata[3] ?>] - <?php echo $matnoticia[3] ?></th>
                                    </tr>
                                    <tr>
                                        <th class="notinterior" align="left"> &#149; [<?php echo $matdata[4] ?>] - <?php echo $matnoticia[4] ?></th>
                                    </tr>
                                    <tr>
                                        <th class="notinterior" align="left"> &#149; [<?php echo $matdata[5] ?>] - <?php echo $matnoticia[5] ?></th>
                                    </tr>
                                </table>
                            </th>
                            <th class="div" align="right"><hr class="div"></th>
                            <th class="not2">
                            <table class="noticia">
                                    <tr>
                                        <th class="notinterior" align="left"> &#149; [<?php echo $matdata[6] ?>] - <?php echo $matnoticia[6] ?></th>
                                    </tr>
                                    <tr>
                                        <th class="notinterior" align="left"> &#149; [<?php echo $matdata[7] ?>] - <?php echo $matnoticia[7] ?></th>
                                    </tr>
                                    <tr>
                                        <th class="notinterior" align="left"> &#149; [<?php echo $matdata[8] ?>] - <?php echo $matnoticia[8] ?></th>
                                    </tr>
                                    <tr>
                                        <th class="notinterior" align="left"> &#149; [<?php echo $matdata[9] ?>] - <?php echo $matnoticia[9] ?></th>
                                    </tr>
                                    <tr>
                                        <th class="notinterior" align="left"> &#149; [<?php echo $matdata[10] ?>] - <?php echo $matnoticia[10] ?></th>
                                    </tr>
                                </table>
                            </th>
                        </tr>
                    </table>
                </th>
            </tr>
            <tr>
                <th colspan="2">Mais destaques!</th>
            </tr>
            <tr>
                <th colspan="2">&nbsp;</th>
            </tr>
            <tr>
                <th colspan="2">&nbsp;</th>
            </tr>
            <tr>
                <th colspan="2">&nbsp;</th>
            </tr>
        </table>
    </body>
</html>