<?php
$adminMenuLinks = require( site_base('src/includes/data/adminMenuLinks.php') );
?>
<nav class="navbar navbar-default" id="mainMenu">
	<div class="container-fluid p-md-0 p-lg-0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNavbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="mainNavbar" class="navbar-collapse collapse p-md-0 p-lg-0 ml-xs-0 mr-xs-0">
			<ul class="nav navbar-nav m-xs-0">
				<?= drawAdminMenu($adminMenuLinks); ?>
			</ul>
		</div>
	</div>
</nav>