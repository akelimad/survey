<?php
use Modules\Survey\Models\Survey;
use App\Form;
?>
<style>
    textarea{
        resize: vertical;
    }
</style>
<div class="content">
    <input type="hidden" name="id" value="<?= (isset($survey->id)) ? $survey->id : 0 ?>">
    <div class="form-group mb-0">
        <label for="name" class="control-label"> <?= trans_e('Titre'); ?> <span class="asterisk">*</span></label>
        <input type="text" class="form-control" name="name" id="name" value="<?= (isset($survey->name)) ? $survey->name : '' ?>" required>
    </div>
    <div class="form-group mb-0">
        <label for="description" class="control-label"><?= trans_e('Description'); ?></label>
        <textarea class="form-control mb-0" name="description" id="description" style="height: 90px;"><?= (isset($survey->description)) ? $survey->description : '' ?></textarea>
    </div> 
</div>

<script>
$(document).ready(function() {
    $('form').on('chmFormSuccess', function(){
        chmTable.refresh('#surveysTable')
    })
})
</script>