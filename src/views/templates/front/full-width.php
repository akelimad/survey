<?php //dump($GLOBALS['etalent']) ?>
<div class="container">
	<div class="row" style="margin-bottom: 20px;">
		<div class="col-md-12">
			<!-- START ENTETE -->
			<div class="quicknavigation">
				<div class="center">
					<div class="nav">
						<ul></ul>
					</div>
					<!-- SOCIAL BTNS-->
					<div id="ctl00_ctl00_ph_socialHead" class="socialHub"></div>
					<!-- RSS / Contact-->
					<div class="rsscontact">
						<ul>
							<li class="acces"><a href="<?= $GLOBALS['etalent']['config']['site_url']; ?>" target="_blank" style="color:#ffffff;" title="<?php trans_e("Accès au site de l'institution - Nouvelle fenêtre"); ?>"><?php trans_e("Accès au site de l'institution"); ?></a></li>
							<li class="contactus"><a href="<?= site_url('infos/contact/') ?>" style="color:#ffffff;" title="<?php trans_e("Contactez-nous"); ?>"><?php trans_e("Contactez-nous"); ?></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div id='entete' style="width: 1035px;height: 188px; background-image: url(<?= site_url('assets/images/bannier/etalent.jpg'); ?>);"  onClick="javascript:window.open('<?php echo $site; ?>','_self')" class="cu" >
                <a href='<?php echo $urlhome; ?>'><div id='logo'></div></a>
				<div id="bandepremiere"></div>
            </div>

            <div id='rsearch' style=" margin: 40px 0 0 20px;">        
		        <form action='<?php echo $urlinfos; ?>/rechercher/' method="post" name="formulaire_a"  onsubmit="return go_search()"><br/>            
		            <input class='rsh' type='text' name='keywords' placeholder="<?php trans_e("RECHERCHER"); ?>">&nbsp;&nbsp;            
		            <input type='hidden' value="" name='button' class='env' /> 
		            <a  onclick="formulaire_a.submit()">
		            <i class="fa fa-search fa-lg" style="color:<?php echo $color_bg; ?>"></i></a>
		        </form>    
		    </div> 


			<div id="menulangue-panier">
				<h3 class="titreh1"><?= get_setting('front_welcome_message', trans("Bienvenue sur Etalent")); ?></h3>
			</div>

			<div style="padding: 10px 0px">
				<div style="float: left;"><?php trans_e("Vous êtes ici:"); ?> <b><?php echo $ariane; ?></b></div>       
			</div>
		</div>
	</div>
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-12">
			<?php echo $content; ?>
		</div>
	</div>
</div>