<?php
use Modules\Socialshare\Models\Share;
$params = Share::checkRequiredParameters();
?>
<style type="text/css">
td{
	vertical-align:middle !important;
}
i.fa-play{
	color:#27ca27;
}
i.fa-stop{
	color:#ff1717;
}
</style>
<?php get_flash_message() ?><br>
<h1 style="text-transform: uppercase;" class="pull-left"><?= trans('Liste des applications linkedin') ?></h1>
<a href="backend/socialshare/settings" chm-modal chm-modal-options='{"form": {"action": "backend/socialshare/settings", "class": "chm-simple-form"}, "footer": {"label": "<?php trans_e("Sauvgarder"); ?>"}, "width": "400"}' class="btn btn-primary btn-xs pull-right mb-15"><i class="fa fa-cogs"></i>&nbsp;<?php trans_e("Paramètrages") ?></a>
<div chm-table="socialshare/linkedin/table" id="ApplinkedinTableContainer" style="clear:both"></div>
<?php
if ($params) {
?>
<form action="<?= site_url('backend/socialshare/linkedin/addconfig'); ?>" method="post">
	<div class="row">
		<div class="col-md-4">
			<label for="share_in" class="col-md-4" style="width: 100%; padding: 0;"><?php trans_e("Ou souhaitez vous partager vos offres ?"); ?>&nbsp;<font style="color:red;">*</font></label>
			<select name="share_in" id="share_in" style="width: 100%;padding: 2.5px;" required>
				<option value="">-----------</option>
				<option value="company">Votre company</option>
				<option value="profil">Votre profil</option>
				<option value="two">Les deux</option>
			</select>
			<div id="company_block" style="display:none;">
				<br>
				<label for="company_id" class="col-md-4" style="width: 100%; padding: 0;"><?php trans_e("Entrez l'ID de votre company"); ?>&nbsp;<font style="color:red;">*</font></label>
				<input type="text" name="company_id" id="company_id" style="width: 100%;" />
			</div>
		</div>
	</div>
	<div class="form-group mt-10 mb-0">
		<button type="submit" class="btn btn-primary btn-sm pull-left"><?php trans_e("Autoriser l'accés à votre compte"); ?></button>
	</div>
</form>
<?php
} else {
get_alert('danger', trans("Veuillez remplir vos paramètres en cliquant sur le botton paramètrages à fin de continuer de partager vos offre"), false);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#share_in').change(function() {
			if ($(this).val() == 'company' || $(this).val() == 'two') {
				$('#company_block').show();
				$('#company_block input').attr('required', 'required');
			} else {
				$('#company_block').hide();
				$('#company_block input').removeAttr('required');
			}
		});
	});

	var setPublishStatus = function ($app_id) {
		$this = $('#' + $app_id);
		$status = ( $this.data('publish-status') == 'play' ? 'stop' : 'play' )
		$.ajax({
			type: 'POST',
			url: "<?= site_url('backend/socialshare/publish/status/set') ?>",
			data: { app_id : $app_id, new_status : $status },
			beforeSend: function() {
				$this.html('<i class="fa fa-circle-o-notch fa-spin fast-spin"></i>')
			},
			success: function(data) {
			},
			error: function(xhr) {return false; },
			complete: function() {
				$this.html('<i class="fa fa-'+ $this.data('publish-status') +'"></i>')
				$this.data('publish-status', $status)
			}
		});
		return false;
	}

	var deleteApp = function (args) {
		window.chmModal.show({
			type: 'POST',
			url: window.chmSite.url('backend/socialshare/linkedin/app/delete'),
			data: {
				app_id: args.app_id
			}
		}, {
			message: '<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;' + trans('Supprission en cours...'),
			width: 400,
			onSuccess: (response) => {
				$('a#' + args.app_id).parent().parent().fadeOut('slow')
				window['chmAlert'][response.status](response.message)
			}
		})
	}
</script>