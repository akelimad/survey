<?php
use \Modules\Language\Models\Language;
use \App\Helpers\Table;
?>

<style>
.pagination-wrap {
  margin-top: 5px;
}  
</style>

<h1 style="display: inline;text-transform: uppercase;"><?php trans_e('Traductions des phrases'); ?></h1>

<div class="pull-right">
  <a href="javascript:void(0)" class="btn btn-primary btn-xs" title="<?php trans_e("Scanner le code pour les nouvelles phrases ajoutées.") ?>" onclick="Language.scan()"><i class="fa fa-search"></i>&nbsp;<?php trans_e("Scanner le code") ?></a>
</div>

<div class="panel panel-default mt-10 mb-10">
  <div class="panel-body">
    <form method="GET" action="">
      <input type="hidden" name="page" value="<?= Table::getPage(); ?>">
      <div class="col-md-4 pl-0 pl-xs-15">
        <div class="form-group mb-0">
          <label for="keywords">Rechercher par mot clé</label>
          <input type="text" name="s" id="keywords" style="width:100%;">
        </div>
      </div>
      <div class="col-md-3 pl-0 pl-xs-15">
        <div class="form-group mb-0">
          <label for="lang">Langues</label>
          <select id="lang" name="lang" style="width:100%; height: 23px;">
            <?php foreach (Language::findAll() as $key => $lang) : 
              $selected = '';
              if (!isset($_GET['lang'])) {
                if ($lang->default_lang == 1) {
                  $selected = 'selected';
                }
              } else if ($_GET['lang'] == $lang->iso_code) {
                $selected = 'selected';
              }
            ?>
              <option value="<?= $lang->iso_code ?>" <?= $selected; ?>><?= $lang->name ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-2 pl-0 pl-xs-15">
        <div class="form-group mb-0">
          <label for="status">Statut</label>
          <select id="status" name="status" style="width:100%; height: 23px;">
            <option value=""></option>
            <option value="1">Traduit</option>
            <option value="2">Non traduit</option>
          </select>
        </div>
      </div>
      <div class="col-md-3 pl-0 pl-xs-15">
        <div style="margin-top: 22px;">
          <button type="submit" class="btn btn-primary btn-xs pull-left" style="margin-right: 5px;">Rechercher</button>
          <a href="<?= site_url('backend/language/strings') ?>" class="btn btn-danger btn-xs">Réinitialiser</a>
        </div>
      </div>
    </form>
  </div> 
</div>

<div chm-table="backend/language/strings/table" id="stringsTable"></div>

<script>
$('body').on('click', '.save_trans', function (event) {
  event.preventDefault()

  var $input = $(this).closest('tr').find('input')
  var sid = $input.data('sid')
  var iso_code = $('[name="lang"]').val()
  var value = $input.val()

  Language.store(this, sid, iso_code, value)
})

$('body').on('change', '.trans_value', function (event) {
  if ($(this).val() != $(this).data('ov')) {
    $(this).css('border', '1px solid #F44336')
    $(this).data('ov', $(this).val())
  }
})
</script>