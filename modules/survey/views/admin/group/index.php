<?php
use Modules\Survey\Models\Group;
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
</style>

<h1 style="display: inline;text-transform: uppercase;"><?php trans_e('groupes'); ?></h1>
<div class="pull-right">
  <a href="javascript:void(0)" class="btn btn-primary btn-xs" title="<?php trans_e("Nouveau groupe") ?>" onclick="Group.form(<?= $sid ?>)"><i class="fa fa-plus"></i>&nbsp;<?php trans_e("Ajouter") ?></a>
</div>

<div class="panel panel-default mt-10 mb-10">
  <div class="panel-body">
    <form method="GET" action="">
      <input type="hidden" name="page" value="1">
      <div class="col-md-4 pl-0 pl-xs-15">
        <div class="form-group mb-0">
          <label for="keywords"><?php trans_e("Rechercher par mot clé") ?></label>
          <input type="text" value="<?= (isset($_GET['g'])) ? $_GET['g'] : ''; ?>" name="g" id="keywords" style="width:100%;">
        </div>
      </div>
      <div class="col-md-3 pl-0 pl-xs-15">
        <div style="margin-top: 22px;">
          <button type="submit" class="btn btn-primary btn-xs pull-left" style="margin-right: 5px;"><?php trans_e("Rechercher") ?></button>
          <a href="<?= site_url('backend/survey/'. $sid .'/group/index') ?>" class="btn btn-danger btn-xs"><?php trans_e("Réinitialiser") ?></a>
        </div>
      </div>
    </form>
  </div> 
</div>

<div chm-table="backend/survey/<?= $sid ?>/group/table" chm-table-params="<?= htmlentities(json_encode($_GET)) ?>" id="groupsTable"></div>
