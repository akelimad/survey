<table width="100%" border="0" cellpadding="3">

            <tr>

              <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

                  <h1>Récapitulatif de l'offre </h1>

                </div></td>

            </tr>

            </table>

              <table width="100%" border="0" cellpadding="3">

            <tr>

              <td width="25%">Date de publication</td>

              <td width="50%">Intitulé du poste</td>

              <td width="25%">

              <?php if($_SESSION['r_prm_region_off']==0){ ?> 

                Région de travail

                <?php }else{ ?>

                Lieu de travail

                <?php } ?>

              </td>

            </tr>

    

     



            

            

            

            

            <tr>

              <td><b><?php echo date("d.m.Y",strtotime($offre['date_insertion'])); ?></b></td>

         

              <td><b><?php echo $offre['Name']; ?></b></td>

              <td><b>

                <?php if($_SESSION['r_prm_region_off']==0){ 

                  $select_lieu = mysql_query("SELECT * from prm_region where id_region = '".safe($offre['id_localisation'])."' ");

                    $lieu = mysql_fetch_array($select_lieu);

                    echo $lieu['nom_region'];

                  }else{ 

                    $select_lieu = mysql_query("SELECT ville from prm_villes where id_vill = '".safe($offre['id_localisation'])."' ");

                    $lieu = mysql_fetch_array($select_lieu);

                    echo $lieu['ville'];

                  } ?>

              </b></td>

            </tr>

            </table>

             <table width="100%" border="0" cellpadding="3">

            <tr>

              <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

                  <h1>Votre motivation pour le poste </h1>

                </div></td>

            </tr>

            

        <tr> 

        

    <td width="30%" valign="top" >Choisissez un cv  :</td>

    

    <td><select  id="cv" name="cv"  style="width:200px;">

    <?php //if(isset($_POST['cv'])) $cv1 = $_POST['cv']; else $cv1 = ""; 

        $select_cv_principale= mysql_query("SELECT * from cv where candidats_id = '".safe($_SESSION['abb_id_candidat'])."' AND actif=1 AND principal=1");

          

          $cv_principale = mysql_fetch_array($select_cv_principale);

            $succes = mysql_num_rows($select_cv_principale);

            if($succes)

            $cv1 = $cv_principale['id_cv'];

            else

            $cv1= "";

?>

<?php 

         

            $select_model=mysql_query("select * from cv  where candidats_id='".safe($_SESSION['abb_id_candidat'])."'  AND actif=1");

          

          while($cv2 = mysql_fetch_array($select_model))

          {

           if($cv1 == $cv2['id_cv'] )  $selected =  "selected";

           else $selected =  "";

           

         echo "<option value='".$cv2['id_cv']."'     ".$selected."     >".$cv2['titre_cv']."</option>";

         

         }

          ?>

</td>

  </tr>





  <?php

          $select_model = mysql_query("select * from lettres_motivation where candidats_id = '".safe($_SESSION['abb_id_candidat'])."' AND actif=1 ");

		  $lettre_model = mysql_fetch_array($select_model);

            $succes = mysql_num_rows($select_model);

            if($succes)

            $letter1 = $lettre_model['id_lettre'];

            else

            $letter1= "";

	if($letter1!= "") {

  ?>  

                <tr> 

        

    <td valign="top" >Choisissez une lettre de motivation    :

       <input name="id_offre" type="hidden" value="<?php echo $id_offre; ?>" /></td>



    <td><select  id="Letter" name="Letter" style="width:200px;" >

    <?php // if(isset($_POST['Letter'])) $letter1 = $_POST['Letter']; else $letter1 = "";   



    $select_lettre_principale= mysql_query("select * from lettres_motivation where candidats_id = '".safe($_SESSION['abb_id_candidat'])."' 

      AND actif=1 AND principal=1");

          

          $lettre_principale = mysql_fetch_array($select_lettre_principale);

            $succes = mysql_num_rows($select_lettre_principale);

            if($succes)

            $letter1 = $lettre_principale['id_lettre'];

            else

            $letter1= "";

        echo  $lettre_principale['id_lettre'];

            ?>

<option value="" <?php if($letter1== "")  echo "selected"; ?>></option>

<?php 

          $select_model = mysql_query("select * from lettres_motivation where candidats_id = '".safe($_SESSION['abb_id_candidat'])."' 

            AND actif=1 ");

          

          while($lettre = mysql_fetch_array($select_model))

          {

           if($letter1 == $lettre['id_lettre'] )  $selected =  "selected";

           else $selected =  "";

           

         echo "<option value='".$lettre['id_lettre']."'     ".$selected."     >".$lettre['titre']."</option>";

         

         }

          ?>

</td>

  </tr>

  <?php

	}

  ?>

            <?php if($_SESSION['r_prm_region_off']==0){ ?> 

            <tr>

              <td>Ville d'affectation : <span style="color:red"></span></td>

                 <td><select id="lieu" name="lieu" style="width:200px;"

                 title="Lieu de travail" required/>

                      <option value="" selected="selected"></option>

                         <?php 

                         $select_region = mysql_query("SELECT * FROM prm_region 

                          where id_region like '".safe($offre['id_localisation'])."'");

                          while($r_region = mysql_fetch_array($select_region))

                          {

?><optgroup label="<?php echo $pays['nom_region']; ?>"><?php

                          $select_ville=mysql_query('SELECT * from prm_region_ville 

                            where id_region='.$r_region['id_region']);



                          while ($r_ville = mysql_fetch_array($select_ville))  {

                              $r_n_nom_region = $r_ville['nom_region'];$r_n_ville = $r_ville['ville'];

                          ?>

                              <option value="<?php echo $r_n_ville; ?>" 

                              <?php if (isset($lieu_id) and $lieu_id ==$r_n_ville)

                               echo 'selected="selected"'; ?>>

                              <?php echo $r_n_ville; ?></option>

                              <?php

                          }

                          echo " </optgroup>";

                          }

                         ?>

                     </select> 

                     <input type="hidden" name="n_region" value="<?php echo $offre['id_localisation']; ?>"> 

                 </td>

            </tr>

            <?php } ?>

            <tr>

              <td  valign="top" ><label>Votre message </label></td>

           <td >

                <textarea name="motivation" id="editor2" required/>

                </textarea>

                <script type="text/javascript">

                CKEDITOR.replace( 'editor2',

                                                    {

                                                    width : "500px",

                                                    height : "200px"

                                                    });

          </script>

              </td>

            </tr>

            





  

      



            <tr>

              <td colspan="4"><div class="ligneBleu"></div>

                <input name="id_offre" type="hidden" value="<?php echo $id_offre; ?>" />

                <input  name="send" type="submit" value="Envoyer ma candidature" class="espace_candidat" />

              </td>

            </tr>

          </table>