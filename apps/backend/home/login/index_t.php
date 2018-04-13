<?php 





session_start();

 ob_start();

if (isset($_SESSION["abb_admin"]) && $_SESSION["abb_admin"] != "") {

    header("Location: ../accueil/");

} 



/**/

$msg_alert ='';



    require_once(dirname(__FILE__) . "/../../../../config/config.php");

 

	 if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['pass']) && !empty($_POST['pass'])) {

	 

// logout  

    session_unset();

    session_destroy();

//	

    session_start();

	    $login = $_POST['login'];

        $pass = md5($_POST['pass']); 

        $sql = mysql_query("SELECT id_role,ref_filiale,id_type_role from root_roles where (login = '". safe($login) ."' OR email = '". safe($login) ."') AND mdp = '". safe($pass) ."' limit 0,1");

		$role = mysql_fetch_assoc($sql);

		

       // $numrows = mysql_num_rows($sql);

        if ($role) {

		$id_offre_f='';

            $_SESSION['abb_admin'] = $login;	 
			$_SESSION['id_role'] = $role['id_role']; 
			$_SESSION['id_type_role'] = $role['id_type_role']; 

			 

			  

				

			 $_SESSION['ref_filiale_role'] = $role['ref_filiale'];  

				



				

							$q_ref_fili='';$q_ref_fili_and='';

							if (isset($_SESSION['ref_filiale_role']) and $_SESSION['ref_filiale_role']!=''  and $_SESSION['ref_filiale_role']!='0'){		

									$q_ref_fili = "where ref_filiale = '".$_SESSION['ref_filiale_role']."' ";		

									$q_ref_fili_and = " and  ref_filiale = '".$_SESSION['ref_filiale_role']."' ";	

									$_SESSION['query_ref_fili'] 	 = $q_ref_fili;		

									$_SESSION['query_ref_fili_and']  = $q_ref_fili_and;	

								 

							}		 

				



 			

		 

/*						 

					 

					 $result_filiale = mysql_query("select id_offre from offre ".$q_ref_fili." ");

                            while( $reponse_filiale  = mysql_fetch_array($result_filiale)) {   

                            $id_offre_f .= " '".$reponse_filiale['id_offre']."' ,";

							   } 

							$id_offre_filiale=substr($id_offre_f, 0, -1);

								

							if(empty($id_offre_filiale)){	$id_offre_filiale=0; }	

							

							$_SESSION['query_offre_fili']=" where offre.id_offre in (".$id_offre_filiale.") ";

							$_SESSION['query_offre_fili_and']=" And  offre.id_offre in (".$id_offre_filiale.") ";

				

//*/	

		

			

			 

    $sql0_0 = "select id_role from roles_tmp where id_role=".$role['id_role']."  limit 0,1 ";

	$select0_0 = mysql_query($sql0_0); 

	if(mysql_num_rows($select0_0) > 0){

		$_SESSION['compte_v'] = 1; 

		

					$req_permission_c = mysql_query("select menu1_c,menu2_c,menu3_c,menu4_c,menu5_c,menu6_c,menu7_c from root_permission_c  limit 0,1 ");

					$permission_c = mysql_fetch_assoc($req_permission_c);	

					

					$_SESSION['menu1_c'] = $permission_c['menu1_c'];

					$_SESSION['menu2_c'] = $permission_c['menu2_c'];

					$_SESSION['menu3_c'] = $permission_c['menu3_c'];

					$_SESSION['menu4_c'] = $permission_c['menu4_c'];

					$_SESSION['menu5_c'] = $permission_c['menu5_c'];

					$_SESSION['menu6_c'] = $permission_c['menu6_c'];

					$_SESSION['menu7_c'] = $permission_c['menu7_c']; 

					

		}else{

					$_SESSION['menu1_c'] = $_SESSION['menu2_c'] = $_SESSION['menu3_c'] = $_SESSION['menu4_c'] =  $_SESSION['menu5_c'] =  $_SESSION['menu6_c'] =  $_SESSION['menu7_c'] = 1; 					

		}

 

	

					if($login=='root') {						

					$_SESSION['menu1'] =  $_SESSION['menu2'] =  $_SESSION['menu3'] =  $_SESSION['menu4'] =  $_SESSION['menu5'] =  $_SESSION['menu6'] =  $_SESSION['menu7'] = 1; 				

					}	else	{

					$req_permission = mysql_query("select menu1,menu2,menu3,menu4,menu5,menu6,menu7 from root_permission where id_role='".$role['id_type_role']."'  limit 0,1 ");

					$permission = mysql_fetch_assoc($req_permission);	

					

					$_SESSION['menu1'] = $permission['menu1'];

					$_SESSION['menu2'] = $permission['menu2'];

					$_SESSION['menu3'] = $permission['menu3'];

					$_SESSION['menu4'] = $permission['menu4'];

					$_SESSION['menu5'] = $permission['menu5'];

					$_SESSION['menu6'] = $permission['menu6'];

					$_SESSION['menu7'] = $permission['menu7']; 

					

					

					}

				

            mysql_query("INSERT INTO `his_connexion`(  `id_log`, `login`,  `action`, `type_connexion`) VALUES ( '" .  safe($_SESSION['id_role']) . "','" .  safe($_SESSION['abb_admin']) . "', 'connexion',1)");	





















			

				header("Location: ../accueil/");

				

        } else {

    $messages=array();

set_flash_message('error', 'Votre Email et/ou votre mot de passe est incorrect !');

	 }

		

		

	 }

     



  $nom_page_site = "AUTHENTIFICATION" ;

 

 	

	 $ariane="Admin > Authentification  ";	

	 ob_end_flush();

?>