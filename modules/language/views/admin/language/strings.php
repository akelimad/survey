<?php
use Modules\Language\Models\Language;
use App\Helpers\Table;
use App\Form;
?>

<style>
.pagination-wrap {
  margin-top: 5px;
}  
.form-group {
  margin-bottom: 0px;
}
th.actions, td.actions {
  width: 20px !important;
  text-align: center;
}
</style>

<h1 style="display: inline;text-transform: uppercase;"><?php trans_e('Traductions des phrases'); ?></h1>

<div class="pull-right">
  <a href="javascript:void(0)" class="btn btn-success btn-xs" title="<?php trans_e("Importer les traductions à partir de d'un fichier CSV") ?>" onclick="Language.import()"><i class="fa fa-download"></i>&nbsp;<?php trans_e("Importer les traductions") ?></a>

  <a href="javascript:void(0)" class="btn btn-primary btn-xs" title="<?php trans_e("Scanner le code pour trouver les nouvelles phrases ajoutées.") ?>" onclick="Language.scan()"><i class="fa fa-search"></i>&nbsp;<?php trans_e("Scanner le code") ?></a>
</div>

<div class="panel panel-default mt-10 mb-10">
  <div class="panel-body">
    <form method="GET" action="" id="transFilterForm">
      <input type="hidden" name="page" value="1">
      <div class="col-md-4 pl-0 pl-xs-15">
        <div class="form-group mb-0">
          <label for="keywords"><?php trans_e("Rechercher par mot clé") ?></label>
          <input type="text" value="<?= (isset($_GET['s'])) ? $_GET['s'] : ''; ?>" name="s" id="keywords" style="width:100%;">
        </div>
      </div>
      <div class="col-md-3 pl-0 pl-xs-15">
        <?= \App\Form::select(
          'lang', trans("Langues"), 
          null,
          Language::getActiveLanguages(),
          [
            'style' => 'width:100%; height: 23px;cursor: pointer;', 
            'class' => ''
          ]
        ); ?>
      </div>
      <div class="col-md-2 pl-0 pl-xs-15">
        <?= Form::select('status', trans("Statut"), null, ['', 'Traduit', 'Non traduit'], ['style' => 'width:100%; height: 23px;', 'required', 'class' => '']); ?>
      </div>
      <div class="col-md-3 pl-0 pl-xs-15">
        <div style="margin-top: 22px;">
          <button type="submit" class="btn btn-primary btn-xs pull-left" style="margin-right: 5px;"><?php trans_e("Rechercher") ?></button>
          <button type="button" class="btn btn-danger btn-xs" id="resetFilter"><?php trans_e("Réinitialiser") ?></button>
          <a href="javascript:void(0)" class="btn btn-info btn-xs" id="exportTrans" title="<?php trans_e("Exporter les résultats de recherche") ?>" onclick="Language.export()"><i class="fa fa-upload"></i>&nbsp;<?php trans_e("Exporter") ?></a>
        </div>
      </div>
    </form>
  </div> 
</div>

<div chm-table="backend/language/strings/table" chm-table-params="<?= htmlentities(json_encode($_GET)) ?>" id="stringsTable"></div>

<script>
$(document).ready(function () {
  $('body').on('change', '.trans_value', function (event) {
    if ($(this).val() != $(this).data('ov')) {
      $(this).css('border', '1px solid #F44336')
      $(this).data('ov', $(this).val())
    }
  })

  $('#resetFilter').click(function () {
    chmUrl.eraseAllParams()
    $('input').val('')
    $('select').prop('selectedIndex', 0)
    filterForm()
  })

  $('#transFilterForm').submit(function (event) {
    event.preventDefault()
    filterForm()
  })

  $('input, select').change(function() {
    filterForm()
  })

  $('#stringsTable').on('chmTableSuccess', function (event) {
    canExportTrans(event.target)
  })
})


var filterForm = function () {
  var keywords = $('[name="s"]').val()
  var lang     = $('[name="lang"] option:selected').val()
  var status   = $('[name="status"] option:selected').val()
  var tableParams = chmTable.getTableParams($('#stringsTable'))
  
  tableParams.page = 1
  tableParams.s = keywords
  tableParams.lang = lang
  tableParams.status = status

  chmTable.setTableParams($('#stringsTable'), tableParams)

  chmUrl.setParam('page', 1)
  chmUrl.setParam('s', keywords)
  chmUrl.setParam('lang', lang)
  chmUrl.setParam('status', status)

  chmTable.refresh('#stringsTable', tableParams)
}

var canExportTrans = function (target) {
  if ($(target).find('table>tbody>tr:not(.emptyRow)').length == 0) {
    $('#exportTrans').addClass('disabled')
  } else {
    $('#exportTrans').removeClass('disabled')
  }
}
</script>