

<table>

                               

<tr>

  <td colspan="4"><div class="subscription" style="margin: 10px 0pt;width: 720px; ">

      <h1> Dernière expérience professionnelle</h1>

    </div></td>

</tr> 





<tr>

<td colspan="3"> 




<div style="width:100%; display:inline-table;">



<div style="width:33%; display:inline-table;">

<label>Date de début   </label><br/>

<!--

<input  placeholder="  01/01/2010  "  id="calendar_dbex" name="date_debut" 

style="width:170px;" value="<?php if(isset($dd_exp)){echo $dd_exp;}?>"/>

-->

<select style="width: 80px;" id="mois_debut_experience" title="Mois début expérience" name="mois_debut_experience"  />

<option value=""></option>

<option value="01" <?php if($mois_debut_experience=="01"){echo"selected";}?> >janv.</option>

<option value="02" <?php if($mois_debut_experience=="02"){echo"selected";}?> >févr.</option>

<option value="03" <?php if($mois_debut_experience=="03"){echo"selected";}?> >mars</option>

<option value="04" <?php if($mois_debut_experience=="04"){echo"selected";}?> >avril</option>

<option value="05" <?php if($mois_debut_experience=="05"){echo"selected";}?> >mai</option>

<option value="06" <?php if($mois_debut_experience=="06"){echo"selected";}?> >juin</option>

<option value="07" <?php if($mois_debut_experience=="07"){echo"selected";}?> >juil.</option>

<option value="08" <?php if($mois_debut_experience=="08"){echo"selected";}?> >août</option>

<option value="09" <?php if($mois_debut_experience=="09"){echo"selected";}?> >sept.</option>

<option value="10" <?php if($mois_debut_experience=="10"){echo"selected";}?> >oct.</option>

<option value="11" <?php if($mois_debut_experience=="11"){echo"selected";}?> >nov.</option>

<option value="12" <?php if($mois_debut_experience=="12"){echo"selected";}?> >déc.</option>

</select>



<select style="width: 94px;" id="annee_debut_experience" title="Année début expérience" name="annee_debut_experience" />

<option value=""></option>

<?php 

		for ($value = date('Y'); $value >=1966  ; $value--) {

	  if (!empty($annee_debut_experience) and $annee_debut_experience == $value){$selected = 'selected';}

     else{$selected = '';}  

      echo '<option value="'.$value.'" '.$selected.'> '.$value.' </option > ';

        }

?> 

</select>

</div>

<div style="width:50%; display:inline-table;">

<label>Date de fin   </label><br/>

<!--<input  placeholder="  01/01/2010  "  id="calendar_fex" name="date_fin" class="loadedexp"

style="width:170px;"  value="<?php if(isset($df_exp)){echo $df_exp;}?>"/>&nbsp;&nbsp;

-->

<select style="width: 80px;" class="loadedexp" id="mois_fin_experience" title="Mois fin expérience" name="mois_fin_experience" />

<option value=""></option>

<option value="01" <?php if($mois_fin_experience=="01"){echo"selected";}?> >janv.</option>

<option value="02" <?php if($mois_fin_experience=="02"){echo"selected";}?> >févr.</option>

<option value="03" <?php if($mois_fin_experience=="03"){echo"selected";}?> >mars</option>

<option value="04" <?php if($mois_fin_experience=="04"){echo"selected";}?> >avril</option>

<option value="05" <?php if($mois_fin_experience=="05"){echo"selected";}?> >mai</option>

<option value="06" <?php if($mois_fin_experience=="06"){echo"selected";}?> >juin</option>

<option value="07" <?php if($mois_fin_experience=="07"){echo"selected";}?> >juil.</option>

<option value="08" <?php if($mois_fin_experience=="08"){echo"selected";}?> >août</option>

<option value="09" <?php if($mois_fin_experience=="09"){echo"selected";}?> >sept.</option>

<option value="10" <?php if($mois_fin_experience=="10"){echo"selected";}?> >oct.</option>

<option value="11" <?php if($mois_fin_experience=="11"){echo"selected";}?> >nov.</option>

<option value="12" <?php if($mois_fin_experience=="12"){echo"selected";}?> >déc.</option>

</select>



<select style="width: 94px;" class="loadedexp" id="anne_fin_experience" title="Année fin formation" name="anne_fin_experience"  />

<option value=""></option>

<?php 

  for ($value = date('Y'); $value >=1966; $value--) {

	  if (!empty($anne_fin_experience) and $anne_fin_experience == $value){$selected = 'selected';}

     else{$selected = '';}  

      echo '<option value="'.$value.'" '.$selected.'> '.$value.' </option > ';

  }

?> 

</select>



<input type="checkbox" name="todayexp" title=" à aujourd'hui " value="oui" style="width: 20px;"

   <?php if (isset($year_df) AND $year_df == '' )  //echo 'checked=checked'; ?> /> à aujourd'hui 

</div>



</div>

<div style="width:100%; display:inline-table;">



<div style="width:33%; display:inline-table;"><br/>

<label>Entreprise </label>

 <br />

<input type="text" name="entreprise" id="entreprise" style="width:170px;"  value="<?php if(isset($entreprise)){echo htmlspecialchars_decode($entreprise, ENT_QUOTES);}?>" maxlength="100" pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  />

</div>

<div style="width:33%; display:inline-table;"><br/>

<label>Intitulé du poste </label>

 <br />

<input type="text" name="poste" id="poste" style="width:170px;"  value="<?php if(isset($poste)){echo htmlspecialchars_decode($poste, ENT_QUOTES) ;}?>" maxlength="100" pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  />

</div>

<div style="width:33%; display:inline-table;"><br/>

<label>Secteur d'activité </label><br />             

<select id="sector" name="sector" style="width:175px;">

<option selected="selected" value=""></option>

  <?php $req_theme = mysql_query( "SELECT * FROM prm_sectors"); 

          while ( $data = mysql_fetch_array( $req_theme ) ) {   

          $Sector_id = $data['id_sect'];    $Sector = $data['FR'];    

          if(isset($secteur) and $secteur==$Sector_id){   echo '<option value="'.$Sector_id.'" selected="selected">'.$Sector.'</option>';   }   

          else    {   echo '<option value="'.$Sector_id.'">'.$Sector.'</option>';   } }?>

</select>

</div>



</div>

<div style="width:100%; display:inline-table;">



<div style="width:33%; display:inline-table;"><br/>

<label>Fonction </label><br />

     <select   id="fonction_exp" name="fonction_exp" style="width:175px;">

            <option value="" selected="selected"></option>

            <?php

            $req3_theme = mysql_query("SELECT * FROM prm_fonctions");

            while ($data3 = mysql_fetch_array($req3_theme)) {

          $fonc_id = $data3['id_fonc'];

          $fonc = $data3['fonction'];

          if (isset($fonction_exp) and $fonc_id == $fonction_exp)

            $selected = 'selected';

          else

            $selected = '';

          echo "<option value=\"$fonc_id\" " . $selected . ">$fonc</option>";

            }

            ?>

          </select>

</div>

<div style="width:33%; display:inline-table;"><br/>

<label>Type de contrat </label>

  <br />

<select id="type_poste" name="type_poste" style="width:175px;">

<option value=""></option>

<?php

$req_poste = mysql_query("SELECT * FROM prm_type_poste");

while ($poste = mysql_fetch_array($req_poste)) {

  $poste_id = $poste['id_tpost'];

  $poste_desc = $poste['designation'];

  if (isset($type_poste) and $poste_id == $type_poste)

    $selected = "selected";

  else

    $selected = "";

  echo "<option value='$poste_id' " . $selected . ">$poste_desc</option>";

}

?>

</select>

</div>

<div style="width:33%; display:inline-table;"><br/>

<label>Ville </label><br /> 

  <select id="ville_exp" name="ville_exp"  style="width:175px;">



                  <option value=""></option>



                  <?php     $req_ville = mysql_query( "SELECT * FROM prm_villes");        

          while ( $ville1 = mysql_fetch_array( $req_ville ) ) {         

          $pays_id = $ville1['id_vill'];          $ville_desc = $ville1['ville'];         

          if(isset($ville_exp) and $ville_exp==$ville_desc)         {         

          echo '<option value="'.$ville_desc.'" selected="selected">'.$ville_desc.'</option>';          }         

          else          {         echo '<option value="'.$ville_desc.'">'.$ville_desc.'</option>';          }             }   ?>



   </select>

</div>



</div>

<div style="width:100%; display:inline-table;">



<div style="width:33%; display:inline-table;"><br/>

  <label>Pays </label>

    <br />

  <select id="pays_exp" name="pays_exp" style="width:175px;">

  <option value=""></option>

  <?php

  $req_pays = mysql_query("SELECT * FROM prm_pays ORDER BY pays Asc");

  while ($pays = mysql_fetch_array($req_pays)) {

    $pays_id = $pays['id_pays'];

    $pays_desc = $pays['pays'];

    if (isset($pays_exp) and $pays_id == $pays_exp)

      $selected = "selected";

    else

      $selected = "";

    echo "<option value='$pays_id' " . $selected . ">$pays_desc</option>";

  }

  ?>

  </select>

</div>

<div style="width:33%; display:inline-table;"><br/>

<label>Dernier salaire perçu </label>

  <br />

<input type="text" id="salair_pecu" name="salair_pecu" style="width:170px;"  value="<?php if(isset($salair_pecu)){echo $salair_pecu;} else {echo '0';} ?>" maxlength="100" pattern="[0-9,. ]+"  />

</div>

<div style="width:33%; display:inline-table;"><br/>

<label>Copie de l’attestation de l’expérience</label>

  <br />

<input type="file" class="upload-file" title="Veuillez joindre la copie de l’attestation de l’expérience" name="copie_attestation" id="copie_attestation" style="width: 250px;" accept=".gif,.jpeg,.jpg,.png,.pdf,.doc,.docx"/>

</div>

<div style="width:33%; display:inline-table;"><br/>

<label>Description du poste </label><br />

<textarea name="description_poste" rows="5" style="width:100%;" id="description_poste"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+" ><?php if(isset($desc_exp)){

$desc_exp = str_replace($tag_ckedit, "", $desc_exp); echo stripslashes(htmlentities($desc_exp));}?></textarea>

</div>









</table>

<script type="text/javascript">

  var $conditionalInputexp = $('select.loadedexp');

var $todayInputexp = $('input[name="todayexp"]');

<?php if (isset($year_df) AND $year_df == '' AND isset($_POST['ok'])){ ?>

$conditionalInputexp.hide();

<?php }else{ ?>

$conditionalInputexp.show();

<?php } ?>

$todayInputexp.on('click', function(){

    if ( $(this).is(':checked') )

        $conditionalInputexp.hide();

    else

        $conditionalInputexp.show();

});

</script>

