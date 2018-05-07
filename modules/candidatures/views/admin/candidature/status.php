<?php use Modules\Candidatures\Models\Candidature; ?>

<h1 class="page-title"><?php trans_e("ETAT DES CANDIDATURES"); ?></h1>
<div class="list-group">
	<?php foreach (Candidature::getStatus() as $key => $status) : 
		$count = Candidature::countByStatus($status->id_prm_statut_c);
		if(($count == 0 && !isAdmin()) || ($status->id_prm_statut_c == 53 && !isAdmin())) continue;
	?>
		<a href="<?= site_url('backend/module/candidatures/candidature/list/'. $status->id_prm_statut_c); ?>" class="list-group-item <?= ($key%2==0) ? 'list-group-item-info' : ''; ?>" style="padding: 7px 15px;"><?= $status->statut; ?><span class="badge pull-right"><?= $count; ?></span></a>
	<?php endforeach; ?>
</div>