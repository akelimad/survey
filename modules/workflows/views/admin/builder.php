<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Workflow builder</title>
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap-theme.css" />
  <link rel="stylesheet" href="<?php echo site_url('modules/workflows/assets/css/jquery.contextMenu.css'); ?>">
  <link rel="stylesheet" href="<?php echo site_url('modules/workflows/assets/css/styles.css'); ?>">
  <link rel="website" href="<?= site_url() ?>">
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
</head>
<body data-id="">

<style>
	.select2-container--default .select2-selection--single{
		height: 37px !important;
		border-radius: 0px !important;
		border: 0 !important;
		padding: 5px 0 0 !important;
	}
	.select2-container--default .select2-selection--single .select2-selection__arrow {
		top: 6px !important;
	}
	.aLabel{
		display: none !important;
	}
</style>

<input type="hidden" value="<?php echo htmlentities(json_encode($workflows)); ?>" id="workflowsList">
<input type="hidden" value="<?php echo htmlentities($depList); ?>" id="depList">



<article style="visibility:hidden;">
	<div class="context">
		<h1 data-bind="text: selectedWorkflow()"></h1> 
	</div>
	<!-- STEPS -->
	<div data-bind="foreach: steps" class="demo flowchart-demo" id="flowchart-demo">        

		<div class="step" data-bind="attr: { id: id }, style: { top: top, left: left }">
			<div class="step-inner">               

				<div class="panel panel-default" style="min-height: 145px;">
					<div class="panel-heading">

						<select data-bind="options: demoData.depIds, optionsText: 'name', optionsValue: 'Id', value: depId" style="width: 100%;height: 37px;border: 0;" class="select2"></select>			
						

						<center><i class="glyphicon glyphicon-move" style="cursor: move;font-size: 20px;color: rgba(85, 85, 85, 0.68);margin-top: 38px;"></i></center>	

						<!--div class="editable desc">
							<span class="placeholder" data-bind="if: description() === '', event: { dblclick: editStep.bind($data) }">
								Description...
							</span>
							<a href="javascript:void(0)" data-update="desc" data-bind="text: description, 
							visible: activeField() != 'desc',
							event: { dblclick: editStep.bind($data) }">
						</a>

						<textarea data-bind="value: description,
						visible: activeField() === 'desc',
						hasfocus: isActive(), 
						valueUpdate: 'afterkeydown', 
						enterPress: saveStep, 
						escPress: cancelEditStep, 
						event: { blur: saveOrCancelEdit, focus: selectText.bind($data) }" style="width: 100%;height: 85px;"></textarea>
					</div-->

				</div>
			</div>                    
			<button type="button" class="btn btn-danger delete" data-bind="click: deleteStep.bind($data, $parent, 'a', 'b')">&times; <span class="sr-only">Supprimer</span></button>                     
		</div>
	</div>        

</div><!-- / STEPS -->

<div class="key">
	<a href="javascript:void(0)" class="help"><i class="glyphicon glyphicon-question-sign"></i></a>
	<div class="content">
		<h2>Instructions <button class="close" data-dismiss="key">&times;</button></h2>
		<p>Cliquez avec le bouton droit sur le fond de la grille pour ajouter une nouvelle étape.</p>
		<p>Cliquez ou Double-cliquez (voir la clé) sur les détails pour chaque étape pour l'éditer.</p>
		<h2>Clé</h2>
		<label>
			<svg xmlns="http://www.w3.org/2000/svg" version="1.1" position="absolute" pointer-events="all" 
			height="18" width="18">
			<circle stroke-width="3" stroke="#7AB02C" fill="transparent" style="" 
			xmlns="http://www.w3.org/2000/svg" version="1.1" r="6" cy="9" cx="9"></circle>
		</svg>
		Point de sortie
	</label>
	<label>
		<svg xmlns="http://www.w3.org/2000/svg" version="1.1" position="absolute" pointer-events="all" 
		height="18" width="18">
		<circle stroke-width="3" stroke="#7AB02C" fill="#7AB02C" style="" 
		xmlns="http://www.w3.org/2000/svg" version="1.1" r="6" cy="9" cx="9"></circle>
	</svg>
	Point d'entrée
</label>
<label>
	<img src="<?php echo site_url('modules/workflows') ?>/assets/img/pointer.png" />
	Sélectionner
</label>
<label>
	<img src="<?php echo site_url('modules/workflows') ?>/assets/img/move.svg" width="20px" />
	Déplacer
</label>
</div>
</div>

</article>

<aside class="invisible">
	<table class="table table-bordered table-hover">
		<tbody data-bind="foreach: workflows">
			<tr>
				<td class="action">
					<a href="javascript:void(0)" data-bind="click: editWorkflowName.bind($data)"><i class="glyphicon glyphicon-pencil"></i></a>
				</td>
				<td>
					<!-- ko if: isSelected() -->
					<span data-bind="text: name, visible: !isActive()"></span>
					<!-- /ko -->
					<!-- ko if: !isSelected() -->
					<a href="javascript:void(0)" data-bind="text: name, visible: !isActive(), click: $root.selectWorkflow.bind($data)"></a>
					<!-- /ko -->
					<input type="text" data-bind="value: name,
					visible: isActive(),
					hasfocus: isActive(),
					valueUpdate: 'afterkeydown', 
					enterPress: saveWorkflowName,
					escPress: cancelEditWorkflowName,
					event: { blur: saveOrCancelEdit, focus: selectText.bind($data) }" />
				</td>
				<td class="action delete"><a href="javascript:void(0)" data-bind="click: deleteWorkflow.bind($data, $parent, 'a', 'b')">&times;</a></td>
			</tr>
		</tbody>
	</table>
</aside>

<footer data-bind="css: dirtyState()">
	<button onclick="location.href='<?php echo site_url('backend/module/workflows/workflow'); ?>'" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Historique des workflows</button>
	<button type="button" class="btn btn-primary" id="save"  data-bind="click: saveData, enable: steps().length>0">Enregistrer le Workflow</button>
	<button type="button" class="btn btn-default" id="new"  data-bind="click: newWorkflow">Nouveau Workflow</button>
	<button id="workflowBtn" type="button" class="btn btn-default pull-right" data-bind="enable: workflows().length>0">
		<span class="badge" data-bind="text: workflows().length"></span> Workflows enregistré
	</button>
</footer>

<script>
	var HOME_URL = '<?php echo HOME_URL; ?>'
</script>

<!--Hosted JS-->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.2.0/bootbox.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/knockout/2.2.1/knockout-debug.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/knockout.mapping/2.3.4/knockout.mapping.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script>

<!--Downloaded JS-->
<script type="text/javascript" src="<?php echo site_url('modules/workflows/assets/js/lib/jquery.jsPlumb-1.5.5.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('modules/workflows/assets/js/lib/jquery.contextMenu.js'); ?>"></script>

<!--select2-->
<link rel="stylesheet" href="<?php echo site_url('assets/vendors/select2/css/select2.min.css'); ?>">
<script src="<?php echo site_url('assets/vendors/select2/js/select2.full.min.js'); ?>" type="text/javascript"></script>

<!--App JS-->
<script src="<?php echo site_url('assets/js/etalent-functions.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('modules/workflows/assets/js/ko.extensions.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('modules/workflows/assets/js/demo.data.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('modules/workflows/assets/js/workflowViewModel.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('modules/workflows/assets/js/listViewModel.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('modules/workflows/assets/js/stepViewModel.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('modules/workflows/assets/js/resultViewModel.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('modules/workflows/assets/js/templateViewModel.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('modules/workflows/assets/js/demo.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('modules/workflows/assets/js/plumbing.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('modules/workflows/assets/js/view.js'); ?>" type="text/javascript"></script>