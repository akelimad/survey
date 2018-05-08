<?php use App\Form; ?>

<div class="chm-response-messages"></div>
<?php
$max_file_size = get_setting('max_file_size', 400);
?>
<form method="POST" action="<?= site_url('candidat/store'); ?>" class="chm-simple-form" onsubmit="return window.chmForm.submit(event)" enctype="multipart/form-data">

	<h1><?php trans_e("CRÉER MON ESPACE CANDIDAT"); ?></h1>
	<div class="ligneBleu"></div>

	<div class="mt-10 mb-10"><?php get_alert('warning', [trans("Les champs marqués par (*) sont obligatoires"), trans("La taille maximale de chaque fichiers est") .' '. $max_file_size .'ko.', trans("Pour reduire la taille du fichier, nous vous proposons de consulter le lien :") .' <a target="_blank" href="https://smallpdf.com/compress-pdf">https://smallpdf.com/compress-pdf</a>'], false) ?></div>

	<div class="styled-title mt-0 mb-10">
	  <h3><?php trans_e("Intitulé du profil"); ?></h3>
	</div>
	<div class="row mb-10">
		<div class="col-sm-6 required">
			<label for="candidat_titre"><?php trans_e("Titre de votre profil"); ?>&nbsp;</label>
			<input type="text" class="form-control" id="candidat_titre" name="candidat[titre]" required>
			<p class="help-block"><?php trans_e("(EX: Développeur informatique, Consultant SI, Chef de projet...)"); ?></p>
		</div>
	</div>

	<div class="styled-title mt-0 mb-10">
	  <h3><?php trans_e("État civil"); ?></h3>
	</div>
	<div class="row">
		<div class="col-sm-2 required">
			<label for="civilite"><?php trans_e("Civilité"); ?></label>
			<select id="civilite" name="candidat[id_civi]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_civilite') as $key => $value) : ?>
					<option value="<?= $value->id_civi ?>"><?= $value->civilite ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-3 pl-0 pl-xs-15 required">
			<label for="nom"><?php trans_e("Nom"); ?></label>
			<input type="text" class="form-control" id="nom" name="candidat[nom]" required>
		</div>
		<div class="col-sm-3 pl-0 pl-xs-15 required">
			<label for="prenom"><?php trans_e("Prénom"); ?></label>
			<input type="text" class="form-control" id="prenom" name="candidat[prenom]" required>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="candidat_date_n"><?php trans_e("Date de naissance"); ?></label>
			<input readonly type="text" class="form-control" id="candidat_date_n" name="candidat[date_n]" required>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 required">
			<label for="adresse"><?php trans_e("Adresse"); ?></label>
			<input type="text" class="form-control" id="adresse" name="candidat[adresse]" required>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="code"><?php trans_e("Code postal"); ?></label>
			<input type="number" min="1" step="1" class="form-control" id="code" name="candidat[code]">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 required">
			<label for="candidat_ville"><?php trans_e("Ville"); ?></label>
			<select id="candidat_ville" name="candidat[ville]" class="form-control" required>
				<option value=""></option>
				<?php foreach ($villes as $key => $value) : ?>
					<option value="<?= $value->ville ?>"><?= $value->ville ?></option>
				<?php endforeach; ?>
	    </select>
	    <?= Form::input('text', 'candidat[ville_other]', null, null, [], [
	    	'class' => 'form-control',
	    	'style' => 'display:none;',
	    	'title' => trans("Autre (à péciser)")
	    ]); ?>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="candidat_pays"><?php trans_e("Pays de résidence"); ?></label>
			<select id="candidat_pays" name="candidat[id_pays]" class="form-control" required>
				<option value="" data-code=""></option>
				<?php foreach ($pays as $key => $value) : ?>
					<option value="<?= $value->id_pays ?>" data-code="+<?= $value->dial_code ?>"><?= $value->pays ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 col-xs-12 required">
			<label for="nationalite"><?php trans_e("Nationalité"); ?></label>
			<input type="text" class="form-control" id="nationalite" name="candidat[nationalite]" required>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-xs-12">
			<label for="cin"><?php trans_e("CIN"); ?></label>
			<input type="text" class="form-control" id="cin" name="candidat[cin]">
		</div>
		<div class="col-sm-4 col-xs-12 pl-0 pl-xs-15 required">
			<label for="tel1"><?php trans_e("Téléphone"); ?></label>
			<input type="text" class="form-control dial_code" name="candidat[dial_code]" title="<?php trans_e("Indicatif téléphonique") ?>" style="float: left;max-width: 55px;" required>
			<input type="number" min="1" step="1" class="form-control" id="tel1" name="candidat[tel1]" style="float: left;max-width: 165px;margin-left: 5px;" required>
		</div>
		<div class="col-sm-4 col-xs-12 pl-0 pl-xs-15">
			<label for="tel2"><?php trans_e("Téléphone secondaire"); ?></label>
			<input type="number" min="1" step="1" class="form-control" id="tel2" name="candidat[tel2]">
		</div>
	</div>

	
	<div class="styled-title mt-0 mb-10">
	  <h3><?php trans_e("Indentifiants"); ?></h3>
	</div>
	<div class="row">
		<div class="col-sm-4 required">
			<label for="email"><?php trans_e("Adresse e-mail"); ?></label>
			<input type="email" class="form-control" id="email" name="candidat[email]" required>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="mdp"><?php trans_e("Mot de passe"); ?>&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="<?php trans_e("Le mot de passe doit avoir un nombre de caractère de 6 ou plus et au moins un chiffre et un caractère."); ?>"></i></label>
			<input type="password" class="form-control" id="mdp" name="candidat[mdp]" required>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="mdp_confirm"><?php trans_e("Confirmation mot de passe"); ?></label>
			<input type="password" class="form-control" id="mdp_confirm" name="candidat[mdp_confirm]" required>
		</div>
	</div>


	<div class="styled-title mt-0 mb-10">
	  <h3><?php trans_e("Profil"); ?></h3>
	</div>
	<div class="row">
		<div class="col-sm-4 required">
			<label for="situation"><?php trans_e("Situation actuelle"); ?></label>
			<select id="situation" name="candidat[id_situ]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_situation') as $key => $value) : ?>
					<option value="<?= $value->id_situ ?>"><?= $value->situation ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="candidat_sector"><?php trans_e("Secteur actuel"); ?></label>
			<select id="candidat_sector" name="candidat[id_sect]" class="form-control" required>
				<option value=""></option>
				<?php foreach ($sectors as $key => $value) : ?>
					<option value="<?= $value->id_sect ?>"><?= $value->FR ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="candidat_id_fonc"><?php trans_e("Fonction"); ?></label>
			<select id="candidat_id_fonc" name="candidat[id_fonc]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_fonctions') as $key => $value) : ?>
					<option value="<?= $value->id_fonc ?>"><?= $value->fonction ?></option>
				<?php endforeach; ?>
	    </select>
	    <?= Form::input('text', 'candidat[fonction_other]', null, null, [], [
	    	'class' => 'form-control',
	    	'style' => 'display:none;',
	    	'title' => trans("Autre (à péciser)")
	    ]); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="salaire"><?php trans_e("Salaire souhaité"); ?></label>
			<?php $currencies = App\Models\Currency::findAll(false); ?>
			<select id="salaire" name="candidat[id_salr]" class="form-control"<?php if (!empty($currencies)) : ?> style="float: left;max-width: 146px;"<?php endif; ?>>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_salaires') as $key => $value) : ?>
					<option value="<?= $value->id_salr ?>"><?= $value->salaire ?></option>
				<?php endforeach; ?>
	    </select>
			<?php if (!empty($currencies)) : ?>
			<select id="id_currency" name="candidat[id_currency]" class="form-control" style="float: left;max-width: 60px;margin-left: 5px;">
				<option value=""></option>
				<?php foreach ($currencies as $key => $value) : ?>
					<option value="<?= $value->id ?>"><?= $value->text ?></option>
				<?php endforeach; ?>
	    </select>
	  	<?php endif; ?>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="formation"><?php trans_e("Niveau de formation"); ?></label>
			<select id="formation" name="candidat[id_nfor]" class="form-control" required>
				<option value=""></option>
				<?php foreach ($niv_formation as $key => $value) : ?>
					<option value="<?= $value->id_nfor ?>"><?= $value->formation ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="type_formation"><?php trans_e("Type de formation"); ?></label>
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
			<label for="disponibilite"><?php trans_e("Disponibilité"); ?></label>
			<select id="disponibilite" name="candidat[id_dispo]" class="form-control" required>
				<option value=""></option>
				<?php foreach (getDB()->read('prm_disponibilite') as $key => $value) : ?>
					<option value="<?= $value->id_dispo ?>"><?= $value->intitule ?></option>
				<?php endforeach; ?>
	        </select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15 required">
			<label for="experience"><?php trans_e("Expérience"); ?></label>
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
			<label><?php trans_e("Mobilité géographique"); ?></label>
			<label for="oui" class="pull-left">
				<input id="oui" name="candidat[mobilite]" type="radio" value="oui" required>&nbsp;Oui
			</label>
			<label for="non" class="pull-left ml-10">
				<input id="non" name="candidat[mobilite]" type="radio" value="non" checked required>&nbsp;Non
			</label>
		</div>
		<div class="col-sm-5 col-xs-12 required" id="niveau-container" style="display: none;">
			<label><?php trans_e("Au niveau"); ?></label>
			<label for="national" class="pull-left">
				<input id="national" name="candidat[niveau_mobilite]" type="radio" value="1" checked>&nbsp;<?php trans_e("National"); ?>
			</label>
			<label for="international" class="pull-left ml-10">
				<input id="international" name="candidat[niveau_mobilite]" type="radio" value="2">&nbsp;<?php trans_e("International"); ?>
			</label>
			<label for="globale" class="pull-left ml-10">
				<input id="globale" name="candidat[niveau_mobilite]" type="radio" value="3">&nbsp;<?php trans_e("Globale"); ?>
			</label>
		</div>
		<div class="col-sm-4 col-xs-12 required" id="taux-container" style="display: none;">
			<label><?php trans_e("Taux de mobilité"); ?></label>
			<label for="25percent" class="pull-left">
				<input id="25percent" name="candidat[taux_mobilite]" type="radio" value="1" checked>&nbsp;25%
			</label>
			<label for="50percent" class="pull-left ml-10">
				<input id="50percent" name="candidat[taux_mobilite]" type="radio" value="2">&nbsp;50%
			</label>
			<label for="75percent" class="pull-left ml-10">
				<input id="75percent" name="candidat[taux_mobilite]" type="radio" value="3">&nbsp;75%
			</label>
			<label for="100percent" class="pull-left ml-10">
				<input id="100percent" name="candidat[taux_mobilite]" type="radio" value="4">&nbsp;100%
			</label>
		</div>
	</div>


	<?php if (get_setting('register_show_last_formation', 1) != 0) : ?>
	<div class="styled-title mt-0 mb-10">
	  <h3><?php trans_e("Dernière formation"); ?></h3>
	</div>
	<div id="items-container" data-count="1">
		<div class="item">
			<?php if (get_setting('register.allow_multiple_formations', 0) == 1) : ?>
			<div class="ligneBleu mt-15 mb-15">
				<div class="pull-right">
					<span class="btn btn-info btn-xs counter" style="cursor: default;">N°<span class="nbr">1</span></span>
					<button type="button" class="btn btn-danger btn-xs ml-5" onclick="return deleteLine(this)" style="display: none;"><i class="fa fa-trash"></i></button>
				</div>
			</div>
			<?php endif; ?>

			<div class="row">
				<div class="col-sm-4 required">
					<label for="formations_1_date_debut"><?php trans_e("Date de début"); ?></label>
					<input readonly type="text" class="form-control" id="formations_1_date_debut" name="formations[1][date_debut]" required>
				</div>
				<div class="col-sm-8 pl-0 pl-xs-15 required">
					<label for="formations_1_date_fin"><?php trans_e("Date de fin"); ?></label>
					<input readonly type="text" class="form-control" id="formations_1_date_fin" name="formations[1][date_fin]" style="max-width: 226px;float: left;margin-right: 10px;" required>
					<label for="formations_1_today" style="margin-top: 7px;" class="pointer">
						<input type="checkbox" name="formations[1][today]" value="1" class="date_fin_today forma_today" id="formations_1_today">&nbsp;<?php trans_e("Jusqu'à aujourd'hui"); ?>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 required">
					<label for="formations_1_id_ecol"><?php trans_e("École ou établissement"); ?></label>
					<select id="formations_1_id_ecol" name="formations[1][id_ecol]" class="form-control formation_id_ecol" required>
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
			    <?= Form::input('text', 'formations[1][ecole]', null, null, [], [
			    	'class' => 'form-control formation_ecole',
			    	'style' => 'display:none;',
			    	'title' => trans("Autre (à péciser)")
			    ]); ?>
				</div>
				<div class="col-sm-4 pl-0 pl-xs-15 required">
					<label for="formations_1_nfor"><?php trans_e("Nombre d’année de formation"); ?></label>
					<select id="formations_1_nfor" name="formations[1][nivformation]" class="form-control" required>
						<option value=""></option>
						<?php foreach ($niv_formation as $key => $value) : ?>
							<option value="<?= $value->id_nfor ?>"><?= $value->formation ?></option>
						<?php endforeach; ?>
			        </select>
				</div>
				<div class="col-sm-4 pl-0 pl-xs-15 required">
					<label for="formations_1_diplome"><?php trans_e("Diplôme") ?></label>
					<select id="formations_1_diplome" name="formations[1][diplome]" class="form-control formation_diplome" required>
						<option value=""></option>
						<?php foreach (getDB()->read('prm_filieres') as $key => $value) : ?>
							<option value="<?= $value->id_fili ?>"><?= $value->filiere ?></option>
						<?php endforeach; ?>
			    </select>
			    <?= Form::input('text', 'formations[1][diplome_other]', null, null, [], [
			    	'class' => 'form-control formation_diplome_other',
			    	'style' => 'display:none;',
			    	'title' => trans("Autre (à péciser)")
			    ]); ?>
				</div>
			</div>
			<div class="row mt-0">
				<?php 
					$specialty_displayed = false;
					if (Form::getFieldOption('displayed', 'register', 'specialty')) : 
					$specialty_displayed = true;
					$required = Form::getFieldOption('required', 'register', 'specialty') ? ' required' : '';
				?>
				<div class="col-sm-4<?= $required; ?>">
					<label for="formations_1_specialty_id"><?php trans_e("Spécialité") ?></label>
					<select id="formations_1_specialty_id" name="formations[1][specialty_id]" class="form-control formation_specialty_id"<?= $required; ?>>
						<option value=""></option>
						<?php foreach (App\Models\Specialty::findAll(false) as $key => $value) : ?>
							<option value="<?= $value->id ?>"><?= $value->name ?></option>
						<?php endforeach; ?>
			    </select>
			    <?= Form::input('text', 'formations[1][specialty_other]', null, null, [], [
			    	'class' => 'form-control formation_specialty_other',
			    	'style' => 'display:none;',
			    	'title' => trans("Autre (à péciser)")
			    ]); ?>
				</div>
				<?php endif; ?>
				 
				<?php if (Form::getFieldOption('displayed', 'register', 'copie_diplome')) : ?>
				<?php $required = Form::getFieldOption('required', 'register', 'copie_diplome') ? ' required' : ''; ?>
					<div class="col-sm-4<?= ($specialty_displayed) ? ' pl-0 pl-xs-15' : ''; ?><?= $required; ?>">
						<label for="formations_1_copie_diplome"><?php trans_e("Copie du diplôme"); ?>&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="<?php trans_e("Vous pouvez joindre votre Copie du diplôme format Word, PDF ou Image, la taille ne doit pas dépasser"); ?> <?= $max_file_size; ?>ko"></i></label>
						<div class="input-group file-upload">
						    <input type="text" class="form-control" readonly>
						    <label class="input-group-btn">
						        <span class="btn btn-success btn-sm">
						            <i class="fa fa-upload"></i>
						            <input type="file" class="form-control" id="formations_1_copie_diplome" name="copie_diplome" accept="image/*|.doc,.docx,.pdf">
						        </span>
						    </label>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="row mt-10">
				<div class="col-sm-12 required">
					<label for="formations_1_description"><?php trans_e("Description de la formation"); ?></label>
					<textarea name="formations[1][description]" class="form-control ckeditor" id="formations_1_description" required></textarea>
				</div>
			</div>
		</div>
		<?php if (get_setting('register.allow_multiple_formations', 0) == 1) : ?>
			<div class="ligneBleu mt-10"></div>
			<button type="button" class="btn btn-primary btn-sm" onclick="return addLine(this)"><i class="fa fa-plus-square"></i>&nbsp;<?php trans_e("Ajouter une formation"); ?></button>
		<?php endif; ?>
	</div>
	<?php endif; ?>


	<?php if (get_setting('register_show_last_experience', 1) != 0) : ?>
		<div class="styled-title mt-10 mb-10">
		  <h3><?php trans_e("Dernière expérience professionnelle"); ?></h3>
		</div>
		<div id="items-container" data-count="1">
			<div class="item">
				<?php if (get_setting('register.allow_multiple_experiences', 0) == 1) : ?>
				<div class="ligneBleu mt-15 mb-15">
					<div class="pull-right">
						<span class="btn btn-info btn-xs counter" style="cursor: default;">N°<span class="nbr">1</span></span>
						<button type="button" class="btn btn-danger btn-xs ml-5" onclick="return deleteLine(this)" style="display: none;"><i class="fa fa-trash"></i></button>
					</div>
				</div>
				<?php endif; ?>

				<div class="row">
					<div class="col-sm-4">
						<label for="experiences_1_date_debut"><?php trans_e("Date de début"); ?></label>
						<input readonly type="text" class="form-control" id="experiences_1_date_debut" name="experiences[1][date_debut]">
					</div>
					<div class="col-sm-8 pl-0 pl-xs-15">
						<label for="experiences_1_date_fin"><?php trans_e("Date de fin"); ?></label>
						<input readonly type="text" class="form-control" id="experiences_1_date_fin" name="experiences[1][date_fin]" style="max-width: 226px;float: left;margin-right: 10px;">
						<label for="experiences_1_today" style="margin-top: 7px;" class="pointer">
							<input type="checkbox" name="experiences[1][today]" value="1" class="date_fin_today" id="experiences_1_today">&nbsp;<?php trans_e("Jusqu'à aujourd'hui"); ?>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label for="experiences_1_entreprise"><?php trans_e("Entreprise"); ?></label>
						<input type="text" class="form-control" id="experiences_1_entreprise" name="experiences[1][entreprise]">
					</div>
					<div class="col-sm-4 pl-0 pl-xs-15">
						<label for="experiences_1_poste"><?php trans_e("Intitulé du poste"); ?></label>
						<input type="text" class="form-control" id="experiences_1_poste" name="experiences[1][poste]">
					</div>
					<div class="col-sm-4 pl-0 pl-xs-15">
						<label for="experiences_1_id_sect"><?php trans_e("Secteur d'activité"); ?></label>
						<select id="experiences_1_id_sect" name="experiences[1][id_sect]" class="form-control">
							<option value=""></option>
							<?php foreach ($sectors as $key => $value) : ?>
								<option value="<?= $value->id_sect ?>"><?= $value->FR ?></option>
							<?php endforeach; ?>
				    </select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label for="experiences_1_id_fonc"><?php trans_e("Fonction"); ?></label>
						<select id="experiences_1_id_fonc" name="experiences[1][id_fonc]" class="form-control experience_fonction">
							<option value=""></option>
							<?php foreach (getDB()->read('prm_fonctions') as $key => $value) : ?>
								<option value="<?= $value->id_fonc ?>"><?= $value->fonction ?></option>
							<?php endforeach; ?>
				    </select>
				    <?= Form::input('text', 'experiences[1][fonction_other]', null, null, [], [
				    	'class' => 'form-control experience_fonction_other',
				    	'style' => 'display:none;',
				    	'title' => trans("Autre (à péciser)")
				    ]); ?>
					</div>
					<div class="col-sm-4 pl-0 pl-xs-15">
						<label for="experiences_1_id_tpost"><?php trans_e("Type de contrat"); ?></label>
						<select id="experiences_1_id_tpost" name="experiences[1][id_tpost]" class="form-control">
							<option value=""></option>
							<?php foreach (getDB()->read('prm_type_poste') as $key => $value) : ?>
								<option value="<?= $value->id_tpost ?>"><?= $value->designation ?></option>
							<?php endforeach; ?>
				   	</select>
					</div>
					<div class="col-sm-4 col-xs-12 pl-0 pl-xs-15">
						<label for="experiences_1_salair_pecu"><?php trans_e("Dernier salaire perçu"); ?></label>
						<input type="number" min="0" step="0.1" name="experiences[1][salair_pecu]" value="0" class="form-control" id="experiences_1_salair_pecu">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label for="experiences_1_id_pays"><?php trans_e("Pays"); ?></label>
						<select id="experiences_1_id_pays" name="experiences[1][id_pays]" class="form-control">
							<option value="" data-code=""></option>
							<?php foreach ($pays as $key => $value) : ?>
								<option value="<?= $value->id_pays ?>"><?= $value->pays ?></option>
							<?php endforeach; ?>
				    </select>
					</div>
					<div class="col-sm-4 pl-0 pl-xs-15">
						<label for="experiences_1_ville"><?php trans_e("Ville"); ?></label>
						<select id="experiences_1_ville" name="experiences[1][ville]" class="form-control experience_ville">
							<option value=""></option>
							<?php foreach ($villes as $key => $value) : ?>
								<option value="<?= $value->ville ?>"><?= $value->ville ?></option>
							<?php endforeach; ?>
				    </select>
				    <?= Form::input('text', 'experiences[1][ville_other]', null, null, [], [
				    	'class' => 'form-control experience_ville_other',
				    	'style' => 'display:none;',
				    	'title' => trans("Autre (à péciser)")
				    ]); ?>
					</div>

					<?php if (Form::getFieldOption('displayed', 'register', 'copie_attestation')) : ?>
					<?php $required = Form::getFieldOption('required', 'register', 'copie_attestation') ? ' required' : ''; ?>
					<div class="col-sm-4 mb-10 pl-0 pl-xs-15<?= $required; ?>">
						<label for="experiences_1_copie_attestation"><?php trans_e("Copie de l’attestation"); ?>&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="<?php trans_e("Vous pouvez joindre votre Copie de l’attestation format Word, PDF ou Image, la taille ne doit pas dépasser"); ?> <?= $max_file_size; ?>ko"></i></label>
						<div class="input-group file-upload">
						    <input type="text" class="form-control" readonly>
						    <label class="input-group-btn">
						        <span class="btn btn-success btn-sm">
						            <i class="fa fa-upload"></i>
						            <input type="file" class="form-control" id="experiences_1_copie_attestation" name="copie_attestation" accept="image/*|.doc,.docx,.pdf">
						        </span>
						    </label>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<?php if (Form::getFieldOption('displayed', 'register', 'bulletin_paie')) : ?>
				<?php $required = Form::getFieldOption('required', 'register', 'bulletin_paie') ? ' required' : ''; ?>
				<div class="row mb-10">
					<div class="col-sm-4">
						<label for="experiences_1_bulletin_paie"><?php trans_e("Bulletin de paie"); ?>&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="<?php trans_e("Vous pouvez joindre votre Bulletin de paie format Word, PDF ou Image, la taille ne doit pas dépasser"); ?> <?= $max_file_size; ?>ko"></i></label>
						<div class="input-group file-upload">
						    <input type="text" class="form-control" readonly>
						    <label class="input-group-btn">
						        <span class="btn btn-success btn-sm">
						            <i class="fa fa-upload"></i>
						            <input type="file" class="form-control" id="experiences_1_bulletin_paie" name="bulletin_paie" accept="image/*|.doc,.docx,.pdf">
						        </span>
						    </label>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-sm-12">
						<label for="experiences_1_description"><?php trans_e("Description du poste"); ?></label>
						<textarea name="experiences[1][description]" class="form-control ckeditor" id="experiences_1_description"></textarea>
					</div>
				</div>
			</div>
			<?php if (get_setting('register.allow_multiple_experiences', 0) == 1) : ?>
				<div class="ligneBleu mt-10"></div>
				<button type="button" class="btn btn-primary btn-sm" onclick="return addLine(this)"><i class="fa fa-plus-square"></i>&nbsp;<?php trans_e("Ajouter une expérience"); ?></button>
			<?php endif; ?>
		</div>
	<?php endif; ?>


	<div class="styled-title mt-10 mb-10">
	  <h3><?php trans_e("Langues"); ?></h3>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="candidat_arabic"><?php trans_e("Arabe"); ?></label>
			<select name="candidat[arabic]" id="candidat_arabic" class="form-control">
				<option value=""></option>
				<option value="Maîtrisé"><?php trans_e("Maîtrisé"); ?></option>
				<option value="Courant"><?php trans_e("Courant"); ?></option>
				<option value="Basique"><?php trans_e("Basique"); ?></option>
				<option value="Néant"><?php trans_e("Néant"); ?></option>
			</select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="candidat_french"><?php trans_e("Français"); ?></label>
			<select name="candidat[french]" id="candidat_french" class="form-control">
				<option value=""></option>
				<option value="Maîtrisé"><?php trans_e("Maîtrisé"); ?></option>
				<option value="Courant"><?php trans_e("Courant"); ?></option>
				<option value="Basique">Basique</option>
				<option value="Néant"><?php trans_e("Néant"); ?></option>
			</select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="candidat_english"><?php trans_e("Anglais"); ?></label>
			<select name="candidat[english]" id="candidat_english" class="form-control">
				<option value=""></option>
				<option value="Maîtrisé"><?php trans_e("Maîtrisé"); ?></option>
				<option value="Courant"><?php trans_e("Courant"); ?></option>
				<option value="Basique"><?php trans_e("Basique"); ?></option>
				<option value="Néant"><?php trans_e("Néant"); ?></option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<label for="candidat_autre_n"><?php trans_e("Autres 1"); ?></label>
			<input type="text" class="form-control" id="candidat_autre" name="candidat[autre]">
			<select name="candidat[autre_n]" id="candidat_autre_n" class="form-control" style="display: none;margin-top: -5px;">
				<option value=""></option>
				<option value="Maîtrisé"><?php trans_e("Maîtrisé"); ?></option>
				<option value="Courant"><?php trans_e("Courant"); ?></option>
				<option value="Basique"><?php trans_e("Basique"); ?></option>
				<option value="Néant"><?php trans_e("Néant"); ?></option>
			</select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="candidat_autre1_n"><?php trans_e("Autres 2"); ?></label>
			<input type="text" class="form-control" id="candidat_autre1" name="candidat[autre1]">
			<select name="candidat[autre1_n]" id="candidat_autre1_n" class="form-control" style="display: none;margin-top: -5px;">
				<option value=""></option>
				<option value="Maîtrisé"><?php trans_e("Maîtrisé"); ?></option>
				<option value="Courant"><?php trans_e("Courant"); ?></option>
				<option value="Basique"><?php trans_e("Basique"); ?></option>
				<option value="Néant"><?php trans_e("Néant"); ?></option>
			</select>
		</div>
		<div class="col-sm-4 pl-0 pl-xs-15">
			<label for="candidat_autre2_n"><?php trans_e("Autres 3"); ?></label>
			<input type="text" class="form-control" id="candidat_autre2" name="candidat[autre2]">
			<select name="candidat[autre2_n]" id="candidat_autre2_n" class="form-control" style="display: none;margin-top: -5px;">
				<option value=""></option>
				<option value="Maîtrisé"><?php trans_e("Maîtrisé"); ?></option>
				<option value="Courant"><?php trans_e("Courant"); ?></option>
				<option value="Basique"><?php trans_e("Basique"); ?></option>
				<option value="Néant"><?php trans_e("Néant"); ?></option>
			</select>
		</div>
	</div>
	

	<div class="styled-title mt-0 mb-10">
	  <h3><?php trans_e("Pièces jointes"); ?></h3>
	</div>
	<div class="row mb-10">
		<?php 
		$photo_displayed = false; 
		if (Form::getFieldOption('displayed', 'register', 'photo')) :
			$photo_displayed = true;
			$required = Form::getFieldOption('required', 'register', 'photo') ? ' required' : ''; 
		?>
		<div class="col-sm-4 mb-10<?= $required; ?>">
			<label for="candidat_photo"><?php trans_e("Photo"); ?>&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="<?php trans_e("Vous pouvez joindre votre Photo, la taille ne doit pas dépasser"); ?> <?= $max_file_size; ?>ko."></i></label>
			<div class="input-group file-upload">
			    <input type="text" class="form-control" readonly>
			    <label class="input-group-btn">
			        <span class="btn btn-success btn-sm">
			            <i class="fa fa-upload"></i>
			            <input type="file" class="form-control" id="candidat_photo" name="photo" accept="image/*">
			        </span>
			    </label>
			</div>
		</div>
		<?php endif; ?>

		<?php if (Form::getFieldOption('displayed', 'register', 'cv')) : ?>
		<?php $required = Form::getFieldOption('required', 'register', 'cv') ? ' required' : ''; ?>
		<div class="col-sm-4 mb-10<?= ($photo_displayed) ? ' pl-0 pl-xs-15' : '';?><?= $required; ?>">
			<label for="candidat_cv"><?php trans_e("CV"); ?>&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="<?php trans_e("Vous pouvez joindre votre CV format Word ou PDF, la taille ne doit pas dépasser"); ?> <?= $max_file_size; ?>ko"></i></label>
			<div class="input-group file-upload">
			    <input type="text" class="form-control" readonly>
			    <label class="input-group-btn">
			        <span class="btn btn-success btn-sm">
			            <i class="fa fa-upload"></i>
			            <input type="file" class="form-control" id="candidat_cv" name="cv" accept=".doc,.docx,.pdf">
			        </span>
			    </label>
			</div>
		</div>
		<?php endif; ?>

		<?php if (Form::getFieldOption('displayed', 'register', 'lm')) : ?>
		<?php $required = Form::getFieldOption('required', 'register', 'lm') ? ' required' : ''; ?>
		<div class="col-sm-4 mb-10 pl-0 pl-xs-15<?= $required; ?>">
			<label for="candidat_lm"><?php trans_e("Lettre de motivation"); ?>&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="<?php trans_e("Vous pouvez joindre votre Lettre de motivation format Word ou PDF, la taille ne doit pas dépasser"); ?> <?= $max_file_size; ?>ko"></i></label>
			<div class="input-group file-upload">
			    <input type="text" class="form-control" readonly>
			    <label class="input-group-btn">
			        <span class="btn btn-success btn-sm">
			            <i class="fa fa-upload"></i>
			            <input type="file" class="form-control" id="candidat_lm" name="lm" accept=".doc,.docx,.pdf">
			        </span>
			    </label>
			</div>
		</div>
		<?php endif; ?>

		<?php if (Form::getFieldOption('displayed', 'register', 'permis_conduire')) : ?>
		<?php $required = Form::getFieldOption('required', 'register', 'permis_conduire') ? ' required' : ''; ?>
		<div class="col-sm-4 pl-0 pl-xs-15<?= $required; ?>">
			<label for="permis_conduire"><?php trans_e("Permis de conduire"); ?>&nbsp;<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Aide" data-content="<?php trans_e("Vous pouvez joindre votre Permis de conduire format Word, PDF ou Image, la taille ne doit pas dépasser"); ?> <?= $max_file_size; ?>ko"></i></label>
			<div class="input-group file-upload">
			    <input type="text" class="form-control" readonly>
			    <label class="input-group-btn">
			        <span class="btn btn-success btn-sm">
			            <i class="fa fa-upload"></i>
			            <input type="file" class="form-control" id="permis_conduire" name="permis_conduire" accept="image/*|.doc,.docx,.pdf">
			        </span>
			    </label>
			</div>
		</div>
		<?php endif; ?>
	</div>

	<?php if (get_setting('google_recaptcha_enabled', 1) != 0) : ?>
	<div class="styled-title mt-0 mb-10">
	  <h3><?php trans_e("Cocher la case suivant pour confirmer que vous n'êtes pas un robot."); ?></h3>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<script src="https://www.google.com/recaptcha/api.js" async defer></script>
			<div class="g-recaptcha" data-sitekey="<?= get_setting('google_recaptcha_sitekey') ?>"></div>
		</div>
	</div>
	<?php endif; ?>

	<div class="styled-title mt-10 mb-5">
	  <h3><?php trans_e("Conditions d'utilisation"); ?></h3>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<?php if ($numero_cndp_rh = get_setting('register_numero_cndp_rh', false)) : ?>
				<p><strong><?php trans_e("Conformément à la loi 09-08, vous disposer d'un droit d'accès, de rectification et d'opposition au traitement de vos données personnelles, ce traitement a été autorisé par la CNDP sous le N°:"); ?> <?= $numero_cndp_rh ?> du <?= get_setting('register_date_cndp_rh', trans("12 avril 2013")) ?>.</strong></p>
			<?php endif; ?>
			<label for="accepte">
				<input id="accepte" type="checkbox" title="J'accepte" style="width:20px;border:none" required><?php trans_e("J'ai lu et j'accepte"); ?> <a href="javascript:void(0)" onclick="return window.chmModal.show({url:site_url('candidat/terms'), type:'GET'}, {width: 870})"><strong><?php trans_e("les conditions générales d'utilisation"); ?></strong></a>, <?php trans_e("notamment la mention relative à la protection des données personnelles."); ?>
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="ligneBleu mt-10"></div>
			<button type="submit" class="btn btn-primary btn-sm" style="min-width: 170px;"><?php trans_e("Valider"); ?></button>
		</div>
	</div>
</form>

<script>
jQuery(document).ready(function(){

	// Editors
	<?php if (get_setting('register_show_last_formation', 1) != 0) : ?>
	CKEDITOR.replace('formations_1_description', {height: 200});
	<?php endif; ?>

	<?php if (get_setting('register_show_last_experience', 1) != 0) : ?>
	CKEDITOR.replace('experiences_1_description', {height: 200});
	<?php endif; ?>

	$('#candidat_titre').focus()

	// Trigger success
	$('form').on('chmFormSuccess', function(event, response) {
		if(response.status === 'success') {
			$(this).hide()
		}
	})

	// Show other school field
	$('body').on('change', '.formation_id_ecol', function() {
    var $other_input = $(this).next('.formation_ecole')
    $($other_input).val('')
    if ($(this).find('option:selected').text().match("^Autre")) {
      $($other_input).prop('required', true)
      $($other_input).show()
    } else {
      $($other_input).prop('required', false)
      $($other_input).hide()
    }   
  })

	// Salary
  $('#salaire').change(function() {
  	if ($(this).val() != '') {
  		$('#id_currency').prop('required', true)
  	} else {
  		$('#id_currency').prop('required', false)
  	}
  })

  // Fonction
  $('#candidat_id_fonc').change(function() {
    var $other_input = $('#candidat_fonction_other')
    $($other_input).val('')
    if ($(this).find('option:selected').text().match("^Autre")) {
      $($other_input).prop('required', true)
      $($other_input).show()
    } else {
      $($other_input).prop('required', false)
      $($other_input).hide()
    }   
  })

  // Exp Fonction
  $('body').on('change', '.experience_fonction', function() {
    var $other_input = $(this).next('.experience_fonction_other')
    $($other_input).val('')
    if ($(this).find('option:selected').text().match("^Autre")) {
      $($other_input).prop('required', true)
      $($other_input).show()
    } else {
      $($other_input).prop('required', false)
      $($other_input).hide()
    }   
  })

  // Formation diplome
  $('body').on('change', '.formation_diplome', function() {
    var $other_input = $(this).next('.formation_diplome_other')
    $($other_input).val('')
    if ($(this).find('option:selected').text().match("^Autre")) {
      $($other_input).prop('required', true)
      $($other_input).show()
    } else {
      $($other_input).prop('required', false)
      $($other_input).hide()
    }   
  })

  // Speciality
  $('body').on('change', '.formation_specialty_id', function() {
    var $other_input = $(this).next('.formation_specialty_other')
    $($other_input).val('')
    if ($(this).find('option:selected').text().match("^Autre")) {
      $($other_input).prop('required', true)
      $($other_input).show()
    } else {
      $($other_input).prop('required', false)
      $($other_input).hide()
    }   
  })

  // Ville
  $('#candidat_ville').change(function() {
    var $other_input = $('#candidat_ville_other')
    $($other_input).val('')
    if ($(this).find('option:selected').text().match("^Autre")) {
      $($other_input).prop('required', true)
      $($other_input).show()
    } else {
      $($other_input).prop('required', false)
      $($other_input).hide()
    }   
  })

  // Experience ville
  $('body').on('change', '.experience_ville', function() {
    var $other_input = $(this).next('.experience_ville_other')
    $($other_input).val('')
    if ($(this).find('option:selected').text().match("^Autre")) {
      $($other_input).prop('required', true)
      $($other_input).show()
    } else {
      $($other_input).prop('required', false)
      $($other_input).hide()
    }   
  })

  cimDatepicker('#candidat_date_n', {
  	dateFormat: 'dd/mm/yy',
  	maxDate: '-17Y',
    minDate: "-63Y",
  })

  <?php if (get_setting('register_show_last_formation', 1) != 0 || get_setting('register_show_last_experience', 1) != 0) : ?>
  cimDatepicker('[id$="date_debut"], [id$="date_fin"]', {
  	dateFormat: 'dd/mm/yy',
  	maxDate: '-0day',
    minDate: "-30Y",
  })
  <?php endif; ?>

});

function addLine(target) {
	var container = $(target).closest('#items-container')
	var count = $(container).data('count') + 1
	$(container).data('count', count)
  var copy = $(container).find('.item').first().clone()
  $(copy).find('input, select, textarea').each(function() {
  	var name = $(this).attr('name')
  	if (name !== undefined) {
  		var id = $(this).attr('id').replace('_1_', '_'+ count +'_')
	  	$(this).attr('name', name.replace('[1]', '['+ count +']'))
	  	$(this).attr('id', id)

	  	if($(this).is('input[type="checkbox"]') || $(this).is('input[type="radio"]')) {
  			$(this).closest('label').attr('for', id)
  			$(this).prop('checked', false)
	  	} else {
  			$(this).prev('label').attr('for', id)
  			$(this).val('')
	  	}

	  	if ($(this).hasClass('hasDatepicker')) {
	  		$(this).css('display', 'block')
	  	}

  		if($(this).hasClass('hasDatepicker')) {
  			$(this).removeClass('hasDatepicker')
  		}
  	}
  })

  copy.find('.ligneBleu button').show()
	copy.find('.nbr').text(count)

  var textareaId = copy.find('.cke').prev('textarea').attr('id')
  copy.find('.cke').remove()

  cimDatepicker(copy.find('[id$="date_debut"], [id$="date_fin"]'), {
  	dateFormat: 'dd/mm/yy',
  	maxDate: '-0day',
    minDate: "-30Y",
  })

  $(copy).insertAfter($(container).find('.item').last())

  CKEDITOR.replace(textareaId, {height: 200});
}

function deleteLine(target) {
	$(target).closest('.item').remove()
}
</script>