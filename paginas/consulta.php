<!DOCTYPE php>
<?php

include "..\admin\database\consultas.php";

    $solicitacao = $_REQUEST["consulta"];
    $solicitacao = base64_decode($solicitacao);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="..\admin\css\style-consulta.css">
    </head>
    <bodY>
        <table class="principal" border="1">
            <tr>
                <th><?php echo $solicitacao; ?></th>
            </tr>
        </table>
    </bodY>
</html>