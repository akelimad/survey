import $ from 'jquery'

require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/modal')
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/dropdown')
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/collapse')
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/alert')
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/tooltip')
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/popover')

// Modules
import chmSite from './modules/core/site'
import chmUrl from './modules/core/url'
import chmCookie from './modules/core/cookie'
import chmModal from './modules/core/modal'
import chmAlert from './modules/core/alert'
import chmForm from './modules/core/form'
import chmTable from './modules/core/table'
import chmFilter from './modules/core/filter'

import chmOffer from './modules/offer'
import chmAuth from './modules/auth'
import chmCandidat from './modules/candidat'
import chmFormation from './modules/formation'
import chmExperience from './modules/experience'

// Global storage
window.$ = window.jQuery = $

window.chmSite = chmSite
window.chmUrl = chmUrl
window.chmCookie = chmCookie
window.chmModal = chmModal
window.chmAlert = chmAlert
window.chmForm = chmForm
window.chmTable = chmTable
window.chmFilter = chmFilter

window.chmOffer = chmOffer
window.chmAuth = chmAuth
window.chmCandidat = chmCandidat
window.chmFormation = chmFormation
window.chmExperience = chmExperience

// Standart jQuery script
import './custom'
import './scripts/auth'
import './scripts/candidat'
