<h1 class="mb-10"><?php trans_e("Signaler un probléme"); ?></h1>

<div id="form-success-message" style="display: none;">
  <?php get_alert('success', [
    trans("Merci de nous avoir signalé un problème."), 
    trans("Votre message sera traité et nous reviendrons vers vous sous peu.")
  ], false) ?>
</div>

<form method="POST" action="" class="chm-simple-form" onsubmit="return window.chmForm.submit(event)" enctype="multipart/form-data">

  <div class="row">
    <div>
      <label for="ticket_number" class="col-sm-3 pt-5"><?php trans_e("N° billet"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <strong style="color:red;"><?php echo $ticket_number; ?></strong>
        <input type="hidden" class="form-control" id="ticket_number" name="ticket_number" value="<?= $ticket_number; ?>" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="first_name" class="col-sm-3 pt-5"><?php trans_e("Nom de famille"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?= get_candidat('nom'); ?>" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="last_name" class="col-sm-3 pt-5"><?php trans_e("Prénom"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?= get_candidat('prenom'); ?>" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="email" class="col-sm-3 pt-5"><?php trans_e("Courriel"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="email" class="form-control" id="email" name="email" value="<?= get_candidat('email'); ?>" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="phone" class="col-sm-3 pt-5"><?php trans_e("Télephone"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="number" class="form-control" id="phone" name="phone" value="<?= get_candidat('tel1'); ?>" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="subject" class="col-sm-3 pt-5"><?php trans_e("Sujet"); ?></label>
      <div class="col-sm-6 pl-0 pl-xs-15">
        <input type="text" class="form-control" id="subject" name="subject" required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="required">
      <label for="message" class="col-sm-3 pt-5"><?php trans_e("Message"); ?></label>
      <div class="col-sm-9 pl-0 pl-xs-15">
        <textarea name="message" class="form-control" id="message" style="height: 150px;" required></textarea>
      </div>
    </div>
  </div>

  <div class="row">
    <div>
      <label for="attachement" class="col-sm-3 pt-5"><?php trans_e("Pièce à joindre"); ?></label>
      <div class="col-sm-9 pl-0 pl-xs-15">
        <input type="file" name="attachement" id="attachement">
        <p class="help-block"><?php trans_e("Seuls les fichiers (.doc, .jpg, .gif, .png ou .pdf) sont acceptés"); ?></p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-9 col-sm-offset-3 pl-0 pl-xs-15">
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <div class="g-recaptcha" data-sitekey="<?= get_setting('google_recaptcha_sitekey') ?>"></div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="ligneBleu mt-10"></div>
      <button type="reset" class="btn btn-danger btn-xs"><?php trans_e("Réinitialiser"); ?></button>
      <button type="submit" class="btn btn-primary pull-right btn-xs"><?php trans_e("Envoyer"); ?></button>
    </div>
  </div>
</form>


<script>
jQuery(document).ready(function(){

  // Trigger success
  $('form').on('chmFormSuccess', function(event, response) {
    if(response.status === 'success') {
      $('form').hide();
      $('#form-success-message').show();
    }
  })

})
</script>