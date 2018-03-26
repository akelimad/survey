<table width="700px" border="0">

    

    

<tr>

    <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

   <h1>Intitul&eacute; du profil </h1> 

        </div></td>

</tr>

<tr>

    <td colspan="2"><label>Titre de votre profil </label> 

       <span style="color:red;">*</span><br />

        <input type="text" name="titre" value="<?php  echo  $titre; ?>"  style="width:400px" title="Veuillez entrez le titre de profil"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"   required/></td>

    <td ><br><a  href="javascript:void(0)"  class="tooltip" align="center">

    <i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>



     <em><span></span>  (exp:D&eacute;veloppeur informatique,Consultant SI,Chef de projet...) </em>



 </a></td>

</tr>

<tr>

    <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

   <h1>Etat civil </h1>

        </div></td>

</tr>

<tr>

    <td width="30%"><label>Civilit&eacute; </label>

       <span style="color:red;">*</span><br />

<select name="civilite" style="width:175px" title="Veuillez selectionez votre civilité" required/>

<option selected="selected" value=""></option>

<?php $req_civi1 = mysql_query( "SELECT * FROM prm_civilite");        

    while ( $ncivi1 = mysql_fetch_array( $req_civi1 ) ) {           

        $civi_id = $ncivi1['id_civi'];    $civi_desc1 = $ncivi1['civilite'];    

      if ($civi_id == $civilite)

        $selected = "selected";

      else

        $selected = "";

      echo "<option value='" . $civi_id . "' " . $selected . ">" . $civi_desc1 . "</option>"; 

                    }   

                    ?>       

</select>



    </td>

    <td><label>Nom </label>

        <font style="color:red;">*</font><br />

        <input type="text"  name="nom" value="<?php echo $nom; ?>" style="width: 170px;" title="Veuillez entrez votre nom"   pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"   required/>

    </td>

    <td width="20%" ><label>Prénom </label>

       <span style="color:red;">*</span><br />

        <input type="text" name="prenom" value="<?php echo $prenom; ?>" style="width: 170px;" title="Veuillez entrez votre prénom"   pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  required/>

    </td>

</tr>

<tr>

    <td colspan="2"><label>Adresse </label>

       <span style="color:red;">*</span><br />

        <input type="text" name="adresse"value="<?php echo $adresse; ?>" style="width:454px;" title="Veuillez entrez votre adresse"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ',;:°._-+* ]+"   required/>

    </td>

    <td ><label>Code postal </label> <br />

        <input type="text" name="code"  value="<?php echo $code; ?>" style="width: 170px;" title="Veuillez entrez votre code postal"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  /></td>

</tr>

<tr>

    <td><label>Ville </label>

       <span style="color:red;">*</span><br /> 

    <select id="ville" name="ville"  style="width:175px" title="Veuillez selectionnez votre ville"  required/>

                  <option value=""></option>

                  <?php     $req_ville = mysql_query( "SELECT * FROM prm_villes");        

          while ( $ville1 = mysql_fetch_array( $req_ville ) ) {         

          $pays_id = $ville1['id_vill'];          $ville_desc = $ville1['ville'];         

          if($ville==$ville_desc)          {         

          echo '<option value="'.$ville_desc.'" selected="selected">'.$ville_desc.'</option>';          }         

          else          {         echo '<option value="'.$ville_desc.'">'.$ville_desc.'</option>';          }             }   ?>

                </select>

    </td>

    <td width="22%"><label>Pays de r&eacute;sidence </label>

       <span style="color:red;">*</span><br />

        <select name="pays" style="width:175px" title="Veuillez selectionnez votre pays de résidence" required/>

   <option value=""></option>

<?php

$req_pays = mysql_query("SELECT * FROM prm_pays ORDER BY pays Asc");

while ($pays1 = mysql_fetch_array($req_pays)) {

  $pays_id = $pays1['id_pays'];

  $pays_desc = $pays1['pays'];

  if ($pays_id == $pays)

$selected = "selected";

  else

$selected = "";

  echo "<option value=\"$pays_id\" " . $selected . ">$pays_desc</option>";

}

?>

        </select></td>

    <td ><label>Date de naissance </label>

       <span style="color:red;">*</span><br />

        <input id="calendar_naissance" name="date" style="width:170px;" value="<?php echo $date; ?>"     pattern="(?:(?:0[1-9]|1[0-2])[\/\\-. ]?(?:0[1-9]|[12][0-9])|(?:(?:0[13-9]|1[0-2])[\/\\-. ]?30)|(?:(?:0[13578]|1[02])[\/\\-. ]?31))[\/\\-. ]?(?:19|20)[0-9]{2}"   title="Veuillez entrez votre date de naissance" required/>

    </td>

</tr>

<tr>

    <td><label>Nationalit&eacute; </label>

       <span style="color:red;">*</span><br />

        <input name="nationalite"  type="text" value="<?php echo $nationalite; ?>" style="width: 170px;"  title="Veuillez entrez votre nationalité"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"   required/></td>

    <td><label>T&eacute;l&eacute;phone </label>

       <span style="color:red;">*</span><br />

        <input name="tel1" type="tel"  value="<?php echo $tel1; ?>" style="width: 170px;" 

        title="Veuillez entrez votre numéro de téléphone" 

        pattern="^((\+\d{1,4}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{5})(( x| ext)\d{1,5}){0,1}$"

        required/></td>

    <td><label>T&eacute;l&eacute;phone secondaire</label>

        <br />

        <input name="tel2" type="tel"  value="<?php echo $tel2; ?>" style="width: 170px;"

        pattern="^((\+\d{1,4}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{5})(( x| ext)\d{1,5}){0,1}$"

        title="Veuillez entrez votre numéro de téléphone secondaire"/></td>

</tr>

<tr>

<td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

        <h1>Profil </h1>

    </div></td>

</tr>

<tr>

    <td><label>Situation actuelle  </label>

       <span style="color:red;">*</span><br />

        <select name="situation" style="width:175px" title=" Votre situation actuelle "  required/>

   <option value=""></option>   <?php

   $req_theme = mysql_query("SELECT * FROM prm_situation");

   while ($data = mysql_fetch_array($req_theme)) {

       $situ_id = $data['id_situ'];

       $situ = $data['situation'];

       if ($situ_id == $situation)

$selected = 'selected';

       else

$selected = '';

       echo "<option value=\"$situ_id\" " . $selected . ">$situ</option>";

   }

   ?>

   

        </select>

    </td>

    <td style="padding: 0 38px 0 0;"><label>Secteur souhaité  </label>

       <span style="color:red;">*</span><br />

        <select name="domaine" style="width:175px" required/>

   <option value="" selected="selected"></option>

   <?php

   $req_theme = mysql_query("SELECT * FROM prm_sectors");

   while ($data = mysql_fetch_array($req_theme)) {

       $Sector_id = $data['id_sect'];

       $Sector = $data['FR'];

       if ($Sector_id == $domaine)

$selected = 'selected';

       else

$selected = '';

       echo "<option value=\"$Sector_id\" " . $selected . ">$Sector</option>";

   }

   ?>

        </select>

    </td>



       <td><label>Fonction </label>

          <font style="color:red;">*</font> <br />

          <select  name="fonction" style="width:175px" required/>

            <option value="" selected="selected"></option>

            <?php

            $req3_theme = mysql_query("SELECT * FROM prm_fonctions");

            while ($data3 = mysql_fetch_array($req3_theme)) {

          $fonc_id = $data3['id_fonc'];

          $fonc = $data3['fonction'];

          if ( $fonc_id == $fonction)

            $selected = 'selected';

          else

            $selected = '';

          echo "<option value=\"$fonc_id\" " . $selected . ">$fonc</option>";

            }

            ?>

          </select>



              </td>

  

  

</tr>

<tr>

    

    <td><label>Salaire souhaité en Dh </label>

       <span style="color:red;">*</span><br />

        <select name="salaire" style="width:175px" required/>

   <option value=""></option>

   <?php

   $req_salaire = mysql_query("SELECT * FROM prm_salaires");

   while ($salaire1 = mysql_fetch_array($req_salaire)) {

       $salaire_id = $salaire1['id_salr'];

       $salaire_desc = $salaire1['salaire'];

       if ($salaire_id == $salaire)

$selected = "selected";

       else

$selected = "";

       echo "<option value=\"$salaire_id\" " . $selected . ">$salaire_desc</option>";

   }

   ?>

        </select></td>

     

    <td><label>Niveau de formation </label>

       <span style="color:red;">*</span><br />

     <select   name="formation" style="width:175px" required/>

<option selected="selected" value=""></option>

<?php $req_nforma1 = mysql_query( "SELECT * FROM prm_niv_formation");       

    while ( $nforma1 = mysql_fetch_array( $req_nforma1 ) ) {            

        $nforma_id1 = $nforma1['id_nfor'];    $nforma_desc1 = $nforma1['formation'];    

      if ($nforma_id1 == $formation)

        $selected = "selected";

      else

        $selected = "";

      echo "<option value='" . $nforma_id1 . "' " . $selected . ">" . $nforma_desc1 . "</option>";  

                    }   

                    ?>       

</select>

    </td>

    <td><label>Type de formation </label>

       <span style="color:red;">*</span><br />

<select   name="type_formation" style="width:175px" required/>

<option selected="selected" value=""></option>

<?php   $rf01 = mysql_query( " SELECT * FROM  prm_type_formation ");       

    while ( $f01 = mysql_fetch_array( $rf01 ) ) {           

        $fid01 = $f01['id_tfor'];   $fdesc01 = $f01['formation'];   

      if ($fid01 == $type_formation)

        $selected = "selected";

      else

        $selected = "";

      echo "<option value='" . $fid01 . "' " . $selected . ">" . $fdesc01 . "</option>";  

      //  echo " value='" . $fdesc01 . "' " ;

                    }   

                    ?>       

</select>    



    </td>

</tr>

<tr>

    <td><label>Disponibilité</label>

        <font style="color:red;">*</font><br />

        <select name="dispo" style="width:175px" required> 

   <option value="" selected="selected">[Choisissez une disponibilité]</option>

<?php   $rf01 = mysql_query( " SELECT * FROM  prm_disponibilite ");       

    while ( $f01 = mysql_fetch_array( $rf01 ) ) {           

        $fid01 = $f01['id_dispo'];    $fdesc01 = $f01['intitule'];    

      if ($fid01 == $dispo)

        $selected = "selected";

      else

        $selected = "";

      echo "<option value='" . $fid01 . "' " . $selected . ">" . $fdesc01 . "</option>";   

                    }   

                    ?>  

        </select>

    </td>

    <td><label>Dur&eacute;e d'exp&eacute;rience </label>

       <span style="color:red;">*</span><br />

        <select name="exp" style="width:175px" required>

   <option value=""></option>

        <?php

        $req_exp = mysql_query("SELECT * FROM prm_experience");

        while ($exp1 = mysql_fetch_array($req_exp)) {

   $exp_id = $exp1['id_expe'];

   $exp_desc = $exp1['intitule'];

   if ($exp_id == $exp)

       $selected1 = 'selected';

   else

       $selected1 = '';

   echo "<option value=\"$exp_id\" " . $selected1 . ">$exp_desc</option>";

        }

        ?>

        </select>

    </td>

</tr>

<tr>

    <td colspan="4"><label>Mobilité géographique </label> 

        <input name="mobilite" type="radio" value="oui" style="width:20px" onclick="document.getElementById('mobilite').style.display='inline'" <?php if ( $mobilite == 'oui') echo 'checked'; ?>/>

        Oui

        <input name="mobilite" type="radio" value="non" style="width:20px" onclick="document.getElementById('mobilite').style.display='none'" <?php if ( $mobilite == 'non') echo 'checked'; ?> />

        Non

        <ul id="mobilite" style="display:<?php if ( $mobilite== 'oui') echo 'inline';else echo 'none'; ?>;list-style:none;">

   <li style="list-style-type: none;"> <label>Au niveau :</label>   

        <?php

        $req_niv = mysql_query("SELECT * FROM prm_mobi_niv");

        while ($rniv = mysql_fetch_array($req_niv)) {

   $rniv_id = $rniv['id_mobi_niv'];

   $rniv_desc = $rniv['niveau'];

   if ($rniv_id == $niveau)

       $selected1 = 'checked';

   else

       $selected1 = '';    

   echo '<input name="niveau" type="radio" value="'.$rniv_id.'" ' . $selected1 . ' /><label>'.$rniv_desc.'</label>';

        }

        ?> 

     </li>

   <li style="list-style-type: none;"> <label>Taux de mobilité:</label>   

        <?php

        $req_tau = mysql_query("SELECT * FROM prm_mobi_taux");

        while ($rtau = mysql_fetch_array($req_tau)) {

   $rtau_id = $rtau['id_mobi_taux'];

   $rtau_desc = $rtau['taux'];

   if ($rtau_id == $taux )

       $selected1 = 'checked';

   else

       $selected1 = '';    

   echo '<input name="taux" type="radio" value="'.$rtau_id.'" '. $selected1 .' /><label>'.$rtau_desc.'</label>';

        }

        ?> 

     

     </li>

        </ul></td>

</tr>

 

  

  <tr>

<td colspan="4"><div class="ligneBleu"></div>

    <p style="color:#CC0000"> P.S: les champs marqués par (*) sont obligatoires<br/>

        <input name="envoi" type="submit" class="espace_candidat" value="Enregistrer" style="width:170px"/>

        <input name="" type="reset" class="espace_candidat" style="width:170px"/>

    </p></td>

  </tr>    

    

 

      </table>