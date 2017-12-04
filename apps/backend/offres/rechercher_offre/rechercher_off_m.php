<div class='texte' >

        <br/><h1>RECHERCHER DES OFFRES</h1>

<?php

if(isset($_POST["motcle"]) and $_POST["motcle"]!='')  $_SESSION["motcle"]=$_POST["motcle"];

if(isset($_POST["offre"]) and $_POST["offre"]!='')  $_SESSION["offre"]=$_POST["offre"];

if(isset($_POST["intPoste"]) and $_POST["intPoste"]!='')  $_SESSION["intPoste"]=$_POST["intPoste"];

if(isset($_POST["poste"]) and $_POST["poste"]!='')  $_SESSION["poste"]=$_POST["poste"]; 

if(isset($_POST["statut"]) and $_POST["statut"]!='')  $_SESSION["statut"]=$_POST["statut"]; 

if(isset($_POST["lieu"]) and $_POST["lieu"]!='')  $_SESSION["lieu"]=$_POST["lieu"]; 

if(isset($_POST["p_envoi"]) and $_POST["p_envoi"]!='')  $_SESSION["p_envoi"]=$_POST["p_envoi"]; 



////////////////////////////////////////

		 $id__s= (isset($_SESSION['id'])  ) ? $_SESSION['id'] : "" ;

		 

		 

                            if (isset($_POST['p_actualiser'])) {



                            $_SESSION['motcle']='';

                            $_SESSION['offre']='';

                            $_SESSION['intPoste']='';

                            $_SESSION['poste']='';

                            $_SESSION['statut']='';

                            $_SESSION['lieu']='';  



                            }



                            if (isset($_POST['send'])) {

                                $candidats = isset($_POST['select']) ? $_POST['select'] : "";

                               $affected = 0;

                                if (isset($_POST['select'])) {

                                    for ($i = 0; $i < count($candidats); $i++) {

                                        $id_candidat = $candidats[$i];

                                        $selecCV = mysql_query("select * from cv  where candidats_id='$id_candidat'  AND principal=1 AND actif=1");

                                        $councv = mysql_num_rows($selecCV);

                                        $result_cv = mysql_fetch_array($selecCV);

                                        if ($councv)

                                            $id_cv = $result_cv['id_cv'];

                                        else

                                            $id_cv = 0;



                                        $selectt = mysql_query("select * from archive_cvs where id_candidat='$id_candidat' ");

                                        $count = mysql_num_rows($selectt);

                                        if (!$count)

                                            $insert = mysql_query("INSERT INTO archive_cvs VALUES ('1','$id_candidat','$id_cv')");

                                        else

                                            $insert = mysql_query("UPDATE  archive_cvs SET id_cv = $id_cv  where  id_candidat = '$id_candidat' ");

                                        $affected += mysql_affected_rows();

                                    }

                                }

                              if ($affected > 0)

                                    echo '<h3>' . $affected . ' CV archivé(s) avec succès.</h3>';

                               else

                                    echo '<h3>0 CV archivé.</h3>';

                            }

                            ?>

<div class="subscription" style="margin: 10px 0pt;">



                                <h1>Options de recherche des offres </h1>



                            </div>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

                               <table  width="100%">

                                    <td  width="30%">

                                        <table width="100%" border="0">

                                           <tr>

<td colspan="2" >Par mot clé<label><br />



<input  type="text" name="motcle" style="width:185px" value="<?php if (!empty($_SESSION['motcle'])) echo $_SESSION['motcle']; ?>" maxlength="100" />

</label></td>

</tr>

<tr>

<td colspan="2">

<label>Par référence de l'offre</label><br />

<input  type="text" name="offre" style="width:185px"  maxlength="100" />

</td>

</tr>







</table>

</td>

<td  width="30%">

<table>

<tr>

<td>

<label>Par intitulé du poste</label><br />

<input  type="text" name="intPoste" style="width:185px" value="<?php if (!empty($_SESSION['intPoste'])) echo $_SESSION['intPoste']; ?>" maxlength="100" />

</td>

</tr>

<tr>

<td><label>Par type de poste</label><br />

<select name="poste" onchange="this.form.submit()">

<option value="<?php if (!empty($_SESSION['poste'])) echo $_SESSION['poste']; ?>"></option>

<?php

$req_poste = mysql_query("SELECT * FROM prm_type_poste");

while ($type_poste = mysql_fetch_array($req_poste)) {

$poste_id = $type_poste['id_tpost'];

$poste_desc = $type_poste['designation'];



?>

<option value="<?php echo $poste_id; ?>" <?php if (isset($_SESSION['poste']) and $_SESSION['poste'] == $poste_id) echo ' selected="selected"'; ?>><?php echo $poste_desc; ?></option>

<?php

}

?>

</select></td>

</tr>

 

</table>

</td>

   <td  width="30%">

 <table>

<tr>

<td>

 <label>Par statut</label><br />

<select name="statut" onchange="this.form.submit()">

<option value=""></option>

<option value="En cours" <?php if (isset($_SESSION['statut']) and $_SESSION['statut'] == "En cours") echo ' selected="selected"'; ?>>En cours</option>

<option value="Archivee" <?php if (isset($_SESSION['statut']) and $_SESSION['statut'] == "Archivee") echo ' selected="selected"'; ?>>Archivée</option>



</select>          </td>

<td></td>

</tr>

<tr>

<td>

<label>Par lieu de travail</label><br />

<select name="lieu" onchange="this.form.submit()">

<option value="<?php if (!empty($_SESSION['lieu'])) echo $_SESSION['lieu']; ?>"></option>

<?php

$req_lieu = mysql_query("SELECT * FROM prm_localisation");

while ($lieu = mysql_fetch_array($req_lieu)) {

$lieu_id = $lieu['id_localisation'];

$lieu_desc = $lieu['localisation']; 

?>

<option value="<?php echo $lieu_id; ?>" <?php if (isset($_SESSION['lieu']) and $_SESSION['lieu'] == $lieu_id) echo ' selected="selected"'; ?>><?php echo $lieu_desc; ?></option>

<?php

}

?>

</select>

</td>

<td>

</td>

</tr>

 </table> 

 </td> 

  </table>

  <br>

  <input class="espace_candidat" type="submit" name="p_envoi" value="Filtrer" /> 

<input class="espace_candidat" type="submit" name="p_actualiser" OnClick="javascript:window.location.reload()" value="Actualiser">  

</form>

     

        

 <?php            

if( (isset($_SESSION['p_envoi'])) OR (isset($_SESSION['action_offre'])) OR (isset($_SESSION['envoi_fitrage'])) 

 OR (isset($_SESSION['offre'])) OR (isset($_SESSION ['idPage'])) OR (isset($_SESSION["i_t_p_g"])))  { 

    

?>

        

        <div class="subscription" style="margin: 10px 0pt; width:99.9%">

          <h1>Liste des offres :</h1>

        </div>

 <?php            

require_once("./rechercher_off_m_table.php");

 }         

?>     

        <div class="ligneBleu"></div>

        

        <?php 

        if(isset($action_offre) and  $action_offre == 'relancer')

                    {

                                $id_offre = isset($_POST['id'])  ? $_POST['id'] : "";

            $select = mysql_query("select * from offre where id_offre = '$id_offre' ".$q_ref_fili_and." ");

            $reponse = mysql_fetch_array($select);

        ?>

        

         

    <div class="subscription" style="margin: 10px 0pt;">

                  <h1>Personnalisation du message envoyé aux candidats postulant</h1>

                </div>    <form method="post" action="<?php echo($_SERVER['REQUEST_URI']); ?>">

         <table>

            <tr>

              <td width="25%">Intitulé de l'offre <font style="color:#FF0000 ;">*</font></td>

              <td width="75%"><?php echo '<input type="text" name="intitule" style="width:534px" value="'.$reponse['Name'].'" readonly="readonly"/>'; ?>

                <input name="id_offre" type="hidden" value="<?php echo $id_offre; ?>" />

              </td>

            </tr>

            <tr>

              <td width="25%">Date de publication </td>

              <td width="75%"><span style="color:#000000;font-weight:normal"><?php echo $reponse['date_insertion']; ?></span></td>

            </tr>

         

         <tr>

             <td valign="top">Message personnalisé <font style="color:#FF0000 ;">*</font></td>

             

        <?php 

            $select1 = mysql_query("select * from message_offre where id_offre = '$id_offre'");

$reponse1 = mysql_fetch_array($select1);

            $a = mysql_num_rows($select1);

if($a)

$details=$reponse1['message'];

else

        $details="Bonjour,<br/>

Nous vous remercions d'avoir postuler à l'offre : ".$reponse['Name'].".<br/>

Sans réponse de notre part dans un délai de 30 jours, vous pourrez considérer que votre candidature n'a pas été retenue pour le poste demandé.

Cordialement." ;

?>

              <td><textarea name="message" id="editor1"><?php echo stripslashes($details); ?></textarea>

                <script type="text/javascript">

                CKEDITOR.replace( 'editor1',

                {

                enterMode : CKEDITOR.ENTER_DIV,

                entities: false,

                entities_additional : '',

                toolbar : 'Basic',

                resize_enabled : false

                });

            </script>

              </td>

        </tr>

        <tr>

        <td>

        </td>

        <td>

        <input name="envoimessage" type="submit" value="Valider" style="width:100px" />

                  <input name="reset" type="reset" style="width:100px"/>

               </td>

        </tr>

        </table>

                            </form>

        

        

        <?php

            }  ?>

            





      </div>

    </div>

  </div>