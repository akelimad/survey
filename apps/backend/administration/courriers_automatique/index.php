<?php   include ( "./courriers_auto_t.php");  ?>
 
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
 
 <head> 
 </head> 
          		<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp_admin.php"); ?>
                <script type="text/javascript" src="<?php echo $jsurl; ?>/ckeditor/ckeditor.js"></script>
     <body>  
        <!-- START CONTAINER -->
  <!-- START CONTAINER -->
            <div id='container'> 
<?php     include ( dirname(__FILE__) . $tempurl2 . "/header_admin.php");       ?> 
				 <!-- END ENTETE -->
                <!-- START GAUCHE -->
                <div id='gauche' style="width:100%"> 
                      <!-- début menu gauche -->
                    <div id="content_g">
<?php include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_admin.php"); ?>  
									</td>
                            </tr>
                        </table>
                    </div>
                    <!-- fin menu gauche -->  
                <div id='content_d' style="width:720px"> 
				<?php   include ( "./courriers_auto_m.php");  ?> 
				</div> 
                </div> 
                <!-- fin content gauche --> 
            </div> 
            <!-- END CONTAINER --> 
            <!-- BEGIN PUB FORMAT 5 --> 
            <!-- FIN PUB FORMAT 6 --> 
<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_admin.php"); ?> 
<?php   include ( "./courriers_auto_b.php");  ?> 
        </body> 
    </html>
 
