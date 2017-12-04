<?php

session_start();


if ((!isset($_SESSION["abb_admin_stage"]) || $_SESSION["abb_admin_stage"] == ""))
 {  header("Location: ../../stages/");  }  


/*if(!isset($_SESSION['id']) or $_SESSION['id']!=1)
$_SESSION['id']=1;
*/
?>

<?php 

if(isset($_GET['email_tt']) and (isset($_GET['select']) and $_GET['select']!=''))
{
	if(isset($_GET['select'])){$_SESSION['select_s']=$_GET['select'];	}
header("Location:  ../email_list_stage_p.php") ;
}
 


//  <!--	<form action="../email_form_pop_p.php" method="post" name="global" >    <form action="../comptes_candidatures.php" method="post" name="global" >  -->
?>  
  
<?php
// -----------------------------------------
// Coupe une chaine en fonction du nombre de mots.
// ----------------------------------------- 											
function couperChaine($chaine, $nbrMotMax , $nbrMotCarct=null ) {
    $chaineNouvelle = "";
    $i = 0;
    $t_chaineNouvelle = explode(" ", $chaine);
    foreach ($t_chaineNouvelle as $cle => $mot) {
        if ($cle < $nbrMotMax) {
            $chaineNouvelle .= $mot . " ";
        }
        $i++;
    }
	
    if ($i <= $nbrMotMax){	
		$chaine=substr($chaine,0,$nbrMotCarct).'...';
        return $chaine;
		}
    else{
		
		$chaineNouvelle=substr($chaineNouvelle,0,$nbrMotCarct).'...';
        return $chaineNouvelle;
		}
} 
$g_by=" GROUP BY candidats.candidats_id ";

$requete;

$option = 2;

$fvar;

function date_diff1($date1, $date2) {

    $s = strtotime($date2) - strtotime($date1);

    $d = intval($s / 86400) + 1;

    return "$d";
}





 require(dirname(__FILE__) . '/../../../../config/config.php');

  
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$sql_0 = "SELECT * FROM liste_stage where id_stage = ". $_SESSION['id_stg']."  LIMIT 0 , 1  ";
	//	echo $sql_0."<br>";
	   $result_0 = mysql_query($sql_0);
				$row_0 = mysql_fetch_assoc($result_0);
				$list_id_0 = $row_0['id_list_c']; 
				$_SESSION['list_c_0']=" And  candidature_stage.id_candidature  in ( ".$list_id_0." ) ";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				
	
	
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
    
$_SESSION['menu1']=$_SESSION['menu2']=$_SESSION['menu3']=$_SESSION['menu4']=$_SESSION['menu5']=$_SESSION['menu6']=$_SESSION['menu7']=0;	
    

 $_SESSION['link_bak_a']=4;
 $_SESSION['link_bak_b']=44;

        
 $_SESSION['page_courant']=$_SERVER['REQUEST_URI'];
 
 
 
$ariane=" Candidatures > Traitement des candidatures pour stage ";    
 
?>