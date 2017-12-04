<?php

$id_candidat = $resultat['candidats_id'];

$s_candidats = mysql_query( "SELECT * FROM candidats 
    where candidats_id = '".$id_candidat."' limit 0,1");
$r_candidats = mysql_fetch_assoc($s_candidats);

$selecCV = mysql_query("SELECT * from cv  where candidats_id='".$id_candidat."' 
    AND principal=1 AND actif=1");
$councv = mysql_num_rows($selecCV);
$result_cv = mysql_fetch_array($selecCV);

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
                

$s_prm_ecoles = mysql_query("SELECT nom_ecole,pays FROM prm_ecoles a, prm_pays b
where a.id_pays = b.id_pays and a.id_ecole = '" . $resultat['ecole'] . "' ");
$r_prm_ecoles = mysql_fetch_array($s_prm_ecoles);






?>