<form action="<?php echo $_SERVER['REQUEST_URI'];  ?>"  method="post" >



    



    

       <input type="hidden" name="candidature"  value="<?php echo $candidature;      ?>"    />

          <input type="hidden" name="stat"  value="<?php  echo $stat1;  ?>"    />

    









	

	

	

	

	

	

    



<table  width="100%">

<!--========================================================	1	-->

<tr>



<td  width="30%">

<label>Par mot clé</label><br/><input type="text" name="motcle"  value="<?php  if(!empty($_SESSION["nc_motcle"])) echo  $_SESSION["nc_motcle"] ; ?>" style="width: 187px;" maxlength="100" />

</td>

<td  width="30%">

	<label>Par type de formation</label><br /> 

	<select name="type_formation" >

	<option value="" selected="selected"></option>

	<?php   $select_tf = mysql_query("SELECT * FROM prm_type_formation");

      while($tf = mysql_fetch_array($select_tf))  {

	?>

	<option value="<?php echo $tf['id_tfor']; ?>" <?php if (isset($_SESSION["nc_type_formation"]) and $_SESSION["nc_type_formation"] ==$tf['id_tfor']) echo ' selected="selected"'; ?>> <?php echo $tf['formation']; ?></option>

	<?php  }  ?> 

	</select>



</td>

<td  width="30%">

	<label>Par fraicheur du CV</label><br /> 

	<select name="fraicheur" id="fraicheur"> 

	  <option value=""></option> 

	  <option value="30" <?php if(isset($_SESSION["nc_fraicheur"]) and $_SESSION["nc_fraicheur"]=="30") echo ' selected="selected"' ; ?>>1 mois</option>

	  <option value="90" <?php if(isset($_SESSION["nc_fraicheur"]) and $_SESSION["nc_fraicheur"]=="90") echo ' selected="selected"' ; ?>>3 mois</option>

	  <option value="180" <?php if(isset($_SESSION["nc_fraicheur"]) and $_SESSION["nc_fraicheur"]=="180") echo ' selected="selected"' ; ?>>6 mois</option>

	  <option value="360" <?php if(isset($_SESSION["nc_fraicheur"]) and $_SESSION["nc_fraicheur"]=="360") echo ' selected="selected"' ; ?>>12 mois</option>

	</select>



</td>



</tr>

<!--========================================================	2	-->

<tr>

<td  width="30%">

       <label>Par secteur d’activité</label><br />

       <select name="secteur" > 

          <option value="" selected="selected" ></option>

                        <?php

                        $req_theme = mysql_query("SELECT * FROM prm_sectors");

                        while ($data = mysql_fetch_array($req_theme)) {

                        $Sector_id = $data['id_sect'];

                        $Sector = $data['FR'];

                        ?>

<option value="<?php echo $Sector_id; ?>" <?php if (isset($_SESSION["nc_secteur"]) and $_SESSION["nc_secteur"] == $Sector_id) echo ' selected="selected"'; ?>>

<?php echo $Sector; ?></option>

<?php

                        }

                        ?> 

          </select> 



</td>

<td  width="30%">

    <label>Par pays de résidence</label><br />

    <select name="pays">

    <option value=""></option>

    <?php  $req_pays = mysql_query( "SELECT * FROM prm_pays");

    while ( $pays = mysql_fetch_array( $req_pays ) ) {

    $pays_id = $pays['id_pays'];

    $pays_desc = $pays['pays'];

    ?>

    <option value="<?php echo $pays_id; ?>"  <?php if (isset($_SESSION["nc_pays"]) and $_SESSION["nc_pays"] == $pays_id) echo ' selected="selected"'; ?>><?php echo $pays_desc; ?></option>

    <?php } ?>

    </select>  



</td>

<td  width="30%">

	<label>Par ref de l'offre </label> <br> 

	<select name="ref"  id="ref"  > 

	<option></option>         

	<?php 

		$refquery="select * from offre  ". $q_ref_fili ."  ORDER BY id_offre DESC  "; 

		$refreq=  mysql_query($refquery);  $i=0;

		while($refres  =  mysql_fetch_array($refreq))

		{ $reference=$refres['reference'];$ref_titre=$refres['Name'];

	?>

	<option value="<?php echo $reference; ?>" <?php if(isset($_SESSION["nc_ref"]) and $_SESSION["nc_ref"]==$reference) echo "selected='selected'"?> ><?php echo $reference.' | '.$ref_titre; ?></option>

	<?php   } ?>

	</select>



</td>



</tr>

<!--========================================================	3	-->

<tr>



<td width="30%">

<label>Par fonction</label><br />

<select name="fonction" >

<option value="" selected="selected"></option>

                        <?php

                        $req_fonction = mysql_query("SELECT * FROM prm_fonctions");

                        while ($fonc = mysql_fetch_array($req_fonction)) {

                        $Fonct_id = $fonc['id_fonc'];

                        $Fonction = $fonc['fonction'];

                        ?>

<option value="<?php echo $Fonct_id; ?>" <?php if (isset($_SESSION['nc_fonction']) and $_SESSION['nc_fonction'] == $Fonct_id) echo ' selected="selected"'; ?>>

<?php echo $Fonction; ?></option>

<?php

                        }

        ?>

</select>

</td>



<!-- end select par fonction-->



<td  width="30%">

	<label>Par école ou établissement</label><br /> 

	<select name="etablissement" > 

	<option value=""></option>

	<?php 

	$select_ecole = mysql_query("SELECT id_ecole,nom_ecole,pays FROM prm_ecoles a, prm_pays b where a.id_pays = b.id_pays ");

	while($ecole = mysql_fetch_array($select_ecole)) {

	?>

	<option value="<?php echo $ecole['id_ecole']; ?>" <?php if (isset($_SESSION['nc_etablissement']) and $_SESSION['nc_etablissement'] == $ecole['id_ecole']) echo ' selected="selected"'; ?>> <?php echo $ecole['nom_ecole']." || ".$ecole['pays']; ; ?></option>

	<?php } ?>  

	</select> 



</td>

<td  width="30%">

		<label>Par ville</label><br />

	<select name="ville">

	<option value=""></option>

	<?php

	$req_ville = mysql_query("SELECT * FROM prm_villes");

	while ($ville = mysql_fetch_array($req_ville)) {

	$id_vill = $ville['id_vill'];

	$ville = $ville['ville'];

	?>

	<option value="<?php echo $ville; ?>" 

	<?php if (isset($_SESSION['nc_ville']) and $_SESSION['nc_ville'] ==$ville) echo ' selected="selected"'; ?>>

	<?php echo $ville; ?></option>

	<?php } ?>

	</select>



</td>



</tr>

<!--========================================================	4	-->

<tr>

<td  width="30%">

          <label>Par niveau d'étude</label><br /> 

          <select name="formation"> 

            <option value="" selected="selected"></option>

			<?php

				$req_nf = mysql_query( "SELECT * FROM prm_niv_formation");

				while ( $nf = mysql_fetch_array( $req_nf ) ) {

                $nf_id = $nf['id_nfor'];

                $nf_desc = $nf['formation'];

           ?>

<option value="<?php echo $nf_id; ?>" <?php if (isset($_SESSION["nc_formation"]) and $_SESSION["nc_formation"] == $nf_id) echo ' selected="selected"'; ?>><?php echo $nf_desc; ?></option>

			<?php

				}

			?> 



</td>

<td  width="30%">

	<label>Par situation actuelle</label><br /> 

	<select name="situation"> 

	<option value=""></option>

	<?php    $select_sa = mysql_query("SELECT * FROM prm_situation");

	while($sa = mysql_fetch_array($select_sa))  {

	?>

	<option value="<?php echo $sa['id_situ']; ?>" <?php if (isset($_SESSION["nc_situation"]) and $_SESSION["nc_situation"] == $sa['id_situ']) echo ' selected="selected"'; ?>> <?php echo $sa['situation']; ?></option>

	<?php  } ?>  

	</select>  



</td>

<td  width="30%">	

	<label>Par campagne de recrutement</label><br />

	<select name="campagne">

	<option value=""></option>

	<?php

	$req_cr = mysql_query("SELECT * FROM campagne_recrutement ".$q_ref_fili." ");

	while ($c_recrut = mysql_fetch_array($req_cr)) {

	$id_compagne = $c_recrut['id_compagne'];

	$titre_compagne = $c_recrut['titre_compagne'];

	?>

	<option value="<?php echo $id_compagne; ?>" 

	<?php if (isset($_SESSION['nc_campagne']) 

	and $_SESSION['nc_campagne'] ==$id_compagne) echo ' selected="selected"'; ?>>

	<?php echo $titre_compagne; ?></option>

	<?php } ?>

	   </select>



</td>



</tr>

<!--========================================================	5	-->

<tr>



<td  width="30%">

<?php   

    if($_SESSION['r_prm_note']==0){ 

?>

      <label>Par notation</label><br /> 

      <select name="notation" id="notation" > 

        <option value=""></option> 

        <option value="100" style="color:#00B300;" <?php if(isset($_SESSION["nc_notation"]) and $_SESSION["nc_notation"]=="100")  echo ' selected="selected"' ; ?>>Bonne</option>

        <option value="70" style="color:#CC5500;" <?php if(isset($_SESSION["nc_notation"]) and $_SESSION["nc_notation"]=="70")  echo ' selected="selected"' ; ?>>Moyenne</option> 

        <option value="40" style="color:#CC0000;" <?php if(isset($_SESSION["nc_notation"]) and $_SESSION["nc_notation"]=="40")  echo ' selected="selected"' ; ?>>Faible</option> 

        <option value="10" style="color:#000000;" <?php if(isset($_SESSION["nc_notation"]) and $_SESSION["nc_notation"]=="10")   echo ' selected="selected"' ; ?>>Null</option> 

      </select> 

<?php   

        } 

?>

</td>

<td width="30%">	

        <?php   

    if($_SESSION['r_prm_pertinenc_cnddtr']==0){ 

?>   

    <label>Par pertinence</label><br />

    <select name="pertinence" id="pertinence" > 

        <option value=""></option> 

        <option value="100" style="color:#00B300;" <?php if(isset($_SESSION["nc_pertinence"]) and $_SESSION["nc_pertinence"]=="100")  echo ' selected="selected"' ; ?>>Bonne</option> 

        <option value="60" style="color:#CC5500;" <?php if(isset($_SESSION["nc_pertinence"]) and $_SESSION["nc_pertinence"]=="60")   echo ' selected="selected"' ; ?>>Moyenne</option> 

        <option value="30" style="color:#CC0000;" <?php if(isset($_SESSION["nc_pertinence"]) and $_SESSION["nc_pertinence"]=="30")  echo ' selected="selected"' ; ?>>Faible</option> 

    </select>

<?php   

    }  

?>

</td>

<td width="30%">

    <?php if($_SESSION['r_prm_region_off']==0){ ?> 

        <label>Par région de travail</label><br />

    <select name="region">

    <option value=""></option>

    <?php

    $req_ville = mysql_query("SELECT * FROM prm_region");

    while ($ville = mysql_fetch_array($req_ville)) {

    $id_region = $ville['id_region'];

    $nom_region = $ville['nom_region'];

    ?>

    <option value="<?php echo $id_region; ?>" 

    <?php if (isset($_SESSION['nc_region']) and $_SESSION['nc_region'] ==$id_region) echo ' selected="selected"'; ?>>

    <?php echo $nom_region; ?></option>

    <?php } ?>

    </select>

    <?php } ?>

</td>



</tr>

<tr>



    <td  width="30%">

	    <label>Par age</label> <br />

        <select name="age">

   <option value="" > </option>

<?php   $rq_age = mysql_query( " SELECT * FROM  prm_age ");                

        while ( $lage = mysql_fetch_array( $rq_age ) ) {                       

                $age_id = $lage['id_age'];      

				$age_interval = $lage['intervale_age'];        

                                ?>

<option value="<?php echo $age_id; ?>" <?php if (isset($_SESSION['nc_age']) and $_SESSION['nc_age'] == $age_id) echo ' selected="selected"'; ?>>

<?php echo $age_interval; ?></option>

<?php   

                                      }     

                                      ?> 

        </select>

    </td>



    

    <td width="30%">

<label>Par sexe</label><br />

<select name="sexe">

<option value=""></option>

<option value="1" <?php if (isset($_SESSION['nc_sexe']) and $_SESSION['nc_sexe'] == "1") echo ' selected="selected"'; ?>>Homme</option>

<option value="2" <?php if (isset($_SESSION['nc_sexe']) and $_SESSION['nc_sexe'] == "2") echo ' selected="selected"'; ?>>Femme</option>

</select>

    </td>



    <td  width="30%">

<?php if($_SESSION['r_prm_region_off']==0){ ?> 

        <label>Par ville d'affectation</label><br />

    <select name="r_ville">

    <option value=""></option>

<?php

$select_pays = mysql_query("SELECT * FROM prm_region ");

while($pays = mysql_fetch_array($select_pays))

{

?><optgroup label="<?php echo $pays['nom_region']; ?>"><?php

$select_ecole=mysql_query("SELECT * from prm_region_ville where id_region='".$pays['id_region']."' ");



while ($ecole = mysql_fetch_array($select_ecole))  {

    $id_region = $ecole['nom_region'];

    $ville = $ecole['ville'];

?>

    <option value="<?php echo $ville; ?>" 

    <?php if (isset($_SESSION['nc_region_ville']) and $_SESSION['nc_region_ville'] ==$ville) echo ' selected="selected"'; ?>>

    <?php echo $ville; ?></option>

    <?php

}

echo " </optgroup>";

}

?>

    </select>

<?php } ?>

    </td>



</tr>

<tr>

<td  width="30%">

          <label>Par année d'expérience</label><br /> 

          <select name="exp"> 

          <option value=""></option>

			<?php

				$req_exp = mysql_query("SELECT * FROM prm_experience");

					while ($exp = mysql_fetch_array($req_exp)) {

						$exp_id = $exp['id_expe'];

						$exp_desc = $exp['intitule'];

			?>

<option value="<?php echo $exp_id; ?>" <?php if (isset($_SESSION["nc_exp"]) and $_SESSION["nc_exp"] == $exp_id) echo ' selected="selected"'; ?>><?php echo $exp_desc; ?></option>

			<?php

					}

			?>



</td>

<td></td>



<td></td>

</tr>



</table>





   



      



          

      



                

<br/>

        <input type="submit" class="espace_candidat" name="envoi_fitrage"  value=" Filtrer " />



        <input type="submit" class="espace_candidat" name="actualiser" OnClick="javascript:window.location.reload()" value=" Actualiser ">  



<?php if($_SESSION['r_prm_export_candidature']==0){ ?>

<div style="float:right"><button class="espace_candidat" ><a href="#" id="myButtonControlID_txt"  role='button' style="color: #fff;">Exporté la table vers text</button></div>

<div style="float:right"><button class="espace_candidat" ><a href="#" id="myButtonControlID_csv"  role='button' style="color: #fff;">Exporté la table vers CSV</a></button></div>

<div style="float:right"><button class="espace_candidat" 

id="myButtonControlID">Exporté la table vers Excel</button></div><br><br/>

<?php } ?>

    <div class="ligneBleu"></div><br/>



      </form>