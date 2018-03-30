import $ from 'jquery'

export default class chmPrint {

  constructor (target, container, title = '') {
    try {
      var self = this
      $(target).hide()
      var $modal = window.chmModal.loading('<i class="fa fa-circle-o-notch"></i>&nbspTraitement en cours...')
      $modal.find('.modal-dialog').css('width', 230)

      window.html2canvas(document.querySelector(container)).then(canvas => {
        $modal.find('.modal-header').hide()
        $modal.find('.modal-content').css('width', 660)
        $modal.find('.modal-body')
          .css('padding', 0)
          .append('<img src="' + canvas.toDataURL() + '">')

        setTimeout(function () {
          window.chmModal.destroy($modal)
          $(target).show()
          self.print($modal.find('.modal-body>img').attr('src'), title)
        }, 500)
      })
    } catch (e) {
      window.chmModal.destroy($modal)
      window.chmAlert.warning(e.message)
      $(target).show()
    }
  }

  print (dataUrl, title) {
    var windowContent = '<!DOCTYPE html>'
    windowContent += '<html>'
    windowContent += '<head><title>' + title + '</title></head>'
    windowContent += '<body>'
    windowContent += '<img src="' + dataUrl + '">'
    windowContent += '</body>'
    windowContent += '</html>'
    var printWin = window.open('', title)
    if (printWin !== null) {
      printWin.document.open()
      printWin.document.write(windowContent)
      printWin.document.close()
      printWin.focus()
      printWin.print()
      printWin.close()
    } else {
      window.chmModal.alert('', 'Vous devez autoriser les fenêtres Pop-up pour imprimer cette page.', {width: 363})
    }
  }

}

// Initialise tables
$(document).ready(function () {
  var $elements = $('[chm-print]')
  if ($elements.length === 0) return
  for (var i = 0; i < $elements.length; ++i) {
    var $container = $($elements[i]).attr('chm-print')
    var title = $($elements[i]).attr('chm-print-title')
    $($elements[i]).click(function (event) {
      event.preventDefault()
      new chmPrint($(this), $container, title)
    })
  }
})
