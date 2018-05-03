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
    label{
        padding-left: 0 !important;
    }
    label input{
        float: left;
        position: static !important;
    }
</style>
<div class="content">
    <input type="hidden" name="id" value="<?= (isset($survey->id)) ? $survey->id : 0 ?>">
    <div class="form-group mb-0">
        <label for="name" class="control-label required"> <?= trans_e('Titre'); ?></label>
        <input type="text" class="form-control" name="name" id="name" value="<?= (isset($survey->name)) ? $survey->name : '' ?>" required>
    </div>
    <div class="form-group">
        <label for="description" class="control-label"><?= trans_e('Description'); ?></label>
        <textarea class="form-control mb-0" name="description" id="description" style="height: 90px;"><?= (isset($survey->description)) ? $survey->description : '' ?></textarea>
    </div>
    <div class="form-group mb-0">
        <label for="format" class="control-label"><?= trans_e('Format'); ?></label>
        <div class="col-md-4 pl-0">
            <label class="radio-inline"><input type="radio" name="format" value="byGroup" <?= (isset($survey->format) and $survey->format == "byGroup") ? 'checked':'' ?> disabled><?php trans_e("Par groupe"); ?></label>
        </div>
        <div class="col-md-4">
            <label class="radio-inline"><input type="radio" name="format" value="byQst" <?= (isset($survey->format) and $survey->format == "byQst") ? 'checked':'' ?> disabled><?php trans_e("Par question "); ?></label>
        </div>
        <div class="col-md-4">
            <label class="radio-inline"><input type="radio" name="format" value="all" <?= (isset($survey->format) and $survey->format == "all") ? 'checked':'' ?> ><?php trans_e("Tout en un "); ?></label>
        </div>
        <div class="cleafix"></div>
    </div>
    <div class="form-group mb-0">
        <label for="format" class="control-label"><?= trans_e('Actif'); ?></label>
        <select name="active" id="" class="form-control">
            <option value="1" <?= (isset($survey->active) and $survey->active == 1) ? 'selected':'' ?> > <?php trans_e("Activé") ?> </option>
            <option value="0" <?= (isset($survey->active) and $survey->active == 0) ? 'selected':'' ?> > <?php trans_e("Desactivé") ?> </option>
        </select>
    </div>  
</div>

<script>
$(document).ready(function() {
    $('form').on('chmFormSuccess', function(){
        chmTable.refresh('#surveysTable')
    })
})
</script>