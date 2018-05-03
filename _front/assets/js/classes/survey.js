import $ from 'jquery'
import trans from './trans'

export default class Survey {

  static form (id = null) {
    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('backend/survey/form'),
      data: {id: id}
    }, {
      form: {
        action: window.chmSite.url('backend/survey/store'),
        callback: 'chmForm.submit',
        class: 'chm-simple-form'
      },
      footer: {
        label: (id === null) ? trans("Créer") : trans("Mettre à jour")
      },
      width: 400
    })
  }

  static show (id) {
    window.chmModal.show({type: 'GET', url: window.chmSite.url('backend/survey/' + id + '/show')})
  }

  static delete (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('backend/survey/' + params.id + '/delete'),
      data: params
    }, {
      onSuccess: (response) => {
        window.chmTable.refresh($('#surveysTable'), {scrollTo: true})
        window['chmAlert'][response.status](response.message)
      }
    })
  }

  static send (event, candIds) {
    event.preventDefault()
    window.chmModal.show({
      type: 'POST',
      url: 'backend/survey/send',
      data: {candIds: candIds}
    }, {
      form: {
        action: 'backend/survey/send',
        callback: 'chmForm.submit',
        class: 'chm-simple-form'
      },
      footer: {
        label: trans("Envoyer")
      },
      width: 400
    })
  }

}
