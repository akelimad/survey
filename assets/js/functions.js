/**
 * Check if array contain a value
 *
 * @Mhamed chanchaf
 */
function RegExpArr($arr, $value) {
  return new RegExp('/(' + $arr.join('|') + ')/').test($value);
}


/**
 * ERROR MESSAGE
 *
 * @param string message
 */
function error_message(message, params={}){
  if( message == '' ) return;
  if( !detectIE() ) {
    // default params
    var default_params = {
      icon: 'fa fa-exclamation-triangle',
      title: '',
      message: message,
      position: 'topCenter',
      progressBar: false,
    }

    //merging two objects into new object
    var args = $.extend({}, default_params, params);

    iziToast.error(args);
  } else {
    alert(message)
  }
}


/**
 * SUCCESS MESSAGE
 *
 * @param string message
 */
function success_message(message, params={}){
  if( message == '' ) return;
  if( !detectIE() ) {
    // default params
    var default_params = {
      icon: 'fa fa-exclamation-triangle',
      title: '',
      message: message,
      position: 'topRight',
      progressBar: false,
    }

    //merging two objects into new object
    var args = $.extend({}, default_params, params);

    iziToast.success(args);

  } else {
    alert(message)
  }
}

/**
 * Confirm message
 *
 * @author Mhamed Chanchaf
 */
function confirmMessage(event, callable=null, args={}, message=null) {
  var $target = event.target;
  if( $($target).is('i') ) $target = $($target).closest('a')

  if( !$($target).hasClass('confirm') ) {
    event.preventDefault();

    args.target = $target;

      // Add class confirm
    $($target).addClass('confirm')

    if( message == null ) message = 'Êtes-vous sûr ?';

    iziToast.error({
      icon: 'fa fa-exclamation-triangle',
      class: 'confirm',
      message: message,
      position: 'center',
      close: false,
      progressBar: false,
      timeout: false,
      buttons: [
          ['<button>OUI</button>', function (instance, toast) {

            if( callable == null ) {

              if( $($target).is('a') ) {
                location.href = $($target).attr('href')
              } else if( $($target).is('input[type="submit"]') ) {
                $($target).closest('form').submit()
              }
            } else {
              window[callable](args);
              instance.hide({
                transitionOut: 'fadeOutUp',
              }, toast, 'close', 'btn_oui');
            }

          }],
          ['<button>NON</button>', function (instance, toast) {
            $($target).removeClass('confirm')

              instance.hide({
                  transitionOut: 'fadeOutUp',
              }, toast, 'close', 'btn_non');
          }]
      ]
    });
  }

  
}


/**
 * Tell if number is lower than giving length  
 *
 * @param int length
 * @param int max_length
 */
function isLowerThanMax(length, max_length) {
	if( length > max_length ) {
      error_message('Vous avez depassé la valeur maximal pour ce champs, (Max:'+max_length+')')
    	return false;
    }
    return true;
}



// Check for Numeric
function isNumeric(target, max_length=null) {
	var field = jQuery(target);
    if( max_length !== null && !isLowerThanMax(field.val().length, max_length) ) {
	    field.val('');
    } else if (!jQuery(target).val().match(/^[0-9]+$/)) {
		  error_message('Seulement les numeros sont permis.')
	    field.val('');
      return false;
	}
  return true;
}

// Check for String
function isString(target, max_length=null) {
  var field = jQuery(target);
  if( max_length !== null && !isLowerThanMax(field.val().length, max_length) ) {
    field.val('');
  } else {
    var patern = /^([a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ\s<>\/\@!?#$%&*\-_+='.:;[\]|{}()])+$/i
    if( !patern.test(field.val()) ) {
      error_message("Les caractères spéciaux ne sont pas autorisés");
      field.val('');
      return false;
    }
  }
  return true;
}

// Check for Phone
function isPhone(target, max_length=16) {
	var field = jQuery(target);
	var value = field.val();
    if( max_length !== null && !isLowerThanMax(field.val().length, max_length) ) {
	    field.val('');
    } else if (!value.match(/^[0-9+]+$/) ) {
		  error_message('Format de téléphone incorrect.')
	    field.val('');
      return false;
	}
  return true;
}


// Check for Date
function isDate(target) {
	if (!jQuery(target).val().match(/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/)) {
		error_message('Format de date incorrect.')
	    jQuery(target).val('');
      return false;
	}
  return true;
}

// Check for Email
function isEmail(target) {
  if( jQuery(target).val() == '' ) {
    error_message('Le champs email est obligatoire.')
    return false;
  } else if (!jQuery(target).val().match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
		error_message('Format de l\'email incorrect.')
	   jQuery(target).val('');
    return false;
	}
  return true;
}



function cimDatepicker(identifier, params={}) {
  // default params
  var default_params = {
    closeText: 'Fermer',
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
    dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    weekHeader: 'Sem.',
    dateFormat: 'dd/mm/yy',
    defaultDate: "+1w",
    maxDate: '-1day',
    minDate: "-100Y",
    yearRange: "-100:+0",
    changeMonth: true,
    changeYear: true,
    numberOfMonths: 1,
  }

  //merging two objects into new object
  var args = $.extend({}, default_params, params);

  $( identifier ).datepicker(args);
}


function getDate( element ) {
  var date;
  try {
    date = $.datepicker.parseDate( dateFormat, element.value );
  } catch( error ) {
    date = null;
  }
  return date;
}


function site_url(path='') {
	return location.origin +'/'+ path; //$('link[rel="website"]').attr('href') + path;
  // location.origin + 
}


function createCookie(name,value,days=365,path='') {
  if( path == '' ){
    var url  = site_url();
    var path = url.replace(location.origin, '');
  }
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else var expires = "";
  document.cookie = name+"="+value+expires+"; path="+path;
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

function eraseCookie(name) {
  createCookie(name,"",-1);
}



/**
 * AJAX handler
 *
 * @param object args
 * @param callback callback
 */
function ajax_handler($params, callback){
	// default params
	var $default = {
		url: site_url('src/includes/ajax/index.php'),
    type: 'post',
    data: {}
	}

	//merging two objects into new object
 	var $args = jQuery.extend({}, $default, $params);

  // Fire off the request to request_url
  $request = jQuery.ajax($args);

  // Callback handler that will be called on success
  $request.done(function (response, textStatus, jqXHR){
      try {
          callback( jQuery.parseJSON(response) ); //check if response is json
      }catch (e) {
      	callback({error: true});
        error_message('Oops! Une erreur est survenu, essay plus tards.');
      }
  });

  // Callback handler that will be called on failure
  $request.fail(function (jqXHR, textStatus, errorThrown){
  	callback({error: true});
    error_message('Oops! Une erreur est survenu, essay plus tards.');
  });
}


function isGreaterDate(date_start, date_end) {
  var ds_parts = date_start.split('/');
  var date_start = ds_parts[1] + "/" + ds_parts[0] + "/" + ds_parts[2];

  var de_parts = date_end.split('/');
  var date_end = de_parts[1] + "/" + de_parts[0] + "/" + de_parts[2];

  var startDate = new Date(date_start);
  var endDate = new Date(date_end);

  return startDate >= endDate;
};


/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {

  var ua = window.navigator.userAgent;

  var is_android = ((ua.indexOf('Mozilla/5.0') > -1 && ua.indexOf('Android ') > -1 && ua.indexOf('AppleWebKit') > -1) && !(ua.indexOf('Chrome') > -1));
  if( is_android ) {
    return true;
  }

  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
      // IE 10 or older => return version number
      return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
      // IE 11 => return version number
      var rv = ua.indexOf('rv:');
      return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

  var edge = ua.indexOf('Edge/');
  if (edge > 0) {
     // Edge (IE 12+) => return version number
     return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
  }

  // other browser
  return false;
}