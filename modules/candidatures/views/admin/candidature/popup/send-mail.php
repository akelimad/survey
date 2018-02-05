<div id="progress-wrap" style="display: none;">
	<strong>Envoi des emails en cours...(<span id="send-count">0</span>/<span id="total-count">0</span>)</strong>
	<div class="progress progress-striped active" style="margin-bottom: 10px;">
		<div class="progress-bar progress-bar-success" style="width:0%"></div>
	</div>
</div>

<form action="" method="post" id="candidaturesContactForm" onkeypress="return event.keyCode != 13;">
	<div class="form-group">
		<label for="cp_type_mail" class="form-label">Type Email</label>
		<select id="cp_type_mail" class="form-control">
			<option value=""></option>
			<?php foreach (getDB()->read('email_type') as $key => $value) : ?>
				<option value="<?php echo $value->id_email; ?>"><?php echo $value->titre; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="ligneBleu mb-15" style="width: 100%;"></div>
	<div class="form-group">
		<label for="cp_sender" class="form-label">Votre email&nbsp;<font style="color:red">*</font></label>
		<input type="text" name="cp_sender" id="cp_sender" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="cp_receivers" class="form-label">Email du destinataire&nbsp;<font style="color:red">*</font></label>
		<div>
			<select name="cp_receivers" id="cp_receivers" class="form-control" multiple>
				<?php foreach ($candidatures as $key => $c) : ?>
					<option value="<?= $c->cid .'|'. $c->email ?>" selected><?= $c->email ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="cp_subject" class="form-label">Sujet&nbsp;<font style="color:red">*</font></label>
		<input type="text" name="cp_subject" id="cp_subject" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="cp_message" class="form-label">Message&nbsp;<font style="color:red">*</font></label>
		<textarea name="cp_message" id="cp_message" class="form-control ckeditor" cols="30" rows="5" required></textarea>
	</div>

	<div class="form-group">
		<input type="hidden" name="cv_path" id="cp_cv_path" value="<?= (isset($cv_path) && $cv_path != '') ? $cv_path : ''; ?>">
		<?php if(isset($cv_name) && $cv_name != '') : ?>
			<strong><i class="fa fa-paperclip"></i>&nbsp;Pièce joint:</strong>
			<a href="<?= site_url($cv_path) ?>" target="_blank"><?= $cv_name; ?></a>
		<?php endif; ?>
	</div>

	<div class="form-group">
		<?php
		$_variables = ['nom_candidat', 'nom', 'prenom', 'civilite', 'titre_offre', 'ref_offre', 'date_postulation', 'statut_candidature', 'date_statut', 'lieu_statut', 'lien_confirmation'];
		$_variablesHtml .= '';
		foreach ($_variables as $key => $v) {
			$_variablesHtml .= '<code style="display: inline-block;">{{'.$v.'}}</code>';
		}
		get_alert('info', 'Vous pouvez utiliser les variables suivants dans votre email:<br>'.$_variablesHtml, false);
		?>
	</div>
	<div class="ligneBleu" style="width: 100%;"></div>
	<div class="form-group mt-10 mb-0">
		<button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Fermer</button>
		<button type="submit" class="btn btn-primary pull-right">Envoyer</button>
	</div>
</form>


<script>
	jQuery(document).ready(function($){

		CKEDITOR.replace('cp_message');

		$("#cp_receivers").tagsinput({
			confirmKeys: [13, 32, 44, 188],
			allowDuplicates: false,
			trimValue: true
		})

		var $recLength = $("#cp_receivers").tagsinput('items').length;
		$.each($("#cp_receivers option"), function(key, value){
			var $index = $(this).index()
			if( $index < $recLength ) {
				var $span = $('#cp_receivers')
				.prev('.bootstrap-tagsinput')
				.find('span.tag:eq('+ $index +')')
				.contents().first().replaceWith( $(this).text() ); // .split("|").pop()
			} else {
				$(this).remove()
			}
		})

	// $("#cp_receivers").on('itemAdded', function(event) {
	// 	console.log(event)
	// });


	$('#cp_type_mail').change(function(){
		if( $(this).val() == '' ) {
			$('#cp_sender').val('')
			$('#cp_subject').val('')
			$('#cp_message').val('')
			CKEDITOR.instances['cp_message'].setData('')
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
					$('#cp_sender').val(data.email)
					$('#cp_subject').val(data.objet)
					try {
						CKEDITOR.instances['cp_message'].setData(data.message)
					} catch (e) {
						$('#cp_message').val(data.message)
					}
				}
			} catch (e) {
				ajax_error_message();
			}
		}).fail(function (jqXHR, textStatus, errorThrown) {
			ajax_error_message();
		});
	})


	// Send email form submit
	$('#candidaturesContactForm').submit(function(event){
		event.preventDefault()

		var receivers = $('#cp_receivers').val()
		var message = CKEDITOR.instances['cp_message'].getData()
		if( $('#cp_receivers').val() == null || message == '' ) {
			error_message("Merci de remplir tous les champs.");
			return;
		}

		$('#progress-wrap').show()
		$('#candidaturesContactForm').hide()
		$('#total-count').text(receivers.length)

		sendEmailLoop({
			step: 100 / receivers.length,
			width: $('.progress-bar').getWidthInPercent(),
			count: receivers.length,
			index: 0,
			receivers: receivers,
			receiver: receivers[0],
			sender: $('#cp_sender').val(),
			subject: $('#cp_subject').val(),
			message: message,
			cv_path: $('#cp_cv_path').val()
		});
	})


	// Send email loop
	sendEmailLoop = function (data) {
		return ajaxSendEmail(data).then(function(response){
			data.receiver = data.receivers[data.index]
			data.index += 1
			data.width += data.step
			$('.progress-bar').css("width", data.width+'%')
			$('#send-count').text(data.index)
			if( data.index < data.count ) {
				return sendEmailLoop(data)
			} else {
				$('#progress-wrap').empty().html('<div class="chm-alerts alert alert-info alert-white rounded"><div class="icon"><i class="fa fa-check"></i></div><ul><li>L\'envoi d\'emails est terminé.</li></ul></div>')
			}
		});
	}


	// Send email loop
	ajaxSendEmail = function (ajax_data) {
		return $.ajax({
			url: site_url('src/includes/ajax/index.php'),
			method: 'POST',
			data: {
				'action': 'cand_send_email',
				'sender': ajax_data.sender,
				'receiver': ajax_data.receiver,
				'subject': ajax_data.subject,
				'message': ajax_data.message,
				'cv_path': ajax_data.cv_path
			}
		});
	}

});
</script>