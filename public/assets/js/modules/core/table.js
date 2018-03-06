import $ from 'jquery'

/**
 * chmTable
 * <div
  chm-table="route/table"
  chm-table-options='{"with_ajax": false}'
  id="testTableContainer"
  ></div>
 */
export default class chmTable {

  static render (target, page = 1, scrollTo = false) {
    var self = this
    var route = $(target).attr('chm-table')
    if (route === '') return
    self.fill(target, '<i class="fa fa-circle-o-notch fa-spin fast-spin"></i>&nbsp;Chargement de la table en cours...', scrollTo)
    $.ajax({
      type: 'GET',
      url: route,
      data: {page: page}
    }).done(function (response, textStatus, jqXHR) {
      try {
        response = $.parseJSON(response)
        if (response.status === 'success') {
          self.fill(target, response.content, scrollTo)
        } else {
          self.fill(target, '<strong>Une erreur est survenue lors de chargement de la table.</strong>', scrollTo)
        }
      } catch (e) {
        self.fill(target, '<strong>' + e.message + '</strong>', scrollTo)
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      self.fill(target, '<strong>' + jqXHR.status + ' - ' + jqXHR.statusText + '</strong>', scrollTo)
    })
  }

  static refresh (target, page = null, scrollTo = false) {
    if (page === null) {
      page = window.chmUrl.getParam('page', 1)
    }
    this.render(target, page, scrollTo)
  }

  static fill (target, content, scrollTo = false) {
    $(target).empty().html(content)
    if (scrollTo) {
      $('html, body').animate({
        scrollTop: $(target).offset().top
      }, 2000)
    }
  }

}

// Initialise tables
$(document).ready(function () {
  var chmTables = document.querySelectorAll('[chm-table]')
  if (chmTables.length === 0) return
  for (var i = 0; i < chmTables.length; ++i) {
    var page = window.chmUrl.getParam('page', 1)
    chmTable.render(chmTables[i], page)
    var options = {
      with_ajax: true
    }
    var tableOptions = $(chmTables[i]).attr('chm-table-options')
    if (tableOptions !== undefined) {
      options = $.extend(options, JSON.parse(tableOptions))
    }
    // Ajaxify table
    if (options.with_ajax) {
      $('body').on('click', '.pagination > li > a', function (event) {
        event.preventDefault()
        if ($(this).attr('href') !== undefined) {
          var pageNumber = $(this).attr('href').split('page=')[1]
          window.chmUrl.setParam('page', pageNumber)
          chmTable.render($(this).closest('[chm-table]'), pageNumber)
        }
      })
    }
  }
})