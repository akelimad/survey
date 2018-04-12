<input type="hidden" name="id" value="<?= (isset($alert->id_alert)) ? $alert->id_alert : 0; ?>">
<label for="titre" class="form-label mt-0"><?php trans_e("Description de l'alerte"); ?></label>
<input type="text" name="titre" value="<?= (isset($alert->titre)) ? $alert->titre : ''; ?>" id="titre" class="form-control mb-0" required>

<script>
jQuery(document).ready(function(){

  // Trigger success
  $('form').on('chm_form_success', function(event, response) {
    if(response.status === 'success') {
      window.chmTable.refresh($('#alertsTable'), {scrollTo: true})
    }
  })

})
</script>