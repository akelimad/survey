// Validate form fields
$('[eta-validate="string"]').change(function(){
	isString($(this))
});
$('[eta-validate="email"]').change(function(){
	isEmail($(this))
});
$('[eta-validate="numeric"]').change(function(){
	isNumeric($(this))
});
$('[eta-validate="phone"]').change(function(){
	isPhone($(this))
});
$('[eta-validate="date"]').change(function(){
	isDate($(this))
});


// Tooltip
$('[data-toggle="tooltip"]').tooltip({trigger: 'hover'}).on('click', function(event) {
	event.preventDefault()
});

// Popover
$('[data-toggle="popover"]').popover({
	container: 'body',
	html: true,
	content: function () {
		var clone = $($(this).data('popover-content')).clone(true).removeClass('hidden');
		return clone;
	}
}).click(function(event) {
	event.preventDefault();
});


// Candidat table
$('.etaTable .email-condidat').click(function(event){
	event.preventDefault()
	popup_send_email([$(this).data('cid')])
});

$('#bulk-wrap input[type="submit"]').click(function(event){
	var selectedBulk = $('#bulk-wrap select').val()
	var bulkCallable = $('#bulk-wrap select option:selected').data('callback')
	if( $('.etaTable_cb:checked').length == 0 ) {
		event.preventDefault()
		error_message('Vous devez choisir au moin une ligne.');
		return;
	} else if( selectedBulk == '' ) {
		event.preventDefault()
		error_message('Merci de choisir une action.');
		return;
	} else if( bulkCallable != undefined ) {
		event.preventDefault()
		var checked = []
		$('.etaTable_cb:checked').each(function(k, v){
			checked[k] = $(this).val()
		})	
		window[bulkCallable](event, checked);
	}
})


$('.etaTable_cb').change(function(){
	$('.etaTable_checkAll').prop('checked', ($('.etaTable_cb').length == $('.etaTable_cb:checked').length) )
})


$('.etaTable_perpage').change(function(){
	var perpage = $(this).val()
	change_url_param('perpage', perpage)
	location.reload()
})

// Check all
$('.etaTable_checkAll').change(function(){
	$('.etaTable_checkAll').not($(this)).prop('checked', $(this).is(':checked'))
	$(".etaTable_cb").prop("checked", $(this).is(':checked'));
})