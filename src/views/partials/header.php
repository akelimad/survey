<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php get_view('partials/admin_head', [
		'nom_page_site' => $nom_page_site,
		'nom_site' => $nom_site
	]);
	?>
	<?php \App\Event::trigger('head'); ?>
</head>
<body>