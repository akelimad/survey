<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">



































<table  width="100%">



    <td  width="30%">



        <table width="100%" border="0">



            <tr>



<td  >Rechercher par mot clé            <label>



        <input  type="text" name="motcle" style="width:185px" value="<?php if (!empty($_SESSION["cs_motcle"])) echo $_SESSION["cs_motcle"]; ?>" maxlength="100" />



    </label></td>

 

            </tr>



            <tr>



<td colspan="2">







    <label>Secteur d’activité</label><br />







          <select name="secteur" >



          <option value="" selected="selected" ></option>

                        <?php

                        $req_theme = mysql_query("SELECT * FROM prm_sectors");

                        while ($data = mysql_fetch_array($req_theme)) {

                        $Sector_id = $data['id_sect'];

                        $Sector = $data['FR'];

                        ?>

<option value="<?php echo $Sector_id; ?>" <?php if (isset($_SESSION["cs_secteur"]) and $_SESSION["cs_secteur"] == $Sector_id) echo ' selected="selected"'; ?>>

<?php echo $Sector; ?></option>

<?php

                        }

                        ?>

          </select>       </td>























            </tr>























            <tr>







<td>







    <label>Années d'expérience</label><br />







<select name="exp">



          <option value=""></option>

                                                            <?php

                                                            $req_exp = mysql_query("SELECT * FROM prm_experience");

                                                            while ($exp = mysql_fetch_array($req_exp)) {

                                                            $exp_id = $exp['id_expe'];

                                                            $exp_desc = $exp['intitule'];

                        ?>

<option value="<?php echo $exp_id; ?>" <?php if (isset($_SESSION["cs_exp"]) and $_SESSION["cs_exp"] == $exp_id) echo ' selected="selected"'; ?>>

<?php echo $exp_desc; ?></option>

<?php

                                                            }

                                                            ?>



          </select>          </td>















            </tr>















            <tr>







<td>







    <label>Niveau d'étude</label><br />







<select name="formation">



            <option value="" selected="selected"></option>

     <?php

        $req_nf = mysql_query( "SELECT * FROM prm_niv_formation");

            while ( $nf = mysql_fetch_array( $req_nf ) ) {

                $nf_id = $nf['id_nfor'];

                $nf_desc = $nf['formation'];

                        ?>

<option value="<?php echo $nf_id; ?>" <?php if (isset($_SESSION["cs_formation"]) and $_SESSION["cs_formation"] == $nf_id) echo ' selected="selected"'; ?>>

<?php echo $nf_desc; ?></option>

<?php

            }

    ?> 

          </select>           </td>















            </tr>















        </table>















    </td>































    <td  width="30%">







        <table>







            <tr>

         





 <td  >Type de stage            <label><br>



       





    <select name="typestage" id="typestage">

        <option></option>

        <option value="stage observation"     <?php if (isset($_SESSION["cs_typestage"]) and $_SESSION["cs_typestage"]=="stage observation") echo 'selected="selected"'; ?>    >Stage d'observation</option>

        <option value="stage operationnel"  <?php if (isset($_SESSION["cs_typestage"]) and $_SESSION["cs_typestage"]=="stage operationnel") echo 'selected="selected"'; ?>   >Stage Op&eacute;rationnel </option>

        <option value="stage de fin detudes"  <?php if (isset($_SESSION["cs_typestage"]) and $_SESSION["cs_typestage"]=="stage de fin detudes") echo 'selected="selected"'; ?>   >Stage de fin d'&eacute;tudes</option>

    </select>



    </label></td>

   







    </tr>







    <tr>







        <td><label>Fraicheur du CV</label><br />







            <select name="fraicheur" id="fraicheur">







<option value=""></option>







<option value="30" <?php if (isset($_SESSION["cs_fraicheur"]) and $_SESSION["cs_fraicheur"] == "30") echo ' selected="selected"'; ?>>1 mois</option>







<option value="90" <?php if (isset($_SESSION["cs_fraicheur"]) and $_SESSION["cs_fraicheur"] == "90") echo ' selected="selected"'; ?>>3 mois</option>







<option value="180" <?php if (isset($_SESSION["cs_fraicheur"]) and $_SESSION["cs_fraicheur"] == "180") echo ' selected="selected"'; ?>>6 mois</option>







<option value="360" <?php if (isset($_SESSION["cs_fraicheur"]) and $_SESSION["cs_fraicheur"] == "360") echo ' selected="selected"'; ?>>12 mois</option>







            </select></td>







    </tr>





   <tr>







   <td  >Durée de stage           <label><br>



   



         <select name="duree_stage" id="duree_stage">

<<option></option>

      <option value="1 mois"    <?php if (isset($_SESSION["cs_duree_stage"]) and $_SESSION["cs_duree_stage"]=="1 mois") echo 'selected="selected"'; ?>   >1 mois</option>

      <option value="2 mois" <?php if (isset($_SESSION["cs_duree_stage"]) and $_SESSION["cs_duree_stage"]=="2 mois") echo 'selected="selected"'; ?>  >2 mois</option>

      <option value="3 mois" <?php if (isset($_SESSION["cs_duree_stage"]) and $_SESSION["cs_duree_stage"]=="3 mois") echo 'selected="selected"'; ?> >3 mois</option>

      <option value="4 mois" <?php if (isset($_SESSION["cs_duree_stage"]) and $_SESSION["cs_duree_stage"]=="4 mois") echo 'selected="selected"'; ?> >4 mois</option>

      <option value="5 mois" <?php if (isset($_SESSION["cs_duree_stage"]) and $_SESSION["cs_duree_stage"]=="5 mois") echo 'selected="selected"'; ?> >5 mois</option>

      <option value="6 mois" <?php if (isset($_SESSION["cs_duree_stage"]) and $_SESSION["cs_duree_stage"]=="6 mois") echo 'selected="selected"'; ?> >6 mois</option>

      <option value="12 mois" <?php if (isset($_SESSION["cs_duree_stage"]) and $_SESSION["cs_duree_stage"]=="12 mois") echo 'selected="selected"'; ?> >12 mois</option>

    </select>



    </label></td>







        </tr>







    <tr>







        <td colspan="3">







            <label>Ecole ou établissement</label><br />







<select name="etablissement" >



          <option value=""></option>

                      <?php 

                      $select_ecole = mysql_query("SELECT * FROM prm_ecoles");

                      while($ecole = mysql_fetch_array($select_ecole))

                      {

                        ?>

<option value="<?php echo $ecole['id_ecole']; ?>" <?php if (isset($_SESSION["cs_etablissement"]) and $_SESSION["cs_etablissement"] == $ecole['id_ecole']) echo ' selected="selected"'; ?>>

<?php echo $ecole['nom_ecole']; ?></option>

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

            <tr><td><br/><br/></td></tr>

      <tr>







            <td>







<label>Situation actuelle</label><br />







    <select name="situation">



            <option value=""></option>

                        <?php 

                      $select_sa = mysql_query("SELECT * FROM prm_situation");

                      while($sa = mysql_fetch_array($select_sa))

                      {

                        ?>

<option value="<?php echo $sa['id_situ']; ?>" <?php if (isset($_SESSION["cs_situation"]) and $_SESSION["cs_situation"] == $sa['id_situ']) echo ' selected="selected"'; ?>>

<?php echo $sa['situation']; ?></option>

<?php

                      }        

                      ?>  

          </select>           </td>







            <td></td>







        </tr>







        <tr>







            <td>







<label>Type de formation</label><br />







<select name="type_formation" >

<option value="" selected="selected"></option>

      <?php 

      $select_tf = mysql_query("SELECT * FROM prm_type_formation");

      while($tf = mysql_fetch_array($select_tf))

      {

                                ?>

<option value="<?php echo $tf['id_tfor']; ?>" <?php if (isset($_SESSION["cs_type_formation"]) and $_SESSION["cs_type_formation"] ==$tf['id_tfor']) echo ' selected="selected"'; ?>>

<?php echo $tf['formation']; ?></option>

<?php   

      }      

      ?> 

</select>           </td>







            <td>          </td>







        </tr>







        <tr>







            <td>







<label>Pays de résidence</label><br />









               <select name="pays">



          <option value=""></option>



         <?php



            $req_pays = mysql_query( "SELECT * FROM prm_pays");



                while ( $pays = mysql_fetch_array( $req_pays ) ) {



                    $pays_id = $pays['id_pays'];



                    $pays_desc = $pays['pays'];



                         ?>

<option value="<?php echo $pays_id; ?>" <?php if (isset($_SESSION["cs_pays"]) and $_SESSION["cs_pays"] == $pays_id) echo ' selected="selected"'; ?>>

<?php echo $pays_desc; ?></option>

<?php



                }



        ?>



          </select>          </td>







        </tr>















        </table>







        </td>













        </table>





















<br>

        <input class="espace_candidat" type="submit" name="envoi" value="Filtrer" /> 







        <input class="espace_candidat" type="submit" name="Actualiser" OnClick="javascript:window.location.reload()" value="Actualiser">    





<div class="ligneBleu"></div><br/> 









            </form>