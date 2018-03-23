<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="school" class="form-label mt-0">Nom de l'école&nbsp;<span style="color: red">*</span></label>
      <select name="school" class="form-control mb-0" id="school" required>
        <option value=""></option>
        <?php
        $ecolesPays = getDB()->prepare("SELECT distinct p.id_pays, p.pays FROM `prm_ecoles` e JOIN prm_pays p ON p.id_pays=e.id_pays");
        foreach ($ecolesPays as $key => $ep) :
        ?>
        <optgroup label="<?= $ep->pays; ?>">
          <?php $prmEcoles = getDB()->prepare("SELECT * FROM `prm_ecoles` WHERE id_pays=?", [$ep->id_pays]);
          foreach ($prmEcoles as $key => $ecole) : ?>
            <option value="<?= $ecole->id_ecole ?>"><?= $ecole->nom_ecole ?></option>
          <?php endforeach; ?>
        </optgroup‏>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="stage_type" class="form-label mt-0">Type de stage&nbsp;<span style="color: red">*</span></label>
      <select id="stage_type" name="stage_type" class="form-control" required>
        <option value=""></option>
        <?php foreach (getDB()->read('prm_type_stage') as $key => $value) : ?>
          <option value="<?= $value->id_tstage ?>"><?= ucfirst($value->n_type_stage) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="direction" class="form-label mt-0">Direction demandée&nbsp;<span style="color: red">*</span></label>
      <select id="direction" name="direction" class="form-control" required>
        <option value=""></option>
        <?php foreach (getDB()->read('prm_direction_stage') as $key => $value) : ?>
          <option value="<?= $value->id_prm_stage ?>"><?= $value->nom_direction ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="duree" class="form-label mt-0">Durée du stage&nbsp;<span style="color: red">*</span></label>
      <select id="duree" name="duree" class="form-control" required>
        <option value=""></option>
        <?php foreach (getDB()->read('prm_duree_stage') as $key => $value) : ?>
          <option value="<?= $value->id_duree ?>"><?= $value->nom_duree ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="stage_subject" class="form-label mt-0">Objet du stage&nbsp;<span style="color: red">*</span></label>
  <textarea name="stage_subject" class="ckeditor form-control" id="stage_subject" required></textarea>
</div>

<div class="form-group">
  <label for="motivation" class="form-label mt-0">Vos motivations&nbsp;<span style="color: red">*</span></label>
  <textarea name="motivation" class="ckeditor form-control" id="motivation" required></textarea>
</div>

<div class="mt-10">
  <?php get_alert('warning', 'P.S: les champs marqu&eacute;s par (*) sont obligatoires', false) ?>
</div>

<script>
jQuery(document).ready(function(){

  // editors
  CKEDITOR.replace('stage_subject', {height: 100});
  CKEDITOR.replace('motivation', {height: 150});

})
</script>