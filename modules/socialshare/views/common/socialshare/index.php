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
<h1 style="text-transform: uppercase"><?= trans('Liste des application linkedin') ?></h1>
<div chm-table="socialshare/linkedin/table" id="ApplinkedinTableContainer"></div>
<?php get_flash_message() ?>
<form action="<?= site_url('backend/socialshare/linkedin/addconfig'); ?>" method="post">
	<div class="row">
		<div class="col-md-3">
			<label for="client_id" class="col-md-4" style="width: 100%; padding: 0;"><?php trans_e("Client ID"); ?>&nbsp;<font style="color:red;">*</font></label>
			<input type="text" name="client_id" id="client_id" style="width: 100%;" required />
		</div>
		<div class="col-md-3">
			<label for="client_secret" class="col-md-4" style="width: 100%; padding: 0;"><?php trans_e("Client Secret"); ?>&nbsp;<font style="color:red;">*</font></label>
			<input type="text" name="client_secret" id="client_secret" style="width: 100%;" />
		</div>
		<div class="col-md-3">
			<label for="redirect_uri" class="col-md-4" style="width: 100%; padding: 0;"><?php trans_e("Redirect URI"); ?>&nbsp;<font style="color:red;">*</font></label>
			<input type="text" name="redirect_uri" id="redirect_uri" style="width: 100%;" required />
		</div>
		<div class="col-md-3">
			<label for="share_in" class="col-md-4" style="width: 100%; padding: 0;"><?php trans_e("Share in"); ?>&nbsp;<font style="color:red;">*</font></label>
			<select name="share_in" id="share_in" style="width: 100%;padding: 2.5px;" required>
				<option value="">-----------</option>
				<option value="company">Company</option>
				<option value="profil">Profil</option>
				<option value="two">Les deux</option>
			</select>
			<div id="company_block" style="display:none;">
				<br>
				<label for="company_id" class="col-md-4" style="width: 100%; padding: 0;"><?php trans_e("Company ID"); ?>&nbsp;<font style="color:red;">*</font></label>
				<input type="text" name="company_id" id="company_id" style="width: 100%;" />
			</div>
		</div>
	</div>
	<div class="form-group mt-10 mb-0">
		<button type="submit" class="btn btn-primary btn-sm pull-right"><?php trans_e("Enregistrer"); ?></button>
	</div>
</form>
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