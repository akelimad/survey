<?php  include ( "./password_perdu_t.php");  ?>





<!DOCTYPE html >



<html xmlns="http://www.w3.org/1999/xhtml">



<head>

<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp.php"); ?>

</head>



<body>

<div id='container'>       

  <?php include ( dirname(__FILE__) . $tempurl2 . "/header.php"); ?><br/>

  <!-- debut ENTETE -->

  <div id='gauche'>

    <!-- début menu gauche -->

    <div id="content_g">

      <table width="210"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" >

        <tr>

          <td>

            <?php //include (  dirname(__FILE__) . $menuurl . "/menu_gauche_t.php"); ?>

            <?php include (  dirname(__FILE__) . $menuurl2 . "/menu_gauche.php"); ?>

          </td>

        </tr>

      </table>

    </div>

     <!-- fin menu gauche -->   

    <div id="content_d" style="width:700px;">

      <?php

      include ( "./password_perdu_m.php"); 

      ?>

    </div>

    <!-- fin contenu milieu -->

  </div>

  <!-- fin content gauche -->

</div>

<!-- fin entete -->

<?php 

include ( dirname(__FILE__) . $tempurl2 . "/footer.php"); 

?>

<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_tmp.php"); ?>

<?php

include ( "./password_perdu_b.php"); 

?>

</body>

</html> 

