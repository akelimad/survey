<?php 



session_start();



if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");	 } 



if(!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == ""){	header("Location:  ../../login/") ; }





if(!isset($_SESSION['id']) or $_SESSION['id']!=1)

$_SESSION['id']=1;



if(isset($_GET['email_tt']) and (isset($_GET['select']) and $_GET['select']!=''))

{

    if(isset($_GET['select'])){$_SESSION['select_s']=$_GET['select'];   }

echo '<meta http-equiv="refresh" content="0; url=../../popup/partager_stage/">';

//header("Location:  ../email_list_stage_p.php") ;

}



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

		$chaine=substr($chaine,0,$nbrMotCarct).'.';

        return $chaine;

		}

    else{

		

		$chaineNouvelle=substr($chaineNouvelle,0,$nbrMotCarct).'.';

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



    



 $_SESSION['link_bak_a']=4;

 $_SESSION['link_bak_b']=44;



        

 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];

 

 

     

  $nom_page_site ="CANDIDATURES POUR SRAGE"  ;

 

    

$ariane=" Candidatures > Traitement des candidatures pour stage "; 

?>