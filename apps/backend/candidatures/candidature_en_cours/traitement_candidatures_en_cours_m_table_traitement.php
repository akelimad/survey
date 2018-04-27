<?php



//debut candidats

$s_candidats = mysql_query( "SELECT * FROM candidats 

    where candidats_id = '".$return['candidats_id']."' limit 0,1");

$r_candidats = mysql_fetch_assoc($s_candidats);     

//$select_pays = mysql_query("SELECT * from prm_pays where id_pays = '" . $data_candidats['id_pays'] . "' "); 

//$data_pays = mysql_fetch_array($select_pays); 



$newformat = eta_date($r_candidats['date_n'], 'Y-m-d'); 

$age = (time() - strtotime($newformat)) / 3600 / 24 / 365;

$nomPre = $r_candidats['prenom'].'&nbsp;'.$r_candidats['nom'];



$info_entr = 'color:#090'  ;

$lien_candidats =  ''.$urladmin.'/historique_candidats/candidats/?btn_a=m&idcand='.$return['candidats_id'].'&idture='.$return['id_candidature'].''; 

//fin candidats



//debut candidature 

// echo "<br> "."SELECT * FROM candidature where  id_candidature = '".$return['id_candidature']."' limit 0,1";

$s_candidature = mysql_query( "SELECT * FROM candidature where  id_candidature = '".$return['id_candidature']."' limit 0,1");

$r_candidature = mysql_fetch_assoc($s_candidature);

//fin candidature 



//debut offre

// echo " <br>id_offre :".$r_candidature['id_offre']; 

// echo " <br>"."SELECT * FROM offre where  id_offre = '".$r_candidature['id_offre']."' limit 0,1";

$s_offre = mysql_query( "SELECT * FROM offre where  id_offre = '".$return['id_offre']."' limit 0,1");

$r_offre = mysql_fetch_assoc($s_offre);             

// echo " <br>Name :".$r_offre['Name']; 

// echo " <br>reference :".$r_offre['reference']; 

//fin offre





// debut historique

$s_historique ="SELECT * from historique 

  where id_candidature = '".$return['id_candidature']."' ORDER BY date_modification ASC";

$r_historique = mysql_query($s_historique);

$cpt_historique = mysql_num_rows($r_historique);



$historique = mysql_query("SELECT * from historique 

where id_candidature = '".$return['id_candidature']."' 

ORDER BY id  DESC limit 0,1");

$cpt = mysql_num_rows($historique);

$s_r_historique = mysql_fetch_assoc($historique);

// fin historique



//debut formation

$s_formations = mysql_query( "SELECT * FROM formations 

    where  id_formation = '".$r_candidats['id_formation']."' limit 0,1");

$r_formations = mysql_fetch_assoc($s_formations);

//fin formation

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



$s_prm_pays = mysql_query("SELECT * from prm_pays 

    where id_pays = '" . $r_candidats['id_pays'] . "'  limit 0,1");

$r_prm_pays = mysql_fetch_assoc($s_prm_pays);



$s_prm_situation = mysql_query("SELECT * from prm_situation 

    where id_situ = '".$r_candidats['id_situ']."'  limit 0,1");

$r_prm_situation = mysql_fetch_assoc($s_prm_situation);



$s_prm_niv_formation = mysql_query("SELECT * from prm_niv_formation 

    where id_nfor = '".$r_candidats['id_nfor']."'  limit 0,1");

$r_prm_niv_formation = mysql_fetch_assoc($s_prm_niv_formation);



$s_prm_formation = mysql_query("SELECT * from prm_type_formation 

    where id_tfor = '".$r_candidats['id_tfor']."'  limit 0,1");

$r_prm_formation = mysql_fetch_assoc($s_prm_formation);



$s_prm_sectors = mysql_query( "SELECT * FROM prm_sectors 

    where id_sect = '".$r_candidats['id_sect']."'  limit 0,1");

$r_prm_sectors = mysql_fetch_assoc($s_prm_sectors);



$s_prm_experience = mysql_query("SELECT * from prm_experience 

    where id_expe = '".$r_candidats['id_expe']."'  limit 0,1");

$r_prm_experience = mysql_fetch_assoc($s_prm_experience);



$s_prm_salaires = mysql_query("SELECT * from prm_salaires 

    where id_salr = '".$r_candidats['id_salr']."'  limit 0,1");

$r_prm_salaires = mysql_fetch_assoc($s_prm_salaires);



 /*=============================================

 ===========================================================================*/

//traitement CV

$s_cv=mysql_query("SELECT cv.id_cv, cv.lien_cv 

from cv 

inner join candidature on cv.id_cv= candidature.id_cv 

where candidature.candidats_id='".$return['candidats_id']."'  limit 0,1");

$r_cv = mysql_fetch_assoc($s_cv); 

//fin traitement cv



//traitement LM

$s_lettres_motivation = mysql_query("SELECT lettres_motivation.lettre from lettres_motivation  inner join candidature on lettres_motivation.id_lettre= candidature.id_lettre   

where  candidature.id_candidature = ".$return['id_candidature']."  limit 0,1");

$r_lettres_motivation = mysql_fetch_assoc($s_lettres_motivation);

//fin traitement LM



//debut historique utilisateur

$s_root_roles = mysql_query("SELECT * from root_roles where login = '".$_SESSION["abb_admin"]."' limit 0,1");

$r_root_roles = mysql_fetch_assoc($s_root_roles);

//fin historique utilisateur            



//debut notation 1         

$s_notation_1 = mysql_query("SELECT * from notation_1 

    where id_candidature = '".$return['id_candidature']."'  limit 0,1"); 

$r_notation_1 = mysql_fetch_assoc($s_notation_1);



$sum_not1 = $r_notation_1['note_ecole'] + $r_notation_1['note_filiere'] 

+ $r_notation_1['note_diplome'] + $r_notation_1['note_experience'] + $r_notation_1['note_stages'] ; 

//fin notation 1



//debut notation 2 

$s_notation_2 = mysql_query("SELECT * from notation_2 

    where id_candidature = '".$return['id_candidature']."'  limit 0,1 "); 

$r_notation_2 = mysql_fetch_array($s_notation_2);



$sum_note2 = ($r_notation_2['note_qualif']*0.5) + ($r_notation_2['note_commun']*0.3)

 + ($r_notation_2['note_compor']*0.2)  ; 

//fin notation 2 



//calcule somme calcule notation 

$sum_not = ($sum_not1*0.4)+($sum_note2*0.6) ;

$sum_not1_final = ( $sum_not1  ) * 0.4;

$sum_not1_final2 = $sum_not1_final ; 

        

$sum_note2_final = ( ( $sum_note2  * 2.5) * 0.6);

$sum_note2_final2 = $sum_note2_final ;

$sum_note2_final2 = number_format($sum_note2_final2, 2, ',', ' ');



$sum_ffinal = $sum_not1_final + $sum_note2_final;

$sum_ffinal2 = $sum_ffinal  ;            

//fin somme calcule notation          



//début traitement postit

$re_postit = mysql_query(" SELECT * FROM postit WHERE id_candidature='".$return['id_candidature']."' ");

if($postit01 = mysql_fetch_assoc($re_postit)){ $postit_c=$postit01['postit']; }

else {$postit_c='';} 

//fin traitement postit





/*========================================================================================================================*/

                 

?>