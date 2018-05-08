// require modules assets
/* function requireAll (r) {
  r.keys().forEach(r)
}
requireAll(require.context('./../../../modules/language/assets/js/', true, /\.js$/))

var glob = require('glob')

function toObject (paths) {
  var ret = {}

  paths.forEach(function (path) {
    // you can define entry names mapped to [name] here
    ret[path.split('/').slice(-1)[0]] = path
  })

  return ret
}

var files = toObject(glob.sync('./../../../modules/language/assets/js/*.js*'))

console.log(files) */

// require('./../../../modules/language/assets/js/language.js')

// import Language from './../../../modules/language/assets/js/language.js'

// console.log(Language.hello())

import Language from './classes/language'
import Survey from './classes/survey'
import Group from './classes/group'
import Question from './classes/question'

window.Language = Language
window.Survey = Survey
window.Group = Group
window.Question = Question
