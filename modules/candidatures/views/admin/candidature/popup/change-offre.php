<form action="" method="post">
	<input type="hidden" name="change_offre[id_candidature]" value="<?= $id_candidature ?>">

	<div class="row mb-15">
		<label for="change_offre" class="col-md-3"><?php trans_e("Choisissez un offre"); ?>&nbsp;<font style="color:red;">*</font></label>
		<div class="col-md-9">
			<select name="change_offre[id]" id="change_offre" style="width: 100%;" required>
				<?php foreach ($offres as $key => $offre) : ?>
					<option value="<?= $offre->id_offre; ?>" <?= ($id_offre == $offre->id_offre) ? 'selected' : ''; ?>><?= $offre->Name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="ligneBleu" style="width: 100%;"></div>
	<div class="form-group mt-10 mb-0">
		<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><?php trans_e("Fermer"); ?></button>
	    <button type="submit" class="btn btn-primary btn-sm pull-right"><?php trans_e("Mettre à jour"); ?></button>
	</div>
</form>