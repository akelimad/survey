<style>
#dep-takers li{
	list-style-type: none !important;
}
</style>

<div class="row">
	<div class="col-md-6">
		<a href="<?= site_url('backend/module/workflows/workflow/builder') ?>" class="btn btn-primary btn-sm mb-20"><i class="fa fa-code-fork"></i>&nbsp;Gérer les workflows</a>
		<a href="<?= site_url('backend/module/workflows/workflow') ?>" class="btn btn-default btn-sm mb-20"><i class="fa fa-history"></i>&nbsp;Historique des workflows</a>
	</div>
</div>

<form action="" method="post">
	<?php get_flash_message() ?>
	<div class="panel panel-default mt-20" id="dep-takers">
		<div class="panel-body">
			<h5 style="margin: 0px;"><strong>Preneurs par département</strong></h5><hr>
			<ul class="list-group" style="margin-bottom: 0px;">
				<?php foreach ($wf_deps as $id_dep => $dep): ?>
				<li class="list-group-item list-group-item-info mt-10 mb-10"><?= $dep['name'] ?></li>
				<li>
					<ul id="takers" class="pl-15">
						<?php foreach ($dep['takers'] as $key => $taker) :
						$chacked = (isset($takers[$id_dep]) && in_array($taker->id_role, $takers[$id_dep])) ? 'checked' : '';
						?>
							<li>
								<label for="taker<?= $taker->id_role ?>"><input type="checkbox" name="dep_takers[<?= $id_dep ?>][]" value="<?= $taker->id_role ?>" id="taker<?= $taker->id_role ?>" <?= $chacked ?>>&nbsp;<?= $taker->nom ?></label>
							</li>
						<?php endforeach ?>
					</ul>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="ligneBleu mt-10"></div>
			<?php $label = (empty($takers)) ? 'Déclencher le workflow' : 'Mettre à jour'; ?>
			<button type="submit" class="btn btn-primary btn-sm mt-5"><i class="fa fa-save"></i>&nbsp;<?= $label; ?></button>
		</div>
	</div>
</form>