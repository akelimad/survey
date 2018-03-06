<h1>Informations personnalles</h1>


<form method="POST" action="<?= site_url('candidat/cv/informations'); ?>" class="chm-simple-form" onsubmit="return window.chmForm.submit(event)">

  <div class="mt-10 mb-10"><?php get_alert('warning', 'Les champs marqués par (*) sont obligatoires', false) ?></div>

  <div class="styled-title mt-0 mb-10" style="height: 23px;">
    <h3>Intitulé du profil</h3>
  </div>
  <div class="row">
    <div class="col-sm-6 required">
      <label for="candidat_titre">Titre de votre profil&nbsp;</label>
      <input type="text" class="form-control" id="candidat_titre" name="titre" value="<?= get_candidat('titre') ?>" required>
      <p class="help-block">(EX: Développeur informatique, Consultant SI, Chef de projet...)</p>
    </div>
  </div>

  <div class="styled-title mt-0 mb-10" style="height: 23px;">
    <h3>État civil</h3>
  </div>
  <div class="row">
    <div class="col-sm-2 required">
      <label for="civilite">Civilité</label>
      <select id="civilite" name="id_civi" class="form-control" required>
        <option value=""></option>
        <?php foreach (getDB()->read('prm_civilite') as $key => $value) : 
          $selected = (get_candidat('id_civi') == $value->id_civi) ? 'selected' : '';
        ?>
          <option value="<?= $value->id_civi ?>" <?= $selected ?>><?= $value->civilite ?></option>
        <?php endforeach; ?>
          </select>
    </div>
    <div class="col-sm-3 pl-0 pl-xs-15 required">
      <label for="nom">Nom</label>
      <input type="text" class="form-control" id="nom" name="nom" value="<?= get_candidat('nom') ?>" required>
    </div>
    <div class="col-sm-3 pl-0 pl-xs-15 required">
      <label for="prenom">Prénom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" value="<?= get_candidat('prenom') ?>" required>
    </div>
    <div class="col-sm-4 pl-0 pl-xs-15 required">
      <label for="candidat_date_n">Date de naissance</label>
      <input type="date" min="<?= date('Y-m-d', strtotime('-63year')); ?>" max="<?= date('Y-m-d', strtotime('-16year')); ?>" class="form-control" id="candidat_date_n" name="date_n" value="<?= french_to_english_date(get_candidat('date_n')) ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8 required">
      <label for="adresse">Adresse</label>
      <input type="text" class="form-control" id="adresse" name="adresse" value="<?= get_candidat('adresse') ?>" required>
    </div>
    <div class="col-sm-4 pl-0 pl-xs-15">
      <label for="code">Code postal</label>
      <input type="number" min="1" step="1" class="form-control" id="code" name="code" value="<?= get_candidat('code') ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4 required">
      <label for="ville">Ville</label>
      <select id="ville" name="ville" class="form-control" required>
        <option value=""></option>
        <?php foreach ($villes as $key => $value) : 
        $selected = (get_candidat('ville') == $value->ville) ? 'selected' : '';
        ?>
          <option value="<?= $value->ville ?>" <?= $selected; ?>><?= $value->ville ?></option>
        <?php endforeach; ?>
          </select>
    </div>
    <div class="col-sm-4 pl-0 pl-xs-15 required">
      <label for="candidat_pays">Pays de résidence</label>
      <select id="candidat_pays" name="id_pays" class="form-control" required>
        <option value="" data-code=""></option>
        <?php 
        $dial_code = ''; 
        foreach ($pays as $key => $value) : 
        $selected = '';
        if (get_candidat('id_pays') == $value->id_pays) {
          $dial_code = $value->dial_code;
          $selected = 'selected';
        }
        ?>
          <option value="<?= $value->id_pays ?>" data-code="<?= $value->dial_code ?>" <?= $selected; ?>><?= $value->pays ?></option>
        <?php endforeach; ?>
          </select>
    </div>
    <div class="col-sm-4 pl-0 pl-xs-15 col-xs-12 required">
      <label for="nationalite">Nationalité</label>
      <input type="text" class="form-control" id="nationalite" name="nationalite" value="<?= get_candidat('nationalite') ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4 col-xs-12 required">
      <label for="cin">CIN</label>
      <input type="text" class="form-control" id="cin" name="cin" value="<?= get_candidat('cin') ?>" required>
    </div>
    <div class="col-sm-4 col-xs-12 pl-0 pl-xs-15 required">
      <label for="tel1">Téléphone</label>
      <input type="text" class="form-control deal_code" placeholder="(+212)" value="(+<?= $dial_code ?>)" style="float: left;max-width: 55px;" disabled>
      <input type="text" class="form-control" id="tel1" name="tel1" value="<?= get_candidat('tel1') ?>" placeholder="0611223344" style="float: left;max-width: 165px;margin-left: 5px;" required>
    </div>
    <div class="col-sm-4 col-xs-12 pl-0 pl-xs-15">
      <label for="tel2">Téléphone secondaire</label>
      <input type="text" class="form-control deal_code" placeholder="(+212)" value="(+<?= $dial_code ?>)" style="float: left;max-width: 55px;" disabled>
      <input type="text" class="form-control" id="tel2" name="tel2" value="<?= get_candidat('tel2') ?>" placeholder="0511223344" style="float: left;max-width: 165px;margin-left: 5px;">
    </div>
  </div>


  <div class="styled-title mt-0 mb-10" style="height: 23px;">
    <h3>Profil</h3>
  </div>
  <div class="row">
    <div class="col-sm-4 required">
      <label for="situation">Situation actuelle</label>
      <select id="situation" name="id_situ" class="form-control" required>
        <option value=""></option>
        <?php foreach (getDB()->read('prm_situation') as $key => $value) : 
        $selected = (get_candidat('id_situ') == $value->id_situ) ? 'selected' : '';
        ?>
          <option value="<?= $value->id_situ ?>" <?= $selected ?>><?= $value->situation ?></option>
        <?php endforeach; ?>
          </select>
    </div>
    <div class="col-sm-4 pl-0 pl-xs-15 required">
      <label for="candidat_sector">Secteur actuel</label>
      <select id="candidat_sector" name="id_sect" class="form-control" required>
        <option value=""></option>
        <?php foreach ($sectors as $key => $value) : 
        $selected = (get_candidat('id_sect') == $value->id_sect) ? 'selected' : '';
        ?>
          <option value="<?= $value->id_sect ?>" <?= $selected ?>><?= $value->FR ?></option>
        <?php endforeach; ?>
          </select>
    </div>
    <div class="col-sm-4 pl-0 pl-xs-15 required">
      <label for="fonction">Fonction</label>
      <select id="fonction" name="id_fonc" class="form-control" required>
        <option value=""></option>
        <?php foreach (getDB()->read('prm_fonctions') as $key => $value) : 
        $selected = (get_candidat('id_fonc') == $value->id_fonc) ? 'selected' : '';
        ?>
          <option value="<?= $value->id_fonc ?>" <?= $selected ?>><?= $value->fonction ?></option>
        <?php endforeach; ?>
          </select>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4 required">
      <label for="salaire">Salaire souhaité</label>
      <select id="salaire" name="id_salr" class="form-control" required>
        <option value=""></option>
        <?php foreach (getDB()->read('prm_salaires') as $key => $value) : 
        $selected = (get_candidat('id_salr') == $value->id_salr) ? 'selected' : '';
        ?>
          <option value="<?= $value->id_salr ?>" <?= $selected ?>><?= $value->salaire ?></option>
        <?php endforeach; ?>
          </select>
    </div>
    <div class="col-sm-4 pl-0 pl-xs-15 required">
      <label for="formation">Niveau de formation</label>
      <select id="formation" name="id_nfor" class="form-control" required>
        <option value=""></option>
        <?php foreach ($niv_formation as $key => $value) : 
        $selected = (get_candidat('id_nfor') == $value->id_nfor) ? 'selected' : '';
        ?>
          <option value="<?= $value->id_nfor ?>" <?= $selected ?>><?= $value->formation ?></option>
        <?php endforeach; ?>
          </select>
    </div>
    <div class="col-sm-4 pl-0 pl-xs-15 required">
      <label for="type_formation">Type de formation</label>
      <select id="type_formation" name="id_tfor" class="form-control" required>
        <option value=""></option>
        <?php foreach (getDB()->read('prm_type_formation') as $key => $value) : 
        $selected = (get_candidat('id_tfor') == $value->id_tfor) ? 'selected' : '';
        ?>
          <option value="<?= $value->id_tfor ?>" <?= $selected ?>><?= $value->formation ?></option>
        <?php endforeach; ?>
          </select>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4 required">
      <label for="disponibilite">Disponibilité</label>
      <select id="disponibilite" name="id_dispo" class="form-control" required>
        <option value=""></option>
        <?php foreach (getDB()->read('prm_disponibilite') as $key => $value) : 
        $selected = (get_candidat('id_dispo') == $value->id_dispo) ? 'selected' : '';
        ?>
          <option value="<?= $value->id_dispo ?>" <?= $selected ?>><?= $value->intitule ?></option>
        <?php endforeach; ?>
          </select>
    </div>
    <div class="col-sm-4 pl-0 pl-xs-15 required">
      <label for="experience">Expérience</label>
      <select id="experience" name="id_expe" class="form-control" required>
        <option value=""></option>
        <?php foreach (getDB()->read('prm_experience') as $key => $value) : 
        $selected = (get_candidat('id_expe') == $value->id_expe) ? 'selected' : '';
        ?>
          <option value="<?= $value->id_expe ?>" <?= $selected ?>><?= $value->intitule ?></option>
        <?php endforeach; ?>
          </select>
    </div>
  </div>
  <div class="row mb-10">
    <div class="col-sm-3 col-xs-12 required">
      <label>Mobilité géographique</label>
      <label for="oui" class="pull-left">
        <input id="oui" name="mobilite" type="radio" value="oui" <?= (get_candidat('mobilite') == 'oui') ? 'checked' : '' ?> required>&nbsp;Oui
      </label>
      <label for="non" class="pull-left ml-10">
        <input id="non" name="mobilite" type="radio" value="non" <?= (get_candidat('mobilite') == 'non') ? 'checked' : '' ?> required>&nbsp;Non
      </label>
    </div>
    <div class="col-sm-5 col-xs-12 required" id="niveau-container" <?= (get_candidat('mobilite') == 'non') ? 'style="display: none;"' : '' ?>>
      <label>Au niveau</label>
      <label for="national" class="pull-left">
        <input id="national" name="niveau_mobilite" type="radio" value="1" <?= (get_candidat('niveau_mobilite') == 1) ? 'checked' : '' ?>>&nbsp;National
      </label>
      <label for="international" class="pull-left ml-10">
        <input id="international" name="niveau_mobilite" type="radio" value="2" <?= (get_candidat('niveau_mobilite') == 2) ? 'checked' : '' ?>>&nbsp;International
      </label>
      <label for="globale" class="pull-left ml-10">
        <input id="globale" name="niveau_mobilite" type="radio" value="3" <?= (get_candidat('niveau_mobilite') == 3) ? 'checked' : '' ?>>&nbsp;Globale
      </label>
    </div>
    <div class="col-sm-4 col-xs-12 required" id="taux-container" <?= (get_candidat('mobilite') == 'non') ? 'style="display: none;"' : '' ?>>
      <label>Taux de mobilité</label>
      <label for="25percent" class="pull-left">
        <input id="25percent" name="taux_mobilite" type="radio" value="1" <?= (get_candidat('taux_mobilite') == 1) ? 'checked' : '' ?>>&nbsp;25%
      </label>
      <label for="50percent" class="pull-left ml-10">
        <input id="50percent" name="taux_mobilite" type="radio" value="2" <?= (get_candidat('taux_mobilite') == 2) ? 'checked' : '' ?>>&nbsp;50%
      </label>
      <label for="75percent" class="pull-left ml-10">
        <input id="75percent" name="taux_mobilite" type="radio" value="3" <?= (get_candidat('taux_mobilite') == 3) ? 'checked' : '' ?>>&nbsp;75%
      </label>
      <label for="100percent" class="pull-left ml-10">
        <input id="100percent" name="taux_mobilite" type="radio" value="4" <?= (get_candidat('taux_mobilite') == 4) ? 'checked' : '' ?>>&nbsp;100%
      </label>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="ligneBleu mt-10"></div>
      <button type="submit" class="btn btn-primary btn-sm" style="min-width: 170px;">Enregistrer</button>
    </div>
  </div>
</form>