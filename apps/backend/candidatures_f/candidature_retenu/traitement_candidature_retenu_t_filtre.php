<?php

        
        
        
        
        
        
        
        
        
 /////////////////////////////////////////////traitement filtrage///////////////////////////////////////////////// 
if(isset($_POST["motcle"]) and $_POST["motcle"]!='')  					$_SESSION["crt_motcle"]=$_POST["motcle"];
if(isset($_POST["pertinence"]) and $_POST["pertinence"]!='')  			$_SESSION["crt_pertinence"]=$_POST["pertinence"];
if(isset($_POST["notation"]) and $_POST["notation"]!='')  				$_SESSION["crt_notation"]=$_POST["notation"];
if(isset($_POST["secteur"]) and $_POST["secteur"]!='')  				$_SESSION["crt_secteur"]=$_POST["secteur"];
if(isset($_POST["fraicheur"]) and $_POST["fraicheur"]!='')  			$_SESSION["crt_fraicheur"]=$_POST["fraicheur"];
if(isset($_POST["type_formation"]) and $_POST["type_formation"]!='')  	$_SESSION["crt_type_formation"]=$_POST["type_formation"];
if(isset($_POST["exp"]) and $_POST["exp"]!='')  						$_SESSION["crt_exp"]=$_POST["exp"];
if(isset($_POST["etablissement"]) and $_POST["etablissement"]!='')  	$_SESSION["crt_etablissement"]=$_POST["etablissement"];
if(isset($_POST["pays"]) and $_POST["pays"]!='')  						$_SESSION["crt_pays"]=$_POST["pays"];
if(isset($_POST["formation"]) and $_POST["formation"]!='')  			$_SESSION["crt_formation"]=$_POST["formation"];
if(isset($_POST["situation"]) and $_POST["situation"]!='')  			$_SESSION["crt_situation"]=$_POST["situation"];
if(isset($_POST["ref"]) and $_POST["ref"]!='')  						$_SESSION["crt_ref"]=$_POST["ref"];
      
if(isset($_POST["campagne"]) and $_POST["campagne"]!='') $_SESSION["crt_campagne"]=$_POST["campagne"]; 
	       
if(isset($_POST["ville"]) and $_POST["ville"]!='')                      $_SESSION["crt_ville"]=$_POST["ville"];

if(isset($_POST["campagne"]) and $_POST["campagne"]!='') $_SESSION["crt_campagne"]=$_POST["campagne"]; 

if(isset($_POST["region"]) and $_POST["region"]!='') $_SESSION["crt_region"]=$_POST["region"];
if(isset($_POST["r_ville"]) and $_POST["r_ville"]!='') $_SESSION["crt_region_ville"]=$_POST["r_ville"];

          if(isset($_POST['actualiser']))	{

				$_POST['motcle']="";
				$_SESSION["crt_motcle"]="";

				$_POST['fonction']="";
				$_SESSION["crt_fonction"]="";

				$_POST['pays']="";
				$_SESSION["crt_pays"]="";

				$_POST['exp']="";
				$_SESSION["crt_exp"]="";

				$_POST['secteur']="";
				$_SESSION["crt_secteur"]="";

				$_POST['pertinence']=""; 
				$_SESSION["crt_pertinence"]="";

                $_POST['notation']=""; 
                $_SESSION["crt_notation"]=""; 

				$_POST['fraicheur']="";
				$_SESSION["crt_fraicheur"]="";

				$_POST['situation']="";
				$_SESSION["crt_situation"]="";

				$_POST['etablissement']="";
				$_SESSION["crt_etablissement"]="";

				$_POST['type_formation']="";
				$_SESSION["crt_type_formation"]="";

				$_POST['formation']="";
				$_SESSION["crt_formation"]="";

				$_POST['ref']="";
				$_SESSION["crt_ref"]="";

                $_POST['ville']="";
                $_SESSION["crt_ville"]="";
                
                $_POST['campagne']="";
                $_SESSION["crt_campagne"]="";

                $_POST['region']="";
                $_SESSION["crt_region"]="";

                $_POST['r_ville']="";
                $_SESSION["crt_region_ville"]="";

				}



        
        
 
              
              
             $requete = ""; 
              $filtrage="&filtrage=filtrage";
                     
                       
            



        if(!empty($_SESSION["crt_motcle"])||!empty($_SESSION["crt_fonction"])||!empty($_SESSION["crt_pertinence"])||!empty($_SESSION["crt_fraicheur"])
            ||!empty($_SESSION["crt_region"])||!empty($_SESSION["crt_region_ville"])
            ||!empty($_SESSION["crt_notation"])||!empty($_SESSION["crt_pays"])||!empty($_SESSION["crt_formation"])||!empty($_SESSION["crt_type_formation"])||!empty($_SESSION["crt_exp"])||!empty($_SESSION["crt_secteur"])||!empty($_SESSION["crt_situation"])||!empty($_SESSION["crt_etablissement"])||!empty($_SESSION["crt_ref"])
            ||!empty($_SESSION["crt_ville"])||!empty($_SESSION["crt_campagne"]))

        {
                            
  
	$tab_c=$tab_f=$tab_o=$tab_n_c=$tab_n_f=$tab_n_o=$tab_a_c=$tab_a_f=$tab_a_o
    =$tab_f=$tab_n_f=$tab_a_f=$tab_c_r=$tab_n_c_r=$tab_a_c_r="";
  
                       
            if(!empty($_SESSION["crt_pays"]))
			{
				$requete .= " and candidats.id_pays = '".$_SESSION["crt_pays"]."'";
				
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
			}
			if(!empty($_SESSION["crt_region"]))
            {
            $requete .= " and candidature_region.id_region = '".$_SESSION["crt_region"]."'";
    
                if($tab_c_r==""){ $tab_c_r=1;
                    $tab_n_c_r=" ,candidature_region ";
                    $tab_a_c_r=" candidature.id_candidature = candidature_region.id_candidature and ";
                    }
            }

            if(!empty($_SESSION["crt_region_ville"]))
            {
            $requete .= " and candidature_region.ville_region = '".$_SESSION["crt_region_ville"]."'";
    
                if($tab_c_r==""){ $tab_c_r=1;
                    $tab_n_c_r=" ,candidature_region ";
                    $tab_a_c_r=" candidature.id_candidature = candidature_region.id_candidature and ";
                    }
            }
            if(!empty($_SESSION["crt_ville"]))
			{
            $requete .= " and candidats.ville = '".$_SESSION["crt_ville"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
			}   
            
            if(!empty($_SESSION["crt_formation"]))
            {  
                    $requete .= " And candidats.id_nfor = '".$_SESSION["crt_formation"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }
			
            if(!empty($_SESSION["crt_fonction"]))
            {
                    $requete .= " And candidats.id_fonc = '".$_SESSION["crt_fonction"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }  
			
            if(!empty($_SESSION["crt_type_formation"]))
            { 
                    $requete .= " And candidats.id_tfor = '".$_SESSION["crt_type_formation"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }
			
            if(!empty($_SESSION["crt_exp"]))
            {
                    $requete .= " And candidats.id_expe = '".$_SESSION["crt_exp"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }
			
            if(!empty($_SESSION["crt_secteur"]))
            {
                    $requete .= " And candidats.id_sect = '".addslashes($_SESSION["crt_secteur"])."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }
			
            if(!empty($_SESSION["crt_situation"]))
            {
                    $requete .= " And candidats.id_situ = '".$_SESSION["crt_situation"]."'";
	
				if($tab_c==""){ $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }     
			
            if(!empty($_SESSION["crt_fraicheur"]))
            {
                    $requete .= " And DATEDIFF(curdate(),dateMAJ)<'".$_SESSION["crt_fraicheur"]."'";
					

				if($tab_c==""){  $tab_c=1;
					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					}
            }   
			
            if(!empty($_SESSION["crt_ref"]))
            {
                    $requete .= " And offre.reference = '".$_SESSION["crt_ref"]."'";
	
				if($tab_o==""){ $tab_o=1;
					$tab_n_o=" ,offre ";
					$tab_a_o=" candidature.id_offre = offre.id_offre and ";
					}
            }
			
            if(!empty($_SESSION["crt_etablissement"]))
            {
                    $requete .= " And formations.id_ecol = '".$_SESSION["crt_etablissement"]."'";
	
				if($tab_f==""){ $tab_f=1;
					$tab_n_f=" ,formations ";
					$tab_a_f=" candidature.candidats_id = formations.candidats_id and ";
					}
            }   
			
			//, filtre par campagne de recrutement
            if(!empty($_SESSION["crt_campagne"]))
            {
                    $requete .= " And campagne_offres.id_compagne = '".$_SESSION["crt_campagne"]."'";
    
                if($tab_o_c==""){ $tab_o_c=1;
                    $tab_n_o_c=" ,campagne_offres ";
                    $tab_a_o_c=" candidature.id_offre = campagne_offres.id_offre and ";
                    }
            }
			
            if(!empty($_SESSION["crt_pertinence"]))
            {
                    $p_f=$_SESSION["crt_pertinence"];
                    if($p_f==100){$p_d=$p_f=100;}
                    elseif($p_f<100 and $p_f>=40 ){$p_d=40;$p_f=99;}
                    elseif(  $p_f<40 ){$p_d=0;$p_f=39;}
                    
                    $requete .= " And total_p BETWEEN '".$p_d."' AND '".$p_f."' ";
                    
                    $tab_n_p=" ,pertinence_oc ";
                    $tab_a_p=" candidature.id_offre = pertinence_oc.id_offre and  candidature.candidats_id = pertinence_oc.candidats_id and pertinence_oc.ref_p='p' and  ";
 
            }
			
            if(!empty($_SESSION["crt_notation"]))
            {
                    $p_f=$_SESSION["crt_notation"];if($p_f==10){$p_d=$p_f-10;}else{$p_d=$p_f-30;}
                    $requete .= " And notation BETWEEN '".$p_d."' AND '".$p_f."' ";
					
 
            }   
			
			
			
		
              if(!empty($_SESSION["crt_motcle"]))
            {
                $requete .= " And lower(concat_ws(' ',titre,formations.id_ecol,formations.diplome,
                    formations.description, candidats.nom, candidats.prenom, candidats.email,
             CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%".$_SESSION["crt_motcle"]."%')";
			 

					$tab_n_c=" ,candidats ";
					$tab_a_c=" candidature.candidats_id = candidats.candidats_id and ";
					$tab_n_f=" ,formations ";
					$tab_a_f=" candidature.candidats_id = formations.candidats_id and ";
					$tab_n_o=" ,offre ";
					$tab_a_o=" candidature.id_offre = offre.id_offre and ";
            }
			
			
            //  
            //$g_by_query = str_replace(" where ", " ,offre,candidats,notation_1 where ", $_SESSION['query']);
			
				$_SESSION['query'] = str_replace(" ".$tab_n_c.$tab_n_c_r.$tab_n_f.$tab_n_o.$tab_n_p.$tab_n_o_c." WHERE  ".$tab_a_c.$tab_a_c_r.$tab_a_f.$tab_a_o.$tab_a_p.$tab_a_o_c." ", "WHERE", $_SESSION['query']);
                
                $query_add_table = str_replace("WHERE", " ".$tab_n_c.$tab_n_c_r.$tab_n_f.$tab_n_o.$tab_n_p.$tab_n_o_c." WHERE  ".$tab_a_c.$tab_a_c_r.$tab_a_f.$tab_a_o.$tab_a_p.$tab_a_o_c." ", $_SESSION['query']);
                
              $g_by_query = str_replace("GROUP BY candidature.id_candidature", "", $query_add_table); 
              
            $_SESSION['query']= $g_by_query." ".$requete.$g_by." ";  

        
    
                       

        }

     
          
           
       
/////////////////////////////////////////////traitement filtrage/////////////////////////////////////////////////  
        
?>