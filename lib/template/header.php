 <!-- START ENTETE -->

 



 

 <div class="quicknavigation">

 <!--

  <div style="float:left; width:125px; margin: -10px 0 0 10px;" >

  <div id="google_translate_element"></div><script type="text/javascript">

function googleTranslateElementInit() {

  new google.translate.TranslateElement({pageLanguage: 'fr', includedLanguages: 'de,en,es,fr', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');

}

</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  </div>  

  -->			     <!-- -->

			   

 						

            <div   style="  float: left; width: 220px;">

  

          <?php if( $fb_url!='' or $tw_url!='' or $li_url!='' or $via_url!='' ){ ?>

		  

					<div class="socialButtons"  style="color:#ffffff;" >  <?php trans_e("Retrouvez-nous sur:"); ?> 

					

          <?php if( $fb_url!=''   ){ ?>

					 <a href="<?php echo $fb_url ?>" target="_blank" title="<?php trans_e("Retrouver nous sur Facebook - nouvelle fenêtre"); ?>">

           <img id="img_fb" src="<?php echo $imgurl ?>/icons/head-fb.png" alt="<?php trans_e("Retrouver La Poste recrute sur Facebook"); ?>"></a>

          <?php } ?>

		   

          <?php if(  $tw_url!=''   ){ ?>

					 <a href="<?php echo $tw_url ?>" target="_blank" title="<?php trans_e("Retrouver nous sur Twitter - nouvelle fenêtre"); ?>">

           <img src="<?php echo $imgurl ?>/icons/head-twitter.png" alt="<?php trans_e("Retrouver La Poste recrute sur Twitter"); ?>"></a>

          <?php } ?>

		   

          <?php if(   $li_url!=''   ){ ?>

					 <a href="<?php echo $li_url ?>" target="_blank" title="<?php trans_e("Retrouver nous sur LinkedIn - nouvelle fenêtre"); ?>">

           <img id="img_li" src="<?php echo $imgurl ?>/icons/head-linkedin.png" alt="<?php trans_e("Retrouver La Poste recrute sur LinkedIn"); ?>"></a>

          <?php } ?>

		   

          <?php if(   $via_url!='' ){ ?>

					 <a href="<?php echo $via_url ?>" target="_blank" title="<?php trans_e("Retrouver nous sur Viadeo - nouvelle fenêtre"); ?>">

           <img id="img_vd" src="<?php echo $imgurl ?>/icons/head-viadeo.png" alt="<?php trans_e("Retrouver La Poste recrute sur Viadeo"); ?>"></a>

          <?php } ?>

					 

					</div>

 

          <?php } ?>

		  

			</div>



    <div class="center" style="  float: right; width: 400px;">

            

            <div class="nav">

                <ul>

             

            </ul>

            </div> 





            <!-- RSS / Contact-->

        <div class="rsscontact">

                <ul>



                    <li class="acces"><a 

                    style="color:#ffffff;" href="<?php echo $site_url ?>" target="_blank" title="Accès au site de l'institution - Nouvelle fenêtre"><?php trans_e("Accès au site de l'institution"); ?></a></li>

                    <li class="contactus"><a 

                    style="color:#ffffff;" href="<?php echo $urlinfos ?>/contact/" title="<?php trans_e("Contactez-nous"); ?>"><?php trans_e("Contactez-nous"); ?></a></li>

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

 <style type="text/css">

.social{

font-family:verdana;

font-size: 10px;

float: right;

margin-top: -1px;

height: 10px;

 vertical-align: middle;

}

.social img ,.mysocial img

{

    vertical-align: middle;

}

.mysocial

{

font-family:verdana;

padding-top: -2px;

position: relative;

font-size: 10px;

height: 10px;

margin-left: 820px;

}

 </style>







	<?php if (get_setting('custom_logo_banner', '') != '') : ?>
            <?= get_setting('custom_logo_banner') ?>
        <?php else : ?>
            <a href="<?= site_url(); ?>" id="logo-banner">
                <img src="<?= site_url('assets/images/bannier/'. $GLOBALS['etalent']->config['banniere']); ?>" class="img-responsive">
            </a>
        <?php endif; ?>

			<div id="menulangue-panier"  >

						<h3 class="titreh1"><?= get_setting('front_welcome_message', 'Bienvenue sur Etalent'); ?></h3>

				<div id="menulangue">

				<?php trans_e("Vous êtes ici"); ?> :  <b><?php echo $ariane; ?></b>

				<div id="ctl00_cont_panier">

			</div>

			

            <span style="position:relative;text-align:left; width:940px; padding:0px 10px ; color:#454545; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px;float:left;height:0px"> <?php set_include_path('/template');

?>

            </span>