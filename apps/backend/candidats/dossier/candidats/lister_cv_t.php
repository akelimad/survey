<?php

session_start(); 
if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 
 
if ((!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") and (!isset($_SESSION["responsablecom"]) || $_SESSION["responsablecom"]==""))
 {
    header("Location: ../../login/"); 
} 

    require(dirname(__FILE__) . '/../../../../../config/config.php');
 
	

				
// -----------------------------------------
// Coupe une chaine en fonction du nombre de mots.
// -----------------------------------------
               																						
function couperChaine($chaine, $nbrMotMax) {
    $chaineNouvelle = "";
    $i = 0;
    $t_chaineNouvelle = explode(" ", $chaine);
    foreach ($t_chaineNouvelle as $cle => $mot) {
        if ($cle < $nbrMotMax) {
            $chaineNouvelle .= $mot . " ";
        }
        $i++;
    }
    if ($i <= $nbrMotMax)
        return $chaine;
    else
        return $chaineNouvelle . " ...";
}
$requete;
$option = 2;
$fvar;
function date_diff1($date1, $date2) {
    $s = strtotime($date2) - strtotime($date1);
    $d = intval($s / 86400) + 1;
    return "$d";
}


$g_by=" GROUP BY candidats.candidats_id ";


    function time_ago($date, $granularity = 2) {
        $date = strtotime($date);
        $difference = time() - $date;
        $periods = array(
            'decade' => 315360000,
            'année' => 31536000,
            'mois' => 2628000,
            'semaine' => 604800,
            'jour' => 86400,
            'heure' => 3600,
            'minute' => 60,
            'seconde' => 1);
        $retval = '';
        if ($difference < 1) {
            $retval = "moins de 1 second";
        } else {
            foreach ($periods as $key => $value) {
                if ($difference >= $value) {
                    $time = floor($difference / $value);
                    $difference %= $value;
                    $retval .= ($retval ? ' ' : '') . $time . ' ';
                    $retval .= (($time > 1 && $key != 'mois') ? $key . 's' : $key);
                    $granularity--;
                }
                if ($granularity == '0') {
                    break;
                }
            }
        }
        return $retval;
    }
    
if(isset($_GET["in_d"]) and $_GET["in_d"]!='')  $_SESSION["lcv_in_d"]=$_GET["in_d"]; 
    $in_d = isset($_SESSION["lcv_in_d"]) ? $_SESSION["lcv_in_d"]: "";
     
    $sql_0 = mysql_query("SELECT * FROM dossier WHERE id_dossier ='".$in_d."' ");
    
    $row = mysql_fetch_assoc($sql_0);
    
 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];
$ndd = strtoupper ( $row["nom_dossier"] );
         
 
  $nom_page_site ="DOSSIER || ".strtoupper($ndd) ;
  
    
$ariane=" Candidats > <a href='../?a=2&b=26'> Dossier </a> > Liste des candidats par dossier"; 
?>