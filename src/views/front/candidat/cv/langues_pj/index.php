<?php
$languageLevels = [
  'Maîtrisé' =>'Maîtrisé',
  'Courant' =>'Courant',
  'Basique' =>'Basique',
  'Néant' =>'Néant'
];
$max_file_size = get_setting('max_file_size');
$hasCV = \App\Models\Candidat::hasCV(get_candidat_id());
?>

<h1>Langues et pieces joints</h1>

<?php get_flash_message() ?>

<div class="mt-10 mb-10"><?php get_alert('warning', ['Les champs marqués par (*) sont obligatoires', 'La taille maximal de chaque fichiers est <?= $max_file_size; ?>ko.'], false) ?></div>

<form method="POST" action="<?= site_url('candidat/cv/langues_pj'); ?>" class="chm-simple-form" enctype="multipart/form-data">

  <div class="styled-title mt-10 mb-10" style="height: 23px;">
    <h3>Langues</h3>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <label for="candidat_arabic">Arabe</label>
      <select name="candidat[arabic]" id="candidat_arabic" class="form-control">
        <option value=""></option>
        <?php foreach ($languageLevels as $key => $value) : 
        $selected = (get_candidat('arabic') == $key) ? 'selected' : '';
        ?>
        <option value="<?= $key ?>" <?= $selected; ?>><?= $value ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-sm-4 pl-0 pl-xs-15">
    <label for="candidat_french">Français</label>
    <select name="candidat[french]" id="candidat_french" class="form-control">
      <option value=""></option>
      <?php foreach ($languageLevels as $key => $value) : 
      $selected = (get_candidat('french') == $key) ? 'selected' : '';
      ?>
      <option value="<?= $key ?>" <?= $selected; ?>><?= $value ?></option>
    <?php endforeach; ?>
  </select>
</div>
<div class="col-sm-4 pl-0 pl-xs-15">
  <label for="candidat_english">Anglais</label>
  <select name="candidat[english]" id="candidat_english" class="form-control">
    <option value=""></option>
    <?php foreach ($languageLevels as $key => $value) : 
    $selected = (get_candidat('english') == $key) ? 'selected' : '';
    ?>
    <option value="<?= $key ?>" <?= $selected; ?>><?= $value ?></option>
  <?php endforeach; ?>
</select>
</div>
</div>
<div class="row">
  <div class="col-sm-4">
    <label for="candidat_autre">Autres 1</label>
    <input type="text" class="form-control" id="candidat_autre" name="candidat[autre]" value="<?= get_candidat('autre'); ?>">
    <select name="candidat[autre_n]" id="exp_autre_n" class="form-control" style="<?= (get_candidat('autre_n') == '') ? 'display: none;' : ''; ?>margin-top: -5px;">
      <option value=""></option>
      <?php foreach ($languageLevels as $key => $value) : 
      $selected = (get_candidat('autre_n') == $key) ? 'selected' : '';
      ?>
      <option value="<?= $key ?>" <?= $selected; ?>><?= $value ?></option>
    <?php endforeach; ?>
  </select>
</div>
<div class="col-sm-4 pl-0 pl-xs-15">
  <label for="candidat_autre1">Autres 2</label>
  <input type="text" class="form-control" id="candidat_autre1" name="candidat[autre1]" value="<?= get_candidat('autre1'); ?>">
  <select name="candidat[autre1_n]" id="exp_autre1_n" class="form-control" style="<?= (get_candidat('autre1_n') == '') ? 'display: none;' : ''; ?>margin-top: -5px;">
    <option value=""></option>
    <?php foreach ($languageLevels as $key => $value) : 
    $selected = (get_candidat('autre1_n') == $key) ? 'selected' : '';
    ?>
    <option value="<?= $key ?>" <?= $selected; ?>><?= $value ?></option>
  <?php endforeach; ?>
</select>
</div>
<div class="col-sm-4 pl-0 pl-xs-15">
  <label for="candidat_autre2">Autres 3</label>
  <input type="text" class="form-control" id="candidat_autre2" name="candidat[autre2]" value="<?= get_candidat('autre2'); ?>">
  <select name="candidat[autre2_n]" id="exp_autre2_n" class="form-control" style="<?= (get_candidat('autre2_n') == '') ? 'display: none;' : ''; ?>margin-top: -5px;">
    <option value=""></option>
    <?php foreach ($languageLevels as $key => $value) : 
    $selected = (get_candidat('autre2_n') == $key) ? 'selected' : '';
    ?>
    <option value="<?= $key ?>" <?= $selected; ?>><?= $value ?></option>
  <?php endforeach; ?>
</select>
</div>
</div>


<div class="styled-title mt-0 mb-10" style="height: 23px;">
  <h3>Pièces jointes</h3>
</div>
<div class="row mb-10">
  <div class="col-sm-3 mb-10">
    <label for="candidat_photo">Photo&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="Vous pouvez joindre votre Photo, la taille ne doit pas dépassé <?= $max_file_size; ?>ko."></i></label>
    <div class="input-group file-upload photo" <?= (get_candidat('photo') != '') ? 'style="display: none;"' : '' ?>>
      <input type="text" class="form-control" readonly>
      <label class="input-group-btn">
        <span class="btn btn-success btn-sm">
          <i class="fa fa-upload"></i>
          <input type="file" class="form-control" id="candidat_photo" name="photo" accept="image/*">
        </span>
      </label>
    </div>
    <?php if (get_candidat('photo') != '') : ?>
      <div id="candidatPhoto">
        <img class="img-responsive mt-10" src="<?= get_photo_url(get_candidat('photo', 'no-photo.png')); ?>">
        <button type="button" class="btn btn-danger btn-xs" onclick="return chmModal.confirm('', '', 'Êtes-vous sûr de vouloir supprimer la photo ?', 'chmCandidat.deletePhoto', {'photo': '<?= get_candidat('photo'); ?>'}, {width: 332})" style="position: absolute;top: 25px;left: 15px;"><i class="fa fa-trash"></i></button>
      </div>
    <?php endif; ?>
  </div>
  <div class="col-sm-9">
    <div class="row">
      <div class="col-sm-12 mb-10 pl-0 pl-xs-15 <?= !$hasCV ? 'required' : ''; ?>">
        <label for="candidat_cv">CV&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="Vous pouvez joindre jusqu'à 5 CVs Word ou PDF, la taille de chaque cv ne doit pas dépassé <?= $max_file_size; ?>ko"></i></label>
        <div class="input-group file-upload" <?= (count($cvs) > 5) ? 'style="display:none;"' : '' ?>>
          <input type="text" class="form-control" readonly>
          <label class="input-group-btn">
            <span class="btn btn-success btn-sm">
              <i class="fa fa-upload"></i>
              <input type="file" class="form-control" id="candidat_cv" name="cv" accept=".doc,.docx,.pdf">
            </span>
          </label>
        </div>
        <ul class="mt-10" id="cvItems">
          <?php foreach ($cvs as $key => $cv) : ?>
          <li class="cv_<?= $cv->id_cv; ?>">
            <label for="cv_input_<?= $cv->id_cv; ?>" style="cursor: pointer;">
              <button type="button" class="btn btn-danger btn-xs delete" onclick="return chmModal.confirm('', '', 'Êtes-vous sûr de vouloir supprimer le CV ?', 'chmCandidat.deleteCV', {'id': '<?= $cv->id_cv; ?>'}, {width: 312})" title="Supprimer" <?= ($cv->principal == 1) ? 'style="display: none;"' : '' ?>><i class="fa fa-trash"></i></button>
              <a target="_blank" href="<?= get_resume_url($cv->lien_cv); ?>" class="btn btn-default btn-xs" title="Télécharger"><i class="fa fa-download"></i></a>
              <span class="btn btn-primary btn-xs" title="Définir comme principal">
                <input type="radio" name="cv_default" id="cv_input_<?= $cv->id_cv; ?>" onchange="return chmCandidat.setCVDefault(<?= $cv->id_cv; ?>)" <?= ($cv->principal == 1) ? 'checked' : ''; ?>>
              </span>
              <?= $cv->titre_cv; ?>
            </label>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-sm-12 mb-10 pl-0 pl-xs-15">
        <label for="candidat_lm">Lettre de motivation&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="Vous pouvez joindre jusqu'à 5 lettres de motivation Word ou PDF, la taille de chaque lettre ne doit pas dépassé <?= $max_file_size; ?>ko"></i></label>
        <div class="input-group file-upload" <?= (count($lms) > 5) ? 'style="display:none;"' : '' ?>>
          <input type="text" class="form-control" readonly>
          <label class="input-group-btn">
            <span class="btn btn-success btn-sm">
              <i class="fa fa-upload"></i>
              <input type="file" class="form-control" id="candidat_lm" name="lm" accept=".doc,.docx,.pdf">
            </span>
          </label>
        </div>
        <ul class="mt-10" id="lmItems">
          <?php foreach ($lms as $key => $lm) : ?>
          <li class="lm_<?= $lm->id_lettre; ?>">
            <label for="lm_input_<?= $lm->id_lettre; ?>" style="cursor: pointer;">
              <button type="button" class="btn btn-danger btn-xs delete" onclick="return chmModal.confirm('', '', 'Êtes-vous sûr de vouloir supprimer la Lettre de motivation ?', 'chmCandidat.deleteLM', {'id': '<?= $lm->id_lettre; ?>'}, {width: 428})" title="Supprimer" <?= ($lm->principal == 1) ? 'style="display: none;"' : '' ?>><i class="fa fa-trash"></i></button>
              <a target="_blank" href="<?= get_motivation_letter_url($lm->lettre); ?>" class="btn btn-default btn-xs" title="Télécharger"><i class="fa fa-download"></i></a>
              <span class="btn btn-primary btn-xs" title="Définir comme principal">
                <input type="radio" name="lm_default" id="lm_input_<?= $lm->id_lettre; ?>" onchange="return chmCandidat.setLMDefault(<?= $lm->id_lettre; ?>)" <?= ($lm->principal == 1) ? 'checked' : ''; ?>>
              </span>
              <?= $lm->titre; ?>
            </label>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-sm-12">
    <div class="ligneBleu mt-10"></div>
    <button type="submit" class="btn btn-primary btn-sm" style="min-width: 170px;">Enregistrer</button>
  </div>
</div>
</form>