<?php      include ( "./inscription_t.php");	 	?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php   include ( dirname(__FILE__) . $tempurl2 . "/header_tmp.php"); ?>
<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>
<?php	
	if(isset($_GET['succed']))
			{
 
			echo '<script type="text/javascript" >
			window.opener.location.reload();
			window.opener.location.href="'.$urlcandidat.'/inscription/";
			self.close(); 
			</script>';

			}
?> 

</head>

<body>
<?php 

/*function redirect($url) {
    if(!headers_sent()) {
        //If headers not sent yet... then do php redirect
        header('Location: '.$url);
        exit;
    } else {
        //If headers are sent... do javascript redirect... if javascript disabled, do html redirect.
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';
        exit;
    }
}
*/

$url = $urlcandidat."./";
if (isset($_SESSION["abb_login_candidat"]) && $_SESSION["abb_login_candidat"] != "") {redirect($url);}
?>
<?php include ( "./inscription_m.php");	 ?>


<?php include ( dirname(__FILE__) . $tempurl2 . "/footer.php"); ?>

<?php  include ( "./inscription_b.php");	 ?>

</body>

</html>
 