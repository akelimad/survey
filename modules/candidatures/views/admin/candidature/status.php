<?php use Modules\Candidatures\Models\Candidatures; ?>
<h1 class="page-title">ETAT DES CANDIDATURES</h1>
<div class="list-group">
	<?php foreach (Candidatures::getStatus() as $key => $status) : ?>
		<a href="<?= site_url('backend/module/candidatures/candidature/list/'. $status->id_prm_statut_c); ?>" class="list-group-item <?= ($key%2==0) ? 'list-group-item-info' : ''; ?>" style="padding: 7px 15px;"><?= $status->statut; ?><span class="badge pull-right"><?= Candidatures::countByStatus($status->id_prm_statut_c); ?></span></a>
	<?php endforeach; ?>
</div>