<?php 

    

 

    require_once dirname(__FILE__) . "/../../../../config/fo_conn.php";



	



$messages=array(); 

$message_succ=array(); 

if(isset($_POST['envoi']))

{ 

$email = isset($_POST['email'])? trim($_POST['email']) : "";

$valid = "/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9_-]+\.[a-zA-Z0-9_-]+$/"; 

if(empty($email))

{

array_push($messages,"Veuillez entrer votre adresse email!</div>");

}

elseif(!preg_match($valid,$email))

array_push($messages,"L'email saisie n'est pas bien formaté</div>");

else

{

$sql = mysql_query("SELECT * FROM candidats WHERE email = '".$email."'");

$exist = mysql_num_rows($sql);$sql_rep = mysql_fetch_array($sql);

	if(!$exist)

	{

	array_push($messages,"L'adresse e-mail saisie ne correspond à aucune adresse dans notre base de données! Si vous souhaitez vous inscrire,  

			  <a href ='../inscription/'>cliquer içi</a></div>");

	}else{

    if($sql_rep['status']=='2')

	array_push($messages,"Veuillez cliquer sur le lien de confirmation d'inscription envoyé sur votre boite email.,  

          <a href ='../../'>Ne pas attendre</a><br>

		  Si vous voulez envoyer un autre email de confirmation <a href=\"../../confirmation/?p=".$sql_rep['mdp']."&i=".$sql_rep['candidats_id']."&r=r\">cliquer içi.</a></div><meta http-equiv=\"refresh\" content=\"5; url=".$site."\">");

		  }

}

if(!empty($messages))

{

}

else

{

$reponse = mysql_fetch_array($sql);

$mdp = "";



      for($i=0; $i<6; $i++){



         $randnum = mt_rand(0,61);



         if($randnum < 10){



            $mdp .= chr($randnum+48);



         }else if($randnum < 36){



            $mdp .= chr($randnum+55);



         }else{



            $mdp .= chr($randnum+61);



         }



      }

include("./password_perdu_m_email_1.php");

}

}





$nom_page_site = "MOT DE PASSE OUBLIE" ;



$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> >  Mot de passe oublié ";



?>