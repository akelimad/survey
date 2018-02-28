import $ from 'jquery'

export default class chmForm {

  static submit (event, target = null) {
    event.preventDefault()

    if (target === null) target = $(event.target)

    // Get form data
    var form = $(target)[0]
    var data = new window.FormData(form)

    // Check if there is textarea with ckeditor
    if ($('textarea.ckeditor').length > 0) {
      $.each($('textarea.ckeditor'), function () {
        var id = $(this).attr('id')
        var name = $(this).attr('name')
        try {
          data.set(name, window.CKEDITOR.instances[id].getData())
        } catch (e) {}
      })
    }

    // Disable submit button
    var btn = $(target).find('[type="submit"]')
    var btnHtml = btn.html()
    var loadingLabel = 'Traitement en cours...'
    var loadingAttr = $(target).attr('chm-loading-label')
    if (loadingAttr !== undefined) {
      loadingLabel = loadingAttr
    }
    btn.html('<i class="fa fa-circle-o-notch"></i>&nbsp;' + loadingLabel)
    btn.prop('disabled', true)

    $('.chm-response-messages').empty()

    var action = $(target).attr('action')
    if (action === '') action = window.location.href

    // Prepare ajax arguments
    var ajaxArgs = {
      type: $(target).attr('method'),
      url: action,
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000
    }
    if ($(target).find('[type="file"]')) ajaxArgs.enctype = 'multipart/form-data'

    // Fire ajax request
    $.ajax(ajaxArgs).done(function (response, textStatus, jqXHR) {
      try {
        response = $.parseJSON(response)

        // Trigger callback
        $(target).trigger('chm_form_success', response)

        if (response.message !== '' && ['success', 'info', 'warning', 'danger', 'error'].indexOf(response.status) !== -1) {
          if (typeof response.message === 'object') {
            if (response.status !== 'success') window.chmAlert.danger("L'opération est fini avec des erreurs.")
            var dismissible = (response.data.dismissible && response.data.dismissible === true)
            window.chmForm.showMessagesBlock(response.status, response.message, target, dismissible)
          } else {
            window['chmAlert'][response.status](response.message)
          }
        }
        if (response.status === 'success') {
          window.chmModal.destroy()
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
      if (window.grecaptcha !== undefined) {
        window.grecaptcha.reset()
      }
    })
  }

  static showMessagesBlock (type, messages, target, dismissible = true) {
    var alert = window.chmAlert.getAlertBlock(type, messages, dismissible)
    var modal = $(target).closest('.chm-modal')
    var container = (modal.length > 0) ? modal : target
    if (modal.length > 0) {
      if ($('.chm-response-messages').length < 1) {
        $(container).find('.modal-body').prepend('<div class="chm-response-messages"></div>')
      }
      $('.chm-response-messages').html(alert)
    } else {
      if ($('.chm-response-messages').length === 0) {
        $(container).prepend('<div class="chm-response-messages"></div>')
      }
      $('.chm-response-messages').html(alert)
      $('body, html').animate({scrollTop: $(target).offset().top}, 1000)
    }
  }

}
