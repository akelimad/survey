$(document).ready(function() {

	$('body').append( '<a href="' + data_json.site_url + ( data_json.isbackend ? 'backend/' : '' ) + 'message/candidature/' + data_json.candidature_id + '/messages"><div class="notification hide"><span class="count_notif"></span></div></a>' );
	/*----------------- Run thread for notification ----------------------*/
	var $shownotification = setInterval(function(){
		$data = RunAJAXRequest('message/candidature/message/notification', { candidature_id: data_json.candidature_id }, 'show' )
	}, 2000);
	var $shownotificationInTabs = setInterval(function(){
		$data = RunAJAXRequest('message/candidature/message/notification', { candidature_id: data_json.candidature_id, isTab: true }, 'show_in_tab' )
	}, 2000);
	/*----------------------------- Finish ------------------------------*/
	var RunAJAXRequest = function(url, data, etat){
		$.ajax({
			type: 'POST',
			url: url,
			data: data,
			dataType: 'JSON',
			beforeSend: function() {
			},
			success: function(data) {
				if(etat == 'show') {
					if (!data_json.isbackend) {
						$count =  data.count_msg_not_readed
						if( $count > 0 ) {
							$('.notification .count_notif').text( 'Nouveau message (' + data.count_msg_not_readed  + ')' )
							$('.notification').removeClass('hide').fadeIn('slow')
						}else{
							$('.notification .count_notif').text( '' )
							$('.notification').addClass('hide')
						}
					}
				}else if (etat == 'show_in_tab') {
					$.each(data.notifications_tabs, function(key, value) {
						$elt = $('.conversation_tabs ul li#tab'+ value.candidature_id +' span')
						if ($elt.length == 0 && parseInt(value.count_not_seen) > 0) {
							$('.conversation_tabs ul li#tab'+ value.candidature_id +' a').after( '<span class="count_msg_not_read">'+ value.count_not_seen +'</span>' );
						}else if($elt.length != 0){
							if (parseInt($elt.html()) != parseInt(value.count_not_seen) && parseInt(value.count_not_seen) != 0) {
								$elt.text( value.count_not_seen )
							}else if( parseInt(value.count_not_seen) == 0 ){
								$elt.remove()
							}
						}
					})
				}
			},
			error: function(xhr) { },
			complete: function() {}
		});
	}
	/*------------------------- RealTime message sync -------------------*/
	setInterval(function() {
		// TODO - Remove opacity refrech table 
		chmTable.refresh('#messageTableContainer')
	}, 2000);

});