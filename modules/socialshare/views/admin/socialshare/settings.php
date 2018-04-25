<div class="row">
	<div class="col-md-12 mt-5 mb-0">
		<label for="client_id" class="col-md-4" style="width: 100%; padding: 0;"><?php trans_e("Client ID"); ?>&nbsp;<font style="color:red;">*</font></label>
		<input type="text" name="client_id" id="client_id" class="form-control" value="<?= ( isset($settings['Client_ID']) ?  $settings['Client_ID'] : '' ) ?>" required />
	</div>
</div>
<div class="row">
	<div class="col-md-12 mt-5 mb-0">
		<label for="client_secret" class="col-md-4" style="width: 100%; padding: 0;"><?php trans_e("Client Secret"); ?>&nbsp;<font style="color:red;">*</font></label>
		<input type="text" name="client_secret" id="client_secret" class="form-control" value="<?= ( isset($settings['Client_secret']) ?  $settings['Client_secret'] : '' ) ?>" required />
	</div>
</div>
<div class="row">
	<div class="col-md-12 mt-5 mb-0">
		<label for="redirect_uri" class="col-md-4" style="width: 100%; padding: 0;"><?php trans_e("Redirect URI"); ?>&nbsp;<font style="color:red;">*</font></label>
		<input type="text" name="redirect_uri" id="redirect_uri" class="form-control" value="<?= ( isset($settings['Redirect_URI']) ?  $settings['Redirect_URI'] : '' ) ?>" required />
	</div>
</div>