<div id="chm-offer-search" data-total-offers="<?= $pagi->total_results ?>"></div>

<div class="styled-title mt-0 mb-10">
  <h3><?php trans_e("Offres d'emploi"); ?></h3>
</div>
<?php if(!empty($offers)) : ?>

  <?php foreach ($offers as $key => $offer) : ?>
    <?php get_view('front/offer/content', ['offer' => $offer]) ?>
  <?php endforeach; ?>

  <div class="row">
    <div class="col-sm-4 mb-xs-10">
      <?php
        $show_start = (($perpage * $currentPage) - $perpage) + 1;
        $show_end = ($show_start + $perpage) - 1;
        if( $show_end > $pagi->total_results ) $show_end = $pagi->total_results;
      ?>
      <strong style="font-size: 11px;margin-top: 6px;display: block;">Affichage de <?= $show_start ?> à <?= $show_end ?> de <?= $pagi->total_results ?> offres</strong>
    </div>
    <div class="col-sm-8">
      <span class="pull-right">
        <?= (isset($pagi->links_html)) ? $pagi->links_html : '' ?>
      </span>
    </div>
  </div>

<?php else : ?>
  <strong><?php trans_e("Aucune offre trouvée."); ?></strong>
<?php endif; ?>
