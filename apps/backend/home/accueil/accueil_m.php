<?php



  /* ==================================================================== */ 

  /* Offres */ 

  /* ==================================================================== */ 

  

    $date_0 = date('Y-m-d');

    $date_7 = date('Y-m-d', strtotime('+7 days'));

	//echo $date_7; 

	

			$nbr_encours=$nbr_archiv=$nbr_echeance=$nbr_c_r_offre=0;

			

			$q__statistique="SELECT ( SELECT COUNT(candidats_id) FROM candidats where id_civi != 0 and nom !='' and prenom !='' and last_connexion != '0000-00-00' ) As nbr_c_c, 

            ( SELECT COUNT(id_dossier) FROM dossier ) As nbr_d_f,

            ( SELECT COUNT(id_compagne) FROM campagne_recrutement ".$q_ref_fili.") As nbr_c_of, 

            ( SELECT COUNT(id_offre) FROM offre WHERE status = 'Archivée' ".$q_ref_fili_and." ) As nbr_o_a,

             ( SELECT COUNT(id_offre) FROM offre WHERE status ='En cours' ".$q_ref_fili_and." ) As nbr_o_e , 

             ( SELECT COUNT(id_offre) FROM offre WHERE status ='En cours' ".$q_ref_fili_and." and date_expiration > DATE_SUB(NOW(), INTERVAL 7 DAY) ) As nbr_o_d , 

             ( SELECT COUNT(id_candidature) FROM candidature WHERE status='En attente'  ) As nbr_cn_c , 

            ( SELECT COUNT(id_candidature) FROM candidature_spontanee ) As nbr_sp_c , 

            ( SELECT COUNT(id_candidature) FROM candidature_stage ) As nbr_st_c limit 0,1 ";

			//echo $q__statistique;

    $select__statistique = mysql_query($q__statistique);

	

     $req__statistique = mysql_fetch_assoc($select__statistique) ;

	 $nbr_encours=$req__statistique['nbr_o_e'];

	 $nbr_archiv=$req__statistique['nbr_o_a'];

	 $nbr_echeance=$req__statistique['nbr_o_d'];

  

 

 

  /* ==================================================================== */ 

  /* Candidatures */  

  /* ==================================================================== */ 

			

 

			

      

     if(!empty($o____c)) { $clos__cond1 = $clos__cond2 = $where____and.$o____c; $where__cc__and=" and ";}

	 else { $clos__cond1 = "  ";$clos__cond2 = " where "; $where__cc__and="   ";} 

      

      

	$sql_req_nc="SELECT count(id_candidature) as count_c FROM candidature ". $tbl____o ." where candidature.status='En attente'  ".$q_offre_fili_and. $clos__cond1 ."   limit 0,1 ";

		//echo "<br>".$sql_req_nc."<br>";

		

			

		$count_query_c = 	mysql_query($sql_req_nc);

			$count_r_c = mysql_fetch_assoc ($count_query_c);

			$new = $count_r_c['count_c'];

			/*

			echo "<br>"."SELECT count(id_candidature) as count_c FROM candidature where status='En attente'  ".$q_offre_fili_and__v."   limit 0,1 "."***".$new;

			*/

		$count_query_sp = 	mysql_query("SELECT count(id_candidature) as count_sp FROM candidature_spontanee  limit 0,1 ");

			$count_r_sp = mysql_fetch_assoc ($count_query_sp);

			$cand_spontanee = $count_r_sp['count_sp'];

			

			

		$count_query_st = 	mysql_query("SELECT count(id_candidature) as count_st FROM candidature_stage  limit 0,1 ");

			$count_r_st = mysql_fetch_assoc ($count_query_st);

			$cand_stage = $count_r_st['count_st'];

			//echo 

			

			

 

			

	

			 

		 

			

/*--------------------------------------------*/	

			

				$count_cours = 0;  

		

$result_array_1 =  $array_test_1 =  array();

		 

				$sql_ref_statut_affiche_1="";

				

            $select_popup_1 = mysql_query("SELECT statut FROM `prm_statut_candidature` where `popup_3`=3      ".$sql_ref_statut_affiche_1."  " );

			

			

            while($status_popup_1 = mysql_fetch_array($select_popup_1))

			{

				$result_array_1[] = $status_popup_1['statut'];

			}



  

/*--------------------------------------------*/	

        $count_retenu = 0;  

		

$result_array_2 =  $array_test_2 =  array();

		

			 //exemple of ref à afficher in  $ref_statut_affiche="'c0_1','c0_2','c0_3','c0_4'";

			$ref_statut_affiche_2="'c0_4'";

			//ne pas modifer 

			if(!empty($ref_statut_affiche_2)){

			 $sql_ref_statut_affiche_2="and `ref_statut` in ($ref_statut_affiche_2)";   

			 }

            $select_popup_2 = mysql_query("SELECT statut FROM `prm_statut_candidature` where  `popup_4`=4      ".$sql_ref_statut_affiche_2."  " );

			

			 

            while($status_popup_2 = mysql_fetch_array($select_popup_2))

			{

				$result_array_2[] = $status_popup_2['statut'];

			}

  



/*--------------------------------------------*/	

			 

        $count_recruter = 0;  

		

$result_array_3 =  $array_test_3 =  array();

		

			 //exemple of ref à afficher in  $ref_statut_affiche="'c0_1','c0_2','c0_3','c0_4'";

			$ref_statut_affiche_3="'c0_5'";

			//ne pas modifer 

			if(!empty($ref_statut_affiche_3)){

			 $sql_ref_statut_affiche_3="and `ref_statut` in ($ref_statut_affiche_3)";   

			 }

            $select_popup_3 = mysql_query("SELECT statut FROM `prm_statut_candidature` where  `popup_5`=5       ".$sql_ref_statut_affiche_3."  " );

			

			 

            while($status_popup_3 = mysql_fetch_array($select_popup_3))

			{

				$result_array_3[] = $status_popup_3['statut'];

			}



    

		

/*--------------------------------------------*/

/*--------------------------------------------*/    

             

        $count_non_retenu = 0;  

        

$result_array_4 =  $array_test_4 =  array();

        

             //exemple of ref à afficher in  $ref_statut_affiche="'c0_1','c0_2','c0_3','c0_4'";

            $ref_statut_affiche_4="'c0_6'";

            //ne pas modifer 

            if(!empty($ref_statut_affiche_4)){

             $sql_ref_statut_affiche_4="and `ref_statut` in ($ref_statut_affiche_4)";   

             }

            $select_popup_4 = mysql_query("SELECT statut FROM `prm_statut_candidature` 

                where  `popup_6`=6       ".$sql_ref_statut_affiche_4."  " );

             

            while($status_popup_4 = mysql_fetch_array($select_popup_4))

            {

                $result_array_4[] = $status_popup_4['statut'];

            }



    

        

/*--------------------------------------------*/		



		

		$sql_req_cc="SELECT   candidature.candidats_id , candidature.id_candidature,  candidature.id_offre  FROM   candidature ". $tbl____o ." ". $q_offre_fili .$clos__cond2  .$offre_candidatures.$where__cc__and."     candidature.status != 'En attente'     ";

		

		//echo "<br>".$sql_req_cc."<br>";

    

        $select_candidature = mysql_query($sql_req_cc);



        while($id_candid = mysql_fetch_array($select_candidature))

        {

            $last_status = ''; $last_id = 0;

			

	 

			

			

            $select_count_hist = mysql_query("SELECT id_candidature,status 

                from historique where id_candidature = '".$id_candid['id_candidature']."' order by  `historique`.`id` DESC limit 0,1");

            if($status = mysql_fetch_array($select_count_hist))

            {

                $last_id = $status['id_candidature'];

                $last_status = $status['status'];

            }

			

/*--------------------------------------------*/	

            if(in_array($last_status, $result_array_1) )

            { 

                $array_test_1[] = $last_id;

                $count_cours++;  

            } 



/*--------------------------------------------*/	

            if(in_array($last_status, $result_array_2) )

            { 

                $array_test_2[] = $last_id;

                $count_retenu++;  

            } 

/*--------------------------------------------*/	

            if(in_array($last_status, $result_array_3) )

            { 

                $array_test_3[] = $last_id;

                $count_recruter++;  

            } 

/*--------------------------------------------*/	

            if(in_array($last_status, $result_array_4) )

            { 

                $array_test_4[] = $last_id;

                $count_non_retenu++;  

            } 

/*--------------------------------------------*/



		}

		

		

			 

			

 

 



  /* ==================================================================== */ 

  /* Candidats */ 

  /* ==================================================================== */ 

  

    

	 $nbr_cv_cand=$req__statistique['nbr_c_c'];

	  

	 $nbr_doss_cand=$req__statistique['nbr_d_f'];



     $nbr_c_r_offre=$req__statistique['nbr_c_of'];



?>







<?php require_once("./accueil_m_statistique.php");?>



<?php require_once("./accueil_m_table.php");?>

