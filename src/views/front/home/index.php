<div id="chm-offer-search" data-total-offers="<?= count($offers) ?>"></div>

<div class="styled-title mt-0 mb-10">
  <h3><?php trans_e("Les dernières offres d'emploi"); ?></h3>
</div>
<?php if(!empty($offers)) : ?>

  <?php foreach ($offers as $key => $offer) : ?>
    <?php get_view('front/offer/content', ['offer' => $offer]) ?>
  <?php endforeach; ?>
  <a href="<?= site_url('offres'); ?>"><strong><i class="fa fa-th-list"></i>&nbsp;<?php trans_e("TOUTES LES OFFRES"); ?></strong></a>

<?php else : ?>
  <strong><?php trans_e("Aucune offre trouvée."); ?></strong>
<?php endif; ?>
