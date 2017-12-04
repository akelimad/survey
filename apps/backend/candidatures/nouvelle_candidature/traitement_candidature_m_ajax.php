<?php

session_start();

		
		
/* MAJ */
if($_POST['MAJ']=="1"){

					$query  =  $_SESSION["query"];  
					$query = $query."  ORDER BY  LPAD(notation, 20, '0') desc ";
					$req  =  mysql_query($query);


//*
while($return_maj = mysql_fetch_array($req))
     {
		 
		 			$s_candidats = mysql_query( "SELECT * FROM candidats where candidats_id = '".$return_maj['candidats_id']."' limit 0,1");
					$r_candidats = mysql_fetch_assoc($s_candidats);
					
					
			$querymaj = mysql_query("SELECT * from notation_1 where id_candidature = '".$r_candidats['id_candidature']."' "); 
			$start = microtime(true);
			if($data66 = mysql_fetch_array($querymaj)){
			$sum_not = $data66['note_ecole'] + $data66['note_filiere'] + $data66['note_diplome'] + $data66['note_experience'] + $data66['note_stages'] ;    
			 // mysql_query("UPDATE candidature SET notation='".safe($sum_not)."' where id_candidature = '".$return_maj['id_candidature']."' ");
			}
			/* */ 
					
			$select_offre = mysql_query("SELECT * from offre where id_offre = '".safe($r_candidats['id_offre'])."' limit 0,1");
			$offre = mysql_fetch_assoc($select_offre);
			/* */
			$pertinence = mysql_query("SELECT *  FROM candidats  WHERE   candidats_id = '".$r_candidats['candidats_id']."' limit 0,1");

			$array = mysql_fetch_assoc($pertinence);
			$percent_for = 0;
			$percent_exp = 0;

			if($array['id_nfor'] == $offre['id_nfor']) $percent_for = 60;
			if($array['id_expe'] == $offre['id_expe']) $percent_exp = 40;
			$percent = $percent_for +  $percent_exp;
			 // mysql_query("UPDATE candidature SET pertinence='".safe($percent)."' where id_candidature = '".$return_maj['id_candidature']."' ");

			/*echo "".$array['id_nfor'] ."== ".$offre['id_nfor']." <br/>";
			echo "UPDATE candidature SET pertinence='".safe($percent)."' where id_candidature = '".$return_maj['id_candidature']."' <br/>";*/
			/* */    
	}             
//*/
   
}