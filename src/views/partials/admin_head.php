<link rel="icon" type="image/x-icon" href="<?= site_url('public/favicon.ico'); ?>">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="Description" content="<?= get_setting('seo_description'); ?>"/>
<meta name="keywords" content="<?= get_setting('seo_keywords'); ?>"/>
<title><?= (isset($nom_page_site) &&$nom_page_site != '') ? $nom_page_site : get_setting('nom_site'); ?></title>