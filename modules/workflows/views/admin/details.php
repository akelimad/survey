<?php
use \Modules\Workflows\Models\Workflow;

global $color_bg;
?>

<style>
	.espace_candidat:hover{
		color: #fff;
		padding-bottom: 3px;
	}
</style>
	
<div class="row">
	<div class="col-md-6">
		<a href="<?= site_url('backend/module/workflows/workflow/builder') ?>" class="btn btn-primary btn-sm mb-20"><i class="fa fa-code-fork"></i>&nbsp;Gérer les workflows</a>
		<a href="<?= site_url('backend/module/workflows/workflow') ?>" class="btn btn-default btn-sm mb-20"><i class="fa fa-history"></i>&nbsp;Historique des workflows</a>
	</div>
	<div class="col-md-6">
		<?php if($canChangeStatus) : ?>
		<form action="" method="post" class="pull-right">
			<select name="new_status" id="new_status" class="from-control" style="width: 100px; margin-right: 6px; height: 31px;padding: 5px;" required>
				<option value=""></option>
				<?php foreach ($status as $key => $value) : ?>
					<option value="<?= $key ?>"><?= $value['verb'] ?></option>
				<?php endforeach; ?>
			</select>
			<textarea name="note" id="wf_note" cols="30" rows="4" style="display: none;margin: 10px auto;"></textarea>
			<button type="submit" class="btn btn-primary btn-sm">Changer</button>
		</form>
		<?php endif; ?>
	</div>
</div>
    

<div class="panel panel-default mt-20" style="margin-bottom: 10px;">
	<div class="panel-body">
		<h5 style="margin: 0px;"><strong>Détails de l'offre</strong></h5><hr>
		<ul class="list-group" style="margin-bottom: 0px;">
			<li class="list-group-item list-group-item-info">
				<div class="row">
					<div class="col-md-2">Référence</div>	
					<div class="col-md-10"><?= $offre->reference; ?></div>	
				</div>
			</li>
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-2">Titre de l'offre</div>	
					<div class="col-md-10"><?= $offre->Name; ?>
						<form action="<?= site_url('backend/offres/modifier_offre/') ?>" method="post" name="formulaire2" target="_blank" style="display: initial;margin-left: 10px;">
							<input name="id" type="hidden" value="<?= $offre->id_offre; ?>">
              <input name="action_offre" type="hidden" value="edit">
              <input name="action" type="hidden" value="">
							<button type="submit" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;Modifier l'offre</button>
						</form>
					</div>	
				</div>
			</li>
			<li class="list-group-item list-group-item-info">
				<div class="row">
					<div class="col-md-2">Date d’insertion</div>	
					<div class="col-md-10"><?= date('d/m/Y', strtotime($offre->date_insertion)); ?></div>	
				</div>
			</li>
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-2">Date d’expiration</div>	
					<div class="col-md-10"><?= date('d/m/Y', strtotime($offre->date_expiration)); ?></div>	
				</div>
			</li>
			<li class="list-group-item list-group-item-info">
				<div class="row">
					<div class="col-md-2">Mobilité</div>	
					<div class="col-md-10"><?= $offre->mobilite; ?></div>	
				</div>
			</li>
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-2">Statut courant</div>	
					<div class="col-md-10"><?php
						$class = Workflow::getStatusClassByName($offre->current_status);
						$label = Workflow::getStatusLabelByName($offre->current_status);					
						echo '<span class="label label-'. $class .'">'. $label .'</span>';
					?></div>	
				</div>
			</li>
		</ul>
	</div>
</div><!-- /.panel -->


<div class="panel panel-default" style="margin-bottom: 10px;">
	<div class="panel-body">
		<h5 style="margin: 0px;"><strong>Historique des changements de statut</strong></h5><hr>
		<ul class="list-group" style="margin-bottom: 0px;">
			<li class="list-group-item list-group-item-info">
				<div class="row">
					<div class="col-md-2"><strong>Agent</strong></div>	
					<div class="col-md-2"><strong>Date de changement</strong></div>	
					<div class="col-md-2"><strong>Statut</strong></div>	
					<div class="col-md-6"><strong>Note</strong></div>	
				</div>
			</li>
		  <?php $i=1; foreach ($history as $key => $his) : ?>
		    <?php $even = ($i%2==0) ? 'list-group-item-info' : ''; ?>
			<li class="list-group-item <?php echo $even; ?>">
				<div class="row">
					<div class="col-md-2"><?= $his->nom_agent; ?></div>
					<div class="col-md-2"><?php echo date('d/m/Y H:i:s', strtotime($his->created_at)); ?></div>
					<div class="col-md-2">
						<?php
							$class = Workflow::getStatusClassByName($his->status);
							$label = Workflow::getStatusLabelByName($his->status);	
						?>					
						<span class="label label-<?php echo $class; ?>"><?php echo $label; ?></span>
					</div>
					<div class="col-md-6"><?= $his->note; ?></div>
				</div>
			</li>
		  <?php $i++; endforeach; ?>
		</ul>
	</div>
</div><!-- /.panel -->

<script>
jQuery(document).ready(function(){
	$('#new_status').change(function(){
		if( $(this).val() != '' ) {
			$('#wf_note').css('display', 'block')
		} else {
			$('#wf_note').css('display', 'none')
		}
	})

})
</script>