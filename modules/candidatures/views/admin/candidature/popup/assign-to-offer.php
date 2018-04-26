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
	App\Models\Offer::findAll(),
	['required']
); ?>