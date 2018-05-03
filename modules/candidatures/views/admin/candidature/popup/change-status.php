<div class="row">	
	<div class="col-md-12">
		<div class="subscription mt-0 mb-10" style="height: 23px;">
			<h1><?php trans_e("Pour le(s) candidat(s)"); ?></h1>
		</div>
		<div>
			<select name="status[receivers][]" id="receivers" class="form-control" multiple required>
				<?php foreach ($candidats as $key => $candidat) : ?>
					<option value="<?= $candidat->candidature_id .'|'. $candidat->email ?>" selected><?= App\Models\Candidat::getDisplayName($candidat, false) ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>	
</div>

<div class="row">	
	<div class="col-md-12">
		<div class="subscription mt-0 mb-10" style="height: 23px;">
			<h1><?php trans_e("Modifier la statut"); ?></h1>
		</div>
	</div>	
</div>

<div class="row">
	<label for="status_id" class="col-md-4"><?php trans_e("Statut"); ?>&nbsp;<font style="color:red;">*</font></label>
	<div class="col-md-6">
		<select name="status[id]" id="status_id" style="width: 100%;" required>
			<option value=""></option>
			<?php foreach (\Modules\Candidatures\Models\Candidatures::getStatus() as $key => $value) : ?>
				<option value="<?= $value->id_prm_statut_c; ?>" data-ref="<?= $value->ref_statut; ?>" <?= ($statut_id == $value->id_prm_statut_c) ? 'disabled' : ''; ?>><?= $value->statut; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>

<div class="row mt-5 mb-10">
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

<?php if (count($cIds) == 1) \App\Event::trigger('change_status_form_fields', ['candidature' => $candidature]); ?>

<script>
jQuery(document).ready(function($){

	$("#receivers").tagsinput({
		confirmKeys: [13, 32, 44, 188],
		allowDuplicates: false,
		trimValue: true
	})

	$("#receivers").on('beforeItemAdd', function(event) {
	  event.cancel = true;
	});

	$("#receivers").on('beforeItemRemove', function(event) {
	  event.cancel = true;
	});

	$('[data-role="remove"]').remove()

	var $recLength = $("#receivers").tagsinput('items').length;
	$.each($("#receivers option"), function(key, value){
		var $index = $(this).index()
		if( $index < $recLength ) {
			var $span = $('#receivers')
			.next('.bootstrap-tagsinput')
			.find('span.tag:eq('+ $index +')')
			.contents().first().replaceWith( $(this).text() );
		} else {
			$(this).remove()
		}
	})

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
        $('#status_email_type').val('').trigger('change')
      }
		} catch (e) {}
  })


  $('body').on('chmFormSuccess', '#changeSatatusForm', function (event, response) {
  	if (response.status === 'reload') {
  		window.location.reload()
  	}
  })

})
</script>