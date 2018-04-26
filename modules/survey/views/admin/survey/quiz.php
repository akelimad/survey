<?php
use Modules\Survey\Models\Survey;
use App\Form;
?>
<style>
    .groupeTitle{
        background: #efefef;
        padding: 5px;
        font-weight: bold;
        text-transform: capitalize;
    }
    .questionTitle{
        text-decoration: underline;
        font-weight: bold;
    }
    textarea{
        height: 7em !important;
        resize: vertical;
    }
    .imgBox{
        height: 133px;
    }
    .imgBox img{
        max-height: 100%;
        margin: auto;
    }
    label{
        display: inline-block !important;
        cursor: pointer;
    }
    label:hover{
        color: #e88435;
    }

</style>
<div class="content chm-simple-form">
    <?php if( isset($survey) ) { ?>
    <form action="survey/<?= $survey->id ?>/storeAnswers" method="post" onsubmit="return chmForm.submit(event)">
        <?php foreach (Survey::getSurveyGroups($survey->id) as $group) { ?>
        <div class="form-group mb-0">
            <p class="groupeTitle"> <?= $group->name; ?> </p>
            <?php foreach (Survey::getGroupeQuestions($group->id) as $key => $question) { ?>
                <p class="questionTitle"> <?= $question->name ?> </p>
                <?php if($question->type == "textarea" ) { ?>
                    <textarea name="<?= $question->id ?>" id="" rows="30" class="form-control" required></textarea> 
                <?php }elseif($question->type == "text"){ ?>
                    <input type="text" name="<?= $question->id ?>" id="" class="form-control" required>
                <?php }elseif($question->type == "file"){ ?>
                    <?php foreach (Survey::getQuestionAttachmnts($question->id) as $key => $image) { ?>
                        <div class="col-md-3">
                            <div class="imgBox mb-10">
                                <img src="<?= site_url("uploads/survey/questions/".$question->id."/".$image->file_name) ?>" class="img-responsive" alt="image choice">
                            </div>
                            <select name="<?= $question->id ?>" id="" class="form-control" required>
                                <option value=""> <?= trans("Selectionnez") ?> </option>
                                <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                                    <option value="<?= $choice->id ?>"> <?= $choice->name ?> </option>
                                <?php } ?>
                                <?php foreach (Survey::getQuestionAttachmnts($question->id) as $key => $choice) { ?>
                                    <option value="<?= $choice->id ?>"> <?= $choice->title ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php if(($key+1) % 4 == 0 ) { ?>
                        <div class="clearfix"></div> 
                        <?php } ?>
                    <?php } ?>
                    <div class="clearfix"></div>
                <?php }else if($question->type == "select"){ ?>
                    <div class="col-md-4 pl-0">
                        <select name="<?= $question->id ?>" id="" class="form-control" required>
                            <option value=""> <?= trans("Selectionnez") ?> </option>
                            <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                                <option value="<?= $choice->id ?>"> <?= $choice->name ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                <?php }else{ ?>
                    <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                    <p> <input type="<?= $question->type ?>" name="<?= $question->id."[]" ?>" value="<?= $choice->id ?>" id="answer-<?= $choice->id ?>" > <label for="answer-<?= $choice->id ?>"> <?= $choice->name ?> </label> </p>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="action">
            <button type="submit" class="btn btn-primary pull-right"> <i class="fa fa-check"></i> <?= trans("Valider") ?> </button>
            <div class="clearfix"></div>
        </div>
    </form>
    <?php }else{ ?>
        <?php get_alert('warning', trans("Il n'ya aucune question pour ce questionnaire !")) ?>
    <?php } ?>
    <div class="success" style="display: none;">
        <?php get_alert('success', trans("Merci pour votre réponse !")) ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('form').on('chm_form_success', function(event){
        $(this).remove()
        $(".success").show().slideDown()
    })
})
</script>