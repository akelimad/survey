<?php include ( "./index_t.php"); ?>

<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp.php"); ?>
<link rel="stylesheet" type="text/css" href="<?= site_url('assets/css/etalent-alerts.css') ?>">
<style>
  .chm-alerts {
    margin-bottom: 5px;
  }
  .chm-alerts.alert-white .icon {
    padding-top: 0px;
  }
  .chm-alerts ul {
    margin: 12px 0 10px 55px !important;
  }
  .chm-alerts button.close {
    display: none;
  }
</style>
</head>

<body>



 <!-- START CONTAINER -->

<div id='container'>

                <!-- START ENTETE -->

<?php if (isset($_SESSION['abb_admin'])) {

include ( dirname(__FILE__) . $tempurl2 . "/header.php");  }

else {

include ( dirname(__FILE__) . $tempurl2 . "/header.php");  } ?>

<div id='gauche'>

    <div id='content_g'>

        <div id="menu-fo">

        </div>	

    </div>		

    <div id='content_d'>
      <?php get_flash_message() ?>
        <?php include ("./index_m.php"); ?>

    </div>

</div><!-- fin content gauche -->

<div id='droite'>

</div>

<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_admin.php"); ?>

<?php       include ( "./index_b.php"); ?>

</body>

</html> 