<?php	include('./fiche_profil_t.php');    ?>

    <!DOCTYPE html>

    <html >

        <head>		 

                <?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp.php"); ?>				

				<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>

        </head>

        <body>

<?php

/////////////////////////////////////////////////////////////////////////////////// 

$vis='';$sans_exp='';

///////////////////////////////////////////////////////////////////////////////////

?>		

				

<div id='container'>

  <?php include ( dirname(__FILE__) . $tempurl2 . "/header.php"); ?>

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

      <?php 

        include ( "./moncv_m.php");    

      ?>

    </div>



  

  </div>

 

</div>  

<?php 

include ( dirname(__FILE__) . $tempurl2 . "/footer.php"); 

?>

<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_tmp.php"); ?>

<?php

include ( "./fiche_profil_b.php"); 

?>  

</body>

</html>

