<?php

session_start();
 error_reporting (E_ALL ^ E_NOTICE);
 if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 
if(!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "")
{	header("Location:  ../../login/") ;  }

// -----------------------------------------
// Coupe une chaine en fonction du nombre de mots.
// -----------------------------------------
function couperChaine($chaine, $nbrMotMax){
$chaineNouvelle = "";
$i=0;
$t_chaineNouvelle = explode(" ",$chaine);
foreach($t_chaineNouvelle as $cle => $mot){
if($cle < $nbrMotMax){
$chaineNouvelle .= $mot." ";
}
$i++;
}
if($i<=$nbrMotMax)
return $chaine;
else
return $chaineNouvelle." ...";
}
 $requete;
 $option=2;
 $fvar;
 function date_diff1($date1, $date2)
{
 $s = strtotime($date2)-strtotime($date1);
 $d = intval($s/86400)+1;
 return "$d";
}
 

	  
    require(dirname(__FILE__).'/../../../../config/config.php');
        mysql_connect($serveur,$user,$passwd);
        mysql_select_db($bdd);  
function time_ago($date, $granularity = 2)
{
    $date = strtotime($date);
    $difference = time() - $date;
    $periods = array(
        'decade' => 315360000,
        'année'   => 31536000,
        'mois'  => 2628000,
        'semaine'   => 604800,
        'jour'    => 86400,
        'heure'   => 3600,
        'minute' => 60,
        'seconde' => 1);
    $retval = '';
    if ($difference < 1)
    {
        $retval = "moins de 1 second";
    }
    else
    {
        foreach ($periods as $key => $value)
        {
            if ($difference >= $value)
            {
                $time = floor($difference/$value);
                $difference %= $value;
                $retval .= ($retval ? ' ' : '').$time.' ';
                $retval .= (($time > 1 && $key !=mois) ? $key.'s' : $key);
                $granularity--;
            }
            if ($granularity == '0')
            {
                break;
            }
        }
    }
    return $retval;
}


 $_SESSION['link_bak_a']=2;
 $_SESSION['link_bak_b']=25;            
 
      
 
  $nom_page_site ="CANDIDATS || IMPORT MANUEL DE CV "  ;
  
    
 
   
$ariane=" Candidats > Import manuel des CVs";
?>