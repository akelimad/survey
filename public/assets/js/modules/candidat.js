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

}
