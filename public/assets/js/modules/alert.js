import $ from 'jquery'

export default class chmAlert {

  static createAlert (message, type, timeout) {
    $('.chm-float-alert').alert('close')
    var alert = $('<div class="alert alert-' + type + ' fade in chm-float-alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + message + '&nbsp;&nbsp;</div>')

    $(alert).appendTo('body')

    $(alert).delay(timeout).fadeOut(1000, function () {
      $(this).alert('close')
    })
  }

  static success (message, timeout = 3000) {
    this.createAlert(message, 'success', timeout)
  }

  static info (message, timeout = 3000) {
    this.createAlert(message, 'info', timeout)
  }

  static warning (message, timeout = 3000) {
    this.createAlert(message, 'warning', timeout)
  }

  static danger (message, timeout = 3000) {
    this.createAlert(message, 'danger', timeout)
  }

}
