/**
 * ERROR MESSAGE
 *
 * @param string message
 */
function error_message(message, params={}){
  window.chmAlert.danger(message)
}


function ajax_error_message() {
  error_message('Une erreur est survenu, essay plus tards.');
}

/**
 * SUCCESS MESSAGE
 *
 * @param string message
 */
function success_message(message, params={}){
  window.chmAlert.success(message)
}

/**
 * Confirm message
 *
 * @author Mhamed Chanchaf
 */
function confirmMessage(event, callable = null, args = {}, message ='Êtes-vous sûr de vouloir effectuer cette action?') {
  window.chmModal.confirm(event.target, title = '', message, callable, args, {width: 325, closeAfterConfirm: true})
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
    // var patern = /^([a-z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ\s<>@!#$%^&*()-_+[\]{}?:;|\'\"\\,./~`\-=])+$/i
    if( !patern.test(field.val()) ) {
      error_message("Les caractères spéciaux ne sont pas autorisés");
      field.val('');
      return false;
    }
    // var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-="
    /*var specialChars = '"';
    var string = field.val();
    for(i = 0; i < specialChars.length;i++){
        if(string.indexOf(specialChars[i]) > -1){
          error_message("Les caractères suivants: ("+specialChars+") ne sont pas permis");
          field.val('');
          return false;
        }
    }*/
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
    numberOfMonths: 1
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
  return window.chmSite.url(path)
}

function createCookie(name,value,days=365,path='') {
  window.chmCookie.create(name, value, days, path)
}

function readCookie(name, _default = null) {
  return window.chmCookie.read(name, _default);
}

function eraseCookie(name) {
  return window.chmCookie.erase(name);
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
    data: {},
    showErrorMessage: true
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
        if( $args.showErrorMessage ) error_message('Une erreur est survenu, essay plus tards.');
      }
  });

  // Callback handler that will be called on failure
  $request.fail(function (jqXHR, textStatus, errorThrown){
    callback({error: true});
    if( $args.showErrorMessage ) error_message('Une erreur est survenu, essay plus tards.');
  });
}


function get_ajax_url()
{
  return site_url('src/includes/ajax/index.php');
}

/**
 * Get url parameter
 *
 * @param $name string
 * @return $params string
 **/
function get_url_param(name){
  return window.chmUrl.getParam(name)
}

/**
 * Change url parameter
 *
 * @param param string
 * @param value string
 * @return void
 */
function change_url_param(param, value) {
  return window.chmUrl.setParam(param, value)
}


/**
 * Delete parameter from url
 *
 * @param param string
 * @return void
 */
function remove_url_param(param) {
  return window.chmUrl.eraseParam(name)
}