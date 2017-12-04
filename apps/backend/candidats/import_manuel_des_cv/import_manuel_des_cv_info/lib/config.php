<?php
require_once dirname(__FILE__) . "/../../../../../../config/config.php";
  
                       

          /**
 * Database connection
 

// Define the DB Server
//define('DB_SERVER', 'localhost');

// Define the DB User
define('DB_USER', '');

// Define the DB User
define('DB_PASSWORD', '');

// Define the DB User
define('DB_NAME', '');
*/
// Define your full name
define('FULL_NAME', 'Developer');

/**
 * SMTP
 */

// Define STMP Server
define('SMTP', 'smtp.gmail.com');

// Define STMP Email
define('SMTP_EMAIL', '');

// Define STMP password
define('SMTP_PASSWORD', '');

// Define your reply-to email address
define('REPLY_TO', SMTP_EMAIL);

// Define your reply-to full name
define('REPLY_TO_NAME', FULL_NAME);

/**
 * MAIL SERVER
 */

/* Define your mail server */
define('MAIL_SERVER', '{mail.etalent.ma:143/novalidate-cert}');

// Define your email address
define('EMAIL', 'pharma5@etalent.ma');

// Define your email password
define('PASSWORD', 'qwerty1');

// Define your reply-to full name
define('TIME_LIMIT', 9000);

// Define max emails to fetch
define('MAX_EMAILS', 25);

//$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
//$db = mysql_select_db(DB_NAME) or die(mysql_error());

$accepted_extensions = array('doc', 'docx', 'pdf');
$doc_extensions = array('doc', 'docx');
?>
