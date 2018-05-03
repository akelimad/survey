<?php
use Modules\Survey\Models\Group;
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
    <input type="hidden" name="gid" value="<?= (isset($group->id)) ? $group->id : 0 ?>">
    <div class="form-group mb-0">
        <label for="name" class="control-label required"> <?= trans_e('Titre'); ?></label>
        <input type="text" class="form-control" name="name" id="name" value="<?= (isset($group->name)) ? $group->name : '' ?>" required>
    </div>
    <div class="form-group mb-0">
        <label for="description" class="control-label"><?= trans_e('Description'); ?></label>
        <textarea class="form-control mb-0" name="description" id="description" style="height: 90px;"><?= (isset($group->description)) ? $group->description : '' ?></textarea>
    </div> 
</div>

<script>
$(document).ready(function() {
    $('form').on('chmFormSuccess', function(){
        chmTable.refresh('#groupsTable')
    })
})
</script>