<?php
use App\Assets;
use Modules\Workflows\Models\Workflow;

// register custom ajax actions
new Modules\Workflows\Controllers\AjaxController();

\App\Event::add('wf_offre_form_fields', function(){

	$workflow = new \stdClass;
	if( isset($_POST['id']) && Workflow::hasWorkflow($_POST['id']) ) {
  	$workflow = Workflow::GetWorklowByOfferID($_POST['id']);
	}

	return get_view('admin/partials/offres-form-fields', ['workflow' => $workflow], __FILE__);
});

$uri = addslashes(str_replace(PHYSICAL_URI, '', $_SERVER['REQUEST_URI']));
if( in_array($uri, ['backend/offres/creer_offre/', 'backend/offres/modifier_offre/']) ) {
	Assets::addJS('typeahead', [
		// 'src' => 'http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.min.js', 
	  'src' => site_url('assets/vendors/typeahead/typeahead.bundle.min.js'),
	  'admin' => true,
	  'front' => false
	]);

	Assets::addJS('tagsinput', [
	  'src' => site_url('assets/vendors/tagsinput/bootstrap-tagsinput.min.js'), 
	  'admin' => true,
	  'front' => false
	]);

	Assets::addCSS('tagsinput', [
	  'src' => site_url('assets/vendors/tagsinput/bootstrap-tagsinput.css'), 
	  'admin' => true,
	  'front' => false
	]);

	Assets::addJS('workflow', [
	  'src' => module_url(__FILE__, 'assets/js/workflow.js'), 
	  'admin' => true,
	  'front' => false,
	  'version' => ETA_ASSETS_VERSION
	]);
}