<?php use App\Form; ?>
<?php $max_file_size = get_setting('max_file_size', 400); ?>

<div class="chm-response-messages"></div>
<form method="POST" action="" class="chm-simple-form" id="forumForm" onsubmit="return chmForm.submit(event)" enctype="multipart/form-data">

  <h1><?php trans_e("Formulaire Forum"); ?></h1>
  <div class="ligneBleu mb-15"></div>

  <div class="row">
    <div class="required">
      <label for="nom" class="col-sm-3 pt-5"><?php trans_e("Nom de famille"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="text" class="form-control" id="nom" name="nom" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="prenom" class="col-sm-3 pt-5"><?php trans_e("Prénom"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="text" class="form-control" id="prenom" name="prenom" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="email" class="col-sm-3 pt-5"><?php trans_e("E-mail"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="tel1" class="col-sm-3 pt-5"><?php trans_e("Numéro de téléphone"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="number" min="1" step="1" class="form-control" id="tel1" name="tel1" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="id_dispo" class="col-sm-3 pt-5"><?php trans_e("Date de disponibilité"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <select id="id_dispo" name=" id_dispo" class="form-control" required>
          <option value=""></option>
          <?php foreach (getDB()->read('prm_disponibilite') as $key => $value) : ?>
            <option value="<?= $value->id_dispo ?>"><?= $value->intitule ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="required">
      <label for="titre" class="col-sm-3 pt-5"><?php trans_e("Poste souhaité"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="text" class="form-control" id="titre" name="titre" required>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="required">
      <label for="cv" class="col-sm-3 pt-5"><?php trans_e("CV"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <div class="input-group file-upload">
          <input type="text" class="form-control" readonly>
          <label class="input-group-btn">
              <span class="btn btn-success btn-sm">
                  <i class="fa fa-upload"></i>
                  <input type="file" class="form-control" id="cv" name="cv" accept=".doc,.docx,.pdf">
              </span>
          </label>
        </div>
        <p class="help-block"><?php trans_e("Formats autorisées: (Word ou PDF)"); ?><br><?php trans_e("Le taille de CV ne doit pas dépasser"); ?>&nbsp;<b><?= $max_file_size; ?>ko</b></p>
      </div>
    </div>
  </div>

  <?php if (get_setting('google_recaptcha_enabled', false)) : ?>
  <div class="row">
    <div class="col-ms-8 col-md-offset-3 mt-10">
      <!--div class="g-recaptcha" data-sitekey="<?= get_setting('google_recaptcha_sitekey') ?>"></div-->
      <p class="help-block"><?php trans_e("Cocher cette case pour confirmer que vous n'êtes pas un robot."); ?></p>
    </div>
  </div>
  <?php endif; ?>

  <div class="row">
    <div class="col-sm-12">
      <div class="ligneBleu mt-10"></div>
      <button type="submit" class="btn btn-primary btn-sm" style="min-width: 170px;"><?php trans_e("Valider"); ?></button>
    </div>
  </div>
</form>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
jQuery(document).ready(function(){

  // Trigger success
  $('#forumForm').on('chmFormSuccess', function(event, response) {
    if(response.status === 'success') {
      $(this).hide()
    }
  })

});
</script>