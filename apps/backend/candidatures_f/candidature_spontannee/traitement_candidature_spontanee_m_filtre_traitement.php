<?php
 if (isset($_POST['envoi'])) {

$_session['formation'] = '';

if (!empty($_SESSION['cp_motcle']) || !empty($_SESSION['cp_fonction']) || !empty($_SESSION['cp_fraicheur']) || !empty($_SESSION['cp_pays']) || !empty($_SESSION['cp_formation']) || !empty($_SESSION['cp_type_formation']) || !empty($_SESSION['cp_exp']) || !empty($_SESSION['cp_ville'])|| !empty($_SESSION['cp_secteur']) || !empty($_SESSION['cp_situation']) || !empty($_SESSION['cp_etablissement'])) {

$requete = "";
if (!empty($_SESSION['cp_pays'])){
if (empty($requete))
  $requete .= "candidats.id_pays = '" . $_SESSION['cp_pays'] . "'";
else
  $requete .= "And candidats.id_pays = '" . $_SESSION['cp_pays'] . "'";
}

if (!empty($_SESSION['cp_ville'])){
if (empty($requete))
  $requete .= "candidats.ville = '" . $_SESSION['cp_ville'] . "'";
else
  $requete .= "And candidats.ville = '" . $_SESSION['cp_ville'] . "'";
}


if (!empty($_SESSION['cp_motcle'])) {

if (empty($requete))
  $requete .= "lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom,candidats.email,candidature_spontanee.message, candidats.prenom, CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION['cp_motcle'] . "%')";
else
  $requete .= "And lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom,candidature_spontanee.message, candidats.prenom, CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION['cp_motcle'] . "%')";
}

if (!empty($_SESSION['cp_formation'])) {
//  $_session['formation'] = $fvar;
if (empty($requete))
  $requete .= "candidats.id_nfor = '" . $_SESSION['cp_formation'] . "'";
else
  $requete .= "And candidats.id_nfor = '" . $_SESSION['cp_formation'] . "'";
}

if (!empty($_SESSION['cp_fonction'])) {
if (empty($requete))
  $requete .= "candidats.id_fonc = '" . $_SESSION['cp_fonction'] . "'";
else
  $requete .= "And candidats.id_fonc = '" . $_SESSION['cp_fonction'] . "'";
}

if (!empty($_SESSION['cp_type_formation'])) {
if (empty($requete))
  $requete .= "candidats.id_tfor = '" . $_SESSION['cp_type_formation'] . "'";
else
  $requete .= "And candidats.id_tfor = '" . $_SESSION['cp_type_formation'] . "'";
}

if (!empty($_SESSION['cp_exp'])) {
if (empty($requete))
  $requete .= "candidats.id_expe = '" . $_SESSION['cp_exp'] . "'";
else
  $requete .= "And candidats.id_expe = '" . $_SESSION['cp_exp'] . "'";
}

if (!empty($_SESSION['cp_secteur'])) {
if (empty($requete))
  $requete .= "candidats.id_sect = '" . addslashes($_SESSION['cp_secteur']) . "'";
else
  $requete .= "And candidats.id_sect = '" . addslashes($_SESSION['cp_secteur']) . "'";
}

if (!empty($_SESSION['cp_situation'])) {
if (empty($requete))
  $requete .= "candidats.id_situ = '" . $_SESSION['cp_situation'] . "'";
else
  $requete .= "And candidats.id_situ = '" . $_SESSION['cp_situation'] . "'";
 }

if (!empty($_SESSION['cp_etablissement'])) {
if (empty($requete))
  $requete .= " formations.id_ecol = '" . addslashes($_SESSION['cp_etablissement']) . "'";
else
  $requete .= "And formations.id_ecol = '" . addslashes($_SESSION['cp_etablissement']) . "'";
}

if (!empty($_SESSION['cp_fraicheur'])) {
if (empty($requete))
  $requete .= "DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION['cp_fraicheur'] . "'";
else
  $requete .= "And DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION['cp_fraicheur'] . "'";
}


$selectString = "SELECT * 
from  candidats   
INNER JOIN candidature_spontanee on candidature_spontanee.candidats_id = candidats.candidats_id  
INNER JOIN formations ON candidats.candidats_id = formations.candidats_id 
WHERE " . $requete . "  ".$g_by."  order by date_cs desc ";
$_SESSION['query_cpf']=$selectString;
}// fin if traitement filtre
else{
  $selectString = "SELECT  * from candidature_spontanee order by date_cs desc  ";  
  $_SESSION['query_cpf']=$selectString;
}

}else{
   $selectString = "SELECT  * from candidature_spontanee order by date_cs desc  "; 
   //$_SESSION['query_cpf']=$selectString;
}
?>