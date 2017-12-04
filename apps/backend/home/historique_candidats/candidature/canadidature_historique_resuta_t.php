<?php 



session_start();



if(isset($_SESSION['compte_v'])) {  header("Location: ../../../compte/");  } 



if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../../../login/"); 

}  

/*

if (isset($_SESSION['ref_filiale_role']) and $_SESSION['ref_filiale_role']!='0'){	

  		header("Location:  ../../../") ;

	  }

*/

$url44 = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 

    //echo $url44 ;

    $_SESSION['url44'] = $url44;

	

	

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

		

$requete;

$option = 2;

$fvar;



function date_diff1($date1, $date2) {

    $s = strtotime($date2) - strtotime($date1);

    $d = intval($s / 86400) + 1;

    return "$d";

}



$g_by=" GROUP BY candidats.candidats_id ";

$g_by2=" GROUP BY cv.candidats_id ";



	

	

	

    require(dirname(__FILE__) . '/../../../../../config/config.php');

   

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

	if(isset($_GET['cc']))

    {

    include("./candidat.php");

    }



 

$idcand = (isset($_GET["idcand"]))? $_GET["idcand"] : '';

$idture = (isset($_GET["idture"]))? $_GET["idture"] : '';		





 $_SESSION['link_bak_a']=4;

 $_SESSION['link_bak_b']=40;           

 if($idture !=''){

 $_SESSION['link_bak_b']=41;   

 }

	

$req00_theme = mysql_query( "SELECT * FROM candidats where candidats_id = '".$idcand."'");

$data00 = mysql_fetch_array($req00_theme);

$ccandidat = $data00['prenom'].' '.$data00['nom'].'';

 

 //$_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];

 



  $nom_page_site = strtoupper($ccandidat) ;

 

 



$ariane=" Candidatures > <a href='?a=4&b=45'>Historique des candidats</a> > $ccandidat";	

		

    ?> 