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

});