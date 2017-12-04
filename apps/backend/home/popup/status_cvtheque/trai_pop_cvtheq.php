

<script>

   

function hideDiv2() { 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire').style.visibility = 'hidden'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire.visibility = 'hidden'; 

        } else { // IE 4 

            document.all.repertoire.style.visibility = 'hidden'; 

        } 

    } 

}

 

function showDiv2(a,b,c,d) { 



var rel=a + " " + b;

var rel2=c;

var rel3=d; 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire').style.visibility = 'visible'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire.visibility = 'visible'; 

        } else { // IE 4 

            document.all.repertoire.style.visibility = 'visible'; 

        } 

    } 

	

			var titre=rel;

            var ht = "<p> "+ titre +" </p>";

            $("#champ_email").append(ht); 

            var id_candidat = '<input type="hidden" value="'+rel2+'" name="candidats_id" />';

            $("#id_candidat").append(id_candidat);

             

			

							$('#row_dim01').hide(); $('#row_dim02').hide(); 

							$('#row_dim11').hide(); $('#row_dim12').hide(); 

							$('#row_dim21').hide(); $('#row_dim22').hide();

							$('#row_dim31').hide(); $('#row_dim32').hide(); 

			

							var now     = new Date(); 

							var year    = now.getFullYear();

							var month   = now.getMonth()+1; 

							var day     = now.getDate();

							var hour    = now.getHours();

							var minute  = now.getMinutes();

							document.getElementById("dd1").value = year+'-'+month+'-'+day;

							document.getElementById("dh1").value = hour;

							document.getElementById("dm1").value = minute; 

}







	

			$(function() {

			$('#row_dim').hide(); 

			 

				});

				

				

				

    $(document).ready(function(){

		/*

        $('#form_pop_status').submit(function(){

            var variable = $(this).serialize();

            $.ajax({

                type: 'POST',

                url: '../../popup/status_cvtheque/state_cvtheq.php',

                data:  variable,

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

                            $("#repertoire").fadeIn("slow"); 

                        }

                        else

                        {

                            if(msg=="ok")

                            {

                                $('#msg').empty();	

                                $('#msg').append('<h3>Commentaire ajouté avec succès</h3>');

                                $("#repertoire").fadeIn("slow"); 

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

		

        $("#fermer").click(function(){

             

            location.reload();

        });

		

    });

</script> 

<?php 

$spontanee_page=strpos($_SERVER['REQUEST_URI'],'candidature_spontannee');

$stage_page=strpos($_SERVER['REQUEST_URI'],'candidature_stage');



			

if($spontanee_page>0){$dsbl='candidature_spontanee';}

elseif($stage_page>0){$dsbl='candidature_stage';}

else{$dsbl='';} 

 

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

if(($a_accu=="A") or ($a_comp=="C")){$sql_where=" where`etat_1` in (1,2) ";$etat_s="etat_1";} 

if($c_nouvelle=="NC"){$sql_where=" where `etat_2` in (1,2) ";$etat_s="etat_2";}

if($c_en_cours=="CC"){$sql_where=" where `etat_3` in (1,2) ";$etat_s="etat_3";}

if($c_retenu=="CR"){$sql_where=" where `etat_4` in (1,2) ";$etat_s="etat_4";}

if($c_recruter=="CRCR"){$sql_where=" where `etat_5` in (1,2) ";$etat_s="etat_5";}

if($c_non_retenu=="CNR"){$sql_where=" where `etat_6` in (1,2) ";$etat_s="etat_6";}

if($c_Spt=="CSpt"){$sql_where=" where `etat_7` in (1,2) ";$Spt_Stg="CSpt";$etat_s="etat_7";}

if($c_Stg=="CStg"){$sql_where=" where `etat_8` in (1,2) ";$Spt_Stg="CStg";$etat_s="etat_8";}

 



 ?>



<div id="repertoire"  style="visibility: hidden;"><div id="fils">

        <div id="fade_dossier"></div>

        <div class="popup_block" style="width: 560px; z-index: 999; top: 10%; left: 25%;">

            <div class="titleBar">

                <div class="title">Formulaire d'édition de statut de la candidature</div>

                <a href="javascript:hideDiv2()" id="fermer"><div class="close" style="cursor: pointer;">close</div></a>

            </div>

			

            <div id="content" class="content" style=" height: 100%; ">

                <form action="../../popup/status_cvtheque/state_cvtheq.php" id="form_pop_status" method="post">

				 <input type="hidden" value="<?php echo $dsbl; ?>" name="nom_tab" />

				 

				 <input type="hidden" value="<?php echo $Spt_Stg; ?>" name="Spt_Stg" />

				 

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

            <select name="status" id="status" style="width: 275px;">

                    <option value="" ></option>					

                   	

                <?php 

				

						$select_opt= "SELECT * FROM `prm_statut_candidature` ".$sql_where."  order by order_statut  DESC  " ;

						/**/echo $select_opt;

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

						 

								

								 

                        <tr>

                            <td valign="top"><br><b>Commentaire</b></td>

                            <td style="height:100px"><br>

                                <textarea name="commentaire" id="commentaire" style="height: 150px;width: 273px;"></textarea>

								 

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

	