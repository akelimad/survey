<?php
require_once dirname(__FILE__) . "/../../../../../../config/config.php";



function get_email_from_source($src) {
    $pattern = '/[A-Za-z0-9._-]+@[A-Za-z0-9._-]{2,}\.[a-z]{2,4}/';
    preg_match_all($pattern, $src, $emails);

    if (!empty($emails) && !empty($emails[0])) {
        return $emails;
    }  else
        return '';

}

function email_exists($email) {
    $query = "SELECT * FROM candidats WHERE email='$email'";
    $result_set = mysql_query($query) or die(mysql_error());

    return mysql_num_rows($result_set);
}

function insert_emails($emails) {
    if (!empty($emails)) {
        foreach ($emails as $email) {

            if (!email_exists($email['email'])) {

            }// Insert emails
            $query = "INSERT INTO candidats (email,mdp,nl_partenaire,status) VALUES ";
            $query .= "( '".$email['email']."' ,  '".$email['password']."' , '".$email['password2']."',".$email['status']." )";

            mysql_query($query) or die(mysql_error());
            $id = mysql_insert_id();

            // Insert CV
            $query = "INSERT INTO cv VALUES ";
            $query .= "('', ".$id.",'".$email['filename']."' ,'".$email['filename']."' ,'1','1')";

            mysql_query($query) or die(mysql_error());


            $query = "INSERT INTO cv_importe ( `candidats_id`,`mail`) VALUES ";
            $query .= "( ".$id.",'".$email['email']."' )";

            mysql_query($query) or die(mysql_error());
        }

    }

    return true;

}
function insert_email($email) {

    if (!email_exists($email['email'])) {
        // Insert emails
        $query = "INSERT INTO candidats (email,mdp,nl_partenaire,status,last_connexion) VALUES ";

        $query .= "( '".$email['email']."' ,  '".$email['password']."' , '".$email['password2']."',".$email['status'].",".$email['lastcnx']." )";

        mysql_query($query) or die(mysql_error());
        $id = mysql_insert_id();

        // Insert CV
        $query = "INSERT INTO cv VALUES ";
        $query .= "('', ".$id.",'".$email['filename']."' ,'".$email['filename']."' ,'1','1')";

        mysql_query($query) or die(mysql_error());


        $query = "INSERT INTO cv_importe ( `candidats_id`,`mail`) VALUES ";
        $query .= "( ".$id.",'".$email['email']."' )";

        mysql_query($query) or die(mysql_error());
    }


    return true;

}
