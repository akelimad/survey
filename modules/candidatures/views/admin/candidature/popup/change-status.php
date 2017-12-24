<div class="row">	
	<div class="col-md-4"><strong>Nom et prénom du candidat</strong></div>
	<div class="col-md-8">: <?= $candidature->displayName; ?></div>
</div>

<form action="" method="post" id="changeSatatusForm">

	<input type="hidden" name="status[id_candidature]" value="<?= $candidature->cid ?>">

	<div class="row">	
		<div class="col-md-12">
			<div class="subscription mt-15 mb-10" style="height: 23px;">
				<h1>Modifier statut de la candidature</h1>
			</div>
		</div>	
	</div>

	<div class="row">
		<label for="status_id" class="col-md-4">Statut de la candidature&nbsp;<font style="color:red;">*</font></label>
		<div class="col-md-6">
			<select name="status[id]" id="status_id" style="width: 100%;" required>
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

	<div id="email_convocation" style="display: none;">
		<div class="row">
			<div class="col-md-12">
				<div class="subscription mt-15 mb-10" style="height: 23px;">
					<h1>Email de convocation</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<label for="status_email_type" class="col-md-4">Type Email</label>
			<div class="col-md-6">
				<select id="status_email_type" name="status[mail][type]" style="width: 100%;">
					<option value=""></option>
					<?php foreach (getDB()->read('email_type') as $key => $value) : ?>
						<option value="<?php echo $value->id_email; ?>"><?php echo $value->titre; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="ligneBleu mb-10" style="width: 100%;"></div>
		<div class="row mb-5">
			<label for="status_mail_sender" class="col-md-4">Expéditeur&nbsp;<font style="color:red;">*</font></label>
			<div class="col-md-5">
				<input type="email" name="status[mail][sender]" id="status_mail_sender" style="width: 100%;">
				<input type="hidden" name="status[mail][receiver]" value="<?= $candidature->candidat_email; ?>">
			</div>
		</div>
		<div class="row mb-5">
			<label for="status_mail_subject" class="col-md-4">Sujet&nbsp;<font style="color:red;">*</font></label>
			<div class="col-md-8">
				<input type="text" name="status[mail][subject]" id="status_mail_subject" style="width: 100%;">
			</div>
		</div>
		<div class="row mb-5">
			<div class="col-md-12">
				<label for="status_mail_message">Message&nbsp;<font style="color:red;">*</font></label>
				<span style="vertical-align: top; font-size: 11px; display: inline-block;">Utiliser la variable <code style="display: inline-block;">{{lien_confirmation}}</code> pour afficher le lien de confirmation <font style="color:red;">(obligatoire)</font>.</span>
			</div>
			<div class="col-md-12">
				<textarea name="status[mail][message]" id="status_mail_message" class="ckeditor" cols="30" rows="5"></textarea>
			</div>
		</div>
	</div>

	<?php \App\Event::trigger('change_status_form_fields', ['candidature' => $candidature]); ?>

	<div class="ligneBleu" style="width: 100%;"></div>
	<div class="form-group mt-10 mb-0">
		<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Fermer</button>
	    <button type="submit" class="btn btn-primary btn-sm pull-right">Appliquer les changements</button>
	</div>

</form>

<script>
jQuery(document).ready(function($){

	$('#status_email_type').change(function(){
		if( $(this).val() == '' ) {
			$('#status_mail_sender').val('')
			$('#status_mail_subject').val('')
			CKEDITOR.instances['status_mail_message'].setData('')
			return;
		}
		ajax_handler({
			data: {
				'action': 'cand_type_email',
				'id_email': $(this).val(),
			},
			showErrorMessage:false
		}, function(response){
			if( typeof response.email != undefined ) {
				$('#status_mail_sender').val(response.email)
				$('#status_mail_subject').val(response.objet)
				CKEDITOR.instances['status_mail_message'].setData(response.message)
			}
		});
	})

	$('form').submit(function(event){
		var message = CKEDITOR.instances['status_mail_message'].getData()
		var $ref = $(this).find('option:selected').data('ref')
		if( (message.indexOf("{{lien_confirmation}}") <= 0) && ($ref == 'N_2' || $ref == 'N_9') ) {
			event.preventDefault()
			error_message('Le message doit contenir la variable <code style="display: inline-block;">{{lien_confirmation}}</code>')
		}
	})

    $('#status_id').change(function(){
        var $ref = $(this).find('option:selected').data('ref')
        var $requiredEmailFields = $('#status_mail_sender, #status_mail_subject, #status_mail_message')
        if( $ref == 'N_2' || $ref == 'N_9' ) {
        	$requiredEmailFields.prop('required', true)
        	CKEDITOR.replace('status_mail_message');
            $('#email_convocation').show()
        } else {
        	CKEDITOR.instances['status_mail_message'].destroy()
        	$requiredEmailFields.prop('required', false)
            $('#email_convocation').hide()
        }
    })

})
</script>