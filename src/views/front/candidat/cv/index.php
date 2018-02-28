<h1>Mon CV</h1>

<?php
switch ($progress) {
  case '25':
    $progress_class = 'danger';
    break;
  case '50':
    $progress_class = 'warning';
    break;
  case '75':
    $progress_class = 'info';
    break;
  case '100':
    $progress_class = 'success';
    break;
  default:
    $progress_class = 'danger';
    break;
}
?>
<p class="mt-10 mb-5">Complété à <?= $progress; ?>%</p>
<div class="progress mb-10" style="height: 16px;">
  <div class="progress-bar progress-bar-xs progress-bar-<?= $progress_class; ?> progress-bar-striped" role="progressbar" aria-valuenow="<?= $progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $progress; ?>%">
    <span class="sr-only">Complété à <?= $progress; ?>%</span>
  </div>
</div>

<?php get_alert('warning', [
  '<strong style="font-size: 12px;">Afin d\'avoir une meilleure visibilité de votre candidature:</strong>', 
  'Ajouter d\'autres formations, <a href="javascript:void(0)" onclick="return chmFormation.getForm()">cliquer içi</a>', 
  'Ajouter d\'autres expériences professionnelles, <a href="javascript:void(0)" onclick="return chmExperience.getForm()">cliquer içi</a>'
  ], false) ?>