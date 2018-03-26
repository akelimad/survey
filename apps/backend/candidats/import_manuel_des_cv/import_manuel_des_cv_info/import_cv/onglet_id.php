

                        <div style="float:left; ">



                            <table>

							

									<tr>

										<td style="width: 180px;"><label>E-mail du candidat  </label></td>

										<td><input type="text" id="email0" name="email1"  value="<?php echo $pass[1]; ?>"  style="font-size:12px;width:215px;"></td>

									</tr>

  



                                    <tr><td><br></td></tr>

									

                                    <tr>



                                        <td><label>Titre de profil </label>



                                        </td><td>

 

											<input type="text" id="titre"  title="Veuillez entrez le titre de profil" name="titre" style="font-size:12px;width:215px;" value="<?php if(isset($titre)) echo $titre; ?>"  maxlength="50"  />



                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>

									

                                    <tr>



                                        <td width="49%"><label>Civilit&eacute; </label>



                                        </td><td >



                                            <select name="civilite"   style="font-size:12px;width: 214px;">



                                            <option value=""></option>



                                              <?php         $req_ci = mysql_query( "SELECT * FROM prm_civilite");               



                                              while ( $ci = mysql_fetch_array( $req_ci ) ) {                    



                                              $ci_id = $ci['id_civi'];                  



                                              $ci_desc = $ci['civilite'];                   



                                                  if(isset($civilite) and $civilite==$ci_id){                   



                                                  echo '<option value="'.$ci_id.'" selected="selected">'.$ci_desc.'</option>';



                                                  }     else    {                   



                                                  echo '<option value="'.$ci_id.'">'.$ci_desc.'</option>';                  



                                                  }



                                              }     



                                              ?></select>



                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>



                                    <tr>



                                        <td><label>Nom </label>



                                        </td><td>



                                            <input   type="text" id="nom" name="nom" value="<?php echo $pass[4];?>"   style="font-size:12px;width:215px;"/>



                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>



                                    <tr>



                                        <td><label>Pr&eacute;nom </label>



                                        </td><td>



                                            <input   type="text" id="prenom" name="prenom"  value="<?php echo $pass[5];?>"   style="font-size:12px;width:215px;"/>



                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>



                                    <tr>



                                        <td ><label>Adresse </label>



                                        </td><td>



                                            <input   type="text" name="adresse" value="<?php if(isset($adresse)) echo $adresse; ?>"   style="font-size:12px;width:215px;"/>



                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>



                                    <tr>



                                        <td><label>Code postal </label>



                                        </td><td>



                                            <input   type="text" name="code" value="<?php if(isset($code)) echo $code; ?>"   style="font-size:12px;width:215px;"/>



                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>



                                    <tr>



                                        <td><label>Ville </label>



                                        </td><td>

 

										   <select id="ville" name="ville" placeholder="Ville candidat " title="Veuillez selectionnez votre ville"  style="font-size:12px;width:214px;" >

														  <option value=""></option>

														  <?php     $req_ville = mysql_query( "SELECT * FROM prm_villes");        

												  while ( $ville1 = mysql_fetch_array( $req_ville ) ) {         

												  $pays_id = $ville1['id_vill'];          $ville_desc = $ville1['ville'];         

												  if(isset($ville) and $ville==$ville_desc)         {         

												  echo '<option value="'.$ville_desc.'" selected="selected">'.$ville_desc.'</option>';          }         

												  else          {         echo '<option value="'.$ville_desc.'">'.$ville_desc.'</option>';          }             }   ?>

											</select>

											

                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>



                                    <tr>



                                        <td><label>Pays de r&eacute;sidence </label>



                                        </td><td>



                                            <select name="pays"   style="font-size:12px;width: 214px;" >



                                              <option value=""></option>



                                              <?php         $req_pays = mysql_query( "SELECT * FROM prm_pays ORDER BY pays Asc");               while ( $pays1 = mysql_fetch_array( $req_pays ) ) {                 $pays_id = $pays1['id_pays'];                   $pays_desc = $pays1['pays'];                    if(isset($pays) and $pays==$pays_id)                    {                   echo '<option value="'.$pays_id.'" selected="selected">'.$pays_desc.'</option>';                    }                   else                    {                   echo '<option value="'.$pays_id.'">'.$pays_desc.'</option>';                    }               }       ?>



                                            </select>



                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>



                                    <tr>



                                        <td><label>Date de naissance </label>



                                        </td><td>



                                        <input   id="calendar" name="date"  value="<?php if(isset($date)) echo $date; ?>"   style="font-size:12px;width:215px;"/><?php //echo $pass[2]; ?>



                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>



                                    <tr>



                                        <td><label>Nationalit&eacute; </label>



                                        </td><td>



                                            <input   name="nationalite" type="text" value="<?php if(isset($nationalite)) echo $nationalite; ?>"   style="font-size:12px;width:215px;"/>



                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>



                                    <tr>



                                        <td><label>T&eacute;l&eacute;phone </label>



                                        </td><td>



                                            <input   name="tel1" type="text" value="<?php $string = str_replace(' ', '', $pass[3]);echo $string; ?>"   style="font-size:12px;width:215px;"/>



                                        </td>



                                    </tr>



                                    <tr><td><br></td></tr>



                                    <tr>



                                        <td><label>T&eacute;l&eacute;phone secondaire</label>



                                        </td><td>



                                            <input name="tel2" type="text" value="<?php if(isset($tel2)) echo $tel2; ?>"   style="font-size:12px;width:215px;"/>



                                        </td>



                                    </tr>



                            </table>



                        </div>



						

						

						

						

						

						

						<!--

						

						

						





















<table  width="100%" border="0">



<tr>

     <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

  <h1>Intitul&eacute; du profil </h1> 

  </div></td>

</tr>

 

 <tr>

     <td><label>Titre de votre profil  </label>

<font style="color:red;">*</font> <br />

<input id="titre"  type="text" placeholder="Titre de profil" title="Veuillez entrez le titre de profil" name="titre" style="width:200px" value="<?php if(isset($titre)){echo $titre;}  ?>"  maxlength="50" required/></td>



         

       

<td colspan="2">

         <br><a href="javascript:void(0)" class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>



     <em><span></span>  (exp:D&eacute;veloppeur informatique,Consultant SI,Chef de projet...) </em>



 </a>

</td>

                          

 </tr>      

      

      

            <tr>



              <td colspan="3"><div class="subscription" style="margin: 10px 0pt;">



                  <h1>&Eacute;tat civil </h1>



                </div></td>



            </tr>



            <tr>



              <td width="32%"><label>Civilit&eacute; </label>



                <font style="color:red;">*</font> <br />



                <select id="civilite" name="civilite" title="Veuillez selectionez votre civilité" required/>

        

             <option value=""></option>



                  <?php     $req_ci = mysql_query( "SELECT * FROM prm_civilite");       

          while ( $ci = mysql_fetch_array( $req_ci ) ) {          

          $ci_id = $ci['id_civi'];          

          $ci_desc = $ci['civilite'];         

            if(isset($civilite) and $civilite==$ci_id){         

            echo '<option value="'.$ci_id.'" selected="selected">'.$ci_desc.'</option>';

            }   else  {         

            echo '<option value="'.$ci_id.'">'.$ci_desc.'</option>';          

            }

          }   

          ?>



                </select></td>



              <td width="38%"><label>Nom </label>



                <font style="color:red;">*</font> <br />

<?php

$nom___v='';

 if(isset($nom)){$nom___v=$nom;} 

 elseif(isset($_SESSION['fb___nom'] )){$nom___v=$_SESSION['fb___nom'];} 

 ?>

                <input  type="text" placeholder="Nom candidat" title="Veuillez entrez votre nom" 

                id="nom" name="nom" value="<?php  echo $nom___v;  ?>" maxlength="30" required/></td>



              <td width="30%"><label>Prénom </label>



                <font style="color:red;">*</font> <br />

<?php 

$prenom___v='';

if(isset($prenom)){$prenom___v=$prenom;}

elseif(isset($_SESSION['fb___prenom'] )){$prenom___v=$_SESSION['fb___prenom'];} 

?>

                <input  type="text" placeholder="Prénom candidat" title="Veuillez entrez votre prénom"

                id="prenom" name="prenom"  value="<?php  echo $prenom___v; ?>" maxlength="30" required/>



              </td>



            </tr>



            <tr>



              <td colspan="2"><label>Adresse </label>



                <font style="color:red;">*</font> <br />



                <input  id="adresse"  type="text" placeholder="Adresse candidat" title="Veuillez entrez votre adresse"

                name="adresse" value="<?php if(isset($adresse)){echo $adresse;}?>" style="width:432px" maxlength="100" required/>



              </td>



              <td><label>Code postal </label> <br />



                <input id="code" type="text" placeholder="Code postal " title="Veuillez entrez votre code postal"

                name="code" value="<?php if(isset($code)){echo $code;}?>"  maxlength="30" /></td>



            </tr>



            <tr>



              <td><label>Ville </label>



                <font style="color:red;">*</font> <br />



                <select id="ville" name="ville" placeholder="Ville candidat " title="Veuillez selectionnez votre ville" required>



                  <option value=""></option>



                  <?php     $req_ville = mysql_query( "SELECT * FROM prm_villes");        

          while ( $ville1 = mysql_fetch_array( $req_ville ) ) {         

          $pays_id = $ville1['id_vill'];          $ville_desc = $ville1['ville'];         

          if(isset($ville) and $ville==$ville_desc)         {         

          echo '<option value="'.$ville_desc.'" selected="selected">'.$ville_desc.'</option>';          }         

          else          {         echo '<option value="'.$ville_desc.'">'.$ville_desc.'</option>';          }             }   ?>



                </select>

                 </td>



              <td><label>Pays de r&eacute;sidence </label>



                <font style="color:red;">*</font> <br />



                <select id="pays" name="pays" placeholder="Pays candidat " title="Veuillez selectionnez votre pays de résidence" required>



                  <option value="22">Maroc</option>



                  <?php     $req_pays = mysql_query( "SELECT * FROM prm_pays ORDER BY pays Asc");       

          while ( $pays1 = mysql_fetch_array( $req_pays ) ) {         

          $pays_id = $pays1['id_pays'];         $pays_desc = $pays1['pays'];          

          if(isset($pays) and $pays==$pays_id)          {         

          echo '<option value="'.$pays_id.'" selected="selected">'.$pays_desc.'</option>';          }         

          else          {         echo '<option value="'.$pays_id.'">'.$pays_desc.'</option>';          }             }   ?>



                </select></td>



              <td><label>Date de naissance </label>



                <font style="color:red;">*</font> <br />



                <input  id="calendar" name="date"  placeholder="Date de naissance " title="Veuillez entrez votre date de naissance"

                value="<?php if(isset($date)){echo $date;}?>"  placeholder="  01/01/1980  " required/>



              </td>



            </tr>



            <tr>



              <td><label>Nationalit&eacute; </label>



                <font style="color:red;">*</font> <br />



                <input id="nationalite" placeholder="Nationalité" title="Veuillez entrez votre nationalité"

                 name="nationalite" type="text" value="<?php if(isset($nationalite)){echo $nationalite;}?>"  maxlength="30" required/>



              </td>



              <td><label>T&eacute;l&eacute;phone </label>



                <font style="color:red;">*</font> <br />



                <input id="tel1" placeholder="exemple : 0623456789" title="Veuillez entrez votre numéro de téléphone"

                pattern="^((\+\d{1,4}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{5})(( x| ext)\d{1,5}){0,1}$"

                 name="tel1" type="tel" value="<?php if(isset($tel1)){echo $tel1;}  /*pattern="[\+]\d{3}[\(]\d{2}[\)]\d{4}[\-]\d{4}"  placeholder="(Format: +999(99)9999-9999)" */  ?>"  maxlength="20" required/>



              </td>



              <td><label>T&eacute;l&eacute;phone secondaire</label>



                <br />



                <input id="tel2" name="tel2" placeholder="exemple : 0623456789" title="Veuillez entrez votre numéro de téléphone secondaire"

                type="tel" value="<?php if(isset($tel2)){echo $tel2;}?>"  placeholder="  0623456789  " maxlength="20"/>



              </td>



            </tr>



            <tr>



              <td colspan="3"><div class="subscription" style="margin: 10px 0pt;">



                  <h1>Indentifiants </h1>



                </div></td>



            </tr>



            <tr>



              <td><label>Adresse E-mail </label>



                <font style="color:red;">*</font> <br />

<?php

$email___v='';

if(isset($email1)){$email___v=$email1;}

elseif(isset($_SESSION['fb___email'] )){$email___v=$_SESSION['fb___email'];} 

?>

                <input type="email" id="email0" placeholder="exemple@domaine.com" title="Veuillez entrez votre email"

                name="email1" value="<?php  echo $email___v; ?>"  style="width:200px"  placeholder="   me@example.com  " maxlength="50" required/></td>



              <td><label>Mot de passe </label>



                <font style="color:red;">*</font> <br />



                <input id="mdp1" placeholder="**********" 

                 title="Veuillez entrer le mot de passe" 

                 oninput="form.mdp2.pattern = escapeRegExp(this.value)"

                type="password" name="mdp1" style="width:198px"  maxlength="15" required/>

           <a href="javascript:void(0)" class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>



     <em><span></span>  Le mot de passe doit contenir entre 4 et 15 caractères et doit avoir au moins un chiffre et un caractère . </em>



 </a></td>



              <td><label>Confirmation mot de passe </label>



                <font style="color:red;">*</font> <br />



                <input id="mdp2" placeholder="**********" 

                pattern="" title="Veuillez retapez le mot de passe" 

                type="password" name="mdp2" style="width:200px"  maxlength="15" required /></td>



            </tr>

<script>

    function escapeRegExp(str) {

      return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");

    }

</script>

            <tr>



              <td colspan="3"><div class="subscription" style="margin: 10px 0pt;">



                  <h1>Profil </h1>



                </div></td>



            </tr>



            <tr>



              <td><label>Situation actuelle </label>



                <font style="color:red;">*</font> <br />



                <select id="situation" name="situation" title=" Votre situation actuelle " required>

            <option value=""></option>

                  <?php     $req_si = mysql_query( "SELECT * FROM prm_situation");        

          while ( $si = mysql_fetch_array( $req_si ) ) {          

          $si_id = $si['id_situ'];          

          $si_desc = $si['situation'];          

            if(isset($civilite) and $situation==$si_id){          

            echo '<option value="'.$si_id.'" selected="selected">'.$si_desc.'</option>';

            }   else  {         

            echo '<option value="'.$si_id.'">'.$si_desc.'</option>';          

            }

          }   

          ?>

                </select></td>



              <td><label>Domaine    </label>



                <font style="color:red;">*</font> <br />



                <select id="domaine" name="domaine" title=" Votre domaine " required/>



                  <option value="" ></option>



                  <?php $req_theme = mysql_query( "SELECT * FROM prm_sectors"); 

          while ( $data = mysql_fetch_array( $req_theme ) ) {   

          $Sector_id = $data['id_sect'];    $Sector = $data['FR'];    

          if(isset($domaine) and $domaine==$Sector_id){   echo '<option value="'.$Sector_id.'" selected="selected">'.$Sector.'</option>';   }   

          else    {   echo '<option value="'.$Sector_id.'">'.$Sector.'</option>';   } }?>



                </select>



              </td>



              <td><label>Fonction </label>

          <font style="color:red;">*</font> <br />

          <select id="fonction" title=" Votre fonction "  name="fonction" required/>

            <option value="" selected="selected"></option>

            <?php

            $req3_theme = mysql_query("SELECT * FROM prm_fonctions");

            while ($data3 = mysql_fetch_array($req3_theme)) {

          $fonc_id = $data3['id_fonc'];

          $fonc = $data3['fonction'];

          if (isset($fonction) and $fonc_id == $fonction)

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



             



              <td><label>Salaire souhaité </label>



                <font style="color:red;">*</font> <br />



                <select id="salaire" name="salaire" title=" Votre salaire souhaité " required/>



                  <option value=""></option>



                  <?php     $req_salaire = mysql_query( "SELECT * FROM prm_salaires");        

          while ( $salaire1 = mysql_fetch_array( $req_salaire ) ) {         

          $salaire_id = $salaire1['id_salr'];         $salaire_desc = $salaire1['salaire'];         

          if(isset($salaire) and $salaire==$salaire_id )          {       

          echo '<option value="'.$salaire_id.'" selected="selected">'.$salaire_desc.'</option>';          }         else          {         echo '<option value="'.$salaire_id.'">'.$salaire_desc.'</option>';          }                       }   ?>



                </select></td>



              <td><label>Niveau de formation </label>



                <font style="color:red;">*</font> <br />



                <select id="formation" name="formation" title=" Votre niveau de formation"  required/>

          <option value=""></option>



                  <?php     $req_niv_formation = mysql_query( "SELECT * FROM prm_niv_formation");       

          while ( $niv_formation = mysql_fetch_array( $req_niv_formation ) ) {          

          $formation_id = $niv_formation['id_nfor'];          

          $formation_desc = $niv_formation['formation'];          

            if(isset($formation) and $formation==$formation_id )          {         

            echo '<option value="'.$formation_id.'" selected="selected">'.$formation_desc.'</option>';          }         

            else          {         

            echo '<option value="'.$formation_id.'">'.$formation_desc.'</option>';          

            }                       

          }   ?>





                </select></td>



              <td><label>Type de formation </label>



                <font style="color:red;">*</font> <br />



                <select id="type_formation" name="type_formation" title=" Votre type de formation" required/>

                <option value=""></option>



                  <?php     $req_typ_formation = mysql_query( "SELECT * FROM prm_type_formation");       

          while ( $typ_formation = mysql_fetch_array( $req_typ_formation ) ) {          

          $t_formation_id = $typ_formation['id_tfor'];          

          $t_formation_desc = $typ_formation['formation'];          

            if(isset($type_formation) and $type_formation==$t_formation_id )          {         

            echo '<option value="'.$t_formation_id.'" selected="selected">'.$t_formation_desc.'</option>';          }         

            else          {         

            echo '<option value="'.$t_formation_id.'">'.$t_formation_desc.'</option>';          

            }                       

          }   ?>



                </select>



              </td>



            



            </tr>

      <tr>

           <td><label>Disponibilité</label>

          <font style="color:red;">*</font><br />

          <select  id="dispo" title=" Votre disponibilité"  name="dispo" required/>

            <option value="" selected="selected"> </option>

            <?php

            $req2_theme = mysql_query("SELECT * FROM prm_disponibilite");

            while ($data2 = mysql_fetch_array($req2_theme)) {

          $dispo_id = $data2['id_dispo'];

          $dispo_int = $data2['intitule'];

          if (isset($dispo) and $dispo_id == $dispo)

            $selected = 'selected';

          else

            $selected = '';

          echo "<option value=\"$dispo_id\" " . $selected . ">$dispo_int</option>";

            }

            ?>

            

          </select>

         </td>

           <td ><label>Exp&eacute;rience </label>



                <font style="color:red;">*</font> <br />



                <select id="exp" name="exp" title=" Votre expérience" required/>



                  <option value=""></option>



                  <?php     $req_exp = mysql_query( "SELECT * FROM prm_experience");        

          while ( $exp1 = mysql_fetch_array( $req_exp ) ) {         

          $exp_id = $exp1['id_expe'];         $exp_desc = $exp1['intitule'];          

          if(isset($exp) and $exp==$exp_id){          

          echo '<option value="'.$exp_id.'" selected="selected">'.$exp_desc.'</option>';          }         

          else          {         echo '<option value="'.$exp_id.'">'.$exp_desc.'</option>';          }             }   ?>



                </select>

         </td>

      </tr>



       <tr>

         <td colspan="4"><br><label>Mobilité géographique </label>

      <input name="mobilite" title=" Votre mobilité géographique" type="radio" value="oui" 

      onclick="document.getElementById('mobilite').style.display='inline'" style="width:20px" <?php if (isset($mobilite) AND $mobilite == 'oui') echo 'checked'; ?> />

      Oui

      <input name="mobilite" type="radio" value="non" checked="checked"

      onclick="document.getElementById('mobilite').style.display='none'" style="width:20px" <?php if (isset($mobilite) AND $mobilite == 'non') echo 'checked'; ?> />

      Non

      <ul id="mobilite" style="display:<?php if (isset($mobilite) AND $mobilite == 'oui') echo 'inline'; else echo 'none'; ?>;list-style:none;">

        <li style="list-style-type: none;"> Au niveau :   

           <?php

            $req1_mobi = mysql_query("SELECT * FROM prm_mobi_niv");

            while ($mobi_n1 = mysql_fetch_array($req1_mobi)) {

          $mobin_id = $mobi_n1['id_mobi_niv'];          $mobi_n = $mobi_n1['niveau'];

          if (isset($niveau) and $mobin_id == $niveau)

            $selected = 'checked';

          else

            $selected = '';

          echo '<input name="niveau" type="radio" value="'.$mobin_id .'" style="width: 20px;" '. $selected .' /> '.$mobi_n;

            }

            ?>

            

      </li>

        <li style="list-style-type: none;"> Taux de mobilité:

           <?php

            $req2_mobi = mysql_query("SELECT * FROM prm_mobi_taux");

            while ($mobi_t2 = mysql_fetch_array($req2_mobi)) {

          $mobit_id = $mobi_t2['id_mobi_taux'];         $mobi_t = $mobi_t2['taux'];

          if (isset($taux) and $mobit_id == $taux)

            $selected = 'checked';

          else

            $selected = '';

          echo '<input name="taux" type="radio" value="'.$mobit_id .'" style="width: 20px;" '. $selected .' /> '.$mobi_t;

            }

            ?>

            

      </li></ul>  </td>

       </tr>

       

                            

       

                                

                        

    

    





  

  

        

<!--  

==========================================================================================================================================  

========================================================================================================================================== 

-- > 





          </table>

		  

		  -->