export default class chmCandidat {

  static formationForm (fid = null) {
    var url = (fid === null) ? 'candidat/cv/formation' : 'candidat/cv/formation/' + fid
    window.chmModal.show({
      type: 'POST',
      url: window.chmSite.url(url),
      data: {
        id_formation: fid
      }
    }, {
      form: {
        action: window.chmSite.url(url),
        callback: 'window.chmForm.submit'
      },
      footer: {
        label: (fid === null) ? 'Créer' : 'Mettre à jour'
      }
    })
  }

}
