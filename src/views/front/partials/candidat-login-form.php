<?php $route = \App\Permission::getRoute(); ?>

<?php if(!isLogged('candidat') && !in_array($route, ['candidat/inscription'])) : ?>
<div class="panel panel-default" id="candidat-login-form">
	<div class="panel-heading pb-0">
		<h4 class="panel-title">Espace candidat</h4>
	</div>
	<div class="panel-body pt-5">
		<h3><i class="fa fa-sign-in"></i>&nbsp;J'ai déjà un espace candidat</h3>
		<form method="POST" action="<?= site_url('candidat/login'); ?>" onsubmit="return chmForm.sumbit(event)" class="chm-simple-form">
			<div class="form-group mb-0">
				<input type="email" class="form-control" name="email" placeholder="Email" required>
			</div>
			<div class="form-group mb-0">
				<input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
			</div>
			<a href="javascript:void(0)" onclick="return chmModal.show({url:'candidat/reset-password', type:'GET'}, {width: 200})"><strong>Mot de passe perdu ?</strong></a>
			<button type="sumbit" class="btn btn-primary btn-xs pull-right">S'identifier</button>
			<hr>
			<h3><i class="fa fa-sign-in"></i>&nbsp;Créer mon espace candidat</h3>
			<a href="<?= site_url('candidat/inscription') ?>" class="pull-right register"><i class="fa fa-user-plus fa-4x"></i></a>
			<p class="mb-0">Vous n'avez pas encore votre propre<br> espace candidat. Créez-le en cliquant ici.</p>
		</form>
	</div>
</div>
<?php endif; ?>