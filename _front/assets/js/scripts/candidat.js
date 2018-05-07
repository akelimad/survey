import $ from 'jquery'

$(document).ready(function () {
  // birthday
  $('body').on('change', '#candidat_date_n', function () {
    if (!$(this).val().startsWith(0)) {
      var maxDate = new Date(new Date().setFullYear(new Date().getFullYear() - 16))
      var d = $(this).val().split('/')
      var dateN = new Date(d[2] + '-' + d[1] + '-' + d[0])
      if (dateN > maxDate) {
        $(this).val('')
        window.chmAlert.danger('Votre âge doit être supérieur à 16 ans.')
      }
    }
  })

  // date fin exp et formation
  $('body').on('change', '[id$="date_debut"], [id$="date_fin"]', function () {
    var row = $(this).closest('.row')
    var dateDebut = row.find('[id$="date_debut"]').val()
    var ddParts = dateDebut.split('/')
    dateDebut = ddParts[2] + '-' + ddParts[1] + '-' + ddParts[0]
    var dateFin = row.find('[id$="date_fin"]').val()
    var dfParts = dateFin.split('/')
    dateFin = dfParts[2] + '-' + dfParts[1] + '-' + dfParts[0]
    if (!dateFin.startsWith(0) && dateFin !== '' && dateDebut !== '') {
      var dateD = new Date(dateDebut)
      var dateF = new Date(dateFin)
      if (dateF <= dateD) {
        row.find('[id$="date_fin"]').val('')
        window.chmAlert.danger('La date de fin doit être supérieur à date de début.')
      }
    } else if (!dateDebut.startsWith(0) && dateDebut !== '') {
      dateD = new Date(dateDebut)
      var dateN = $('#candidat_date_n').val()
      var dnParts = dateN.split('/')
      dateN = new Date(dnParts[2] + '-' + dnParts[1] + '-' + dnParts[0])
      if (dateN > dateD) {
        row.find('[id$="date_debut"]').val('')
        window.chmAlert.danger('La date de fin doit être supérieur à date de naissance.')
      }
    }
  })

  // set dial_code
  $('body').on('change', '#candidat_pays', function () {
    var code = $(this).find('option:selected').data('code')
    var dialCode = (code !== undefined) ? code : ''
    $('.dial_code').val(dialCode)
  })

  // mobilite
  $('body').on('change', '[name="candidat[mobilite]"], [name="mobilite"]', function () {
    if ($(this).val() === 'oui') {
      $('#niveau-container, #taux-container').show()
    } else {
      $('#niveau-container, #taux-container').hide()
    }
  })

  // date_fin_today
  $('body').on('change', '.date_fin_today', function () {
    var dateFin = $(this).closest('.col-sm-8').find('[type="text"]')
    if ($(this).is(':checked')) {
      $(dateFin).hide()
      $(dateFin).val('')
      if ($(this).is('.forma_today')) {
        $(dateFin).prop('required', false)
      }
    } else {
      $(dateFin).show()
      if ($(this).is('.forma_today')) {
        $(dateFin).prop('required', true)
      }
    }
  })

  // other languages
  $('body').on('keyup', 'input[id^="candidat_autre"]', function () {
    var select = $(this).next('select')
    if ($(this).val() !== '') {
      $(select).show()
      $(select).prop('required', true)
    } else {
      $(select).prop('required', false)
      $(select).val('')
      $(select).hide()
    }
  })
})
