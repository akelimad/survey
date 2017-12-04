<?php
 
session_start();

if(isset($_SESSION['compte_v'])) {  header("Location: ../../../compte/");  } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {     header("Location: ../../../login/");  } 
	 
	 
    require_once dirname(__FILE__) . "/../../../../../config/config.php";

	
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


 
 function time_ago($date, $granularity = 2){   
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
                $retval .= (($time > 1 && $key !='mois') ? $key.'s' : $key);
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
 
        
 
        
        
        $sql_roles = mysql_query("SELECT * FROM  root_roles where login = '".$_SESSION['abb_admin']."' ");
        $rep_roles = mysql_fetch_assoc($sql_roles);
		
		
		$id_offre = isset($_GET['offre'])  ? $_GET['offre'] : "";
		$select = mysql_query("select * from offre where id_offre = '$id_offre'");
		$reponse = mysql_fetch_array($select);
		$ss  = $reponse['Name']; 
    
	
	
 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];
    

 $_SESSION['link_bak_a']=1;
 $_SESSION['link_bak_b']=13;

  
  $nom_page_site = "OFFRES || MATCHING DES OFFRES " ;
  
 $ariane=" Offres > <a href='../?a=1&b=13'>Matching des offres</a> > $ss" ;
 ?>