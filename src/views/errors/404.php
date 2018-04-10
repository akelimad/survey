<!DOCTYPE html>
<html lang="fr">
<head>        
	<title><?= SITE_NAME;?> | <?php trans_e("Page introuvable"); ?></title>    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="<?php echo site_url('assets/vendors/bootstrap/css/bootstrap.min.css'); ?>">
	<style>
	body{
	background: #334454;
	  font-family: arial;
	}
	.page-container {
	  width: 100%;
	  float: left;
	  min-height: 100%;
	}
	.page-container .page-content.page-content-default {
		padding: 0px;
		float: left;
		width: 100%;
	}
	.block-error {
		width: 400px;
		margin: 50px auto 0px;
	}
	.block-error .error-num {
		font-size: 190px;
		font-weight: 100;
		text-align: center;
		float: left;
		width: 100%;
		color: #FFF;
		line-height: 180px;
	}
	.block-error .error-text {
		font-size: 31px;
		color: #F5F5F5;
		float: left;
		width: 100%;
		font-weight: 200;
		text-align: center;
		margin-top: 10px;
		text-transform: uppercase;
	}
	.block-error .error-description {
		font-size: 13px;
		color: #F0F0F0;
		float: left;
		width: 100%;
		font-weight: 300;
		margin: 30px 0px;
		text-align: center;
	}
	.block-error .copy {
		float: left;
		width: 100%;
		text-align: center;
		color: #FFF;
		color: #dddddd;
		font-size: 12px;
	}
	a{
		text-decoration: none !important;
	}

	.button {
    cursor: pointer;
    padding: 12px 18px;
    display: inline-block;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 14px;
    outline: none;
    overflow: hidden;
    position: relative;
    z-index: 10;
    color: #fff;
    background-color: #505050;
    border: none;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
	}

	.button:hover, .button:focus {
    background-color: #282828;
    color: #fff;
	}

	.button.orange {
    background-color: #EF8A04;
	}

	.button.orange:hover {
    background-color: #e32b2b;
	}
	</style>
</head>
<body>
	
	<div class="page-container">
		
		<div class="page-content page-content-default">

			<div class="block-error">
				
				<div class="error-num">404</div>
				<div class="error-text"><?php trans_e("PAGE NON TROUVÉE"); ?></div>
				
				<div class="error-description"><?php trans_e("Malheureusement, nous avons du mal à charger la page que vous recherchez. Veuillez attendre un instant et réessayer ou utiliser les actions ci-dessous."); ?></div>
				<div class="row" style="margin-bottom: 20px;">
					<div class="col-md-6">
						<a href="#" class="button btn-block text-center" onclick="window.history.go(-1); return false;"><?php trans_e("Page précédente"); ?></a>
					</div>
					<div class="col-md-6" style="padding-left: 0px;">
						<a href="<?php echo site_url('contact'); ?>" class="button orange btn-block text-center"><?php trans_e("Contactez-nous"); ?></a>
					</div>
				</div>
				<div class="copy">
					&copy; <?php echo date('Y') ?> <?= SITE_NAME;?> | <?php trans_e("Tous les droits sont réservés"); ?>
				</div>
			</div>
			
		</div>
	</div>        
	
</body>
</html>
