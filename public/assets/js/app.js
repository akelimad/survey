import $ from 'jquery'

require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/modal')
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/dropdown')
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/collapse')
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/alert')
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/tooltip')
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/popover')

// Modules
import chmSite from './modules/site'
import chmUrl from './modules/url'
import chmCookie from './modules/cookie'
import chmModal from './modules/modal'
import chmFilter from './modules/filter'
import chmAlert from './modules/alert'
import chmForm from './modules/form'
import chmOffer from './modules/offer'

// Global storage
window.$ = window.jQuery = $
window.chmSite = chmSite
window.chmUrl = chmUrl
window.chmCookie = chmCookie
window.chmForm = chmForm
window.chmModal = chmModal
window.chmAlert = chmAlert
window.chmFilter = chmFilter
window.chmOffer = chmOffer

// Standart jQuery script
import './custom'
