<article class="offer-box">
  <strong class="title">
    <a href="<?= site_url('offre/'.$offer->id_offre) ?>"><?= $offer->Name ?></a>&nbsp;||
    <?= date("d.m.Y",strtotime($offer->date_expiration)); ?>
  </strong>
  <p class="mb-0 mt-5">
    <strong><?php trans_e("Profils recherchés"); ?></strong>
  </p>
  <p align="justify" class="mb-5">
    <?= word_limit(strip_tags(stripslashes($offer->Profil)), 36) ?>
    <a href="<?= site_url('offre/'.$offer->id_offre) ?>"><i class="fa fa-long-arrow-right"></i>&nbsp;<strong style="font-size: 11px;"><?php trans_e("Voir l'offre"); ?></strong></a>
  </p>
  <strong style="font-size: 11px">Réf. <?php echo $offer->reference; ?>&nbsp;||&nbsp;<?php trans_e("Date d’expiration:"); ?> <?= date("d.m.Y",strtotime($offer->date_expiration)); ?>&nbsp;||&nbsp;<?= $offer->fonction ?></strong>
  <div>
  <hr>
</article>