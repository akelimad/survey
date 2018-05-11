<li class="<?= $cls4; ?>">
	<a href="<?= site_url('backend/module/candidatures/candidature/status'); ?>"><?php trans_e("Candidatures"); ?></a>	
	<ul class="secondLevel">
		<li>
			<a href="<?= site_url('backend/module/candidatures/candidature/status'); ?>"><?php trans_e("État des candidatures"); ?></a>
		</li>
		<li>
			<a href="<?= site_url('backend/module/candidatures/candidature/list/0'); ?>"><?php trans_e("Nouvelles candidatures"); ?></a>
		</li>
		<li>
			<a href="<?= site_url('backend/module/candidatures/candidature'); ?>"><?php trans_e("Candidatures en cours"); ?></a>
		</li>
		<?php foreach (\Modules\Candidatures\Models\Candidature::getStatus() as $key => $status) : ?>
			<li>
				<a href="<?= site_url('backend/module/candidatures/candidature/list/'. $status->id_prm_statut_c); ?>"><?= $status->statut; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</li>