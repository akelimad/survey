<?php


$candidat_pertinence = mysql_query("SELECT * FROM candidats 
    where  candidats_id  IN ( SELECT candidats_id FROM candidature 
        WHERE id_offre=".$offre['id_offre']." and candidats_id IS NOT NULL) ");

// début while candidats
while($array_candidats_p = mysql_fetch_assoc($candidat_pertinence)){

$nbr_p_c=0;
$ref_pertinence = mysql_query("SELECT * FROM prm_pertinence WHERE ref_p = 'p' limit 0,1");
$prm_p_candidat = mysql_fetch_array($ref_pertinence);

if($prm_p_candidat['prm_titre'] == "1")
    {
        $nbr_p_c +=100;
        if(strpos( $array_candidats_p['titre'],$offre['Name']) !== false)
        {$percent_titre = 100;}else{$percent_titre = 0;}
    }
if($prm_p_candidat['prm_expe'] == "1")
    {
        $nbr_p_c +=100;
        if($array_candidats_p['id_expe'] == $offre['id_expe']) 
        {$percent_expe = 100;}else{$percent_expe = 0;}
    }
if($prm_p_candidat['prm_local'] == "1")
    {
        $nbr_p_c +=100;
        $candidat_ville = mysql_query("SELECT *  FROM prm_villes 
         WHERE   id_vill = '".$offre['id_localisation']."' limit 0,1 ");
        $array_villes_p = mysql_fetch_array($candidat_ville);

        $experience_pertinence_v = mysql_query("SELECT *  FROM experience_pro 
         WHERE   candidats_id = '".$array_candidats_p['candidats_id']."' ");
        while($array_experience_p_v = mysql_fetch_assoc($experience_pertinence_v))
        {
                if(($array_candidats_p['ville'] == $array_villes_p['ville'])
                OR ($array_experience_p_v['ville'] == $array_villes_p['ville'])) 
                {$percent_ville = 100;}else{$percent_ville = 0;}
        }
    }
if($prm_p_candidat['prm_tpost'] == "1")
    {
        $nbr_p_c +=100;
        $experience_pertinence_tp = mysql_query("SELECT *  FROM experience_pro 
         WHERE   candidats_id = '".$array_candidats_p['candidats_id']."'");
        while($array_experience_p_tp = mysql_fetch_assoc($experience_pertinence_tp))
        {
            if($array_experience_p_tp['id_tpost'] == $offre['id_tpost']) 
            {$percent_tposte = 100;}else{$percent_tposte = 0;}
        } 
    }
if($prm_p_candidat['prm_fonc'] == "1")
    {
        $nbr_p_c +=100;
$experience_pertinence = mysql_query("SELECT *  FROM experience_pro
 WHERE   candidats_id = '".$array_candidats_p['candidats_id']."' ");
while($array_experience_p = mysql_fetch_assoc($experience_pertinence))
{
        if(($array_experience_p['id_fonc'] == $offre['id_fonc'])
            OR ($array_candidats_p['id_fonc'] == $offre['id_fonc']))
        {$percent_fonction = 100;}else{$percent_fonction = 0;}
}
    }
if($prm_p_candidat['prm_nfor'] == "1")
    {
        $nbr_p_c +=100;
        $formations_pertinence = mysql_query("SELECT *  FROM formations
         WHERE   candidats_id = '".$array_candidats_p['candidats_id']."' ");
        while($array_formation_p = mysql_fetch_assoc($formations_pertinence))
        {
        if(($array_candidats_p['id_nfor'] == $offre['id_nfor'])
        OR ($array_formation_p['nivformation'] == $offre['id_nfor']) ) 
        {$percent_formation = 100;}else{$percent_formation = 0;}
        }
    }
if($prm_p_candidat['prm_mobil'] == "1")
    {
        $nbr_p_c +=100;
        if($array_candidats_p['mobilite'] == $offre['mobilite']) 
        {$percent_mobilite = 100;}else{$percent_mobilite = 0;}
    }
if($prm_p_candidat['prm_n_mobil'] == "1")
    {
        $nbr_p_c +=100;
        if($array_candidats_p['niveau_mobilite'] == $offre['niveau_mobilite']) 
        {$percent_niveau_mobilite = 100;}else{$percent_niveau_mobilite = 0;}
    }
if($prm_p_candidat['prm_t_mobil'] == "1")
    {
        $nbr_p_c +=100;
        if($array_candidats_p['taux_mobilite'] == $offre['taux_mobilite']) 
        {$percent_taux_mobilite = 100;}else{$percent_taux_mobilite = 0;}
    }

$somme_n1 = $percent_titre / $nbr_p_c;
$somme_n2 = $percent_expe / $nbr_p_c;
$somme_n3 = $percent_ville / $nbr_p_c;
$somme_n4 = $percent_tposte / $nbr_p_c;
$somme_n5 = $percent_fonction / $nbr_p_c;
$somme_n6 = $percent_formation / $nbr_p_c;
$somme_n7 = $percent_mobilite / $nbr_p_c;
$somme_n8 = $percent_niveau_mobilite / $nbr_p_c;
$somme_n9 = $percent_taux_mobilite / $nbr_p_c;

$t_s_n =$somme_n1 + $somme_n2 +$somme_n3+
$somme_n4+$somme_n5+$somme_n6+$somme_n7+$somme_n8+$somme_n9;

$s_note_finale = $t_s_n * 100 ;
$r_note_finale = number_format($s_note_finale,2);



$test_pertinence_id = mysql_query("SELECT id_p_oc FROM `pertinence_oc` 
    WHERE   id_offre = '".$offre['id_offre']."' 
    and  candidats_id = '".$array_candidats_p['candidats_id']."' and  
    ref_p= 'p'   limit 0,1 ");

if($id_pertinence_existe = mysql_fetch_assoc($test_pertinence_id)){
$s_p_sql=" UPDATE `pertinence_oc` SET  `ref_p`='p',
 `candidats_id`='".safe($array_candidats_p['candidats_id'])."',
  `id_offre`='".safe($offre['id_offre'])."',
   `prm_titre`='".safe($percent_titre)."', 
   `prm_expe`='".safe($percent_expe)."', 
   `prm_local`='".safe($percent_ville)."', 
   `prm_tpost`='".safe($percent_tposte)."', 
   `prm_mobil`='".safe($percent_mobilite)."', 
   `prm_n_mobil`='".safe($percent_niveau_mobilite)."',
    `prm_t_mobil`='".safe($percent_taux_mobilite)."',
     `prm_fonc`='".safe($percent_fonction)."',
      `prm_nfor`='".safe($percent_formation)."',
       `total_p`='".safe($r_note_finale)."' 
        WHERE `id_p_oc`='".safe($id_pertinence_existe['id_p_oc'])."'  ";  
}else{
$s_p_sql = "INSERT INTO pertinence_oc
(`ref_p`, `candidats_id`, `id_offre`,
 `prm_titre`, `prm_expe`, `prm_local`, `prm_tpost`,
  `prm_fonc`, `prm_nfor`, `prm_mobil`, `prm_n_mobil`,
   `prm_t_mobil`, `total_p`) 
    VALUES ('p','".safe($array_candidats_p['candidats_id'])."',
        '".safe($offre['id_offre'])."',
        '".safe($percent_titre)."','".safe($percent_expe)."',
        '".safe($percent_ville)."',
        '".safe($percent_tposte)."','".safe($percent_fonction)."',
        '".safe($percent_formation)."',
        '".safe($percent_mobilite)."',
        '".safe($percent_niveau_mobilite)."'
        ,'".safe($percent_taux_mobilite)."',
        '".safe($r_note_finale)."')";
}

$insertion_pertinence=mysql_query($s_p_sql);



}//fin while candidats



?>