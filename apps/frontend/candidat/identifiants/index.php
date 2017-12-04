<?php  include ( "./changer_mdp_t.php");  ?>

<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp.php"); ?>

<style type="text/css">td{padding:5px 0;}</style>

 

</head>

<body>

<!-- START CONTAINER -->

    <div id='container'>

        <?php include ( dirname(__FILE__) . $tempurl2 . "/header.php"); ?><br/>

<!-- END ENTETE -->

<!-- START GAUCHE -->   

<div id='gauche'>

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

    

    

     <div id='content_d' style="width:700px">

      <?php 

        include ( "./changer_mdp_m.php");    

      ?>

    </div>

</div><!-- fin content gauche -->

<!-- début div droit -->



</div>

<?php 

include ( dirname(__FILE__) . $tempurl2 . "/footer.php"); 

?>

<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_tmp.php"); ?>

<?php

include ( "./changer_mdp_b.php"); 

?>  

</body>

</html>