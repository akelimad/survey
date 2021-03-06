import $ from 'jquery'

export default class chmCandidature {

  static spontanee () {
    if (!window.chmAuth.isLogged()) {
      window.chmAuth.loginModal('Vous devez vous connecter pour déposer une candidature spontanée.')
      return
    }

    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('candidature/spontanee')
    }, {
      form: {
        action: window.chmSite.url('candidature/spontanee'),
        method: 'POST',
        callback: 'chmForm.submit',
        id: 'candidature-spontanee',
        class: 'chm-simple-form'
      },
      footer: {
        label: 'Envoyer ma candidature'
      }
    })
  }

  static stage () {
    if (!window.chmAuth.isLogged()) {
      window.chmAuth.loginModal('Vous devez vous connecter pour déposer une candidature pour un stage.')
      return
    }

    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('candidature/stage')
    }, {
      form: {
        action: window.chmSite.url('candidature/stage'),
        method: 'POST',
        callback: 'chmForm.submit',
        id: 'candidature-stage',
        class: 'chm-simple-form'
      },
      footer: {
        label: 'Envoyer ma candidature'
      }
    })
  }

  static deleteSpontanee (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/account/candidature/deleteSpontanee'),
      data: params
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        $('tr#csp_' + params.id).remove()
        if ($('#candidaturesSpontanees tbody tr').length === 0) {
          $('#candidaturesSpontanees').empty().html('<tr class="empty"><td colspan="4"><strong>Aucune candidature enregistrée.</strong></td></tr>')
        }
        window['chmAlert'][response.status](response.message)
      }
    })
  }

  static deleteStage (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/account/candidature/deleteStage'),
      data: params
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        $('tr#stage_' + params.id).remove()
        if ($('#candidaturesStage tbody tr').length === 0) {
          $('#candidaturesStage').empty().html('<tr class="empty"><td colspan="4"><strong>Aucune candidature enregistrée.</strong></td></tr>')
        }
        window['chmAlert'][response.status](response.message)
      }
    })
  }

  static alertForm (id = null) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/account/candidature/alertForm'),
      data: {id: id}
    }, {
      onSuccess: (response) => {
        window['chmAlert'][response.status](response.message)
      }
    })
  }

}
