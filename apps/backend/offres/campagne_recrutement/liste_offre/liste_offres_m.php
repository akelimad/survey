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

							

							  <div style=" float: right; padding: 2px 5px 0px 0px;">

								<a href="<?php echo $_SESSION['page_courant__c']; ?>" style=" border-bottom: none; ">

									<img src="<?php echo $imgurl; ?>/arrow_ltr.png" title="Retour"><strong style="color:#fff">Retour</strong>

							    </a>	

							  </div>

							  

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

        if(isset($_POST['partager']))   

        {

        $objet = "Offre d'emploi de ".$nom_site;

        $headers = 'MIME-Version: 1.0' . "\r\n";

        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= 'From: '.$nom_site.' <'.$admin_email.'>' . "\r\n"; //on définit l'expéditeur

        

        $id_offre = isset($_POST['id_offre'])  ? $_POST['id_offre'] : "";





          foreach($_POST['checkbox'] as $checkbox){

    if(isset($checkbox)){

    

        //* --------------------------   insertion dans la table his_off_partag

        $id_p=$checkbox;

        $sql_partenaire = mysql_query("SELECT * FROM  partenaire where id_parte = '".$id_p."' ");

        $rep_partenaire = mysql_fetch_assoc($sql_partenaire);

               

            $partenaire = $rep_partenaire['nom'];

            $lien_offre='<a href="'.$site.'offres/index.php?id='.$id_offre.'">'.$site.'offres/index.php?id='.$id_offre.'</a>';

            $email = $rep_partenaire['email'];

            $message = $rep_partenaire['message'];

            // Génère : message

                $var = array("{{nom}}", "{{lien}}");

                $replace   = array($partenaire, $lien_offre);

                $new_msg = str_replace($var, $replace, $message);

            

         // INSERT INTO his_off_partag      

                        $date_his_p = date("Y-m-d H:i:s");            

                        

                        mysql_query("INSERT INTO his_off_partag VALUES ('','$id_offre','$id_p','$date_his_p')");    

                        

        // -------------------------    */ 

        

        mail($email, $objet, $new_msg, $headers);

    }

      else { echo 'cochez au moins une case!';  }

    }}

    

    if(isset($_POST['envoimessage']))

                    {

            $id_offre = isset($_POST['id_offre'])  ? $_POST['id_offre'] : "";

             $message = isset($_POST['message'])  ? $_POST['message'] : "";

//$message = htmlentities ($message );

$message = addslashes ($message );

            $select = mysql_query("select * from message_offre where id_offre = '$id_offre'");

            $reponse = mysql_fetch_array($select);

            $a = mysql_num_rows($select);

        

            if($a)

            {

            mysql_query("UPDATE message_offre SET message ='".safe($message)."' where id_offre='".safe($id_offre)."'");

                $maj = mysql_affected_rows();

                    if($maj > 0)

                    echo '<script type="text/javascript">alert("votre message a été modifié avec succès");</script>';

                    }

                    else

                    {   

                        mysql_query("INSERT INTO message_offre VALUES ('','".safe($id_offre)."','".safe($message)."')");

                    

                    echo '<script type="text/javascript">alert("votre message a été modifié avec succès");</script>';

            }

                        }

        

            if (isset($_POST['action_offre']))

            {

                $action_offre = $_POST['action_offre'];

                if(isset($_POST['id']))

                {

                    $id = $_POST['id'];

                    if ($action_offre == 'archive')

                    {

                        mysql_query("Update offre Set status = 'Archivée' where id_offre = '$id'");

                        $affected = mysql_affected_rows();

                        if ($affected > 0 )

                            echo '<h3>Offre archivée avec succés</h3>';

                    }

                    elseif($action_offre == 'desarchive')

                    {

                        mysql_query("Update offre Set status = 'En cours' where id_offre = '$id'");

                        $affected = mysql_affected_rows();

                        if ($affected > 0 )

                            include('../../offres_alerts.php');

                            echo '<h3>Offre publiée avec succés</h3>';

                    }

                    }

            }

            

            if (isset($_POST['action_offre']))

            {

                $action_offre = $_POST['action_offre'];

                if($action_offre == 'supprimer')

                { 

                        mysql_query("DELETE FROM his_off_rol where id_offre = '$id'");

                        mysql_query("DELETE FROM offre where id_offre = '$id'");

                        mysql_query("DELETE FROM campagne_offres where id_offre = '$id'");

                        $affected = mysql_affected_rows();

                            echo '<h3>Suppression avec succés</h3>';

                    

                }

            }       

            

            if(isset($_POST['action']))

                $action = $_POST['action'];

            elseif(isset($_POST['action']))

                $action = $_POST['action'];

            else

                $action = '';

            if($action  == "encours")

                $sql = mysql_query("select * from offre where  status = 'En cours' ORDER BY date_insertion DESC");

            elseif($action == "archive")

                $sql = mysql_query("select * from offre where  status = 'Archivée' ORDER BY date_insertion DESC");

            else

                $sql = mysql_query("select * from offre  ORDER BY date_insertion DESC");

 



//  ###########################################################



                            





$requete = "";







if (!empty($_SESSION['offre'])) {

if (empty($requete))

        $requete .= "offre.reference = '" . $_SESSION['offre'] . "'";

else

        $requete .= "And offre.reference = '" . $_SESSION['offre'] . "'";

}



if (!empty($_SESSION['intPoste'])) {

if (empty($requete))

        $requete .= "offre.Name = '" . $_SESSION['intPoste'] . "'";

else

        $requete .= "And offre.Name = '" . $_SESSION['intPoste'] . "'";

}



if (!empty($_SESSION['poste'])) {

if (empty($requete))

        $requete .= "offre.id_tpost = '" . $_SESSION['poste'] . "'";

else

        $requete .= "And offre.id_tpost = '" . $_SESSION['poste'] . "'";

}



if (!empty($_SESSION['statut'])) {

if (empty($requete))

        $requete .= "offre.status = '" . $_SESSION['statut'] . "'";

else

        $requete .= "And offre.status = '" . $_SESSION['statut'] . "'";

}



if (!empty($_SESSION['lieu'])) {

if (empty($requete))

        $requete .= "offre.id_localisation = '" . $_SESSION['lieu'] . "'";

else

        $requete .= "And offre.id_localisation = '" . $_SESSION['lieu'] . "'";

}



if (!empty($_SESSION['motcle'])) {

if (empty($requete))

        $requete .= "lower(concat_ws(' ',offre.reference,offre.Name,offre.status,offre.id_tpost,offre.id_localisation )) like lower('%" . $_SESSION['motcle'] . "%')";

else

        $requete .= "And lower(concat_ws(' ',offre.reference,offre.Name,offre.status,offre.id_tpost,offre.id_localisation )) like lower('%" . $_SESSION['motcle'] . "%')";

}



if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;

/*$itemsParPage=10;

*/

if( (isset($_SESSION['p_envoi'])) AND $_SESSION['p_envoi']!='' AND (!empty($requete)) ){

$pag_query = "select * from offre where   " . $requete ."  And  ". $id_off . " ".$q_ref_fili_and."  ORDER BY date_insertion DESC";

$reqpagination=  mysql_query($pag_query); 

$rows = mysql_num_rows($reqpagination);

$nbItems = $rows;



//Nombre de pages

$nbPages = $nbItems/$itemsParPage;

//Numero de Page courante

if(isset($_GET['idPage']) and ($_GET['idPage']=="not" or $_GET['idPage']==""))

   unset ($_GET['idPage']);

if(!isset($_GET['idPage']))

{           $pageCourante = 1;  

}   

else

{if(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)

  $pageCourante = $_GET['idPage'];

else

$pageCourante = $nbPages;

}

//Calcul de la clause LIMIT

$limitstart = $pageCourante*$itemsParPage-$itemsParPage;



$selectString = "select * from offre where   " . $requete ."  And  ". $id_off . " ".$q_ref_fili_and."  ORDER BY date_insertion DESC

"; // LIMIT " . $limitstart . ", " . $itemsParPage ."

$_SESSION['qry'] = $selectString;

}else{

    $pag_query = "select * from offre where  "  . $id_off . " ".$q_ref_fili_and."  ORDER BY date_insertion DESC";

$reqpagination=  mysql_query($pag_query); 

$rows = mysql_num_rows($reqpagination);

$nbItems = $rows;



//Nombre de pages

$nbPages = $nbItems/$itemsParPage;

//Numero de Page courante

if(isset($_GET['idPage']) and ($_GET['idPage']=="not" or $_GET['idPage']==""))

   unset ($_GET['idPage']);

if(!isset($_GET['idPage']))

{           $pageCourante = 1;  

}   

else

{if(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)

  $pageCourante = $_GET['idPage'];

else

$pageCourante = $nbPages;

}

//Calcul de la clause LIMIT

$limitstart = $pageCourante*$itemsParPage-$itemsParPage;



 $selectString = "select * from offre where  "  . $id_off . " ".$q_ref_fili_and."  ORDER BY date_insertion DESC

  ";  //LIMIT " . $limitstart . ", " . $itemsParPage ."

$_SESSION['qry'] = $selectString;   

}





//echo $selectString;



    $sql = mysql_query($_SESSION['qry']);

//  ###########################################################







/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];



$select = mysql_query($_SESSION['qry']);



$tpc = mysql_num_rows($select);                     

$nbItems = $tpc;

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;

$nbPages = ceil ( $nbItems / $itemsParPage );

if (! isset ( $_GET ['idPage'] ))

$pageCourante = 1;        

elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)

$pageCourante = $_GET ['idPage'];

else

$pageCourante = 1;

// Calcul de la clause LIMIT

$limitstart = $pageCourante * $itemsParPage - $itemsParPage;

 //



$sql_pagination=$_SESSION['qry']."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

// echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination

        

require_once("./liste_offres_m_table.php");          

?>     

        

        <?php    ?>

            



        

        <?php  

     

       

	

	

	

	

    if(isset($_POST['ref']) || ( isset($_POST['offre'])  AND  $_POST['offre']!=""  )|| isset($_POST['select']))

    {

    





//          *****************************           //

//          *****************************           //













    if(isset($_POST['offre']) && !empty($_POST['offre'])      )

        $id_o = $_POST['offre'];

    else

        $id_o = $_POST['ref'];

    if(isset($_POST['archive']))

        {

            for ($i = 0; $i < count($_POST["select"]); $i++)

            {   

                mysql_query("Update candidature SET status = 'En cours' where id_candidature = '".$_POST["select"][$i]."'");

            }

        }

        if(isset($_POST['delete']))     

        {

            for ($i = 0; $i < count($_POST["select"]); $i++)

            {   

                $id_candidature = $_POST["select"][$i];

                $date_modification = date("Y-m-d H:i");

                $my_sql = mysql_query("SELECT status from candidature where id_candidature = '$id_candidature'");

                $test = mysql_fetch_array($my_sql);

                if($test['status'] == 'Cloturé')

                {

                mysql_query("DELETE from candidature where id_candidature = '$id_candidature'");

                mysql_query("DELETE from historique where id_candidature = '$id_candidature'");

                }

                else

                { 

                mysql_query("Update candidature SET status = 'Cloturé' where id_candidature = '$id_candidature'");

                mysql_query("INSERT INTO historique VALUES ('$id_candidature','Non retenu','$date_modification','')");

                }

            }

     

        }

     

      if(isset($_POST['offre']) )

      {

        $id_offre = $_POST['offre'];

       

          }  

     ?>

  

 

	  



<?php





//          *****************************           //

//          *****************************           //





    

    }

     ?>

	  

    </div>

	

	

	

  </div>