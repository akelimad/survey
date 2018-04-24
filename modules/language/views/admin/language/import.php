<?php
use App\Form;
use Modules\Language\Models\Language;
?>

<?= Form::select(
  'lang', 
  trans("Choisissez une Langue"), 
  null,
  ['' => ''] + Language::getActiveLanguages(),
  ['required']
); ?>

<?= Form::input(
  'number', 
  'lines_to_ignore', 
  trans("Nombres de lignes à ignorer"),
  1,
  [],
  ['min' => 0, 'step' => 1, 'required']
  );
?>

<?= Form::input(
  'file', 
  'file', 
  trans("Fichier de traductions"),
  null,
  [],
  ['accept' => '.csv', 'required', 'help' => trans("Choisissez un fichier au format CSV")]
  );
?>

<?= Form::input(
  'checkbox', 
  'overwrite', 
  trans("Écraser les anciens traductions"),
  1,
  [],
  ['required', 'checked']
  );
?>

<script>
$(document).ready(function() {
  $('#importTransForm').on('chmFormSuccess', function (event, response) {
    chmTable.refresh($('#stringsTable'), {scrollTo: true})

    chmModal.alert('<?php trans_e("Importation des traductions"); ?>', response.message)
  })
})
</script>