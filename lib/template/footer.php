<div id='bottom'>



	<div id='bdp' >		



	<div id='bdp_texte' style="padding-top:10px;" >     



	<a class='bdp' href='<?= site_url('terms'); ?>'><?php trans_e("Mentions légales"); ?></a>    

    <span class='bdp' style="color:#ffffff;" >|</span>



	<a class='bdp' href='<?= site_url('conditions'); ?>'><?php trans_e("Conditions Générales d'utilisation"); ?></a>    	   

	 <span class='bdp' style="color:#ffffff;" >|</span>





	<a class='bdp' href='<?= site_url('sitemap'); ?>'><?php trans_e("Plan du site"); ?></a>  


	 <?php if(get_setting('allow_bugs_report') == 1) : ?>
	<a class='bdp' href='<?= site_url('bug-report'); ?>'><?php trans_e("Signaler un problème"); ?></a>

	 <span class='bdp' style="color:#ffffff;" >|</span>
	<?php endif; ?>
	 


	<?php if(get_setting('show_copyright') == 1) : ?>
   <div style="display:inline;float:right;padding-right:30px;font-family:arial;font-size:10px;font-weight:bold;">	  

   <a class="copyright bdp" href="<?php echo $site_url_lycom ?>" target="_blank" title="E-Talent - Nouvelle fenêtre">  &copy;   E-Talent</a>

   </div>
   <?php endif; ?>



    </div>	



    </div>	



</div>
