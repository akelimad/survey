<?php

$query = "SELECT  
candidature.candidats_id , candidature.id_candidature,
 candidature.id_offre 
 FROM   candidature  
where   candidature.status = 'En attente' 
 ".$q_offre_fili_and."  ".$offre_candidatures."  ";
                 
	
		$_SESSION["query"] = $query." ".$g_by ;                                                                                        
         
 // echo  $_SESSION["query"];

if(isset($query))
$_SESSION["query"] = $query." ".$g_by;  


?>