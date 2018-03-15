<?php 
$color_bg =  get_setting('color_bg', '#6d6e72');
$color_bg_menu =  get_setting('color_bg_menu', '#e1a04e');
?>
<style>
    .btn-primary {
        background-color: <?= $color_bg ?>;
        border-color: <?= $color_bg ?>;
    }

    #admin-navbar li:hover > a, #admin-navbar li.active > a {
        color: #fff;
        background-color: <?= $color_bg_menu ?>;
    }

    #footer-navbar, #top-navbar,
    .styled-title, .subscription,
    .chmTable thead th, .chmTable tfoot th {
        background-color: <?= $color_bg ?>;
    }

    .nav-pills li.active > a, 
    .nav-pills li.active > a:hover, 
    .nav-pills li.active > a:focus, 
    .nav-pills li > a:hover, 
    .nav-pills li > a:active, 
    .nav-pills li > a:focus {
        background-color: <?= $color_bg_menu ?>;
    }

    .account-nav li.active > a,
    #candidat-login-form .panel-title, 
    #candidat-account-menu .panel-title, 
    #candidat-login-form .p.panel-body h3,
    #candidat-account-menu .p.panel-body h3 {
        color: <?= $color_bg_menu ?>;
    }


    #candidat-account-menu .panel-body h3, 
    #candidat-login-form .panel-body h3,
    #candidat-account-menu .panel-heading .panel-title, 
    #candidat-login-form .panel-heading .panel-title,
    #welcome h3,
    .column-body h1,
    #candidat-account-menu .panel-body .register i, 
    #candidat-login-form .panel-body .register i,
    #candidat-login-form .register i,
    #candidat-account-menu .register i {
        color: <?= $color_bg ?>;
    }

    #offer-container ul {
        padding-left: 25px;
    }
    
    #offer-container ul li {
        list-style: inherit !important;
    }
</style>