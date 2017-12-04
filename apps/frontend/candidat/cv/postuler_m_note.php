<?php
 
 $id_candidat = $_SESSION['abb_id_candidat'];

/*==================================================================================================*/
$query_offre=" select c.id_candidature, c.id_offre, n.id_note1 from candidature  c
 inner join offre o ON c.id_offre = o.id_offre   
 inner join notation_1 n ON c.id_candidature = n.id_candidature 
 where o.status='En cours'  and c.candidats_id = '".$id_candidat."'";
 
 /*
echo $query_offre;
//*/

$req_offre = mysql_query($query_offre);
  $num_offre = mysql_num_rows($req_offre); 
            if($num_offre > 0){
				
while($offre = mysql_fetch_array($req_offre)){
    if($array_n['id_ecol'] == $ecoless_n['id_ecole']) 
    $note_ecole = $ecoless_n['note'];

/*==================================================================================================*/

$id_note1 = $offre['id_note1'];

$id_candidature = $offre['id_candidature'];

 $id_offre = $offre['id_offre'];
 
 
 /* */
 $notation = mysql_query("SELECT * from formations 
    where id_formation  = (SELECT MIN(id_formation) FROM formations where candidats_id = '".safe($id_candidat)."') LIMIT 0 , 1");
 $array_n = mysql_fetch_array($notation);
 
 
/* traitement ecole */
$note_ecole = 0;
$ecoless = mysql_query("SELECT *  FROM offre_necole  WHERE   id_offre = '".safe($id_offre)."'");
while($ecoless_n = mysql_fetch_array($ecoless)){
    if($array_n['id_ecol'] == $ecoless_n['id_ecole']) 
    $note_ecole = $ecoless_n['note'];
}


/* traitment filiere*/
$note_filiere = 0;
$filiere = mysql_query("SELECT *  FROM offre_nfiliere  WHERE   id_offre = '".safe($id_offre)."'");
while($filiere_n = mysql_fetch_array($filiere)){
    if($array_n['diplome'] == $filiere_n['id_fili'] ) 
    $note_filiere = $filiere_n['note'];  
}



/* traitment diplome*/
$note_diplome=1; 
  $date_f = $array_n['date_fin']; 
  $date_f = explode("/", $date_f); 
    if(!empty($date_f[2])) {
  $date_f_cl = (date("md", date("U", mktime(0, 0, 0, $date_f[0], $date_f[1], $date_f[2]))) > date("md") ? ((date("Y") - $date_f[2]) - 1) : (date("Y") - $date_f[2]));
  } else {
  $date_f_cl = (date("m", date("U", mktime(0,  $date_f[0] ))) > date("m") ? ((date("Y") - $date_f[1]) - 1) : (date("Y") - $date_f[1]));
  }
if($date_f_cl<2) 		 $note_diplome=5; 
if($date_f_cl<4 and $date_f_cl>1) 		 $note_diplome=3;

/* traitment experience*/
$note_experience=0;
$sum_day_exp=0;
    $select_experience_pro = mysql_query("SELECT * from experience_pro where id_tpost  <> '4' and candidats_id = '".safe($id_candidat)."' ");
    while($experience_pro = mysql_fetch_array($select_experience_pro)) {

	
		  $date_d = $experience_pro['date_debut']; 
		  $date_d = explode("/", $date_d); 
		  
		  $date_f =  (empty($experience_pro['date_fin'])) ? date("d/m/Y") : $experience_pro['date_fin'] ;  
		  $date_f = explode("/", $date_f); 
		  
   $dStart = new DateTime($date_d[2].'-'.$date_d[1].'-'.$date_d[0]);
   $dEnd  = new DateTime($date_f[2].'-'.$date_f[1].'-'.$date_f[0]);
   $dDiff = $dStart->diff($dEnd); 
   $sum_day_exp += $dDiff->days;
//*/
		
		}	
		$day_yr=$sum_day_exp/365; 
		$note_experience= round($day_yr*8, 0) ; 
		if($note_experience>40) 	$note_experience=40;
		

/* traitment stages*/
$note_stages=0;
$select_experience_pro_s = mysql_query("SELECT * from experience_pro where id_tpost  = '4'  and candidats_id = '".safe($id_candidat)."' ");
while($experience_pro_s = mysql_fetch_array($select_experience_pro_s)) {
    $note_stages=5;
}	

/* traitment experience plus 3 ans ==> stages = 0 */
		if($note_experience>23) $note_stages=0;

/* =========== insertion table notation =========== */	 
		
										/*	 UPDATE `notation_1` SET `id_note1`=[value-1],`id_candidature`=[value-2],`note_ecole`=[value-3],`note_filiere`=[value-4],`note_diplome`=[value-5],`note_experience`=[value-6],`note_stages`=[value-7],`obs`=[value-8] WHERE 1	*/
$sql_note = " UPDATE `notation_1` SET `id_candidature`='".safe($id_candidature)."',`note_ecole`='".safe($note_ecole)."',`note_filiere`='".safe($note_filiere)."',
`note_diplome`='".safe($note_diplome)."',	`note_experience`='".safe($note_experience)."',`note_stages`='".safe($note_stages)."',`obs`='".safe($day_yr)."'
 WHERE `id_note1`='".safe($id_note1)."' ";
										 
				//echo $sql_note;

mysql_query($sql_note);

/* =========== update table candidature =========== */	 

        $sum_not = $note_ecole + $note_filiere + $note_diplome + $note_experience + $note_stages ;
				mysql_query("UPDATE `candidature` SET  `notation`='$sum_not'  WHERE `id_candidature`='$id_candidature' ");


/*==================================================================================================*/

}

}		  
		  
/*==================================================================================================*/

 ?> 