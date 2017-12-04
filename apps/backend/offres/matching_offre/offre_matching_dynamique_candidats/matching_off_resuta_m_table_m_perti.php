<?php
ini_set('max_execution_time', 0);

/*-------------------------------------------------------------------------------------------------*/
 

					
	//	  echo  "<br>--------------------<br>r_prm_pertinence<br>--------------------<br>" ;
          
		 
//*/

 
 
 
$sql_tbl_offre_p =  "SELECT id_offre,Name,id_expe,id_localisation,id_tpost,mobilite,niveau_mobilite,taux_mobilite,id_fonc,id_nfor FROM offre WHERE id_offre=".$p_id_offre." limit 0,1 " ;

 /*
  echo  "<br>--------------------<br>"; 
 echo $sql_tbl_offre_p; 
  echo  "<br>--------------------<br>";
 */ 
 
$tbl_offre_p = mysql_query($sql_tbl_offre_p);
  while($r_offre = mysql_fetch_assoc($tbl_offre_p))
   {
	
	
	

		  

	//	  echo  "<br>--------------------<br>r_offre<br>--------------------<br>" ; 
		 $o_titre			=	 $r_offre['Name']	;
		 $o_expe			= 	 $r_offre['id_expe']	;
		 $o_local			= 	 $r_offre['id_localisation']	;
		 $o_tpost		    = 	 $r_offre['id_tpost']	;
		 $o_mobil			= 	 $r_offre['mobilite']	;
		 $o_n_mobil			= 	 $r_offre['niveau_mobilite']	;
		 $o_t_mobil	 		= 	 $r_offre['taux_mobilite']	;
		 $o_fonc			= 	 $r_offre['id_fonc']	;
		 $o_nfor  			= 	 $r_offre['id_nfor']	;	
		 
 
 /**/
 
 $sql_tbl_candidats_p = "SELECT candidats_id FROM candidats  where  candidats_id   =".$p_candidats_id."   limit 0,1  ";
/*
 echo  "<br>--------------------<br>"; 
 echo $sql_tbl_candidats_p; 
 echo  "<br>--------------------<br>";
 */
$candidat_pertinence = mysql_query($sql_tbl_candidats_p);

// début while candidats
while($r_candidats_req = mysql_fetch_assoc( $candidat_pertinence )){
	
	
	/*=============================================================================================*/
	 
			
  
		$tbl_candidats = mysql_query("SELECT candidats_id,titre,id_expe,mobilite,niveau_mobilite,niveau_mobilite,taux_mobilite,id_fonc,id_nfor,ville FROM `candidats` WHERE   candidats_id = '".$r_candidats_req['candidats_id']."' limit 0,1 ");
		$r_candidats = mysql_fetch_assoc($tbl_candidats); 
 
 

 

		 

		  

		 
	//	  echo  "<br>--------------------<br>r_candidats<br>--------------------<br>" ; 
		$c_titre			=	 $r_candidats['titre']	;
		$c_expe				= 	 $r_candidats['id_expe']	; 
		$c_mobil			= 	 $r_candidats['mobilite']	;
		$c_n_mobil		    = 	 $r_candidats['niveau_mobilite']	;
		$c_t_mobil			= 	 $r_candidats['taux_mobilite']	;
		$c_fonc    			=    $r_candidats['id_fonc']	;
		$c_nfor     	 	=    $r_candidats['id_nfor']	;
		 
		   
	//	  echo  "<br>--------------------<br>prm_villes<br>--------------------<br>" ;
	
	
		 if ( $prm_local==1    )   {
		$prm_villes = mysql_query("SELECT id_vill FROM `prm_villes` WHERE   ville = '". $r_candidats['ville']."' limit 0,1 ");
		$r_prm_villes = mysql_fetch_assoc($prm_villes);  
		 $c_local   = $r_prm_villes['id_vill']	;
		 }
		 
	//	  echo  "<br>--------------------<br>formations<br>--------------------<br>" ;
		 
		 
		 if ( $prm_nfor==1   )   {
		$tbl_formations = mysql_query("SELECT nivformation FROM `formations` WHERE   candidats_id = '".$r_candidats['candidats_id']."'  ");
		 }
		 
		 
	//	  echo  "<br>--------------------<br>experience_pro<br>--------------------<br>" ;
		 
		 
		 if ($prm_tpost==1  or $prm_fonc==1  )   {
		$tbl_experience_pro = mysql_query("SELECT id_tpost,id_fonc FROM `experience_pro` WHERE   candidats_id = '".$r_candidats['candidats_id']."' ");
		  }
		 
		 
		 
		 
		  
	//	  echo  "<br>--------------------<br> init <br>--------------------<br>" ;

	
 $t_prm_activ = $t_r_match = $t_r_match_titre = $t_r_match_expe = $t_r_match_local = $t_r_match_mobil = $t_r_match_n_mobil = $t_r_match_t_mobil = $t_r_match_fonc = $t_r_match_nfor = $t_r_match_tpost = $p__match_titre = $p__match_expe = $p__match_local = $p__match_mobil = $p__match_n_mobil = $p__match_t_mobil = $p__match_fonc = $p__match_nfor = $p__match_tpost = 0 ;
		 
 $t_prm_activ = $prm_titre + $prm_expe + $prm_local + $prm_tpost + $prm_mobil + $prm_n_mobil + $prm_t_mobil + $prm_fonc	+ $prm_nfor ;
		  
		  
	
	//	  echo  "<br>--------------------<br> if candidats <br>--------------------<br>" ; 	  
		  
		 
		 if ( $prm_titre==1  and  (strpos( $o_titre,$c_titre) !== false)) {
		   $t_r_match_titre  = 1; $p__match_titre  = 100;
		}
 
		 if ( $prm_expe==1  and  $o_expe== $c_expe)   {
		   $t_r_match_expe  = 1;$p__match_expe  = 100;
		} 
		 
		 if ( $prm_local==1  and  $o_local== $c_local)   {
		   $t_r_match_local  = 1; $p__match_local  = 100;
		} 
		 
		 
		 if ( $prm_mobil==1  and  $o_mobil== $c_mobil)   {
		   $t_r_match_mobil  = 1;$p__match_mobil  = 100;
		} 
		 
		 if ( $prm_n_mobil==1  and  $o_n_mobil== $c_n_mobil and  $o_mobil=="oui" )   {
		   $t_r_match_n_mobil  = 1;  $p__match_n_mobil  = 100;
		} 
		 
		 if ( $prm_t_mobil==1  and  $o_t_mobil== $c_t_mobil and  $o_mobil=="oui" )   {
		   $t_r_match_t_mobil  = 1; $p__match_t_mobil  = 100;
		} 
		 
		 if ( $prm_fonc==1  and  $o_fonc== $c_fonc)   {
		   $t_r_match_fonc  = 1;$p__match_fonc  = 100;
		} 
		 
		 if ( $prm_nfor==1  and  $o_nfor== $c_nfor)   {
		   $t_r_match_nfor  = 1;$p__match_nfor  = 100;
		} 
		 
		  
	//	  echo  "<br>--------------------<br> if formations <br>--------------------<br>" ; 	 
		 if ( $prm_nfor==1   )   {
		 while($r_tbl_formations = mysql_fetch_assoc($tbl_formations))
						{ 
									
								 $f_nfor  			= 	 $r_tbl_formations['nivformation']	;	

								 if (    $o_nfor== $f_nfor)   {
								   $t_r_match_nfor  = 1;$p__match_nfor  = 100;
								} 
		 
						}
		 }
		 

		 
	//	  echo  "<br>--------------------<br> if expetiences <br>--------------------<br>" ; 	 
		 if ( $prm_tpost==1  or $prm_fonc==1 )   {
		 while($r_tbl_experience_pro = mysql_fetch_assoc($tbl_experience_pro))
						{
		   
								 $e_tpost			    = 	 $r_tbl_experience_pro['id_tpost']	;
								 $e_fonc				= 	 $r_tbl_experience_pro['id_fonc']	;
								 

								 if ( $prm_tpost==1  and  $o_tpost== $e_tpost)   {
								   $t_r_match_tpost  = 1;$p__match_tpost  = 100;
								} 
								 
								 if ( $prm_fonc==1  and  $o_fonc== $e_fonc)   {
								   $t_r_match_fonc  = 1;$p__match_fonc  = 100;
								} 
						}
		 }

		 
		 

	//	  echo  "<br>--------------------<br> resulta <br>--------------------<br>" ; 
		

		
		  $t_r_match  = $t_r_match_titre+$t_r_match_expe+$t_r_match_local+$t_r_match_mobil +$t_r_match_n_mobil+$t_r_match_t_mobil  +$t_r_match_fonc+$t_r_match_nfor+$t_r_match_tpost;

		 
		 
 
		 if($t_r_match==0) { $r_match_result=0; }
		 elseif(!empty($t_prm_activ) and !empty($t_r_match)){ $r_match_result=($t_r_match/$t_prm_activ); }
		 else { $r_match_result=0; }
		 
		 
		 
		 $r_match_result_s=round(($r_match_result*100), 2);
		 
		 
		  
 if($r_match_result_s>$min_p_a_req){		

		 
		  
	//	  echo  "<br>--------------------<br> debut  INSERT & UPDATE <br>--------------------<br>" ; 
		$prm_pertinence_tst = mysql_query("SELECT id_p_oc FROM `pertinence_oc` WHERE   id_offre = '".$r_offre['id_offre']."' and  candidats_id = '".$r_candidats['candidats_id']."' and  ref_p= 'd'   limit 0,1 ");
		
		
		if($r_prm_pertinence_tst = mysql_fetch_assoc($prm_pertinence_tst)){
			
$sql_pertinence="
UPDATE `pertinence_oc` SET  `ref_p`='d', `candidats_id`='".safe($r_candidats['candidats_id'])."', `id_offre`='".safe($r_offre['id_offre'])."', `prm_titre`='".safe($p__match_titre)."', `prm_expe`='".safe($p__match_expe)."', `prm_local`='".safe($p__match_local)."', `prm_tpost`='".safe($p__match_tpost)."', `prm_mobil`='".safe($p__match_mobil)."', `prm_n_mobil`='".safe($p__match_n_mobil)."', `prm_t_mobil`='".safe($p__match_t_mobil)."', `prm_fonc`='".safe($p__match_fonc)."', `prm_nfor`='".safe($p__match_nfor)."', `total_p`='".safe($r_match_result_s)."'  WHERE `id_p_oc`='".safe($r_prm_pertinence_tst['id_p_oc'])."'  
";	

		} else {
			
$sql_pertinence="
INSERT INTO `pertinence_oc`(  `ref_p`, `candidats_id`, `id_offre`, `prm_titre`, `prm_expe`, `prm_local`, `prm_tpost`, `prm_mobil`, `prm_n_mobil`, `prm_t_mobil`, `prm_fonc`, `prm_nfor`, `total_p` ) VALUES ('d','".safe($r_candidats['candidats_id'])."','".safe($r_offre['id_offre'])."','".safe($p__match_titre)."','".safe($p__match_expe)."','".safe($p__match_local)."','".safe($p__match_tpost)."','".safe($p__match_mobil)."','".safe($p__match_n_mobil)."','".safe($p__match_t_mobil)."','".safe($p__match_fonc)."','".safe($p__match_nfor)."','".safe($r_match_result_s)."' )
";			

		}

// echo "<br>--------------------<br>";
 // echo $sql_pertinence;
		 
	    $p_pertinence=mysql_query( $sql_pertinence );
 
	//	  echo  "<br>--------------------<br> fin  INSERT & UPDATE <br>--------------------<br>" ; 
 }
 
 
 
  
 
 
 
 
 /// 
	
	/*=============================================================================================*/



}//fin while candidats



}//fin while offre



?>