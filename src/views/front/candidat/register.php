<h1>CRÉER MON ESPACE CANDIDAT</h1>
<div class="ligneBleu"></div>

<div class="chm-response-messages"></div>

<form method="POST" action="<?= site_url('candidat/store'); ?>" class="chm-simple-form" onsubmit="return window.chmForm.sumbit(event)" enctype="multipart/form-data">

	<div class="mt-10 mb-10"><?php get_alert('warning', ['Les champs marqués par (*) sont obligatoires', 'La taille maximal de chaque fichiers est 400 ko.'], false) ?></div>

	<div class="styled-title mt-0 mb-10" style="height: 23px;">
	  <h3>Intitulé du profil</h3>
	</div>
	<div class="row">
		<div class="col-sm-6 required">
			<label for="candidat_titre">Titre de votre profil&nbsp;</label>
			<input type="text" class="form-control" id="candidat_titre" name="candidat[titre]" required>
			<p class="help-block">(EX: Développeur informatique, Consultant SI, Chef de projet...)</p>
		</div>
	</div>

	<div class="styled-title mt-0 mb-10" style="height: 23px;">
	  <h3>État civil</h3>
	</div>
	<div class="row">
		<div class="col-sm-2 required">
			<label for="civilite">Civilité</label>
			<select id="civilite" name="candidat[id_civi]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_civilite') as $key => $value) : ?>
					<option value="<?= $value->id_civi ?>"><?= $value->civilite ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-3 pl-0 pl-xs-15 required">
			<label for="nom">Nom</label>
			<input type="text" class="form-control" id="nom" name="candidat[nom]" required>
		</div>
		<div class="col-sm-3 pl-0 pl-xs-15 required">
			<label for="prenom">Prénom</label>
			<input type="text" class="form-control" id="prenom" name="candidat[prenom]" required>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="candidat_date_n">Date de naissance</label>
			<input type="date" min="<?= date('Y-m-d', strtotime('-63year')); ?>" max="<?= date('Y-m-d', strtotime('-16year')); ?>" class="form-control" id="candidat_date_n" name="candidat[date_n]" required>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 required">
			<label for="adresse">Adresse</label>
			<input type="text" class="form-control" id="adresse" name="candidat[adresse]" required>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="code">Code postal</label>
			<input type="number" min="1" step="1" class="form-control" id="code" name="candidat[code]">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 required">
			<label for="ville">Ville</label>
			<select id="ville" name="candidat[ville]" class="form-control" required>
				<option value=""></option>
				<?php foreach ($villes as $key => $value) : ?>
					<option value="<?= $value->ville ?>"><?= $value->ville ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="candidat_pays">Pays de résidence</label>
			<select id="candidat_pays" name="candidat[id_pays]" class="form-control" required>
				<option value="" data-code=""></option>
				<?php foreach ($pays as $key => $value) : ?>
					<option value="<?= $value->id_pays ?>" data-code="<?= $value->dial_code ?>"><?= $value->pays ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 col-xs-12 required">
			<label for="nationalite">Nationalité</label>
			<input type="text" class="form-control" id="nationalite" name="candidat[nationalite]" required>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-xs-12 required">
			<label for="cin">CIN</label>
			<input type="text" class="form-control" id="cin" name="candidat[cin]" required>
		</div>
		<div class="col-sm-4 col-xs-12 pl-0 pl-xs-15 required">
			<label for="tel1">Téléphone</label>
			<input type="text" class="form-control deal_code" name="candidat[tel1_deal_code]" placeholder="(+212)" style="float: left;max-width: 55px;" required>
			<input type="number" min="1" step="1" class="form-control" id="tel1" name="candidat[tel1]" placeholder="0611223344" style="float: left;max-width: 165px;margin-left: 5px;" required>
		</div>
		<div class="col-sm-4 col-xs-12 pl-0 pl-xs-15">
			<label for="tel2">Téléphone secondaire</label>
			<input type="text" class="form-control deal_code" name="candidat[tel2_deal_code]" placeholder="(+212)" style="float: left;max-width: 55px;">
			<input type="number" min="1" step="1" class="form-control" id="tel2" name="candidat[tel2]" placeholder="0511223344" style="float: left;max-width: 165px;margin-left: 5px;">
		</div>
	</div>

	
	<div class="styled-title mt-0 mb-10" style="height: 23px;">
	  <h3>Indentifiants</h3>
	</div>
	<div class="row">
		<div class="col-sm-4 required">
			<label for="email">Adresse e-mail</label>
			<input type="email" class="form-control" id="email" name="candidat[email]" required>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="mdp">Mot de passe</label>
			<input type="password" class="form-control" id="mdp" name="candidat[mdp]" required>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="mdp_confirm">Confirmation mot de passe</label>
			<input type="password" class="form-control" id="mdp_confirm" name="candidat[mdp_confirm]" required>
		</div>
	</div>


	<div class="styled-title mt-0 mb-10" style="height: 23px;">
	  <h3>Profil</h3>
	</div>
	<div class="row">
		<div class="col-sm-4 required">
			<label for="situation">Situation actuelle</label>
			<select id="situation" name="candidat[id_situ]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_situation') as $key => $value) : ?>
					<option value="<?= $value->id_situ ?>"><?= $value->situation ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="candidat_sector">Secteur actuel</label>
			<select id="candidat_sector" name="candidat[id_sect]" class="form-control" required>
				<option value=""></option>
				<?php foreach ($sectors as $key => $value) : ?>
					<option value="<?= $value->id_sect ?>"><?= $value->FR ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="fonction">Fonction</label>
			<select id="fonction" name="candidat[id_fonc]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_fonctions') as $key => $value) : ?>
					<option value="<?= $value->id_fonc ?>"><?= $value->fonction ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 required">
			<label for="salaire">Salaire souhaité</label>
			<select id="salaire" name="candidat[id_salr]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_salaires') as $key => $value) : ?>
					<option value="<?= $value->id_salr ?>"><?= $value->salaire ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="formation">Niveau de formation</label>
			<select id="formation" name="candidat[id_nfor]" class="form-control" required>
				<option value=""></option>
				<?php foreach ($niv_formation as $key => $value) : ?>
					<option value="<?= $value->id_nfor ?>"><?= $value->formation ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="type_formation">Type de formation</label>
			<select id="type_formation" name="candidat[id_tfor]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_type_formation') as $key => $value) : ?>
					<option value="<?= $value->id_tfor ?>"><?= $value->formation ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 required">
			<label for="disponibilite">Disponibilité</label>
			<select id="disponibilite" name="candidat[id_dispo]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_disponibilite') as $key => $value) : ?>
					<option value="<?= $value->id_dispo ?>"><?= $value->intitule ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="experience">Expérience</label>
			<select id="experience" name="candidat[id_expe]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_experience') as $key => $value) : ?>
					<option value="<?= $value->id_expe ?>"><?= $value->intitule ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
	</div>
	<div class="row mb-10">
		<div class="col-sm-3 col-xs-12 required">
			<label>Mobilité géographique</label>
			<label for="oui" class="pull-left">
				<input id="oui" name="candidat[mobilite]" type="radio" value="oui" required>&nbsp;Oui
			</label>
			<label for="non" class="pull-left ml-10">
				<input id="non" name="candidat[mobilite]" type="radio" value="non" checked required>&nbsp;Non
			</label>
		</div>
		<div class="col-sm-5 col-xs-12 required" id="niveau-container" style="display: none;">
			<label>Au niveau</label>
			<label for="national" class="pull-left">
				<input id="national" name="candidat[niveau_mobilite]" type="radio" value="1" checked>&nbsp;National
			</label>
			<label for="international" class="pull-left ml-10">
				<input id="international" name="candidat[niveau_mobilite]" type="radio" value="2">&nbsp;International
			</label>
			<label for="globale" class="pull-left ml-10">
				<input id="globale" name="candidat[niveau_mobilite]" type="radio" value="3">&nbsp;Globale
			</label>
		</div>
		<div class="col-sm-4 col-xs-12 required" id="taux-container" style="display: none;">
			<label>Taux de mobilité</label>
			<label for="25percent" class="pull-left">
				<input id="25percent" name="candidat[taux_mobilite]" type="radio" value="1" checked>&nbsp;25 %
			</label>
			<label for="50percent" class="pull-left ml-10">
				<input id="50percent" name="candidat[taux_mobilite]" type="radio" value="2">&nbsp;50 %
			</label>
			<label for="75percent" class="pull-left ml-10">
				<input id="75percent" name="candidat[taux_mobilite]" type="radio" value="3">&nbsp;75 %
			</label>
			<label for="100percent" class="pull-left ml-10">
				<input id="100percent" name="candidat[taux_mobilite]" type="radio" value="4">&nbsp;100 %
			</label>
		</div>
	</div>


	<div class="styled-title mt-0 mb-10" style="height: 23px;">
	  <h3>Dernière formation</h3>
	</div>
	<div class="row">
		<div class="col-sm-4 required">
			<label for="forma_date_debut">Date de début</label>
			<input type="date" max="<?= date('Y-m-d'); ?>" class="form-control" id="forma_date_debut" name="formation[date_debut]" required>
		</div>
		<div class="col-sm-8 pl-0 pl-xs-15 required">
			<label for="forma_date_fin">Date de fin</label>
			<input type="date" max="<?= date('Y-m-d'); ?>" class="form-control" id="forma_date_fin" name="formation[date_fin]" style="max-width: 226px;float: left;margin-right: 10px;" required>
			<label for="forma_today" style="margin-top: 7px;" class="pointer">
				<input type="checkbox" name="formation[today]" value="1" class="date_fin_today" id="forma_today">&nbsp;Jusqu'à aujourd'hui
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 required">
			<label for="forma_ecol">École ou établissement</label>
			<select id="forma_ecol" name="formation[id_ecol]" class="form-control" required>
				<option value=""></option>
				<?php
				$ecolesPays = getDB()->prepare("SELECT distinct p.id_pays, p.pays FROM `prm_ecoles` e JOIN prm_pays p ON p.id_pays=e.id_pays");
				foreach ($ecolesPays as $key => $ep) :
				?>
				<optgroup label="<?= $ep->pays; ?>">
					<?php $prmEcoles = getDB()->prepare("SELECT * FROM `prm_ecoles` WHERE id_pays=?", [$ep->id_pays]);
					foreach ($prmEcoles as $key => $ecole) : ?>
						<option value="<?= $ecole->id_ecole ?>"><?= $ecole->nom_ecole ?></option>
					<?php endforeach; ?>
				</optgroup‏>
				<?php endforeach; ?>
	    </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="forma_nfor">Nombre d’année de formation</label>
			<select id="forma_nfor" name="formation[nivformation]" class="form-control" required>
				<option value=""></option>
				<?php foreach ($niv_formation as $key => $value) : ?>
					<option value="<?= $value->id_nfor ?>"><?= $value->formation ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="forma_diplome">Diplôme</label>
			<select id="forma_diplome" name="formation[diplome]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_filieres') as $key => $value) : ?>
					<option value="<?= $value->id_fili ?>"><?= $value->filiere ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
	</div>
	<div class="row mt-0">
		<div class="col-sm-4">
			<label for="forma_copie_diplome">Copie du diplôme</label>
			<div class="input-group file-upload">
			    <input type="text" class="form-control" readonly>
			    <label class="input-group-btn">
			        <span class="btn btn-default btn-sm">
			            <i class="fa fa-upload"></i>
			            <input type="file" class="form-control" id="forma_copie_diplome" name="copie_diplome" accept="image/*|.doc,.docx,.pdf">
			        </span>
			    </label>
			</div>
		</div>
	</div>
	<div class="row mt-10">
		<div class="col-sm-12 required">
			<label for="forma_description">Description de la formation</label>
			<textarea name="formation[description]" class="form-control" id="forma_description" required></textarea>
		</div>
	</div>

	
	<div class="styled-title mt-10 mb-10" style="height: 23px;">
	  <h3>Dernière expérience professionnelle</h3>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="date_debut">Date de début</label>
			<input type="date" max="<?= date('Y-m-d'); ?>" class="form-control" id="exp_date_debut" name="experience[date_debut]">
		</div>
		<div class="col-sm-8 pl-0 pl-xs-15">
			<label for="date_fin">Date de fin</label>
			<input type="date" max="<?= date('Y-m-d'); ?>" class="form-control" id="exp_date_fin" name="experience[date_fin]" style="max-width: 226px;float: left;margin-right: 10px;">
			<label for="exp_today" style="margin-top: 7px;" class="pointer">
				<input type="checkbox" name="experience[today]" value="1" class="date_fin_today" id="exp_today">&nbsp;Jusqu'à aujourd'hui
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="entreprise">Entreprise</label>
			<input type="text" class="form-control" id="entreprise" name="experience[entreprise]">
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="poste">Intitulé du poste</label>
			<input type="text" class="form-control" id="poste" name="experience[poste]">
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="exp_sector">Secteur d'activité</label>
			<select id="exp_sector" name="experience[id_sect]" class="form-control">
				<option value=""></option>
				<?php foreach ($sectors as $key => $value) : ?>
					<option value="<?= $value->id_sect ?>"><?= $value->FR ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="exp_fonction">Fonction</label>
			<select id="exp_fonction" name="experience[id_fonc]" class="form-control">
				<option value=""></option>
				<?php foreach (getDB()->read('prm_fonctions') as $key => $value) : ?>
					<option value="<?= $value->id_fonc ?>"><?= $value->fonction ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="exp_tpost">Type de contrat</label>
			<select id="exp_tpost" name="experience[id_tpost]" class="form-control">
				<option value=""></option>
				<?php foreach (getDB()->read('prm_type_poste') as $key => $value) : ?>
					<option value="<?= $value->id_tpost ?>"><?= $value->designation ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 col-xs-12 pl-0 pl-xs-15">
			<label for="salair_pecu">Dernier salaire perçu</label>
			<input type="number" min="0" step="0.1" name="experience[salair_pecu]" value="0" class="form-control" id="salair_pecu">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="exp_pays">Pays</label>
			<select id="exp_pays" name="experience[id_pays]" class="form-control">
				<option value="" data-code=""></option>
				<?php foreach ($pays as $key => $value) : ?>
					<option value="<?= $value->id_pays ?>"><?= $value->pays ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="exp_ville">Ville</label>
			<select id="exp_ville" name="experience[ville]" class="form-control">
				<option value=""></option>
				<?php foreach ($villes as $key => $value) : ?>
					<option value="<?= $value->ville ?>"><?= $value->ville ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 mb-10 pl-0 pl-xs-15">
			<label for="copie_attestation">Copie de l’attestation</label>
			<div class="input-group file-upload">
			    <input type="text" class="form-control" readonly>
			    <label class="input-group-btn">
			        <span class="btn btn-default btn-sm">
			            <i class="fa fa-upload"></i>
			            <input type="file" class="form-control" id="copie_attestation" name="copie_attestation" accept="image/*|.doc,.docx,.pdf">
			        </span>
			    </label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<label for="exp_description">Description du poste</label>
			<textarea name="experience[description]" class="form-control" id="exp_description"></textarea>
		</div>
	</div>


	<div class="styled-title mt-10 mb-10" style="height: 23px;">
	  <h3>Langues</h3>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="candidat_arabic">Arabe</label>
			<select name="candidat[arabic]" id="candidat_arabic" class="form-control">
				<option value=""></option>
				<option value="Maîtrisé">Maîtrisé</option>
				<option value="Courant">Courant</option>
				<option value="Basique">Basique</option>
				<option value="Néant">Néant</option>
			</select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="candidat_french">Français</label>
			<select name="candidat[french]" id="candidat_french" class="form-control">
				<option value=""></option>
				<option value="Maîtrisé">Maîtrisé</option>
				<option value="Courant">Courant</option>
				<option value="Basique">Basique</option>
				<option value="Néant">Néant</option>
			</select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="candidat_english">Anglais</label>
			<select name="candidat[english]" id="candidat_english" class="form-control">
				<option value=""></option>
				<option value="Maîtrisé">Maîtrisé</option>
				<option value="Courant">Courant</option>
				<option value="Basique">Basique</option>
				<option value="Néant">Néant</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="candidat_autre">Autres 1</label>
			<input type="text" class="form-control" id="candidat_autre" name="candidat[autre]">
			<select name="candidat[autre_n]" id="exp_autre_n" class="form-control" style="display: none;margin-top: -5px;">
				<option value=""></option>
				<option value="Maîtrisé">Maîtrisé</option>
				<option value="Courant">Courant</option>
				<option value="Basique">Basique</option>
				<option value="Néant">Néant</option>
			</select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="candidat_autre1">Autres 2</label>
			<input type="text" class="form-control" id="candidat_autre1" name="candidat[autre1]">
			<select name="candidat[autre1_n]" id="exp_autre1_n" class="form-control" style="display: none;margin-top: -5px;">
				<option value=""></option>
				<option value="Maîtrisé">Maîtrisé</option>
				<option value="Courant">Courant</option>
				<option value="Basique">Basique</option>
				<option value="Néant">Néant</option>
			</select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="candidat_autre2">Autres 3</label>
			<input type="text" class="form-control" id="candidat_autre2" name="candidat[autre2]">
			<select name="candidat[autre2_n]" id="exp_autre2_n" class="form-control" style="display: none;margin-top: -5px;">
				<option value=""></option>
				<option value="Maîtrisé">Maîtrisé</option>
				<option value="Courant">Courant</option>
				<option value="Basique">Basique</option>
				<option value="Néant">Néant</option>
			</select>
		</div>
	</div>
	

	<div class="styled-title mt-0 mb-10" style="height: 23px;">
	  <h3>Pièces jointes</h3>
	</div>
	<div class="row mb-10">
		<div class="col-sm-4 mb-10">
			<label for="candidat_photo">Photo</label>
			<div class="input-group file-upload">
			    <input type="text" class="form-control" readonly>
			    <label class="input-group-btn">
			        <span class="btn btn-default btn-sm">
			            <i class="fa fa-upload"></i>
			            <input type="file" class="form-control" id="candidat_photo" name="photo" accept="image/*">
			        </span>
			    </label>
			</div>
		</div>
		<div class="col-sm-4 mb-10 pl-0 pl-xs-15 required">
			<label for="candidat_cv">CV</label>
			<div class="input-group file-upload">
			    <input type="text" class="form-control" readonly>
			    <label class="input-group-btn">
			        <span class="btn btn-default btn-sm">
			            <i class="fa fa-upload"></i>
			            <input type="file" class="form-control" id="candidat_cv" name="cv" accept=".doc,.docx,.pdf">
			        </span>
			    </label>
			</div>
		</div>
		<div class="col-sm-4 mb-10 pl-0 pl-xs-15">
			<label for="candidat_lm">Lettre de motivation</label>
			<div class="input-group file-upload">
			    <input type="text" class="form-control" readonly>
			    <label class="input-group-btn">
			        <span class="btn btn-default btn-sm">
			            <i class="fa fa-upload"></i>
			            <input type="file" class="form-control" id="candidat_lm" name="lm" accept=".doc,.docx,.pdf">
			        </span>
			    </label>
			</div>
		</div>
	</div>


	<div class="styled-title mt-0 mb-5" style="height: 23px;">
	  <h3>Conditions d'utilisation</h3>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="g-recaptcha" data-sitekey="<?= get_setting('google_recaptcha_sitekey') ?>"></div>
		</div>
	</div>
	<div class="row mt-10">
		<div class="col-sm-12">
			<label for="accepte">
				<input id="accepte" type="checkbox" title="J'accepte" style="width:20px;border:none" required>
				<font style="color:red;">*</font>&nbsp;J'accepte <a href="javascript:void(0)" onclick="return window.chmModal.show({url:site_url('candidat/terms'), type:'GET'}, {width: 870})"> les conditions d'utilisation et les règles de confidentialité </a> du site.
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="ligneBleu mt-10"></div>
			<button type="submit" class="btn btn-primary btn-sm" style="min-width: 170px;">Valider</button>
		</div>
	</div>
</form>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
jQuery(document).ready(function(){

	// editors
	CKEDITOR.replace('forma_description', {height: 200});
	CKEDITOR.replace('exp_description', {height: 200});

	$('#candidat_titre').focus()

	// birthday
	$('#candidat_date_n').change(function() {
		if(!$(this).val().startsWith(0)) {
			var maxDate  = new Date(new Date().setFullYear(new Date().getFullYear() -16))
			var selected = new Date($(this).val().replace('-', '/'));
			if(selected >= maxDate) {
				$(this).val('')
				error_message('Votre âge doit être supérieur à 16 ans.')
			}
		}
	})

	// date fin exp et formation
	$('[id$="date_debut"], [id$="date_fin"]').change(function() {
		var row = $(this).closest('.row')
		var date_debut = row.find('[id$="date_debut"]').val()
		var date_fin   = row.find('[id$="date_fin"]').val()
		if(!date_fin.startsWith(0) && date_fin != '' && date_debut != '') {
			var maxDate  = new Date(date_debut.replace('-', '/'))
			var selected = new Date(date_fin.replace('-', '/'))
			if(selected >= maxDate) {
				row.find('[id$="date_fin"]').val('')
				error_message('La date de fin doit être inférieur à date de début.')
			}
		}
	})

	// set deal_code
	$('#candidat_pays').change(function() {
		var code_formated = ''
		var code = $(this).find('option:selected').data('code')
		if(code != '') code_formated = '(+'+ code +')'
		$('.deal_code').val(code_formated)
	})

	// mobilite
	$('[name="candidat[mobilite]"]').change(function() {
		if($(this).val() == 'oui') {
			$('#niveau-container, #taux-container').show()
		} else {
			$('#niveau-container, #taux-container').hide()

		}
	})

	// date_fin_today
	$('.date_fin_today').change(function() {
		var date_fin = $(this).closest('.col-sm-8').find('[type="date"]')
		if($(this).is(':checked')) {
			$(date_fin).hide()
			$(date_fin).val('')
			if($(this).is("#forma_today")) {
				$(date_fin).prop('required', false)
			}
		} else {
			$(date_fin).show()
			if($(this).is("#forma_today")) {
				$(date_fin).prop('required', true)
			}
		}
	})

	// other languages
	$('input[id^="candidat_autre"]').on('keyup', function() {
		var select = $(this).next('select')
		if($(this).val() != '') {
			$(select).show()
			$(select).prop('required', true)
		} else {
			$(select).prop('required', false)
			$(select).val('')
			$(select).hide()
		}
	})

	// Trigger success
	$('form').on('chm_form_success', function(response) {
		$(this).hide()
	})


});
</script>