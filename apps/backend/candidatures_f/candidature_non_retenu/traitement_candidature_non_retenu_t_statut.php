<?php





$offre_candidatures = (isset($_SESSION['offre_candidatures_0'])) ? $_SESSION['offre_candidatures_0'] : '' ;		



   $count_test = 0;  

			 

			

			 

			 //exemple of ref à afficher in  $ref_statut_affiche="'c0_1','c0_2','c0_3','c0_4'";

			$ref_statut_affiche="'c0_6'";

			//ne pas modifer 

			if(!empty($ref_statut_affiche)){

			 $sql_ref_statut_affiche="and `ref_statut` in ($ref_statut_affiche)";   

			 }

            $select_popup_3 = mysql_query("SELECT * FROM `prm_statut_candidature`where `popup_4`=4    ".$sql_ref_statut_affiche."  " );

			

			

			$result_array = array();

            while($status_popup_3 = mysql_fetch_array($select_popup_3))

			{

				$result_array[] = $status_popup_3['statut'];

			}



    

			

			

        $select_candidature = mysql_query("select id_candidature from candidature inner join offre on candidature.id_offre = offre.id_offre   ".$offre_candidatures."   ". $q_offre_fili_and ."   ");

        while($id_candid = mysql_fetch_array($select_candidature))

        {

            $last_status = ''; $last_id = 0;

			

	 

			

            $select_count_tel = mysql_query("select id_candidature,status from historique where id_candidature = '".$id_candid['id_candidature']."' order by date_modification");

            while($status = mysql_fetch_array($select_count_tel))

            {

                $last_id = $status['id_candidature'];

                $last_status = $status['status'];

            }

			

            if(in_array($last_status, $result_array) )

            { 

                $array_test[] = $last_id;

                $count_test++;  

            } 







		}



        



        

 

        



        if(isset($_GET['candidature']))



            $candidature =  $_GET['candidature'];



        elseif(isset($_POST['candidature']))



            $candidature =  $_POST['candidature'];



        else



            $candidature =  "";



            

 



         

 

        

$g_by=" GROUP BY candidature.id_candidature ";

 

        

        

        $condition = "WHERE ( id_candidature IN (";

        

      

            

           

        if(isset($array_test) And $count_test!=0)

            $s_test = implode(",",$array_test);

             

        if (isset( $s_test) and  $s_test!='')   {       $condition .= $s_test ;             } 

			

            $condition = rtrim($condition," , ");

        $condition .=') ) ';

         

       // if($condition=='WHERE ( id_candidature IN () ) ') $condition=''; 



         

                   

            $query = "SELECT * from candidats 

            inner join candidature on candidats.candidats_id = candidature.candidats_id 

            inner join offre on candidature.id_offre = offre.id_offre 

            INNER JOIN formations ON candidature.candidats_id = formations.candidats_id 

            ".$condition."  ".$q_offre_fili_and."   ";

			

			

                   if(isset($query)) $_SESSION["query"] = $query." ".$g_by ;   

            



?>