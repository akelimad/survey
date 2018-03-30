export default class chmAuth {

  static isLogged () {
    var logged = document.body.className.match('logged')
    return (logged !== null && logged.length === 1)
  }

  static reActivate (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/account/re-activate'),
      data: params
    }, {
      message: '<i class="fa fa-power-off"></i>&nbsp;Activation en cours...',
      onSuccess: (response) => {
        window.location.href = response.data.redirect
      }
    })
  }

  static resentEmail (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/account/resent-email'),
      data: params
    }, {
      message: '<i class="fa fa-send"></i>&nbsp;Envoi en cours...',
      onSuccess: (response) => {
        window.chmAlert.info(response.message)
      }
    })
  }

  static resetPassword () {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/account/reset-password')
    }, {
      form: {
        action: window.chmSite.url('candidat/account/reset-password'),
        callback: 'chmForm.submit',
        id: 'candidat-reset-password',
        class: 'chm-simple-form'
      },
      footer: {
        label: 'Réinitialiser'
      },
      width: 370
    })
  }

  static loginModal (message = null) {
    if (message !== null) {
      window.chmAlert.warning(message)
    }
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('auth/login')
    }, {
      width: 350,
      id: 'login-modal'
    })
  }

}
