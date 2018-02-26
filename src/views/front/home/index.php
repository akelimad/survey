<div id="chm-offer-search" data-total-offers="<?= count($offers) ?>"></div>

<div class="styled-title mt-0 mb-10">
  <h3>Les dernières offres d'emploi</h3>
</div>
<?php if(!empty($offers)) : ?>

  <?php foreach ($offers as $key => $offer) : ?>
    <?php get_view('front/offer/content', ['offer' => $offer]) ?>
  <?php endforeach; ?>
  <a href="<?= site_url('offres'); ?>"><strong><i class="fa fa-th-list"></i>&nbsp;TOUTES LES OFFRES</strong></a>

<?php else : ?>
  <strong>Aucun offre trouvé</strong>
<?php endif; ?>
