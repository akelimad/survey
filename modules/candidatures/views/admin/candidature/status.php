<?php use Modules\Candidatures\Models\Candidatures; ?>
<h1 class="page-title">ETAT DES CANDIDATURES</h1>
<ul class="list-group">
	<?php foreach (Candidatures::getStatus() as $key => $status) : ?>
		<li class="list-group-item <?= ($key%2==0) ? 'list-group-item-info' : ''; ?>" style="padding: 6px 15px;">
			<a href="<?= site_url('backend/module/candidatures/candidature/list/'. $status->id_prm_statut_c); ?>"><?= $status->statut; ?><span class="badge pull-right"><?= Candidatures::countByStatus($status->id_prm_statut_c); ?></span></a>
		</li>
	<?php endforeach; ?>
</ul>