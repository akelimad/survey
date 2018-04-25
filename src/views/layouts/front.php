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
    <title><?= (isset($nom_page_site) &&$nom_page_site != '') ? $nom_page_site : get_setting('nom_site'); ?></title>
    <base href="<?= site_url(); ?>">

    <?php \App\Event::trigger('head'); ?>
</head>
<body<?= isLogged('candidat') ? ' class="logged candidat"' : ''; ?>>

    <div class="container">
        <nav class="navbar navbar-default" id="top-navbar">
            <div class="container-fluid pl-5 pl-xs-15">
                <ul class="nav navbar-nav navbar-right pr-5">
                    <li><a href="<?= get_site('site_url'); ?>" target="_blank" style="color:#ffffff;" title="<?php trans_e("Accès au site de l'institution - Nouvelle fenêtre") ?>"><?php trans_e("Accès au site de l'institution"); ?></a></li>
                    <li><a href="<?= site_url('contact') ?>" title="Contactez-nous"><?php trans_e("Contactez-nous"); ?></a></li>
                </ul>
            </div>
        </nav>
        
        <?php if (get_setting('custom_logo_banner', '') != '') : ?>
            <?= get_setting('custom_logo_banner') ?>
        <?php else : ?>
            <a href="<?= site_url(); ?>" id="logo-banner">
                <img src="<?= site_url('assets/images/bannier/'. $GLOBALS['etalent']->config['banniere']); ?>" class="img-responsive">
            </a>
        <?php endif; ?>

        <div id="welcome">
            <h3 class="pull-left"><?= get_setting('front_welcome_message', trans("Bienvenue sur Etalent")); ?></h3>
            <?php if (isModuleEnabled('language')) : ?>
            <div id="languageBlock" class="pull-right" style="margin-top: 5px;">
                <i class="fa fa-globe"></i>
                <?= \App\Form::select(
                    null, null, 
                    \Modules\Language\Models\Language::getCurrentLanguage('iso_code', 'fr'),
                    \Modules\Language\Models\Language::getActiveLanguages(), [
                        'onchange' => 'Language.change(this.value)',
                        'style' => 'outline:0;',
                        'class' => ''
                    ]
                ); ?>
            </div>
            <?php endif; ?>
        </div>

        <div id="breadcrumb"><?php trans_e("Vous êtes ici:"); ?> <strong><?php echo $ariane; ?></strong></div>
    </div>

    <div class="container mt-20 mb-20">
        <div class="row">
            <div class="col-sm-4 custom col-xs-12 pr-0 pr-xs-15">
                <?php if (isLogged('candidat')) : ?>
                    <?php get_view('front/menu/candidat-account') ?>
                <?php else : ?>
                    <?php get_view('front/candidat/login-form') ?>
                <?php endif; ?>
                <?php get_view('front/menu/left-sidebar') ?>

                <?php
                // Show left sidebar ad banner
                $left_sidebar_ad = get_setting('front_show_sidebar_ad_block');
                if (!empty($left_sidebar_ad)) : ?>
                    <img src="<?= $left_sidebar_ad ?>" class="img-responsive">
                <?php endif; ?>
            </div>
            <div class="col-sm-8 custom col-xs-12 column-body">
                <?= $content; ?>
            </div> 
        </div>
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
                        <li><a href="http://www.etalent.ma/" target="_blank" title="E-Talent- Nouvelle fenêtre">&copy; E-Talent</a></li>
                    </ul>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </footer>

    <?php if (get_setting('show_cookie_notification') == 1 && read_cookie('ac') != 1) : ?>
    <div class="alert alert-info fade in chm-float-alert" style="padding: 8px 0 6px !important;background-color: <?= get_setting('color_bg_menu') ?>;border-color: <?= get_setting('color_bg_menu') ?>;">
        <strong style="font-size: 14px;font-weight: normal;color: #fff;"><?php trans_e("Nous utilisons des cookies pour vous garantir la meilleure expérience sur notre site. Si vous continuez à utiliser ce dernier, nous considérerons que vous acceptez l'utilisation des cookies."); ?></strong>
        <button class="btn btn-default btn-xs" data-dismiss="alert" aria-hidden="true" style="margin-top: -5px;margin-left: 10px;" onclick="return chmCookie.create('ac', 1)"><?php trans_e("OK"); ?></button>
    </div>
    <?php endif; ?>
    
    <?php \App\Event::trigger('footer'); ?>
</body>
</html>