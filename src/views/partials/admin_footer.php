<?php
$planSitePath = (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") ? 'liens/' : 'liens_a/';
?>
<div id="bottom">
	<div id="bdp">		
		<div id="bdp_texte" style="padding-top:10px;" >     
			<a class="bdp" href="<?= site_url('infos/mentions_legales/'); ?>">Mentions légales</a>    
			<span class='bdp' style="color:#ffffff;">|</span>
			<a class="bdp" href="<?= site_url('infos/conditions/'); ?>">Conditions Générales d'utilisation</a>    	   
			<span class="bdp" style="color:#ffffff;">|</span>
			<a class="bdp" href="<?= site_url('infos/'.$planSitePath); ?>">Plan du site</a>      	   
			<span class="bdp" style="color:#ffffff;">|</span>
			<a class="bdp" href="<?= site_url('infos/signaler_probleme/'); ?>">Signaler un problème</a>
			<div style="display:inline;float:right;padding-right:30px;font-family:arial;font-size:10px;font-weight:bold;">	
				<a class="bdp" href="http://www.etalent.ma/" target="_blank" title="E-Talent- Nouvelle fenêtre">&copy; E-Talent</a>
			</div>
		</div>
	</div>
</div>