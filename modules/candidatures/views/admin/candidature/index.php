<?php get_flash_message(); ?>
<h1 class="page-title">TRAITEMENT DES NOUVELLES CANDIDATURES</h1>
<table>
	<tbody>
		<tr class="odd">
			<td><b>Nombre des nouvelles candidaturess : </b></td>
			<td>&nbsp;<span class="badge badge-success"><?= $table->total_results ?></span></td>
		</tr>
	</tbody>
</table>

<input type="hidden" id="url_params" value="<?= htmlentities(json_encode($_GET)); ?>">
<input type="hidden" id="filterFields" value="<?= htmlentities(json_encode($params['filterFields'])); ?>">

<div data-toggle="collapse" data-target="#candidatures-filter-wrap" class="subscription filter-candidatures-title<?= (read_cookie('eta_filter')==0) ? ' collapsed' : ''; ?>"><h1>Options de filtrage</h1></div>
<div id="candidatures-filter-wrap" class="collapse<?= (read_cookie('eta_filter')=='1') ? ' in' : ''; ?> pt-0">
	<img src="<?= module_url(__FILE__, 'assets/img/loading.gif'); ?>" style="width: 30px;margin: 0px auto 30px;">
</div>

<?= $table->render(); ?>

<div id="candidaturesModal" class="modal fade" role="dialog" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="border-bottom: none;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><img src="<?= module_url(__FILE__, 'assets/img/loading.gif'); ?>" style="width: 30px;">&nbsp;Chargement en cours...</h4>
			</div>
			<div class="modal-body" style="display: none;border-top: 1px solid #e5e5e5;"></div>
		</div>
	</div>
</div>