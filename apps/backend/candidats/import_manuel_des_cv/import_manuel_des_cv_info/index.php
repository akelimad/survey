<?php
	include("./import_manuel_des_cv_info_t.php");  
if(!(($_FILES["file"]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" AND $_FILES["file"]["type"] == "application/msword") 
	OR ($_FILES["file"]["type"] != "application/msword" AND $_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" OR $_FILES["file"]["type"] == "application/pdf"))){

    header("Location: ".$urlad_cand."/import_manuel_des_cv/?e=1 ");
}
else
{  ?>

    <!DOCTYPE html PUBLIC>

    <html xmlns="http://www.w3.org/1999/xhtml">

        <head>

<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>
  
</head>
<body>

 
<div id='container' >
<?php     include ( dirname(__FILE__) . $tempurl3 . "/header_admin.php");       ?>

 

                    <br>    <br>
<?php include ( "./import_manuel_des_cv_info_m.php");?>
</div>


<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_admin.php"); ?>
<?php include ( "./import_manuel_des_cv_info_b.php");?>

</body>

</html>
<?php
}
?>
