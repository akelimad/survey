<div class="row">	
	<div class="col-md-4"><strong><?php trans_e("Nom et prénom du candidat"); ?></strong></div>
	<div class="col-md-8">: <?= $candidature->displayName; ?></div>
</div>

<form action="" method="post" id="changeSatatusForm">

	<input type="hidden" name="status[id_candidature]" value="<?= $candidature->cid ?>">

	<div class="row">	
		<div class="col-md-12">
			<div class="subscription mt-15 mb-10" style="height: 23px;">
				<h1><?php trans_e("Modifier statut de la candidature"); ?></h1>
			</div>
		</div>	
	</div>

	<div class="row">
		<label for="status_id" class="col-md-4"><?php trans_e("Statut de la candidature"); ?>&nbsp;<font style="color:red;">*</font></label>
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
		<label for="status_date" class="col-md-4"><?php trans_e("Date et Heure"); ?>&nbsp;<font style="color:red;">*</font></label>
		<div class="col-md-8">
			<input type="date" name="status[date]" id="status_date" value="<?= date("Y-m-d") ?>" style="width: 120px;" required>
			<input type="time" name="status[time]" id="status_time" style="width: 70px;" value="<?= date("H:m") ?>" required>
		</div>
	</div>

	<div class="row">
		<label for="status_comments" class="col-md-4"><?php trans_e("Commentaire"); ?></label>
		<div class="col-md-8">
			<textarea name="status[comments]" style="width:100%;" rows="4"></textarea>
		</div>
	</div>

	<div id="email_convocation" style="display: none;">
		<div class="row">
			<div class="col-md-12">
				<div class="subscription mt-15 mb-10" style="height: 23px;">
					<h1><?php trans_e("Email de convocation"); ?></h1>
				</div>
			</div>
		</div>
		<div class="row">
			<label for="status_email_type" class="col-md-4"><?php trans_e("Type Email"); ?></label>
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
			<label for="status_mail_sender" class="col-md-4"><?php trans_e("Expéditeur"); ?></label>
			<div class="col-md-5">
				<input type="email" name="status[mail][sender]" id="status_mail_sender" style="width: 100%;">
				<input type="hidden" name="status[mail][receiver]" value="<?= $candidature->candidat_email; ?>">
			</div>
		</div>
		<div class="row mb-5">
			<label for="status_mail_subject" class="col-md-4"><?php trans_e("Sujet"); ?></label>
			<div class="col-md-8">
				<input type="text" name="status[mail][subject]" id="status_mail_subject" style="width: 100%;">
			</div>
		</div>
		<div class="row mb-5">
			<div class="col-md-12">
				<label for="status_mail_message"><?php trans_e("Message"); ?></label>
				<span style="vertical-align: top; font-size: 11px; display: inline-block;"><?php trans_e("Utiliser la variable"); ?> <code style="display: inline-block;">{{lien_confirmation}}</code> <?php trans_e("pour afficher le lien de confirmation"); ?> <font style="color:red;"><?php trans_e("(obligatoire)"); ?></font>.</span>
			</div>
			<div class="col-md-12">
				<textarea name="status[mail][message]" id="status_mail_message" style="width: 100%;" class="ckeditor" cols="30" rows="5"></textarea>
			</div>
		</div>
	</div>

	<?php \App\Event::trigger('change_status_form_fields', ['candidature' => $candidature]); ?>

	<div class="ligneBleu" style="width: 100%;"></div>
	<div class="form-group mt-10 mb-0">
		<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><?php trans_e("Fermer"); ?></button>
	    <button type="submit" class="btn btn-primary btn-sm pull-right"><?php trans_e("Appliquer les changements"); ?></button>
	</div>

</form>

<script>
jQuery(document).ready(function($){

	$('#status_email_type').change(function(){
		if( $(this).val() == '' ) {
			$('#status_mail_sender').val('')
			$('#status_mail_subject').val('')
			$('#status_mail_message').val('')
			CKEDITOR.instances['status_mail_message'].setData('')
			return;
		}

		// Fire off the request
		$.ajax({
			type: 'POST',
			url: site_url('src/includes/ajax/index.php'),
			data: {
				'action': 'cand_type_email',
				'id_email': $(this).val()
			}
		}).done(function (response, textStatus, jqXHR) {
			try {
				var data = $.parseJSON(response);
				if( $.type(data) == 'object' ) {
					$('#status_mail_sender').val(data.email)
					$('#status_mail_subject').val(data.objet)
					try {
						CKEDITOR.instances['status_mail_message'].setData(data.message)
					} catch (e) {
						$('#status_mail_message').val(data.message)
					}
				}
			} catch (e) {
				ajax_error_message();
			}
		}).fail(function (jqXHR, textStatus, errorThrown) {
			ajax_error_message();
		});
	})

	$('form').submit(function(event){
		var message = CKEDITOR.instances['status_mail_message'].getData()
		var $ref = $(this).find('option:selected').data('ref')
		if( (message.indexOf("{{lien_confirmation}}") <= 0) && ($ref == 'N3' || $ref == 'N10') && $('#status_mail_sender').val() != '' ) {
			event.preventDefault()
			error_message('<?php trans_e("Le message doit contenir la variable"); ?> <code style="display: inline-block;">{{lien_confirmation}}</code>')
		}
	})

    $('#status_id').change(function(){
    	try {
	        var $ref = $(this).find('option:selected').data('ref')
	        var $requiredEmailFields = $('#status_mail_sender, #status_mail_subject, #status_mail_message')
	        if( $ref == 'N3' || $ref == 'N10' ) {
	        	// $requiredEmailFields.prop('required', true)
	        	CKEDITOR.replace('status_mail_message');
	            $('#email_convocation').show()
	        } else {
	        	CKEDITOR.instances['status_mail_message'].destroy()
	        	// $requiredEmailFields.prop('required', false)
	            $('#email_convocation').hide()
	        }
		} catch (e) {}
    })

})
</script>