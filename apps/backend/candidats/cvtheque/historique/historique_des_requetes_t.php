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

                        



	//  -d-  																						

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

	//  -f-  

$requete;

$option = 2;

$fvar;

function date_diff1($date1, $date2) {

    $s = strtotime($date2) - strtotime($date1);

    $d = intval($s / 86400) + 1;

    return "$d";

}



$g_by=" GROUP BY candidats.candidats_id ";

$g_by1=" GROUP BY cv.candidats_id ";

     

function switchdate($var) 

{ 

$tab = explode("/",$var); 

$datechangee = $tab[2]."-".$tab[1]."-".$tab[0]; 

return $datechangee ; 

} 



 

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

	if (isset($_GET['id']) && !empty($_GET['id'])) {

                $id = $_GET['id'];

                if ($_GET['action'] == "delete") {

                          if (mysql_query("delete from historique_cvtheque  where id_hit_cvtheq='$id'")) {

                            //  $_SESSION['msg'] = "L'agent ou le responsable de communication est supprimé avec succès";

                           header("location:./");                                        

                          } else {

                              $_SESSION['erreur'] = "Une erreur est survenue lors de la suppression";                                       

                          }                                     

                          

                  }    

              }

              $popup_div="";

       if(isset($_POST['email_tt'])){

        

        $result_unique =  array_keys(array_flip($_POST['select'])); 

        

        

                                            

    $cama='' ;$txt_area="";

            for ($i = 0; $i < count($result_unique); $i++){     if($i!=0) $cama=', ' ;      

            $txt_area.=$cama.$result_unique[$i];            

            } 

            

    $sql_delete = mysql_query("DELETE from historique_cvtheque WHERE id_hit_cvtheq IN (".$txt_area.") ");

    

        

        $popup_div='    <script type="text/javascript">  alert("Suppression avec succès!"); </script> ';

        

        }

	 if (isset($_GET['actualiser'])) {

                        $_GET['motcle'] = "";        $_GET['d_env'] = "";      



                    }

 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];

 

 

 $_SESSION['link_bak_a']=2;

 $_SESSION['link_bak_b']=24; 			

          

 

  $nom_page_site ="CV-THEQUE || HISTORIQUES DES REQUETES"  ;

  

     

$ariane=" Candidats > <a href='../?a=2&b=24'>CV thèque</a> > Historiques des requêtes";	

		

    ?> 