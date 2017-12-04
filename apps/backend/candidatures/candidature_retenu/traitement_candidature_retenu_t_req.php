<?php


   $count_test =  0; 
$result_array =  $array_test =  array(); 
			  
			//ne pas modifer 
			if(!empty($ref_statut_affiche)){
			 $sql_ref_statut_affiche="and `ref_statut` in ($ref_statut_affiche)";   
			 }
            $select_popup_3 = mysql_query("SELECT statut FROM `prm_statut_candidature`where    popup_4=4     " );
			
			 
            while($status_popup_3 = mysql_fetch_array($select_popup_3))
			{
				$result_array[] = $status_popup_3['statut'];
			}

    
			 

		$qury_cand____1="SELECT   candidature.candidats_id , candidature.id_candidature,  candidature.id_offre  FROM   candidature  ". $tbl____o . $q_offre_fili ." ".$offre_candidatures. $where____and.$o____c."      candidature.status = 'En cours'     ";
		
 
		
		
        $select_candidature = mysql_query($qury_cand____1);
			 
			
			 
			
			 
        while($id_candid = mysql_fetch_array($select_candidature))
        {
            $last_status = ''; $last_id = 0;
			
	 
			
            
			
            $select_count_hist = mysql_query("select id_candidature,status from historique where id_candidature = '".$id_candid['id_candidature']."' order by  `historique`.`id` DESC limit 0,1");
            if($status = mysql_fetch_array($select_count_hist))
            {
                $last_id = $status['id_candidature'];
                $last_status = $status['status'];
            }
			
            if(in_array($last_status, $result_array) )
            { 
		//echo  $last_status."<br>" ;
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
 
        
        
        $condition = "WHERE ( candidature.id_candidature IN (";
        
      
            
           
        if(isset($array_test) And $count_test!=0)
            $s_test = implode(",",$array_test);
             
        if (isset( $s_test) and  $s_test!='')   {       $condition .= $s_test ;             } 
			
            $condition = rtrim($condition," , ");
        $condition .=') ) ';
         
       // if($condition=='WHERE ( id_candidature IN () ) ') $condition=''; 

          
     $clos__cond = " and "; if(!empty($o____c)) $clos__cond = $where____and.$o____c;
                 
	
			$query = "SELECT  
			candidature.candidats_id , candidature.id_candidature,  candidature.id_offre 
			 FROM   candidature    ".$tbl____o .$condition."  ".$q_offre_fili_and.$clos__cond ."    candidature.status = 'En cours'  ";
                
				
     

/*echo  $query ;*/

             if(isset($query))

        $_SESSION["query"] = $query." ".$g_by ; 

       
	   
 
 
        
?>