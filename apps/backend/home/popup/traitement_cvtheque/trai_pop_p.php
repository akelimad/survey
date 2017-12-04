

<script language="javascript">



function hideDiv() { 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire_dossier').style.visibility = 'hidden'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire_dossier.visibility = 'hidden'; 

        } else { // IE 4 

            document.all.repertoire_dossier.style.visibility = 'hidden'; 

        } 

    } 

}

function hideDiv0() { 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire0').style.visibility = 'hidden'; 

        document.getElementById('repertoire_dossier').style.visibility = 'hidden'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire0.visibility = 'hidden'; 

            document.repertoire_dossier.visibility = 'hidden'; 

        } else { // IE 4 

            document.all.repertoire0.style.visibility = 'hidden'; 

            document.all.repertoire_dossier.style.visibility = 'hidden'; 

        } 

    } 

}

 

function showDiv(a,b,c) { 



var rel01=a+ " " +b;

var rel02=c;



    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire_dossier').style.visibility = 'visible'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire_dossier.visibility = 'visible'; 

        } else { // IE 4 

            document.all.repertoire_dossier.style.visibility = 'visible'; 

        } 

    } 

	

	

			var titre=rel01;

            var ht = "<p> "+ titre +" </p>";

            $("#champ_email1").append(ht);

 



            var id_candidat1 = '<input type="hidden" value="'+rel02+'" name="id_candidature" />';



            $("#id_candidat1").append(id_candidat1);

			

}





    $(document).ready(function(){

	 

		

		

        $("#fermer1").click(function(){ 

			document.getElementById('repertoire_dossier').style.visibility = 'hidden'; 

            location.reload();

        });

		 

    });

</script>

 <?php 

 

 $dsbl='';

 

$cvtheque_page=strpos($_SERVER['REQUEST_URI'],'candidats/cvtheque/');

  

if($cvtheque_page>0){$dsbl='../candidatures/';} 

 

 ?>

<div id="repertoire_dossier"  style="visibility: hidden;" ><div id="fils_dossier">

        <div id="fade_dossier"></div>

        <div class="popup_block_dossier" style="width: 560px; z-index: 999; top: 10%; left: 25%;">

            <div class="titleBar_dossier">

                <div class="title_dossier">Formulaire d'affectation à l'offre </div>

                <a href="javascript:hideDiv()" id="fermer1"><div class="close_dossier" style="cursor: pointer;">close</div></a>

            </div>

            <div id="content_dossier" class="content_dossier" style="height: 180px;">

                <form action="../<?php echo $dsbl; ?>postuler/" id="form_pop_dossier" method="post">

                    <table border="0" cellspacing="0" cellpadding="2" align="center">

                        <tr>

                            <td colspan="2">

                                <div id="msg1"></div>

                            </td>

                        </tr>

                        <tr>

                            <td width="38%"><b>Prénom et nom du candidat : </b></td>

                            <td id="champ_email1"></td>

                            <td id="id_candidat1"></td>

                        </tr>

                        <tr>

                            <td colspan="2">

                                <div class="subscription" style="margin: 10px 0pt;">

                                    <h1>Affectation à l'offre  </h1>

                                </div>

                            </td>

                        </tr>		                     

                        

                        <tr>

                            <td width="35%"><b>Nom de l'offre  </b></td>

                            <td width="75%">

                                <select name="offre" required>

									 <option value=""></option>

								  <?php	

    $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;

    $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;        



    $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;

    $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ;     

                                  $req_ci = mysql_query( "SELECT * FROM offre 

                                    ". $q_ref_fili ."");				

								  while ( $ci = mysql_fetch_array( $req_ci ) ) {					

								  $ds_id = $ci['id_offre'];					

								  $ds_nom = $ci['Name']; 	

								  $ds_exp = $ci['date_expiration'];					

								  

									  echo '<option value="'.$ds_id.'">'.$ds_nom.' | Expire le : '.$ds_exp.'</option>';	

								  }		

								  ?>

								  </select>

                            </td>

                        </tr>

                        <tr>

                            <td colspan="2">

                                <div class="ligneBleu"></div>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <input class="espace_candidat" name="envoi" type="submit" value="Valider" style="width:170px" />

                            </td>	

                            <td>

                                <input class="espace_candidat" name="" type="reset" style="width:170px"/>

                            </td>

                        </tr>					  

                    </table>

                </form>

            </div>

        </div>

    </div>

    <!--Fin POPUP-->

