jQuery(document).ready(function($){

	showSharePopup = function(id_offer) {
		window.chmModal.show({
			url: get_ajax_url(), 
			data: {
				action: 'offer_share_popup',
				id_offer: id_offer
			}
		})
	}

});