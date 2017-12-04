<?php

    $s_candidats = mysql_query( "SELECT * FROM candidats where candidats_id = '".$return['candidats_id']."' limit 0,1");
                    $r_candidats = mysql_fetch_assoc($s_candidats);
                 
                 // echo "<br> "."SELECT * FROM candidature where  id_candidature = '".$return['id_candidature']."' limit 0,1";
                      
                    $s_candidature = mysql_query( "SELECT * FROM candidature where  id_candidature = '".$return['id_candidature']."' limit 0,1");
                    $r_candidature = mysql_fetch_assoc($s_candidature);
                    
                 // echo " <br>id_offre :".$r_candidature['id_offre']; 
                  
                 // echo " <br>"."SELECT * FROM offre where  id_offre = '".$r_candidature['id_offre']."' limit 0,1";
                 
                    $s_offre = mysql_query( "SELECT * FROM offre where  id_offre = '".$return['id_offre']."' limit 0,1");
                    $r_offre = mysql_fetch_assoc($s_offre);
                 
                 // echo " <br>Name :".$r_offre['Name']; 
                 // echo " <br>reference :".$r_offre['reference']; 
                  
                    $s_formations = mysql_query( "SELECT * FROM formations where  id_formation = '".$r_candidats['id_formation']."' limit 0,1");
                    $r_formations = mysql_fetch_assoc($s_formations);
                 
                 
                ///////////////////////////////////////////////////
                $s_prm_region_ville = mysql_query("SELECT * from candidature_region 
                where id_candidature = '" .$return['id_candidature']. "'  limit 0,1"); 
                $r_prm_region_ville = mysql_fetch_assoc($s_prm_region_ville); 
                                 
                $s_prm_region = mysql_query("SELECT * from prm_region 
                where id_region = '" .$r_prm_region_ville['id_region']. "'  limit 0,1"); 
                $r_prm_region = mysql_fetch_assoc($s_prm_region);
                ////////////////////////////////////////////////////// 

                $s_prm_civilite = mysql_query("SELECT civilite from prm_civilite 
                     where id_civi = '" . $r_candidats['id_civi'] . "'  limit 0,1"); 
                $r_prm_civilite = mysql_fetch_assoc($s_prm_civilite); 

                $s_prm_fonction = mysql_query("SELECT fonction from prm_fonctions 
                    where id_fonc = '" . $r_candidats['id_fonc'] . "'  limit 0,1"); 
                $r_prm_fonction = mysql_fetch_assoc($s_prm_fonction); 

                $s_prm_disponibilite = mysql_query("SELECT intitule from prm_disponibilite 
                    where id_dispo = '" . $r_candidats['id_dispo'] . "'  limit 0,1"); 
                $r_prm_disponibilite = mysql_fetch_assoc($s_prm_disponibilite); 
                ////////////////////////////////////////////
                 
                $s_prm_pays = mysql_query("SELECT * from prm_pays where id_pays = '" . $r_candidats['id_pays'] . "'  limit 0,1"); 
                $r_prm_pays = mysql_fetch_assoc($s_prm_pays); 
                $s_prm_situation = mysql_query("SELECT * from prm_situation where id_situ = '".$r_candidats['id_situ']."'  limit 0,1");
                $r_prm_situation = mysql_fetch_assoc($s_prm_situation);
                $s_prm_niv_formation = mysql_query("SELECT * from prm_niv_formation where id_nfor = '".$r_candidats['id_nfor']."'  limit 0,1");
                $r_prm_niv_formation = mysql_fetch_assoc($s_prm_niv_formation);
                $s_prm_formation = mysql_query("SELECT * from prm_type_formation where id_tfor = '".$r_candidats['id_tfor']."'  limit 0,1");
                $r_prm_formation = mysql_fetch_assoc($s_prm_formation);
                $s_prm_sectors = mysql_query( "SELECT * FROM prm_sectors where id_sect = '".$r_candidats['id_sect']."'  limit 0,1");
                $r_prm_sectors = mysql_fetch_assoc($s_prm_sectors);
                $s_prm_experience = mysql_query("SELECT * from prm_experience where id_expe = '".$r_candidats['id_expe']."'  limit 0,1");
                $r_prm_experience = mysql_fetch_assoc($s_prm_experience);
                $s_prm_salaires = mysql_query("SELECT * from prm_salaires where id_salr = '".$r_candidats['id_salr']."'  limit 0,1");
                $r_prm_salaires = mysql_fetch_assoc($s_prm_salaires);
                
                 
                $s_cv=mysql_query("SELECT cv.id_cv, cv.lien_cv from cv join candidature on cv.id_cv= candidature.id_cv where candidature.candidats_id='".$return['candidats_id']."'  limit 0,1");
                $r_cv = mysql_fetch_assoc($s_cv);  
                
                 
                $s_lettres_motivation = mysql_query("SELECT lettres_motivation.lettre 
          from lettres_motivation 
          inner join candidature on lettres_motivation.id_lettre= candidature.id_lettre   
                    where  candidature.id_candidature = ".$return['id_candidature']."  limit 0,1");   
                $r_lettres_motivation = mysql_fetch_assoc($s_lettres_motivation); 
                 
                 
                $s_notation_1 = mysql_query("SELECT * from notation_1 where id_candidature = '".$return['id_candidature']."'  limit 0,1"); 
                $r_notation_1 = mysql_fetch_assoc($s_notation_1);
                 
                
                $s_historique  = mysql_query("SELECT * from historique where id_candidature = '".$return['id_candidature']."' limit 0,1");
                $r_historique = mysql_fetch_assoc($s_historique);
            
            
            
                $s_root_roles = mysql_query("SELECT * from root_roles where login = '".$_SESSION["abb_admin"]."' limit 0,1");
                $r_root_roles = mysql_fetch_assoc($s_root_roles);
        

?>