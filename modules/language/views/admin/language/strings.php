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
  <a href="javascript:void(0)" class="btn btn-primary btn-xs" title="<?php trans_e("Scanner le code pour les nouvelles phrases ajoutées.") ?>" onclick="Language.scan()"><i class="fa fa-search"></i>&nbsp;<?php trans_e("Scanner le code") ?></a>
</div>

<div class="panel panel-default mt-10 mb-10">
  <div class="panel-body">
    <form method="GET" action="">
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
            'style' => 'width:100%; height: 23px;cursor: pointer;'
          ]
        ); ?>
      </div>
      <div class="col-md-2 pl-0 pl-xs-15">
        <?= Form::select('status', trans("Statut"), null, ['', 'Traduit', 'Non traduit'], ['style' => 'width:100%; height: 23px;', 'required']); ?>
      </div>
      <div class="col-md-3 pl-0 pl-xs-15">
        <div style="margin-top: 22px;">
          <button type="submit" class="btn btn-primary btn-xs pull-left" style="margin-right: 5px;"><?php trans_e("Rechercher") ?></button>
          <button type="reset" class="btn btn-danger btn-xs"><?php trans_e("Réinitialiser") ?></button>
        </div>
      </div>
    </form>
  </div> 
</div>

<div chm-table="backend/language/strings/table" chm-table-params="<?= htmlentities(json_encode($_GET)) ?>" id="stringsTable"></div>

<script>
$('body').on('change', '.trans_value', function (event) {
  if ($(this).val() != $(this).data('ov')) {
    $(this).css('border', '1px solid #F44336')
    $(this).data('ov', $(this).val())
  }
})

$('[name="lang"]').change(function () {
  chmUrl.setParam('lang', $(this).val())
  chmTable.refresh('#stringsTable', {lang: $(this).val()})
})

$('[type="reset"]').click(function () {
  chmUrl.eraseAllParams()
  $('form')[0].reset()
  chmTable.refresh('#stringsTable', {
    lang: chmUrl.getParam('lang', $('[name="lang"]').val())
  })
})

$('form').submit(function (event) {
  event.preventDefault()
  filterForm()
})

var filterForm = function () {
  var keywords = $('[name="s"]').val()
  var lang     = $('[name="lang"]').val()
  var status   = $('[name="status"]').val()

  chmUrl.setParam('s', keywords)
  chmUrl.setParam('lang', lang)
  chmUrl.setParam('status', status)

  chmTable.refresh('#stringsTable', {
    s: keywords,
    lang: lang,
    status: status
  })
}
</script>