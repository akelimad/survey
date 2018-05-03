jQuery(document).ready(function($){
	var url_params = $('#url_params').val();
	var fields = $('#filterFields').val();
	var loadingGifUrl = site_url('modules/candidatures/assets/img/loading.gif');
	var modalTitle = '<img src="'+ loadingGifUrl +'" style="width: 30px;">&nbsp;Chargement en cours...';

	showModal = function(ajax_args) {
		ajax_args.type = 'POST';
		ajax_args.url = site_url('src/includes/ajax/index.php')
		$('[data-toggle="popover"]').popover('hide')
		window.chmModal.show(ajax_args)
	}

	showCandidaturesFilterForm = function(url_params, fields) {
		// Fire off the request
		$.ajax({
			type: 'POST',
			url: site_url('src/includes/ajax/index.php'),
			data: {
				'action': 'cand_filter_form',
				'params': url_params,
				'fields': fields,
			}
		}).done(function (response, textStatus, jqXHR) {
			try {
				var data = $.parseJSON(response);
				if( $.type(data) == 'object' ) {
					$('#candidatures-filter-wrap').empty().html(data.content)
				} else {
					$('#candidatures-filter-wrap').empty().html('<div class="chm-alerts alert alert-warning alert-white rounded"><div class="icon"><i class="fa fa-warning"></i></div><ul><li>Une erreur est survenue lors de chargement de filter. <a href="javascript:void(0)" id="refresh-candidatures-filter" style="float: right;margin-right: 5px;margin-top: -2px;"><i class="fa fa-refresh"></i></a></li></ul></div>')
				}
			} catch (e) {
				ajax_error_message();
			}
        }).fail(function (jqXHR, textStatus, errorThrown) {
        	ajax_error_message();
        });
	}

	showAttachmentsPopup = function(event, candidatures, currentPage=1) {
		event.preventDefault()
		showModal({
			data: {
				'action': 'cand_attachments_popup',
				'candidatures': candidatures,
				'page': currentPage
			}
		})
	}

	showSendEmailPopup = function(event, candidatures) {
		event.preventDefault()
		showModal({
			data: {
				'action': 'cand_sendemail_popup',
				'candidatures': candidatures
			}
		})
	}

	showSendCVEmailPopup = function(event, candidatures) {
		event.preventDefault()
		showModal({
			data: {
				'action': 'cand_send_cv_email_popup',
				'candidatures': candidatures
			}
		})
	}

	// show change status popup
	showChangeSatatusPopup = function(event, candidatures) {
		event.preventDefault()

		var url = window.chmSite.url('backend/candidatures/change-status')
		window.chmModal.show({
      type: 'POST',
      url: url,
      data: {
      	candidatures: candidatures,
				'id_statut': $('input#current_statut_id').val()
      }
    }, {
      form: {
        action: url,
        callback: 'chmForm.submit',
        id: 'changeSatatusForm'
      },
      footer: {
        label: trans("Appliquer les changements")
      }
    })
	}

	// Update candidature note ecrit
	showNoteEcritPopup = function(id_candidature) {
		event.preventDefault()
		showModal({
			data: {
				'action': 'cand_note_ecrit_popup',
				'id_candidature': id_candidature
			}
		})
	}

	// partager les candidatures
	showShareCandidaturePopup = function(event, candidatures) {
		event.preventDefault()
		showModal({
			data: {
				'action': 'cand_share_candidature_popup',
				'candidatures': candidatures,
				'table_actions': $('#table_actions').val()
			}
		})
	}

	// Change candidature offre
	showChangeOffrePopup = function(id_candidature, id_offre) {
		event.preventDefault()
		showModal({
			data: {
				'action': 'cand_change_offre_popup',
				'id_candidature': id_candidature,
				'id_offre': id_offre
			}
		})
	}

	// Assign candidature To Offer
	assignToOffer = function (event, ids) {
		var url = window.chmSite.url('backend/candidatures/assign-to-offer')
		window.chmModal.show({
      type: 'POST',
      url: url,
      data: {cIds: ids}
    }, {
      form: {
        action: url,
        callback: 'chmForm.submit',
        class: 'chm-simple-form'
      },
      footer: {
        label: trans("Affecter")
      },
      width: 400
    })
	}	

	$.fn.getWidthInPercent = function () {
		var width = parseFloat($(this).css('width'))/parseFloat($(this).parent().css('width'));
		return Math.round(100*width);
	};

	$('#candidaturesModal').on('hidden.bs.modal', function () {
		$('#candidaturesModal .modal-header h4').html(modalTitle)
		$('#candidaturesModal .modal-body').empty().hide()
	})
	
	$(document).on('click', '#refresh-candidatures-filter', function(event){
		event.preventDefault()
		$('#candidatures-filter-wrap').empty().html('<img src="'+ loadingGifUrl +'" style="width: 30px;margin: 0px auto 30px;">');
		showCandidaturesFilterForm(url_params, fields)
	})

	$('.filter-candidatures-title').click(function(event){
		if( $(this).hasClass('collapsed') ) {
			var $cookieValue = 1;
			if( $('#candidatures-filter').length == 0 ) {
				showCandidaturesFilterForm(url_params, fields)
			}
		} else {
			var $cookieValue = 0;
		}
		createCookie('eta_filter', $cookieValue)
	});

	var eta_filter = readCookie('eta_filter')
	if( 
		(eta_filter == null || eta_filter == '1') && 
		$('#candidatures-filter-wrap').length == 1 && 
		$('#candidatures-filter').length == 0
	) {
		showCandidaturesFilterForm(url_params, fields)
	}


});