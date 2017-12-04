<?php



session_start();



if(!isset($_SESSION['compte_v'])|| $_SESSION["compte_v"] == "") {  header("Location: ../../compte/");	 }  



if(!isset($_SESSION['menu4_c'])|| $_SESSION["menu4_c"] == 0) {  header("Location: ../../compte/");    }





/*//////////////////////////////////////////////////////////////////////////////////////*/		

		  $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;

		  $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;		 

	

		  $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;

		  $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ;		

 /*//////////////////////////////////////////////////////////////////////////////////////*/

			

//*/



 $q_offre_fili = str_replace("offre.id_offre", " candidature.id_offre", $q_offre_fili);

 $q_offre_fili_and = str_replace("offre.id_offre", " candidature.id_offre", $q_offre_fili_and);						



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

          

          

          

        require_once dirname(__FILE__) . "/../../../../config/config.php";



 



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

 

 



$offre_candidatures = (isset($_SESSION['offre_candidatures_0'])) ? $_SESSION['offre_candidatures_0'] : '' ; 







/////////////////////////////////////////////traitement statut/////////////////////////////////////////////////   

include('traitement_candidature_recruter_t_req.php');

/////////////////////////////////////////////traitement statut///////////////////////////////////////////////// 



             

        

/////////////////////////////////////////////traitement filtrage///////////////////////////////////////////////// 

include('traitement_candidature_recruter_t_filtre.php');     

/////////////////////////////////////////////traitement filtrage///////////////////////////////////////////////// 





        

        

         

        

          

          



		  



       

/////////////////////////////////////////////traitement filtrage/////////////////////////////////////////////////  

        

       

if(isset($_SESSION["query"]))   { 

  

 



/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

$query=$_SESSION["query"];

$select = mysql_query($query);



$tpc = mysql_num_rows($select);                     

$nbItems = $tpc;

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;

$nbPages = ceil ( $nbItems / $itemsParPage );

if (! isset ( $_GET ['idPage'] ))

$pageCourante = 1;        

elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)

$pageCourante = $_GET ['idPage'];

else

$pageCourante = 1;

// Calcul de la clause LIMIT

$limitstart = $pageCourante * $itemsParPage - $itemsParPage;

 //



$sql_pagination=$query."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination

 

      

        }

        

        

    

 $_SESSION['link_bak_a']=4;

 $_SESSION['link_bak_b']=47;            

 

        

 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI']; 

    

  $nom_page_site ="CANDIDATURES RECRUTES"  ;

 

   



    $ariane=" Candidatures > Traitement des candidatures recrut&#233;";

?>