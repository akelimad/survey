<div class='texte'>


                        <h1>  SIGNALER UN PROBLEME</h1>





                        <h2>  </h2> 

                        <p>


                        </p><br />


<?php
$id_a = isset($_SESSION['id_role']) ? $_SESSION['id_role'] : "";
$id_c = isset($_SESSION['abb_id_candidat']) ? $_SESSION['abb_id_candidat'] : "";

$ticket = isset($_POST['ticket']) ? $_POST['ticket'] : "";
$destination = isset($_POST['destination']) ? $_POST['destination'] : "";
$user_last_name = isset($_POST['user_last_name']) ? ( $_POST['user_last_name'] ) : "";
$user_first_name = isset($_POST['user_first_name']) ? ($_POST['user_first_name']) : "";
$user_email = isset($_POST['user_email']) ? ($_POST['user_email']) : "";$user_tel = isset($_POST['tel']) ? ($_POST['tel']) : "";
$subject = isset($_POST['subject']) ? ($_POST['subject']) : "";
$message = isset($_POST['msg']) ? ($_POST['msg']) : "";
$message_2 = $message;

$dt = date('Y-m-d H:i:s');


$fileName    = isset($_FILES['piecejointe']) ? $_FILES['piecejointe']['name']       : ""	;
$tmpName	 = isset($_FILES['piecejointe']) ? $_FILES['piecejointe']['tmp_name'] 	: "1"	;
$fileType	 = isset($_FILES['piecejointe']) ? $_FILES['piecejointe']['type'] 		: ""	;
$fileSize	 = isset($_FILES['piecejointe']) ?  $_FILES["piecejointe"]["size"]		: ""	;
$fileError	 = isset($_FILES['piecejointe']) ?  $_FILES["piecejointe"]["error"]		: ""	;


if($id_c=='' && $id_a!='') {$id_u=$id_a ;$type_u='Responsable';}
elseif($id_c!='' && $id_a=='') {$id_u=$id_c ;$type_u='Candidat';}
else {$id_u='' ;$type_u='Visiteur';}

$sql_insert = "INSERT INTO root_signale_probleme VALUES ('','".safe($id_u)."','".safe($type_u)."','".safe($ticket)."','".safe($dt)."','".safe($user_last_name)."','".safe($user_first_name)."','".safe($user_email)."','".safe($user_tel)."','".safe($subject)."','".safe($message)."','')";
/*
echo '<br>*******************<br>'.$sql_insert.'<br>*******************<br>';
$id_prob=1;
//*/

$req_insert = mysql_query($sql_insert);

$id_prob=mysql_insert_id();  

if( ($message != "")  ){
//---------------------------------------------------------------------------//
//                                Send Mail                                  //
//---------------------------------------------------------------------------//
		
		
    $destination = $admin_email;
	
	
/*
echo 'test : '.'<br>-*1*--'.$user_last_name.'<br>-*2*--'. $user_first_name.'<br>-*3*--'. $user_email.'<br>-*4*--'. $destination.'<br>-*5*--'. $subject.'<br>-*6*--'. $message.'<br>-*7*--'. $to.'<br>-*8*--'. $site.'<br>-*9*--'. $fileName.'<br>-*10*--'. $tmpName.'<br>-*11*--'. $fileType.'<br>-*12*--'. $fileSize.'<br>-*13*--'. $fileError .'<br>-**--'.'  --- fin';

$mail_can = send_mail($user_last_name, $user_first_name, $user_email, $destination, $subject, $message, $to, $site, $fileName, $tmpName, $fileType, $fileSize, $fileError, $file_upload_pj3,$id_prob,$ticket );

//*/

//---------------------------------------------------------------------------//

include("prob_signal_t_email_1.php");

//---------------------------------------------------------------------------//


//---------------------------------------------------------------------------//

include("prob_signal_t_email_2.php");

//---------------------------------------------------------------------------//


echo "Merci de nous avoir signaler un probléme. Votre message sera traité et nous reviendrons vers vous sous peu.<br>
<br>Vous allez être rediriger sous peu vers la page principale.";


 print("<meta http-equiv=\"Refresh\" Content=\"4;url=$urlhome\" />");

}
else{

echo '<span style="color:red;">Veuillez entrer votre message avent d’envoyé le message.</span> ';

 print("<meta http-equiv=\"Refresh\" Content=\"2;url=sig_prob.php\" />");
 
}

?>        
 </div>