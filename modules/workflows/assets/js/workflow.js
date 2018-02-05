jQuery(document).ready(function($){
	"use strict";

	// Instantiate the Bloodhound suggestion engine
	var users = new Bloodhound({
		datumTokenizer: function (datum) {
        return Bloodhound.tokenizers.whitespace(datum.nom);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id_role'),
	  remote: {
	    wildcard: '%QUERY',
	    limit: 10,
	    url: site_url('src/includes/ajax/index.php?action=search_users&query=%QUERY'),
	    transform: function(response) {
	      // Map the remote source JSON array to a JavaScript object array
	      return $.map(response, function(user) {
	        return user;
	      });
	    }
	  }
	});

	$('.search-users').tagsinput({
		confirmKeys: [13, 32, 44, 188],
		allowDuplicates: false,
		itemValue: 'id_role',
  	itemText: 'nom',
	  typeaheadjs: [{
      minLength: 3,
      highlight: true,
	  },{
      limit: 10,
      name: 'users',
      displayKey: 'nom',
      source: users.ttAdapter()
	  }],
	  freeInput: true
	})

	$('.search-users').each(function(k, v){
		var $el = $(this)
		if( $el.val() != '' ) {
			$.each(JSON.parse($el.val()), function(k, v){
				$el.tagsinput('add', v);
			})
		}
	})

	$('[name="wf_type"]').change(function(){
		if( $(this).val() == 'default' ) {
			$('.type_default').show()
			$('.type_custom').hide()
		} else {
			$('.type_default').hide()
			$('.type_custom').show()
		}
	})

	

})