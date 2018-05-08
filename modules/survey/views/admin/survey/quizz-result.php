<?php
use Modules\Survey\Models\Survey;
use App\Form;
?>
<style>
    .groupeTitle{
        background: #676767;
        padding: 5px;
        font-weight: bold;
        text-transform: capitalize;
        color: white;
    }
    .questionTitle{
        font-weight: bold;
        padding: 6px 0;
        color: black;
    }
    .question-wrap {
        border: 1px solid #d6d1d1;
        margin-bottom: 10px;
        padding: 0 20px;
    }
    textarea{
        min-height: 7em !important;
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
    .correct{
        color: green;
    }
    .incorrect{
        color: red;
    }


</style>
<div class="content chm-simple-form">
    <?php if( isset($survey) ) { ?>
        <?php foreach (Survey::getSurveyGroups($survey->id) as $group) { ?>
            <div class="tab">
                <div class="form-group mb-0">
                    <p class="groupeTitle"> <?= $group->name ?> </p>
                    <?php foreach (Survey::getGroupeQuestions($group->id) as $key => $question) {  ?>
                        <div class="question-wrap">
                        <p class="questionTitle"> <i class="fa fa-caret-right"></i> <?= $question->name ?>  </p>
                        <?php if($question->type == "textarea" ) { ?>
                            <textarea name="<?= $question->id ?>" id="" rows="30" class="form-control" ></textarea> 
                        <?php }elseif($question->type == "text"){ ?>
                            <input type="text" name="<?= $question->id ?>" class="form-control" value="">
                        <?php }elseif($question->type == "file"){ ?> <!-- file -->
                            <?php foreach (Survey::getQuestionAttachmnts($question->id) as $key => $image) { ?>
                                <div class="col-md-3">
                                    <div class="imgBox mb-10">
                                        <img src="<?= site_url("uploads/survey/questions/".$question->id."/".$image->file_name) ?>" class="img-responsive" alt="image choice">
                                    </div>
                                    <select name="<?= $question->id."[".$image->id."]" ?>" id="" class="form-control" required>
                                        <option value=""> <?= trans("Selectionnez") ?> </option>
                                        <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                                            <option value="<?= $choice->id ?>"> <?= $choice->name ?> </option>
                                        <?php } ?>
                                        <?php foreach (Survey::getQuestionAttachmnts($question->id) as $key => $choice) { ?>
                                            <option value="<?= $choice->id ?>"> <?= $choice->title ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php if(($key+1) % 3 == 0 ) { ?>
                                <div class="clearfix"></div> 
                                <?php } ?>
                            <?php } ?>
                            <div class="clearfix"></div>
                        <?php }else if($question->type == "select"){ ?> <!-- select -->
                            <div class="col-md-4 pl-0">
                                <select name="<?= $question->id ?>" id="" class="form-control" required>
                                    <option value=""> <?= trans("Selectionnez") ?> </option>
                                    <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                                        <option value="<?= $choice->id ?>"> <?= $choice->name ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        <?php }else{ ?> <!-- checkbox or radio -->
                            <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                            <p class="mb-0"> <input type="<?= $question->type ?>" data-id="<?= $question->id ?>" name="<?= $question->id."[]" ?>" class="check-radio " value="<?= $choice->id ?>" id="answer-<?= $choice->id ?>" <?= $choice->is_correct == 1 ? 'checked':'' ?> disabled > <label for="answer-<?= $choice->id ?>" class="<?php if(in_array($choice->id, Survey::getUserResponse($question->id)) and $choice->is_correct == 1 ){ echo 'correct'; }else if(!in_array($choice->id, Survey::getUserResponse($question->id)) and $choice->is_correct == 1){echo 'incorrect';} ?> " > <?= $choice->name ?> </label> </p>
                            <?php } ?>
                        <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php }else{ ?>
        <?php get_alert('warning', trans("Il n'ya aucune question pour ce questionnaire !")) ?>
    <?php } ?>
</div>