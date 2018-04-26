<?php
use Modules\Survey\Models\Survey;
use App\Form;
?>
<style>
    textarea{
        resize: vertical;
    }
    .required:after{
        content: '*';
        color: #d43939;
        margin-left: 4px;
        font-size: 13px;
    }
</style>
<div class="content">
    <input type="hidden" name="id" value="<?= (isset($survey->id)) ? $survey->id : 0 ?>">
    <div class="form-group mb-0">
        <label for="name" class="control-label required"> <?= trans_e('Titre'); ?></label>
        <input type="text" class="form-control" name="name" id="name" value="<?= (isset($survey->name)) ? $survey->name : '' ?>" required>
    </div>
    <div class="form-group mb-0">
        <label for="description" class="control-label"><?= trans_e('Description'); ?></label>
        <textarea class="form-control mb-0" name="description" id="description" style="height: 90px;"><?= (isset($survey->description)) ? $survey->description : '' ?></textarea>
    </div> 
</div>

<script>
$(document).ready(function() {
    $('form').on('chm_form_success', function(){
        chmTable.refresh('#surveysTable')
    })
})
</script>