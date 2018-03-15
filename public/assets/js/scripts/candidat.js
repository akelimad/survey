import $ from 'jquery'

$(document).ready(function () {
  // birthday
  $('body').on('change', '#candidat_date_n', function () {
    if (!$(this).val().startsWith(0)) {
      var maxDate = new Date(new Date().setFullYear(new Date().getFullYear() - 16))
      var dateN = new Date($(this).val())
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
    var dateFin = row.find('[id$="date_fin"]').val()
    if (!dateFin.startsWith(0) && dateFin !== '' && dateDebut !== '') {
      var dateD = new Date(dateDebut)
      var dateF = new Date(dateFin)
      if (dateF <= dateD) {
        row.find('[id$="date_fin"]').val('')
        window.chmAlert.danger('La date de fin doit être supérieur à date de début.')
      }
    } else if (!dateDebut.startsWith(0) && dateDebut !== '') {
      dateD = new Date(dateDebut)
      var dateN = new Date($('#candidat_date_n').val())
      if (dateN <= dateD) {
        row.find('[id$="date_debut"]').val('')
        window.chmAlert.danger('La date de fin doit être supérieur à date de naissance.')
      }
    }
  })

  // set deal_code
  $('body').on('change', '#candidat_pays', function () {
    var codeFormated = ''
    var code = $(this).find('option:selected').data('code')
    if (code !== '') codeFormated = '(+' + code + ')'
    $('.deal_code').val(codeFormated)
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
    var dateFin = $(this).closest('.col-sm-8').find('[type="date"]')
    if ($(this).is(':checked')) {
      $(dateFin).hide()
      $(dateFin).val('')
      if ($(this).is('#forma_today') || $(this).is('#exp_today')) {
        $(dateFin).prop('required', false)
      }
    } else {
      $(dateFin).show()
      if ($(this).is('#forma_today') || $(this).is('#exp_today')) {
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
