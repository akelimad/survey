import $ from 'jquery'

$(document).ready(function () {
  // Check all table rows
  $('.chmTable_checkAll').change(function () {
    $('.chmTable_checkAll').not($(this)).prop('checked', $(this).is(':checked'))
    $('.chmTableCB').prop('checked', $(this).is(':checked'))
  })

  $('.chmTableCB').change(function () {
    $('.chmTable_checkAll').prop('checked', ($('.chmTableCB').length === $('.chmTableCB:checked').length))
  })

  $('.chmTableBulkActionsSubmitButton').click(function (event) {
    var selected = $(this).prev('select').find('option:selected')
    if ($(this).closest('form').find('.chmTableCB:checked').length === 0) {
      event.preventDefault()
      window.chmModal.alert('', 'Vous devez choisir au moin une ligne.', { width: 300 })
    } else if (selected.val() === '') {
      event.preventDefault()
      window.chmModal.alert('', 'Vous devez choisir une action.', { width: 300 })
    } else if (selected.data('action') !== 'undefined') {
      event.preventDefault()
      var checked = []
      $('.chmTableCB:checked').each(function (k, v) {
        checked[k] = $(this).val()
      })
      var parts = selected.data('action').split('.')
      if (parts.length === 2) {
        window[parts[0]][parts[1]](checked)
      } else {
        window[parts[0]](checked)
      }
    }
  })

  // calculate action column width
  if ($('th.actions').length > 0) {
    var max = 0
    $('.chmTable>tbody>tr').each(function () {
      var count = $(this).find('td:last-child>a').length
      if (count > max) max = count
    })
    $('th.actions').css('width', (max * 34))
  }

  // bulk send invitations
  $('body').on('submit', '#invitForm', function (event) {
    event.preventDefault()
    $('#sendInvitButton').prop('disabled', true)
    var forumId = $(this).find('select>option:selected').val()
    var cids = $(this).find('[name="cids[]"]')
    if (forumId === '') return
    var candidats = []
    $.each(cids, function (k, v) {
      candidats[k] = $(this).val()
    })
    $('#sendInvitButton').html('<i class="fa fa-circle-o-notch fa-spin fa"></i>&nbsp;Envoi en cours... <span class="badge badge-default">0/' + candidats.length + '</span>')
    window.chmCandidat.sendInvitationLoop(candidats, forumId)
  })

  // Change perpe value
  $('.chmTablePerpage').change(function () {
    var perpage = $(this).val()
    window.chmUrl.setParam('page', 1)
    window.chmUrl.setParam('perpage', perpage)
    window.location.reload()
  })

  // Modal close event
  $('body').on('hidden.bs.modal', '.chm-modal', function () {
    if ($(this).attr('chm-modal-action') === 'reload') {
      window.location.reload()
    } else {
      $(this).data('bs.modal', null)
      $(this).remove()
    }
  })

  // Prevent default on click event
  $('a[onclick]').on('click', function (e) {
    return e.preventDefault()
  })

  // Add new Line
  $('body').on('click', '.addLine', function (event) {
    event.preventDefault()
    var $row = $(this).closest('tr')
    var copy = $row.clone()
    copy.find('button').toggleClass('addLine deleteLine')
    copy.find('button').toggleClass('btn-success btn-danger')
    copy.find('button>i').toggleClass('fa-plus fa-minus')
    $row.find('input').val('')
    $(copy).insertBefore($row)
  })

  // Delete added Line
  $('body').on('click', '.deleteLine', function () {
    $(this).closest('tr').remove()
  })

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', '.file-upload input[type="file"]', function () {
    var input = $(this)
    var numFiles = input.get(0).files ? input.get(0).files.length : 1
    var label = input.val().replace(/\\/g, '/').replace(/.*\//, '')
    input.trigger('fileselect', [numFiles, label])
  })

  // We can watch for our custom `fileselect` event like this
  $(document).ready(function () {
    $(document).on('fileselect', '.file-upload input[type="file"]', function (event, numFiles, label) {
      var input = $(this).parents('.input-group').find(':text')
      var log = numFiles > 1 ? numFiles + ' files selected' : label
      if (input.length) {
        input.val(log)
      }
    })
  })

  getSearchFormPosition()

  // Initialise filter form
  window.chmFilter.init()

  // offer search
  if ($('#chm-offer-search').length > 0) {
    window.chmOffer.renderSearchForm()
  }

  // Select2 jquery plugin show number of selected items in the result instead of tags
  if ($.fn.select2) {
    $('body').on('select2:selecting', 'select[multiple]', function (evt) {
      showNumberOfSelectedItems($(this))
    })
    $('body').on('select2:unselecting', 'select[multiple]', function (evt) {
      showNumberOfSelectedItems($(this))
    })
    $(document).on('DOMNodeInserted', function (e) {
      if ($(e.target).hasClass('select2-selection')) {
        window.setTimeout(function () {
          var $target = $(e.target).closest('.select2-container').prev('select')
          showNumberOfSelectedItems($target)
        })
      }
    })
  }

  // Tooltip
  if ($('[data-toggle="tooltip"]').length > 0) {
    $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'}).on('click', function (event) {
      event.preventDefault()
    })
  }

  // Popover
  if ($('[data-toggle="popover"]').length > 0) {
    $('[data-toggle="popover"]').popover({
      container: 'body',
      html: true,
      content: function () {
        var clone = $($(this).data('popover-content')).clone(true).removeClass('hidden')
        return clone
      }
    }).click(function (event) {
      event.preventDefault()
      $('[data-toggle="popover"]').not(this).popover('hide')
      $('.popover-title>i').remove()
      $('.popover-title').append('<i class="fa fa-times pull-right"></i>')
    })
    $('body').on('click', '.popover-title>i', function () {
      $('[data-toggle="popover"]').popover('hide')
    })
  }
})

function showNumberOfSelectedItems (target) {
  var $ul = $(target).next('span').find('ul')
  $ul.hide()
  window.setTimeout(function () {
    var count = $ul.find('li').length - 1
    switch (count) {
      case 0:
        $ul.empty().hide()
        break
      case 1:
        $ul.empty().html('<li class="count-selected">' + count + ' élément sélectionné</li>')
        $ul.show()
        break
      default:
        $ul.html('<li class="count-selected">' + count + ' éléments sélectionnés</li>')
        $ul.show()
        break
    }
  }, 200)
}

$(window).resize(function () {
  getSearchFormPosition()
})

function getSearchFormPosition () {
  if ($('#topSearchForm').length === 1) {
    $('#topSearchForm').css('right', $('#logo-banner').offset().left + 90)
  }
}
