<script>

   

function hideDiv2() { 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire01').style.visibility = 'hidden'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire01.visibility = 'hidden'; 

        } else { // IE 4 

            document.all.repertoire01.style.visibility = 'hidden'; 

        } 

    } 

}

 

function showDiv2(a,b,c,d,e,f) { 



var rel=a + " " + b;

var rel2=c;

var rel3=d;

var rel4=e;

var rel5=f;



    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire01').style.visibility = 'visible'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire01.visibility = 'visible'; 

        } else { // IE 4 

            document.all.repertoire01.style.visibility = 'visible'; 

        } 

    } 

	

			var titre=rel;

            var ht = "<p> "+ titre +" </p>";

            $("#champ_email").append(ht); 

            var id_candidat = '<input type="hidden" value="'+rel2+'" name="id_candidature" />';

            $("#id_candidat").append(id_candidat); 

            date_modification = rel4;

			if (rel5==99 || rel5==100){ perti='vert.png'; }

			if (rel5==66 || rel5==67){ perti='orang.png'; }

			if (rel5==33 || rel5==34){ perti='rouge.png'; }

			if (rel5==0){ perti='noir.png'; } 

			var img_p ='Pertinence : <img src="<?php echo $imgurl ; ?>/icons/'+perti+'">';

            $("#pertinence").append(img_p);

			

			

							$('#row_dim01').hide(); $('#row_dim02').hide(); 

							$('#row_dim11').hide(); $('#row_dim12').hide(); 

							$('#row_dim21').hide(); $('#row_dim22').hide();

							$('#row_dim31').hide(); $('#row_dim32').hide();

                            $('#commentaires').hide();$('#l1_11').hide();

                            $('#l1_12').hide();$('#l1_13').hide(); 





			 

}







	

			$(function() {

			$('#row_dim').hide(); 



							$('#row_dim11').hide();  $('#row_dim12').hide(); 

							$('#row_dim21').hide();  $('#row_dim22').hide(); 

							$('#row_dim31').hide();  $('#row_dim32').hide();

                             $('#commentaires').hide(); $('#l1_11').hide();

                            $('#l1_12').hide();$('#l1_13').hide(); 

                            $('#idTable_email_r').hide();$('#idTable_email_n_r').hide();

                            $('#idTable_email').hide();

                            $('#commentaires').hide(); $('#l1_11').hide();

                            $('#l1_12').hide();$('#l1_13').hide();

			$('#status').change(function(){					



							$('#row_dim11').hide();  $('#row_dim12').hide(); 

							$('#row_dim21').hide();  $('#row_dim22').hide(); 

							$('#row_dim31').hide();  $('#row_dim32').hide();

                             $('#commentaires').hide(); $('#l1_11').hide();

                            $('#l1_12').hide();$('#l1_13').hide(); 

                            $('#idTable_email_r').hide();$('#idTable_email_n_r').hide();

                            $('#idTable_email').hide();

                            $('#commentaires').show(); $('#l1_11').show();

                            $('#l1_12').show();$('#l1_13').show();

							 



						if(  ($('#status').val() == 'c0_2') || ($('#status').val() == 'c0_3') ) {

							$('#row_dim11').show(); $('#row_dim12').show(); 

							$('#row_dim21').show(); $('#row_dim22').show(); 

							$('#row_dim31').show(); $('#row_dim32').show();

                            $('#idTable_email_r').hide();$('#idTable_email_n_r').hide();

                            $('#idTable_email').hide();

                            $('#commentaires').show(); $('#l1_11').show();

                            $('#l1_12').show();$('#l1_13').show();

							

						} 

						/*($('#status').val() == 'c0_1')  || */

						if(($('#status').val() == 'c2_1')) { 

							$('#row_dim11').show(); $('#row_dim12').show();

                            $('#row_dim21').show();		$('#row_dim22').show(); 

							$('#row_dim31').show();  	$('#row_dim32').show(); 

                            $('#idTable_email_r').hide();$('#idTable_email_n_r').hide();

                            $('#idTable_email').hide();

                            $('#commentaires').show(); $('#l1_11').show();

                            $('#l1_12').show();$('#l1_13').show();

						}

                        if(($('#status').val() == 'c2_2')   || ($('#status').val() == 'c2_3') || ($('#status').val() == 'c2_4') || ($('#status').val() == 'c2_5') || ($('#status').val() == 'c2_6')) { 

                            $('#row_dim11').show(); $('#row_dim12').show();

                            $('#row_dim21').show();     $('#row_dim22').show(); 

                            $('#row_dim31').show();     $('#row_dim32').show(); 

                            $('#idTable_email_r').hide();$('#idTable_email_n_r').hide();

                            $('#idTable_email').hide();

                            $('#commentaires').show(); $('#l1_11').show();

                            $('#l1_12').show();$('#l1_13').show();

                        } 

                        if(($('#status').val() == 'c0_4') ) { 

                            

                            $('#row_dim11').hide();  $('#row_dim12').hide(); 

                            $('#row_dim21').hide();  $('#row_dim22').hide(); 

                            $('#row_dim31').hide();  $('#row_dim32').hide();

                            $('#row_dim21').hide();     $('#row_dim22').hide(); 

                            $('#row_dim31').hide();     $('#row_dim32').hide(); 

                            $('#idTable_email_r').hide();$('#idTable_email_n_r').hide();

                            $('#idTable_email').hide();

                            $('#commentaires').show(); $('#l1_11').show();

                            $('#l1_12').show();$('#l1_13').show();

                        }

                        if(($('#status').val() == 'c0_6') ) { 

                            $('#row_dim11').hide();  $('#row_dim12').hide(); 

                            $('#row_dim21').hide();  $('#row_dim22').hide(); 

                            $('#row_dim31').hide();  $('#row_dim32').hide();

                            $('#row_dim21').hide();     $('#row_dim22').hide(); 

                            $('#row_dim31').hide();     $('#row_dim32').hide(); 



                            $('#idTable_email_r').hide();$('#idTable_email_n_r').hide();

                            $('#idTable_email').hide();

                            $('#commentaires').show(); $('#l1_11').show();

                            $('#l1_12').show();$('#l1_13').show();

                        }

		

							

							document.getElementById("evenement").value = "";

							

						 

					});

				});

		

				

    $(document).ready(function(){

		/*

        $('#form_pop_status').submit(function(){

            var variable = $(this).serialize();

            $.ajax({

                type: 'POST',

                url: '../../popup/status_candidature/state.php',

                data:  variable , 

                success: function(msg){

                    if(msg=="vide")

                    {

                        $('#msg').empty();

                        $('#msg').append('<p style=color:#CC0000>Remplissez tous les champs SVP</p>');

                    }

                   else

                    {			

                        if(msg=="ok")

                        {

                            $('#msg').empty();	

                            $('#msg').append('<h3>Commentaire ajouté avec succès</h3>');

                            $("#repertoire01").fadeIn("slow"); 

                        }

                        else

                        {

                            if(msg=="ok")

                            {

                                $('#msg').empty();	

                                $('#msg').append('<h3>Commentaire ajouté avec succès</h3>');

                                $("#repertoire01").fadeIn("slow"); 

                            }

                            else

                            {

                                $('#msg').empty();

                                $('#msg').append('<p style=color:#CC0000>Une erreur est survenu veillez recommencer plus tard</p>');

                                $('#msg').append(msg);

                            }

                        }

                    }				

                }

			

            });

            return false;

        });

			//*/

		

        $("#fermer8").click(function(){  

            location.reload();

        });

		

    });

</script> 

<?php 

 



$dt=date('Y-m-d'); $dh=date('H'); $dm=date('i'); 

 

 

 ?>



 <?php

 

 

$valid_ds=strpos($_SERVER['REQUEST_URI'],'accueil/');

$a_accu=($valid_ds>0)? 'A' : '';

 

 

$valid_ds=strpos($_SERVER['REQUEST_URI'],'compte/');

$a_comp=($valid_ds>0)? 'C' : '';

 

 

$valid_ds=strpos($_SERVER['REQUEST_URI'],'nouvelle_candidature/');

$c_nouvelle=($valid_ds>0)? 'NC' : '';

 

$valid_ds=strpos($_SERVER['REQUEST_URI'],'candidature_en_cours/');

$c_en_cours=($valid_ds>0)? 'CC' : '';

 

$retenu_page_r=strpos($_SERVER['REQUEST_URI'],'candidature_retenu/');

$c_retenu=($retenu_page_r>0)? 'CR' : '';

 

$retenu_page_r=strpos($_SERVER['REQUEST_URI'],'candidature_recruter/');

$c_recruter=($retenu_page_r>0)? 'CRCR' : '';



$retenu_page_f_nr=strpos($_SERVER['REQUEST_URI'],'candidature_non_retenu/');

$c_non_retenu=($retenu_page_f_nr>0)? 'CNR' : '';



$retenu_page_s=strpos($_SERVER['REQUEST_URI'],'candidature_spontannee/');

$c_Spt=($retenu_page_s>0)? 'CSpt' : '';



$retenu_page_s=strpos($_SERVER['REQUEST_URI'],'candidature_stage/');

$c_Stg=($retenu_page_s>0)? 'CStg' : '';





$sql_where="";$Spt_Stg=$etat_s="";

if(($a_accu=="A") or ($a_comp=="C")){$sql_where=" where `etat_1` in (1,2) ";$etat_s="etat_1";} 

if($c_nouvelle=="NC"){$sql_where=" where `etat_2` in (1,2) ";$etat_s="etat_2";}

if($c_en_cours=="CC"){$sql_where=" where `etat_3` in (1,2) ";$etat_s="etat_3";}

if($c_retenu=="CR"){$sql_where=" where `etat_4` in (1,2) ";$etat_s="etat_4";}

if($c_recruter=="CRCR"){$sql_where=" where `etat_5` in (1,2) ";$etat_s="etat_5";}

if($c_non_retenu=="CNR"){$sql_where=" where `etat_6` in (1,2) ";$etat_s="etat_6";}

if($c_Spt=="CSpt"){$sql_where=" where `etat_7` in (1,2) ";$Spt_Stg="CSpt";$etat_s="etat_7";}

if($c_Stg=="CStg"){$sql_where=" where `etat_8` in (1,2) ";$Spt_Stg="CStg";$etat_s="etat_8";}

 



 ?>

<div id="repertoire01"  style="visibility: hidden;"><div id="fils">

        <div id="fade_dossier"></div>

        <div class="popup_block" style="width: 560px; z-index: 999; top: 10%; left: 25%;">

            <div class="titleBar">

                <div class="title">Formulaire d'édition de statut de la candidature</div>

                <a href="javascript:hideDiv2()" id="fermer8"><div class="close" style="cursor: pointer;">close</div></a>

            </div>

			

            <div id="content" class="content" style=" height: 100%;  ">

                <form action="../../popup/status_candidature/state.php" id="form_pop_status" method="post">

                    <table border="0" cellspacing="0" cellpadding="2" align="center">

                        <tr>

                            <td colspan="2">

                                <div id="msg"></div>

                            </td>

                        </tr>

                        <tr>

                            <td width="38%"><b>Nom et prénom du candidat : </b></td>

                            <td><div  id="champ_email" style="  float: left;"></div> <div id="pertinence" style="margin-left: 235px;margin-top: 10px;"></div> </td>

                            

                            <td id="id_candidat"></td>

                        </tr>	 

                        <tr>

                            <td colspan="2">

                                <div class="subscription" style="margin: 10px 0pt;">

                                    <h1>Modifier statut de la candidature</h1>

                                </div>

                            </td>

                        </tr>	



						<tr>

                            <td width="25%"><b>Statut de la candidature</b><font style="color:red;">*</font></td>

                            <td width="75%">

            <select name="status" id="status" style="width: 275px;" title="Statut de la candidature" required>

				<option value="" ></option>

              

                <?php 

				

						$select_opt= "SELECT * FROM `prm_statut_candidature` ".$sql_where."  order by order_statut  DESC  " ;

						/*echo $select_opt;*/

						$select_opt_f = mysql_query($select_opt);

						

						$select_opt_f_num = mysql_num_rows($select_opt_f); 

			  

						if($select_opt_f_num>0){

							while($match =  mysql_fetch_array($select_opt_f) ) {

								

								$var_e= $match[$etat_s];

								

								$var_ref= $match["ref_statut"];

								$var_val= $match["statut"];

								

								$selected=  "";

								

								if($var_e == '2') {$selected= ' disabled style="color:gray" ';}

								if($var_e == '3') {$selected= '  style="display:none" ';}

									 

								 echo "<option value=\"$var_ref\" " . $selected . ">$var_val</option>";												

								 

							}

						}

						



				?>



				

                

            </select>

                            </td>

                        </tr> 

									<tr id="l1_11">

										<td width="25%"><div class="row" id="row_dim11"><br><b>Lieu</b></div></td>

										<td width="75%">

													<div class="row" id="row_dim12"><br><input type="text" name="lieu" id="lieu" style=" width: 185px; " maxlength="50" ></div>

										</td>

									</tr>

									<tr id="l1_12">

                                        <td width="25%"><div class="row" id="row_dim21"><br><b>Date d'envoi</b></div></td>

                                        <td width="75%">

                                        <div class="row" id="row_dim22"><br> 

                                        <input name="dd1sys" id="dd1sys" value="<?php echo date("Y-m-d"); ?>" 

                                              type="date" style=" width: 150px; " disabled>

                                        </div>

                                        </td>

                                    </tr>

                                    <tr id="l1_13">

										<td width="25%"><div class="row" id="row_dim21"><br><b>Date et Heure</b></div></td>

										<td width="75%">

										  <div class="row" id="row_dim22"><br> 

											<input name="dd1" id="dd1" value="<?php echo date("Y-m-d"); ?>" 

                                              type="date" style=" width: 150px; " >

													 

													<?php		$z1='';$z2='';   ?>

										  <input type="number" name="dh1" id="dh1" 

                                          style=" width: 50px; " value="<?php echo $z1.$dh; ?>" 

                                          maxlength="2"  min="0" max="24" title="heure" pattern="0[0-9]|1[0-9]|2[0-3]" required> H 

										  <input type="number" name="dm1" id="dm1" 

                                          style=" width: 50px; " value="<?php echo $z2.$dm; ?>" 

                                          maxlength="2"  min="0" max="60" title="minute" pattern="[0-5][0-9]" required> Min</div> 

										</td>

									</tr>

									 

                        <tr id="commentaires">

                            <td valign="top"><br><b>Commentaire</b></td>

                            <td style="height:100px"><br>

                                <textarea name="commentaire" id="commentaire" title="Commentaire" 

                                style="height: 150px;width: 273px;" required></textarea>

								 

                            </td>		

                        </tr>

						<tr>

<td colspan="2">

 <table id="idTable_email"   >

 <colgroup>

                                    <col style="width: 200px">

                                    <col style="width: 300px"> 

                                    </colgroup>

<tr>

<td colspan="2">

<p>

<?php 

$query = "SELECT * FROM root_email_auto where ref like 'all' ";

$req  =  mysql_query($query);

$return = mysql_fetch_array($req);

?>

<div style="height: 150px;overflow-y: scroll;background-color: #e8f0f0;" disabled>

<?php echo $return['message']; ?>

</div>



</p>

</td></tr>

    </table>

    <table id="idTable_email_r"   >

 <colgroup>

                                    <col style="width: 200px">

                                    <col style="width: 300px"> 

                                    </colgroup>

<tr>

<td colspan="2">

<p>

<?php 

$query = "SELECT * FROM root_email_auto where ref like 'c' ";

$req  =  mysql_query($query);

$return = mysql_fetch_array($req);

?>

<div style="height: 150px;overflow-y: scroll;background-color: #e8f0f0;" disabled>

<?php echo $return['message']; ?>

</div>



</p>

</td></tr>

    </table>

    <table id="idTable_email_n_r"   >

 <colgroup>

                                    <col style="width: 200px">

                                    <col style="width: 300px"> 

                                    </colgroup>

<tr>

<td colspan="2">

<p>

<?php 

$query = "SELECT * FROM root_email_auto where ref like 'zw' ";

$req  =  mysql_query($query);

$return = mysql_fetch_array($req);

?>

<div style="height: 150px;overflow-y: scroll;background-color: #e8f0f0;" disabled>

<?php echo $return['message']; ?>

</div>



</p>

</td></tr>

    </table>

    </td>

    </tr>

                        <tr>

                            <td colspan="2">

                                <div class="ligneBleu"></div>

                                

                            </td>

                        </tr>

						 

                        <tr>

                            <td><br>

                                <input class="espace_candidat" name="envoi" type="submit" value="Valider" style="width:170px" />

                            </td>	

                            <td><br>

                                <input class="espace_candidat" name="" type="reset" style="width:170px"/>

                            </td>

                        </tr>					  

                    </table>

                </form>

				</div>

				

            </div>

        </div>

    </div>

    <!--Fin POPUP-->

	