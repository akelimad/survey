<?php \App\Event::trigger('head'); ?>
<!DOCTYPE html>
<html>
<head>
  <title><?= $offer->Name ?></title>
</head>
<body>
  <div class="container">
    <h3><?= $offer->Name ?></h3>
    <br>
    <div class="styled-title mt-0 mb-10">
      <h3><?php trans_e("Informations générales"); ?></h3>
    </div>

    <table id="offer-infos">
      <tbody>
        <tr>
          <td width="160"><?php trans_e("Type de poste"); ?></td>
          <td>:<strong>&nbsp;<?= (isset($tpost->designation)) ? $tpost->designation : '' ?></strong></td>
        </tr>
        <tr>
          <td><?php trans_e("Niveau d'expérience"); ?></td>
          <td>:<strong>&nbsp;<?= (isset($tpost->designation)) ? $tpost->designation : '' ?></strong></td>
        </tr>
        <tr>
          <td><?php trans_e("Niveau de formation"); ?></td>
          <td>:<strong>&nbsp;<?= (isset($nfor->formation)) ? $nfor->formation : '' ?></strong></td>
        </tr>
        <tr>
          <td><?php trans_e("Fonction"); ?></td>
          <td>:<strong>&nbsp;<?= (isset($fonc->fonction)) ? $fonc->fonction : '' ?></strong></td>
        </tr>
        <tr>
          <td>
            <?php if(read_session('r_prm_region_off') == 0) : ?>
              <?php trans_e("Lieu de travail"); ?>
            <?php else : ?>
              <?php trans_e("Région de travail"); ?>
            <?php endif; ?>
          </td>
          <td>:<strong>&nbsp;<?= (isset($lieu->name)) ? $lieu->name : '' ?></strong></td>
        </tr>
        <tr>
          <td><?php trans_e("Date d’expiration"); ?></td>
          <td>:<strong>&nbsp;<?= date("d.m.Y", strtotime($offer->date_expiration)) ?></strong></td>
        </tr>
      </tbody>
    </table>

    <div class="styled-title mt-10 mb-10">
      <h3><?php trans_e("Description du poste"); ?></h3>
    </div>
    <?= $offer->Details ?>

    <div class="styled-title mt-10 mb-10">
      <h3><?php trans_e("Profils recherchés"); ?></h3>
    </div>
    <?= $offer->Profil ?>
  </div>
</body>
</html>