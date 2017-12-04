<?php

       
$action = $data_accueil['action'];
$confirmation_statu = $data_accueil['confirmation_statu']; 
$lieux =$data_accueil['lieu'];
                      
$debut = $data_accueil['start'];
$fin = $data_accueil['end'];
                                          
$candidats__id = $data_accueil['candidats_id'];
$candidature__id = $data_accueil['id_candidature'];
                        
$msg = $data_accueil['obs'];
$msg1 = $data_accueil['obs'];
                                          
$s_candidats = mysql_query( "SELECT * FROM candidats 
    where candidats_id = '".$candidats__id."' limit 0,1");
$r_candidats = mysql_fetch_assoc($s_candidats); 
$r_c_nom = $r_candidats['nom']. '&nbsp;' .$r_candidats['prenom'];
$r_c_email= $r_candidats['email'];
$r_c_tel_1 = $r_candidats['tel1'];
$r_c_tel_2 = $r_candidats['tel1'];

                                            
/**/
$select02  = mysql_query("SELECT * from candidature 
    where id_candidature = '".$candidature__id."' 
     and  candidature.status = 'En cours'
     limit 0,1 ");
$reponse02 = mysql_fetch_array($select02);                                              
$offre__id = $reponse02['id_offre'];
//$percent = $reponse02['pertinence'];



$s_offre = mysql_query( "SELECT * FROM offre where  id_offre = '".$offre__id."' limit 0,1");
$r_offre = mysql_fetch_assoc($s_offre);  
$offre_name = $r_offre['Name'] ;

$r_historique = mysql_query("SELECT * from historique 
          where id_candidature = '".$candidature__id."' ORDER BY date_modification ASC");
$cpt = mysql_num_rows($r_historique);


?>