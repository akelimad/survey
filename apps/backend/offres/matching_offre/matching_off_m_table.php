<?php



if(isset($_POST["c_offre"]) and $_POST["c_offre"]!=''){  $_SESSION["c_offre_requet"]=$_POST["c_offre"];} 

 

$prm_titre= (isset($_POST['prm_titre']))? $_POST['prm_titre'] : "";

$prm_expe = (isset($_POST['prm_expe']))? $_POST['prm_expe'] : "";

$prm_local = (isset($_POST['prm_local']))? $_POST['prm_local'] : "";

$prm_tpost = (isset($_POST['prm_tpost']))? $_POST['prm_tpost'] : "";

$prm_fonc = (isset($_POST['prm_fonc']))? $_POST['prm_fonc'] : "";

$prm_nfor = (isset($_POST['prm_nfor']))? $_POST['prm_nfor'] : "";

$prm_mobil = (isset($_POST['prm_mobil']))? $_POST['prm_mobil'] : "";

$prm_n_mobil = (isset($_POST['prm_n_mobil']))? $_POST['prm_n_mobil'] : "";

$prm_t_mobil = (isset($_POST['prm_t_mobil']))? $_POST['prm_t_mobil'] : ""; 





$min_p_a_req = (isset($_POST['min_p_a_req']))? $_POST['min_p_a_req'] : ""; 





           

          if(isset($_POST['actualiser']))

				{

				$_SESSION["c_offre_requet"]="";

				

				$prm_titre=  $prm_expe =  $prm_local =  $prm_tpost =  $prm_fonc =  $prm_nfor =  $prm_mobil =  $prm_n_mobil =  $prm_t_mobil =$min_p_a_req= "";

				 

				}else{

					

					  if(!empty($_SESSION["c_offre_requet"]) AND (!empty($prm_titre) OR !empty($prm_expe) OR !empty($prm_local) OR !empty($prm_tpost) OR !empty($prm_fonc) OR !empty($prm_nfor) OR !empty($prm_mobil) OR !empty($prm_n_mobil) OR !empty($prm_t_mobil) ) )

							{

								echo '<meta http-equiv="refresh" content="0;'.$urlad_offr.'/matching_offre/offre_matching_dynamique_candidats/?offre='.$_SESSION["c_offre_requet"].'&prm_titre='.$prm_titre.'&prm_expe='.$prm_expe.'&prm_local='.$prm_local.'&prm_tpost='.$prm_tpost.'&prm_fonc='.$prm_fonc.'&prm_nfor='.$prm_nfor.'&prm_mobil='.$prm_mobil.'&prm_n_mobil='.$prm_n_mobil.'&prm_t_mobil='.$prm_t_mobil.'&min_p_a_req='.$min_p_a_req.'" />';

							}

					

				}

	

/*	

echo   $_SESSION["c_offre_requet"]."<br>".$prm_titre."<br>".  $prm_expe ."<br>".  $prm_local ."<br>".  $prm_tpost ."<br>".  $prm_fonc ."<br>".  $prm_nfor ."<br>".  $prm_mobil ."<br>".  $prm_n_mobil ."<br>".  $prm_t_mobil ."<br>". $min_p_a_req."<br>";	

//*/





/*

<form action="<?php echo $urlad_offr;?>/matching_offre/offre_matching_dynamique_candidats/" method="post">

*/



?>	

								

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">



<table width="100%">

<tr colspan="2">

<div class="subscription" style="width:100%; margin: 10px 0pt;">

<h1>Choix de requête :</h1>

</div>

</tr>

<tr>

<td align="right">

<b>Requête pour  :<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

</td>

<td> 

<select name="c_offre" id="c_offre"  style="width: 300px;" onchange="this.form.submit()"

                                        title="Veuillez selectionnez un type" required/>

<option value="" ></option>  

<?php

$select_status_r = mysql_query( "SELECT DISTINCT o.Name,o.id_offre,o.reference 

    FROM offre o where o.id_offre in (select id_offre from candidature )

    ".$q_offre_fili_and."  

    ORDER by reference ASC");

 while($status_ref_r = mysql_fetch_array($select_status_r))

 { 

$id_offre = $status_ref_r['id_offre'];

$Name = $status_ref_r['Name']; 

?>

<option value="<?php echo $id_offre; ?>" 

<?php if (isset($_SESSION["c_offre_requet"]) and  $_SESSION["c_offre_requet"] == $id_offre) 

echo ' selected="selected"'; ?>>

<?php echo $Name; ?></option>

<?php

 }

 ?>

</select>

</td>

                            </tr>

                            

<?php if(isset($_SESSION["c_offre_requet"]) AND $_SESSION["c_offre_requet"]!="" ){  ?>                  

                            <tr>

                                    <td colspan="2"><div class="ligneBleu"></div></td>

                            </tr>

                            <tr>

                                <td colspan="2">

                                    <h2><strong>Critère de filtrage :</strong></h2>

                                     <br>

                                </td>

                            </tr>

                            

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      Selectionnez les critéres de pertinence

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;">

		

		<input name="prm_titre" type="checkbox" value="1" style="width: 20px;height: 17px;" >  Titre

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		

		<input name="prm_expe" type="checkbox" value="1" style="width: 20px;height: 17px;" >  Expérience

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		

		<input name="prm_local" type="checkbox" value="1" style="width: 20px;height: 17px;" >  Ville

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		

		<input name="prm_tpost" type="checkbox" value="1" style="width: 20px;height: 17px;" >  Type de poste

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

        

		<input name="prm_fonc" type="checkbox" value="1" style="width: 20px;height: 17px;" >  Fonction

        

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

        

<input name="prm_nfor" type="checkbox" value="1" style="width: 20px;height: 17px;" >  Formation

        

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		

		<input name="prm_mobil" type="checkbox" value="1" style="width: 20px;height: 17px;" >  Mobilité (Oui/Non)

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		

		<input name="prm_n_mobil" type="checkbox" value="1" style="width: 20px;height: 17px;" >  Niveau Mobilité 

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		

<input name="prm_t_mobil" type="checkbox" value="1" style="width: 20px;height: 17px;" >  Taux Mobilité 

		

    </td>

    </tr>

	

	

	<script>

	  function handleChange(input) {

		if (input.value < 0) input.value = 0;

		if (input.value > 100) input.value = 100;

	  }

	</script>





    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

		Minimum pertinence (Valeur entre 0 et 100)

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 		

		<input name="min_p_a_req" type="text" value=""   onchange="handleChange(this);" >  		

    </td>

    </tr>

                           

                            

                            

                            <tr>

                                <td></td>

                                <td>

								<br>

                            <input type="submit" class="espace_candidat" 

                            id="valider" type="submit" name="valider" value="valider" />

                            <input type="submit" class="espace_candidat" name="actualiser" 

                            OnClick="javascript:window.location.reload()" value="Actualiser "> 

                                </td>

                            </tr>

                            

                                                    

                            <tr>

                                    <td colspan="2"><div class="ligneBleu"></div>

                                      <b><span style="color:red">P.S: les champs marqués par (*) sont obligatoires</span></b>   </td>

                            </tr>

                               <?php   }  ?>   

                        </table>  

                        

</form> 