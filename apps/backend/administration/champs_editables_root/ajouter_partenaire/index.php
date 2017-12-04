<?php  include ( "./ajout_partenaire_t.php"); ?>



<!DOCTYPE html>



<html xmlns="http://www.w3.org/1999/xhtml">



    <head> 
	
		<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>
		
		<style type="text/css"   >
		#addrole tr td{height:20px;}
		input{width:200px;}
		select{width:206px;}
		.btn{width:70px;}
		.erreur{color:red;}
		.success{color:green;}
		</style>	

<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script> 
    </head>



    <body>



        <!-- START CONTAINER -->



        <div id='container'>




            <!-- START ENTETE -->


<?php     include ( dirname(__FILE__) . $tempurl3 . "/header_admin.php");       ?>

            <!-- END ENTETE -->

            <!-- START GAUCHE -->	

            <div id='gauche' style="width:100%">

<?php include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_admin.php"); ?>
                
                <div id='content_d' style="width:720px">
				
				<?php  include ( "./ajout_partenaire_m.php"); ?>
				
                </div></div>


        </div>


<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_admin.php"); ?>
		   <?php  include ( "./ajout_partenaire_b.php"); ?>
    </body>



</html>