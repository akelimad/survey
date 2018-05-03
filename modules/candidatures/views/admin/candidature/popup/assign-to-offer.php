<?= App\Form::input(
  'hidden', 
  'cand_type', 
  null,
  $cand_type
); ?>

<?= App\Form::input(
	'hidden', 
	'candIds', 
	null, 
	htmlentities(json_encode($cIds))
); ?>

<?= App\Form::select(
	'offer_id', 
	trans("Nom de l'offre"), 
	null, 
	App\Models\Offer::findActive(),
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