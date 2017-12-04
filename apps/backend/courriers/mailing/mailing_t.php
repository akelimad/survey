<?php 



session_start();

if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../../login/");

} 





require_once dirname(__FILE__) . "/../../../../config/config.php";

		mysql_connect($serveur,$user,$passwd);

		mysql_select_db($bdd);

	

   

$g_by ='';



	

		$session_tel = "";

    	$session_convocation="";

		$session_rencontre= "";

		$session_recontact = "";

		$session_transmis = "";

		$session_retenus= "";

		$count_tel = 0;

		$count_convocation = 0; 

		$count_rencontre = 0;

		$count_recontact = 0;

		$count_transmis = 0;

		$count_retenu = 0;

		$select_candidature = mysql_query("select id_candidature from candidature 

            inner join offre on candidature.id_offre = offre.id_offre 

            INNER JOIN formations ON candidature.candidats_id = formations.candidats_id ");

		while($id_candid = mysql_fetch_array($select_candidature))

		{

			$last_status = ''; $last_id = 0;

			$select_count_tel = mysql_query("select id_candidature,status 

            from historique where id_candidature = '".$id_candid['id_candidature']."' order by date_modification");

			while($status = mysql_fetch_array($select_count_tel))

			{

				$last_id = $status['id_candidature'];

				$last_status = $status['status'];

			}

			if($last_status == 'Appel téléphonique')

			{

				$array_tel[] = $last_id;				

				$count_tel++;

			}

			if($last_status == 'Convocation entretien')

			{

				$array_convocation[] = $last_id;

				$count_convocation++;

			}

			if($last_status == 'A rencontrer')

			{

				$array_rencontre[] = $last_id;

				$count_rencontre++;	

			}

			if($last_status == 'A recontacter')

			{

				$array_recontact[] = $last_id;

				$count_recontact++;

			}

			if($last_status == 'Candidature transmise')

			{

				$array_transmis[] = $last_id;

				$count_transmis++;

			}

			if($last_status == 'Retenu')

			{

				$array_retenu[] = $last_id;

				$count_retenu++;

			}

		}

		if(isset($array_tel))

		

		$session_tel = implode("+",$array_tel);

		if(isset($array_convocation))

		

		$session_convocation= implode("+",$array_convocation);

		if(isset($array_rencontre))

		

		$session_rencontre= implode("+",$array_rencontre);

		if(isset($array_recontact))

		

		$session_recontact = implode("+",$array_recontact);

		if(isset($array_transmis))

		

		$session_transmis = implode("+",$array_transmis);

		if(isset($array_retenu))

		

		$session_retenus= implode("+",$array_retenu);

		

		if(isset($_POST['candidature']))

			$candidature =  $_POST['candidature'];

		elseif(isset($_POST['candidature']))

			$candidature =  $_POST['candidature'];

		  else

			$candidature =  "";

		if(isset($_POST['stat'])) // si status historique est rï¿½cupï¿½rï¿½ aprï¿½s le click sur le lien 

		          $stat =  $_POST['stat'];

        elseif(isset($_POST['stat'])) //si status historique est rï¿½cupï¿½rï¿½ par le formulaire d'edition de la candidature

		          $stat =  $_POST['stat'];

	       else

    		$stat = "";    

            $stat1=$stat;

		switch($candidature)

		{

			case "encours" : 

			     if(isset($_SESSION["query"]))

				    $_SESSION["query"] = NULL;break;

                

				

			case "refus"   : $query = "select * from candidats inner join candidature 

                on candidats.candidats_id = candidature.candidats_id inner join offre 

                on candidature.id_offre = offre.id_offre INNER JOIN formations 

                ON candidature.candidats_id = formations.candidats_id  

                where  candidature.status = 'Cloturé'   ";

                $_SESSION["query"] = $query ;break;

			case "spont"   : $query = "select * from candidats inner join candidature 

                on candidats.candidats_id = candidature.candidats_id inner join offre 

                on candidature.id_offre = offre.id_offre INNER JOIN formations 

                ON candidature.candidats_id = formations.candidats_id  

                where  offre.id_offre = 1 And candidature.status = 'En attente'    ";

				$_SESSION["query"] = $query ;break;                                                                                         

           

		   

			default	: $query = "select * from candidats inner join candidature 

                on candidats.candidats_id = candidature.candidats_id inner join offre 

                on candidature.id_offre = offre.id_offre INNER JOIN formations 

                ON candidature.candidats_id = formations.candidats_id  

                where candidature.status = 'En attente' ";

				$_SESSION["query"] = $query." ".$g_by ;                                                                                        

		}

		

	   switch($stat)

	   {

		case "tel": 

    		if($session_tel != "")

    		{

    			$condition = "WHERE ( ";

    			$tel = explode("+",$session_tel);

    			for($i=0; $i < count($tel); $i++)

    				$condition .= "id_candidature =".$tel[$i]." OR ";

    			$condition = rtrim($condition," OR ");                      

                    $condition .=' ) ';

    		}

    		else

    			$condition = "WHERE id_candidature = ''";

    			

				

    			$query = "select * from candidats inner join candidature 

                on candidats.candidats_id = candidature.candidats_id inner join offre 

                on candidature.id_offre = offre.id_offre INNER JOIN formations 

                ON candidature.candidats_id = formations.candidats_id ".$condition."  ";break;	

		case "entretien": 

    		if($session_convocation != "")

    		{



    			$condition = "WHERE ( ";



    			$convocation = explode("+",$session_convocation);



    			for($i=0; $i < count($convocation); $i++)



    				$condition .= "id_candidature =".$convocation[$i]." OR ";



    			$condition = rtrim($condition," OR ");

                           $condition .=' ) ';

    		}



    		else



    			$condition = "WHERE id_candidature = ''";

                   

				   

    		$query = "select * from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id inner join offre on candidature.id_offre = offre.id_offre INNER JOIN formations ON candidature.candidats_id = formations.candidats_id ".$condition."  ";break;



		case "recontact": 



    		if($session_recontact != "")



    		{



    			$condition = "WHERE ( ";



    			$recontact = explode("+",$session_recontact);



    			for($i=0; $i < count($recontact); $i++)



    				$condition .= "id_candidature =".$recontact[$i]." OR ";



    			$condition = rtrim($condition," OR ");

                             $condition .=' ) '; 



    		}



    		else



    			$condition = "WHERE id_candidature = ''";



				

    		$query = "select * from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id inner join offre on candidature.id_offre = offre.id_offre INNER JOIN formations ON candidature.candidats_id = formations.candidats_id ".$condition."  ";break;



		case "rencontre": 



    		if($session_rencontre != "")



    		{



    			$condition = "WHERE ( ";



    			$rencontre = explode("+",$session_rencontre);



    			for($i=0; $i < count($rencontre); $i++)



    				$condition .= "id_candidature =".$rencontre[$i]." OR ";



    			$condition = rtrim($condition," OR ");

                             $condition .=' ) ';



    		}



    		else



    		$condition = "WHERE id_candidature = ''";

                    

					

    		$query = "select * from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id inner join offre on candidature.id_offre = offre.id_offre INNER JOIN formations ON candidature.candidats_id = formations.candidats_id  ".$condition."  ";break;



		case "transmis":



        	if($session_transmis != "")



        		{



        			$condition = "WHERE ( ";



        			$transmis = explode("+",$session_transmis);



        			for($i=0; $i < count($transmis); $i++)



        				$condition .= "id_candidature =".$transmis[$i]." OR ";

                               



        			$condition = rtrim($condition," OR ");

                                $condition .=' ) ';



        		}



        		else



        		$condition = "WHERE id_candidature = ''"; 



                        

						

        		$query = "select * from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id inner join offre on candidature.id_offre = offre.id_offre INNER JOIN formations ON candidature.candidats_id = formations.candidats_id ".$condition."  ";break;



		case "retenus":



    		if($session_retenus != "")



    		{



    			$condition = "WHERE ( ";



    			$retenus = explode("+",$session_retenus);



    			for($i=0; $i < count($retenus); $i++)



    				$condition .= "id_candidature =".$retenus[$i]." OR ";



    			$condition = rtrim($condition," OR ");

                             $condition .=' ) ';



    		}



    		else



    			$condition = "WHERE id_candidature = ''"; 

                    

					

    		$query = "select * from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id inner join offre on candidature.id_offre = offre.id_offre INNER JOIN formations ON candidature.candidats_id = formations.candidats_id ".$condition."  ";break;



    			}//fin switch



				

				

            $query = "select * from candidats  INNER JOIN formations ON candidats.candidats_id = formations.candidats_id ";





    	         if(isset($query))



    		$_SESSION["query"] = $query." ".$g_by;	

             

        

 /////////////////////////////////////////////traitement filtrage///////////////////////////////////////////////// 

  $requete='';      

        

          if(isset($_POST['envoi_fitrage'])  || isset($_POST['filtrage']) )



	  {

              $_SESSION["query"] = $query." ".$g_by;

              

              $filtrage="&filtrage=filtrage";



	    if(!empty($_POST['motcle'])||!empty($_POST['fonction'])||!empty($_POST['fraicheur'])

            ||!empty($_POST['pays'])||!empty($_POST['formation'])

            ||!empty($_POST['type_formation'])||!empty($_POST['villes'])

            ||!empty($_POST['exp'])||!empty($_POST['secteur'])||!empty($_POST['situation'])

            ||!empty($_POST['etablissement'])||!empty($_POST['ref']))

		{

		      $_SESSION["query"] = $query;

			if(!empty($_POST['pays']))



			$requete .= " and candidats.id_pays = '".$_POST['pays']."'";





			  if(!empty($_POST['motcle']))



			{

		

		

			}	

			





			if(!empty($_POST['formation']))



			{



				

					$requete .= " And candidats.id_nfor = '".$_POST['formation']."'";



			}









			if(!empty($_POST['fonction']))



			{



				

					$requete .= " And candidats.id_fonc = '".$_POST['fonction']."'";



			}					

            if(!empty($_POST['villes']))



            {



                

                    $requete .= " And candidats.ville = '".$_POST['villes']."'";



            }

			if(!empty($_POST['type_formation']))



			{

			



			



					$requete .= " And candidats.id_tfor = '".$_POST['type_formation']."'";



			}



			if(!empty($_POST['exp']))



			{

					$requete .= " And candidats.id_expe = '".$_POST['exp']."'";

			}



			if(!empty($_POST['secteur']))



			{



					$requete .= " And candidats.id_sect = '".addslashes($_POST['secteur'])."'";



			}



			if(!empty($_POST['situation']))



			{



			



					$requete .= " And candidats.id_situ = '".$_POST['situation']."'";



			}

                        

                        if(!empty($_POST['ref']))



			{



			



					$requete .= " And offre.reference = '".$_POST['ref']."'";



			}





			if(!empty($_POST['etablissement']))



			{



				

					$requete .= " And formations.id_ecol = '".$_POST['etablissement']."'";



			}	



						if(!empty($_POST['fraicheur']))



			{



			



					$requete .= " And DATEDIFF(curdate(),dateMAJ)<'".$_POST['fraicheur']."'";



			}	



			

			

               $g_by_query = str_replace("GROUP BY candidature.id_candidature", "", $_SESSION['query']);   

            $_SESSION['query']= $g_by_query." ".$requete.$g_by." ";            

               // echo $_SESSION['query'];      



		}



	

	 }

        

          

   

          

          

          if(isset($_POST['actualiser']))



				{



				$_POST['motcle']="";



				$_POST['fonction']="";



				$_POST['pays']="";



				$_POST['exp']="";



				$_POST['secteur']="";



				$_POST['fraicheur']="";



				$_POST['situation']="";



				$_POST['etablissement']="";



				$_POST['type_formation']="";



                $_POST['villes']="";



				$_POST['formation']="";



				$_POST['ref']="";



				}



        

/////////////////////////////////////////////traitement filtrage/////////////////////////////////////////////////  

        

		

       





		

     



 

		

		

 

 $_SESSION['link_bak_a']=5;

 $_SESSION['link_bak_b']=55; 			



		

 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];

    

  $nom_page_site ="E-MAILING"  ;

 



	$ariane=" Courriers > E-Mailing";

?>