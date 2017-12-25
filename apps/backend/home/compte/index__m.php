<?php

 

  /* ==================================================================== */ 

  /* Candidatures */  

  /* ==================================================================== */ 

  

      $nbr_status=$nbr_et=$nbr_ce=$nbr_ep=$nbr_ru=$nbr_rr=$nbr_re=$nbr_nm=$nbr_nc=0;

      

      

    

 $q_offre_fili__v = str_replace("offre.id_offre", " candidature.id_offre", $q_offre_fili);

 $q_offre_fili_and__v = str_replace("offre.id_offre", " candidature.id_offre", $q_offre_fili_and);  

      

 

      

      

    $count_query_c =  mysql_query("SELECT count(id_candidature) as count_c FROM candidature where status='En attente'  ".$q_offre_fili_and__v."  ".$offre_candidatures." limit 0,1 ");

      $count_r_c = mysql_fetch_assoc ($count_query_c);

      $new = $count_r_c['count_c'];

      /*

      echo "<br>"."SELECT count(id_candidature) as count_c FROM candidature where status='En attente'  ".$q_offre_fili_and__v."   limit 0,1 "."***".$new;

      */

    $count_query_sp =   mysql_query("SELECT count(id_candidature) as count_sp FROM candidature_spontanee  limit 0,1 ");

      $count_r_sp = mysql_fetch_assoc ($count_query_sp);

      $cand_spontanee = $count_r_sp['count_sp'];

      

      

    $count_query_st =   mysql_query("SELECT count(id_candidature) as count_st FROM candidature_stage  limit 0,1 ");

      $count_r_st = mysql_fetch_assoc ($count_query_st);

      $cand_stage = $count_r_st['count_st'];

      

      

 

      

  

       

     

      

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



    

        $select_candidature = mysql_query("SELECT   candidature.candidats_id , candidature.id_candidature,  candidature.id_offre  FROM   candidature  where   candidature.status != 'En attente'  

        ". $q_offre_fili__v ." ".$offre_candidatures."    ");

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

      

 

?>

<table width="100%">

    <tr>

<td width="40%">

<?php include('index__m_statistique_agenda.php'); ?>     

</td>

<td width="60%"  valign=top>

<?php include('index__m_statistique_table.php'); ?>     

 </td>   

    </tr>

</table>



 





<?php require_once("./index__m_table.php");?>