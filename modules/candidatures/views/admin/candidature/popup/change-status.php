<div class="row">	
	<div class="col-md-4"><strong>Nom et prénom du candidat</strong></div>
	<div class="col-md-8">: <?= $candidature->displayName; ?></div>
</div>

<div class="row">	
	<div class="col-md-12">
		<div class="subscription mt-15 mb-10" style="height: 23px;">
			<h1>Modifier statut de la candidature</h1>
		</div>
	</div>	
</div>

<form action="" method="post" id="changeSatatusForm">

	<input type="hidden" name="status[id_candidature]" value="<?= $candidature->cid ?>">

	<div class="row">
		<label for="status_id" class="col-md-4">Statut de la candidature&nbsp;<font style="color:red;">*</font></label>
		<div class="col-md-6">
			<select name="status[id]" id="status_id" style="width: 100%;">
				<option value=""></option>
				<?php foreach (\Modules\Candidatures\Models\Candidatures::getStatus() as $key => $value) : ?>
					<option value="<?= $value->id_prm_statut_c; ?>" data-ref="<?= $value->ref_statut; ?>" <?= ($id_statut==$value->id_prm_statut_c) ? 'disabled' : ''; ?>><?= $value->statut; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="row mb-5">
		<label for="status_date" class="col-md-4">Date et Heure&nbsp;<font style="color:red;">*</font></label>
		<div class="col-md-8">
			<input type="date" name="status[date]" id="status_date" value="<?= date("Y-m-d") ?>" style="width: 120px;" required>
			<input type="time" name="status[time]" id="status_time" style="width: 70px;" value="<?= date("H:m") ?>" required>
		</div>
	</div>

	<div class="row">
		<label for="status_comments" class="col-md-4">Commentaire</label>
		<div class="col-md-8">
			<textarea name="status[comments]" style="width:100%;" rows="4"></textarea>
		</div>
	</div>

	<?php \App\Event::trigger('change_status_form_fields', ['candidature' => $candidature]); ?>

	<div class="ligneBleu" style="width: 100%;"></div>
	<div class="form-group mt-10 mb-0">
		<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Fermer</button>
	    <button type="submit" class="btn btn-primary btn-sm pull-right">Appliquer les changements</button>
	</div>

</form>