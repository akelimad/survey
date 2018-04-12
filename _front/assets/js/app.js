import $ from 'jquery'

require('./../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/modal')
require('./../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/dropdown')
require('./../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/collapse')
require('./../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/alert')
require('./../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/tooltip')
require('./../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/popover')

// Modules
import chmSite from './modules/site'
import chmUrl from './modules/url'
import chmCookie from './modules/cookie'
import chmModal from './modules/modal'
import chmAlert from './modules/alert'
import chmForm from './modules/form'
import chmTable from './modules/table'
import chmFilter from './modules/filter'
import chmPrint from './modules/print'

import trans from './classes/trans'
import chmOffer from './classes/offer'
import chmAuth from './classes/auth'
import chmCandidat from './classes/candidat'
import chmCandidature from './classes/candidature'
import chmFormation from './classes/formation'
import chmExperience from './classes/experience'
import chmJobAlerts from './classes/job-alerts'

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
window.chmPrint = chmPrint

window.chmOffer = chmOffer
window.chmAuth = chmAuth
window.chmCandidat = chmCandidat
window.chmCandidature = chmCandidature
window.chmFormation = chmFormation
window.chmExperience = chmExperience
window.chmJobAlerts = chmJobAlerts

window.trans = trans

// Standart jQuery script
import './custom'
import './scripts/auth'
import './scripts/candidat'
