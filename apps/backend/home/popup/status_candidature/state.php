<?php  


session_start();

require(dirname(__FILE__).'/../../../../../config/config.php');




if(isset($_POST['id_candidature']) &&  !empty($_POST['status']))
{
			$id_candidature = isset($_POST['id_candidature'])  ? $_POST['id_candidature'] : "";
			$sql_1="select * from candidature where id_candidature = '$id_candidature'";
			//echo "<br>".$sql_1."<br>";
			$select  = mysql_query($sql_1);
			$reponse = mysql_fetch_array($select);
			$idcand = $reponse['candidats_id'];
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
			
			//$dateDebut = implode('-', array_reverse(explode('/', $dateDebut)));
			
			$dd1 = implode('/', array_reverse(explode('/', $dd1)));
			$dd2 = implode('/', array_reverse(explode('/', $dd2)));
			$id_agenda='';
				$dt1 = $dd1.' '.$dh1.':'.$dm1;		$dt2 = $dd2.' '.$dh2.':'.$dm2;	//->format('Y-m-d H:i:s');
				
				
			 
				
				/*/////////////////////////////////////////////	insert in agenda table	*/
				
						$select_opt= "SELECT * FROM `prm_statut_candidature`where `etat_1` in (1,2) and  `etat_2` in (1,2)  " ;
						/*echo $select_opt;*/
						$select_opt_f = mysql_query($select_opt);
						
						$select_opt_f_num = mysql_num_rows($select_opt_f); 
			  
						if($select_opt_f_num>0){
							while($match =  mysql_fetch_array($select_opt_f) ) {
 
								
								$var_val= $match["ref_statut"];
								$var_statut= $match["statut"];
								
								if( $status == $var_val ){											
															$sql_10="select * from agenda where id_candidature = '$id_candidature'";
															//echo "<br>".$sql_1."<br>";
															if($select10  = mysql_query($sql_10)){			
																	$reponse10 = mysql_fetch_array($select10);
																	$id_agenda = $reponse10['id_agend'];			
															}
															if($id_agenda != ''){
															$sql_2=" UPDATE agenda SET candidats_id='".safe($idcand)."',
															id_candidature='".safe($id_candidature)."',action='".safe($var_statut)."',
															obs='".safe($commentaire)."',lieu='".safe($lieu)."',start='".safe($dt1)."',
															end='".safe($dt2)."',confirmation_statu='0'  WHERE id_agend='".safe($id_agenda)."' ";	 				
															} else {
															$sql_2="INSERT INTO agenda VALUES ('','".safe($idcand)."','".safe($id_candidature)."',
																'".safe($var_statut)."','".safe($commentaire)."','".safe($lieu)."','".safe($dt1)."',
																'".safe($dt2)."','0')";					
															}
															/*echo "<br>".$sql_2."<br>";*/
															mysql_query($sql_2);
															if($id_agenda == '')	$id_agenda=mysql_insert_id(); 
													}
						}
				
				}
				/*/////////////////////////////////////////////		*/

				
				
			
			
			$date_modification = gmdate("Y-m-d H:i:s");
			 
			$ref= $r_statut ='';

			
			 
				
				/*///////////////////////////////////////////// get ref email	*/
				
						$select_opt= "SELECT * FROM `prm_statut_candidature`where `etat_2` in (1,2)   " ;
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
			else	{		$sql_up1  = 'Non retenu' ;	}
		 
					
				
				$sql_3="UPDATE candidature SET status='".safe($sql_up1)."' where id_candidature='".safe($id_candidature)."'";				
				/*echo "update : <br>".$sql_3."<br>";*/
			
		 	
				$sql_up  =mysql_query($sql_3);
			//$affected = mysql_affected_rows($sql_up);
			$msg_pop='';
				if ($sql_up){				
					$msg_pop ='';// '<p style=color:#09B34D>Votre action a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s !</p>';
				}else{	
					$msg_pop = '<p style=color:#CC0000>Une erreur est survenu veillez recommencer plus tard</p>';
				}
				

			
			$utilisateur	= $_SESSION['abb_admin'];

			$req_sql='INSERT INTO historique VALUES ("", "'.safe($id_candidature).'" , "'. safe($r_statut) .'" , "'.safe($date_modification).'" , "'.safe($utilisateur).'" , "'.safe($lieu).'" , "'. safe($commentaire) .'" )';
			//echo "<br>".$req_sql."<br>";
			mysql_query($req_sql);
			
 			$status_detail     = isset($_POST['status_detail'])   ? $_POST['status_detail']    	 : "";
 			$commentaire_detail     = isset($_POST['commentaire_detail'])   ? $_POST['commentaire_detail']    	 : "";
			if($status_detail!=''){
			$id_histo=mysql_insert_id();
			$req_sql01="INSERT INTO historique_detail VALUES ('','".safe($id_histo)."','".safe($status_detail)."','".safe($commentaire_detail)."')";
			//echo "<br>".$req_sql01."<br>";
			mysql_query($req_sql01);
			}
			//***************************************************************************************************************************************//
 
		
			
			
			//==============================================================     mail      ==========================================================//
			$mail_msg='';
				if($ref!=''){
			    /////////////////////////////////////////////////////////////////////////////////////////////////////////
				///////////////////////////////////// debut email de refus //////////////////////////////////////////////
				/////////////////////////////////////////////////////////////////////////////////////////////////////////
			 include("../state_email.php");
				
				///////////////////////////////////// email de refus //////////////////////////////////////////////
			
			}
			//***************************************************************************************************************************************//
				$h='42';
				if($mail_msg!='') $h='80';
				
		$show=  ' <html><head>'
				.'<link href="'.$cssurl.'/style_admin.php" rel="stylesheet" type="text/css" media="all" />'
				.'</head><body>'
				
		.'	<div id="repertoire01"><div id="fils"> <div id="fade" style="background: #fff; " ></div>'
		//.'<div class="popup_block"   style="width: 30%; z-index: 999; top: 30%; left: 40%; overflow:auto" >'
	//	.'<div class="titleBar">  <a href="javascript:fermer()">	  <div class="close" style="cursor: pointer;">close</div></a></div>'
		.'<div id="content" align="center" class="content" style=" height: '.$h.'px; ">'
		.'<h3>'.$msg_pop.'</h3>'.$mail_msg.' </div></div></div> </div>'
		.'<meta http-equiv="refresh" content="0;'.$_SESSION['page_courant '].'" />'
		 
				.'</body></html>';	
				
		echo $show;
				
				
			}	
					

	?>