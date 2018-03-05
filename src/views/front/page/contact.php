<h1 class="mb-10">Nous contacter</h1>

<?php get_alert('info', 'Vos questions, commentaires et suggestions sont les bienvenues !', false) ?>

<p class="mt-15 mb-15"><strong>Courriel:</strong>&nbsp;<a href="mailto:<?= get_setting('email_e'); ?>"><?= get_setting('email_e'); ?></a></p>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<form method="POST" action="" class="chm-simple-form" onsubmit="return window.chmForm.submit(event)">

  <?php $showDestinations = (get_setting('front_show_contact_destination') == 1); ?>
  <div class="row" style="display:<?= ($showDestinations) ? 'block' : 'none' ?>">
    <div class="required">
      <label for="destination" class="col-sm-3 pt-5">Envoyer à</label>
      <div class="col-sm-5 pl-0 pl-xs-15">
        <select id="destination" name="destination" class="form-control" <?= ($showDestinations) ? 'required' : '' ?>>
          <option value=""></option>
          <?php foreach (getDB()->read('prm_destination') as $key => $value) : ?>
            <option value="<?= $value->titre ?>"><?= $value->titre ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="first_name" class="col-sm-3 pt-5">Nom de famille</label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?= get_candidat('nom'); ?>" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="last_name" class="col-sm-3 pt-5">Prénom</label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?= get_candidat('prenom'); ?>" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="email" class="col-sm-3 pt-5">Courriel</label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="email" class="form-control" id="email" name="email" value="<?= get_candidat('email'); ?>" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="subject" class="col-sm-3 pt-5">Sujet</label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="text" class="form-control" id="subject" name="subject" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="message" class="col-sm-3 pt-5">Message</label>
      <div class="col-sm-9 pl-0 pl-xs-15">
        <textarea name="message" class="form-control" id="message" style="height: 150px;" required></textarea>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-9 col-sm-offset-3 pl-0 pl-xs-15">
      <div class="g-recaptcha" data-sitekey="<?= get_setting('google_recaptcha_sitekey') ?>"></div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="ligneBleu mt-10"></div>
      <button type="reset" class="btn btn-danger btn-xs">Réinitialiser</button>
      <button type="submit" class="btn btn-primary pull-right btn-xs">Envoyer</button>
    </div>
  </div>
</form>


<script>
jQuery(document).ready(function(){

  // Trigger success
  $('form').on('chm_form_success', function(event, response) {
    if(response.status === 'success') {
      $('[type="reset"]').trigger('click')
    }
  })

})
</script>