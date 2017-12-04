<div class='texte'>


                        <h1>NOUS CONTACTER</h1>





                        <p>Vos questions, commentaires et suggestions sont les bienvenues !  </p> 

                        <p>


                        </p><br />


<?php
$destination = isset($_POST['destination']) ? $_POST['destination'] : "";


$user_last_name = isset($_POST['user_last_name']) ? ( $_POST['user_last_name'] ) : "";


$user_first_name = isset($_POST['user_first_name']) ? ($_POST['user_first_name']) : "";


$user_email = isset($_POST['user_email']) ? ($_POST['user_email']) : "";


$subject = isset($_POST['subject']) ? ($_POST['subject']) : "";


$message = isset($_POST['msg']) ? ($_POST['msg']) : "";




if($message != ""){
//---------------------------------------------------------------------------//
//                                Send Mail                                  //
//---------------------------------------------------------------------------//


$mail_can = send_mail($user_first_name, $user_last_name, $user_email, $destination, $subject, $message, $to);


//---------------------------------------------------------------------------//
//---------------------------------------------------------------------------//


echo $msg_s ;

print("<meta http-equiv=\"Refresh\" Content=\"6;url=$urlhome\" />");
// print("<meta http-equiv=\"Refresh\" Content=\"10;url=index.php\" />");

}
else{

echo '<span style="color:red;">'.$msg_e.' </span> ';

// print("<meta http-equiv=\"Refresh\" Content=\"2;url=contact.php\" />");
}
?>        











                    </div>