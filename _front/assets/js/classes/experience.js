export default class chmExperience {

  static getForm (id = null) {
    var url = (id === null) ? 'candidat/cv/experience' : 'candidat/cv/experience/' + id
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url(url),
      data: {
        id: id
      }
    }, {
      form: {
        action: window.chmSite.url('candidat/cv/experience/store'),
        callback: 'window.chmForm.submit',
        class: 'chm-simple-form'
      },
      footer: {
        label: (id === null) ? 'Créer' : 'Mettre à jour'
      }
    })
  }

  static delete (params) {
    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('candidat/cv/experience/' + params.id + '/delete')
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        window['chmAlert'][response.status](response.message)
        window.chmTable.refresh(document.querySelector('#experiencesTableContainer'))
      }
    })
  }

  static deleteCertificate (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/cv/experience/delete-certificate'),
      data: params
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        this.getForm(params.id)
        window.chmTable.refresh(document.querySelector('#experiencesTableContainer'))
      }
    })
  }

  static deleteBulletinPaie (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/cv/experience/delete-bulletin-paie'),
      data: params
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        this.getForm(params.id)
        window.chmTable.refresh(document.querySelector('#experiencesTableContainer'))
      }
    })
  }

}
