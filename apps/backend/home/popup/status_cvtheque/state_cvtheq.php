<?php  

session_start();

require(dirname(__FILE__).'/../../../../../config/config.php');




if(isset($_POST['candidats_id']) &&  !empty($_POST['status']))
{ 

			$idcand = isset($_POST['candidats_id'])  ? $_POST['candidats_id'] : "";
 			$status      = isset($_POST['status'])  	? $_POST['status']    		: ""; 
			$commentaire   	= isset($_POST['commentaire'])  	? $_POST['commentaire']    		: "";
			  
  $commentaire =str_replace('"', "'", $commentaire); 
			
 			$lieu     = isset($_POST['lieu'])   ? $_POST['lieu']    	 : "";
 			$dd1      = isset($_POST['dd1'])  	? $_POST['dd1']    		 : "";
 			$dh1      = isset($_POST['dh1'])  	? $_POST['dh1']    		 : "";
 			$dm1      = isset($_POST['dm1'])  	? $_POST['dm1']    		 : "";
 			$dd2      = isset($_POST['dd2'])  	? $_POST['dd2']    		 : $dd1;
 			$dh2      = isset($_POST['dh2'])  	? $_POST['dh2']    		 : $dh1;
 			$dm2      = isset($_POST['dm2'])  	? $_POST['dm2']    		 : $dm1;
			 
			
			$dd1 = implode('/', array_reverse(explode('/', $dd1)));
			$dd2 = implode('/', array_reverse(explode('/', $dd2)));
			 
			
			$idcand = isset($_POST['candidats_id'])  ? $_POST['candidats_id'] : "";
			
			$id_agenda='';
			
			
			
			
			
				
				/*/////////////////////////////////////////////	insert in agenda table	*/
				
				 
						$sql_where=$sql_and="";
				
						$Spt_Stg     = isset($_POST['Spt_Stg'])   ? $_POST['Spt_Stg']    	 : "";
			
						if($Spt_Stg=="CSpt"){$sql_where=" where `etat_7` in (1,2) ";$sql_and=" and `etat_7` in (1,2) "; }
						if($Spt_Stg=="CStg"){$sql_where=" where `etat_8` in (1,2) ";$sql_and=" and `etat_8` in (1,2) "; }
				
				
						$select_opt= "SELECT * FROM `prm_statut_candidature`where `etat_1` in (1,2) ".$sql_and."   " ;
						/*echo $select_opt;*/
						$select_opt_f = mysql_query($select_opt);
						
						$select_opt_f_num = mysql_num_rows($select_opt_f); 
			  
						if($select_opt_f_num>0){
							while($match =  mysql_fetch_array($select_opt_f) ) {
 
								
								$var_val= $match["ref_statut"];
								$var_statut= $match["statut"];
								
								if( $status == $var_val ){											
				
															$sql_10="select * from agenda_stage where candidats_id = '$idcand'";
															if($select10  = mysql_query($sql_10)){			
																	$reponse10 = mysql_fetch_array($select10);
																	$id_agenda = $reponse10['id_agenda'];			
															}
															if($id_agenda != ''){
															$sql_2=" UPDATE agenda_stage SET candidats_id='".safe($idcand)."',action='".safe($var_statut)."',
															obs='".safe($commentaire)."',lieu='".safe($lieu)."',
															confirmation_statu='0'  WHERE id_agenda='".safe($id_agenda)."' ";	 				
															} else {
															$sql_2="INSERT INTO agenda_stage VALUES ('','".safe($idcand)."',
																'".safe($var_statut)."','".safe($commentaire)."','".safe($lieu)."','0')";					
															}
														//echo "<br>".$sql_2."<br>";
														mysql_query($sql_2);
														if($id_agenda == '')	$id_agenda=mysql_insert_id();
													}
						}
				
				}
				/*/////////////////////////////////////////////		*/

				
				
			
			
			$date_modification = gmdate("Y-m-d H:i:s");
			 
			
			$ref= $r_statut =''; 

			
			 
				
				/*///////////////////////////////////////////// get ref email	*/
				
						$select_opt= "SELECT * FROM `prm_statut_candidature` ".$sql_where."   " ;
						/*echo $select_opt;*/
						$select_opt_f = mysql_query($select_opt);
						
						$select_opt_f_num = mysql_num_rows($select_opt_f); 
			  
						if($select_opt_f_num>0){
							while($match =  mysql_fetch_array($select_opt_f) ) {
 
								
								$var_val= $match["ref_statut"];
								
								if( $status == $var_val ){											
																$ref=$match["ref_email"];
																$r_statut=$match["statut"];
													}
						}
				
				}
				/*/////////////////////////////////////////////	*/
			
 
 
   
			if($r_statut !='Non retenu'){			$sql_up1  = 'En cours' ;	}
			else	{		$sql_up1  = 'Non retenu' ;		
			


			$sql_3='';$t_postulation='';
			$nom_tab= isset($_POST['nom_tab'])  	? $_POST['nom_tab']    		 : "";
				
			} 
			
			/*
			if($nom_tab=='candidature_spontanee') {$ref='';} //17
			elseif($nom_tab=='candidature_stage') {$ref='';} //18
			//*/
			if($ref!=''){
			//include("state_cvtheq_email_1.php");
			}
			//*			
			if($r_statut =='Non retenu'){		$sql_3="DELETE FROM $nom_tab  where candidats_id = '$idcand'";	
			 echo "<br>delete :".$sql_3."<br>";
			}else{
				$sql_edit_statut="UPDATE candidature_stage 
			SET etat='$r_statut' where candidats_id ='$idcand' ";
			echo $sql_edit_statut;
			}
			
			
			//*/
			
				
			
				if($sql_edit_statut!=''){
				$sql_up_edit  =mysql_query($sql_edit_statut);
				//
				$utilisateur	= $_SESSION['abb_admin'];$date_modification = gmdate("Y-m-d H:i:s");
				$req_sql='INSERT INTO historique_stage VALUES ("", "'.safe($idcand).'" ,
				 "'.safe($r_statut).'" , "'.safe($date_modification).'" , "'.safe($utilisateur).'" ,
				 "'.safe($lieu).'" , "'. safe($commentaire) .'" )';
				//echo "<br>".$req_sql."<br>";
				mysql_query($req_sql);

				//$affected = mysql_affected_rows($sql_up);
				$msg_pop='';
				if ($sql_up_edit){				
					$msg_pop ='';// '<p style=color:#09B34D>Votre action a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s !</p>';
				}else{	
					$msg_pop = '<p style=color:#CC0000>Une erreur est survenu veillez recommencer plus tard</p>';
				}
				
				$show= '	<div id="repertoire"><div id="fils"><div id="fade" style="background: #fff; " ></div>';
				//$show.='<div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%; overflow:auto" >';
				//$show.='<div class="titleBar">  <a href="javascript:fermer()">	  <div class="close" style="cursor: pointer;">close</div></a></div>'; 
				$show.='<div id="content" align="center" class="content" style=" height: 42px; "> <h3>'.$msg_pop.'</h3> </div></div></div> </div>';  
				$show.='  <meta http-equiv="refresh" content="0;'.$_SESSION['page_courant '].'" />   ';	
				}

				if($sql_3!=''){
				$sql_up  =mysql_query($sql_3);
			//$affected = mysql_affected_rows($sql_up);
				$msg_pop='';
				if ($sql_up){				
					$msg_pop ='';// '<p style=color:#09B34D>Votre action a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s !</p>';
				}else{	
					$msg_pop = '<p style=color:#CC0000>Une erreur est survenu veillez recommencer plus tard</p>';
				}
				
				$show= '	<div id="repertoire"><div id="fils"><div id="fade" style="background: #fff; " ></div>';
				//$show.='<div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%; overflow:auto" >';
				//$show.='<div class="titleBar">  <a href="javascript:fermer()">	  <div class="close" style="cursor: pointer;">close</div></a></div>'; 
				$show.='<div id="content" align="center" class="content" style=" height: 42px; "> <h3>'.$msg_pop.'</h3> </div></div></div> </div>';  
				$show.='  <meta http-equiv="refresh" content="0;'.$_SESSION['page_courant '].'" />   ';	
				}
				
			 
			 
		$show_f=  ' <html><head>'
				.'<link href="'.$cssurl.'/style_admin.php" rel="stylesheet" type="text/css" media="all" /> '
				.'</head><body>'
				
		.$show	
		 
				.'</body></html>';
				
				echo $show_f;
				
				
			}	else	{		
					echo '<p style=color:#CC0000>Le choix du statut est obligatoire !</p>';
					}

	?>