<?php
  
session_start();

if(!isset($_SESSION['compte_v'])|| $_SESSION["compte_v"] == "") {  header("Location: ../../compte/");	 }  

if(!isset($_SESSION['menu5_c'])|| $_SESSION["menu5_c"] == 0) {  header("Location: ../../compte/");    }

require_once dirname(__FILE__) . "/../../../../config/config.php";

/*//////////////////////////////////////////////////////////////////////////////////////*/		
    $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;
    $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;		 

    $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;
    $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ;		
/*//////////////////////////////////////////////////////////////////////////////////////*/
//*/

 $q_offre_fili = str_replace("offre.id_offre", " candidature.id_offre", $q_offre_fili);
 $q_offre_fili_and = str_replace("offre.id_offre", " candidature.id_offre", $q_offre_fili_and);						

$offre_candidatures = (isset($_SESSION['offre_candidatures_0'])) ? $_SESSION['offre_candidatures_0'] : '' ;	

/*////////////////// partager and envoyer email all ////////////////////////////////////*/
if(isset($_POST['partage_tt'])  and (isset($_POST['select_candidature']) and  $_POST['select_candidature']!=''))
{
if(isset($_POST['select_candidature'])){$_SESSION['select0']=$_POST['select_candidature'];	}
echo '<meta http-equiv="refresh" content="0; url=../../popup/partager_candidature/">';
}

if(isset($_POST['email_tt']) and (isset($_POST['select_candidat']) and $_POST['select_candidat']!=''))
{
if(isset($_POST['select_candidat'])){$_SESSION['select1']=$_POST['select_candidat'];	}
echo '<meta http-equiv="refresh" content="0; url=../../popup/envoyer_email_pj/">';
}
/*//////////////////////////////////////////////////////////////////////////////////////*/
	
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
                    $retval .= (($time > 1 && $key != 'mois') ? $key.'s' : $key);
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
/*//////////////////////////////////////////////////////////////////////////////////////*/
$g_by=" GROUP BY  candidature.id_candidature  ";
/*//////////////////////////////////////////////////////////////////////////////////////*/
if(isset($_GET['cc']))
{include("../../home/popup/candidat.php");} 
 
/////////////////////////////////////////////traitement statut/////////////////////////////////////////////////   
include('traitement_candidature_non_retenu_t_req.php');
/////////////////////////////////////////////traitement statut///////////////////////////////////////////////// 

            
        
/////////////////////////////////////////////traitement filtrage///////////////////////////////////////////////// 
include('traitement_candidature_non_retenu_t_filtre.php');     
/////////////////////////////////////////////traitement filtrage/////////////////////////////////////////////////  
        
    
if(isset($_SESSION["query"])  ) {
    $pag_query = str_replace("*", "count(*)", $_SESSION['query']);
    if(  isset($_POST["envoi_fitrage"])) 
    $pag_query=$pag_query." ".$g_by;
    //echo $pag_query."<br>";
    $reqpagination=  mysql_query($pag_query);
    $nbItems = (isset($nbItems[0])) ? $nbItems[0] : 0 ;
    if(isset($_POST['nbr_parpage']) and  $_POST['nbr_parpage']!="" and is_numeric($_POST['nbr_parpage']))
       $itemsParPage = $_POST['nbr_parpage'];
    else
       $itemsParPage=10000;
    //Nombre de pages
    $nbPages = $nbItems/$itemsParPage;
    //Numero de Page courante
    if(isset($_POST['idPage']) and ($_POST['idPage']=="not" or $_POST['idPage']=="")){
     unset ($_POST['idPage']);
    }
    if(!isset($_POST['idPage'])){
    $pageCourante = 1;
    }   
    else{
    if(is_numeric($_POST['idPage']) && $_POST['idPage']<=$nbPages)
    $pageCourante = $_POST['idPage'];
    else
    $pageCourante = $nbPages;
    }
    //Calcul de la clause LIMIT
    $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
}

 $_SESSION['link_bak_a']=4;
 $_SESSION['link_bak_b']=49;            

        
 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];
     
  $nom_page_site ="CANDIDATURES NON RETENUES"  ;
 
   

    $ariane=" Candidatures > Traitement des candidatures non retenues ";
?>