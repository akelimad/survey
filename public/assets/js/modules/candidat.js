import $ from 'jquery'

export default class chmCandidat {

  static deletePhoto (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/cv/langues_pj/delete-photo'),
      data: params
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        $('#candidatPhoto').hide()
        $('.file-upload.photo').show()
        window['chmAlert'][response.status](response.message)
      }
    })
  }

  static deleteCV (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/cv/langues_pj/delete-cv'),
      data: params
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        if (response.status === 'success') {
          $('li.cv_' + params.id).remove()
        }
        window['chmAlert'][response.status](response.message)
      }
    })
  }

  static deleteLM (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/cv/langues_pj/delete-lm'),
      data: params
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        if (response.status === 'success') {
          $('li.lm_' + params.id).remove()
        }
        window['chmAlert'][response.status](response.message)
      }
    })
  }

  static setCVDefault (id) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/cv/langues_pj/set-cv-default'),
      data: {id: id}
    }, {
      onSuccess: (response) => {
        window['chmAlert'][response.status](response.message)
      }
    })
  }

  static setLMDefault (id) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/cv/langues_pj/set-lm-default'),
      data: {id: id}
    }, {
      onSuccess: (response) => {
        window['chmAlert'][response.status](response.message)
      }
    })
  }

}
