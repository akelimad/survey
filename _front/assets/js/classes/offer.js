import $ from 'jquery'

export default class chmOffer {

  static form (idRoleOffre, id = null) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('backend/module/offer/partner/entry'),
      data: {
        id_entry: id,
        id_role_offre: idRoleOffre
      }
    }, {
      form: {
        action: window.chmSite.url('backend/module/offer/partner/store-entry'),
        callback: 'window.chmForm.submit',
        enctype: true
      },
      footer: {
        label: (id === null) ? 'Créer' : 'Mettre à jour'
      }
    })
  }

  static deleteEntryAttachement (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('backend/module/offer/partner/delete-entry-attachement'),
      data: params
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        this.form(params.roid, params.eid)
      }
    })
  }

  static renderSearchForm () {
    var container = $('#chm-offer-search')
    $(container).show().html('<i class="fa fa-circle-o-notch mb-20"></i>&nbsp;Chargement de formulaire de recherche...')
    var url = window.chmSite.url('offer/search-form')
    $.post(url).done(function (response, textStatus, jqXHR) {
      try {
        response = $.parseJSON(response)
        $(container).empty().html(response.content)
        var total = $(container).data('total-offers')
        if (total !== undefined) {
          $(container).find('.total-offers').text(total)
        }
      } catch (e) {
        $(container).empty().hide()
        window.chmAlert.warning(e.message)
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      $(container).empty().hide()
      window.chmAlert.warning(jqXHR.status + ' - ' + jqXHR.statusText)
    })
  }

  static showAdvancedSearch () {
    var $advanced = $('#chm-offer-search .chm-advanced-search')
    var cookie = 0
    var display = 'none'
    if ($advanced.css('display') === 'none') {
      cookie = 1
      display = 'block'
    }
    window.chmCookie.create('eta_of', cookie)
    $advanced.css('display', display)
  }

  static sendToFriend (id) {
    if (!window.chmAuth.isLogged()) {
      window.chmAuth.loginModal('Vous devez vous connecter pour envoyer cet offre à votre ami.')
      return
    }
    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('offre/' + id + '/send-to-friend')
    }, {
      form: {
        action: window.chmSite.url('offre/' + id + '/send-to-friend'),
        method: 'POST',
        callback: 'chmForm.submit',
        id: 'send-offer-to-friend',
        class: 'chm-simple-form'
      },
      footer: {
        label: 'Envoyer'
      },
      width: 370
    })
  }

  static postuler (id) {
    if (!window.chmAuth.isLogged()) {
      window.chmAuth.loginModal('Vous devez vous connecter pour postuler à cet offre.')
      return
    }

    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('offre/' + id + '/postuler')
    }, {
      form: {
        action: window.chmSite.url('offre/' + id + '/postuler/store'),
        method: 'POST',
        id: 'offer-postuler',
        class: 'chm-simple-form'
      },
      footer: {
        label: 'Envoyer ma candidature'
      }
    })
  }

  static manageFields () {
    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('backend/offer/manage-fields')
    })
  }

}
