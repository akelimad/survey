<div class="row">	
	<div class="col-md-12">
		<div class="subscription mb-0" style="height: 23px;">
			<h1>Liste des pièces jointes</h1>
		</div>
		<?= $table->render(); ?>
	</div>	
</div>

<div class="row">	
	<div class="col-md-12">
		<div class="subscription mt-15" style="height: 23px;">
			<h1>Ajouter des pièces jointes</h1>
		</div>
		<form action="" method="post" enctype="multipart/form-data" id="candidatureAttachmentsForm">
			<input type="hidden" name="id_candidature" id="attach_id_candidature" value="<?= $id_candidature ?>">
			<input type="hidden" name="currentPage" id="currentPage" value="<?= $currentPage ?>">
			<table class="table" id="attachmentTable">
				<tbody>
					<tr>
						<td width="170" style="padding: 4px 2px;"><input type="file" name="attachments[]" accept="image/*|.doc,.docx,.xls,.xlsx,.pdf" style="width:100%"></td>
						<td width="170" style="padding: 4px 2px;"><input type="text" name="titles[]" style="width:100%"></td>
						<td width="5" style="padding: 4px 2px;"><button type="button" class="btn btn-success btn-block btn-xs addLine"><i class="fa fa-plus"></i></button></td>
					</tr>
				</tbody>
			</table>

			
			<div class="ligneBleu mt-5" style="width: 100%;"></div>
			<div class="form-group mt-5 mb-0">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Fermer</button>
			    <button type="submit" class="btn btn-primary btn-sm pull-right">Attacher les fichiers</button>
			</div>
		</form>
	</div>	
</div>

<script>
jQuery(document).ready(function($){

	$('[data-toggle="tooltip"]').tooltip(); 

	$('#candidatureAttachmentsForm').submit(function(event){
		event.preventDefault()

		var form = $(this)[0];
		var data = new FormData(form);
		data.append('action', 'cand_save_attachments');
	    
	    var $button = $(this).find('button[type="submit"]')
	    $button.prop("disabled", true)

	    $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: get_ajax_url(),
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (response) {
            	$button.prop("disabled", false)
            	try {
			        var data = jQuery.parseJSON(response)
			        if( typeof data.status != undefined ) {
						if( data.status == 'success' ) {
							success_message(data.message, {position:'topCenter'});
							showAttachmentsPopup(event, [$('#attach_id_candidature').val()], $('#currentPage').val())
						} else {
							error_message(data.message);
						}
					} else {
						ajax_error_message()
					}
			    }catch (e) {
			        ajax_error_message()
			    }
            }
        });
	})


	editCandidatureAttachment = function(event, data) {
		event.preventDefault()
		var $parentRow = $(event.target).closest('tr')
		$parentRow.find('.save_title').show()
		$parentRow.find('a:not(.save_title)').hide()
		$parentRow.find('strong.title').hide()
		$parentRow.find('.title_input').attr('type', 'text')
	}


	saveAttachementTitle = function(event, data) {
		event.preventDefault()
		var $parentRow = $(event.target).closest('tr')
		$parentRow.find('.save_title').hide()
		$parentRow.find('a:not(.save_title)').show()
		var $input = $parentRow.find('.title_input')

		// Fire off the request
		$.ajax({
			type: 'POST',
			url: site_url('src/includes/ajax/index.php'),
			data: {
				'action': 'cand_save_attachement_title',
				'title': $input.val(),
				'id_attachement': data[0]
			}
		}).done(function (response, textStatus, jqXHR) {
			try {
				var data = $.parseJSON(response);
				if( $.type(data) == 'object' ) {
					if( typeof data.status != undefined ) {
						if( data.status == 'success' ) {
							$parentRow.find('strong.title').text($input.val()).show()
							$input.attr('type', 'hidden')
							$parentRow.find('td.updated_at').text(data.updated_at)
							success_message(data.message, {position:'topCenter'});
						} else {
							error_message(data.message);
						}
					} else {
						ajax_error_message()
					}
				}
			} catch (e) {
				ajax_error_message()
			}
		}).fail(function (jqXHR, textStatus, errorThrown) {
			ajax_error_message();
		});
	}


	deleteCandidatureAttachment = function(params) {
		// Fire off the request
		$.ajax({
			type: 'POST',
			url: site_url('src/includes/ajax/index.php'),
			data: {
				'action': 'cand_delete_attachement',
				'id_attachement': params[0]
			}
		}).done(function (response, textStatus, jqXHR) {
			try {
				var data = $.parseJSON(response);
				if( $.type(data) == 'object' ) {
					if( typeof data.status != undefined ) {
						if( data.status == 'success' ) {
							$(params.target).closest('tr').addClass('deletedRow')

							$(params.target).closest('tr').fadeOut( "slow", function() {
							    $(this).remove();
							});

							success_message(data.message, {position:'topCenter'});
							showAttachmentsPopup(event, [$('#attach_id_candidature').val()], $('#currentPage').val())
						} else {
							error_message(data.message);
						}
					} else {
						ajax_error_message()
					}
				}
			} catch (e) {
				ajax_error_message();
			}
		}).fail(function (jqXHR, textStatus, errorThrown) {
			ajax_error_message();
		});
	}


	// Ajax pagination
	$('.live-link>a').click(function(event){
		event.preventDefault()
		var $link = $(this).attr('href')
		showModal({
			data: {
				'action': 'cand_attachments_popup',
				'candidatures': [$('#attach_id_candidature').val()],
				'page': $link.slice($link.indexOf('=')+1)
			}
		})
	})


	// Add new Line
    $("#attachmentTable").on('click', '.addLine', function(){
        event.preventDefault()

        var $row = $(this).closest("tr")

        var copy = $row.clone()
			copy.find('button').toggleClass('addLine deleteLine')
			copy.find('button').toggleClass('btn-success btn-danger')
			copy.find('button>i').toggleClass('fa-plus fa-minus')

		$row.find('input').val('')

        $(copy).insertBefore($row)
    })

    $("#attachmentTable").on('click', '.deleteLine', function(){
        $(this).closest('tr').remove();
    });

    $('#candidaturesModal .modal-content').css('max-width', window.outerWidth-30)


})
</script>