<h1>Mes identifiants</h1>

<div class="styled-title mt-10 mb-10">
  <h3>Vous souhaitez changer votre mot de passe ?</h3>
</div>

<form method="POST" action="<?= site_url('candidat/change-password'); ?>" class="chm-simple-form" onsubmit="return window.chmForm.submit(event)">

  <div class="row pl-xs-15 pr-xs-15">
    <div class="required">
      <label for="current_password" class="col-sm-4 p-xs-0 mt-5">Votre mot de passe actuel</label>
      <input type="password" class="form-control col-sm-4" id="current_password" name="current_password" required>
    </div>
  </div>

  <div class="row pl-xs-15 pr-xs-15">
    <div class="required">
      <label for="password" class="col-sm-4 p-xs-0 mt-5">Nouveau mot de passe</label>
      <input type="password" class="form-control col-sm-4" id="password" name="password" required>
    </div>
  </div>

  <div class="row pl-xs-15 pr-xs-15">
    <div class="required">
      <label for="confirm_password" class="col-sm-4 p-xs-0 mt-5">Confirmer le nouveau mot de passe</label>
      <input type="password" class="form-control col-sm-4" id="confirm_password" name="confirm_password" required>
    </div>
  </div>

  <div class="ligneBleu"></div>
  <button type="submit" class="btn btn-primary btn-sm">Changer</button>
</form>

<script>
jQuery(document).ready(function(){

  // Trigger form success
  $('form').on('chm_form_success', function(event, response) {
    if(response.status === 'success') {
      $(this).find('input').val('')
      window.location.href = site_url('candidat/logout')
    }
  })

});
</script>