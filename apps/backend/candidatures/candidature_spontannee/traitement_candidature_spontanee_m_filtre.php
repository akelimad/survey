<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">



































                                <table  width="100%">



                                    <td  width="30%">



                                        <table width="100%" border="0">



                                            <tr>



                                                <td  >Par mot cl?           <label><br/>



<input  type="text" name="motcle" style="width:185px" value="<?php if (!empty($_SESSION['cp_motcle'])) echo $_SESSION['cp_motcle']; ?>" maxlength="100" />



                                                    </label></td>



                                 

                                              







                                            </tr>



                                            <tr>



                                                <td colspan="2">







                                                    <label>Par secteur d?activit?/label><br />





<select name="secteur" >



          <option value="" selected="selected" ></option>

                        <?php

                        $req_theme = mysql_query("SELECT * FROM prm_sectors");

                        while ($data = mysql_fetch_array($req_theme)) {

                        $Sector_id = $data['id_sect'];

                        $Sector = $data['FR'];

                        ?>

<option value="<?php echo $Sector_id; ?>" <?php if (isset($_SESSION['cp_secteur']) and $_SESSION['cp_secteur'] == $Sector_id) echo ' selected="selected"'; ?>>

<?php echo $Sector; ?></option>

<?php

                        }

                        ?>

          </select>       </td>























                                            </tr>

											<tr>

											

											

											<td width="30%">

<label>Par fonction</label><br />

<select name="fonction" >

<option value="" selected="selected"></option>

                        <?php

                        $req_fonction = mysql_query("SELECT * FROM prm_fonctions");

                        while ($fonc = mysql_fetch_array($req_fonction)) {

                        $Fonct_id = $fonc['id_fonc'];

                        $Fonction = $fonc['fonction'];

                        ?>

<option value="<?php echo $Fonct_id; ?>" <?php if (isset($_SESSION['cp_fonction']) and $_SESSION['cp_fonction'] == $Fonct_id) echo ' selected="selected"'; ?>>

<?php echo $Fonction; ?></option>

<?php

                        }

        ?>

</select>

</td>

											</tr>























                                            <tr>







                                                <td>







                                                    <label>Par ann? d'exp?ience</label><br />





<select name="exp">



          <option value=""></option>

                                                            <?php

                                                            $req_exp = mysql_query("SELECT * FROM prm_experience");

                                                            while ($exp = mysql_fetch_array($req_exp)) {

                                                            $exp_id = $exp['id_expe'];

                                                            $exp_desc = $exp['intitule'];

                        ?>

<option value="<?php echo $exp_id; ?>" <?php if (isset($_SESSION['cp_exp']) and $_SESSION['cp_exp'] == $exp_id) echo ' selected="selected"'; ?>>

<?php echo $exp_desc; ?></option>

<?php

                                                            }

                                                            ?>



          </select>        </td>















                                            </tr>















                                            <tr>







                                                <td>







  </td>















                                            </tr>















                                        </table>















                                    </td>































                                    <td  width="30%">







                                        <table>







                                            <tr>

                         



<td>

        <label>Par pays de r?idence</label><br />







               <select name="pays">



          <option value=""></option>



         <?php



            $req_pays = mysql_query( "SELECT * FROM prm_pays order by pays asc");



                while ( $pays = mysql_fetch_array( $req_pays ) ) {



                    $pays_id = $pays['id_pays'];



                    $pays_desc = $pays['pays'];



                         ?>

<option value="<?php echo $pays_id; ?>" <?php if (isset($_SESSION['cp_pays']) and $_SESSION['cp_pays'] == $pays_id) echo ' selected="selected"'; ?>>

<?php echo $pays_desc; ?></option>

<?php



                }



        ?>



          </select>         



</td>

                                                   







        </tr>







        <tr>







            <td><label>Par fraicheur du CV</label><br />







                <select name="fraicheur" id="fraicheur">







                    <option value=""></option>







                    <option value="30" <?php if (isset($_SESSION['cp_fraicheur']) and $_SESSION['cp_fraicheur'] == "30") echo ' selected="selected"'; ?>>Moins de 1 mois</option>







                    <option value="90" <?php if (isset($_SESSION['cp_fraicheur']) and $_SESSION['cp_fraicheur'] == "90") echo ' selected="selected"'; ?>>Moins de 3 mois</option>







                    <option value="180" <?php if (isset($_SESSION['cp_fraicheur']) and $_SESSION['cp_fraicheur'] == "180") echo ' selected="selected"'; ?>>Moins de 6 mois</option>







                    <option value="360" <?php if (isset($_SESSION['cp_fraicheur']) and $_SESSION['cp_fraicheur'] == "360") echo ' selected="selected"'; ?>>Moins de 12 mois</option>







                </select></td>







        </tr>





   <tr>







                       <td  >





 <label>Par ?ole ou ?ablissement</label><br />





   

<select name="etablissement" >



          <option value=""></option>

                      <?php 

                      $select_ecole = mysql_query("SELECT id_ecole,nom_ecole,pays FROM prm_ecoles a, prm_pays b

where a.id_pays = b.id_pays ");

                      while($ecole = mysql_fetch_array($select_ecole))

                      {

                        ?>

<option value="<?php echo $ecole['id_ecole']; ?>" <?php if (isset($_SESSION['cp_etablissement']) and $_SESSION['cp_etablissement'] == $ecole['id_ecole']) echo ' selected="selected"'; ?>>

<?php echo $ecole['nom_ecole']." || ".$ecole['pays']; ; ?></option>

<?php

                      }        

                      ?> 



          </select> 





                       </td>







        </tr>

		

		<tr>

		    <td  width="30%">

	    <label>Par age</label> <br />

        <select name="age">

   <option value="" > </option>

<?php   $rq_age = mysql_query( " SELECT * FROM  prm_age ");                

        while ( $lage = mysql_fetch_array( $rq_age ) ) {                       

                $age_id = $lage['id_age'];      

				$age_interval = $lage['intervale_age'];        

                                ?>

<option value="<?php echo $age_id; ?>" <?php if (isset($_SESSION['cp_age']) and $_SESSION['cp_age'] == $age_id) echo ' selected="selected"'; ?>>

<?php echo $age_interval; ?></option>

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

                      $select_sa = mysql_query("SELECT * FROM prm_situation");

                      while($sa = mysql_fetch_array($select_sa))

                      {

                        ?>

<option value="<?php echo $sa['id_situ']; ?>" <?php if (isset($_SESSION['cp_situation']) and $_SESSION['cp_situation'] == $sa['id_situ']) echo ' selected="selected"'; ?>>

<?php echo $sa['situation']; ?></option>

<?php

                      }        

                      ?>  

          </select>         </td>







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

<option value="<?php echo $tf['id_tfor']; ?>" <?php if (isset($_SESSION['cp_type_formation']) and $_SESSION['cp_type_formation'] ==$tf['id_tfor']) echo ' selected="selected"'; ?>>

<?php echo $tf['formation']; ?></option>

<?php   

      }      

      ?> 

</select>         </td>







      







        </tr>







        <tr>







            <td>





  <label>Par niveau d'?ude</label><br />





<select name="formation">



            <option value="" selected="selected"></option>

     <?php

        $req_nf = mysql_query( "SELECT * FROM prm_niv_formation");

            while ( $nf = mysql_fetch_array( $req_nf ) ) {

                $nf_id = $nf['id_nfor'];

                $nf_desc = $nf['formation'];

                        ?>

<option value="<?php echo $nf_id; ?>" <?php if (isset($_SESSION['cp_formation']) and $_SESSION['cp_formation'] == $nf_id) echo ' selected="selected"'; ?>>

<?php echo $nf_desc; ?></option>

<?php

            }

    ?> 

          </select> 

             </td>







        </tr>

		

		<tr>

		<td width="30%">

<label>Par sexe</label><br />

<select name="sexe">

<option value=""></option>

<option value="1" <?php if (isset($_SESSION['cp_sexe']) and $_SESSION['cp_sexe'] == "1") echo ' selected="selected"'; ?>>Homme</option>

<option value="2" <?php if (isset($_SESSION['cp_sexe']) and $_SESSION['cp_sexe'] == "2") echo ' selected="selected"'; ?>>Femme</option>

</select>

    </td>

		</tr>















        </table>







        </td>













                        





  







          </td>







          </tr>







</table>







        







        </td>









































       </tr>

       <tr>

         <td>

        <label>Par ville</label><br />

<select name="ville">

<option value=""></option>

<?php

$req_pays = mysql_query( "SELECT * FROM prm_villes order by ville asc");

while ( $pays = mysql_fetch_array( $req_pays ) ) {

$id_vill = $pays['id_vill'];

$ville = $pays['ville'];

?>

<option value="<?php echo $ville; ?>" 

<?php if (isset($_SESSION['cp_ville']) and $_SESSION['cp_ville'] == $ville) echo ' selected="selected"'; ?>>

<?php echo $ville; ?></option>

<?php

}

?>

</select><br />    

</td>

       </tr>



        </table>

<br/> 

        <input  type="submit" class="espace_candidat" name="envoi" value="Filtrer" /> 

        <input type="submit" class="espace_candidat" name="actualiser" OnClick="javascript:window.location.reload()" value="Actualiser">    

        <div class="ligneBleu"></div><br/> 

            </form>