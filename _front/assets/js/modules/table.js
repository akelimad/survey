/**
 * chmTable
 *
 * How to use this class
 *
 | <div
 |   chm-table="route/table"
 |   chm-table-options='{"with_ajax": false}'
 |   chm-table-params='{"id": 10, "name": "John Doe"}'
 |   id="testTableContainer"
 | ></div>
 *
 */
import $ from 'jquery'
import trans from './../classes/trans'

export default class chmTable {

  static render (target, params = {}) {
    // Store self class object to use it inside Ajax
    var self = this

    // Get Table route
    var route = $(target).attr('chm-table')
    if (route === '') return

    // Prepare Table params
    params = $.extend({}, {page: 1, scrollTo: false}, params)

    // Decrease Table opacity while loading
    if ($(target).find('table').length === 0) {
      self.fill(target, '<i class="fa fa-circle-o-notch fa-spin fast-spin"></i>&nbsp;' + trans("Chargement de la table en cours..."), params.scrollTo)
    } else {
      $(target).css('opacity', '0.3')
    }

    // Fire Ajax action
    $.get(route, params).done(function (response, textStatus, jqXHR) {
      try {
        // Transform response to JSON if type is string
        if (typeof response === 'string') {
          response = $.parseJSON(response)
        }
        // Fill the Table container with new rendred HTML
        if (response.status === 'success') {
          self.fill(target, response.content, params.scrollTo)
        } else {
          self.fill(target, '<strong>' + trans("Une erreur est survenue lors de chargement de la table.") + '</strong>', params.scrollTo)
        }
        $(target).trigger('chmTableSuccess', response)
      } catch (e) {
        // Show error message
        self.fill(target, '<strong>' + e.message + '</strong>', params.scrollTo)
        $(target).trigger('chmTableError', e.message)
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      var message = jqXHR.status + ' - ' + jqXHR.statusText
      self.fill(target, '<strong>' + message + '</strong>', params.scrollTo)
      $(target).trigger('chmTableError', message)
    })
  }

  static refresh (target, params = {}) {
    // Prepare params array
    if (!('page' in params)) {
      params.page = window.chmUrl.getParam('page', 1)
    }
    if (!('scrollTo' in params)) params.scrollTo = false

    params = $.extend({}, this.getTableParams(target), params)

    this.render(target, params)
  }

  static fill (target, content, scrollTo = false) {
    $(target).empty().html(content).css('opacity', '1')
    if (scrollTo) {
      $('html, body').animate({
        scrollTop: $(target).offset().top
      }, 2000)
    }
  }

  static getTableParams (target) {
    var params = {}
    if ($(target).attr('chm-table-params') !== undefined) {
      try {
        params = $.parseJSON($(target).attr('chm-table-params'))
      } catch (e) {
        window.chmAlert.warning(trans("Le format de JSON donné n'est pas correct."))
      }
    }
    return params
  }

  static setTableParams (target, params) {
    $(target).attr('chm-table-params', JSON.stringify(params))
  }

}

// Initialise tables
$(document).ready(function () {
  // Select all Tables occurences
  var chmTables = document.querySelectorAll('[chm-table]')
  if (chmTables.length === 0) return

  // Get current page
  var page = window.chmUrl.getParam('page', 1)

  // Loop for each Table
  for (var i = 0; i < chmTables.length; ++i) {
    var params = chmTable.getTableParams($(chmTables[i]))
    params.page = page

    // Render Table HTML
    chmTable.render(chmTables[i], params)

    // Prepare Table options
    var options = {with_ajax: true}
    var tableOptions = $(chmTables[i]).attr('chm-table-options')
    if (tableOptions !== undefined) {
      options = $.extend({}, options, $.parseJSON(tableOptions))
    }

    // Ajaxify the Table
    if (options.with_ajax) {
      var $paginationLink = '#' + $(chmTables[i]).attr('id') + ' .pagination > li > a'
      $('body').on('click', $paginationLink, function (event) {
        event.preventDefault()
        if ($(this).attr('href') !== undefined && !$(this).closest('li').hasClass('active')) {
          var $tableContainer = $(this).closest('[chm-table]')
          // Get clicked url page number
          var pageNumber = window.chmUrl.getParam('page', 1, $(this).attr('href'))

          // Change page value on the current url
          window.chmUrl.setParam('page', pageNumber)

          // Update params page number
          params = chmTable.getTableParams($tableContainer)
          params.page = pageNumber

          // Refresh Table content
          chmTable.render($tableContainer, params)
        }
      })
    }
  }
})
