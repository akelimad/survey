<?php
use App\Models\Candidat;
use App\Models\Sector;
use App\Models\Fonction;
use App\Models\TypePoste;
use App\Models\Country;
use App\Models\Filiere;
use App\Models\Experience;
use App\Models\FormationLevel;
use App\Models\School;
use App\Models\Situation;
use App\Models\Availability;
use App\Models\Mobilite;
use App\Models\Salary;
use App\Models\TypeFormation;
?>
<script src="<?= site_url('assets/vendors/html2canvas/html2canvas.min.js'); ?>"></script>

<div id="cv-container">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="pull-left"><?php trans_e("Mon CV"); ?></h1>
      <div class="cv-print-btn">
        <a href="javascript:void(0)" chm-print="#cv-container" chm-print-title="<?php trans_e("Mon CV"); ?>" class="btn btn-primary btn-xs pull-right hidden-xs" id="cv-print" style="margin-top: 3px;"><i class="fa fa-print"></i>&nbsp;<?php trans_e("Imprimer"); ?></a>
      </div>
    </div>
  </div>

  <div id="progress-container">
    <p class="mt-10 mb-5"><?php trans_e("Complété à"); ?> <?= $progress; ?>%</p>
    <div class="progress mb-10" style="height: 16px;">
      <div class="progress-bar progress-bar-xs progress-bar-default progress-bar-striped" role="progressbar" aria-valuenow="<?= $progress; ?>" aria-valuemin="0" aria-valuemax="100" style="background-color:#<?= $progress_color; ?>;width: <?= $progress; ?>%">
        <span class="sr-only"><?php trans_e("Complété à"); ?> <?= $progress; ?>%</span>
      </div>
    </div>
  </div>

  <div class="cv-alert">
  <?php get_alert('warning', [
    '<strong style="font-size: 12px;">'. trans("Afin d'avoir une meilleure visibilité de votre candidature:") .'</strong>', 
    trans("Ajouter d'autres formations,") .' <a href="javascript:void(0)" onclick="return chmFormation.getForm()">'. trans("cliquer içi") .'</a>', 
    trans("Ajouter d'autres expériences professionnelles,") .' <a href="javascript:void(0)" onclick="return chmExperience.getForm()">'. trans("cliquer içi") .'</a>'
    ], false) ?>
  </div>

  <div class="styled-title mt-10 mb-10">
    <h3><?php trans_e("Mes informations"); ?></h3>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <table class="cvTable">
        <tr>
          <th width="130"><i class="fa fa-file-text-o"></i>&nbsp;<?php trans_e("Titre du CV"); ?></th>
          <td>:&nbsp;<?= get_candidat('titre'); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-pencil"></i>&nbsp;<?php trans_e("Date de création"); ?></th>
          <td>:&nbsp;<?= eta_date(get_candidat('date_inscription')); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-clock-o"></i>&nbsp;<?php trans_e("Date de modification"); ?></th>
          <td>:&nbsp;<?= eta_date(get_candidat('dateMAJ')); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-hourglass-start"></i>&nbsp;<?php trans_e("Situation actuelle"); ?></th>
          <td>:&nbsp;<?= Situation::getNameById(get_candidat('id_situ')); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-anchor"></i>&nbsp;<?php trans_e("Disponibilité"); ?></th>
          <td>:&nbsp;<?= Availability::getNameById(get_candidat('id_dispo')); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-plane"></i>&nbsp;<?php trans_e("Mobilite"); ?></th>
          <td>:&nbsp;<?= ucfirst(get_candidat('mobilite', 'non')); ?>
            <?php
            $level = Mobilite::getLevelNameById(get_candidat('niveau_mobilite'));
            $rate = Mobilite::getRateNameById(get_candidat('taux_mobilite'));
            if ($level != '') echo ' | '. $level;
            if ($rate != '') echo ' | '. $rate;
            ?>          
          </td>
        </tr>
      </table>
    </div>
    <div class="col-sm-6">
      <table class="cvTable">
        <tr>
          <th width="125"><i class="fa fa-money"></i>&nbsp;<?php trans_e("Salaire souhaité"); ?></th>
          <td>:&nbsp;<?= Salary::getNameById(get_candidat('id_salr')); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-cogs"></i>&nbsp;<?php trans_e("Fonction souhaitée"); ?></th>
          <td>:&nbsp;<?= Fonction::getNameById(get_candidat('id_fonc')); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-binoculars"></i>&nbsp;<?php trans_e("Secteur souhaité"); ?></th>
          <td>:&nbsp;<?= Sector::getNameById(get_candidat('id_sect')); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-briefcase"></i>&nbsp;<?php trans_e("Durée d'expérience"); ?></th>
          <td>:&nbsp;<?= Experience::getNameById(get_candidat('id_expe')); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-graduation-cap"></i>&nbsp;<?php trans_e("Type de formation"); ?></th>
          <td>:&nbsp;<?= TypeFormation::getNameById(get_candidat('id_tfor')); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-signal"></i>&nbsp;<?php trans_e("Niveau de formation"); ?></th>
          <td>:&nbsp;<?= FormationLevel::getNameById(get_candidat('id_nfor')); ?></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="styled-title mt-10 mb-10">
    <h3><?php trans_e("MON CV"); ?></h3>
  </div>

  <div class="row">
    <div class="col-sm-9">
      <table class="cvTable my-cv">
        <tr>
          <th colspan="2"><i class="fa fa-user"></i>&nbsp;<?= Candidat::getDisplayName(null, true); ?></th>
        </tr>
        <tr>
          <th width="120"><i class="fa fa-envelope"></i>&nbsp;<?php trans_e("E-mail"); ?></th>
          <td>:&nbsp;<?= get_candidat('email'); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-phone"></i>&nbsp;<?php trans_e("Télephone"); ?></th>
          <td>:&nbsp;<?= get_candidat('tel1'); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-map-marker"></i>&nbsp;<?php trans_e("Adresse"); ?></th>
          <td>:&nbsp;<?= get_candidat('adresse'); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-street-view"></i>&nbsp;<?php trans_e("Ville"); ?></th>
          <td>:&nbsp;<?= get_candidat('ville'); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-map"></i>&nbsp;<?php trans_e("Pays de résidance"); ?></th>
          <td>:&nbsp;<?= Country::getNameById(get_candidat('id_pays')); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-address-card-o"></i>&nbsp;<?php trans_e("Nationalité"); ?></th>
          <td>:&nbsp;<?= get_candidat('nationalite'); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-calendar"></i>&nbsp;<?php trans_e("Date de naissance"); ?></th>
          <td>:&nbsp;<?= eta_date(get_candidat('date_n')); ?></td>
        </tr>
      </table>
    </div>
    <div class="col-sm-3">
      <img class="img-responsive pull-right" src="<?= get_photo_url(get_candidat('photo', 'no-photo.png')); ?>">
    </div>
  </div>


  <div class="styled-title mt-10 mb-10">
    <h3><?php trans_e("Formations"); ?></h3>
  </div>
  <?php if (!empty($formations)) : ?>
  <?php foreach ($formations as $key => $formation) : ?>
    <div class="row mb-10">
      <div class="col-sm-3 mb-5">
        <strong><?= eta_date($formation->date_debut, '%b %Y', true); ?>&nbsp;-&nbsp;<?= ($formation->date_fin != '') ? eta_date($formation->date_fin, '%b %Y', true) : trans("Aujourd'hui"); ?></strong>
      </div>
      <div class="col-sm-9 pl-0 pl-xs-15">
        <?php 
        $filiere = Filiere::getNameById($formation->diplome);
        $level = FormationLevel::getNameById($formation->nivformation);
        $school = ($formation->ecole != '') ? $formation->ecole : School::getNameById($formation->id_ecol);
        $country = School::getCountryNameById($formation->id_ecol);
        $formaOutput = '<strong>'. $filiere;
        if ($filiere != '' && $level != '') $formaOutput .= ' - ';
        $formaOutput .= $level .'</strong><br>';
        $formaOutput .= $school;
        if ($school != '' && $country != '') $formaOutput .= ' - ';
        $formaOutput .= $country;
        echo $formaOutput;
        ?>
      </div>
    </div>
    <?php endforeach; ?>
  <?php else : ?>
    <strong><?php trans_e("Aucune formation trouvée."); ?></strong>
  <?php endif; ?>


  <div class="styled-title mt-10 mb-10">
    <h3><?php trans_e("Experiences"); ?></h3>
  </div>
  <?php if (!empty($experiences)) : ?>
  <?php foreach ($experiences as $key => $experience) : ?>
    <div class="row mb-10">
      <div class="col-sm-3 mb-5">
        <strong><?= eta_date($experience->date_debut, '%b %Y', true); ?>&nbsp;-&nbsp;<?= ($experience->date_fin != '') ? eta_date($experience->date_fin, '%b %Y', true) : trans("Aujourd'hui"); ?></strong>
      </div>
      <div class="col-sm-9 pl-0 pl-xs-15">
        <?php
        $sector = Sector::getNameById($experience->id_sect);
        $fonction = Fonction::getNameById($experience->id_fonc);
        $typePoste = TypePoste::getNameById($experience->id_tpost);
        $country = Country::getNameById($experience->id_pays);

        $formaOutput = '<strong>'. $sector;
        if ($fonction != '' && $sector != '') $formaOutput .= ' - ';
        $formaOutput .= $fonction .'</strong><br>';

        $formaOutput .= $experience->poste;
        if ($experience->poste != '' && $experience->entreprise != '') $formaOutput .= ' - ';
        $formaOutput .= $experience->entreprise;
        if (($experience->entreprise != '' || $experience->poste != '') && $experience->ville != '') $formaOutput .= ' - ';
        $formaOutput .= $experience->ville .'<br>';

        $formaOutput .= $typePoste;
        if ($typePoste != '' && $country != '') $formaOutput .= ' - ';
        $formaOutput .= $country;
        echo $formaOutput;
        ?>
      </div>
    </div>
    <?php endforeach; ?>
  <?php else : ?>
    <strong><?php trans_e("Aucune expérience trouvée."); ?></strong>
  <?php endif; ?>

  <div class="styled-title mt-10 mb-10">
    <h3><?php trans_e("Langues"); ?></h3>
  </div>

  <div class="row" id="cv-languages">
    <?php if (get_candidat('arabic') != '') : ?>
    <div class="col-sm-4 mb-10">
      <span><?php trans_e("Arabe"); ?>&nbsp;<strong>(<?= get_candidat('arabic'); ?>)</strong></span>
    </div>
    <?php endif; ?>
    <?php if (get_candidat('french') != '') : ?>
    <div class="col-sm-4 mb-10">
      <span><?php trans_e("Français"); ?>&nbsp;<strong>(<?= get_candidat('french'); ?>)</strong></span>
    </div>
    <?php endif; ?>
    <?php if (get_candidat('english') != '') : ?>
    <div class="col-sm-4 mb-10">
      <span><?php trans_e("Anglais"); ?>&nbsp;<strong>(<?= get_candidat('english'); ?>)</strong></span>
    </div>
    <?php endif; ?>
    <?php if (get_candidat('autre') != '') : ?>
    <div class="col-sm-4 mb-10">
      <span><?= get_candidat('autre'); ?>&nbsp;<strong>(<?= get_candidat('autre_n'); ?>)</strong></span>
    </div>
    <?php endif; ?>
    <?php if (get_candidat('autre1') != '') : ?>
    <div class="col-sm-4 mb-10">
      <span><?= get_candidat('autre1'); ?>&nbsp;<strong>(<?= get_candidat('autre1_n'); ?>)</strong></span>
    </div>
    <?php endif; ?>
    <?php if (get_candidat('autre2') != '') : ?>
    <div class="col-sm-4 mb-10">
      <span><?= get_candidat('autre2'); ?>&nbsp;<strong>(<?= get_candidat('autre2_n'); ?>)</strong></span>
    </div>
    <?php endif; ?>
  </div>

  <div class="styled-title mb-10">
    <h3><?php trans_e("Fichiers joints"); ?></h3>
  </div>

  <div class="row">
    <?php if (!empty($cvs)) : ?>
    <div class="col-sm-6">
    <strong><?php trans_e("CVs"); ?></strong>
    <ul class="mt-10">
    <?php foreach ($cvs as $key => $cv) : ?>
      <li class="mb-5">
        <a target="_blank" href="<?= get_resume_url($cv->lien_cv); ?>" title="<?php trans_e("Télécharger"); ?>"><i class="fa fa-download"></i></a>
        <?= $cv->titre_cv; ?>
      </li>
    <?php endforeach; ?>
    </ul>
    </div>
    <?php endif; ?>

    <?php if (!empty($lms)) : ?>
    <div class="col-sm-6">
    <strong><?php trans_e("Lettres de motivation"); ?></strong>
    <ul class="mt-10">
    <?php foreach ($lms as $key => $lm) : ?>
      <li class="mb-5">
        <a target="_blank" href="<?= get_motivation_letter_url($lm->lettre); ?>" title="<?php trans_e("Télécharger"); ?>"><i class="fa fa-download"></i></a>
        <?= $lm->titre; ?>
      </li>
    <?php endforeach; ?>
    </ul>
    </div>
    <?php endif; ?>
  </div>
</div><!-- / #cv-container -->