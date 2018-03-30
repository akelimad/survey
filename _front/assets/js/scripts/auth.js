import $ from 'jquery'

$(document).ready(function () {
  $('body').on('chm_form_success', '#candidat-login-form', function (event, response) {
    try {
      switch (response.status) {
        case 'success':
          window.location.href = response.data.redirect
          break
        case 'confirm_activation':
          window.chmModal.confirm('', '', response.message, 'chmAuth.reActivate', {cid: response.data.candidat_id}, {width: 400})
          break
        case 'resent_email':
          window.chmModal.confirm('', '', response.message, 'chmAuth.resentEmail', {'cid': response.data.candidat_id}, {width: 400})
          break
      }
    } catch (e) {
      window.chmAlert.warning('Une erreur est survenu, essay plus tards.')
    }
  })

  $('body').on('chm_form_success', '#candidat-reset-password', function (event, response) {
    try {
      switch (response.status) {
        case 'confirm_activation':
          window.chmModal.confirm('', '', response.message, 'chmAuth.reActivate', {cid: response.data.candidat_id}, {width: 400})
          break
        case 'resent_email':
          window.chmModal.confirm('', '', response.message, 'chmAuth.resentEmail', {'cid': response.data.candidat_id}, {width: 400})
          break
      }
    } catch (e) {
      window.chmAlert.warning('Une erreur est survenu, essay plus tards.')
    }
  })
})
