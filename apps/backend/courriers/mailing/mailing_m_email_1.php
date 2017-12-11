<?php

        ////////////////////////////////Récupération des données du formulaires///////////////////////////////  

        $m_email      = isset($_POST['m_email'])     ? $_POST['m_email']        : "";

        $m_emails     = isset($_POST['m_emails'])    ? $_POST['m_emails']       : "";

        $m_sujet      = isset($_POST['m_sujet'])     ? $_POST['m_sujet']        : "";

        $Sujet_f      = isset($_POST['Sujet'])       ? $_POST['Sujet']          : "";

        $m_message    = isset($_POST['m_message'])   ? $_POST['m_message']      : "";

		

		$m_id         = isset($_POST['m_id'])        ? $_POST['m_id']           : "";

		

        ////////////////////////////////////////////////////////////////////////////

        $select1 = mysql_query("select * from email_type where id_email='$m_id' ");

            $reponse1 = mysql_fetch_array($select1);

            $a = mysql_num_rows($select);

            

            $from_email = $m_email;      //$reponse1["email"];            

            $obj_emp    = $Sujet_f ;     //=  ($Sujet_f=='')  ? $reponse1["objet"]      :  $Sujet_f ;

            $new_msg = $reponse1["message"];

            $p_joint = $reponse1["p_joint"];

             

				/*

                $var = array("{{message}}");                

                $replace   = array($m_message);

                $message_employeur = str_replace($var, $replace, $new_msg);

				//*/

				$message_employeur = $m_message;

                $msg_pj="";

            

 

        ////////////////////////////////////////////////////////////////////////////

//----------------------------------------------------------------------------------------------------------------------



$allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx");

$temp = explode(".", $_FILES["piecejointe"]["name"]);

$extension = end($temp);

         //$f_name_path = "" . __DIR__ . "\\upload\\" . $n_f .".". $extension;

         $f_name_path = dirname(__FILE__) . $file_upload_pj . $n_f .".". $extension;



         



if (($_FILES["piecejointe"]["size"] < 2000000)&& in_array($extension, $allowedExts)) {

  if ($_FILES["piecejointe"]["error"] > 0) {

    echo "Return Code: " . $_FILES["piecejointe"]["error"] . "<br>";

  } else {

  

    if (file_exists("upload/" . $_FILES["piecejointe"]["name"])) {

    

    } else {

    

      copy($_FILES["piecejointe"]["tmp_name"], $f_name_path );

      

    }

  }

  

        $tmpName = $_FILES['piecejointe']['tmp_name']; 

        $fileType = $_FILES['piecejointe']['type']; 

        $fileName = $_FILES['piecejointe']['name']; 

} else {

 // echo "Fichier non validé";

}   

//------------------------------------------------------------------------------------------------------------------------- 

$m_emails=str_replace(' ','',$m_emails);

$m_emails = rtrim($m_emails, ',');

$emails_t  =explode(",", $m_emails);

    

    //foreach ($emails_t as &$email) {

    $query  =  $_SESSION["query"];  $req  =  mysql_query($query); 



  //while($rep = mysql_fetch_assoc($req))    {

	 $emails_all='';

	 if ( $m_emails != '') { 

			$emails_all= $m_emails ;	

		 $emails_all=rtrim($emails_all , ",");	 }

	 else { $email_db='';

		 while($rep = mysql_fetch_array($req))  {

			$email_db.=$rep['email'].',';

		 }

		 $emails_all=rtrim($email_db , ",");	 }

	 

	 $email_s = explode(",", $emails_all);

	 

foreach ($email_s as $email) {

         

//==========//==========//==========//==========//==========//



if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.

{

    $passage_ligne = "\r\n";

}

else

{

    $passage_ligne = "\n";

}

//=====Déclaration des messages au format texte et au format HTML.

$message_txt = $nom_site;

$message_html = $message_employeur  ;

//==========

 

//=====Lecture et mise en forme de la pièce jointe.

if($fileName){

$fichier   = fopen($tmpName, "r");

$attachement = fread($fichier, filesize($tmpName));

$attachement = chunk_split(base64_encode($attachement));

fclose($fichier);

}

//==========

 

//=====Création de la boundary.

$boundary = "-----=".md5(rand());

$boundary_alt = "-----=".md5(rand());

//==========

 

//=====Définition du sujet.

$sujet = $obj_emp;

//=========

//$header .= 'From: '.$nom_site.' <'.$from_email.'>' . "\r\n";

//$header .= 'Bcc: '.$from_email."\r\n";

//=====Création du header de l'e-mail.

$header  = "From: ".$nom_site." <".$m_email.">".$passage_ligne;

//$header .= "Bcc: ".$from_email."".$passage_ligne;

//$header .= 'Bcc: '.$from_email."\r\n";

//$header .= "Reply-to: \"Admin email\" <".$from_email.">".$passage_ligne;

$header .= "MIME-Version: 1.0".$passage_ligne;

$header .= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

//==========

 

//=====Création du message.

$message  = $passage_ligne."--".$boundary.$passage_ligne;

$message .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;

$message .= $passage_ligne."--".$boundary_alt.$passage_ligne;

//=====Ajout du message au format texte.

$message .= "Content-Type: text/plain; charset=\"utf-8\"".$passage_ligne;

$message .= "Content-Transfer-Encoding: 8bit".$passage_ligne;

$message .= $passage_ligne.$message_txt.$passage_ligne;

//==========

 

$message .= $passage_ligne."--".$boundary_alt.$passage_ligne;

 

//=====Ajout du message au format HTML.

$message .= "Content-Type: text/html; charset=\"utf-8\"".$passage_ligne;

$message .= "Content-Transfer-Encoding: 8bit".$passage_ligne;

$message .= $passage_ligne.$message_html.$passage_ligne;

//==========

 

//=====On ferme la boundary alternative.

$message .= $passage_ligne."--".$boundary_alt."--".$passage_ligne;

//==========

 

 

 

$message .= $passage_ligne."--".$boundary.$passage_ligne;

 

//=====Ajout de la pièce jointe.

//*

if($reponse1["p_joint"]!='')  {



              $hd='Content-Type: multipart/mixed; charset=utf-8' . "\r\n";

             

                

            //=====Lecture et mise en forme de la pièce jointe.

            $fichier=file_get_contents(dirname(__FILE__) . $file_courrier.$p_joint);

            

            $fichier=chunk_split( base64_encode($fichier) );

            //=====Ajout de la pièce jointe.

            

            $msg_pj= "Content-Type: application/msword; name=\"$p_joint\"\r\n".

                     "Content-Transfer-Encoding: base64\r\n".

                     "Content-Disposition: attachment; filename=\"$p_joint\"\r\n\n".

                     "$fichier".$passage_ligne."--".$boundary;

            $message.=$msg_pj;

            

            }

 

$message .= "Content-Type: image/jpeg; name=\"".$fileName."\"".$passage_ligne;

$message .= "Content-Transfer-Encoding: base64".$passage_ligne;

$message .= "Content-Disposition: attachment; filename=\"".$fileName."\"".$passage_ligne;

$message .= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;

 

$message .= $passage_ligne."--".$boundary."--".$passage_ligne; 

//*/

//========== 

//=====Envoi de l'e-mail.



mail($email,$sujet,$message,$header);

//echo $email .'  <-- <br>';

//==========//==========//==========//==========//==========//



//*/        

    }  //  end for

    

//  Insertion corespondances

     $type_email=($_SESSION['destination']=='-1') ? "Candidats ciblés" : "Tous les candidats";

     $d=date("Y.m.d-H.i.s");$type_c = $m_sujet;$nom_s=$_SESSION['abb_admin'];

     $sql_mail= ' insert into corespondances Values ("","'. safe($obj_emp).'","'. safe($nom_s).'","'. safe($d).'","'. safe($obj_emp).'","'. safe($type_c).'","'. safe($message_employeur).'") ';

     //echo $sql_mail;

     mysql_query($sql_mail);

?>