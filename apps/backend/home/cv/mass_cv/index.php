<?php // HTTP Headers for ZIP File Downloads
// https://perishablepress.com/press/2010/11/17/http-headers-file-downloads/

 session_start();
 
 require(dirname(__FILE__) . "/../../../../../config/config.php");

// set example variables

$filename = $_SESSION['zip_fichier'];
$filepath = dirname(__FILE__).$file_dwn_cv_mass3;


// http headers for zip downloads
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".$filename."\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filepath.$filename));
ob_end_flush();
/*readfile("$archive_file_name");*/
@readfile($filepath.$filename);
?>