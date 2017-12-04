

<script language="javascript">



function hideDiv() { 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('rep').style.visibility = 'hidden'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.rep.visibility = 'hidden'; 

        } else { // IE 4 

            document.all.rep.style.visibility = 'hidden'; 

        } 

    } 

}

 



function showDiv() { 


    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('rep').style.visibility = 'visible'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.rep.visibility = 'visible'; 

        } else { // IE 4 

            document.all.rep.style.visibility = 'visible'; 

        } 

    } 

	

			

}





    $(document).ready(function(){

	

        $("#fermer").click(function(){

            $("#rep").hide();

			

			window.location.href=window.location.href

        });

		

    });

</script>

										

<?php	


if(  !isset($_POST['email_tt']) && $_POST["id_view"]!='' ){	 $var_show="style='visibility: visible;' ";	}
else {	$var_show="style='visibility: hidden;' ";	}

if(isset($_POST['email_tt']) ){	$var_show="style='visibility: hidden;' ";	}



$sql_v = " select * from courrier_type where id_courrier ='".$_POST["id_view"]."' ";

$select_v = mysql_query($sql_v);

 $reponse_v = mysql_fetch_array($select_v);



?>

<div id="rep" <?php echo $var_show; ?> ><div id="fils_dossier">

        <div id="fade_dossier"></div>

        <div class="popup_block_dossier" style="width: 560px; z-index: 999; top: 20%; left: 25%;">

            <div class="titleBar_dossier">

                <div class="title_dossier">Détail de courrier type <?php // echo $_POST["id_view"]; ?></div>

                <a href="javascript:hideDiv()" id="fermer"><div class="close_dossier" style="cursor: pointer;">close</div></a>

            </div>

            <div id="content_dossier" class="content_dossier" style="height: auto;">

			

                    <table border="0" cellspacing="0" cellpadding="2" align="center" width="100%">

					

					

                        <tr>

                            <td style=" width: 25%; "><b>Type du candidature:</b></td>

                            <td id="sujet"><p><?php  echo $reponse_v["type_cand"]; ?></p></td>

                        </tr>

                        <tr>

                            <td ><b>Intitulé de courrier:</b></td>

                            <td id="nom"><p><?php  echo $reponse_v["intituler"]; ?></p></td>

                        </tr>

						

                        <tr>

                            <td ><b>Email expéditeur:</b></td>

                            <td id="type_envoi"><p><?php  echo $reponse_v["expediteur"]; ?></p></td>

                        </tr>

                        <tr>

                            <td ><b>Objet:</b></td>

                            <td id="titre"><p><?php  echo $reponse_v["objet"]; ?></p></td>

                        </tr>

                        <tr>

                            <td ><b>Message:</b></td>

                            <td id="message"><p><?php  echo $reponse_v["message"]; ?></p></td>

                        </tr>

						

						

                        <tr>

                            <td colspan="2">

                                <div class="ligneBleu"></div>

                               

                            </td>

                        </tr>

						

                    </table>

				 </div>	

            </div>

        </div>

    </div>

    <!--Fin POPUP-->

