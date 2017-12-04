

<script language="javascript">



function hideDiv_dir() { 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire_dossier_dir').style.visibility = 'hidden'; 

		location.reload();

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire_dossier_dir.visibility = 'hidden'; 

			location.reload();

        } else { // IE 4 

            document.all.repertoire_dossier_dir.style.visibility = 'hidden'; 

			location.reload();

        } 

    } 

}

function hideDiv0() { 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire0').style.visibility = 'hidden'; 

        document.getElementById('repertoire_dossier_dir').style.visibility = 'hidden'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire0.visibility = 'hidden'; 

            document.repertoire_dossier_dir.visibility = 'hidden'; 

        } else { // IE 4 

            document.all.repertoire0.style.visibility = 'hidden'; 

            document.all.repertoire_dossier_dir.style.visibility = 'hidden'; 

        } 

    } 

}

 

function showDivd(a,b,c) { 



var rel01=a+ " " +b;

var rel02=c;



    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('repertoire_dossier_dir').style.visibility = 'visible'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.repertoire_dossier_dir.visibility = 'visible'; 

        } else { // IE 4 

            document.all.repertoire_dossier_dir.style.visibility = 'visible'; 

        } 

    } 

	

	

			var titre=rel01;

            var ht = "<p> "+ titre +" </p>";

            $("#champ_email1_dir").append(ht);



			



            var id_candidat1 = '<input type="hidden" value="'+rel02+'" name="id_candidature" />';



            $("#id_candidat1_dir").append(id_candidat1);

/*	

 console.log(a);

 console.log(b);

 console.log(c);





 console.log(ht);

 console.log(id_candidat1); 

 */

}





    $(document).ready(function(){

		

        $('#form_pop_dossier_dir').submit(function(){

            var variable = $(this).serialize();

            $.ajax({

                type: 'POST',

                url: 'dossier_suit.php',

                data:  variable,

                success: function(msg1){

                    if(msg1=="vide")

                    {

                        $('#msg1').empty();

                        $('#msg1').append('<p style=color:#CC0000>Choisissez un dossier SVP</p>');

                    }

                    else

                    {			

                        if(msg1=="ok")

                        {

                            $('#msg1').empty();	

                            $('#msg1').append('<h3>Affectation au dossier avec succès</h3>');

                            $("#repertoire_dossier_dir").fadeIn("slow");

							

                        }

                        else

                        {

                            if(msg1=="ok")

                            {

                                $('#msg1').empty();	

                                $('#msg1').append('<h3>Affectation au dossier avec succès</h3>');

                                $("#repertoire_dossier_dir").fadeIn("slow");

								

                            }

                            else

                            {

                                $('#msg1').empty();

								

                                $('#msg1').append(msg1);

                            }

                        }

                    }				

                }

            });

            return false;

        });

        $("#fermer1").click(function(){

		

			document.getElementById('repertoire_dossier_dir').style.visibility = 'hidden'; 

            location.reload();

        });

		

		

    });

</script>



<div id="repertoire_dossier_dir"  style="visibility: hidden;" ><div id="fils_dossier_dir">

        <div id="fade_dossier_dir"></div>

        <div class="popup_block_dossier_dir" style="width: 560px; z-index: 999; top: 10%; left: 25%;">

            <div class="titleBar_dossier_dir">

                <div class="title_dossier_dir">Formulaire d'affectation au dossier </div>

                <a href="javascript:hideDiv_dir()" id="fermer1"><div class="close_dossier_dir" style="cursor: pointer;">close</div></a>

            </div>

            <div id="content_dossier_dir" class="content_dossier_dir" style="height: 100%;">

                <form action="" id="form_pop_dossier_dir" method="post">

                    <table border="0" cellspacing="0" cellpadding="2" align="center">

                        <tr>

                            <td colspan="2">

                                <div id="msg1"></div>

                            </td>

                        </tr>

                        <tr>

                            <td width="38%"><b>Nom et prénom du candidat : </b></td>

                            <td id="champ_email1_dir"></td>

                            <td id="id_candidat1_dir"></td>

                        </tr>

                        <tr>

                            <td colspan="2">

                                <div class="subscription" style="margin: 10px 0pt;">

                                    <h1>Affectation au dossier  </h1>

                                </div>

                            </td>

                        </tr>		                     

                        

                        <tr>

                            <td width="35%"><b>Nom du dossier  </b></td>

                            <td width="75%">

                                <select name="dossier">

									 <option value=""></option>

								  <?php			$req_ci = mysql_query( "SELECT * FROM dossier");				

								  while ( $ci = mysql_fetch_array( $req_ci ) ) {	

								  

								  $ds_nom = $ci['nom_dossier'];	 $ds_id = $ci['id_dossier'];						

								  

									  echo '<option value="'.$ds_id.'">'.$ds_nom.'</option>';	

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

                                <input name="envoi" class="espace_candidat" type="submit" value="Valider" style="width:170px" />

                            </td>	

                            <td>

                                <input name="" type="reset" class="espace_candidat" style="width:170px"/>

                            </td>

                        </tr>					  

                    </table>

                </form>

            </div>

        </div>

    </div>

    <!--Fin POPUP-->

