import $ from 'jquery'

var transStrings = []

export default function trans (msgid) {
  if (window.Object.keys(transStrings).length === 0) {
    $.get('language/api/strings', function (response) {
      transStrings = $.parseJSON(response)
    })
  } else if (msgid in transStrings) {
    return transStrings[msgid]
  } else {
    return msgid
  }
}

export function getTrans (callback) {
  $.get('language/api/strings', function (response) {
    callback($.parseJSON(response))
  })
}

trans('msgid')
