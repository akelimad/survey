

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

 

function showDiv2(a,b,c,d,e,f,n11,n12,n13,n14,n15,n21,n22,n23,n24,n25,n26) { 



var rel=a + " " + b;

var rel2=c;

var rel3=d;

var rel4=e;

var rel5=f;



document.getElementById("nt_ecole").value = n11;

document.getElementById("nt_filiere").value = n12;

document.getElementById("nt_diplome").value = n13;

document.getElementById("nt_experience").value = n14;

document.getElementById("nt_stage").value = n15;



document.getElementById("nt_q_tech").value = n21;

document.getElementById("nt_communic").value = n22;

document.getElementById("nt_comport").value = n23;

document.getElementById("total1").value = n24;

document.getElementById("total2").value = n25;

document.getElementById("totalfinal").value = parseFloat(n26).toFixed(2);



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



            

			if (rel5==99 || rel5==100){ perti='#00B300'; }

			if (rel5==66 || rel5==67){ perti='#CC5500'; }

			if (rel5==33 || rel5==34){ perti='#D50000'; }

			if (rel5==0){ perti='#D50000 '; } 

			var img_p ='<div style="width: 15px; height: 15px; background: '+perti+';-moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;"></div><br/><span id="tableau" >';

            $("#pertinence").append(img_p);

			

			

							$('#row_dim01').hide(); $('#row_dim02').hide(); 

							$('#row_dim11').hide(); $('#row_dim12').hide(); 

							$('#row_dim21').hide(); $('#row_dim22').hide();

							$('#row_dim31').hide(); $('#row_dim32').hide(); 

			 

}







	

			$(function() {

			$('#row_dim').hide(); 

			

							document.getElementById("idTable").style.display = "none";

							document.getElementById("idTable_c").style.display = "none";

                            document.getElementById("idTable_c2").style.display = "none";

                            document.getElementById("idTable2").style.display = "none";  

							document.getElementById("idTable_r").style.display = "none";

							document.getElementById("idTable_tel").style.display = "none";

							document.getElementById("idTable_ent").style.display = "none";

                            document.getElementById("idTable_email").style.display = "none";

                            document.getElementById("idTable_email_r").style.display = "none";

                            document.getElementById("idTable_email_n_r").style.display = "none";

							

			$('#status').change(function(){		 

							 

							$('#row_dim11').show();

							document.getElementById("idTable_tel").style.display = "block";

							document.getElementById("idTable_ent").style.display = "none";

							document.getElementById("idTable_r").style.display = "block" ;

							document.getElementById("idTable").style.display = "none";

							document.getElementById("idTable_c").style.display = "none";

                            document.getElementById("idTable_c2").style.display = "none";

                            document.getElementById("idTable2").style.display = "none";

                            document.getElementById("idTable_email").style.display = "none";

                            document.getElementById("idTable_email_r").style.display = "none";

                            document.getElementById("idTable_email_n_r").style.display = "none";   

							 



						if(  ($('#status').val() == 'c1_1')   ) {

							$('#row_dim11').show(); 

							document.getElementById("idTable").style.display = "block" ;

							document.getElementById("idTable_c").style.display = "block";

                            document.getElementById("idTable_c2").style.display = "block";

                            document.getElementById("idTable2").style.display = "block"; 

							document.getElementById("idTable_r").style.display = "none";

							document.getElementById("idTable_tel").style.display = "none";

							document.getElementById("idTable_ent").style.display = "none";

                            document.getElementById("idTable_email").style.display = "none";

                            document.getElementById("idTable_email_r").style.display = "none";

                            document.getElementById("idTable_email_n_r").style.display = "none";

							

						} 



						if(  ($('#status').val() == 'c0_1')   || ($('#status').val() == 'c2_1')  ) {

							$('#row_dim11').show();

							document.getElementById("idTable_tel").style.display = "block";

							document.getElementById("idTable_ent").style.display = "none";

							document.getElementById("idTable_r").style.display = "block" ;

							document.getElementById("idTable").style.display = "none";

							document.getElementById("idTable_c").style.display = "none";

                            document.getElementById("idTable_c2").style.display = "none";

                            document.getElementById("idTable2").style.display = "none";

                            document.getElementById("idTable_email").style.display = "none";

                            document.getElementById("idTable_email_r").style.display = "none";

                            document.getElementById("idTable_email_n_r").style.display = "none";   

							

						} 



						if(  ($('#status').val() == 'c0_2')  || ($('#status').val() == 'c0_3')   ) {

							$('#row_dim11').show();

							document.getElementById("idTable_tel").style.display = "block";

							document.getElementById("idTable_ent").style.display = "block";

							document.getElementById("idTable_r").style.display = "block" ;

							document.getElementById("idTable").style.display = "none";

							document.getElementById("idTable_c").style.display = "none";

                            document.getElementById("idTable_c2").style.display = "none";

                            document.getElementById("idTable2").style.display = "none";

                            document.getElementById("idTable_email").style.display = "none";

                            document.getElementById("idTable_email_r").style.display = "none";

                            document.getElementById("idTable_email_n_r").style.display = "none";   

							

						}

						

                        if(  ($('#status').val() == 'c2_2')  || ($('#status').val() == 'c2_3')  || ($('#status').val() == 'c2_4') || ($('#status').val() == 'c2_5')  || ($('#status').val() == 'c2_6')   ) {

                            $('#row_dim11').show();

                            document.getElementById("idTable_tel").style.display = "block";

                            document.getElementById("idTable_ent").style.display = "block";

                            document.getElementById("idTable_r").style.display = "block" ;

                            document.getElementById("idTable").style.display = "none";

                            document.getElementById("idTable_c").style.display = "none";

                            document.getElementById("idTable_c2").style.display = "none";

                            document.getElementById("idTable2").style.display = "none";  

                            document.getElementById("idTable_email").style.display = "none";

                            document.getElementById("idTable_email_r").style.display = "none";

                            document.getElementById("idTable_email_n_r").style.display = "none"; 

                            

                        } 

					







	



						if(   ($('#status').val() == 'c0_4') || ($('#status').val() == 'c0_5')   || ($('#status').val() == 'c0_6')  ) {

							$('#row_dim11').show();

							document.getElementById("idTable_r").style.display = "block" ;

							document.getElementById("idTable_tel").style.display = "none";

							document.getElementById("idTable_ent").style.display = "none";

							document.getElementById("idTable").style.display = "none";

							document.getElementById("idTable_c").style.display = "none";

                            document.getElementById("idTable_c2").style.display = "none";

                            document.getElementById("idTable2").style.display = "none";  

                            document.getElementById("idTable_email").style.display = "none";

                            document.getElementById("idTable_email_r").style.display = "none";

                            document.getElementById("idTable_email_n_r").style.display = "none";  

							

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

                url: '../popup/status_accueil/state_c_note.php',

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

		

        $("#fermer").click(function(){  

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





$sql_where="";$Spt_Stg="";

if(($a_accu=="A") or ($a_comp=="C")){$sql_where=" where `etat_1` in (1,2)   ";} 

if($c_nouvelle=="NC"){$sql_where=" where `etat_2` in (1,2) ";}

if($c_en_cours=="CC"){$sql_where=" where `etat_3` in (1,2) ";}

if($c_retenu=="CR"){$sql_where=" where `etat_4` in (1,2)  ";}

if($c_recruter=="CRCR"){$sql_where=" where `etat_5` in (1,2) ";}

if($c_non_retenu=="CNR"){$sql_where=" where `etat_6` in (1,2) ";}

if($c_Spt=="CSpt"){$sql_where=" where `etat_7` in (1,2) ";$Spt_Stg="CSpt";}

if($c_Stg=="CStg"){$sql_where=" where `etat_8` in (1,2) ";$Spt_Stg="CStg";}

 



 ?>

<div id="repertoire01"  style="visibility: hidden;"><div id="fils">

        <div id="fade_dossier"></div>

        <div class="popup_block" style="width: 560px; z-index: 999; top: 5%; left: 25%;">

            <div class="titleBar">

                <div class="title">Formulaire d'édition de statut de la candidature</div>

                <a href="javascript:hideDiv2()" id="fermer"><div class="close" style="cursor: pointer;">close</div></a>

            </div>

			

            <div id="content" class="content" style=" height: 100%; ">

                <form action="../popup/status_accueil/state_c_note.php" id="form_pop_status" method="post">

				

				

				

				

				

				

				

				

                    <table border="0" cellspacing="0" cellpadding="2" align="center">

                        <tr>

                            <td colspan="2">

                                <div id="msg"></div>

                            </td>

                        </tr>

                        <tr>

                            <td width="38%"><b>Nom et prénom du candidat : </b> </td>

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

								

								$var_e= $match["etat_1"];

								

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

                            <td colspan="2">	 

								<br> <style type="text/css">

								.tg  {border-collapse:collapse;border-spacing:0;  border-color: #a9a9a9;}

								.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;   border-color: #a9a9a9;}

								.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;  border-color: #a9a9a9;}

								.tg .tg-s6z2{text-align:center}

								</style>

								 

			                     <div id="idTable2" class="subscription" style="margin: 10px 0pt;">

                                    <h1>Critére de notation</h1>

                                </div>

								<table id="idTable" >

									<colgroup>

									<col style="width: 187px">

									<col style="width: 253px">

									<col style="width: 71px">

									</colgroup>

                                    

									  <tr>

                                        <th colspan="2" 

                                        style="  background: #CFD4D8;border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <center><b>CRITERES</b></center></th>

                                        <th style="  background: #CFD4D8;border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <center><b>NIVEAUX</b></center></th>

                                      </tr>

									  <tr>

										<td rowspan="3" style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <b>FORMATION</b></td>

										<td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <span style="font-size:12px">Ecole</span></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                                    <select name="nt_ecole" id="nt_ecole" style="width: 100%;" onblur="calcul()"> 

                                                        <option value="0" >0</option> 

                                                        <option value="10" >10</option> 

                                                        <option value="15" >15</option> 

                                                        <option value="25" >25</option>   

                                                    </select>  

										</td>

										

									  </tr>

									  <tr>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <span style="font-size:12px">Filière</span></td> 

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                                    <select name="nt_filiere" id="nt_filiere" style="width: 100%;" onblur="calcul()"> 

                                                        <option value="0" >0</option> 

                                                        <option value="5" >5</option> 

                                                        <option value="15" >15</option> 

                                                        <option value="25" >25</option> 

                                                    </select> </td>

									  </tr>

									  <tr>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <span style="font-size:12px">Année d’obtention du diplôme</span></td> 

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                                   <select name="nt_diplome" id="nt_diplome" style="width: 100%;" onblur="calcul()"> 

                                                        <option value="1" >1</option> 

                                                        <option value="3" >3</option> 

                                                        <option value="5" >5</option> 

                                                    </select> </td>

										</td>

									  </tr>

									  <tr>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <b>EXPERIENCE CONFIRMEE</b></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <span style="font-size:12px"> Expérience probante </span></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                                <select name="nt_experience" id="nt_experience" style="width: 100%;" onblur="calcul()"> 

												<?php

												for ($i = 0; $i <= 40; $i++) {

													echo '<option value="'.$i.'" >'.$i.'</option>';

												}

												?>              

                                             </select>                              

                                        </td>

									  </tr>

									  <tr>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <b>STAGES</b></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <span style="font-size:12px">Stages probants </span></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <select name="nt_stage" id="nt_stage" style="width: 100%;" onblur="calcul()"> 

                                                        <option value="0" >0</option> 

                                                        <option value="5" >5</option> 

                                             </select>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td >

                                        </td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;background: #CFD4D8;">

                                        <b >TOTAL N° 1</b></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;background: #CFD4D8;">

                                        <input type="text" SIZE="33" name="total1" id="total1" onblur="calcul()"

                                        style="width: 64px;background: #CFD4D8;text-align: right;" maxlength="2" value="0"  readonly="readonly">

                                        </td>

                                        </tr>

									</table> 

                                 

                                     <div  id="idTable_c2" class="subscription" style="margin: 10px 0pt;">

                                    <h1>Notation de commission</h1>

                                </div>

								<table id="idTable_c" >

                                <!--

                                -->

                                    <colgroup>

                                    <col style="width: 187px">

                                    <col style="width: 253px">

                                    <col style="width: 71px">

                                    </colgroup>

                                    

                                      </tr>

                                      <tr>

                                        <th colspan="2" style="  background: #CFD4D8;border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <center ><b>APTITUDES</b></center></th>

                                        <th style="  background: #CFD4D8;border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <center ><b>NOTES</b></center></th>

                                      </tr>

                                      <tr>

                                       



                                        <td colspan="2" style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <span style="font-size:12px"><b>Qualifications techniques</b></span></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <!--<input  name="nt_q_tech" id="nt_q_tech" style="width: 100%;" maxlength="2" value="0" type="number" ></td>-->

                                        <select name="nt_q_tech" id="nt_q_tech" style="width: 100%;" onblur="calcul()"> 

                                                <?php

                                                for ($i = 0; $i <= 60; $i++) {

                                                    echo '<option value="'.$i.'" >'.$i.'</option>';

                                                }

                                                ?>              

                                             </select>  

                                      </tr>

                                      <tr>

                                        <td colspan="2" style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <span style="font-size:12px"><b>Communication </b></span></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <!--<input  name="nt_communic" id="nt_communic" style="width: 100%;" maxlength="2" value="0" type="number" >-->

                                        <select name="nt_communic" id="nt_communic" style="width: 100%;" onblur="calcul()"> 

                                                <?php

                                                for ($i = 0; $i <= 20; $i++) {

                                                    echo '<option value="'.$i.'" >'.$i.'</option>';

                                                }

                                                ?>              

                                             </select>  

                                        </td>

                                      </tr>

                                      <tr>

                                        <td colspan="2" style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <span style="font-size:12px"><b>Comportement</b></span></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;">

                                        <!--<input  name="nt_comport" id="nt_comport" style="width: 100%;" maxlength="2" value="0" type="number" >-->

                                        <select name="nt_comport" id="nt_comport" style="width: 100%;" onblur="calcul()"> 

                                                <?php

                                                for ($i = 0; $i <= 20; $i++) {

                                                    echo '<option value="'.$i.'" >'.$i.'</option>';

                                                }

                                                ?>              

                                             </select> 

                                        </td>

                                      </tr>

                                      <tr>

                                        <td >

                                        </td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;background: #CFD4D8;">

                                        <b >TOTAL N° 2</b></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;background: #CFD4D8;">

                                        <input type="text" SIZE="33" name="total2" id="total2" style="width: 64px;background: #CFD4D8;text-align: right;" 

                                        maxlength="2" value="0"  readonly="readonly" onblur="calcul()">

                                        </td>

                                        </tr>

                                    <tr>

                                        <td >

                                        </td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;background: #CFD4D8;">

                                        <b >TOTAL FINAL</b> %</td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;background: #CFD4D8;">

                                        <input type="text" SIZE="33" name="totalfinal" id="totalfinal" style="width: 64px;background: #CFD4D8;text-align: right;" maxlength="2" value="0"  readonly="readonly">

                                        </td>

                                        </tr>   

                                    </table> 

							 

                            </td>

                        </tr>	









<script type="text/javascript">

function calcul(){

                var nt_ecole = Number(document.getElementById("nt_ecole").value);

                var nt_diplome = Number(document.getElementById("nt_diplome").value);

                var nt_experience = Number(document.getElementById("nt_experience").value);

                var nt_stage = Number(document.getElementById("nt_stage").value);

                var nt_filiere = Number(document.getElementById("nt_filiere").value);

 

                var total1 = (nt_ecole + nt_diplome + nt_experience + nt_stage + nt_filiere );

                document.getElementById("total1").value = total1;



                var nt_q_tech = Number(document.getElementById("nt_q_tech").value);

                var nt_communic = Number(document.getElementById("nt_communic").value);

                var nt_comport = Number(document.getElementById("nt_comport").value);

                var nt_q_tech2 = Number(nt_q_tech * 0.5 );

                var nt_communic2 = Number(nt_communic * 0.3 );

                var nt_comport2 = Number(nt_comport * 0.2 );



                var total2 = Number( nt_q_tech2 + nt_communic2 + nt_comport2  );

                document.getElementById("total2").value = parseFloat(total2).toFixed(2);



                var total1 = Number(document.getElementById("total1").value);

                var total2 = Number(document.getElementById("total2").value);

                var totalfinal1 = Number( total1  * 0.4 );



                var totalfinal2 = Number( (  total2   * 2.5 ) * 0.6 );

                var totalfinal223 =  Number( totalfinal2  );



                var totalfinal = Number( totalfinal1 + totalfinal223 );

                var totalfinalf = Number( totalfinal );

                document.getElementById("totalfinal").value = parseFloat(totalfinalf).toFixed(2);

            }

</script>

						



						

						

						

						<!--

						-->

						

						

						

						

						

						

						

					    <tr>

                            <td colspan="2">	

								

								 

								<table id="idTable_tel"   > 

									 <colgroup>

                                    <col style="width: 200px">

									<col style="width: 300px"> 

									</colgroup>

									<tr>

                                        <td valign="top"><b>Date d'envoi</b></td>

                                        <td >

                                        <input name="dd1sys" id="dd1" value="<?php echo date("Y-m-d"); ?>" 

                                              type="date" style=" width: 150px; " disabled>

                                        </td>

                                    </tr>			 

									<tr>

										<td valign="top"><b>Date et Heure</b></td>

										<td  > 

													<input name="dd1" id="dd1" value="<?php echo date("Y-m-d"); ?>" 

                                                    type="date" 

                                                     style=" width: 150px; " >

													 

													<?php		$z1='';$z2='';   ?>

													<input type="text" name="dh1" id="dh1" style=" width: 30px; " value="<?php echo $z1.$dh; ?>" maxlength="2"  pattern="0[0-9]|1[0-9]|2[0-3]"> H 

													<input type="text" name="dm1" id="dm1" style=" width: 30px; " value="<?php echo $z2.$dm; ?>" maxlength="2"  pattern="[0-5][0-9]"> Min 

											 

										</td>		

									</tr>

									

								 </table> 

					

                            </td>

                        </tr>	

						

						

						

						

						

						

						

						<!--

						-->

						

						

						

						

						<!--

						-->

						

						

						

						

						

						

						

					    <tr>

                            <td colspan="2">	

								

								 

								<table id="idTable_ent"   > 

									 <colgroup>

									<col style="width: 200px">

									<col style="width: 300px"> 

									</colgroup>

												 

									<tr>

										<td valign="top"><b>Lieu</b></td>

										<td > <input type="text" name="lieu" id="lieu" style=" width: 185px; " maxlength="50" >  

										</td>		

									</tr>

									

								 </table> 

					

                            </td>

                        </tr>	

						

						

						

						

						

						

						

						<!--

						-->

						

						

						

						

						<!--

						-->

						

						

						

						

						

						

						

					    <tr>

                            <td colspan="2">	

							

								 

								<table id="idTable_r"   > 

									 <colgroup>

									<col style="width: 200px">

									<col style="width: 300px"> 

									</colgroup>

												 

									<tr>

										<td valign="top"><b>Commentaire</b></td>

										<td >

											<textarea name="commentaire" id="commentaire" style="height: 150px;width: 273px;"></textarea>

											 

										</td>		

									</tr>

									

								 </table> 

					

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

<div style="height: 200px;overflow-y: scroll;background-color: #e8f0f0;" disabled>

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

<div style="height: 200px;overflow-y: scroll;background-color: #e8f0f0;" disabled>

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

<div style="height: 200px;overflow-y: scroll;background-color: #e8f0f0;" disabled>

<?php echo $return['message']; ?>

</div>



</p>

</td></tr>

    </table>

    </td>

    </tr>					

						

						

						

						

						

						<!--

						-->

						

						

						

						

                        <tr>

                            <td colspan="2">

                                <div class="ligneBleu"></div>

                                

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

    </div>

    <!--Fin POPUP-->

	