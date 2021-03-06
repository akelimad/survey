<?php
use App\Form;
?>

<input type="hidden" name="id" value="<?= (isset($formation->id_formation)) ? $formation->id_formation : 0 ?>">
<div class="row">
  <div class="col-sm-4 required">
    <label for="forma_date_debut"><?php trans_e("Date de début"); ?></label>
    <?php
    $date_debut = '';
    if (isset($formation->date_debut) && $formation->date_debut != '') {
      $date_debut = (strlen($formation->date_debut) == 7) ? '01/'. $formation->date_debut : $formation->date_debut;
      $date_debut = eta_date($date_debut, 'd/m/Y');
    }
    ?>
    <input type="text" readonly value="<?= $date_debut ?>" class="form-control" id="forma_date_debut" name="date_debut" required>
  </div>
  <div class="col-sm-8 pl-0 pl-xs-15 required">
    <label for="forma_date_fin"><?php trans_e("Date de fin"); ?></label>
    <?php
    $date_fin = '';
    if (isset($formation->date_fin) && $formation->date_fin != '') {
      $date_fin = (strlen($formation->date_fin) == 7) ? '01/'. $formation->date_fin : $formation->date_fin;
      $date_fin = eta_date($date_fin, 'd/m/Y');
    }
    ?>
    <input type="text" readonly value="<?= $date_fin ?>" class="form-control" id="forma_date_fin" name="date_fin" style="max-width: 186px;float: left;margin-right: 10px;<?= (isset($formation->date_fin) && $formation->date_fin == '') ? 'display: none;"' : '" required' ?>>
    <label for="forma_today" style="margin-top: 10px;" class="pointer">
      <input type="checkbox" value="1" class="date_fin_today forma_today" id="forma_today"<?= (isset($formation->date_fin) && $formation->date_fin == '') ? ' checked' : '' ?>>&nbsp;<?php trans_e("Jusqu'à aujourd'hui"); ?>
    </label>
  </div>
</div>
<div class="row">
  <div class="col-sm-4 required">
    <label for="forma_ecol"><?php trans_e("École ou établissement"); ?></label>
    <select id="forma_ecol" name="id_ecol" class="form-control" required>
      <option value=""></option>
      <?php
      $ecolesPays = getDB()->prepare("SELECT distinct p.id_pays, p.pays FROM `prm_ecoles` e JOIN prm_pays p ON p.id_pays=e.id_pays");
      foreach ($ecolesPays as $key => $ep) :
      ?>
      <optgroup label="<?= $ep->pays; ?>">
        <?php $prmEcoles = getDB()->prepare("SELECT * FROM `prm_ecoles` WHERE id_pays=?", [$ep->id_pays]);
        foreach ($prmEcoles as $key => $ecole) :
          $selected = (isset($formation->id_ecol) && $formation->id_ecol == $ecole->id_ecole) ? 'selected' : '';
        ?>
          <option value="<?= $ecole->id_ecole ?>" <?= $selected; ?>><?= $ecole->nom_ecole ?></option>
        <?php endforeach; ?>
      </optgroup‏>
      <?php endforeach; ?>
    </select>
    <?php $ecole = (isset($formation->ecole)) ? $formation->ecole : ''; ?>
    <?= Form::input('text', 'ecole', null, $ecole, [], [
      'class' => 'form-control',
      'style' => (empty($formation->ecole)) ? 'display:none;' : '',
      'title' => trans("Autre école ou établissement")
    ]); ?>
  </div>
  <div class="col-sm-4 pl-0 pl-xs-15 required">
    <label for="forma_nfor"><?php trans_e("Nombre d’année de formation"); ?></label>
    <select id="forma_nfor" name="nivformation" class="form-control" required>
      <option value=""></option>
      <?php foreach ($niv_formation as $key => $value) :
      $selected = (isset($formation->nivformation) && $formation->nivformation == $value->id_nfor) ? 'selected' : '';
      ?>
        <option value="<?= $value->id_nfor ?>" <?= $selected; ?>><?= $value->formation ?></option>
      <?php endforeach; ?>
        </select>
  </div>
  <div class="col-sm-4 pl-0 pl-xs-15 required">
    <label for="forma_diplome"><?php trans_e("Diplôme"); ?></label>
    <select id="forma_diplome" name="diplome" class="form-control" required>
      <option value=""></option>
      <?php foreach (getDB()->read('prm_filieres') as $key => $value) :
      $selected = (isset($formation->diplome) && $formation->diplome == $value->id_fili) ? 'selected' : '';
      ?>
        <option value="<?= $value->id_fili ?>" <?= $selected; ?>><?= $value->filiere ?></option>
      <?php endforeach; ?>
    </select>
    <?php $diplome_other = (isset($formation->diplome_other)) ? $formation->diplome_other : ''; ?>
    <?= Form::input('text', 'diplome_other', null, $diplome_other, [], [
      'class' => 'form-control',
      'style' => (empty($formation->diplome_other)) ? 'display:none;' : '',
      'title' => trans("Autre (à péciser)")
    ]); ?>
  </div>
</div>
<div class="row mt-0">
  <?php 
    $specialty_displayed = false;
    if (Form::getFieldOption('displayed', 'register', 'specialty')) : 
    $specialty_displayed = true;
    $required = Form::getFieldOption('required', 'register', 'specialty') ? ' required' : '';
  ?>
  <div class="col-sm-4 required">
    <label for="forma_specialty"><?php trans_e("Spécialité"); ?></label>
    <select id="forma_specialty" name="specialty_id" class="form-control" required>
      <option value=""></option>
      <?php foreach (App\Models\Specialty::findAll(false) as $key => $value) :
      $selected = (isset($formation->specialty_id) && $formation->specialty_id == $value->id) ? 'selected' : '';
      ?>
        <option value="<?= $value->id ?>" <?= $selected; ?>><?= $value->name ?></option>
      <?php endforeach; ?>
    </select>
    <?php $specialty_other = (isset($formation->specialty_other)) ? $formation->specialty_other : ''; ?>
    <?= Form::input('text', 'specialty_other', null, $specialty_other, [], [
      'class' => 'form-control',
      'style' => (empty($formation->specialty_other)) ? 'display:none;' : '',
      'title' => trans("Autre (à péciser)")
    ]); ?>
  </div>
  <?php endif; ?>

  <?php if (Form::getFieldOption('displayed', 'register', 'copie_diplome')) : ?>
  <?php $required = Form::getFieldOption('required', 'register', 'copie_diplome') ? ' required' : ''; ?>
  <div class="col-sm-4<?= ($specialty_displayed) ? ' pl-0 pl-xs-15' : ''; ?><?= $required; ?>">
    <label for="forma_copie_diplome"><?php trans_e("Copie du diplôme"); ?></label>
    <div class="input-group file-upload<?= (isset($formation->copie_diplome) && $formation->copie_diplome != '') ? ' hidden' : '' ?>">
        <input type="text" class="form-control" readonly>
        <label class="input-group-btn">
            <span class="btn btn-success btn-sm">
                <i class="fa fa-upload"></i>
                <input type="file" class="form-control" id="forma_copie_diplome" name="copie_diplome" accept="image/*|.doc,.docx,.pdf">
            </span>
        </label>
    </div>
    <?php if (isset($formation->copie_diplome) && $formation->copie_diplome != '') : ?>
      <a href="<?= get_copie_diplome_url($formation->copie_diplome); ?>" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-download"></i>&nbsp;<?php trans_e("Télécharger"); ?></a>
      <button class="btn btn-danger btn-xs" type="button" onclick="return chmModal.confirm('', '', '<?php trans_e("Êtes-vous sûr de vouloir supprimer la copie de diplôme ?"); ?>', 'chmFormation.deleteDiplome', {'id': <?= $formation->id_formation; ?>, cd: '<?= $formation->copie_diplome; ?>'}, {width: 405})"><i class="fa fa-trash"></i>&nbsp;<?php trans_e("Supprimer"); ?></button>
    <?php endif; ?>
  </div>
  </div>
  <?php endif; ?>
</div>
<div class="row mt-10">
  <div class="col-sm-12 required">
    <label for="forma_description"><?php trans_e("Description de la formation"); ?></label>
    <textarea name="description" class="form-control ckeditor" id="forma_description" required><?= (isset($formation->description)) ? $formation->description : '' ?></textarea>
  </div>
</div>

<script>
jQuery(document).ready(function(){

  // editors
  CKEDITOR.replace('forma_description', {height: 200});

  // Trigger success
  $('form').on('chmFormSuccess', function(event, response) {
    if(response.status === 'success') {
      chmModal.destroy()
      window['chmAlert'][response.status](response.message)
      console.log(response.data.action)
      if (response.data.action === 'refresh') {
        window.chmTable.refresh(document.querySelector('#formationsTableContainer'))
      } else {
        location.reload()
      }
    }
  })

  // Show other school field
  $('#forma_ecol').change(function() {
    var $forma_other = $('[name="ecole"]')
    $($forma_other).val('')
    if ($(this).find('option:selected').text().match("^Autre")) {
      $($forma_other).prop('required', true)
      $($forma_other).show()
    } else {
      $($forma_other).prop('required', false)
      $($forma_other).hide()
    }   
  })

  // Diplome
  $('#forma_diplome').change(function() {
    var $other_input = $('#diplome_other')
    $($other_input).val('')
    if ($(this).find('option:selected').text().match("^Autre")) {
      $($other_input).prop('required', true)
      $($other_input).show()
    } else {
      $($other_input).prop('required', false)
      $($other_input).hide()
    }   
  })

  // Speciality
  $('#forma_specialty').change(function() {
    var $other_input = $('#specialty_other')
    $($other_input).val('')
    if ($(this).find('option:selected').text().match("^Autre")) {
      $($other_input).prop('required', true)
      $($other_input).show()
    } else {
      $($other_input).prop('required', false)
      $($other_input).hide()
    }   
  })
  
  cimDatepicker('[id$="date_debut"], [id$="date_fin"]', {
    dateFormat: 'dd/mm/yy',
    maxDate: '-0day',
    minDate: "-30Y",
  })

})
</script>