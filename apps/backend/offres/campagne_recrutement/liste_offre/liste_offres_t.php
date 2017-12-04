<?php

session_start();
if(isset($_SESSION['compte_v'])) {  header("Location: ../../../compte/");  } 
if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {
    header("Location: ../../../login/"); 
}  
	   
require_once dirname(__FILE__) . "/../../../../../config/config.php";
        mysql_connect($serveur,$user,$passwd);
        mysql_select_db($bdd);
     
	 
/////////////////////////////////////////////////////

			  if(isset($_GET['in_d']) ) { 	$_SESSION['in_d0']=$_GET['in_d'];	};
			  
			$id_comp = (!empty($_SESSION['in_d0'])) ? $_SESSION['in_d0']  : ""; 
			$offres_id=$offre_id='';
			
		$sql__0 = "SELECT * FROM campagne_offres where id_compagne = ".$id_comp."     ";
	   $result__0 = mysql_query($sql__0); 			
				  $count = mysql_num_rows($result__0);
				if($count>0){        
                            while( $reponse = mysql_fetch_array($result__0)) {   
                            $offre_id .= " '".$reponse['id_offre']."' ,";
							   } 
							$offres_id=substr($offre_id, 0, -1);
					} 
					
					 $id_off = "  offre.id_offre in ( ".$offres_id." ) ";
 
				//$_SESSION['offre_comp']=" And  offre.id_offre in (".$offres_id.") ";

/////////////////////////////////////////////////////	 
          $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;
          $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;      
///////////////////////

			$id_o = (!empty($id_o)) ? $id_o : ''; 
if($id_o != '') { $id_o=" = ".$id_o;}
else { $id_o = " in ( ".$offres_id." ) ";}
	 
	    
        
        $sql_roles = mysql_query("SELECT * FROM  root_roles where login = '".$_SESSION['abb_admin']."' ");
        $rep_roles = mysql_fetch_assoc($sql_roles);
 
////////////////////////////////
if(isset($_SESSION["qry"]))
    {
//echo $_SESSION['qry'];

     
}
 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];
 

 $_SESSION['link_bak_a']=1;
 $_SESSION['link_bak_b']=16;
 
$sql_camp = " SELECT titre_compagne from campagne_recrutement where id_compagne = '".$_GET['in_d']."'
limit 0,1 ";
//echo $sql_camp;
$select_camp = mysql_query($sql_camp);
$rep_camp = mysql_fetch_assoc($select_camp);
$ss  = $rep_camp['titre_compagne']; 

  $nom_page_site = "OFFRES || CAMPAGNE DES RECRUTEMENT " ;
 
 
 $ariane=" Offres > <a href='../'>Campagne de recrutement</a> > $ss";  
?>