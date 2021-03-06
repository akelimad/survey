<script src="<?= site_url('assets/vendors/html2canvas/html2canvas.min.js'); ?>"></script>

<div id="offer-container">
  <h1 class="mb-10"><?= $offer->Name ?></h1>

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
        <td>:<strong>&nbsp;<?= (isset($exp->intitule)) ? $exp->intitule : '' ?></strong></td>
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

  <?php if ($description = get_setting('offer_company_description', false)) : ?>
  <div class="styled-title mt-10 mb-10">
    <h3><?php trans_e("Description de l'entreprise"); ?></h3>
  </div>
  <p align="justify"><?= $description ?></p>
  <?php endif; ?>

  <div class="styled-title mt-10 mb-10">
    <h3><?php trans_e("Description du poste"); ?></h3>
  </div>
  <?= $offer->Details ?>

  <div class="styled-title mt-10 mb-10">
    <h3><?php trans_e("Profils recherchés"); ?></h3>
  </div>
  <?= $offer->Profil ?>

  <?php if(isset($offer->avis_concours) && $offer->avis_concours != '') : ?>
    <div class="styled-title mt-10 mb-10"><h3>Avis de concours</h3></div>
    <a href="<?= site_url('apps/upload/frontend/offre/avis_concours/'.$offer->avis_concours) ;?>"><i class="fa fa-download"> <?php trans_e("Télécharger"); ?></i></a>
  <?php endif; ?>

  <?php if(isset($offer->decisions_recrutement) && $offer->decisions_recrutement != '') : ?>
    <div class="styled-title mt-10 mb-10"><h3><?php trans_e("Décisions de recrutement"); ?></h3></div>
    <a href="<?= site_url('apps/upload/frontend/offre/decisions_recrutement/'.$offer->decisions_recrutement) ;?>"><i class="fa fa-download"> <?php trans_e("Télécharger"); ?></i></a>
  <?php endif; ?>

  <?php if(isset($offer->candidats_convoques) && $offer->candidats_convoques != '') : ?>
    <div class="styled-title mt-10 mb-10"><h3><?php trans_e("Liste des candidats convoqués"); ?></h3></div>
    <a href="<?= site_url('apps/upload/frontend/offre/candidats_convoques/'.$offer->candidats_convoques) ;?>"><i class="fa fa-download"> <?php trans_e("Télécharger"); ?></i></a>
  <?php endif; ?>

  <?php if(isset($offer->resultats_concours) && $offer->resultats_concours != '') : ?>
    <div class="styled-title mt-10 mb-10"><h3><?php trans_e("Résultats des concours"); ?></h3></div>
    <a href="<?= site_url('apps/upload/frontend/offre/resultats_concours/'.$offer->resultats_concours) ;?>"><i class="fa fa-download"> <?php trans_e("Télécharger"); ?></i></a>
  <?php endif; ?>

  <?php if(isset($offer->avis_modification) && $offer->avis_modification != '') : ?>
    <div class="styled-title mt-10 mb-10"><h3><?php trans_e("Avis de Modification"); ?></h3></div>
    <a href="<?= site_url('apps/upload/frontend/offre/avis_modification/'. $offer->avis_modification) ;?>"><i class="fa fa-download"> <?php trans_e("Télécharger"); ?></i></a>
  <?php endif; ?>

  <?php if(isset($offer->avis_report) && $offer->avis_report != '') : ?>
    <div class="styled-title mt-10 mb-10"><h3><?php trans_e("Avis de report"); ?></h3></div>
    <a href="<?= site_url('apps/upload/frontend/offre/avis_report/'. $offer->avis_report) ;?>"><i class="fa fa-download"> <?php trans_e("Télécharger"); ?></i></a>
  <?php endif; ?>
</div>

<?php if($offer->status != 'Archivée' && strtotime($offer->date_expiration) >= strtotime(date('Y-m-d', time()))) : ?>
<div class="ligneBleu"></div>
<ul id="offer-actions">
  <li class="mb-5">
    <a href="javascript:void(0)" onclick="return chmOffer.postuler(<?= $offer->id_offre; ?>)" class="btn btn-primary btn-sm"><i class="fa fa-reply-all"></i>&nbsp;<?php trans_e("Répondre à cette offre"); ?></a>
  </li>
  <li class="mb-5">
    <a href="<?= site_url('offres') ?>" class="btn btn-primary btn-sm"><i class="fa fa-list-ul"></i>&nbsp;<?php trans_e("Toutes les offres d'emploi"); ?></a>
  </li>
  <li class="mb-5 hidden-xs">
    <a href="javascript:void(0)" chm-print="#offer-container" chm-print-title="<?= $offer->Name; ?>" class="btn btn-primary btn-sm" id="offer-print"><i class="fa fa-print"></i>&nbsp;<?php trans_e("Imprimer l'offre"); ?></a>
  </li>
  <li class="mb-5">
    <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="return chmOffer.sendToFriend(<?= $offer->id_offre; ?>)"><i class="fa fa-envelope"></i>&nbsp;<?php trans_e("Envoyer cette offre à un ami"); ?></a>
  </li>
</ul>
<?php endif; ?>