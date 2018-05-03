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
/*if ($('[data-toggle="tooltip"]').length > 0) {
	$('[data-toggle="tooltip"]').tooltip({trigger: 'hover'}).on('click', function(event) {
		event.preventDefault()
	});
}*/

// Popover
if ($('[data-toggle="popover"]').length > 0) {
	$('[data-toggle="popover"]').popover({
		container: 'body',
		html: true,
		content: function () {
			var clone = $($(this).data('popover-content')).clone(true).removeClass('hidden');
			return clone;
		}
	}).click(function(event) {
		event.preventDefault();
		$('[data-toggle="popover"]').not(this).popover('hide');
		$('.popover-title').append('<i class="fa fa-times"></i>')
		
	});
	
	$('body').on('click', '.popover-title>i', function(){
		$('[data-toggle="popover"]').popover('hide');
	})
}

// Candidat table
$('.etaTable .email-condidat').click(function(event){
	event.preventDefault()
	popup_send_email([$(this).data('cid')])
});

$('body').on('click', '#bulk-wrap [type="submit"]', function(){
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
		var parts = bulkCallable.split('.')
    if (parts.length === 2) {
      window[parts[0]][parts[1]](event, checked)
    } else {
      window[parts[0]](event, checked)
    }
	}
})


$('body').on('change', '.etaTable_cb', function(){
	$('.etaTable_checkAll').prop('checked', ($('.etaTable_cb').length == $('.etaTable_cb:checked').length) )
})


$('body').on('change', '.etaTable_perpage', function(){
	var perpage = $(this).val()
	change_url_param('page', 1)
	change_url_param('perpage', perpage)
	location.reload()
})

// Check all
$('body').on('change', '.etaTable_checkAll', function(){
	$('.etaTable_checkAll').not($(this)).prop('checked', $(this).is(':checked'))
	$(".etaTable_cb").prop("checked", $(this).is(':checked'));
})