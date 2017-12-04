            <link rel="icon" type="image/gif" href="<?php echo $imgurl ?>/animated_favicon1.gif" />     



            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



            <title><?php if(empty($nom_page_site)){ echo $nom_site;} else {echo $nom_page_site;} ?></title>

            <meta name="Description" content="<?php    echo $seo_description;        ?>,Mon compte"/>

            <meta name="keywords" content="<?php    echo $seo_keywords;        ?>,Mon compte"/>

  

<link href="<?php echo $cssurl ?>/style_admin.php" rel="stylesheet" type="text/css" media="all" /> 

<link href="<?php echo $cssurl ?>/styles/menuprincipal.php" type="text/css" rel="stylesheet" media="all">

<!--    --> 

<link href="<?php echo $cssurl ?>/font-awesome-4.3.0/css/font-awesome.min.css  " rel="stylesheet" media="all" type="text/css"/>  



<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script> 

<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery.validate.min.js"></script> 

<script type="text/javascript" src="<?php echo $jsurl; ?>/scripts_valide.js"></script>
<?php \App\Event::trigger('head'); ?>
<!--	-->