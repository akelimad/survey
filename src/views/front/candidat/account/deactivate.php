<h1>Désactiver mon compte</h1>

<div class="chm-response-messages mt-10"></div>

<form method="POST" action="" class="chm-simple-form" id="deactivateAccountForm">
  <div class="styled-title mt-10 mb-10">
    <h3>Vous souhaitez désactiver votre compte ?</h3>
  </div>

  <strong>Pourquoi souhaiteriez-vous désactiver votre compte ?</strong>

  <ul class="mt-15 mb-15 ml-15">
    <?php foreach (getDB()->read('prm_compte_desactiver') as $key => $value) : ?>
    <li class="mb-10">
      <label for="raison_<?= $value->id_prm_compte; ?>">
        <input type="radio" name="raison" value="<?= $value->id_prm_compte ?>" id="raison_<?= $value->id_prm_compte; ?>">
        <?= $value->raison ?>
      </label>
    </li>
    <?php endforeach; ?>
  </ul>

  <?php // get_alert('warning', 'Lorsque vous désactivez votre compte, votre profil et toutes les informations qui y sont associées sont effacées du site.') ?>

  <div class="ligneBleu mt-5"></div>
  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmdeactivateAccountForm(event)"><i class="fa fa-warning"></i>&nbsp;Désactiver mon compte</button>
</form>


<script>
jQuery(document).ready(function(){

  // Trigger form success
  $('form').on('chm_form_success', function(event, response) {
    if(response.status === 'deactivated') {
      $('#candidat-account-menu').hide()
      $('#deactivateAccountForm').hide()
      chmForm.showMessagesBlock('success', response.message, $('#deactivateAccountForm'), false)
      setTimeout(function () {
        window.location.href = site_url('candidat/logout')
      }, 3000)
    }
  })

  confirmdeactivateAccountForm = function (event) {
    event.preventDefault()
    if ($('[name="raison"]:checked').val() == undefined) {
      chmModal.alert('', 'Vous devez choisir la raison de désactiver votre compte.', {width: 402});
    } else {
      chmModal.confirm('', '', 'Voulez-vous vraiment désactiver votre compte ?', 'submitdeactivateAccountForm', {}, {width: 350})
    }
  }

  submitdeactivateAccountForm = function () {
    chmModal.destroy()
    chmForm.submit(event, $('#deactivateAccountForm'))
  }

});
</script>