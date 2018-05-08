import $ from 'jquery'
import trans from './trans'

export default class Question {
  static form (params) {
    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('backend/survey/' + params.sid + '/group/' + params.gid + '/question/form'),
      data: {
        sid: params.sid,
        gid: params.gid,
        qid: params.qid
      }
    }, {
      form: {
        action: window.chmSite.url('backend/survey/' + params.sid + '/group/' + params.gid + '/question/store'),
        callback: 'chmForm.submit',
        class: 'chm-simple-form'
      },
      footer: {
        label: (params.qid === null) ? trans("Créer") : trans("Mettre à jour")
      }
    })
  }

  static delete (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('backend/survey/' + params.sid + '/group/' + params.gid + '/question/' + params.qid + '/delete'),
      data: params
    }, {
      onSuccess: (response) => {
        window.chmTable.refresh($('#questionsTable'), {scrollTo: true})
        window['chmAlert'][response.status](response.message)
      }
    })
  }

}
