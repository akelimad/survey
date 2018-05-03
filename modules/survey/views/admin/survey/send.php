<?= App\Form::input(
	'hidden', 
	'candIds', 
	null, 
	htmlentities(json_encode($candIds))
); ?>

<?= App\Form::select(
	'survey_id', 
	trans("Titre de questionnaire"), 
	null, 
	Modules\Survey\Models\Survey::findActive(),
	['required']
); ?>

<script>
jQuery(document).ready(function($){

  $('form').on('chmFormSuccess', function (event, response) {
    if (response.status === 'reload') {
      window.location.reload()
    }
  })

})
</script>