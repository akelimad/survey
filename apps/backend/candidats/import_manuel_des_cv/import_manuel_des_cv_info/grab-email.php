<?php



include('lib/config.php');
include('lib/functions.php');

include('lib/PdfToText.php');
include('lib/DocxConversion.php');
include('lib/PHPMailer/PHPMailerAutoload.php');

$successes = array();
$errors = array();
$new_emails = array();

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
$gen_pass=generateRandomString();

/**
 * First, grab the resumes sent to email
 */

/**
 *	Gmail attachment extractor.
 *
 *	Downloads attachments from Gmail and saves it to a file.
 *	Uses PHP IMAP extension, so make sure it is enabled in your php.ini,
 *	extension=php_imap.dll
 *
 */

set_time_limit(TIME_LIMIT);

/* try to connect */
$connection = imap_open(MAIL_SERVER, EMAIL, PASSWORD) or die('Cannot connect to Mailbox: ' . imap_last_error());

/* get all new emails. If set to 'ALL' instead 
 * of 'NEW' retrieves all the emails, but can be 
 * resource intensive, so the following variable, 
 * $max_emails, puts the limit on the number of emails downloaded.
 * 
 */

$date = date("j F Y");

//imap_reopen($connection, $hostname.'[Gmail]/Spam');
imap_reopen($connection, MAIL_SERVER.'INBOX');
$emails = imap_search($connection, 'ON "'.$date.'"');

//imap_reopen($connection, MAIL_SERVER.'INBOX.Junk');
//$emails2 = imap_search($connection, 'ON "'.$date.'"');

//$emails = array_merge($emails1, $emails2);

//echo count($emails);
//exit;

/* useful only if the above search is set to 'ALL' */
$max_emails = MAX_EMAILS;


//echo '<pre>';

/* if any emails found, iterate through each email */
if($emails) {

    $count = 1;

    /* put the newest emails on top */
    rsort($emails);

    /* for every email... */
    foreach($emails as $email_number)
    {

        /* get information specific to this email */
        $overview = imap_fetch_overview($connection,$email_number,0);

        /* get mail message */
        $message = imap_fetchbody($connection,$email_number,2);

        /* get mail structure */
        $structure = imap_fetchstructure($connection, $email_number);

        $attachments = array();

        /* if any attachments found... */
        if(isset($structure->parts) && count($structure->parts))
        {
            for($i = 0; $i < count($structure->parts); $i++)
            {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );

                if($structure->parts[$i]->ifdparameters)
                {
                    foreach($structure->parts[$i]->dparameters as $object)
                    {
                        if(strtolower($object->attribute) == 'filename')
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                }

                if($structure->parts[$i]->ifparameters)
                {
                    foreach($structure->parts[$i]->parameters as $object)
                    {
                        if(strtolower($object->attribute) == 'name')
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }

                if($attachments[$i]['is_attachment'])
                {
                    $attachments[$i]['attachment'] = imap_fetchbody($connection, $email_number, $i+1);

                    /* 4 = QUOTED-PRINTABLE encoding */
                    if($structure->parts[$i]->encoding == 3)
                    {
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    }
                    /* 3 = BASE64 encoding */
                    elseif($structure->parts[$i]->encoding == 4)
                    {
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }
                }
            }
        }

        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
            if($attachment['is_attachment'] == 1)
            {
                $filename = $attachment['name'];
                if(empty($filename)) $filename = $attachment['filename'];

                if(empty($filename)) $filename = time() . ".dat";

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if ( in_array($ext, $accepted_extensions) ) {
                    //if ( in_array($ext, $accepted_extensions) ) {
                    /* prefix the email number to the filename in case two emails
                     * have the attachment with the same file name.
                     */
                    //$fp = fopen("./attachments/" . $email_number . "-" . $filename, "w+");
                    $id = uniqid();
                    $filename =  $id . "CV." . $ext;
                    $file =    "./attachments/attachment-" . $filename;
                    if (!isset($dev)) {
                        $new_file =  dirname(__FILE__).$file_cv5.$filename;
                    } else {
                        $new_file =    "./attachments/processed/attachment-" . $filename;
                    }

                    $fp = fopen($file, "w+");
                    fwrite($fp, $attachment['attachment']);
                    fclose($fp);

                    /**
                     * Second, grab the email address from this resume
                     */

                    $source = '';
                    $exist = false;
                    if (in_array($ext, $doc_extensions)) {
                        $doc = new DocxConversion( $file );
                        $source = $doc->convertToText();
                    }  elseif ($ext == 'pdf') {
                        $pdf    =  new PdfToText ( $file ) ;
                        $source = $pdf -> Text ;
                    }


                    //echo $source;

                    /**
                     * Third, send a thank-you email to these email addresses
                     */
                    $found_emails = get_email_from_source($source);

                    //die(var_dump($found_emails));

                    if (!empty($found_emails)) {
                        $to_email = $found_emails[0][0];

                        $mail_subject = "CV received";
                        $mail_message = "Thank you for dropping us your resume.";

                        if (!email_exists($to_email)) {
                            /** Move the attached file to /processed */
                            if (file_exists($file)) rename($file, $new_file);

                            $gen_pass=generateRandomString();
                        $mdp = md5($gen_pass);
                        $mdp_req = $mdp;

                        insert_email(array('email'=>$to_email, 'password'=>$mdp_req,'password2'=>$gen_pass,'filename'=>$filename,'status'=>2,'lastcnx'=>'0000-00-00'));
                       // insert_email(array('email'=>$to_email));

                        $_SESSION['emails'][] =  array('email'=>$to_email, 'password'=>$gen_pass);


                        if (!isset($dev)) {
                            include("./enregistrement_candidat_email_2.php");
                        } else {
                            send_email($to_email);
                        }
                        } else {
                            /** Remove the attached file if email already exists */
                            if (file_exists($file)) unlink($file);
                        }

                        

                    } else {
                        /** Remove the attached file //*/
                        if (file_exists($file)) unlink($file);
                    }

                }

        }

    }

if($count++ >= $max_emails) break;
}

}

/* close the connection */
imap_close($connection);

?>
    <h2>Result</h2>
<?php if (count($emails) == 0) { ?>
    <p>No email found.</p>
    <?php
} else {
    ?>
    <p><?php echo count($emails); ?> recent email(s) found in the inbox</p>
    <p><?php echo count($successes); ?> email(s) found & sent to their respective owners.</p>
<?php }