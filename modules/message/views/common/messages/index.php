<?php
use Modules\Message\Models\Message;
?>
<div class="row">
	<?php if ( isBackend() ) : ?>
		<div class="col-md-4" style="padding-right: 0;">
			<div class="conversation_tabs">
				<ul class="nav nav-pills nav-stacked">
					<?php foreach ( $tabs_conversation as $tab ) : ?>
						<li class="<?= ( $_GET['id'] === $tab->id_candidature ? 'active' : '' ) ?>" style="overflow: hidden;" id="<?= 'tab'. $tab->id_candidature ?>">
							<a href="<?= site_url( 'backend/message/candidature/'. $tab->id_candidature .'/messages' ) ?>"><?= '<strong style="font-size:11px">'. $tab->Name .'</strong> - '.$tab->candidat_name ?>
								<?= ( Message::getTotalMsgNotRead($tab->id_candidature) != 0 ? '<span class="count_msg_not_read">'. Message::getTotalMsgNotRead($tab->id_candidature) .'</span>' : '' ) ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<div class="col-md-<?= ( isBackend() ? '8' : '12' ) ?>">
		<div class="panel panel-default mb-10">
			<div class="panel-body" style="padding:5px">
				<div 
				chm-table="<?= (isBackend()) ? 'backend/message/table' : 'message/table'; ?>" 
				chm-table-params='{"id": <?= $_GET['id']; ?>}'
				id="messageTableContainer"
				></div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body p-5">
				<form action="<?= site_url('message/candidature/message/store'); ?>" method="post" class="chm-simple-form" onsubmit="return window.chmForm.submit(event)">
					<input type="hidden" name="cand_id" value="<?= $_GET['id'] ?>">
					<div class="form-group mb-5">
						<textarea class="form-control mb-0 p-5" name="message" placeholder="<?php trans_e("Message...") ?>" style="height: 50px;"></textarea>
					</div>
					<div class="row">
						<div class="col-md-8 section-attachment">
							<table>
								<tr>
									<td>
										<div class="row">
											<div class="col-md-7">
												<input type="file" name="attachments[]" id="attachments" class="mb-5" accept="image/*,.xlsx,.xls,.doc,.docx,.pdf" />
											</div>
											<div class="col-md-4">
												<input type="text" name="att_labels[]" placeholder="<?php trans_e("Titre") ?>" style="border: 1px solid #eee;outline:0;padding: 1px 5px;">
											</div>
										</div>
									</td>
									<td>
										<button type="button" class="btn btn-default btn-xs addLine" style="outline:0;font-size: 8px;padding: 2px 5px;margin-top: -13px;position: absolute;margin-left:7px"><i class="fa fa-plus"></i></button>
									</td>
								</tr>
							</table>
						</div>	
						<div class="col-md-4">
							<button type="submit" class="btn btn-primary btn-xs pull-right mb-0"><?php trans_e("Send") ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	var data_json = { site_url: '<?= site_url() ?>', candidature_id: '<?= $_GET['id'] ?>', isbackend: '<?= isBackend() ?>' }
	$(document).ready(function() {
		$('form').on('chm_form_success', function(response) {
			$('textarea[name=message]').val('');
			$obj = document.querySelector('.section-attachment table tbody');
			$htmlcloned = $obj.lastElementChild.innerHTML
			$('.section-attachment table tbody').html('<tr>'+$htmlcloned+'</tr>');
			$('.section-attachment table tbody tr:last-child td div div input').val('')
		})
	})
</script>