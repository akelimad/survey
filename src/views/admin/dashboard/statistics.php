<style type="text/css">
.panel-heading {
  padding: 5px 8px 5px;
  font-size: 14px !important;
}  

.dual-gear-loading{
  width: 30px;
  position: absolute;
  top: 46%;
  left: 45%;
}

.panel-body{
  min-height: 300px !important;
}
</style>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading"><?php trans_e("Nombre des candidats par secteurs d'activités"); ?></div>
      <div class="panel-body">
        <div id="sector-chart" class="shart_wrap">
          <img src="<?= site_url('modules/candidatures/assets/img/loading.gif'); ?>" class="dual-gear-loading">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading"><?php trans_e("Nombre des candidats par pays de résidence"); ?></div>
      <div class="panel-body">
        <div id="residence-country-chart" class="shart_wrap">
          <img src="<?= site_url('modules/candidatures/assets/img/loading.gif'); ?>" class="dual-gear-loading">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading"><?php trans_e("Nombre des candidats par situation"); ?></div>
      <div class="panel-body">
        <div id="situation-chart" class="shart_wrap">
          <img src="<?= site_url('modules/candidatures/assets/img/loading.gif'); ?>" class="dual-gear-loading">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading"><?php trans_e("Nombre des candidats par expérience"); ?></div>
      <div class="panel-body">
        <div id="experience-chart" class="shart_wrap">
          <img src="<?= site_url('modules/candidatures/assets/img/loading.gif'); ?>" class="dual-gear-loading">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading"><?php trans_e("Nombre des Candidatures par statut"); ?></div>
      <div class="panel-body">
        <div id="candidatures-status-chart" class="shart_wrap">
          <img src="<?= site_url('modules/candidatures/assets/img/loading.gif'); ?>" class="dual-gear-loading">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading"><?php trans_e("Nombre des Offres par statut"); ?></div>
      <div class="panel-body">
        <div id="offers-status-chart" class="shart_wrap">
          <img src="<?= site_url('modules/candidatures/assets/img/loading.gif'); ?>" class="dual-gear-loading">
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
jQuery(document).ready(function () {

  // Charts params
  var charts = [
    {
      container:'sector-chart',
      url:'dashboard/chart/sector',
      type: 'donut',
      options: {
        pieHole: 0.4
      }
    },
    {
      container:'residence-country-chart',
      url:'dashboard/chart/residence-country'
    },
    {
      container:'situation-chart',
      url:'dashboard/chart/situation',
      type:'bar',
      options: {
        legend: {
          position: 'none'
        }
      }
    },
    {
      container:'experience-chart',
      url:'dashboard/chart/experience',
      type: 'donut',
      options: {
        pieHole: 0.4
      }
    },
    {
      container:'offers-status-chart',
      url:'dashboard/chart/offers-status',
      type:'bar',
      options: {
        legend: {
          position: 'none'
        }
      }
    },
    {
      container:'candidatures-status-chart',
      url:'dashboard/chart/candidatures-status'
    }
  ]

  var charts_params = []
  $.each(charts, function (k, v) {
    var _params = {
      container: v.container, 
      type:'pie',
      url: v.url,
      options: {
        legend:{
          position: 'right', 
          textStyle: {color: 'black', fontSize: 10},
          alignment:'automatic'
        }
      }
    }
    _params = $.extend({}, _params, v)

    charts_params[k] = _params
  })

  setTimeout(function(){
    draw_chart_loop(charts_params, 0)
  }, 1000)

})


/**
 * Loop for charts
 *
 * @param object charts
 * @param int current
 *
 * @return void
 */
function draw_chart_loop(charts, current) {
  var next = current + 1
  var params = charts[current]
  var ajax_data = {}
  ajax_data.action = params.action || ''
  if( typeof params.data != 'undefined' ) {
    $.each(params.data, function(k, v){
      ajax_data[k] = v
    })
  }

  return ajax_draw_chart(ajax_data, params).then(function(data){
    if( typeof charts[next] != 'undefined' ) {
      return draw_chart_loop(charts, next)
    }
  });
}

/**
 * Get Chart data
 *
 * @param object ajax_data
 * @return ajax_object
 */
function ajax_draw_chart(ajax_data, params) {
  $request = $.ajax({
    url: site_url(params.url),
    method: 'POST',
    data: ajax_data,
    dataType: "json",
    async: false,
    delay: 5
  });

  // Callback handler that will be called on success
  $request.done(function (data, textStatus, jqXHR){
      try {
        draw_chart(data, params)
      } catch (e) {}
  });

  return $request;
}

/**
 * Draw Chart
 *
 * @param object jsonData
 * @param object params
 * @return void
 */
function draw_chart(jsonData, params) {
  params.type = params.type || 'pie';

  // Load the Visualization API and package.
  switch(params.type) {
    case 'pie' :
      google.charts.load('current', {'packages':['corechart']});
    break;
    case 'timeLine' :
      google.charts.load('visualization', '1', {'packages':['annotatedtimeline']});
    break;
    case 'bar' :
      google.charts.load('current', {packages: ['corechart', 'bar']});
    break;
    case 'donut' :
      google.charts.load("current", {packages:["corechart"]});
    break;
  }

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(function() {

    // merging two objects into new object
    var options = {
      width: params.width || $('#'+params.container).closest('.panel-body').width(),
      height: params.height || $('#'+params.container).closest('.panel-body').height()
    }
    var options = jQuery.extend({}, options, params.options);

    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(jsonData);

    // Instantiate and draw our chart, passing in some options.
    switch(params.type) {
      case 'pie' :
        var chart = new google.visualization.PieChart(document.getElementById(params.container));
      break;
      case 'timeLine' :
        var chart = new google.visualization.AnnotatedTimeLine(document.getElementById(params.container));
        options.displayAnnotations = true
      break;
      case 'bar' :
        var chart = new google.visualization.ColumnChart(document.getElementById(params.container));
      break;
      case 'donut' :
        var chart = new google.visualization.PieChart(document.getElementById(params.container));
      break;
    }
    chart.draw(data, options);
  });
}
</script>