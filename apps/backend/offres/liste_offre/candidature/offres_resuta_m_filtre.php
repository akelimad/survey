<div class="subscription" style="margin: 10px 0pt;">



                                <h1>Options de filtrage des CV </h1>



                            </div>

<form enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI'];  ?>" method="post">

<table  width="100%">

<td  width="30%">

<table width="100%" border="0">

<tr>

<td colspan="2" >Par mot clé<label><br/>

<input  type="text" name="motcle" style="width:185px" value="<?php if (!empty($_SESSION['motcle'])) echo $_SESSION['motcle']; ?>" maxlength="100" />

</label></td>

</tr>

<tr>

<td colspan="2">

<label>Par secteur d’activité</label><br />

<select name="secteur" >

<option value="" selected="selected"></option>

            <?php

            $req_theme = mysql_query("SELECT * FROM prm_sectors");

            while ($data = mysql_fetch_array($req_theme)) {

            $Sector_id = $data['id_sect'];

            $Sector = $data['FR'];

                        ?>

<option value="<?php echo $Sector_id; ?>" <?php if (isset($_SESSION['secteur']) and $_SESSION['secteur'] == $Sector_id) echo ' selected="selected"'; ?>>

<?php echo $Sector; ?></option>

<?php

            }

            ?>

</select>

</td>

</tr>

<tr>

<td>

<label>Par années d'expérience</label><br />

<select name="exp">

<option value=""></option>

                              <?php

                              $req_exp = mysql_query("SELECT * FROM prm_experience");

                              while ($exp = mysql_fetch_array($req_exp)) {

                              $exp_id = $exp['id_expe'];

                              $exp_desc = $exp['intitule'];

                        ?>

<option value="<?php echo $exp_id; ?>" <?php if (isset($_SESSION['exp']) and $_SESSION['exp'] == $exp_id) echo ' selected="selected"'; ?>>

<?php echo $exp_desc; ?></option>

<?php

                              }

                              ?>  

</select>

</td>

</tr>

<tr>

    <td>

  <label>Par salaire souhaité en DH </label> <br />

        <select name="salaire">

   <option value=""></option>

   <?php

   $req_salaire = mysql_query("SELECT * FROM prm_salaires");

   while ($salaire = mysql_fetch_array($req_salaire)) {

       $salaire_id = $salaire['id_salr'];

       $salaire_desc = $salaire['salaire'];;

                        ?>

<option value="<?php echo $salaire_id; ?>" <?php if (isset($_SESSION['salaire']) and $_SESSION['salaire'] == $salaire_id) echo ' selected="selected"'; ?>>

<?php echo $salaire_desc; ?></option>

<?php

   }

   ?>

        </select>

    </td>

</tr>

</table>

</td>

<td  width="30%">

<table>

<tr>

<td>

<label>Par niveau d'étude</label><br />

<select name="formation">

<option value="" selected="selected"></option>

   <?php

    $req_nf = mysql_query( "SELECT * FROM prm_niv_formation");

      while ( $nf = mysql_fetch_array( $req_nf ) ) {

        $nf_id = $nf['id_nfor'];

        $nf_desc = $nf['formation'];

?>

<option value="<?php echo $nf_id; ?>" <?php if (isset($_SESSION['formation']) and $_SESSION['formation'] == $nf_id) echo ' selected="selected"'; ?>>

<?php echo $nf_desc; ?></option>

<?php

        //echo "<option value=\"$nf_id\"  ".$nf_desc.">$nf_desc</option>";

      }

  ?> 

</select> 

</td>

</tr>

<tr>

<td><label>Par fraicheur du CV</label><br />

<select name="fraicheur" id="fraicheur">

<option value=""></option>

<option value="30" <?php if (isset($_SESSION['fraicheur']) and $_SESSION['fraicheur'] == "30") echo ' selected="selected"'; ?>>Moins 1 mois</option>

<option value="90" <?php if (isset($_SESSION['fraicheur']) and $_SESSION['fraicheur'] == "90") echo ' selected="selected"'; ?>>Moins 3 mois</option>

<option value="180" <?php if (isset($_SESSION['fraicheur']) and $_SESSION['fraicheur'] == "180") echo ' selected="selected"'; ?>>Moins de 6 mois</option>

<option value="360" <?php if (isset($_SESSION['fraicheur']) and $_SESSION['fraicheur'] == "360") echo ' selected="selected"'; ?>>Moins de 12 mois</option>

</select></td>

</tr>

<tr>

<td colspan="3">

<label>Par école ou établissement</label><br />

<select name="etablissement" >

<option value=""></option>

            <?php 

            $select_ecole = mysql_query("SELECT * FROM prm_ecoles");

            while($ecole = mysql_fetch_array($select_ecole))

            {

                        ?>

<option value="<?php echo $ecole['id_ecole']; ?>" <?php if (isset($_SESSION['etablissement']) and $_SESSION['etablissement'] == $ecole['id_ecole']) echo ' selected="selected"'; ?>>

<?php echo $ecole['nom_ecole']; ?></option>

<?php 

            }      

            ?>  

</select>

</td>

</tr>

<tr>



    <td><label>Par disponibilité</label> <br />

        <select name="dispo">

   <option value="" selected="selected"> </option>

<?php   $rf01 = mysql_query( " SELECT * FROM  prm_disponibilite  ");        

    while ( $f01 = mysql_fetch_array( $rf01 ) ) {           

        $fid01 = $f01['id_dispo'];    $fdesc01 = $f01['intitule'];    

                            ?>

<option value="<?php echo $fid01; ?>" <?php if (isset($_SESSION['dispo']) and $_SESSION['dispo'] == $fid01) echo ' selected="selected"'; ?>>

<?php echo $fdesc01; ?></option>

<?php 

                    }   

                    ?> 



        </select>

    </td>

</tr>

</table>

</td>

   <td  width="30%">

 <table>

<tr>

<td>

 <label>Par situation actuelle</label><br />

<select name="situation">

<option value=""></option>

            <?php 

            $select_sa = mysql_query("SELECT * FROM prm_situation ");

            while($sa = mysql_fetch_array($select_sa))

            {

                                ?>

<option value="<?php echo $sa['id_situ']; ?>" <?php if (isset($_SESSION['situation']) and $_SESSION['situation'] == $sa['id_situ']) echo ' selected="selected"'; ?>>

<?php echo $sa['situation']; ?></option>

<?php   

            }      

            ?>  

</select>          </td>

<td></td>

</tr>

<tr>

<td>

<label>Par type de formation</label><br />

<select name="type_formation" >

<option value="" selected="selected"></option>

      <?php 

      $select_tf = mysql_query("SELECT * FROM prm_type_formation");

      while($tf = mysql_fetch_array($select_tf))

      {

                                ?>

<option value="<?php echo $tf['id_tfor']; ?>" <?php if (isset($_SESSION['type_formation']) and $_SESSION['type_formation'] ==$tf['id_tfor']) echo ' selected="selected"'; ?>>

<?php echo $tf['formation']; ?></option>

<?php   

      }      

      ?> 

</select>

</td>

<td>

</td>

</tr>

<tr>

<td>

<label>Par pays de résidence</label><br />

<select name="pays">

<option value=""></option>







       <?php

       $req_pays = mysql_query("SELECT * FROM prm_pays");







       while ($pays = mysql_fetch_array($req_pays)) {







 $pays_id = $pays['id_pays'];







 $pays_desc = $pays['pays'];





                                ?>

<option value="<?php echo $pays_id; ?>" <?php if (isset($_SESSION['pays']) and $_SESSION['pays'] ==$pays_id) echo ' selected="selected"'; ?>>

<?php echo $pays_desc; ?></option>

<?php 

       }

       ?>

   </select>          </td>



    </tr>

    </table>

    </td>



  </table><br>



<input type="submit" title="Filtrer" class="espace_candidat" name="filtrer_f" value="Filtrer" /> 

<input type="submit" title="Actualiser" class="espace_candidat" name="actualiser" OnClick="javascript:window.location.reload()" value="Actualiser">



<!-- <input type="submit" class="espace_candidat" name="historique" value="Historique des requêtes ">  --> 





</form>