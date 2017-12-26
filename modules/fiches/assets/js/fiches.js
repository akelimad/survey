jQuery(document).ready(function($){

	// show change status popup
	showFicheEvaluationPopup = function(event, candidatures) {
		event.preventDefault()
		showModal({
			data: {
				'action': 'fiche_evaluation_popup',
				'candidatures': candidatures
			}
		})
	}

	// Display note orale history
	showNoteOralePopup = function(id_candidature, currentPage=1) {
		event.preventDefault()
		showModal({
			data: {
				'action': 'cand_note_orale_popup',
				'id_candidature': id_candidature,
				'page': currentPage
			}
		})
	}

	// Show Fiche details
	showFicheDetails = function(value, key='id_historique') {
		showModal({
			data: {
				'action': 'cand_show_fiche_details',
				'key': key,
				'value': value
			}
		})
	}


	// Ajax pagination
	$(document).on('click', '.noteOraleTableForm .live-link>a', function(event){
		event.preventDefault()
		var $link = $(this).attr('href')
		showModal({
			data: {
				'action': 'cand_note_orale_popup',
				'id_candidature': $('#note_id_candidature').val(),
				'page': $link.slice($link.indexOf('=')+1)
			}
		})
	})


});