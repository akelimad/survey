<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="Description" content="<?= get_setting('seo_description'); ?>"/>
    <meta name="keywords" content="<?= get_setting('seo_keywords'); ?>"/>
    <link rel="icon" type="image/x-icon" href="<?= site_url('public/favicon.ico'); ?>">
    <title><?= ($nom_page_site != '') ? $nom_page_site : get_setting('nom_site'); ?></title>
    <base href="<?= site_url(); ?>">

    <?php \App\Event::trigger('head'); ?>
</head>
<body<?= isLogged('admin') ? ' class="logged admin"' : ''; ?>>

    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-default" id="top-navbar">
                    <div class="container-fluid pl-5 pl-xs-15">
                        <ul class="nav navbar-nav navbar-right pr-5">
                            <li><a href="<?= get_site('site_url'); ?>" target="_blank" style="color:#ffffff;" title="Accès au site de l'institution - Nouvelle fenêtre"><?php trans_e("Accès au site de l'institution"); ?></a></li>
                            <li><a href="<?= site_url('contact') ?>" title="Contactez-nous"><?php trans_e("Contactez-nous"); ?></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-md-12">
                <?php get_view('partials/admin_menu'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 col-xs-12">
                <div id="breadcrumb"><?php trans_e("Vous êtes ici:"); ?> <strong><?php echo $ariane; ?></strong></div>
            </div>
            <div class="col-md-5 col-xs-12">
                <?php if($admin_email = read_session('abb_admin', false)) : ?>
                    <div class="pull-right">
                        <?php trans_e("Connecté en tant que:"); ?> <b><?= $admin_email; ?></b> | <a href="<?= site_url('backend/logout') ?>"><?php trans_e("Déconnexion"); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container mt-30 mb-20">
        <?= $content; ?>
    </div>

    <footer id="footer">
        <div class="container">
            <nav class="navbar navbar-default" id="footer-navbar">
                <div class="container-fluid pl-5 pl-xs-15">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= site_url('terms'); ?>"><?php trans_e("Mentions légales"); ?></a></li>
                        <li><a href="<?= site_url('conditions'); ?>"><?php trans_e("Conditions Générales d'utilisation"); ?></a></li>
                        <li><a href="<?= site_url('sitemap'); ?>"><?php trans_e("Plan du site"); ?></a></li>
                        <?php if(get_setting('allow_bugs_report') == 1) : ?>
                        <li><a href="<?= site_url('bug-report'); ?>"><?php trans_e("Signaler un problème"); ?></a></li>
                        <?php endif; ?>
                    </ul>
                    <?php if(get_setting('show_copyright') == 1) : ?>
                    <ul class="nav navbar-nav navbar-right pr-5 mt-xs-0">
                        <li><a href="http://www.etalent.ma/" target="_blank" title="<?php trans_e("E-Talent - Nouvelle fenêtre"); ?>">&copy; E-Talent</a></li>
                    </ul>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </footer>
    
    <?php \App\Event::trigger('footer'); ?>
</body>
</html>