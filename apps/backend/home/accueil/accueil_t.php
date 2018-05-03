<?php 



// session_start();

if (session_status() == PHP_SESSION_NONE) session_start();


// if(isset($_SESSION['compte_v'])) {  header("Location: ../compte/");	 } 



// if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {    header("Location: ../login/"); }  

   



   

   

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

    require_once dirname(__FILE__) . "/../../../../config/config.php";

 

	

    $sql0_0 = "select id_role from role_offre where id_role=". $_SESSION['id_role']." ";

	$select0_0 = mysql_query($sql0_0); 

	// if(mysql_num_rows($select0_0) > 0)  { header("Location: ../compte/");	}	





/*//////////////////////////////////////////////////////////////////////////////////////*/		

		  $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;

		  $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;		 

	

		  $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;

		  $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ;		

		  

   





 $q_offre_fili = str_replace("offre.id_offre", " candidature.id_offre", $q_offre_fili);

 $q_offre_fili_and = str_replace("offre.id_offre", " candidature.id_offre", $q_offre_fili_and);		

		  

		  

 $tbl____o=$o____c=$where____and2="";$where____and= " where ";

			 

   if( empty($_SESSION['compte_v'])) {

	  

			 $offre_candidatures = $q_offre_fili = $q_offre_fili_and ="";

			 

		if(!empty($q_ref_fili)){	 $tbl____o=" , offre "; $where____and=" and ";$o____c=" candidature.id_offre=offre.id_offre"; $where____and2=" and "; }

			 

			  $q_offre_fili =  $q_ref_fili ;

			  $q_offre_fili_and = $q_ref_fili_and ;

			 

	  }  

	  

 /*//////////////////////////////////////////////////////////////////////////////////////*/

	

 $_SESSION['link_bak_a']=0;

 $_SESSION['link_bak_b']=00;

		

 $_SESSION['page_courant_ac']=$_SERVER['REQUEST_URI']; 

 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];



 



  $nom_page_site ="ACCUEIL"  ;

 

  

$ariane="Accueil  ";	

?>