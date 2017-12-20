<?php use Modules\Candidatures\Models\Candidatures; ?>
<div id="container">
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
							<li class="acces"><a href="<?php echo $GLOBALS['etalent']['config']['site_url']; ?>" target="_blank" style="color:#ffffff;" title="Accès au site de l'institution - Nouvelle fenêtre">Accès au site de l'institution</a></li>
							<li class="contactus"><a href="<?= site_url('infos/contact/') ?>" style="color:#ffffff;" title="Contactez-nous">Contactez-nous</a></li>
						</ul>
					</div>
				</div>
			</div>
			<?php get_view('partials/admin_menu'); ?>
			<div style="padding: 10px 0px">
				<div style="float: left;">Vous êtes ici :  <b><?php echo $ariane; ?></b></div>     
				<div style="float: right;">
					<?php	if(isset($_SESSION['abb_admin'])) : ?>
						<table>
							<tr>
								<td>
									<div style="float:left;">
									<?php if(isset($_SESSION['abb_admin'])) : ?>
										Connecté en tant que: <b><?= $_SESSION['abb_admin']; ?></b> | <a href="<?= site_url('index.php?action=logout') ?>">Déconnexion</a>
									<?php endif; ?>
									</div>
						 		</td>
							</tr>
						</table>
					<?php endif; ?>
				</div>     
			</div>
		</div>
	</div>
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-3">
			<ul id="menu_site_carriere" style="padding: 1px;">
				<li <?= ($_GET['action'] == 'status') ? 'class="menufo-active"' : ''; ?>>
					<a href="<?= site_url('backend/module/candidatures/candidature/status'); ?>"><i class="fa fa-pie-chart"></i>&nbsp;État des candidatures</a>
				</li>
				<li <?= (isset($_GET['id']) && $_GET['id']==0) ? 'class="menufo-active"' : ''; ?>>
					<a href="<?= site_url('backend/module/candidatures/candidature/list/0'); ?>"><i class="fa fa-spinner"></i>&nbsp;Nouvelles candidatures</a>
				</li>
				<li <?= (!isset($_GET['id']) && $_GET['action'] == 'index') ? 'class="menufo-active"' : ''; ?>>
					<a href="<?= site_url('backend/module/candidatures/candidature'); ?>"><i class="fa fa-list-ol"></i>&nbsp;Candidatures en cours</a>
				</li>
				<?php foreach (Candidatures::getStatus() as $key => $status) : ?>
					<li <?= (isset($_GET['id']) && $_GET['id']==$status->id_prm_statut_c) ? 'class="menufo-active"' : ''; ?>>
						<a href="<?= site_url('backend/module/candidatures/candidature/list/'. $status->id_prm_statut_c); ?>"><i class="fa fa-tasks"></i>&nbsp;<?= $status->statut; ?><span class="badge pull-right"><?= Candidatures::countByStatus($status->id_prm_statut_c); ?></span></a>
					</li>
				<?php endforeach; ?>
				<!--li>
					<a href="<?//= site_url('backend/module/candidatures/candidature/historique'); ?>"><i class="fa fa-history"></i>&nbsp;Historique des notes</a>
				</li-->
			</ul>
		</div>
		<div class="col-md-9">
			<?php echo $content; ?>
		</div>
	</div>
</div>