<?php	include("./historique_des_requetes_t.php");     ?>
    <!DOCTYPE html >

    <html xmlns="http://www.w3.org/1999/xhtml">

        <head>

			<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>
			<style>select{width:190px ;}</style>
			  
			 
        </head>

        <body>



            <!-- START CONTAINER -->

            <div id="container">

           
			<?php     include ( dirname(__FILE__) . $tempurl3 . "/header_admin.php");       ?>
            
			<!-- END ENTETE -->

                <!-- START GAUCHE -->	

                <div id="gauche">

				<?php include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_candidats.php"); ?>
                </div><!-- fin content gauche -->
<div id="content_d" style="width:720px;margin-left: 20px;"><br/>
<h1>HISTORIQUE DES REQUETES</h1>
<?php
echo '<div style=" float: right; padding: 2px 5px 0px 0px;">
            <a href="../?a=2&b=24" style=" border-bottom: none; ">
            <img src="'.$imgurl.'/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>
          </a>  </div>';
              echo '<div class="subscription" style="margin: 10px 0pt;">
                    <h1>D&eacute;tails des requ&#233;tes</h1>
                    </div>  ';
 //include('historique_des_requetes_m.php');?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" >   
<?php include ("historique_des_requetes_m_table.php"); ?>
</form>
</div>



<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_admin.php"); ?>
<?php       ?>
<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_tmp_admin.php"); ?>

</body>
</html> 