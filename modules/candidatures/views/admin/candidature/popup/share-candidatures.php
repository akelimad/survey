<form action="<?= site_url('backend/module/candidatures/candidature') ?>" method="post" id="shareCandidaturesForm">

	<input type="hidden" name="share[candidatures]" value="<?= htmlentities(json_encode($candidatures)) ?>">

	<div class="row">
		<label for="share_type" class="col-md-4"><?php trans_e("Type Email"); ?></label>
		<div class="col-md-6">
			<select id="share_type" name="share[type]" style="width: 100%;">
				<option value=""></option>
				<?php foreach (getDB()->read('email_type') as $key => $value) : ?>
					<option value="<?php echo $value->id_email; ?>"><?php echo $value->titre; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="ligneBleu mb-10" style="width: 100%;"></div>
	<div class="row mb-5">
		<label for="share_sender" class="col-md-4"><?php trans_e("Expéditeur"); ?>&nbsp;<font style="color:red;">*</font></label>
		<div class="col-md-5">
			<input type="email" name="share[sender]" id="share_sender" style="width: 100%;" required>
		</div>
	</div>
	<div class="row mb-5">
		<label for="share_sender" class="col-md-4"><?php trans_e("Email du destinataire"); ?>&nbsp;<font style="color:red;">*</font></label>
		<div class="col-md-5">
			<input type="email" name="share[receiver]" id="share_receiver" style="width: 100%;" required>
		</div>
	</div>
	<div class="row mb-5">
		<label for="share_subject" class="col-md-4"><?php trans_e("Sujet"); ?>&nbsp;<font style="color:red;">*</font></label>
		<div class="col-md-8">
			<input type="text" name="share[subject]" id="share_subject" style="width: 100%;" required>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<label for="share_message"><?php trans_e("Message"); ?>&nbsp;<font style="color:red;">*</font></label>
		</div>
		<div class="col-md-12 mb-10">
			<textarea name="share[message]" id="share_message" class="ckeditor" cols="30" rows="5" style="width: 100%;" required></textarea>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-md-12">
			<strong><?php trans_e("Suite du message"); ?></strong>
			<textarea class="mt-5 ckeditor" style="width: 100%;min-height:110px;padding: 20px;" disabled><?php trans_e("Vos identifiants de connexion sur notre site web:"); ?> {{site}}&#10;<?php trans_e("Votre email:"); ?> {{email}}&#10;<?php trans_e("Mot de passe:"); ?> {{mot_passe}}&#10;<?php trans_e("Ces identifiants vous permettront de consulter des candidatures ciblées."); ?></textarea>
		</div>
	</div>

	<div class="styled-title mt-0 mb-0">
	  <h3><?php trans_e("Actions autorisées"); ?></h3>
	</div>
	<div class="row mb-10">
	<?php foreach ($table_actions as $key => $label) : ?>
		<div class="col-md-6">
			<label for="<?= $key ?>"><input type="checkbox" name="share[authorized_actions][]" id="<?= $key ?>" value="<?= $key ?>" style="vertical-align: sub;">&nbsp;<?= $label ?></label>
		</div>
	<?php endforeach; ?>
	</div>

	<div class="ligneBleu" style="width: 100%;"></div>
	<div class="form-group mt-10 mb-0">
		<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><?php trans_e("Fermer"); ?></button>
	    <button type="submit" class="btn btn-primary btn-sm pull-right"><?php trans_e("Envoyer"); ?></button>
	</div>
</form>


<script>
jQuery(document).ready(function($){

	CKEDITOR.replace('share_message');
	
	$('#share_type').change(function(){
		if( $(this).val() == '' ) {
			$('#share_sender').val('')
			$('#share_subject').val('')
			$('#share_message').val('')
			CKEDITOR.instances['share_message'].setData('')
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
					$('#share_sender').val(data.email)
					$('#share_subject').val(data.objet)
					try {
						CKEDITOR.instances['share_message'].setData(data.message)
					} catch (e) {
						$('#share_message').val(data.message)
					}
				}
			} catch (e) {
				ajax_error_message();
			}
		}).fail(function (jqXHR, textStatus, errorThrown) {
			ajax_error_message();
		});
	})

})
</script>