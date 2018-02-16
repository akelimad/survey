export default class chmOffer {

  static form (idRoleOffre, id = null) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('backend/module/offer/partner/entry'),
      data: {
        id_entry: id,
        id_role_offre: idRoleOffre
      }
    }, {
      form: {
        action: window.chmSite.url('backend/module/offer/partner/store-entry'),
        callback: 'window.chmForm.sumbit',
        enctype: true
      },
      footer: {
        label: (id === null) ? 'Créer' : 'Mettre à jour'
      }
    })
  }

  static deleteEntryAttachement (params) {
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url('backend/module/offer/partner/delete-entry-attachement'),
      data: params
    }, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...',
      onSuccess: {callback: 'chmOffer.form', params: params}
    })
  }

}
