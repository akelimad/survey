      <table width="700px" border="0">

    

                                                                

<tr>

    <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

            <h1>AJOUTER / MODIFIER UNE EXPERIENCE PROFESSIONNELLE </h1>

        </div></td>

</tr>    

</table>

<div style="width:100%; display:inline-table;">

<input type="hidden" name="id__e" value="<?php if (isset($_POST['ok']) AND isset($_POST['id']) AND ($_POST['id']!='') ) {echo $_POST['id'];} ?>" /> 

<div style="width:33%; display:inline-table;">

  <label>Date de début </label><br />

<!--

  <input  placeholder="  01/01/2010  "  id="calendar_dbex" name="date_debut" style="width:170px;" value="<?php echo $dd_exp; ?>" 

  title="Veuillez entrez la date de début d'expérience"  required/>

-->

<select class="form-control" id="mois_debut_experience" title="Mois debut expérience" name="mois_debut_experience" 

style="width: 38%;" required/>

<option value=""></option>

<option value="01" <?php if($month_dd=="01"){echo"selected";}?> >janv.</option>

<option value="02" <?php if($month_dd=="02"){echo"selected";}?>>févr.</option>

<option value="03" <?php if($month_dd=="03"){echo"selected";}?>>mars</option>

<option value="04" <?php if($month_dd=="04"){echo"selected";}?>>avril</option>

<option value="05" <?php if($month_dd=="05"){echo"selected";}?>>mai</option>

<option value="06" <?php if($month_dd=="06"){echo"selected";}?>>juin</option>

<option value="07" <?php if($month_dd=="07"){echo"selected";}?>>juil.</option>

<option value="08" <?php if($month_dd=="08"){echo"selected";}?>>août</option>

<option value="09" <?php if($month_dd=="09"){echo"selected";}?>>sept.</option>

<option value="10" <?php if($month_dd=="10"){echo"selected";}?>>oct.</option>

<option value="11" <?php if($month_dd=="11"){echo"selected";}?>>nov.</option>

<option value="12" <?php if($month_dd=="12"){echo"selected";}?>>déc.</option>

</select>

<select class="form-control" id="anne_debut_experience" title="Année debut expérience" name="anne_debut_experience" 

style="width: 38%;" required/>

<option value=""></option>

<?php

  for ($i = date('Y'); $i >= 1966; $i--) {

    if (isset($i) and $year_dd == $i){$selected = 'selected';}

    else{$selected = '';}      

    echo '<option value="'.$i.'" '.$selected.' >'.$i.'</option>';

  }

?>

</select>

</div>

<div style="width:60%; display:inline-table;">

  <label>Date de fin </label><br />

<!--  

<input  placeholder="  01/01/2010  "  id="calendar_fex" name="date_fin"  style="width:170px;"  class="loadedexp"

  value="<?php echo $df_exp; ?>"

  title="Veuillez entrez la date de fin d'expérience"  />&nbsp;&nbsp;

-->

<select class="loadedexp" id="mois_fin_experience" title="Mois fin expérience" 

name="mois_fin_experience" style="width: 22.3%%;" />

<option value=""></option>

<option value="01" <?php if($month_df=="01"){echo"selected";}?> >janv.</option>

<option value="02" <?php if($month_df=="02"){echo"selected";}?>>févr.</option>

<option value="03" <?php if($month_df=="03"){echo"selected";}?>>mars</option>

<option value="04" <?php if($month_df=="04"){echo"selected";}?>>avril</option>

<option value="05" <?php if($month_df=="05"){echo"selected";}?>>mai</option>

<option value="06" <?php if($month_df=="06"){echo"selected";}?>>juin</option>

<option value="07" <?php if($month_df=="07"){echo"selected";}?>>juil.</option>

<option value="08" <?php if($month_df=="08"){echo"selected";}?>>août</option>

<option value="09" <?php if($month_df=="09"){echo"selected";}?>>sept.</option>

<option value="10" <?php if($month_df=="10"){echo"selected";}?>>oct.</option>

<option value="11" <?php if($month_df=="11"){echo"selected";}?>>nov.</option>

<option value="12" <?php if($month_df=="12"){echo"selected";}?>>déc.</option>

</select>



<select class="loadedexp" id="anne_fin_experience" title="Année fin expérience" 

name="anne_fin_experience" style="width: 22.3%%;" />

<option value=""></option>

<?php

  for ($i = date('Y'); $i >= 1966; $i--) {

    if (isset($i) and $year_df == $i){$selected = 'selected';}

    else{$selected = '';}      

    echo '<option value="'.$i.'" '.$selected.' >'.$i.'</option>';

  }

?>

</select>



<input type="checkbox" name="todayexp" title=" à aujourd'hui " value="oui" style="width: 20px;" 

   <?php if (isset($df_exp) AND $df_exp == '' AND isset($_POST['ok']) ) echo 'checked=checked'; ?>  /> à aujourd'hui 

</div>



</div>

<div style="width:100%; display:inline-table;">



<div style="width:33%; display:inline-table;">

  <label>Entreprise </label>

  <br />

  <input type="text" name="entreprise" id="entreprise" style="width:170px;"  value="<?php echo $entreprise; ?>"  title="Veuillez entrez le nom de l'entreprise"  maxlength="50"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"   required/>

</div>

<div style="width:33%; display:inline-table;">

<label>Intitulé du Poste </label>

<br />

<input type="text" name="poste" id="poste" style="width:170px;"  value="<?php echo $poste; ?>"  title="Veuillez entrez l'intitulé du poste"  maxlength="20" pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"   required/>

</div>

<div style="width:33%; display:inline-table;">

  <label>Secteur d'activité </label><br />

  <select name="sector" style="width:175px;" title="Veuillez selectionnez le secteur d'activité"  required/>

  <option selected="selected" value=""></option>

    <?php $req_theme = mysql_query( "SELECT * FROM prm_sectors"); 

                    while ( $data = mysql_fetch_array( $req_theme ) ) {       

                    $Sector_id = $data['id_sect'];        $Sector = $data['FR'];      

                    if($secteur==$Sector_id){     echo '<option value="'.$Sector_id.'" selected="selected">'.$Sector.'</option>';     }       

                    else      {       echo '<option value="'.$Sector_id.'">'.$Sector.'</option>';     }   }?>  

  </select>

</div>



</div>

<div style="width:100%; display:inline-table;">



<div style="width:33%; display:inline-table;">

  <label>Fonction </label><br />

  <select   name="fonction_exp" style="width:175px;" title="Veuillez selectionnez la fonction"  required/>

  <option value="" selected="selected"></option>

  <?php $req_theme = mysql_query("SELECT * FROM prm_fonctions");

                        while ($data = mysql_fetch_array($req_theme)) {

                      $fonc_id = $data['id_fonc'];

                      $fonc = $data['fonction'];

                      if ( $fonc_id == $fonction_exp)

                          $selected = 'selected';

                      else

                          $selected = '';

  echo "<option value=\"$fonc_id\" " . $selected . ">$fonc</option>";

  }

  ?>

  </select> 

</div>

<div style="width:33%; display:inline-table;">

<label>Type de contrat </label><br />

<select name="type_poste" id="type_poste" style="width:175px;" title="Veuillez selectionnez le type de contrat"  required/>

<option value=""></option>

<?php

$req_poste = mysql_query("SELECT * FROM prm_type_poste");

while ($poste = mysql_fetch_array($req_poste)) {

    $poste_id = $poste['id_tpost'];

    $poste_desc = $poste['designation'];

    if (  $poste_id ==  $type_poste)

        $selected = "selected";

    else

        $selected = "";

    echo "<option value='$poste_id' " . $selected . ">$poste_desc</option>";

}

?>

</select>

</div>

<div style="width:33%; display:inline-table;">

  <label>Ville </label><br />

  <select id="ville_exp" name="ville_exp"  style="width:175px;"

        title="Veuillez selectionnez la ville"  required/>

   <option value=""></option>

   <?php         $req_ville = mysql_query( "SELECT * FROM prm_villes");              

                  while ( $ville1 = mysql_fetch_array( $req_ville ) ) {                 

                  $pays_id = $ville1['id_vill'];                    $ville_desc = $ville1['ville'];                 

                  if($ville_exp==$ville_desc)                   {                   

                  echo '<option value="'.$ville_desc.'" selected="selected">'.$ville_desc.'</option>';                  }                   

                  else                  {                   echo '<option value="'.$ville_desc.'">'.$ville_desc.'</option>';                    }               }       ?>

  </select>

</div>



</div>

<div style="width:100%; display:inline-table;">



<div style="width:33%; display:inline-table;">

  <label>Pays </label><br />

  <select name="pays_exp" id="pays_exp" style="width:175px;"

  title="Veuillez selectionnez le pays"  required/>

  <option value=""></option>

  <?php $req_pays = mysql_query("SELECT * FROM prm_pays ORDER BY pays Asc");

  while ($pays = mysql_fetch_array($req_pays)) {

      $pays_id = $pays['id_pays'];

      $pays_desc = $pays['pays'];

      if ( $pays_id == $pays_exp)

          $selected = "selected";

      else

          $selected = "";

      echo "<option value='$pays_id' " . $selected . ">$pays_desc</option>";

  }

  ?>

  </select>

</div>

<div style="width:33%; display:inline-table;">

<label>Dernier salaire perçu </label><br />

<input type="text" id="salair_pecu" name="salair_pecu" style="width:170px;"  value="<?php if(isset($salair_pecu) and $salair_pecu!=''){echo $salair_pecu;} else {echo '0';}  ?>" maxlength="100" pattern="[0-9,. ]+"  title="Veuillez entrez dérnier salire perçu"   maxlength="20" required/>

</div>



</div>

<div style="width:100%; display:inline-table;">

<label>Description du poste </label><br />

<textarea name="description_poste" rows="5" style="width:500px" id="editor2"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+" ><?php echo strip_tags(stripslashes($desc_exp)); ?></textarea>

</div>



  





<table> 

  <tr>

<td colspan="4">

    <p style="color:#CC0000"> P.S: les champs marqués par (*) sont obligatoires</p>

        <!--<input name="reset01" type="reset" class="espace_candidat" style="width:170px"/>-->

    </td>

  </tr>

  <tr>

      <td colspan="4">

        <input name="envoi" type="submit" class="espace_candidat" value="Enregistrer" style="width:170px"/>

        <input name="reset01" type="submit" class="espace_candidat" value="Réinitialiser" style="width:170px"/>

      </td>

  </tr>    

       

       

      </table>

       <div class="ligneBleu"></div>

<script type="text/javascript">

  var $conditionalInput = $('select.loadedexp');

var $todayInput = $('input[name="todayexp"]');

<?php if (isset($df_exp) AND $df_exp == '' AND isset($_POST['ok'])){ ?>

$conditionalInput.hide();

<?php }else{ ?>

$conditionalInput.show();

<?php } ?>

$todayInput.on('click', function(){

    if ( $(this).is(':checked') )

        $conditionalInput.hide();

    else

        $conditionalInput.show();

});

</script>