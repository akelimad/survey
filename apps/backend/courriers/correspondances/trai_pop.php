

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

	

			

   $("#fermer12").click(function(){


            document.getElementById('rep').style.visibility = 'hidden'; 
            location.reload();

            

        });
}








</script>

										

<?php	


if(  !isset($_POST['email_tt']) && isset($_POST['id_view']) && $_POST["id_view"]!='' ){	 $var_show="style='visibility: visible;' ";	}
else {	$var_show="style='visibility: hidden;' ";	}

if(isset($_POST['email_tt']) ){	$var_show="style='visibility: hidden;' ";	}



$id__view=(isset($_POST['id_view'])) ?  $_POST['id_view']  : "";

$sql_v = " select * from corespondances where id ='".$id__view."' ";

$select_v = mysql_query($sql_v);

 $reponse_v = mysql_fetch_array($select_v);



?>



<div id="rep" <?php echo $var_show; ?>  ><div id="fils_dossier">

        <div id="fade_dossier"></div>

        <div class="popup_block_dossier" style="width: 560px; z-index: 999; top: 20%; left: 25%;">

            <div class="titleBar_dossier">

                <div class="title_dossier">Détail de la correspondance </div>

                <a href="javascript:hideDiv()" id="fermer12"><div class="close_dossier" style="cursor: pointer;">close</div></a>

            </div>

            <div id="content_dossier" class="content_dossier" style="height: 440px;">

			

                    <table border="0" cellspacing="0" cellpadding="2" align="center" width="100%">

					

                        <tr>

                            <td width="30%"><b>Ref : </b></td>

                            <td width="70%" id="ref"><p><?php  echo $reponse_v["id"]; ?></p></td>

                        </tr>

                        <tr>

                            <td ><b>Sujet : </b></td>

                            <td id="sujet"><p><?php  echo $reponse_v["sujet"]; ?></p></td>

                        </tr>

                        <tr>

                            <td ><b>Nom : </b></td>

                            <td id="nom"><p><?php  echo $reponse_v["nom"]; ?></p></td>

                        </tr>

                        <tr>

                            <td ><b>Date d’envoi : </b></td>

                            <td id="date_envoi"><p><?php  echo $reponse_v["date_envoi"]; ?></p></td>

                        </tr>

                        <tr>

                            <td ><b>Type d’envoi : </b></td>

                            <td id="type_envoi"><p><?php  echo $reponse_v["type_email"]; ?></p></td>

                        </tr>

                        

                        <tr>

                            <td ><b>Message envoyé : </b></td>

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

