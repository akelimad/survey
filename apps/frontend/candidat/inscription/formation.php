

  

<?php

$month_dd=$year_dd=$month_df=$year_df='';



if(!empty($dd_formation) and !empty($df_formation)){

$orderdate_dd = explode('/', $dd_formation); 

$month_dd=(empty($orderdate_dd[2])) ? $orderdate_dd[0] : $orderdate_dd[1];

$year_dd=(empty($orderdate_dd[2])) ? $orderdate_dd[1] : $orderdate_dd[2];

 

$orderdate_dd = explode('/', $df_formation); 

$month_df=(empty($orderdate_dd[2])) ? $orderdate_dd[0] : $orderdate_dd[1];

$year_df=(empty($orderdate_dd[2])) ? $orderdate_dd[1] : $orderdate_dd[2]; 

}

?>





<table>

                             

<tr>

<td colspan="4"><div class="subscription" style="margin: 10px 0pt;width: 720px;">

<h1>Dernière formation</h1>

</div>

</td>

</tr>

<tr>

<td id="erreurs_formation" colspan="4">



<div style="width:100%; display:inline-table;">

<div style="width:33%; display:inline-table;">

  <label>Date de début </label><span style="color:red;">*</span> : <br/>

<!--

<input  placeholder="  01/2010  "  id="calendar_dbf"  title="Veuillez selectionez la date de début" 

style="width:170px;"  name="date_debut_formation" value="<?php if(isset($dd_formation)){echo $dd_formation;}?>" required/>

-->

<!-- //////////////////////////////////////////////////// -->

<select style="width: 80px;" class="form-control" id="mois_debut_formation" title="Mois debut formation" name="mois_debut_formation"  required/>

<option value=""></option>

<option value="01" <?php if($mois_debut_formation=="01"){echo"selected";}?> >janv.</option>

<option value="02" <?php if($mois_debut_formation=="02"){echo"selected";}?> >févr.</option>

<option value="03" <?php if($mois_debut_formation=="03"){echo"selected";}?> >mars</option>

<option value="04" <?php if($mois_debut_formation=="04"){echo"selected";}?> >avril</option>

<option value="05" <?php if($mois_debut_formation=="05"){echo"selected";}?> >mai</option>

<option value="06" <?php if($mois_debut_formation=="06"){echo"selected";}?> >juin</option>

<option value="07" <?php if($mois_debut_formation=="07"){echo"selected";}?> >juil.</option>

<option value="08" <?php if($mois_debut_formation=="08"){echo"selected";}?> >août</option>

<option value="09" <?php if($mois_debut_formation=="09"){echo"selected";}?> >sept.</option>

<option value="10" <?php if($mois_debut_formation=="10"){echo"selected";}?> >oct.</option>

<option value="11" <?php if($mois_debut_formation=="11"){echo"selected";}?> >nov.</option>

<option value="12" <?php if($mois_debut_formation=="12"){echo"selected";}?> >déc.</option>

</select>

<select style="width: 94px;" class="form-control" id="anne_debut_formation" title="Année debut formation" name="anne_debut_formation" required/>

<option value=""></option>

<?php 

  for ($value = date('Y'); $value >=1966  ; $value--) {

	  if (!empty($anne_debut_formation) and $anne_debut_formation == $value){$selected = 'selected';}

     else{$selected = '';}  

      echo '<option value="'.$value.'" '.$selected.'> '.$value.' </option > ';

  }

?> 

</select>

<!-- //////////////////////////////////////////////////// -->



</div>

<div style="width:50%; display:inline-table;">

<label>Date de fin </label><span style="color:red;">*</span> : <br/>

<!--<input  placeholder="  01/2010  "  id="calendar_ff"  title="Veuillez selectionez la date de fin"  class="formloaded" 

style="width:170px;"  name="date_fin_formation" value="<?php if(isset($df_formation)){echo $df_formation;}?>" />&nbsp;&nbsp;

-->

<!-- //////////////////////////////////////////////////// -->



<select style="width: 80px;" class="formloaded" id="mois_fin_formation" title="Mois fin formation" name="mois_fin_formation"  />

<option value=""></option>

<option value="01" <?php if($mois_fin_formation=="01"){echo"selected";}?> >janv.</option>

<option value="02" <?php if($mois_fin_formation=="02"){echo"selected";}?> >févr.</option>

<option value="03" <?php if($mois_fin_formation=="03"){echo"selected";}?> >mars</option>

<option value="04" <?php if($mois_fin_formation=="04"){echo"selected";}?> >avril</option>

<option value="05" <?php if($mois_fin_formation=="05"){echo"selected";}?> >mai</option>

<option value="06" <?php if($mois_fin_formation=="06"){echo"selected";}?> >juin</option>

<option value="07" <?php if($mois_fin_formation=="07"){echo"selected";}?> >juil.</option>

<option value="08" <?php if($mois_fin_formation=="08"){echo"selected";}?> >août</option>

<option value="09" <?php if($mois_fin_formation=="09"){echo"selected";}?> >sept.</option>

<option value="10" <?php if($mois_fin_formation=="10"){echo"selected";}?> >oct.</option>

<option value="11" <?php if($mois_fin_formation=="11"){echo"selected";}?> >nov.</option>

<option value="12" <?php if($mois_fin_formation=="12"){echo"selected";}?> >déc.</option>

</select>



<select style="width: 94px;" class="formloaded" id="anne_fin_formation" title="Année fin formation" name="anne_fin_formation"  />

<option value=""></option>

<?php 

        for ($value = date('Y'); $value >=1966 ; $value--) {

	  if (!empty($anne_fin_formation) and $anne_fin_formation == $value){$selected = 'selected';}

     else{$selected = '';}  

      echo '<option value="'.$value.'" '.$selected.'> '.$value.' </option > ';

        }

?> 

</select>



<!-- //////////////////////////////////////////////////// -->

<input type="checkbox" name="today" title=" à aujourd'hui " value="oui" style="width: 20px;"

   <?php if (isset($year_df) AND $year_df == '' )  //echo 'checked=checked'; ?> /> à aujourd'hui 

</div>

</div>

<div style="width:100%; display:inline-table;">

<div style="width:33%; display:inline-table;"><br/>

  <label>&Eacute;cole ou établissement </label><span style="color:red;">*</span>

<br />

<select id="etablissement" name="etablissement" title="Veuillez selectionez école ou établissement" 

style="font-size:11px;width: 174px;" required/>

<option value="" selected="selected"></option>

<?php

$select_pays = mysql_query("SELECT distinct prm_ecoles.id_pays,prm_pays.pays as nom_pays 

  from prm_ecoles inner join prm_pays on prm_pays.id_pays=prm_ecoles.id_pays ");

while($pays = mysql_fetch_array($select_pays))

{

echo "<optgroup label='".$pays['nom_pays']."'>";

$select_ecole=mysql_query('SELECT * from prm_ecoles where id_pays='.$pays['id_pays']);



while ($ecole = mysql_fetch_array($select_ecole))  {

  if (isset($etablissement) and $ecole['id_ecole'] == $etablissement)

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

<select id="nivformation" name="nivformation" title="Veuillez selectionez votre nombre d'année de formation"

                style="font-size:11px;width: 174px;" required/>

          <option value=""></option>



                  <?php     $req_niv_formation = mysql_query( "SELECT * FROM prm_niv_formation");       

          while ( $niv_formation = mysql_fetch_array( $req_niv_formation ) ) {          

          $formation_id = $niv_formation['id_nfor'];          

          $formation_desc = $niv_formation['formation'];          

            if(isset($nivformation) and $nivformation==$formation_id )          {         

            echo '<option value="'.$formation_id.'" selected="selected">'.$formation_desc.'</option>';          }         

            else          {         

            echo '<option value="'.$formation_id.'">'.$formation_desc.'</option>';          

            }                       

          }   ?>

</select>

</div>

<div style="width:33%; display:inline-table;"><br/>

 <label>Diplôme </label><span style="color:red;">*</span>

<br />

<select id="diplome" name="diplome" title="diplome"

style="font-size:11px;width: 174px;" required/>

<option value=""></option>

<?php     $req_filieres = mysql_query( "SELECT * FROM prm_filieres");       

while ( $niv_filieres = mysql_fetch_array( $req_filieres ) ) {          

$filieres_id = $niv_filieres['id_fili'];          

$filieres_desc = $niv_filieres['filiere'];          

if(isset($diplome) and $diplome==$filieres_id )          {         

echo '<option value="'.$filieres_id.'" selected="selected">'.$filieres_desc.'</option>';          }         

else          {         

echo '<option value="'.$filieres_id.'">'.$filieres_desc.'</option>';          

}                       

}   ?>



</select>

</div>

<div style="width:33%; display:inline-table;">



<div id="div_etablissement" class="show_autre" <?php  if ((isset($etablissement) and $etablissement != '290') OR (!isset($etablissement))) echo 'style="display:none"';?> >

<label>Nom &Eacute;cole ou &eacute;tablissement  </label>

<span style="color:red;">*</span><br />

<input id="nom_etablissement" type="text" placeholder="Nom de l'école ou établissement" title="Veuillez selectionez votre nom de l'école ou établissement" name="nom_etablissement" style="width:170px;" value="<?php if(isset($nom_etablissement)){echo htmlspecialchars_decode($nom_etablissement, ENT_QUOTES) ;}?>" maxlength="100"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"   />

</div>

</div>

</div>

<div style="width:33%; display:inline-table;">

<label>Copie du diplôme</label>

  <br />

<input type="file" class="upload-file" title="Veuillez joindre la copie du diplôme" name="copie_diplome" id="copie_diplome" style="width: 250px;" accept=".gif,.jpeg,.jpg,.png,.pdf,.doc,.docx"/>

</div>

<div style="width:100%; display:inline-table;">
<br />
<label>Description de la formation </label>

<br />

<textarea  name="description_formation" rows="5" placeholder="Description de la formation" title="Veuillez entrer la description de la formation"

style="width:500px" id="description_formation"  pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  /><?php if(isset($desc_form)){

$desc_form = str_replace($tag_ckedit, "", $desc_form); echo stripslashes(htmlentities($desc_form));}?></textarea>

</div>



</table>

 



  <script src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>

  

  <script>

 

$(document).ready(function(){

 

    $("#calendar_dbf").datepicker({ 

        dateFormat: 'mm/yy',

        changeMonth: true,

        changeYear: true,

        showButtonPanel: true,

 yearRange : 'c-40:c+60' ,

        onClose: function(dateText, inst) {  

            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 

            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 

            $(this).val($.datepicker.formatDate('mm/yy', new Date(year, month, 1)));

        }

    });

 

    $("#calendar_dbf").focus(function () {

        $(".ui-datepicker-calendar").hide();

        $("#ui-datepicker-div").position({

            my: "center top",

            at: "center bottom",

            of: $(this)

        });    

    });

    

});

 $(document).ready(function(){

 

    $("#calendar_ff").datepicker({ 

        dateFormat: 'mm/yy',

        changeMonth: true,

        changeYear: true,

        showButtonPanel: true,

 yearRange : 'c-40:c+60' ,

        onClose: function(dateText, inst) {  

            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 

            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 

            $(this).val($.datepicker.formatDate('mm/yy', new Date(year, month, 1)));

        }

    });

 

    $("#calendar_ff").focus(function () {

        $(".ui-datepicker-calendar").hide();

        $("#ui-datepicker-div").position({

            my: "center top",

            at: "center bottom",

            of: $(this)

        });    

    });

    

}); 

</script>



<script type="text/javascript">

  var $conditionalInput = $('select.formloaded');

var $todayInput = $('input[name="today"]');

<?php if (isset($year_df) AND $year_df == '' AND isset($_POST['ok'])){ ?>

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

  



