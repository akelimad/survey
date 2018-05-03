<?php
use App\Models\Candidat;
use App\Models\Candidature;
use App\Models\Situation;
use App\Models\Status;
use Modules\Message\Models\Message;
?>

<script src="http://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<style>
#alertsTable .actions {
  width: 120px;
}
</style>

<div id="account-container">
  <div class="row mb-10">
    <div class="col-sm-12">
      <h1 class="pull-left"><?php trans_e("Mon compte"); ?></h1>
      <a href="javascript:void(0)" chm-print="#account-container" chm-print-title="<?php trans_e("Mon compte"); ?>" class="btn btn-primary btn-xs pull-right hidden-xs" style="margin-top: 3px;"><i class="fa fa-print"></i>&nbsp;<?php trans_e("Imprimer"); ?></a>
    </div>
  </div>

  <div class="progress mb-10" style="height: 16px;text-align: center;">
    <div class="progress-bar progress-bar-xs progress-bar-default progress-bar-striped" role="progressbar" aria-valuenow="<?= $progress; ?>" aria-valuemin="0" aria-valuemax="100" style="background-color:#<?= $progress_color; ?>;width: <?= $progress; ?>%">
      <span style="font-size: 10px;margin-top: -2px;display: block;"><?php trans_e("Complété à"); ?> <?= $progress; ?>%</span>
    </div>
  </div>

  <?php if (\Modules\Candidat\Models\Candidat::canUpdateAccount()) :
    get_alert('warning', [
    '<strong style="font-size: 12px;">'. trans("Afin d'avoir une meilleure visibilité de votre candidature:") .'</strong>', 
    trans("Ajouter d'autres formations,") .' <a href="javascript:void(0)" onclick="return chmFormation.getForm()">'. trans("cliquer içi") .'</a>', 
    trans("Ajouter d'autres expériences professionnelles,") .' <a href="javascript:void(0)" onclick="return chmExperience.getForm()">'. trans("cliquer içi") .'</a>'
    ], false);
  endif; ?>

  <div class="styled-title mt-10 mb-10">
    <h3><?php trans_e("Mes informations"); ?></h3>
  </div>
  <div class="row">
    <div class="col-sm-2 col-xs-12">
      <img class="img-responsive pull-left mb-xs-10" src="<?= get_photo_url(get_candidat('photo', 'no-photo.png')); ?>">
    </div>
    <div class="col-sm-10 col-xs-12 pl-0 pl-xs-15">
      <table class="cvTable my-cv">
        <tr>
          <th colspan="2"><i class="fa fa-user"></i>&nbsp;<?= Candidat::getDisplayName(null, true); ?></th>
        </tr>
        <tr>
          <th width="110"><i class="fa fa-file-text-o"></i>&nbsp;<?php trans_e("Titre du CV"); ?></th>
          <td>:&nbsp;<?= get_candidat('titre'); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-envelope"></i>&nbsp;<?php trans_e("E-mail"); ?></th>
          <td>:&nbsp;<?= get_candidat('email'); ?></td>
        </tr>
        <tr>
          <th><i class="fa fa-hourglass-start"></i>&nbsp;<?php trans_e("Situation actuelle"); ?></th>
          <td>:&nbsp;<?= Situation::getNameById(get_candidat('id_situ')); ?></td>
        </tr>
        <tr>
          <td colspan="2"><i class="fa fa-eye"></i>&nbsp;<?php trans_e("Mon CV a été consulté"); ?>&nbsp;<strong><?= get_candidat('vues'); ?></strong>&nbsp;<?php trans_e("fois."); ?></td>
        </tr>
        <tr>
          <td colspan="2"><i class="fa fa-clock-o"></i>&nbsp;<?php trans_e("Mon CV a été mis à jour la dernière fois le"); ?> <strong><?= eta_date(get_candidat('dateMAJ')); ?></strong></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="styled-title mt-10 mb-5">
    <h3><?php trans_e("Offres correspondantes à votre profil"); ?></h3>
  </div>
  <?php $matchedOffers = Candidat::getMatchedOffers(); ?>
  <table class="table accountTable">
  <?php if(!empty($matchedOffers)) : ?>
    <thead>
      <tr>
        <th><?php trans_e("Date"); ?></th>
        <th><?php trans_e("Intitulé du poste"); ?></th>
        <th width="10"></th>
      </tr>
    </thead>
    <?php foreach ($matchedOffers as $key => $mo) : ?>
    <tr>
      <td><?= eta_date($mo->date_insertion); ?></td>
      <td><?= $mo->Name; ?></td>
      <td>
        <a target="_blank" href="<?= site_url('offre/'. $mo->id_offre); ?>" class="btn btn-primary btn-xs mb-0" title="<?php trans_e("Consulter l'offre"); ?>"><i class="fa fa-link"></i></a>
      </td>
    </tr>
  <?php endforeach; ?>
  <?php else : ?>
    <tr class="empty">
      <td colspan="3">
         <strong><?php trans_e("Aucune offre ne correspond à votre profil."); ?></strong>
      </td>
    </tr>
  <?php endif; ?>
  </table>

  <div class="styled-title mt-10 mb-5">
    <h3><?php trans_e("Mes candidatures"); ?></h3>
  </div>
  <?php $candidatures = Candidature::findAllByCandidatId(); ?>
  <table class="table accountTable">
  <?php if(!empty($candidatures)) : ?>
    <thead>
      <tr>
        <th><?php trans_e("Date"); ?></th>
        <th><?php trans_e("Intitulé du poste"); ?></th>
        <th><?php trans_e("Etat"); ?></th>
        <th width="60"><?php trans_e("Action"); ?></th>
      </tr>
    </thead>
    <?php foreach ($candidatures as $key => $ca) : ?>
    <tr>
      <td><?= eta_date($ca->date_candidature); ?></td>
      <td><a target="_blank" href="<?= site_url('offre/'. $ca->id_offre); ?>"><?= $ca->Name; ?></a></td>
      <td>
        <?php $history = Candidature::getHistoryStatus($ca->id_candidature); ?>
        <?= ($history->status != 'En attente') ? '<span class="label label-success">'. trans("En cours") .'</span>' : '<span class="label label-warning">'. trans("En attente") .'</span>'; ?></td>
      <td>
        <?php
        // Check if candidature need confirmation
        $calendar = getDB()->prepare("SELECT * FROM agenda WHERE id_candidature=?", [$ca->id_candidature], true);
        $confirmation_status = $calendar_status = $confirmation_link = 'javascript:void(0)';
        if (isset($calendar->id_agend)) {
          $confirmation_status = $calendar->confirmation_statu;
          if ($confirmation_status == 0) {
            $confirmation_link = site_url('candidature/confirm/'. md5($calendar->id_agend));
          }
          $calendar_status = $calendar->action;
        }
        
        // Prepare link attributes
        if ($confirmation_status == '0' && in_array($ca->c_status, [32, 39])) {
          $icon = 'fa fa-calendar-times-o';
          $label = trans("Non confirmé, cliquer pour confirmer.");
          $cursor = 'pointer';
          $btnType = 'danger';
          $btnDisabled = '';
        } elseif ($confirmation_status == '1' && in_array($ca->c_status, [33, 40])) {
          $icon = 'fa fa-calendar-check-o';
          $label = trans("Déja Confirmé");
          $cursor = 'default';
          $btnType = 'success';
          $btnDisabled = '';
        } else {
          $icon = 'fa fa-spinner';
          $label = trans("En attente");
          $cursor = 'default';
          $btnType = 'default';
          $btnDisabled = 'disabled';
        }
        ?>
        <a href="<?= $confirmation_link; ?>" class="btn btn-<?= $btnType; ?> btn-xs mb-0 <?= $btnDisabled; ?>" title="<?= $label; ?>" style="cursor: <?= $cursor; ?>"><i class="<?= $icon; ?>"></i></a>

        <?php if (isModuleEnabled('message') && Message::AdminIsStartingDiscussion($ca->id_candidature)) : ?>
        <a href="<?= site_url('message/candidature/'. $ca->id_candidature .'/messages') ?>" class="btn btn-default btn-xs mb-0" title="<?php trans_e("Discussion"); ?>" style="cursor: pointer"><i class="fa fa-comment-o"></i></a>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  <?php else : ?>
    <tr class="empty">
      <td colspan="4">
        <strong><?php trans_e("Aucune candidature enregistrée."); ?></strong>
      </td>
    </tr>
  <?php endif; ?>
  </table>


  <?php if (get_setting('front_menu_offres_candidature_spontannee') == 1) : ?>
  <div class="styled-title mt-10 mb-5">
    <h3><?php trans_e("Mes candidatures spontanées"); ?></h3>
  </div>
  <?php $csp = Candidature::getCandidaturesSpontanees(); ?>
  <table class="table accountTable" id="candidaturesSpontanees">
  <?php if(!empty($csp)) : ?>
    <thead>
      <tr>
        <th width="70"><?php trans_e("Date"); ?></th>
        <th><?php trans_e("Intitulé du poste"); ?></th>
        <th width="65"><?php trans_e("Etat"); ?></th>
        <th width="30"><?php trans_e("Action"); ?></th>
      </tr>
    </thead>
    <?php foreach ($csp as $key => $value) : ?>
    <tr id="csp_<?= $value->id_candidature; ?>">
      <td><?= eta_date($value->date_cs, get_setting('date_format')); ?></td>
      <td><?php trans_e("Candidature spontanée"); ?></td>
      <td><span class="label label-success"><?php trans_e("En cours"); ?></span></td>
      <td>
        <a href="javascript:void(0)" onclick="return chmModal.confirm('', '', '<?php trans_e("Êtes-vous sûr de vouloir supprimer cette candidature ?"); ?>', 'chmCandidature.deleteSpontanee', {'id': <?= $value->id_candidature; ?>}, {width: 375})" class="btn btn-danger btn-xs mb-0" title="Supprimer"><i class="fa fa-trash"></i></a>
      </td>
    </tr>
    <?php endforeach; ?>
  <?php else : ?>
    <tr class="empty">
      <td colspan="4">
        <strong><?php trans_e("Aucune candidature enregistrée."); ?></strong>
      </td>
    </tr>
  <?php endif; ?>
  </table>
  <?php endif; ?>


  <?php if (get_setting('front_menu_offres_candidature_stage') == 1) : ?>
  <div class="styled-title mt-10 mb-5">
    <h3><?php trans_e("Mes candidature pour stage"); ?></h3>
  </div>
  <?php $stages = Candidature::getCandidaturesStage(); ?>
  <table class="table accountTable" id="candidaturesStage">
  <?php if(!empty($stages)) : ?>
    <thead>
      <tr>
        <th width="70"><?php trans_e("Date"); ?></th>
        <th><?php trans_e("Intitulé du poste"); ?></th>
        <th width="65"><?php trans_e("Etat"); ?></th>
        <th width="30"><?php trans_e("Action"); ?></th>
      </tr>
    </thead>
    <?php foreach ($stages as $key => $stage) : ?>
    <tr id="stage_<?= $stage->id_candidature; ?>">
      <td><?= eta_date($stage->date, get_setting('date_format')); ?></td>
      <td><?php trans_e("Candidature pour stage"); ?></td>
      <td><span class="label label-success"><?php trans_e("En cours"); ?></span></td>
      <td>
        <a href="javascript:void(0)" onclick="return chmModal.confirm('', '', '<?php trans_e("Êtes-vous sûr de vouloir supprimer cette candidature ?"); ?>', 'chmCandidature.deleteStage', {'id': <?= $stage->id_candidature; ?>}, {width: 375})" class="btn btn-danger btn-xs mb-0" title="<?php trans_e("Supprimer"); ?>"><i class="fa fa-trash"></i></a>
      </td>
    </tr>
    <?php endforeach; ?>
  <?php else : ?>
    <tr class="empty">
      <td colspan="4">
        <strong><?php trans_e("Aucune candidature enregistrée."); ?></strong>
      </td>
    </tr>
  <?php endif; ?>
  </table>
  <?php endif; ?>

  <div class="styled-title mt-10 mb-0">
    <h3 class="pull-left"><?php trans_e("Mes alertes"); ?></h3>
    <a href="javascript:void(0)" class="pull-right mr-10" onclick="return chmJobAlerts.form()" style="color: #fff;margin-top: -1px;"><i class="fa fa-plus"></i>&nbsp;<?php trans_e("Créer une nouvelle alerte candidat"); ?></a>
  </div>
  <div chm-table="candidat/account/alert/table" id="alertsTable"></div>


</div><!-- /#account-container -->