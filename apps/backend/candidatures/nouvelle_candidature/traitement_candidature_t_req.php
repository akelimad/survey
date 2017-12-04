<?php

	$query = "SELECT   candidature.candidats_id , candidature.id_candidature, candidature.id_offre 
				FROM   candidature  ". $tbl____o .$q_offre_fili.$where____and.$o____c. "  candidature.status = 'En attente' ";
                
				
	
		$_SESSION["query"] = $query." ".$g_by ;          
		
  /*	 echo  $_SESSION["query"];   */       
   

if(isset($query))
$_SESSION["query"] = $query." ".$g_by;  


?>