import $ from 'jquery'

export default class Language {

  static trans (msgid) {
    return msgid
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

  static store (target, sid, isoCode, value) {
    $(target).prop('disabled', true).html('<i class="fa fa-circle-o-notch fa-spin"></i>')

    var url = window.chmSite.url('backend/language/strings/store')
    $.post(url, {sid: sid, isoCode: isoCode, value: value}).done(function (response, textStatus, jqXHR) {
      try {
        if (typeof response === 'string') response = $.parseJSON(response)
        $('textarea[data-sid="' + sid + '"]').css('border', '1px solid #7d7b7b')
        window['chmAlert'][response.status](response.message)
      } catch (e) {
        window.chmAlert.warning(e.message)
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      window.chmAlert.warning(jqXHR.status + ' - ' + jqXHR.statusText)
    }).always(function (jqXHR, textStatus, errorThrown) {
      $(target).prop('disabled', false).html('<i class="fa fa-save"></i>')
    })
  }

}
