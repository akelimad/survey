import $ from 'jquery'
import trans from './trans'

export default class Group {

  static form (sid, gid = null) {
    window.chmModal.show({
      type: 'GET',
      url: window.chmSite.url('backend/survey/' + sid + '/group/form'),
      data: {
        sid: sid,
        gid: gid
      }
    }, {
      form: {
        action: window.chmSite.url('backend/survey/' + sid + '/group/store'),
        callback: 'chmForm.submit',
        class: 'chm-simple-form'
      },
      footer: {
        label: (gid === null) ? trans("Créer") : trans("Mettre à jour")
      },
      width: 400
    })
  }

  static delete (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('backend/survey/' + params.sid + '/group/' + params.gid + '/delete'),
      data: params
    }, {
      onSuccess: (response) => {
        window.chmTable.refresh($('#groupsTable'), {scrollTo: true})
        window['chmAlert'][response.status](response.message)
      }
    })
  }

}
