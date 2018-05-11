<?php 
use App\Form; 
use Modules\Candidatures\Models\Status;
use Modules\Candidatures\Models\Candidature;
?>

<div class="row">	
	<div class="col-md-12">
		<div class="subscription mt-0 mb-10" style="height: 23px;">
			<h1><?php trans_e("Pour le(s) candidat(s)"); ?></h1>
		</div>
		<div>
			<select name="status[receivers][]" id="receivers" class="form-control mb-0" multiple required>
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
		<select name="status[id]" class="form-control mb-0" id="status_id" required>
			<option value=""></option>
			<?php foreach (Candidature::getStatus() as $key => $value) : ?>
				<option value="<?= $value->id_prm_statut_c; ?>" data-ref="<?= $value->ref_statut; ?>" <?= ($statut_id == $value->id_prm_statut_c) ? 'disabled' : ''; ?>><?= $value->statut; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>

<?php if (Form::getFieldOption('displayed', 'candidatures', 'motif_rejet')) : ?>
<div class="row mt-5" id="motif_rejet-container" style="display: none;">
	<label for="motif_rejet" class="col-md-4"><?php trans_e("Motif de rejet"); ?></label>
	<div class="col-md-6">
		<select name="status[motif_rejet]" class="form-control mb-0" id="motif_rejet">
			<option value=""></option>
			<option value="Age NC"><?php trans_e("Age NC"); ?></option>
			<option value="Exp NC"><?php trans_e("Exp NC"); ?></option>
			<option value="Exp <"><?php trans_e("Exp <"); ?></option>
			<option value="Diplôme NC"><?php trans_e("Diplôme NC"); ?></option>
			<option value="Permis NC"><?php trans_e("Permis NC"); ?></option>
			<option value="Exp NJ"><?php trans_e("Exp NJ"); ?></option>
			<option value="Dossier Incomplet"><?php trans_e("Dossier Incomplet"); ?></option>
			<option value="_other" chm-form-other="status_motif_rejet_other"><?php trans_e("Autre (à péciser)"); ?></option>
		</select>
		<?= Form::input('text', 'status[motif_rejet_other]', null, null, [], [
      'class' => 'form-control mt-5 mb-0',
      'style' => 'display:none;',
      'title' => trans("Autre (à péciser)")
    ]); ?>
	</div>
</div>
<?php endif; ?>

<div class="row mt-5 mb-5">
	<label for="status_date" class="col-md-4"><?php trans_e("Date et Heure"); ?>&nbsp;<font style="color:red;">*</font></label>
	<div class="col-md-8">
		<input type="date" name="status[date]" class="form-control mb-0 mr-5" id="status_date" value="<?= date("Y-m-d") ?>" style="width: 120px;float: left;" required>
		<input type="time" name="status[time]" class="form-control mb-0" id="status_time" style="width: 75px;" value="<?= date("H:m") ?>" required>
	</div>
</div>

<div class="row mt-5 mb-5" id="status_lieu-row" style="display:none;">
	<label for="status_lieu" class="col-md-4"><?php trans_e("Lieu"); ?></label>
	<div class="col-md-8">
		<?= Form::input('text', 'status[lieu]', null, null, [], [
      'class' => 'form-control mt-5 mb-0'
    ]); ?>
	</div>
</div>

<div class="row">
	<label for="status_comments" class="col-md-4"><?php trans_e("Commentaire"); ?></label>
	<div class="col-md-8">
		<textarea name="status[comments]" class="form-control mb-0 ckeditor" style="height: 80px;" rows="4"></textarea>
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
			<select id="status_email_type" name="status[mail][type]" class="form-control mb-5">
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
			<input type="email" name="status[mail][sender]" id="status_mail_sender" class="form-control mb-0">
		</div>
	</div>
	<div class="row mb-5">
		<label for="status_mail_subject" class="col-md-4"><?php trans_e("Sujet"); ?></label>
		<div class="col-md-8">
			<input type="text" name="status[mail][subject]" id="status_mail_subject" class="form-control mb-0">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<label for="status_mail_message"><?php trans_e("Message"); ?></label>
		</div>
		<div class="col-md-12">
			<textarea name="status[mail][message]" id="status_mail_message" class="form-control mb-0 ckeditor" class="ckeditor" cols="30" rows="5"></textarea>
			<p class="mb-0 mt-5" style="vertical-align: top; font-size: 11px; display: inline-block;"><?php trans_e("Utiliser la variable"); ?> <code style="display: inline-block;">{{lien_confirmation}}</code> <?php trans_e("pour afficher le lien de confirmation"); ?> <font style="color:red;"><?php trans_e("(obligatoire)"); ?></font>.</p>
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
					$('#status_mail_message').val(data.message)
          try {
            CKEDITOR.instances['status_mail_message'].setData(data.message)
          } catch (e) {}
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

      $('#status_lieu').val('')
      $('#motif_rejet-container select').val('')
      $('#status_motif_rejet_other').val('')
      $('#status_motif_rejet_other').prop('required', false)

      if( $ref == '<?= Status::STATUS_NON_PRESELECTIONNES_REF; ?>') {
      	$('#motif_rejet-container').show()
      } else {
      	$('#motif_rejet-container').hide()
      }

      if( $ref == '<?= Status::STATUS_CONVOQUES_ECRIT_REF; ?>' || $ref == '<?= Status::STATUS_CONVOQUES_ORAL_REF; ?>' ) {
      	// $requiredEmailFields.prop('required', true)
        $('#email_convocation').show()

        $('#status_lieu-row').show()
        $('#status_lieu').prop('required', true)

      	CKEDITOR.replace('status_mail_message');
      } else {
      	// $requiredEmailFields.prop('required', false)
        $('#email_convocation').hide()

        $('#status_lieu-row').hide()
        $('#status_lieu').prop('required', false)

        $('#status_email_type').val('').trigger('change')
      	CKEDITOR.instances['status_mail_message'].destroy()
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