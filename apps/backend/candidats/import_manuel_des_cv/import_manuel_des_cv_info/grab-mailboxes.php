<?php

include('lib/config.php');
include('lib/functions.php');


/* connect to gmail with your credentials */
//$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$hostname = '{mail.lycom.ma:143/novalidate-cert}';
//$hostname = '{imap.hellodarija.com:993/imap/ssl}';
$username = EMAIL;
$password = PASSWORD;

/* try to connect */
$connection = imap_open(MAIL_SERVER, EMAIL, PASSWORD) or die('Cannot connect to Mailbox: ' . imap_last_error());

$mailboxes = imap_list($connection, MAIL_SERVER, '*');

echo '<pre>';
var_dump($mailboxes);
exit;