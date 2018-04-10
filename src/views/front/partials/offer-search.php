<form method="GET" action="<?= site_url('offres'); ?>">
  <div class="panel panel-default">
    <div class="panel-body">

      <?php
      $route = str_replace(site_url(), '', strtok($_SERVER['HTTP_REFERER'], '?'));
      switch ($route) {
        case 'offres':
          $label = trans("offre(s) d'emploi trouvé(s)");
          break;
        case 'offres/stage':
          $label = trans("offre(s) de stage trouvé(s)");
          break;
        default:
          $label = trans("offres en ligne");
          break;
      }
      ?>
      <p><strong class="total-offers">0</strong>&nbsp;<?php echo $label ?></p>

        <div class="row">
          <div class="col-sm-5 mb-5 mb-xs-5">
            <label for="keywords"><?php trans_e("Mots clés"); ?></label>
            <input type="text" name="s" id="keywords" value="<?= (isset($s)) ? $s : ''; ?>" title="Saisissez vos mots clés (EX: Informatique, infographiste,...)">
          </div>
          <div class="col-sm-4 mb-5 mb-xs-5 pl-0 pl-xs-15">
            <label for="fonction"><?php trans_e("Fonctions"); ?></label>
            <select name="f[]" id="fonction" multiple>
              <?php foreach (getDB()->read('prm_fonctions') as $key => $value) : ?>
                <?php $selected = (isset($f) && in_array($value->id_fonc, $f)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_fonc ?>" <?= $selected ?>><?= $value->fonction ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-3 mb-5 pl-0 pl-xs-15">
            <label for="local"><?php trans_e("Lieu de travail"); ?></label>
            <select name="l[]" id="local" multiple>
              <?php foreach (getDB()->read('prm_localisation') as $key => $value) : ?>
                <?php $selected = (isset($l) && in_array($value->id_localisation, $l)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_localisation ?>" <?= $selected ?>><?= $value->localisation ?></option>
              <?php endforeach; ?>
            </select>
          </div>
      </div>

      <div class="mb-5 chm-advanced-search" style="display:<?= (read_cookie('eta_of') == 1) ? 'block' : 'none' ?>;">
        <div class="row">
          <div class="col-sm-5 mb-5">
            <label for="experience"><?php trans_e("Niveau d'expérience"); ?></label>
            <select name="e[]" id="experience" multiple>
              <?php foreach (getDB()->read('prm_experience') as $key => $value) : ?>
                <?php $selected = (isset($e) && in_array($value->id_expe, $e)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_expe ?>" <?= $selected ?>><?= $value->intitule ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-4 mb-5 mb-xs-5 pl-0 pl-xs-15">
            <label for="nfor"><?php trans_e("Niveau d'étude"); ?></label>
            <select name="nf[]" id="nfor" multiple>
              <?php foreach (getDB()->read('prm_niv_formation') as $key => $value) : ?>
                <?php $selected = (isset($nf) && in_array($value->id_nfor, $nf)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_nfor ?>" <?= $selected ?>><?= $value->formation ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-3 mb-5 mb-xs-5 pl-0 pl-xs-15">
            <label for="type_poste"><?php trans_e("Type de poste"); ?></label>
            <select name="tp[]" id="type_poste" multiple>
              <?php foreach (getDB()->read('prm_type_poste') as $key => $value) : ?>
                <?php $selected = (isset($tp) && in_array($value->id_tpost, $tp)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_tpost ?>" <?= $selected ?>><?= $value->designation ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5 mb-5">
            <label for="sec"><?php trans_e("Secteur d'activité"); ?></label>
            <select name="sec[]" id="sec" multiple>
              <?php foreach (getDB()->read('prm_sectors') as $key => $value) : ?>
                <?php $selected = (isset($sec) && in_array($value->id_sect, $sec)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_sect ?>" <?= $selected ?>><?= $value->FR ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-4 mb-5 mb-xs-5 pl-0 pl-xs-15">
            <label for="mobi"><?php trans_e("Mobilité"); ?></label>
            <select name="m[]" id="mobi" multiple>
              <?php foreach (getDB()->read('prm_mobi_niv') as $key => $value) : ?>
                <?php $selected = (isset($m) && in_array($value->id_mobi_niv, $m)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_mobi_niv ?>" <?= $selected ?>><?= $value->niveau ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>

      <p class="mb-0"><?php trans_e("* <strong>Ctrl + Bouton gauche</strong> de la souris pour séléctionner multiples choix."); ?></p>

      <div class="row mt-5">
        <div class="col-sm-3 col-xs-6">
          <a href="<?= site_url('offres'); ?>"><i class="fa fa-list-ul"></i>&nbsp;<?php trans_e("Voir toutes les offres"); ?></a>
        </div>
        <div class="col-sm-3 col-sm-offset-4 col-xs-6">
          <a href="javascript:void(0)" onclick="return chmOffer.showAdvancedSearch()" class="pull-right" style="margin-top: 4px;"><i class="fa fa-search-plus"></i>&nbsp;<?php trans_e("Recherche avancée"); ?></a>
        </div>
        <div class="col-sm-2 col-xs-12 mt-xs-10">
          <button type="submit" class="btn btn-primary btn-xs pull-right"><i class="fa fa-search"></i>&nbsp;<?php trans_e("Rechercher"); ?></button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
$(document).ready(function() {
  $('select[multiple]').select2()
})
</script>