<?php 
        
        
        
        
        
 /////////////////////////////////////////////traitement filtrage///////////////////////////////////////////////// 
if(isset($_POST["motcle"]) and $_POST["motcle"]!='')  $_SESSION["crc_motcle"]=$_POST["motcle"];
if(isset($_POST["pertinence"]) and $_POST["pertinence"]!='')  $_SESSION["crc_pertinence"]=$_POST["pertinence"];
if(isset($_POST["secteur"]) and $_POST["secteur"]!='')  $_SESSION["crc_secteur"]=$_POST["secteur"];
if(isset($_POST["fraicheur"]) and $_POST["fraicheur"]!='')  $_SESSION["crc_fraicheur"]=$_POST["fraicheur"];
if(isset($_POST["type_formation"]) and $_POST["type_formation"]!='')  $_SESSION["crc_type_formation"]=$_POST["type_formation"];
if(isset($_POST["exp"]) and $_POST["exp"]!='')  $_SESSION["crc_exp"]=$_POST["exp"];
if(isset($_POST["etablissement"]) and $_POST["etablissement"]!='')  $_SESSION["crc_etablissement"]=$_POST["etablissement"];
if(isset($_POST["pays"]) and $_POST["pays"]!='')  $_SESSION["crc_pays"]=$_POST["pays"];
if(isset($_POST["formation"]) and $_POST["formation"]!='')  $_SESSION["crc_formation"]=$_POST["formation"];
if(isset($_POST["situation"]) and $_POST["situation"]!='')  $_SESSION["crc_situation"]=$_POST["situation"];
if(isset($_POST["ref"]) and $_POST["ref"]!='')  $_SESSION["crc_ref"]=$_POST["ref"];
if(isset($_POST["campagne"]) and $_POST["campagne"]!='') $_SESSION["crc_campagne"]=$_POST["campagne"];

if(isset($_POST["region"]) and $_POST["region"]!='') $_SESSION["crc_region"]=$_POST["region"];
if(isset($_POST["r_ville"]) and $_POST["r_ville"]!='') $_SESSION["crc_region_ville"]=$_POST["r_ville"];
//------------------------------------------------------------------------------------------
if(isset($_POST["fonction"]) and $_POST["fonction"]!='')  $_SESSION["crc_fonction"]=$_POST["fonction"];  
if(isset($_POST["age"]) and $_POST["age"]!='')  $_SESSION["crc_age"]=$_POST["age"];  
if(isset($_POST["sexe"]) and $_POST["sexe"]!='')  $_SESSION["crc_sexe"]=$_POST["sexe"];  
/////////////////////////////////////////////////////////////////////////////////////////////
	  
	       
          
          if(isset($_POST['actualiser']))	{

				$_POST['motcle']="";
				$_SESSION["crc_motcle"]="";

				$_POST['fonction']="";
				$_SESSION["crc_fonction"]="";

				$_POST['pays']="";
				$_SESSION["crc_pays"]="";

				$_POST['exp']="";
				$_SESSION["crc_exp"]="";

				$_POST['secteur']="";
				$_SESSION["crc_secteur"]="";

				$_POST['pertinence']=""; 
				$_SESSION["crc_pertinence"]=""; 

				$_POST['fraicheur']="";
				$_SESSION["crc_fraicheur"]="";

				$_POST['situation']="";
				$_SESSION["crc_situation"]="";

				$_POST['etablissement']="";
				$_SESSION["crc_etablissement"]="";

				$_POST['type_formation']="";
				$_SESSION["crc_type_formation"]="";

				$_POST['formation']="";
				$_SESSION["crc_formation"]="";

				$_POST['ref']="";
				$_SESSION["crc_ref"]="";

                $_POST['campagne']="";
                $_SESSION["crc_campagne"]="";

                $_POST['region']="";
                $_SESSION["crc_region"]="";

                $_POST['r_ville']="";
                $_SESSION["crc_region_ville"]="";
				
				 $_POST['age']="";
                $_SESSION["crc_age"]="";
				 $_POST['sexe']="";
                $_SESSION["crc_sexe"]="";

				}



        
         
              
              
             $requete = ""; 
              $filtrage="&filtrage=filtrage";
                     
                       
            

 

    
 
        
             
          
 
        
/////////////////////////////////////////////traitement filtrage/////////////////////////////////////////////////  
        
        
        if(!empty($_SESSION["crc_motcle"])||!empty($_SESSION["crc_fonction"])||!empty($_SESSION["crc_pertinence"])||!empty($_SESSION["crc_fraicheur"])
            ||!empty($_SESSION["crc_region"])||!empty($_SESSION["crc_region_ville"])
            ||!empty($_SESSION["crc_notation"])||!empty($_SESSION["crc_pays"])||!empty($_SESSION["crc_formation"])||!empty($_SESSION["crc_type_formation"])
			||!empty($_SESSION["crc_exp"])||!empty($_SESSION["crc_secteur"])||!empty($_SESSION["crc_situation"])||!empty($_SESSION["crc_etablissement"])
			||!empty($_SESSION["crc_ref"])||!empty($_SESSION["crc_campagne"])
			|| !empty($_SESSION['crc_sexe']) || !empty($_SESSION['crc_age']))
        
		{
                            
  
	$tab_c=$tab_f=$tab_o=$tab_n_c=$tab_n_f=$tab_n_o=$tab_a_c=$tab_a_f=$tab_a_o
    =$tab_f=$tab_n_f=$tab_a_f=$tab_c_r=$tab_n_c_r=$tab_a_c_r=$tab_o_c=$tab_n_o_c=$tab_a_o_c="";
   
  
                       
            if(!empty($_SESSION["crc_pays"]))
			{
				$requete .= " and candidats.id_pays = '".$_SESSION["crc_pays"]."'";
				
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
			}
			if(!empty($_SESSION["crc_region"]))
            {
            $requete .= " and candidature_region.id_region = '".$_SESSION["crc_region"]."'";
    
                if($tab_c_r==""){ $tab_c_r=1;
                    $tab_n_c_r=" ,candidature_region ";
                    $tab_a_c_r=" candidature.id_candidature = candidature_region.id_candidature and ";
                    }
            }

            if(!empty($_SESSION["crc_region_ville"]))
            {
            $requete .= " and candidature_region.ville_region = '".$_SESSION["crc_region_ville"]."'";
    
                if($tab_c_r==""){ $tab_c_r=1;
                    $tab_n_c_r=" ,candidature_region ";
                    $tab_a_c_r=" candidature.id_candidature = candidature_region.id_candidature and ";
                    }
            }
            if(!empty($_SESSION["crc_ville"]))
			{
            $requete .= " and candidats.ville = '".$_SESSION["crc_ville"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
			}   
            
            if(!empty($_SESSION["crc_formation"]))
            {  
                    $requete .= " And candidats.id_nfor = '".$_SESSION["crc_formation"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }
			
			
			//---------------------age and sexe----------------------------------------------	

  if(!empty($_SESSION["crc_sexe"]))
            
			{
			if($_SESSION['crc_sexe']=="1"){
				
					 $requete .= " And candidats.id_civi =1";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}

					}else if($_SESSION['crc_sexe']=="2"){
									
					    $requete .= " And (candidats.id_civi =2 OR candidats.id_civi=4)";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}

					}  
			}
			
			//-------------------age---------
			

			//*************
			  if(!empty($_SESSION["crc_age"]))
            {
			
	if($_SESSION['crc_age']==1){
	  $requete .=" And (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 18 YEAR AND CURDATE() - INTERVAL 15 YEAR) ";
				
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
}elseif($_SESSION['crc_age']==2){
  $requete .=" And (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 30 YEAR AND CURDATE() - INTERVAL 18 YEAR) ";
				
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}

}elseif($_SESSION['crc_age']==3){

  $requete .=" And (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 40 YEAR AND CURDATE() - INTERVAL 30 YEAR) ";
				
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
}elseif($_SESSION['crc_age']==4){

  $requete .=" And (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 60 YEAR AND CURDATE() - INTERVAL 40 YEAR) ";
				
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
  }elseif($_SESSION['crc_age']==5){

  $requete .=" And (STR_TO_DATE(date_n, '%d/%m/%Y') BETWEEN CURDATE() - INTERVAL 90 YEAR AND CURDATE() - INTERVAL 60 YEAR) ";
				
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
  }
		
}	
			

		
//--------------------- end: age and sexe----------------------------------------------	
			
            if(!empty($_SESSION["crc_fonction"]))
            {
                    $requete .= " And candidats.id_fonc = '".$_SESSION["crc_fonction"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }  
			
            if(!empty($_SESSION["crc_type_formation"]))
            { 
                    $requete .= " And candidats.id_tfor = '".$_SESSION["crc_type_formation"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }
			
            if(!empty($_SESSION["crc_exp"]))
            {
                    $requete .= " And candidats.id_expe = '".$_SESSION["crc_exp"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }
			
            if(!empty($_SESSION["crc_secteur"]))
            {
                    $requete .= " And candidats.id_sect = '".addslashes($_SESSION["crc_secteur"])."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }
			
            if(!empty($_SESSION["crc_situation"]))
            {
                    $requete .= " And candidats.id_situ = '".$_SESSION["crc_situation"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }     
			
            if(!empty($_SESSION["crc_fraicheur"]))
            {
                    $requete .= " And DATEDIFF(curdate(),dateMAJ)<'".$_SESSION["crc_fraicheur"]."'";
					

				if($tab_c==""){  $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }   
			
            if(!empty($_SESSION["crc_ref"]))
            {
                    $requete .= " And offre.reference = '".$_SESSION["crc_ref"]."'";
	
				if($tab_o==""){ $tab_o=1;
					$tab_n_o=" ,offre ";
					$tab_a_o=" candidature.id_offre = offre.id_offre and ";
					}
            }
			if(!empty($_SESSION["crc_campagne"]))
            {
                    $requete .= " And campagne_offres.id_compagne = '".$_SESSION["crc_campagne"]."'";
    
                if($tab_o_c==""){ $tab_o_c=1;
                    $tab_n_o_c=" ,campagne_offres ";
                    $tab_a_o_c=" candidature.id_offre = campagne_offres.id_offre and ";
                    }
            }
            if(!empty($_SESSION["crc_etablissement"]))
            {
                    $requete .= " And formations.id_ecol = '".$_SESSION["crc_etablissement"]."'";
	
				if($tab_f==""){ $tab_f=1;
					$tab_n_f=" ,formations ";
					$tab_a_f=" candidature.candidats_id = formations.candidats_id and ";
					}
            }   
			
			
			
            if(!empty($_SESSION["crc_pertinence"]))
            {
                  
                    $p_f=$_SESSION["crc_pertinence"];
                    if($p_f==100){$p_d=$p_f=100;}
					elseif($p_f<100 and $p_f>=40 ){$p_d=40;$p_f=99;}
					elseif(  $p_f<40 ){$p_d=0;$p_f=39;}
					
                    $requete .= " And total_p BETWEEN '".$p_d."' AND '".$p_f."' ";
					
					$tab_n_p=" ,pertinence_oc ";
					$tab_a_p=" candidature.id_offre = pertinence_oc.id_offre and  candidature.candidats_id = pertinence_oc.candidats_id and pertinence_oc.ref_p='p' and  ";
 
            }
			
            if(!empty($_SESSION["crc_notation"]))
            {
                    $p_f=$_SESSION["crc_notation"];if($p_f==10){$p_d=$p_f-10;}else{$p_d=$p_f-30;}
                    $requete .= " And notation BETWEEN '".$p_d."' AND '".$p_f."' ";
					
 
            }   
			
			
			
		
              if(!empty($_SESSION["crc_motcle"]))
            {
                $requete .= " And lower(concat_ws(' ',titre,formations.id_ecol,formations.diplome,
                    formations.description, candidats.nom, candidats.prenom, candidats.email,
             CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%".$_SESSION["crc_motcle"]."%')";
			 

					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					$tab_n_f=" ,formations ";
					$tab_a_f=" candidature.candidats_id = formations.candidats_id and ";
					$tab_n_o=" ,offre ";
					$tab_a_o=" candidature.id_offre = offre.id_offre and ";
					$tab_n_p=" ,pertinence_oc ";
					$tab_a_p=" candidature.id_offre = pertinence_oc.id_offre and  candidature.candidats_id = pertinence_oc.candidats_id and pertinence_oc.ref_p='p' and  ";
 
            }
			
			if($tbl____o!="") {$tab_n_o="";}
			
            //  
            //$g_by_query = str_replace(" where ", " ,offre,candidats,notation_1 where ", $_SESSION['query']);
			
				

				/*$_SESSION['query'] = str_replace(" ".$tab_n_c.$tab_n_c_r.$tab_n_f.$tab_n_o.$tab_n_p.$tab_n_o_c." where  ".$tab_a_c.$tab_a_c_r.$tab_a_f.$tab_a_o.$tab_a_p.$tab_a_o_c." ", "where", $_SESSION['query']);
                
                $query_add_table = str_replace("where", " ".$tab_n_c.$tab_n_c_r.$tab_n_f.$tab_n_o.$tab_n_p.$tab_n_o_c." where  ".$tab_a_c.$tab_a_c_r.$tab_a_f.$tab_a_o.$tab_a_p.$tab_a_o_c." ", $_SESSION['query']);
				
              $g_by_query = str_replace("GROUP BY candidature.id_candidature", "", $query_add_table); 
			  
            $_SESSION['query']= $g_by_query." ".$requete.$g_by." ";   */
				$_SESSION['query'] = str_replace(" ".$tab_n_c.$tab_n_c_r.$tab_n_f.$tab_n_o.$tab_n_p.$tab_n_o_c." WHERE  ".$tab_a_c.$tab_a_c_r.$tab_a_f.$tab_a_o.$tab_a_p.$tab_a_o_c." ", "WHERE", $_SESSION['query']);
                
                $query_add_table = str_replace("WHERE", " ".$tab_n_c.$tab_n_c_r.$tab_n_f.$tab_n_o.$tab_n_p.$tab_n_o_c." WHERE  ".$tab_a_c.$tab_a_c_r.$tab_a_f.$tab_a_o.$tab_a_p.$tab_a_o_c." ", $_SESSION['query']);
                
              $g_by_query = str_replace("GROUP BY candidature.id_candidature", "", $query_add_table); 
              
            $_SESSION['query']= $g_by_query." ".$requete.$g_by." "; 
			
        }
     
        
       
      
     
        
        
        
        
/////////////////////////////////////////////traitement filtrage/////////////////////////////////////////////////  
        
          
         //echo  "filter ::  <br>".$_SESSION['query']; 
     
   
?>