<?php         include("./note_off_resuta_t.php");     ?><!DOCTYPE html ><html xmlns="http://www.w3.org/1999/xhtml"><head><?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?><script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>  <script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script> <script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery.tablesorter.min.js"></script><script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery.tablesorter.pager.min.js"></script>  <script type="text/javascript">    $(document).ready(function() {         $("#note_candidature").tablesorter({sortList: [[0,1]],                     widgets: ['zebra'],                     dateFormat: 'uk',               headers: {0: {sorter:'text'}  ,7: {sorter: "shortDate"}} ,               widthFixed: true, widgets: ['zebra']});           		                                           });  </script></head><body><!-- START CONTAINER --><div id='container' ><?php     include ( dirname(__FILE__) . $tempurl3 . "/header_admin.php");       ?><div id='content_d' style="width:100%;">   <?php include ("./note_off_resuta_m.php"); ?></div> </div><?php include ("./note_off_resuta_b.php"); include ( dirname(__FILE__) . $tempurl3 . "/footer_admin.php"); ?> <?php include ( dirname(__FILE__) . $tempurl3 . "/footer_tmp_admin.php"); ?></body></html> 