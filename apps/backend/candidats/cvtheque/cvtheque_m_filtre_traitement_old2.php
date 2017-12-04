<?php


        


$user = (isset($_SESSION['abb_admin'])) ? $_SESSION['abb_admin'] : "";
$m =  (isset($_SESSION['motcle'])) ? $_SESSION['motcle'] : "";
$m1 =  (isset($_SESSION['secteur'])) ? $_SESSION['secteur'] : "";
$m2 =  (isset($_SESSION['exp'])) ? $_SESSION['exp'] : "";
$m3 =  (isset($_SESSION['salaire'])) ? $_SESSION['salaire'] : "";
$m4 =  (isset($_SESSION['formation'])) ? $_SESSION['formation'] : "";
$m10 =  (isset($_SESSION['fraicheur'])) ? $_SESSION['fraicheur'] : "";
$m5 =  (isset($_SESSION['etablissement'])) ? $_SESSION['etablissement'] : "";
$m6 =  (isset($_SESSION['dispo'])) ? $_SESSION['dispo'] : "";
$m7 =  (isset($_SESSION['situation'])) ? $_SESSION['situation'] : "";
$m8 =  (isset($_SESSION['type_formation'])) ? $_SESSION['type_formation'] : "";
$m9 =  (isset($_SESSION['pays'])) ? $_SESSION['pays'] : "";
$m11 =  (isset($_SESSION['ville'])) ? $_SESSION['ville'] : "";




if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;

$nbPages = (isset($nbItems)) ? ceil ( $nbItems / $itemsParPage ) : 0 ;
if (! isset ( $_GET ['idPage'] ))
$pageCourante = 1;        
elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)
$pageCourante = $_GET ['idPage'];
else
$pageCourante = 1;
// Calcul de la clause LIMIT
$limitstart = $pageCourante * $itemsParPage - $itemsParPage;
// 

if (isset($_SESSION['envoi'])) {

$reqs=mysql_query("INSERT INTO `historique_cvtheque`
  (`user`, `motcle`, `id_sect`, `id_expe`,
 `id_salr`, `id_for`, `id_frai`, `id_etab`,
  `id_dispo`, `id_situ`, `id_tfor`, `id_pays`)
  VALUES 
  ('".safe($user)."','".safe($m)."','".safe($m1)."',
    '".safe($m2)."','".safe($m3)."','".safe($m4)."',
    '".safe($m10)."','".safe($m5)."','".safe($m6)."','".safe($m7)."',
    '".safe($m8)."','".safe($m9)."')");


   $_session['formation'] = '';

if (!empty($_SESSION['motcle']) || !empty($_SESSION['fonction']) 
  || !empty($_SESSION['fraicheur']) || !empty($_SESSION['pays']) 
  || !empty($_SESSION['ville']) || !empty($_SESSION['formation']) 
  || !empty($_SESSION['type_formation']) || !empty($_SESSION['exp']) 
  || !empty($_SESSION['secteur']) || !empty($_SESSION['situation']) 
  || !empty($_SESSION['etablissement']) || !empty($_SESSION['salaire']) 
  || !empty($_SESSION['dispo']) || !empty($_SESSION['datecv']) ) {

$requete = "";
if (!empty($_SESSION['pays']))
{
  $requete .= "And candidats.id_pays = '" . $_SESSION['pays'] . "'";
}

if (!empty($_SESSION['ville']))
{
  $requete .= "And candidats.ville = '" . $_SESSION['ville'] . "'";
}

if (!empty($_SESSION['motcle'])) {
 $requete .= "And lower(concat_ws(' ',titre, 
  formations.id_ecol,formations.diplome,formations.description,
   candidats.nom, candidats.email,candidats.prenom,
    CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION['motcle'] . "%')";
}

if (!empty($_SESSION['formation'])) { 
 $requete .= "And candidats.id_nfor = '" . $_SESSION['formation'] . "'";
}

if (!empty($_SESSION['fonction'])) {
 $requete .= "And candidats.id_fonc  = '" . $_SESSION['fonction'] . "'";
}

if (!empty($_SESSION['type_formation'])) { 
 $requete .= "And candidats.id_tfor = '" . $_SESSION['type_formation'] . "'";
}

if (!empty($_SESSION['exp'])) {
    $requete .= "And candidats.id_expe = '" . $_SESSION['exp'] . "'";
}

if (!empty($_SESSION['secteur'])) {
$requete .= "And candidats.id_sect = '" . addslashes($_SESSION['secteur']) . "'";
}

if (!empty($_SESSION['situation'])) {
    $requete .= "And candidats.id_situ = '" . $_SESSION['situation'] . "'";
}

if (!empty($_SESSION['etablissement'])) {
  $requete .= " And formations.id_ecol = '" . $_SESSION['etablissement']  . "' ";
}
                  
if (!empty($_SESSION['salaire'])) {
  $requete .= " And candidats.id_salr = '" . $_SESSION['salaire']  . "' ";
}
          
if (!empty($_SESSION['dispo'])) {
  $requete .= " And candidats.id_dispo = '" . $_SESSION['dispo']  . "' ";
}
          
if (!empty($_SESSION['datecv'])) {
 $requete .= "And DATEDIFF(curdate(),CVdateMAJ)<'" . $_SESSION['datecv'] . "'";
}
          
if (!empty($_SESSION['fraicheur'])) {
$requete .= "And DATEDIFF(curdate(),CVdateMAJ)<'" . $_SESSION['fraicheur'] . "'";
}

$selectString = "SELECT * from  candidats,formations
WHERE candidats.candidats_id = formations.candidats_id 
" . $requete . " and id_civi != 0 and nom !='' and prenom !='' and last_connexion != '0000-00-00'
".$g_by."    order by dateMAJ desc 
";

} 
else {
//$selectString = "select * from  candidats  INNER JOIN formations ON candidats.candidats_id = formations.candidats_id  INNER JOIN cv ON cv.candidats_id = candidats.candidats_id WHERE   cv.principal=1 AND cv.actif=1  ".$g_by."  order by dateMAJ desc LIMIT " . $limitstart . "," . $itemsParPage . " ";
$selectString = "SELECT * from  candidats   where  id_civi != 0 and nom !='' and prenom !='' and last_connexion != '0000-00-00'  ".$g_by."  
  order by dateMAJ desc  ";
}
}//fin envoi
else {
//$selectString = "select * from  candidats  INNER JOIN formations ON candidats.candidats_id = formations.candidats_id  INNER JOIN cv ON cv.candidats_id = candidats.candidats_id  WHERE   cv.principal=1 AND cv.actif=1  ".$g_by."  order by dateMAJ desc LIMIT " . $limitstart . "," . $itemsParPage . "";
$selectString = "SELECT * from  candidats   where  id_civi != 0 and nom !='' and prenom !=''  and last_connexion != '0000-00-00' ".$g_by."  
 order by dateMAJ desc ";
}


//echo $selectString;

?>