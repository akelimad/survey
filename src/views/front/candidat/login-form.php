<?php $route = \App\Route::getRoute(); ?>

<?php if(!isLogged('candidat') && !in_array($route, ['candidat/inscription'])) : ?>
<div class="panel panel-default" id="candidat-login-form">
	<div class="panel-heading pb-0">
		<h4 class="panel-title"><?php trans_e("Espace candidat"); ?>
			<?php if(is_ajax()) : ?>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top: -3px;">×</button>
			<?php endif; ?>
		</h4>
	</div>
	<div class="panel-body pt-5">
		<h3><i class="fa fa-sign-in"></i>&nbsp;<?php trans_e("J'ai déjà un espace candidat"); ?></h3>
		<form method="POST" action="<?= site_url('candidat/login'); ?>" onsubmit="return chmForm.submit(event)" class="chm-simple-form" chm-loading-label="">
			<div class="form-group mb-0">
				<input type="email" class="form-control" name="email" placeholder="<?php trans_e("Email"); ?>" required>
			</div>
			<div class="form-group mb-0">
				<input type="password" name="password" class="form-control" placeholder="<?php trans_e("Mot de passe"); ?>" required>
			</div>
			<a href="javascript:void(0)" onclick="return chmAuth.resetPassword()"><strong><?php trans_e("Mot de passe perdu ?"); ?></strong></a>
			<button type="submit" class="btn btn-primary btn-xs pull-right"><?php trans_e("S'identifier"); ?></button>
			<hr>
			<h3><i class="fa fa-pencil-square-o"></i>&nbsp;<?php trans_e("Créer mon espace candidat"); ?></h3>
			<a href="<?= site_url('candidat/inscription') ?>" class="pull-right register"><i class="fa fa-user-plus fa-4x"></i></a>
			<p class="mb-0"><?php trans_e("Vous n'avez pas encore votre propre<br> espace candidat."); ?> <?php trans_e("Créez-le en"); ?> <a href="<?= site_url('candidat/inscription') ?>"><?php trans_e("cliquant ici."); ?></a></p>
		</form>
	</div>
</div>
<?php endif; ?>