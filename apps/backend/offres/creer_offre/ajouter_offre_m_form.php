<select name="id_offr_s" id="id_offr_s"  style="width:510px" onchange="this.form.submit()" > 

                       <option value=""></option> 

<?php  

$req_theme = mysql_query("SELECT * FROM  offre ".$q_ref_fili."  ");

while ($data = mysql_fetch_array($req_theme)) {

$sf=''; $m_id = $data['id_offre']; $obj = $data['Name']; 

if ($id_offr_s != $m_id)

$sf = "";

else

$sf = ' selected="selected"'; 

echo "<option value=\"$m_id\" " . $sf . ">$obj</option>";}

?> 

                      </select>  

                  </form> 

                </td>

             </tr>

            <?php \app\Event::trigger('wf_offre_form_fields'); ?>

             <tr>

                 <td width="169">Intitul&eacute; du poste <span style="color:red">*</span></td>

                 <td width="503">

                 <input list="tmail" id="intitule1" type="text" name="intitule" 

                 value="<?php if(isset($r_name)) echo $r_name; else echo ""; ?>"  maxlength="80" style="width:504px" 

                 title="Intitulé du poste" required/>

                 <!--<input id="intitule1" type="text" name="intitule" value="<?php echo $r_email; ?>"  maxlength="80" style="width:504px" title="Intitulé du poste" required/>--></td>

             </tr>
                


         <tr>

             <td><!-- Secteur d’activit&eacute;<span style="color:red">*</span> --></td>

             <td>

             <!--

             <select name="secteur" style="width:510px"

             title="Secteur d’activité" required/>

<option value="" selected="selected"></option>

 <?php

 /*

 $req_theme = mysql_query("SELECT * FROM prm_sectors");

 while ($data = mysql_fetch_array($req_theme)) {

     $Sector_id = $data['id_sect'];

     $Sector = $data['FR'];

         if ($Sector_id == $secteur  )

              $selected = 'selected';

         else

              $selected = '';

     echo "<option value=\"$Sector_id\" " . $selected . ">$Sector</option>";

 }

 //*/

 ?>

                 </select>

                 -->

                 <input type="hidden" name="secteur" value="17">

             </td>

         </tr>            

         <tr>

             <td>Fonction / Département<span style="color:red">*</span></td>

             <td><select id="fonction1" name="fonction" style="width:512px" 

             title="Fonction / Département" required/>

                <option value="" selected="selected"></option>

                 <?php

                 $req_theme = mysql_query("SELECT * FROM prm_fonctions");

                 while ($data = mysql_fetch_array($req_theme)) {

                     $Sector_id = $data['id_fonc'];

                     $Sector = $data['fonction'];

                                             if ($Sector_id == $id_fonction  )

                                                 $selected = 'selected';

                                             else

                                                 $selected = '';

                     echo "<option value=\"$Sector_id\" " . $selected . ">$Sector</option>";

                 }

                 ?>

                 </select>

             </td>

         </tr>

             <tr>

                 <td>Mission et responsabilité <span style="color:red">*</span></td>

                 <td><textarea name="details" id="editor11" required/><?php  if(isset($r_details)) echo stripslashes($r_details);  else echo ""; ?></textarea>

                 <script type="text/javascript">

                 CKEDITOR.replace( 'editor11') 

                 </script>

                 

                 </td>

             </tr>

             <tr>

                 <td>Profil recherch&eacute; <span style="color:red">*</span></td>

                 <td><textarea name="profils" 

                 id="editor21"><?php   if(isset($r_profil))  echo stripslashes($r_profil);  else echo "";  ?></textarea>

                 <script type="text/javascript">

                 CKEDITOR.replace( 'editor21') 

                 </script>

                 </td>

             </tr>

         <tr>

             <td>Niveau de formation requis<span style="color:red">*</span></td>

             <td><select id="formation1" name="formation" style="width:510px"

             title="Niveau de formation requis" required/>

<option value="" selected="selected"></option>

                        <?php

                        $req_lieu = mysql_query("SELECT * FROM prm_niv_formation");

                        while ($form_req = mysql_fetch_array($req_lieu)) {

                            $lieu_id = $form_req['id_nfor'];

                            $lieu_desc = $form_req['formation'];

                             if ($lieu_id == $id_formation  )

                                 $selected = 'selected';

                             else

                                 $selected = '';

                            echo "<option value=\"$lieu_id\" " . $selected . ">$lieu_desc</option>";

                        }

                        ?>

                 </select>

             </td>

         </tr>

             <tr>

                 <td>Niveau d'expérience exigé <span style="color:red">*</span></td>

                 <td><select id="exp1" name="exp" style="width:510px"

                 title="Niveau d'expérience exigé" required/>

<option value="" selected="selected"></option>

                         <?php

                         $req_exp = mysql_query("SELECT * FROM prm_experience");

                         while ($exper = mysql_fetch_array($req_exp)) {

                             $exp_id = $exper['id_expe'];

                             $exp_desc = $exper['intitule'];

                             if ($exp_id == $id_exp )

                                 $selected = 'selected';

                             else

                                 $selected = '';

                             echo "<option value=\"$exp_id\" " . $selected . ">$exp_desc</option>";

                         }

                         ?>

                     </select>

                 </td>

             </tr>

         <tr>

             <td>Type de contrat <span style="color:red">*</span></td>

             <td><select id="poste1" name="poste" style="width:510px"

             title="Niveau d'expérience exigé" required/>

<option value="" selected="selected"></option>

                         <?php

                         $req_poste = mysql_query("SELECT * FROM prm_type_poste");

                         while ($type_poste = mysql_fetch_array($req_poste)) {

                             $poste_id = $type_poste['id_tpost'];

                             $poste_desc = $type_poste['designation'];

                             if ($poste_id == $id_poste)

                                 $selected = 'selected';

                             else

                                 $selected = '';

                             echo "<option value=\"$poste_id\" " . $selected . ">$poste_desc</option>";

                         }

                         ?>

                 </select>

             </td>

         </tr>

             <tr>

                 <td>

                <?php if($_SESSION['r_prm_region_off']==0){ ?> 

                Région de travail

                <?php }else{ ?>

                Lieu de travail

                <?php } ?>

                 <span style="color:red">*</span></td>

                 <td><select id="lieu1" name="lieu" style="width:510px"

                 title="Lieu de travail" required/>

                        <option value="" selected="selected"></option>

                         <?php 

                         if($_SESSION['r_prm_region_off']==0){ 

                            $req_lieu = mysql_query("SELECT * FROM prm_region");

                            while ($localisation = mysql_fetch_array($req_lieu)) {

                             $lieu_id = $localisation['id_region'];

                             $lieu_desc = $localisation['nom_region'];

                             if ($lieu_id == $id_lieu)

                                 $selected = 'selected';

                             else

                                 $selected = '';

                             echo "<option value=\"$lieu_id\" " . $selected . ">$lieu_desc</option>";

                         

                            }

                         }else{ 

                            $req_lieu = mysql_query("SELECT * FROM prm_villes");

                            while ($localisation = mysql_fetch_array($req_lieu)) {

                             $lieu_id = $localisation['id_vill'];

                             $lieu_desc = $localisation['ville'];

                             if ($lieu_id == $id_lieu)

                                 $selected = 'selected';

                             else

                                 $selected = '';

                             echo "<option value=\"$lieu_id\" " . $selected . ">$lieu_desc</option>";

                            }

                          } ?>

                         

                     </select>  

                 </td>

             </tr>

            

             <tr>

                 <td valign="top">Mobilité géographique <span style="color:red">*</span></td>

                 <td style="font-size: 11px;"><input name="mobilite" type="radio" value="oui" onclick="javascript:display()" style="width:20px;border:none" <?php if ($mobilite == 'oui') echo 'checked'; ?>/>

                     Oui

                     <input  name="mobilite" type="radio" value="non" onclick="javascript:hide()" style="width:20px;border:none" <?php if ($mobilite == 'non') echo 'checked'; ?> />

                     Non

                     

                                      

                     <ul id="zone" style="display:<?php if ($mobilite == 'oui') echo 'inline'; else echo 'none'; ?>;list-style-type:none;list-style-image:none">

                           <li >Au niveau :   

           <?php

                $i=0;

            $req1_mobi = mysql_query("SELECT * FROM prm_mobi_niv");

            while ($mobi_n1 = mysql_fetch_array($req1_mobi)) {

          $mobin_id = $mobi_n1['id_mobi_niv'];          $mobi_n = $mobi_n1['niveau'];

          if ((isset($niveau) and $mobin_id == $niveau) or ( $i==0))

            $selected = 'checked';

          else

            $selected = '';

          echo '<input name="niveau" type="radio" value="'.$mobin_id .'" style="width: 20px;" '. $selected .' /> '.$mobi_n;       

                $i++;

            }

            ?>    

                             </li>

                           <li style="list-style-type: none;"> Taux de mobilité: 

           <?php

                $i=0;

            $req2_mobi = mysql_query("SELECT * FROM prm_mobi_taux");

            while ($mobi_t2 = mysql_fetch_array($req2_mobi)) {

          $mobit_id = $mobi_t2['id_mobi_taux'];         $mobi_t = $mobi_t2['taux'];

          if ((isset($taux) and $mobit_id == $taux) or ( $i==0))

            $selected = 'checked';

          else

            $selected = '';

          echo '<input name="taux" type="radio" value="'.$mobit_id .'" style="width: 20px;" '. $selected .' /> '.$mobi_t;

                $i++;

            }

            

            ?>   

                             

                             </li>

                        </ul>

         

                     </td>

             </tr>

             

             <tr>

                 <td width="169">Date d’expiration </td>

                 <td width="503">

                 <input id="date_expiration"  type="text" name="date_expiration"   maxlength="10" style="width:504px" pattern="\d{1,2}/\d{1,2}/\d{4}" /></td>

             </tr>

              <?php



	if($_SESSION['r_prm_offr_email']==0){ 

              ?>

			  

              <tr>

                 <td width="169">Email :</td>

                 <td width="503">

                 <input id="contact_email"   placeholder="Email"

                 name="contact_email"  style="width:504px" type="email" /></td>

             </tr>

             

              <?php

	}



	if($_SESSION['r_prm_offr_up_img']==0){

	 

              ?>

              

              <tr>

                 <td width="169">Photo :</td>

                 <td width="503">

                 <input type="file" id="photo_offre"  name="photo_offre"  style="width:504px"  /></td>

             </tr>


            <tr>
                <td colspan="2">
                    <div class="subscription" style="margin: 10px 0 5px;">
                        <h1>Avis de concours</h1>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="file" id="avis_concours" name="avis_concours" /></td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="subscription" style="margin: 10px 0 5px;">
                        <h1>Décisions de recrutement</h1>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="file" id="decisions_recrutement" name="decisions_recrutement" /></td>
            </tr>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="subscription" style="margin: 10px 0 5px;">
                        <h1>Liste des candidats convoqués</h1>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="file" id="candidats_convoques" name="candidats_convoques" /></td>
            </tr>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="subscription" style="margin: 10px 0 5px;">
                        <h1>Résultats des concour</h1>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="file" id="resultats_concours" name="resultats_concours" /></td>
            </tr>

            <?php \App\Event::trigger('after_offre_fields'); ?>
            

              <?php 

	}

              ?>

<?php



	if($_SESSION['r_prm_note']==0){

	 //include ("./ajouter_offre_m_note.php"); 

	}

 

 ?>



        <tr><td colspan="2"><div class="ligneBleu"></div></td></tr>

         </table>



         <p style="color:#CC0000">P.S: les champs marqués par (*) sont obligatoires<br/>

             <input id="envoi1" class="espace_candidat" name="envoi" type="submit" value="Enregistrer" style="width:170px"  onclick="valider();" />

             <input class="espace_candidat" name="" type="reset" style="width:170px"/>

         </p>