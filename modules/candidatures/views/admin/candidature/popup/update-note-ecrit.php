<form action="" method="post">
	<input type="hidden" name="id_candidature" value="<?= $id_candidature ?>">

	<div class="row mb-15">
		<label for="note_ecrit" class="col-md-4">Note écrit&nbsp;<font style="color:red;">*</font></label>
		<div class="col-md-8">
			<input type="number" min="0" max="20" step="0.01" name="note_ecrit" id="note_ecrit" value="<?= $note_ecrit ?>" style="width: 100%;" required>
		</div>
	</div>

	<div class="ligneBleu" style="width: 100%;"></div>
	<div class="form-group mt-10 mb-0">
		<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Fermer</button>
	    <button type="submit" class="btn btn-primary btn-sm pull-right">Sauvegarder la note</button>
	</div>
</form>