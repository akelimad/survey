

<?php if(!isset($cand_stage_succeded)) { ?>



<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="form_standard" method="post">







<table style="width: 690px;">



                <tr> 

                    <td colspan="5"  >

                    <label for="nomecole">Nom de l'&eacute;cole : </label>

                    <font style="color:red;">*</font> <br />

                    </td>

                    <td colspan="9"  >

                    <select name="nomecole" style=" width: 400px; " title="Nom de l'&eacute;cole" required>

                    <?php /*

                    $select_ecole = mysql_query("SELECT * FROM prm_ecoles");

                    while($ecole = mysql_fetch_array($select_ecole))

                    { ?>

                    <option value="<?php echo $ecole['id_ecole']; ?>" 

                    <?php if (isset($_POST['nomecole']) and $_POST['nomecole'] == $ecole['id_ecole']) echo ' selected="selected"'; ?>>

                    <?php echo $ecole['nom_ecole']; ?></option>

                    <?php } */?> 

                    <option value="" >Veuillez selectionnez le Nom de l'&eacute;cole</option>

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

                    <?php /*

                    <input type="text" class="text" title="Veuillez entrer le nom de l'&eacute;cole" name="nomecole" 

                    id="nomecole" value="<?php if(isset($_POST['nomecole']) AND $_POST['nomecole']!='') echo $nomecole; ?>" maxlength="50" 

                    placeholder="Veuillez entrer le nom de votre école"  style=" width: 396px;">

                    */ ?>

                    </td>

                 </tr>

                    <tr>

                    <td><br></td><td><br></td>

                    </tr>                

                <tr> 

                    <td colspan="5"  >

                    <label for="typestage">Type de stage : </label>

                    <font style="color:red;">*</font> <br />

                    </td>

                    <td colspan="9"  >

                   <select name="typestage" id="typestage" title="Veuillez selectionnez le type de stage" style=" width: 400px; " required >

                   <option value="">Veuillez selectionnez le type de stage</option>

                   <?php

                  $req_prstage = mysql_query( "SELECT * FROM prm_type_stage");

                  while ( $nf = mysql_fetch_array( $req_prstage ) ) {

                  $nf_id = $nf['id_tstage'];

                  $nf_desc = $nf['n_type_stage'];

                  ?>

                  <option value="<?php echo $nf_desc; ?>" 

                  <?php if (isset($_POST['typestage'] )

                  and $_POST['typestage'] == $nf_desc) echo ' selected="selected"'; ?>>

                  <?php echo $nf_desc; ?></option>

                  <?php } ?>

                   </select>

                    </td>

                 </tr>

                    <tr>

                    <td><br></td><td><br></td>

                    </tr>

                <tr> 

                    <td colspan="5"  >

                    <label for="entite">Direction demand&eacute;e : </label>

                    <font style="color:red;">*</font><br>          

                    </td>

                    <td colspan="9"  >

                      <?php /* RAM*/ ?>

                      <?php if($_SESSION['r_prm_note']==0){ ?>

                      <select name="entite" id="entite" title="Veuillez selectionnez une direction" style=" width: 400px; " required >

                      <option value="">Veuillez selectionnez une direction</option>

                      <?php

                      $req_drstage = mysql_query( "SELECT * FROM prm_direction_stage");

                      while ( $nf = mysql_fetch_array( $req_drstage ) ) {

                      $nidr_id = $nf['id_prm_stage'];

                      $ndr_desc = $nf['nom_direction'];

                      ?>

                      <option value="<?php echo $ndr_desc; ?>" 

                      <?php if (isset($_POST['entite'] )

                      and $_POST['entite'] == $ndr_desc) echo ' selected="selected"'; ?>>

                      <?php echo $ndr_desc; ?></option>

                      <?php } ?>

                      </select>

                      <?php }else{ ?>

                      <input type="text" class="text" 

                      title="Veuillez entrer le nom de votre direction demandée" 

                      name="entite" id="entite" 

                      value="<?php if(isset($_POST['entite']) AND $_POST['entite']!='') echo $entite; ?>" 

                      maxlength="50"  required style=" width: 396px;" 

                      placeholder="Veuillez entrer le nom de votre direction demandée">

                      <?php } ?>

                    </td>

                 </tr>

                    <tr>

                    <td><br></td><td><br></td>

                    </tr>

                <tr> 

                    <td colspan="5"  >

                    <label for="duree_stage">Dur&eacute;e du stage : </label>

                    <font style="color:red;">*</font> <br />

                    </td>

                    <td colspan="9"  >

                      <select name="duree_stage" id="duree_stage" title="Veuillez selectionnez la dur&eacute;e du stage " 

                      required style=" width: 400px;">

                      <option value="">Veuillez selectionnez la dur&eacute;e du stage</option>

                      <?php

                      $req_drstage = mysql_query( "SELECT * FROM prm_duree_stage");

                      while ( $nf = mysql_fetch_array( $req_drstage ) ) {

                      $nidur_id = $nf['id_duree'];

                      $ndur_desc = $nf['nom_duree'];

                      ?>

                      <option value="<?php echo $ndur_desc; ?>" 

                      <?php if (isset($_POST['duree_stage'] )

                      and $_POST['duree_stage'] == $ndur_desc) echo ' selected="selected"'; ?>>

                      <?php echo $ndur_desc; ?></option>

                      <?php } ?>

                      </select>

                    </td>

                 </tr>

                    <tr>

                    <td><br></td><td><br></td>

                    </tr>

                <tr> 

                    <td colspan="5" valign="top" >

                    <label for="objet_stage">Objet du stage : </label>

                    <font style="color:red;">*</font> <br /><br />

                    </td>

                    <td colspan="9" valign="top" >

                          



                     <textarea  name="objet_stage" title="Objet du stage "  placeholder="Vos motivations" id="objet_stage" cols="60" rows="40"  style="width: 398px;  height: 200px;resize: none;" required><?php if(isset($_POST['objet_stage']) AND $_POST['objet_stage']!='') echo $objet_stage; ?>

                     </textarea>

                            

                                <script type="text/javascript">

                                    CKEDITOR.replace( 'objet_stage' ,

                                    { width: '398px'



                                    });

                                </script>

                            

                    </td>

                 </tr>

                    <tr>

                    <td><br></td><td><br></td>

                    </tr>

                <tr> 

                    <td colspan="5" valign="top" >

                    <label for="motivations">Motivations : </label>

                    <font style="color:red;">*</font>  <br /><br />

                    </td>

                    <td colspan="9" valign="top" >

                     <textarea name="motivations"  id="motivations" title="Motivations" cols="60" rows="40"  style="width: 398px;  height: 200px;resize: none;" required><?php if(isset($_POST['motivations']) AND $_POST['motivations']!='') echo $motivations; ?></textarea>

                    

                                <script type="text/javascript">

                                    CKEDITOR.replace( 'motivations' ,

                                    { width: '398px'});

                                </script>

                                

                    </td>

                 </tr>

                    <tr>

                    <td><br></td><td><br></td>

                    </tr>

                        

               <tr>

              <td colspan="8">

                    <p style="color:#CC0000">

                      P.S: les champs marqu&eacute;s par (*) sont obligatoires

                    </p>

                    <div class="ligneBleu"></div>

    <div style="float: left;"> <input type="submit" name="go" class="espace_candidat" value="Envoyer ma candidature">  </div>

      </td>



            </tr>



          </table>

		  



</form>

<?php 

} 

?>		  