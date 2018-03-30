export default class chmFormation {

  static getForm (id = null) {
    var url = (id === null) ? 'candidat/cv/formation' : 'candidat/cv/formation/' + id
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url(url),
      data: {
        id: id
      }
    }, {
      form: {
        action: window.chmSite.url('candidat/cv/formation/store'),
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
      url: window.chmSite.url('candidat/cv/formation/' + params.id + '/delete')
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        window['chmAlert'][response.status](response.message)
        window.chmTable.refresh(document.querySelector('#formationsTableContainer'))
      }
    })
  }

  static deleteDiplome (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/cv/formation/delete-diplome-copy'),
      data: params
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: (response) => {
        this.getForm(params.id)
        window.chmTable.refresh(document.querySelector('#formationsTableContainer'))
      }
    })
  }

}
