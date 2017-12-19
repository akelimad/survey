<li class="<?= $cls4; ?>">
	<a href="<?= site_url('backend/module/candidatures/candidature/status'); ?>">Candidatures</a>	
	<ul class="secondLevel">
		<li>
			<a href="<?= site_url('backend/module/candidatures/candidature/status'); ?>">État des candidatures</a>
		</li>
		<li>
			<a href="<?= site_url('backend/module/candidatures/candidature/list/0'); ?>">Nouvelles candidatures</a>
		</li>
		<li>
			<a href="<?= site_url('backend/module/candidatures/candidature'); ?>">Candidatures en cours</a>
		</li>
		<?php foreach (\Modules\Candidatures\Models\Candidatures::getStatus() as $key => $status) : ?>
			<li>
				<a href="<?= site_url('backend/module/candidatures/candidature/list/'. $status->id_prm_statut_c); ?>"><?= $status->statut; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</li>