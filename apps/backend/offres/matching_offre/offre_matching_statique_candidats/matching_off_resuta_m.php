<div class='texte' >

        <br/><h1>MATCHING DES OFFRES</h1>



 <div class="haha">

 <?php

 



    if( isset($_GET['offre'])  )

    {

		$ref_pertinence = mysql_query("SELECT min_p_a FROM prm_pertinence WHERE ref_p = 'm' limit 0,1");

        $prm_p_candidat = mysql_fetch_array($ref_pertinence);

				

        $query_count_co=mysql_query(" SELECT c.candidats_id FROM candidats c ,offre o WHERE o.id_expe=c.id_expe and o.id_fonc=c.id_fonc and o.id_nfor=c.id_nfor and o.id_localisation=(SELECT id_vill FROM prm_villes 

										WHERE ville=c.ville limit 0,1) and o.id_offre=".$id_offre." and c.candidats_id not in (SELECT candidats_id FROM candidature WHERE id_offre=".$id_offre." ) " ); 

												

$num_rows_co = mysql_num_rows($query_count_co);

							

        $query_count_p_co=mysql_query("		SELECT candidats_id 

											FROM pertinence_oc

											WHERE  	 id_offre=".$id_offre."  "); 



$num_rows_p_co = mysql_num_rows($query_count_p_co);							

				

/*

echo "--->$num_rows_co<br>--->$num_rows_p_co<br>";

*/



/*===========================================================================================================*/	

if($num_rows_co<>$num_rows_p_co){			

/*===========================================================================================================*/



mysql_query(" DELETE FROM pertinence_oc WHERE  id_offre=".$id_offre."  "); 





/*

		$query_M_pertinence="SELECT * FROM candidats 

		where  candidats_id  NOT IN ( SELECT candidats_id FROM candidature 

        WHERE id_offre=".$offre['id_offre']." and candidats_id IS NOT NULL) ";

*/

        $query_M_pertinence=" SELECT c.candidats_id,o.id_offre FROM candidats c ,offre o WHERE o.id_expe=c.id_expe and o.id_fonc=c.id_fonc and o.id_nfor=c.id_nfor and o.id_localisation=(SELECT id_vill FROM prm_villes 

										WHERE ville=c.ville limit 0,1) and o.id_offre=".$id_offre." and c.candidats_id not in (SELECT candidats_id FROM candidature WHERE id_offre=".$id_offre." ) " ; 

							

$candidat_pertinence = mysql_query($query_M_pertinence);



$percent_titre=$percent_expe=$percent_ville=$percent_tposte=$percent_fonction=$percent_formation=$percent_mobilite=$percent_niveau_mobilite=$percent_taux_mobilite=$min_p_a_req=0;



// début while candidats



while($array_candidats_p = mysql_fetch_assoc($candidat_pertinence)){



$sql_tbl_offre_p =  "SELECT id_expe,id_fonc,id_nfor,id_localisation FROM offre WHERE id_offre=".$array_candidats_p['id_offre']."  limit 0,1" ;

 

$tbl_offre_p = mysql_query($sql_tbl_offre_p);



$offre = mysql_fetch_assoc($tbl_offre_p); 



$sql_tbl_candidats_p =  "SELECT id_expe,id_fonc,id_nfor,ville FROM candidats WHERE candidats_id=".$array_candidats_p['candidats_id']."  limit 0,1" ;

 

$tbl_candidats_p = mysql_query($sql_tbl_candidats_p);



$candidats = mysql_fetch_assoc($tbl_candidats_p); 



/**/

$nbr_p_c=0;

$ref_pertinence = mysql_query("SELECT * FROM prm_pertinence WHERE ref_p = 'm' limit 0,1");

$prm_p_candidat = mysql_fetch_array($ref_pertinence);

	/*

if($prm_p_candidat['prm_titre'] == "1")

    {

        $nbr_p_c +=100;

        if(strpos( $array_candidats_p['titre'],$offre['Name']) !== false)

        {$percent_titre = 100;}else{$percent_titre = 0;}

    }

	*/

if($prm_p_candidat['prm_expe'] == "1")

    {

        $nbr_p_c +=100;

        if($candidats['id_expe'] == $offre['id_expe']) 

        {$percent_expe = 100;}else{$percent_expe = 0;}

    }

if($prm_p_candidat['prm_local'] == "1")

    {  

        $nbr_p_c +=100;

        $candidat_ville = mysql_query("SELECT *  FROM prm_villes 

         WHERE   id_vill = '".$offre['id_localisation']."' limit 0,1 ");

        $array_villes_p = mysql_fetch_array($candidat_ville);

    

                if(($candidats['ville'] == $array_villes_p['ville']) ) 

                {$percent_ville = 100;}else{$percent_ville = 0;}

        

    }

	/*

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

	*/

if($prm_p_candidat['prm_fonc'] == "1")

    {

        $nbr_p_c +=100;

        if($candidats['id_fonc'] == $offre['id_fonc']) 

        {$percent_fonction = 100;}else{$percent_fonction = 0;}

	 

    }

if($prm_p_candidat['prm_nfor'] == "1")

    {

        $nbr_p_c +=100;

        if($candidats['id_nfor'] == $offre['id_nfor']) 

        {$percent_formation = 100;}else{$percent_formation = 0;}

	  

    }

	/*

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

	*/

$somme_n1 = 0;//$percent_titre / $nbr_p_c;

$somme_n4 = 0;//$percent_tposte / $nbr_p_c;

$somme_n7 = 0;//$percent_mobilite / $nbr_p_c;

$somme_n8 = 0;//$percent_niveau_mobilite / $nbr_p_c;

$somme_n9 = 0;//$percent_taux_mobilite / $nbr_p_c;

$somme_n2 = $percent_expe / $nbr_p_c;

$somme_n3 = $percent_ville / $nbr_p_c;

$somme_n5 = $percent_fonction / $nbr_p_c;

$somme_n6 = $percent_formation / $nbr_p_c;



$t_s_n =$somme_n1 + $somme_n2 +$somme_n3+

$somme_n4+$somme_n5+$somme_n6+$somme_n7+$somme_n8+$somme_n9;



$s_note_finale = $t_s_n * 100 ;

$r_note_finale = number_format($s_note_finale,2);



$somme_note_finale = number_format($s_note_finale,0);

if($somme_note_finale>$min_p_a_req){



$test_pertinence_id = mysql_query("SELECT id_p_oc FROM `pertinence_oc` 

    WHERE   id_offre = '".$array_candidats_p['id_offre']."' 

    and  candidats_id = '".$array_candidats_p['candidats_id']."' and  

    ref_p= 'm'   limit 0,1 ");



if($id_pertinence_existe = mysql_fetch_assoc($test_pertinence_id)){

$s_p_sql=" UPDATE `pertinence_oc` SET  `ref_p`='m',

 `candidats_id`='".safe($array_candidats_p['candidats_id'])."',

  `id_offre`='".safe($array_candidats_p['id_offre'])."',

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

    VALUES ('m','".safe($array_candidats_p['candidats_id'])."',

        '".safe($array_candidats_p['id_offre'])."',

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



}











}//fin while candidats







/*===========================================================================================================*/	

	}

/*===========================================================================================================*/				



 	  

				 

		$query_M="	select candidats.candidats_id from candidats ,pertinence_oc 

					where  candidats.candidats_id=pertinence_oc.candidats_id 

					and  pertinence_oc.id_offre=".$id_offre." 

					and pertinence_oc.total_p>".$prm_p_candidat['min_p_a']."

					AND pertinence_oc.ref_p LIKE  'm'

					ORDER BY LPAD(pertinence_oc.total_p, 20, '0') DESC ";

				 

//echo  "<br>".$query_M;

 

/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];



$select = mysql_query($query_M);



$tpc = mysql_num_rows($select);                     

$nbItems = $tpc;

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;

$nbPages = ceil ( $nbItems / $itemsParPage );

if (! isset ( $_GET ['idPage'] ))

$pageCourante = 1;        

elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)

$pageCourante = $_GET ['idPage'];

else

$pageCourante = 1;

// Calcul de la clause LIMIT

$limitstart = $pageCourante * $itemsParPage - $itemsParPage;

 //



$sql_pagination=$query_M."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination; 

 



/////////////   fin pagination



echo '<div style=" float: right; padding: 2px 5px 0px 0px;">

        <a href="../?p=ec" style=" border-bottom: none; ">

        <img src="'.$imgurl.'/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>

      </a>  </div>';

              echo '<div class="subscription" style="margin: 10px 0pt;">

          <h1>LA LISTE DES CANDIDATURES 

          <span class="badge">'.$tpc.'</span></h1>

          </div>  ';



  //--------------------------------------------------------- 

   

//echo "<br>". $sql_pagination;

    if(isset($sql_pagination))

    { 

        

        $req  =  mysql_query($sql_pagination);

        

  ?>

   

  

  

            

            

            



 

 

 

 

 

  <?php include("matching_off_resuta_m_table.php");?>

 

 

 

 

 <?php

    } 

	

 ?>

 

 </div>

 

 

        <?php

 

        

    }

 

     ?>

      </div>

    </div>

  </div> 

  



 