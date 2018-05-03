import $ from 'jquery'

window.transStrings = []

export default function trans (msgid) {
  if (window.Object.keys(window.transStrings).length === 0) {
    $.get('language/api/strings', function (response) {
      window.transStrings = $.parseJSON(response)
    })
  }

  if (msgid in window.transStrings) {
    return window.transStrings[msgid]
  } else {
    return msgid
  }
}

export function getTrans (callback) {
  $.get('language/api/strings', function (response) {
    callback($.parseJSON(response))
  })
}

// trans('msgid')
