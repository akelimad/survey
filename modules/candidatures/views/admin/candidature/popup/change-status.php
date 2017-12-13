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

	<div class="row">
		<label for="usp_status" class="col-md-4">Statut de la candidature&nbsp;<font style="color:red;">*</font></label>
		<div class="col-md-6">
			<select name="usp_status" id="usp_status" style="width: 100%;">
				<option value=""></option>
				<?php foreach (\Modules\Candidatures\Models\Candidatures::getStatus() as $key => $value) : ?>
					<option value="<?= $value->id_prm_statut_c; ?>" data-ref="<?= $value->ref_statut; ?>" <?= ($id_statut==$value->id_prm_statut_c) ? 'disabled' : ''; ?>><?= $value->statut; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>


	<?php \App\Event::trigger('change_status_form_fields', ['candidature' => $candidature]); ?>


	<div class="ligneBleu" style="width: 100%;"></div>
	<div class="form-group mt-10 mb-0">
		<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Fermer</button>
	    <button type="submit" class="btn btn-primary btn-sm pull-right">Appliquer les changements</button>
	</div>

</form>