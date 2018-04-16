import $ from 'jquery'

export default class Language {

  static trans (msgid) {
    return msgid
  }

  static change (isoCode) {
    window.chmCookie.create('eta_lang', isoCode)
    window.location.reload()
  }

  static scan () {
    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('backend/language/scan')
    }, {
      message: '<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;' + this.trans('Recherche de nouveaux phrases en cours...'),
      width: 400,
      onSuccess: (response) => {
        window.chmTable.refresh(document.querySelector('#stringsTable'), {scrollTo: true})
      }
    })
  }

  static store (event, ids, counter = 0, btnHtml = null) {
    var self = this
    var target = event.target
    if ($(target).is('i')) {
      target = $(target).closest('a')
    }
    var $field = $('tr[data-pkv="' + ids[counter] + '"]').find('.trans_value')
    var isoCode = window.chmUrl.getParam('lang', $('[name="lang"] option:selected').val())

    if (counter === 0) {
      btnHtml = $(target).html()
      $(target).prop('disabled', true).html('<i class="fa fa-circle-o-notch fa-spin"></i>')
    }

    return $.post(window.chmSite.url('backend/language/strings/store'), {
      sid: ids[counter],
      isoCode: isoCode,
      value: $field.val()
    }).done(function (response, textStatus, jqXHR) {
      try {
        if (typeof response === 'string') response = $.parseJSON(response)
        $('textarea[data-sid="' + ids[counter] + '"]').css('border', '1px solid #7d7b7b')
        counter += 1
        if (typeof ids[counter] !== 'undefined') {
          self.store(event, ids, counter, btnHtml)
        } else {
          $(target).prop('disabled', false).html(btnHtml)
          window['chmAlert'][response.status](response.message)
        }
      } catch (e) {
        window.chmAlert.warning(e.message)
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      window.chmAlert.warning(jqXHR.status + ' - ' + jqXHR.statusText)
    })
  }

}
