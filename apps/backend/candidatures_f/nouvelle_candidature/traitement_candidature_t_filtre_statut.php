<?php

        $query = "select * from candidats inner join candidature 
                on candidats.candidats_id = candidature.candidats_id inner join offre 
                on candidature.id_offre = offre.id_offre INNER JOIN formations 
                ON candidature.candidats_id = formations.candidats_id  
                where candidature.status = 'En attente'  ".$q_offre_fili_and."  ";
                
				
	
		$_SESSION["query"] = $query." ".$g_by ;                                                                                        
         
//echo  $_SESSION["query"];

?>