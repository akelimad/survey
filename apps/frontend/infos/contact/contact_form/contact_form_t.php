<?php 

 
    require_once dirname(__FILE__) . "/../../../../../config/fo_conn.php";
 
 

////////////////////////////////////////////////////////
    $sql = "select * from message_page ";
    $select = mysql_query($sql);
    $reponse = mysql_fetch_assoc($select); 
    $msg_s= $reponse ["message1"] ;
    $msg_e= $reponse ["message2"] ;
//////////////////////////////////////////////////////
     
?>



<?php

/** Validate captcha */
if (!empty($_REQUEST['captcha'])) {
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
       
          echo "<meta http-equiv='refresh' content='0;URL=../?cpcha=0'>";

        ?>
 

<?php 
		} else {
			
			
			include("contact_form_t_email_1.php");

		}
	 
		unset($_SESSION['captcha']);
	}

?>


<?php



$ariane="  Accueil > Contact ";
?>