

<div class="subscription" style="margin: 10px 0pt;">



<h1> <?php if (isset($_POST['id'])  OR isset($_POST['id__e']) )  {echo "MODFIER";}

         else { echo "AJOUTER"; }

      ?> UNE FORMATION </h1>



</div>

<div style="width:100%; display:inline-table;">

<input type="hidden" name="id__e" value="<?php  

  if (isset($_POST['id'])  )  {echo $_POST['id'];} 

  if (isset($_POST['id__e'])  )  {echo $_POST['id__e'];}   ?>" /><br>

<div style="width:33%; display:inline-table;">

  <label>Date de début </label><span style="color:red;">*</span> : <br/>

<!--

<input type="text" placeholder=" mm/aaaa "  title="Veuillez entrez la date de début de formation"  id="calendar_dbf" style="width:170px;" 

 name="date_debut_formation" value="<?php  echo $dd_formation; ?>" required/>

-->

<?php/* echo $month_dd;

echo $year_dd;

echo $month_df;

echo $year_df; */?>

<select class="form-control" id="mois_debut_formation" title="Mois debut formation" name="mois_formation" style="width: 40%;" required/>

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

<select class="form-control" id="anne_debut_formation" title="Année debut formation" name="anne_formation" style="width: 40%;" required/>

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

<div style="width:50%; display:inline-table;">



<label>Date de fin </label><span style="color:red;">*</span> : <br/>

<!--<input type="text"  placeholder=" mm/aaaa "  title="Veuillez entrez la date de fin de formation" id="calendar_ff" style="width:170px;" 

 name="date_fin_formation" value="<?php  echo $df_formation; ?>" class="conditionally-loaded"  />&nbsp;&nbsp;

-->



<select class="conditionally-loaded" id="mois_fin_formation" title="Mois fin formation" name="mois_fin_formation" style="width: 26.3%%;" />

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



<select class="conditionally-loaded" id="anne_fin_formation" title="Année fin formation" name="anne_fin_formation" style="width: 26.3%%;" />

<option value=""></option>

<?php

  for ($i = date('Y'); $i >= 1966; $i--) {

    if (isset($i) and $year_df == $i){$selected = 'selected';}

    else{$selected = '';}      

    echo '<option value="'.$i.'" '.$selected.' >'.$i.'</option>';

  }

?>

</select>

<input type="checkbox" name="subscribe" title=" à aujourd'hui " value="oui" style="width: 20px;"

   <?php if (isset($year_df) AND $year_df == '' AND isset($_POST['ok']) ) echo 'checked=checked'; ?> /> à aujourd'hui 

</div>



<script type="text/javascript">

  var $conditionalInput = $('select.conditionally-loaded');

var $subscribeInput = $('input[name="subscribe"]');

<?php if (isset($year_df) AND $year_df == '' AND isset($_POST['ok'])){ ?>

$conditionalInput.hide();

<?php }else{ ?>

$conditionalInput.show();

<?php } ?>

$subscribeInput.on('click', function(){

    if ( $(this).is(':checked') )

        $conditionalInput.hide();

    else

        $conditionalInput.show();

});

</script>

</div>

<div style="width:100%; display:inline-table;">

<div style="width:33%; display:inline-table;"><br/>

  <label>&Eacute;cole ou établissement </label><span style="color:red;">*</span>



<br />

<select name="etablissement" id="etablissement" style="font-size:11px;width: 174px;" title="Selectionnez école ou établissement" required/>

<option value="" selected="selected"></option>



<?php

$select_pays = mysql_query("SELECT distinct prm_ecoles.id_pays,prm_pays.pays as nom_pays from prm_ecoles inner join prm_pays on prm_pays.id_pays=prm_ecoles.id_pays ");



while($pays = mysql_fetch_array($select_pays))

{



    echo "<optgroup label='".$pays['nom_pays']."'>";

$select_ecole=mysql_query('select * from prm_ecoles where id_pays='.$pays['id_pays']);



while ($ecole = mysql_fetch_array($select_ecole))  {



    if ($etablissement == $ecole['id_ecole'])

        $selected = "selected";

    else

        $selected = "";

        

    echo "<option value='" . $ecole['id_ecole'] . "' " . $selected . ">" . $ecole['nom_ecole'] . "</option>";

}



echo " </optgroup>";



}



?>

</select>

</div>



<div style="width:33%; display:inline-table;"><br/>

  <label>Nombre d’année de formation </label><span style="color:red;">*</span>

              <br />

  <select id="nivformation" name="nivformation" style="font-size:11px;width: 174px;" 

                title="Selectionnez nombre d'année de formation" required/>

                  <option value=""></option>



                  <?php         $req_niv_formation = mysql_query( "SELECT * FROM prm_niv_formation");               

                  while ( $niv_formation = mysql_fetch_array( $req_niv_formation ) ) {                  

                  $formation_id = $niv_formation['id_nfor'];                    

                  $formation_desc = $niv_formation['formation'];                    

                      if($nivformation==$formation_id )                 {                   

                      echo '<option value="'.$formation_id.'" selected="selected">'.$formation_desc.'</option>';                    }                   

                      else                  {                   

                      echo '<option value="'.$formation_id.'">'.$formation_desc.'</option>';                    

                      }                                 

                  }     ?>





   </select>

</div>

<div style="width:33%; display:inline-table;"><br/>

 <label>Diplôme </label><span style="color:red;">*</span>

<br />





<select id="diplome" name="diplome" style="font-size:11px;width: 174px;" 

                title="Selectionnez nombre d'année de formation" required/>

                  <option value=""></option>



<?php

                        $req_theme = mysql_query("SELECT * FROM prm_filieres");

                        while ($data = mysql_fetch_array($req_theme)) {

                        $id_fili = $data['id_fili'];

                        $filiere = $data['filiere'];

                        ?>

<option value="<?php echo $id_fili; ?>" <?php if (isset($diplome) and $diplome == $id_fili) echo ' selected="selected"'; ?>>

<?php echo $filiere; ?></option>

<?php

                        }

                        ?>



                </select>

</div>

<div style="width:33%; display:inline-table;">

  <div id="div_etablissement" class="show_autre" <?php if(!in_array($etablissement, $id_autre) ) echo 'style="display:none"'?>>

<label>Nom &Eacute;cole ou &eacute;tablissement  </label><br />

<input id="nom_etablissement" type="text"   name="nom_etablissement" style="width:170px;" value="<?php echo $nom_etablissement; ?>"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  />

</div>

</div>     

</div>

<div style="width:100%; display:inline-table;">

<label>Description de la formation </label>

<br />

<textarea name="description_formation" rows="5" style="width:500px" id="description_formation"   pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+" />

<?php  echo htmlspecialchars_decode(strip_tags(stripslashes($desc_form))); ?></textarea>

</div>

<div style="width:100%; display:inline-table;">

<p style="color:#CC0000">P.S: les champs marqués par (*) sont obligatoires</p>

</div>

<div style="width:100%; display:inline-table;">



        <input name="envoi"  type="submit" class="espace_candidat" value="

        <?php if (isset($_POST['id'])  OR isset($_POST['id__e']) )  {echo "Modifier";}

         else { echo "Ajouter"; }

      ?>" style="width:170px"/>





        <input name="reset01" type="submit" class="espace_candidat" value="Réinitialiser" style="width:170px"/>

        <!--<input name="" type="reset" class="espace_candidat" style="width:170px"/>-->

</div>

<div class="ligneBleu"></div>



