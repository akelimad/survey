<?php
require_once dirname(__FILE__) . "/../../../../config/fo_conn.php";
$ariane=" Accueil > Service indisponible";		
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp.php"); ?>
</head>
<body>

    <div id='container'>
        <?php include ( dirname(__FILE__) . $tempurl2 . "/header.php"); ?>
        <div id='gauche'>
            <div id="content_g">
                <table width="210"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >
                    <tr>
                        <td >
                            <?php include (  dirname(__FILE__) . $menuurl2 . "/menu_gauche.php"); ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="content_d"> 
                <div id="moteur">
                    <br><br><center> <strong> <h1>Service indisponible</h1>
                    <div>Le serveur Web est actuellement incapable de traiter la requête HTTP en raison d'une surcharge ou d'une maintenance temporaire du serveur.</div>
                </div>
            </div>
        </div>
    </div>

    <?php include ( dirname(__FILE__) . $tempurl2 . "/footer.php"); ?>
    <?php include ( dirname(__FILE__) . $tempurl2 . "/footer_tmp.php"); ?>
</body>
</html>