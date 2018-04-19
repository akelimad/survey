<input type="hidden" name="id" value="<?= (isset($exp->id_exp)) ? $exp->id_exp : 0 ?>">
<div class="row">
  <div class="col-sm-4 required">
    <label for="exp_date_debut"><?php trans_e("Date de début"); ?></label>
    <?php
    $date_debut = '';
    if (isset($exp->date_debut) && $exp->date_debut != '') {
      $date_debut = (strlen($exp->date_debut) == 7) ? '01/'. $exp->date_debut : $exp->date_debut;
      $date_debut = french_to_english_date($date_debut);
    }
    ?>
    <input type="date" max="<?= date('Y-m-d'); ?>" value="<?= $date_debut ?>" class="form-control" id="exp_date_debut" name="date_debut" required>
  </div>
  <div class="col-sm-8 pl-0 pl-xs-15 required">
    <label for="exp_date_fin"><?php trans_e("Date de fin"); ?></label>
    <?php
    $date_fin = '';
    if (isset($exp->date_fin) && $exp->date_fin != '') {
      $date_fin = (strlen($exp->date_fin) == 7) ? '01/'. $exp->date_fin : $exp->date_fin;
      $date_fin = french_to_english_date($date_fin);
    }
    ?>
    <input type="date" max="<?= date('Y-m-d'); ?>" value="<?= $date_fin ?>" class="form-control" id="exp_date_fin" name="date_fin" style="max-width: 186px;float: left;margin-right: 10px;<?= (isset($exp->date_fin) && $exp->date_fin == '') ? 'display: none;"' : '" required' ?>>
    <label for="exp_today" style="margin-top: 10px;" class="pointer">
      <input type="checkbox" value="1" class="date_fin_today" id="exp_today"<?= (isset($exp->date_fin) && $exp->date_fin == '') ? ' checked' : '' ?>>&nbsp;<?php trans_e("Jusqu'à aujourd'hui"); ?>
    </label>
  </div>
</div>

<div class="row">
  <div class="col-sm-4 required">
    <label for="entreprise"><?php trans_e("Entreprise"); ?></label>
    <input type="text" class="form-control" id="entreprise" name="entreprise" value="<?= (isset($exp->entreprise)) ? $exp->entreprise : '' ?>" required>
  </div>
  <div class="col-sm-4 pl-0 pl-xs-15 required">
    <label for="poste"><?php trans_e("Intitulé du poste"); ?></label>
    <input type="text" class="form-control" id="poste" name="poste" value="<?= (isset($exp->poste)) ? $exp->poste : '' ?>" required>
  </div>
  <div class="col-sm-4 pl-0 pl-xs-15 required">
    <label for="exp_sector"><?php trans_e("Secteur d'activité"); ?></label>
    <select id="exp_sector" name="id_sect" class="form-control" required>
      <option value=""></option>
      <?php foreach ($sectors as $key => $value) : 
      $selected = (isset($exp->id_sect) && $exp->id_sect == $value->id_sect) ? 'selected' : '';
      ?>
        <option value="<?= $value->id_sect ?>" <?= $selected; ?>><?= $value->FR ?></option>
      <?php endforeach; ?>
        </select>
  </div>
</div>
<div class="row">
  <div class="col-sm-4 required">
    <label for="exp_fonction"><?php trans_e("Fonction"); ?></label>
    <select id="exp_fonction" name="id_fonc" class="form-control" required>
      <option value=""></option>
      <?php foreach (getDB()->read('prm_fonctions') as $key => $value) : 
      $selected = (isset($exp->id_fonc) && $exp->id_fonc == $value->id_fonc) ? 'selected' : '';
      ?>
        <option value="<?= $value->id_fonc ?>" <?= $selected; ?>><?= $value->fonction ?></option>
      <?php endforeach; ?>
        </select>
  </div>
  <div class="col-sm-4 pl-0 pl-xs-15 required">
    <label for="exp_tpost"><?php trans_e("Type de contrat"); ?></label>
    <select id="exp_tpost" name="id_tpost" class="form-control" required>
      <option value=""></option>
      <?php foreach (getDB()->read('prm_type_poste') as $key => $value) : 
      $selected = (isset($exp->id_tpost) && $exp->id_tpost == $value->id_tpost) ? 'selected' : '';
      ?>
        <option value="<?= $value->id_tpost ?>" <?= $selected; ?>><?= $value->designation ?></option>
      <?php endforeach; ?>
        </select>
  </div>
  <div class="col-sm-4 col-xs-12 pl-0 pl-xs-15 required">
    <label for="salair_pecu"><?php trans_e("Dernier salaire perçu"); ?></label>
    <input type="number" min="0" step="0.1" name="salair_pecu" value="<?= (isset($exp->salair_pecu)) ? $exp->salair_pecu : '0' ?>" class="form-control" id="salair_pecu" required>
  </div>
</div>
<div class="row">
  <div class="col-sm-4 required">
    <label for="exp_pays"><?php trans_e("Pays"); ?></label>
    <select id="exp_pays" name="id_pays" class="form-control" required>
      <option value="" data-code=""></option>
      <?php foreach ($pays as $key => $value) : 
      $selected = (isset($exp->id_pays) && $exp->id_pays == $value->id_pays) ? 'selected' : '';
      ?>
        <option value="<?= $value->id_pays ?>" <?= $selected; ?>><?= $value->pays ?></option>
      <?php endforeach; ?>
        </select>
  </div>
  <div class="col-sm-4 pl-0 pl-xs-15 required">
    <label for="exp_ville"><?php trans_e("Ville"); ?></label>
    <select id="exp_ville" name="ville" class="form-control" required>
      <option value=""></option>
      <?php foreach ($villes as $key => $value) : 
      $selected = (isset($exp->ville) && $exp->ville == $value->ville) ? 'selected' : '';
      ?>
        <option value="<?= $value->ville ?>" <?= $selected; ?>><?= $value->ville ?></option>
      <?php endforeach; ?>
        </select>
  </div>
  <div class="col-sm-4 mb-10 pl-0 pl-xs-15 ">
    <label for="copie_attestation"><?php trans_e("Copie de l’attestation"); ?></label>
    <div class="input-group file-upload<?= (isset($exp->copie_attestation) && $exp->copie_attestation != '') ? ' hidden' : '' ?>">
        <input type="text" class="form-control" readonly>
        <label class="input-group-btn">
            <span class="btn btn-success btn-sm">
                <i class="fa fa-upload"></i>
                <input type="file" class="form-control" id="copie_attestation" name="copie_attestation" accept="image/*|.doc,.docx,.pdf">
            </span>
        </label>
    </div>
    <?php if (isset($exp->copie_attestation) && $exp->copie_attestation != '') : ?>
      <a href="<?= site_url('apps/upload/frontend/candidat/copie_attestation/'. $exp->copie_attestation); ?>" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-download"></i>&nbsp;<?php trans_e("Télécharger"); ?></a>
      <button class="btn btn-danger btn-xs" type="button" onclick="return chmModal.confirm('', '', '<?php trans_e("Êtes-vous sûr de vouloir supprimer la copie de l’attestation ?"); ?>', 'chmExperience.deleteCertificate', {'id': <?= $exp->id_exp; ?>, cd: '<?= $exp->copie_attestation; ?>'}, {width: 431})"><i class="fa fa-trash"></i>&nbsp;<?php trans_e("Supprimer"); ?></button>
    <?php endif; ?>
  </div>
</div>

<div class="row mt-10">
  <div class="col-sm-12 required">
    <label for="exp_description"><?php trans_e("Description du poste"); ?></label>
    <textarea name="description" class="form-control ckeditor" id="exp_description" required><?= (isset($exp->description)) ? $exp->description : '' ?></textarea>
  </div>
</div>

<script>
jQuery(document).ready(function(){

  // editors
  CKEDITOR.replace('exp_description', {height: 200});

  // Trigger success
  $('form').on('chmFormSuccess', function(event, response) {
    if(response.status === 'success') {
      chmModal.destroy()
      window['chmAlert'][response.status](response.message)
      if (response.data.action === 'refresh') {
        window.chmTable.refresh(document.querySelector('#experiencesTableContainer'))
      } else {
        location.reload()
      }
    }
  })

})
</script>