<?php

 

	// Plusieurs destinataires

     $to  = $user_email; // notez la virgule  . ', ';  $to .= '';

 



    $headers = "From:  ".$nom_site." <".$from_email."> \n" .

            "Content-Type: text/html; charset=ISO-8859-15\n"; //ISO-8859-15

	$headers .= 'Cci: '  . $conf_admin_email_s_prob . "\r\n"; 



    $body = "<p>Bonjour </p><p>Vous avez soumet une requête sur " . $site." avec le ticket : <b>".$ticket."</b></p>"; 

 

    $body .= "<p>Votre message est : <b>" . $message_2 ."</b></p>";

                

    $body .= "<p>Cordialement</p>"  ;

                

    $sujet =  "Votre requête sur  ".$site." : ".$ticket ;           // solution de probléme de codage é --> Ã©  =  utf8_decode("Signaler un probléme")

 

 

mail($to,$sujet,$body,$headers);



//==========//==========//==========//==========// 



 

?>