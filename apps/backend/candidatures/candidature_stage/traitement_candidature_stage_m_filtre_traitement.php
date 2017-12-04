<?php
 if (isset($_POST['envoi'])) {

$_session['formation'] = '';

if (!empty($_SESSION['cs_motcle']) || !empty($_SESSION['cs_fonction']) || !empty($_SESSION['cs_fraicheur']) 
|| !empty($_SESSION['cs_pays']) || !empty($_SESSION['cs_formation']) || !empty($_SESSION['cs_type_formation'])
 || !empty($_SESSION['cs_exp']) || !empty($_SESSION['cs_ville'])|| !empty($_SESSION['cs_secteur']) 
 || !empty($_SESSION['cs_situation']) || !empty($_SESSION['cs_etablissement'])
  || !empty($_SESSION['cs_typestage'])|| !empty($_SESSION['cs_duree_stage'])
  || !empty($_SESSION['cs_sexe']) || !empty($_SESSION['cs_age'])) 
   {

$requete = "";
if (!empty($_SESSION['cs_typestage'])){
if (empty($requete))
  $requete .= " candidature_stage.type = '" . $_SESSION['cs_typestage'] . "'";
else
  $requete .= " And candidature_stage.type = '" . $_SESSION['cs_typestage'] . "'";
}
if (!empty($_SESSION['cs_duree_stage'])){
if (empty($requete))
  $requete .= " candidature_stage.duree = '" . $_SESSION['cs_duree_stage'] . "'";
else
  $requete .= " And candidature_stage.duree = '" . $_SESSION['cs_duree_stage'] . "'";
}
if (!empty($_SESSION['cs_pays'])){
if (empty($requete))
  $requete .= " candidats.id_pays = '" . $_SESSION['cs_pays'] . "'";
else
  $requete .= " And candidats.id_pays = '" . $_SESSION['cs_pays'] . "'";
}

if (!empty($_SESSION['cs_ville'])){
if (empty($requete))
  $requete .= " candidats.ville = '" . $_SESSION['cs_ville'] . "'";
else
  $requete .= " And candidats.ville = '" . $_SESSION['cs_ville'] . "'";
}


if (!empty($_SESSION['cs_motcle'])) {

if (empty($requete))
  $requete .= " lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom,candidats.email,candidature_stage.motivations, candidats.prenom, CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION['cs_motcle'] . "%')";
else
  $requete .= " And lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom,candidature_stage.motivations, candidats.prenom, CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION['cs_motcle'] . "%')";
}

if (!empty($_SESSION['cs_formation'])) {
//  $_session['formation'] = $fvar;
if (empty($requete))
  $requete .= " candidats.id_nfor = '" . $_SESSION['cs_formation'] . "'";
else
  $requete .= " And candidats.id_nfor = '" . $_SESSION['cs_formation'] . "'";
}

//----------------------------------age----------------------------------------
if (!empty($_SESSION['cs_age']))
{

if (empty($requete)){

if($_SESSION['cs_age']==1){
$requete .=" (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 18 YEAR AND CURDATE() - INTERVAL 15 YEAR)";
}elseif($_SESSION['cs_age']==2){
$requete .=" (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 30 YEAR AND CURDATE() - INTERVAL 18 YEAR)";
}elseif($_SESSION['cs_age']==3){
$requete .=" (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 40 YEAR AND CURDATE() - INTERVAL 30 YEAR)";
}elseif($_SESSION['cs_age']==4){
$requete .=" (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 60 YEAR AND CURDATE() - INTERVAL 40 YEAR)";
}elseif($_SESSION['cs_age']==5){
$requete .=" (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 90 YEAR AND CURDATE() - INTERVAL 60 YEAR)";
} 

}else{

if($_SESSION['cs_age']==1){
$requete .=" And (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 18 YEAR AND CURDATE() - INTERVAL 15 YEAR)";
}elseif($_SESSION['cs_age']==2){
$requete .=" And (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 30 YEAR AND CURDATE() - INTERVAL 18 YEAR)";
}elseif($_SESSION['cs_age']==3){
$requete .=" And (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 40 YEAR AND CURDATE() - INTERVAL 30 YEAR)";
}elseif($_SESSION['cs_age']==4){
$requete .=" And (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 60 YEAR AND CURDATE() - INTERVAL 40 YEAR)";
}elseif($_SESSION['cs_age']==5){
$requete .=" And (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 90 YEAR AND CURDATE() - INTERVAL 60 YEAR)";
} 

}



}
//------------------------------ end age --------------------------------------
//------------------------------ sexe -----------------------------------------
if (!empty($_SESSION['cs_sexe']))
{
if (empty($requete)){
if($_SESSION['cs_sexe']=="1"){
$requete .= " candidats.id_civi =1";

}else if($_SESSION['cs_sexe']=="2"){
$requete .= " (candidats.id_civi =2 OR candidats.id_civi=4) ";
}  

}else{

if($_SESSION['cs_sexe']=="1"){
$requete .= " And candidats.id_civi =1";

}else if($_SESSION['cs_sexe']=="2"){
$requete .= " And (candidats.id_civi =2 OR candidats.id_civi=4) ";
}  

}

}
//------------------------------ end sexe ------------------------------------- 




if (!empty($_SESSION['cs_fonction'])) {
if (empty($requete))
  $requete .= " candidats.id_fonc = '" . $_SESSION['cs_fonction'] . "'";
else
  $requete .= " And candidats.id_fonc = '" . $_SESSION['cs_fonction'] . "'";
}

if (!empty($_SESSION['cs_type_formation'])) {
if (empty($requete))
  $requete .= " candidats.id_tfor = '" . $_SESSION['cs_type_formation'] . "'";
else
  $requete .= " And candidats.id_tfor = '" . $_SESSION['cs_type_formation'] . "'";
}

if (!empty($_SESSION['cs_exp'])) {
if (empty($requete))
  $requete .= " candidats.id_expe = '" . $_SESSION['cs_exp'] . "'";
else
  $requete .= " And candidats.id_expe = '" . $_SESSION['cs_exp'] . "'";
}

if (!empty($_SESSION['cs_secteur'])) {
if (empty($requete))
  $requete .= " candidats.id_sect = '" . addslashes($_SESSION['cs_secteur']) . "'";
else
  $requete .= " And candidats.id_sect = '" . addslashes($_SESSION['cs_secteur']) . "'";
}

if (!empty($_SESSION['cs_situation'])) {
if (empty($requete))
  $requete .= " candidats.id_situ = '" . $_SESSION['cs_situation'] . "'";
else
  $requete .= " And candidats.id_situ = '" . $_SESSION['cs_situation'] . "'";
 }

if (!empty($_SESSION['cs_etablissement'])) {
if (empty($requete))
  $requete .= " formations.id_ecol = '" . addslashes($_SESSION['cs_etablissement']) . "'";
else
  $requete .= " And formations.id_ecol = '" . addslashes($_SESSION['cs_etablissement']) . "'";
}

if (!empty($_SESSION['cs_fraicheur'])) {
if (empty($requete))
  $requete .= " DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION['cs_fraicheur'] . "'";
else
  $requete .= " And DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION['cs_fraicheur'] . "'";
}


$selectString = "SELECT * from  candidats 
inner join candidature_stage on candidature_stage.candidats_id = candidats.candidats_id 
INNER JOIN formations ON candidats.candidats_id = formations.candidats_id 
WHERE " . $requete . "  ".$g_by." order by date desc ";

$_SESSION['query_cstage']=$selectString;
}// fin if traitement filtre
else{
  $selectString = "SELECT  * from candidature_stage order by date desc  ";  
  $_SESSION['query_cstage']=$selectString;
}

}else{
   $selectString = "SELECT  * from candidature_stage order by date desc  "; 
   //$_SESSION['query_csf']=$selectString;
}
?>