<?php

$ppp='/liens_a/';

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

$ppp='/liens/';

}

?>

<div id='bottom'>



	<div id='bdp'>		



	<div id='bdp_texte' style="padding-top:10px;" >     



	<a class='bdp' href='<?php echo $urlinfos; ?>/mentions_legales/'>Mentions l&eacute;gales</a>    

    <span class='bdp' style="color:#ffffff;" >|</span>



	<a class='bdp' href='<?php echo $urlinfos; ?>/conditions/'>Conditions G&eacute;n&eacute;rales d'utilisation</a>    	   

	 <span class='bdp' style="color:#ffffff;" >|</span>

	



	<a class='bdp' href='<?php echo $urlinfos. $ppp; ?>'>Plan du site</a>      	   

	 <span class='bdp' style="color:#ffffff;" >|</span>



	<a class='bdp' href='<?php echo $urlinfos; ?>/signaler_probleme/'>Signaler un problème</a>

	   

              



   
	<?php if(get_setting('show_copyright') == 1) : ?>
   <div style="display:inline;float:right;padding-right:30px;font-family:arial;font-size:10px;font-weight:bold;">	 

   <a class='bdp' href="<?php echo $site_url_lycom ?>" target="_blank" title="E-Talent- Nouvelle fenêtre">  &copy;   E-Talent</a>

   </div> 
	<?php endif; ?>


    </div>	



    </div>	



</div>
<?php \App\Event::trigger('footer'); ?>