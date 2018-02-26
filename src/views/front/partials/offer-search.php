<form method="GET" action="<?= site_url('offres'); ?>">
  <div class="panel panel-default">
    <div class="panel-body">
      <?php // $count = getDB()->prepare("SELECT COUNT(*) AS nbr FROM offre", [], true); intval($count->nbr) ?>
      <p><strong class="total-offers">0</strong>&nbsp;offres en ligne</p>
        <div class="row">
          <div class="col-sm-5 mb-5 mb-xs-5">
            <label for="keywords">Mots clés</label>
            <input type="text" name="s" id="keywords" value="<?= (isset($s)) ? $s : ''; ?>" title="Saisissez vos mots clés (EX: Informatique, infographiste,...)">
          </div>
          <div class="col-sm-4 mb-5 mb-xs-5 pl-0 pl-xs-15">
            <label for="fonction">Fonctions</label>
            <select name="f[]" id="fonction" multiple>
              <?php foreach (getDB()->read('prm_fonctions') as $key => $value) : ?>
                <?php $selected = (isset($f) && in_array($value->id_fonc, $f)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_fonc ?>" <?= $selected ?>><?= $value->fonction ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-3 mb-5 pl-0 pl-xs-15">
            <label for="local">Lieu de travail</label>
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
            <label for="experience">Niveau d'expérience</label>
            <select name="e[]" id="experience" multiple>
              <?php foreach (getDB()->read('prm_experience') as $key => $value) : ?>
                <?php $selected = (isset($e) && in_array($value->id_expe, $e)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_expe ?>" <?= $selected ?>><?= $value->intitule ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-4 mb-5 mb-xs-5 pl-0 pl-xs-15">
            <label for="nfor">Niveau d'étude</label>
            <select name="nf[]" id="nfor" multiple>
              <?php foreach (getDB()->read('prm_niv_formation') as $key => $value) : ?>
                <?php $selected = (isset($nf) && in_array($value->id_nfor, $nf)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_nfor ?>" <?= $selected ?>><?= $value->formation ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-3 mb-5 mb-xs-5 pl-0 pl-xs-15">
            <label for="type_poste">Type de poste</label>
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
            <label for="sec">Secteur d'activité</label>
            <select name="sec[]" id="sec" multiple>
              <?php foreach (getDB()->read('prm_sectors') as $key => $value) : ?>
                <?php $selected = (isset($sec) && in_array($value->id_sect, $sec)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_sect ?>" <?= $selected ?>><?= $value->FR ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-sm-4 mb-5 mb-xs-5 pl-0 pl-xs-15">
            <label for="mobi">Mobilité</label>
            <select name="m[]" id="mobi" multiple>
              <?php foreach (getDB()->read('prm_mobi_niv') as $key => $value) : ?>
                <?php $selected = (isset($m) && in_array($value->id_mobi_niv, $m)) ? 'selected' : ''; ?>
                <option value="<?= $value->id_mobi_niv ?>" <?= $selected ?>><?= $value->niveau ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>

      <div class="row mt-10">
        <div class="col-sm-3 col-xs-6">
          <a href="<?= site_url('offres'); ?>"><i class="fa fa-list-ul"></i>&nbsp;Voir toutes les offres</a>
        </div>
        <div class="col-sm-3 col-sm-offset-4 col-xs-6">
          <a href="javascript:void(0)" onclick="return chmOffer.showAdvancedSearch()" class="pull-right" style="margin-top: 4px;"><i class="fa fa-search-plus"></i>&nbsp;Recherche avancée</a>
        </div>
        <div class="col-sm-2 col-xs-12 mt-xs-10">
          <button type="submit" class="btn btn-primary btn-xs pull-right"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
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