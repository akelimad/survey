<?php   include ( "./moncompte_t.php");     ?>


<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>

<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp.php"); ?>
  
<?php	
	if(isset($_GET['succed']))
			{
 
			echo '<script type="text/javascript" >
			window.opener.location.reload();
			window.opener.location.href="'.$urlcandidat.'/compte/";
			self.close(); 
			</script>';

			}
?> 
</head>

<body>

<div id='container'>
  <?php include ( dirname(__FILE__) . $tempurl2 . "/header.php"); ?><br/>
  <!-- END ENTETE -->
  <!-- START GAUCHE -->
  <div id='gauche' style="width:100%">
<!-- début menu gauche -->
<div id="content_g">
 <table width="210"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >
  <tr>
    <td >
  <?php include (  dirname(__FILE__) . $menuurl2 . "/menu_gauche_t.php"); ?>
  <?php include (  dirname(__FILE__) . $menuurl2 . "/menu_gauche.php"); ?>
    </td>
                            </tr>
                        </table>
                    </div>
                       <!-- fin menu gauche -->  
    <div id='content_d' style="width:700px">
      <?php    include("../cv/traitement.php");?>
      <?php 
        //include("./moncompte_m.php"); 
        include("./moncompte_m.php");  
      ?>
    </div>

  
  </div>
 
</div>
<?php 
include ( dirname(__FILE__) . $tempurl2 . "/footer.php"); 
?>
<?php
 //include ( dirname(__FILE__) . $tempurl . "/footer_tmp.php");
 ?>
<?php
include ( "./moncompte_b.php"); 
?>  
</body>
</html>