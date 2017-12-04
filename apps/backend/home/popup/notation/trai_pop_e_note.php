<script>

   

function hideDiv2_note() { 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire01_note').style.visibility = 'hidden'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire01_note.visibility = 'hidden'; 

        } else { // IE 4 

            document.all.repertoire01_note.style.visibility = 'hidden'; 

        } 

    } 

}

 

function showDiv2_note(a,b,c,d,e,f,n11,n12,n13,n14,n15,n16) { 



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

document.getElementById("total1").value = n16;





    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire01_note').style.visibility = 'visible'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire01_note.visibility = 'visible'; 

        } else { // IE 4 

            document.all.repertoire01_note.style.visibility = 'visible'; 

        } 

    } 

	

			var titre=rel;

            var ht = "<p> "+ titre +" </p>";

            $("#champ_email_note").append(ht); 

            var id_candidat_note = '<input type="hidden" value="'+rel2+'" name="id_candidature" />';

            $("#id_candidat_note").append(id_candidat_note); 

            date_modification = rel4;

			if (rel5==99 || rel5==100){ perti='vert.png'; }

			if (rel5==66 || rel5==67){ perti='orang.png'; }

			if (rel5==33 || rel5==34){ perti='rouge.png'; }

			if (rel5==0){ perti='noir.png'; } 

			var img_p ='<a href="../../popup/notation/fiche_technique_note/?id_cnddtr='+rel2+'"><b style="color:green;">Voir la fiche technique</b></a>';

            $("#pertinence_note").append(img_p);

			var ntt_total =nt_totales;

            $("#nt_total").append(ntt_total);

			

						

							document.getElementById("idTable_note").style.display = "block" ;

			 

}





 

			$(function() {

			$('#row_dim').hide(); 

			

							document.getElementById("idTable_note").style.display = "block";

						  

				});

		 

				

				

    $(document).ready(function(){

        $('#form_pop_note').submit(function(){

            var variable = $(this).serialize();

            $.ajax({

                type: 'POST',

                url: '../../popup/notation/state_note.php',

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

                            $("#repertoire01_note").fadeIn("slow"); 

                        }

                        else

                        {

                            if(msg=="ok")

                            {

                                $('#msg').empty();	

                                $('#msg').append('<h3>Commentaire ajouté avec succès</h3>');

                                $("#repertoire01_note").fadeIn("slow"); 

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

				//*/

            });

            return false;

        });

		

		

        $("#fermer").click(function(){  

            location.reload();

        });

		

    });

</script> 





<div id="repertoire01_note"  style="visibility: hidden;"><div id="fils">

        <div id="fade_dossier"></div>

        <div class="popup_block" style="width: 560px; z-index: 999; top: 10%; left: 25%;">

            <div class="titleBar">

                <div class="title">Formulaire d'édition de statut de la candidature</div>

                <a href="javascript:hideDiv2_note()" id="fermer"><div class="close" style="cursor: pointer;">close</div></a>

            </div>

			

            <div id="content" class="content" style=" height: 100%; ">

                <form action="" id="form_pop_note" method="post">

				

				

				

				

				

				

				

				

                    <table border="0" cellspacing="0" cellpadding="2" align="center">

                        <tr>

                            <td colspan="2">

                                <div id="msg"></div>

                            </td>

                        </tr>

                        <tr>

                            <td width="38%"><b>Nom et prénom du candidat : </b> </td>

                            <td><div  id="champ_email_note" style="  float: left;"></div> 

                            <div id="pertinence_note" style="margin-left: 180px;margin-top: 10px;"></div> </td>

                            

                            <td id="id_candidat_note"></td>

                        </tr>	 

                        <tr>

                            <td colspan="2">

                                <div class="subscription" style="margin: 10px 0pt;">

                                    <h1>CRITERE DE NOTATION</h1>

                                </div>

                            </td>

                        </tr>	 

						

						

					    <tr>

                            <td colspan="2">	 

								<style type="text/css">

								.tg  {border-collapse:collapse;border-spacing:0;  border-color: #a9a9a9;}

								.tg td{font-family:Arial, sans-serif;font-size:12px;padding:2px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;   border-color: #a9a9a9;}

								.tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:2px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;  border-color: #a9a9a9;}

								.tg .tg-s6z2{text-align:center}

								</style>

								<table id="idTable_note"  class="tg"  style="undefined;table-layout: fixed; ">

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

                                        <td rowspan="3"><b>Formation</b></td>

                                        <td><span >Ecole</span></td>

                                        <td> 

                                                    <select name="nt_ecole" id="nt_ecole" style="width: 50px;" onblur="calcul()"> 

                                                        <option value="0" >0</option> 

                                                        <option value="10" >10</option> 

                                                        <option value="15" >15</option> 

                                                        <option value="25" >25</option>   

                                                    </select>  

                                        </td>

                                        

                                      </tr>

                                      <tr>

                                        <td><span >Filière</span></td> 

                                                   <td> <select name="nt_filiere" id="nt_filiere" style="width: 50px;" onblur="calcul()"> 

                                                        <option value="0" >0</option> 

                                                        <option value="5" >5</option> 

                                                        <option value="15" >15</option> 

                                                        <option value="25" >25</option> 

                                                    </select> </td>

                                        </td>

                                      </tr>

                                      <tr>

                                        <td><span >Année d’obtention du diplôme</span></td> 

                                                  <td>  <select name="nt_diplome" id="nt_diplome" style="width: 50px;" onblur="calcul()"> 

                                                        <option value="1" >1</option> 

                                                        <option value="3" >3</option> 

                                                        <option value="5" >5</option> 

                                                    </select> </td>

                                        </td>

                                      </tr>

                                      <tr>

                                        <td><b> Expérience confirmée</b></td>

                                        <td><span > Expérience probante </span></td>

                                        <td>

                                            <select name="nt_experience" id="nt_experience" style="width: 50px;" onblur="calcul()"> 

												<?php

												for ($i = 0; $i <= 40; $i++) {

													echo '<option value="'.$i.'" >'.$i.'</option>';

												}

												?>      

                                             </select>

                                        </td>

                                      </tr>

                                      <tr>

                                        <td><b>Stages</b></td>

                                        <td><span >Stages probants </span></td>

                                        <td>

                                            <select name="nt_stage" id="nt_stage" style="width: 50px;" onblur="calcul()"> 

                                                        <option value="0" >0</option> 

                                                        <option value="5" >5</option> 

                                             </select>

                                        </td>

                                      </tr>

                                        <tr>

                                        <td style="  border-style: none;">

                                        </td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;background: #CFD4D8;">

                                        <b >TOTAL N° 1</b></td>

                                        <td style="border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #a9a9a9;background: #CFD4D8;">

                                        <input type="text" SIZE="33" name="total1" id="total1" onblur="calcul()"

                                        style="width: 100%;background: #CFD4D8;" maxlength="2" value="0"  readonly="readonly">

                                        </td>

                                        </tr> 

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

                                <input class="espace_candidat" name="envoi_note" type="submit" value="Valider" style="width:170px" />

                            </td>	

                            <td><br>

                                <input class="espace_candidat" name="" type="reset" style="width:170px"/>

                            </td>

                        </tr>					  

                    </table>

					

				<script type="text/javascript">

function calcul(){

                var nt_ecole = Number(document.getElementById("nt_ecole").value);

                var nt_diplome = Number(document.getElementById("nt_diplome").value);

                var nt_experience = Number(document.getElementById("nt_experience").value);

                var nt_stage = Number(document.getElementById("nt_stage").value);

                var nt_filiere = Number(document.getElementById("nt_filiere").value);

 

                var total1 = (nt_ecole + nt_diplome + nt_experience + nt_stage + nt_filiere );

                document.getElementById("total1").value = total1;



            }

</script>	 

					

                </form>

				</div>

				

            </div>

        </div>

    </div>

    <!--Fin POPUP-->

	