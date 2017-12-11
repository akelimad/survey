<?php



$to = $info_contact;

    //$to = $admin_email; 

	

function send_mail($name, $prenom, $from, $dest, $subject, $message, $to) {

/*

$select = mysql_query("select * from root_email_auto where ref='b' ");

$reponse = mysql_fetch_array($select);

$a = mysql_num_rows($select);

$from_email=$reponse["email"];

//*/





$to = $to;



    $emailfrom = $from;





    $headers = "From: $emailfrom \n" .

            "Content-Type: text/html; charset=utf-8\n";









$body = "Bonjour <BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;





                <strong><font face= \"Arial\" style= \"font-size: 10pt \"> Destination : 





                </font></strong>"

            . $dest;











    $body .= "<BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;





            <strong><font face= \"Arial\" style= \"font-size: 10pt \"> Nom : 





            </font></strong>" . $name;











    $body .= "<BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;





            <strong><font face= \"Arial\" style= \"font-size: 10pt \"> Prenom : 





            </font></strong>"

            . $prenom;











    $body .= "<BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;





                <strong><font face= \"Arial\" style= \"font-size: 10pt \"> email : 





                </font></strong>"

            . $from;











    $body .= "<BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;





                <strong><font face= \"Arial\" style= \"font-size: 10pt \">Sujet : 





                </font></strong>"

            . $subject;











    $body .= "<BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;





                <strong><font face= \"Arial\" style= \"font-size: 10pt \">Message : 





                </font></strong>"

            . $message;















    mail($to, $subject, $body, $headers);

}

?>