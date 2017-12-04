<?php



include ( "./etape4_t.php");	

?>

<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp.php"); ?>
 
</head>

<body>

<!-- START CONTAINER -->

	<div id='container'>

		<?php include ( dirname(__FILE__) . $tempurl3 . "/header.php"); ?><br/>

<!-- END ENTETE -->

<!-- START GAUCHE -->	

<div id='gauche'>

<div id="content_g">
 <table width="210"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >
  <tr>
    <td >
  <?php include (  dirname(__FILE__) . $menuurl3 . "/menu_gauche_t.php"); ?>
  <?php include (  dirname(__FILE__) . $menuurl3 . "/menu_gauche.php"); ?>
    </td>
  </tr>
 </table>
</div>

<div id='content_d' style="width: 715px;">
<?php
include ( "./etape4_m.php");	
?>
</div></div>



</div>

<!-- END CONTAINER -->

<?php include ( dirname(__FILE__) . $tempurl3 . "/footer.php"); ?>
<?php
include ( "./etape4_b.php");	
?>
</body>

</html>
 