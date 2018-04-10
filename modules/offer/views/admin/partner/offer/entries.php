<a href="<?= site_url('backend/module/offer/partner/offers'); ?>" class="btn btn-default btn-xs mt-10"><i class="fa fa-bars"></i>&nbsp;<?php trans_e("Afficher les offres"); ?></a>
<a href="javascript:void(0)" class="btn btn-primary btn-xs mt-10" onclick="return window.chmOffer.form(<?= $_GET['id']; ?>)"><i class="fa fa-plus-circle"></i>&nbsp;<?php trans_e("Créér un nouveau dossier candidat"); ?></a>

<?= $table->render(); ?>