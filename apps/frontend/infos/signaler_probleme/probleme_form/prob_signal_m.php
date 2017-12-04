

<?php

/** Validate captcha */
if (!empty($_REQUEST['captcha'])) {
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
       
          echo "<meta http-equiv='refresh' content='0;URL=../?cpcha=0'>";

        ?>
 

<?php 
		} else {
			
			
         include (  "./prob_signal_m_f.php"); 

		}
	 
		unset($_SESSION['captcha']);
	}

?>

