<?php
use Modules\Survey\Models\Survey;
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
td.actions{
  width: 160px
}
td.actions a{
  display: inline-block !important;
}
td.actions a.show{
  margin-left: 3px;
}

</style>

<h1 style="display: inline;text-transform: uppercase;"><?php trans_e('questionnaires'); ?></h1>
<div class="pull-right">
  <a href="javascript:void(0)" class="btn btn-primary btn-xs" title="<?php trans_e("Nouveau questionnaire") ?>" onclick="Survey.form()"><i class="fa fa-plus"></i>&nbsp;<?php trans_e("Ajouter") ?></a>
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
        <div style="margin-top: 22px;">
          <button type="submit" class="btn btn-primary btn-xs pull-left" style="margin-right: 5px;"><?php trans_e("Rechercher") ?></button>
          <a href="<?= site_url('backend/survey/index') ?>" class="btn btn-danger btn-xs"><?php trans_e("Réinitialiser") ?></a>
        </div>
      </div>
    </form>
  </div> 
</div>

<div chm-table="backend/survey/table" chm-table-params="<?= htmlentities(json_encode($_GET)) ?>" id="surveysTable"></div>
