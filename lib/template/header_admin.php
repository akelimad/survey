 <!-- START ENTETE -->

 <div class="quicknavigation">

    <div class="center">

            

            <div class="nav">

                <ul>

             

            </ul>

            </div>

            <!-- SOCIAL BTNS-->

            <div id="ctl00_ctl00_ph_socialHead" class="socialHub"> 

</div>

            <!-- RSS / Contact-->

        <div class="rsscontact">

                <ul>



                    <li class="acces"><a href="<?php echo $site_url ?>" target="_blank" 

                    style="color:#ffffff;" title="Accès au site du Groupe - Nouvelle fenêtre">Accès au site de l'entreprise</a></li>

                    <li class="contactus"><a href="<?php echo $urlinfos ?>/contact/" 

                    style="color:#ffffff;" title="Contactez-nous">Contactez-nous</a></li>

                </ul>   

        </div>



        </div>

  </div>



 <?php

 /*

 $path1 = $_SERVER['REQUEST_URI'];

 

 $color_lien_menu="";



if(substr($path1,-15)=="/home/index.php")

 $color_lien_menu="accueil";

 if(substr($path1,-17)=="/infos/enbref.php" or substr($path1,-18)=="/infos/valeurs.php" or substr($path1,-19)=="/infos/filiales.php" or substr($path1,-21)=="/infos/actualites.php" )

  $color_lien_menu="nous";

 if(substr($path1,-18)=="/infos/metiers.php")

 $color_lien_menu="metiers";

 if(substr($path1,-22)=="/infos/temoignages.php")

 $color_lien_menu="temoignages";

 

 if(stristr($path1,"/candidat/") or stristr($path1,"/offres/"))

  $color_lien_menu="nousrejoindre";

   if(substr($path1,-22)=="/infos/processusrh.php")

  $color_lien_menu="nousrejoindre";

  if(substr($path1,-22)=="/infos/politiquerh.php")

  $color_lien_menu="nousrejoindre";

  if(substr($path1,-28)=="/infos/foireauxquestions.php")

  $color_lien_menu="nousrejoindre";



//*/

 

 ?>

 <!--

 <style type="text/css">

.social{font-family:verdana;font-size: 10px;float: right;margin-top: -1px;height: 10px; vertical-align: middle;}

.social img ,.mysocial img{    vertical-align: middle;}

.mysocial{font-family:verdana;padding-top: -2px;position: relative;font-size: 10px;height: 10px;margin-left: 820px;}

 </style>

-->

 

               <?php 

                 include ( dirname(__FILE__) .'/../menu/menu_top.php');

				?>

				

 <div style="padding: 10px 0px">



						

                           <div style="float: left;">

                    				Vous êtes ici :  <b><?php echo $ariane; ?></b>                           

							</div>     

						   <div style="float: right;">

                                <?php	 

								if (isset($_SESSION['abb_admin']))  { 

								?>

<table>

<tr>



<td>

<div style="float:left;">

<?php 

 if (isset($_SESSION['abb_admin'])) 

 { 

 echo 'Connect&eacute; en tant que: <b>' . $_SESSION['abb_admin'] . '</b>| <a href="' . $urlhome . 'index.php?action=logout">D&eacute;connexion</a>'; 

 }

 /*

elseif (isset($_SESSION['responsablecom'])) 

{ 

echo 'Connect&eacute; en tant que: <b>' . $_SESSION['responsablecom'] . '</b>| <a href=' . $urlhome . 'index.php?action=logout>D&eacute;connexion</a>'; 

}

elseif (isset($_SESSION['agentcom'])) 

{ 

echo 'Connect&eacute; en tant que: <b>' . $_SESSION['agentcom'] . '</b>| <a href=' . $urlhome . 'index.php?action=logout>D&eacute;connexion</a>'; 

}

 elseif (isset($_SESSION['recrutement'])) 

 { 

 echo 'Connect&eacute; en tant que: <b>' . $_SESSION['recrutement'] . '</b>| <a href=' . $urlhome . 'index.php?action=logout>D&eacute;connexion</a>'; 

 }

 //*/

 ?>

 </div>

 </td>

</tr>

</table>

								<?php

								} 

								?>          

                             </div>     

</div>

					 

 

            <span style="position:relative;text-align:left; width:940px; padding:0px 10px ; color:#454545; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px;float:left;height:0px"> 

			<?php set_include_path('/template');?>

            </span>