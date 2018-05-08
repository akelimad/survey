<?php
use Modules\Survey\Models\Survey;
use App\Form;
?>
<style>
    .chm-alerts ul {
        margin-left: 10%;
    }
    input[type="radio"]{
        width: 3% !important;
    }
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
    }

</style>
<div class="content chm-simple-form">
    <?php if( count(Survey::getSurveyGroups($survey->id))>=1 ) { ?>
        <?php foreach (Survey::getSurveyGroups($survey->id) as $group) { ?>
        <div class="form-group mb-0">
            <p class="groupeTitle"> <?= $group->name; ?> </p>
            <?php foreach (Survey::getGroupeQuestions($group->id) as $key => $question) { ?>
                <p class="questionTitle"> <?= $question->name ?> </p>
                <?php if($question->type == "textarea" ) { ?>
                    <textarea name="" id="" rows="30" class="form-control" disabled></textarea> 
                <?php }elseif($question->type == "text"){ ?>
                    <input type="text" name="" id="" class="form-control" disabled>
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
                        <select name="" id="" class="form-control">
                            <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                                <option value="<?= $choice->id ?>"> <?= $choice->name ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                <?php }else{ ?>
                    <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                    <p> <input type="<?= $question->type ?>" <?= $choice->is_correct == 1 ? 'checked':'' ?> disabled> <?= $choice->name ?> </p>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
        <?php } ?>
    <?php }else{ ?>
        <?php get_alert('warning', trans("Il n'ya aucune question pour ce questionnaire !")) ?>
    <?php } ?>
</div>
