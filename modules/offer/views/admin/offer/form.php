<style>
<?php if (!isset($offer->mobilite) || $offer->mobilite == 'non') : ?>
#offer_niveau_mobiliteContainer, #offer_taux_mobiliteContainer {
  display: none;
}
<?php endif; ?>
</style>

<div class="row">
  <div class="col-sm-3 col-xs-12 custom pr-0 pr-xs-15">
    <?php get_view('admin/menu/offer') ?>
  </div>
  <div class="col-sm-9 col-xs-12 custom column-body">
    <div class="row">
      <div class="col-md-8">
        <h1><?= (isset($offer->id_offre)) ? trans("Modifier une offre") : trans("Créer une offre") ;?></h1>
      </div>
      <!--div class="col-md-4">
        <a href="javascript:void(0)" class="btn btn-primary btn-xs pull-right" style="margin-top: 4px;" onclick="chmOffer.manageFields()"><i class="fa fa-list-ul"></i>&nbsp;<?php //trans_e("Gestion des champs") ?></a>
      </div-->
    </div>
    <div class="ligneBleu"></div>

    <div class="mt-10 mb-10"><?php get_alert('warning', trans("P.S: les champs marqués par (*) sont obligatoires"), false) ?></div>

    <!-- Render form -->
    <?= $form->render(); ?>
  </div>
</div>

<!-- include summernote css/js -->
<?php $code = str_replace('_', '-', getCurrentLanguage('code', 'fr-FR')); ?>
<link href="<?= site_url('assets/vendors/summernote/summernote.css'); ?>" rel="stylesheet">
<script src="<?= site_url('assets/vendors/summernote/summernote.min.js'); ?>"></script>
<script src="<?= site_url('assets/vendors/summernote/lang/summernote-'. $code .'.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?= site_url('assets/vendors/select2/css/select2.min.css'); ?>">
<script src="<?= site_url('assets/vendors/select2/js/select2.min.js'); ?>" type="text/javascript"></script>
<script>
$(document).ready(function() {
  $('select[multiple]').select2()

  $('.summernote').summernote({
    lang: '<?= $code; ?>',
    height: 120
  });

  // mobilite
  $('[name="offer[mobilite]"]').change(function () {
    if ($(this).val() === 'oui') {
      $('#offer_niveau_mobiliteContainer, #offer_taux_mobiliteContainer').show()
    } else {
      $('#offer_niveau_mobiliteContainer, #offer_taux_mobiliteContainer').hide()
    }
  })
})
</script>