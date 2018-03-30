<div id="menu-fo" style="width: 250px;">
	<ul class="nav nav-pills nav-stacked mb-15">
		<?php $menuLinks = require( site_base('src/includes/data/adminMenuLinks.php') );?>
		<?php echo \App\Models\Menu::draw($menuLinks[6]['childrens']); ?>
	</ul>
</div>	