import $ from 'jquery'

export default class chmForm {

  static sumbit (event) {
    event.preventDefault()

    // Get form data
    var form = $(event.target)[0]
    var data = new window.FormData(form)

    // Check if there is textarea with ckeditor
    if ($('textarea.ckeditor').length > 0) {
      $.each($('textarea.ckeditor'), function () {
        var id = $(this).attr('id')
        var name = $(this).attr('name')
        data.set(name, window.CKEDITOR.instances[id].getData())
      })
    }

    // Disable submit button
    var btn = $(event.target).find('[type="submit"]')
    var btnHtml = btn.html()
    btn.html('<i class="fa fa-circle-o-notch"></i>&nbsp;Traitement en cours...')
    btn.prop('disabled', true)

    // Prepare ajax arguments
    var ajaxArgs = {
      type: $(event.target).attr('method'),
      url: $(event.target).attr('action'),
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000
    }
    if ($(event.target).find('[type="file"]')) ajaxArgs.enctype = 'multipart/form-data'

    // Fire ajax request
    $.ajax(ajaxArgs).done(function (response, textStatus, jqXHR) {
      try {
        response = $.parseJSON(response)
        if (response.status === 'success') {
          window.chmModal.destroy()
          // Trigger callback
          $(event.target).trigger('chm_form_success', [response])
          /* if ('onSuccess' in options) {
            console.log(options.onSuccess)
          } */
        }
        if (response.message) {
          if (typeof response.message === 'object') {
            if (response.status !== 'success') window.chmAlert.danger("L'opération est fini avec des erreurs.")
            window.chmForm.showMessagesBlock(response.status, response.message, event.target)
          } else {
            window['chmAlert'][response.status](response.message)
          }
        }
      } catch (error) {
        window.ajax_error_message()
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      var message = jqXHR.status + ' - ' + jqXHR.statusText
      window.chmAlert.danger('<i class="fa fa-times-circle"></i>&nbsp;' + message)
    }).always(function () {
      btn.html(btnHtml)
      btn.prop('disabled', false)
      window.grecaptcha.reset()
    })
  }

  static showMessagesBlock (type, messages, target, dismissible = true) {
    var alertWrapClass = '.chm-response-messages'
    var alert = window.chmAlert.getAlertBlock(type, messages, dismissible)
    var modal = $(target).closest('.chm-modal')
    var container = (modal.length !== 0) ? modal : target
    var alertWrap = $(alertWrapClass)
    if ($(alertWrap).length === 0) {
      alertWrap = $(container).prepend('<div class="chm-response-messages"></div>')
    }
    $(alertWrap).empty().html(alert)
    $('body, html').animate({
      scrollTop: $(target).offset().top
    }, 1000)
  }

}
