<?php
$planSitePath = (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") ? 'liens/' : 'liens_a/';
?>


<div class="container">
	<nav class="navbar navbar-default" id="footer-navbar">
		<div class="container-fluid pl-5 pl-xs-15">
			<ul class="nav navbar-nav mb-xs-0">
				<li><a href="<?= site_url('infos/mentions_legales/'); ?>">Mentions légales</a></li>
				<li><a href="<?= site_url('infos/conditions/'); ?>">Conditions Générales d'utilisation</a></li>
				<li><a href="<?= site_url('infos/'.$planSitePath); ?>">Plan du site</a></li>
				<li><a href="<?= site_url('infos/signaler_probleme/'); ?>">Signaler un problème</a></li>
			</ul>
			<?php if(get_setting('show_copyright') == 1) : ?>
			<ul class="nav navbar-nav navbar-right pr-5 mt-xs-0">
				<li><a href="http://www.etalent.ma/" target="_blank" title="E-Talent- Nouvelle fenêtre">&copy; E-Talent</a></li>
			</ul>
			<?php endif; ?>
		</div>
	</nav>
</div>