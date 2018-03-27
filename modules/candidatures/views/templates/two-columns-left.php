<?php use Modules\Candidatures\Models\Candidatures; ?>
<div class="container">
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-3">
			<ul id="menu_site_carriere" style="padding: 1px;">
				<?php if (read_session('id_type_role') == 1) : ?>
					<li <?= ($_GET['action'] == 'status') ? 'class="menufo-active"' : ''; ?>>
						<a href="<?= site_url('backend/module/candidatures/candidature/status'); ?>"><i class="fa fa-pie-chart"></i>&nbsp;État des candidatures</a>
					</li>
					<li <?= (isset($_GET['id']) && $_GET['id']==0) ? 'class="menufo-active"' : ''; ?>>
						<a href="<?= site_url('backend/module/candidatures/candidature/list/0'); ?>"><i class="fa fa-spinner"></i>&nbsp;Nouvelles candidatures</a>
					</li>
					<li <?= (!isset($_GET['id']) && $_GET['action'] == 'index') ? 'class="menufo-active"' : ''; ?>>
						<a href="<?= site_url('backend/module/candidatures/candidature'); ?>"><i class="fa fa-list-ol"></i>&nbsp;Candidatures en cours</a>
					</li>
				<?php endif; ?>

				<?php
					foreach (Candidatures::getStatus() as $key => $status) : 
					$count = Candidatures::countByStatus($status->id_prm_statut_c);
					if(($count == 0 && !isAdmin()) || ($status->id_prm_statut_c == 53 && !isAdmin())) continue;
					?>
					<li <?= (isset($_GET['id']) && $_GET['id']==$status->id_prm_statut_c) ? 'class="menufo-active"' : ''; ?>>
						<a href="<?= site_url('backend/module/candidatures/candidature/list/'. $status->id_prm_statut_c); ?>"><i class="fa fa-tasks"></i>&nbsp;<?= $status->statut; ?><span class="badge pull-right"><?= $count; ?></span></a>
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