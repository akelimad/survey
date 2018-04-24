import $ from 'jquery'

export default class chmJobAlerts {

  static form (id = null) {
    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('candidat/account/alert/form'),
      data: {id: id}
    }, {
      form: {
        action: window.chmSite.url('candidat/account/alert/form'),
        callback: 'window.chmForm.submit',
        class: 'chm-simple-form'
      },
      footer: {
        label: (id === null) ? 'Créer' : 'Mettre à jour'
      },
      width: 400
    })
  }

  static activate (id, curStatus) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/account/alert/activate'),
      data: {id: id, curStatus: curStatus}
    }, {
      onSuccess: (response) => {
        window.chmTable.refresh($('#alertsTable'), {scrollTo: true})
        window['chmAlert'][response.status](response.message)
      }
    })
  }

  static delete (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('candidat/account/alert/delete'),
      data: params
    }, {
      onSuccess: (response) => {
        window.chmTable.refresh($('#alertsTable'), {scrollTo: true})
        window['chmAlert'][response.status](response.message)
      }
    })
  }

}
