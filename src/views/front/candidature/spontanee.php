<?php if (App\Form::getFieldOption('displayed', 'register', 'id_fonc') && get_setting('candidature.spontanee.show_fonction_field', 0) == 1) : ?>
<label for="id_fonc" class="form-label mt-0"><?php trans_e("Fonction"); ?>&nbsp;<span style="color: red">*</span></label>
<select id="id_fonc" name="id_fonc" class="form-control" required>
  <option value=""></option>
  <?php foreach (getdB()->read('prm_fonctions') as $key => $value) : ?>
    <option value="<?= $value->id_fonc ?>"><?= $value->fonction ?></option>
  <?php endforeach; ?>
</select>
<?php endif; ?>

<label for="id_cv" class="form-label mt-0"><?php trans_e("Choisissez un CV"); ?>&nbsp;<span style="color: red">*</span></label>
<select id="id_cv" name="id_cv" class="form-control" required>
  <option value=""></option>
  <?php foreach (\App\Models\Resume::getByCandidatId() as $key => $value) : ?>
    <option value="<?= $value->id_cv ?>"><?= $value->titre_cv ?></option>
  <?php endforeach; ?>
</select>

<label for="motivation" class="form-label mt-0"><?php trans_e("Vos motivations"); ?>&nbsp;<span style="color: red">*</span></label>
<textarea name="motivation" class="ckeditor form-control" id="motivation" required></textarea>

<div class="mt-10">
  <?php get_alert('warning', trans("P.S: les champs marqués par (*) sont obligatoires"), false) ?>
</div>

<script>
jQuery(document).ready(function(){

  // editors
  CKEDITOR.replace('motivation', {height: 200});

  <?php if (get_setting('candidature.spontanee.show_alert', 0) == 1) : ?>
  $('body').on('chmFormSuccess', '#candidature-spontanee', function (event, response) {
    if (response.status == 'success') {
      setTimeout(function() {
        chmModal.alert('', "<?php trans_e("Pensez à créer une alerte emploi"); ?>", {width:250})
      }, 200)
    }
  })
  <?php endif; ?>

})
</script>