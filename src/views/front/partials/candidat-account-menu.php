<div class="panel panel-default" id="candidat-account-menu">
	<div class="panel-heading pb-0">
		<h4 class="panel-title">Espace candidat</h4>
	</div>
	<div class="panel-body pt-5">
		<div style="font-size: 12px;">Bienvenue&nbsp;:&nbsp;<strong><?= App\Models\Candidat::getDisplayName(null, false) ?></strong></div>
		<h3><i class="fa fa-lock"></i>&nbsp;Vous êtes connecté à votre espace</h3>
		<ul class="account-nav">
			<li>
				<a href="<?= site_url('candidat/compte') ?>"><i class="fa fa-user"></i>&nbsp;Mon compte</a>
			</li>
			<li>
				<a href="<?= site_url('candidat/identifiants') ?>"><i class="fa fa-key"></i>&nbsp;Mes identifiants</a>
			</li>
			<li>
				<a href="<?= site_url('candidat/cv') ?>"><i class="fa fa-file-text-o"></i>&nbsp;Mon CV</a>
				<ul>
					<li>
						<a href="<?= site_url('candidat/cv/informations') ?>"><i class="fa fa-id-card-o"></i>&nbsp;Informations personnelles</a>
					</li>
					<li>
						<a href="<?= site_url('candidat/cv/formations') ?>"><i class="fa fa-graduation-cap"></i>&nbsp;Formations</a>
					</li>
					<li>
						<a href="<?= site_url('candidat/cv/experiences') ?>"><i class="fa fa-briefcase"></i>&nbsp;Expériences</a>
					</li>
					<li>
						<a href="<?= site_url('candidat/cv/langues_pj') ?>"><i class="fa fa-language"></i>&nbsp;Langues et pièces jointes</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="<?= site_url('candidat/supprimer_compte') ?>"><i class="fa fa-ban"></i>&nbsp;Supprimer mon compte</a>
			</li>
			<li>
				<a href="<?= site_url('candidat/logout') ?>" style="font-weight: 700;"><i class="fa fa-sign-out"></i>&nbsp;Déconnexion</a>
			</li>
		</ul>
	</div>
</div>