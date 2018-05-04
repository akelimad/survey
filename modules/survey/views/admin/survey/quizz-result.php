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
        font-weight: bold !important;
    }
    .candidatAnswer{
        color: blue;
        font-weight: bold !important;
    }
    .incorrect{
        color: red;
    }
    .note{
        background: #e1a04e;
        text-align: center;
        padding: 5px;
        font-style: italic;
        color: #c33e3e;
    }


</style>
<div class="content chm-simple-form">
    <?php if( isset($survey) and Survey::checkUserResponse($token) ) { ?>
        <div class="row">
            <div class="col-md-12">
                <h3 class="note"><?php trans_e("Le resultat pour ce questionnaire est") ?> : 00/<?= $countQuestions < 10 ? '0'.$countQuestions : $countQuestions ?></h3>
            </div>
        </div>
        <?php foreach (Survey::getSurveyGroups($survey->id) as $group) { ?>
            <div class="tab">
                <div class="form-group mb-0">
                    <p class="groupeTitle"> <?= $group->name ?> </p>
                    <?php foreach (Survey::getGroupeQuestions($group->id) as $key => $question) {  ?>
                        <div class="question-wrap">
                        <p class="questionTitle"> <i class="fa fa-caret-right"></i> <?= $question->name ?>  </p>
                        <?php if($question->type == "textarea" ) { ?>
                            <p> <?= $question->type=="textarea" ? Survey::getUserResponse($token ,$question->id)[0] : '' ?> </p>
                        <?php }elseif($question->type == "text"){ ?>
                            <p> <?= $question->type=="text" ? Survey::getUserResponse($token ,$question->id)[0] : '' ?> </p>
                        <?php }elseif($question->type == "file"){ ?> <!-- file -->
                            <?php foreach (Survey::getQuestionAttachmnts($question->id) as $key => $image) { ?>
                                <div class="col-md-3 mb-10 text-center">
                                    <div class="imgBox mb-10">
                                        <img src="<?= site_url("uploads/survey/questions/".$question->id."/".$image->file_name) ?>" class="img-responsive" alt="image choice">
                                    </div>
                                    <?php if(Survey::getUserResponse($token ,$question->id)[$key] == $image->title){ ?>
                                        <span class="correct"> <i class="fa fa-check"></i> <?= Survey::getUserResponse($token ,$question->id)[$key] ?> </span>
                                    <?php }else{ ?>
                                        <span class="incorrect mr-10"> <i class="fa fa-close"></i> <?= Survey::getUserResponse($token ,$question->id)[$key] ?> </span>
                                        <span class="correct"> <i class="fa fa-check"></i> <?= $image->title ?> </span>
                                    <?php } ?>
                                </div>
                                <?php if(($key+1) % 4 == 0 ) { ?>
                                <div class="clearfix"></div> 
                                <?php } ?>
                            <?php } ?>
                            <div class="clearfix"></div>
                        <?php }else if($question->type == "select"){ ?> <!-- select -->
                            <div class="col-md-4 pl-0 mb-10">
                                <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                                    <?php if(Survey::getUserResponse($token ,$question->id)[0] == $choice->id and $choice->is_correct != 1){ ?>
                                        <span class="incorrect"> <i class="fa fa-close"></i> <?= $choice->name ?> </span>
                                    <?php } ?>
                                    <?php if($choice->is_correct == 1){ ?>
                                        <span class="correct"> <i class="fa fa-check"></i> <?= $choice->name  ?> </span>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                        <?php }else{ ?> <!-- checkbox or radio -->
                            <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                            <p class="mb-0"> 
                                <input type="<?= $question->type ?>" disabled > 
                                <label for="answer-<?= $choice->id ?>" class="<?php if((in_array($choice->id, Survey::getUserResponse($token ,$question->id)) and $choice->is_correct == 1) || (in_array($choice->id, Survey::getUserResponse($token ,$question->id)) and $choice->is_correct != 1) ){ echo 'candidatAnswer'; } ?>" > 
                                    <?= $choice->name ?> <?= $choice->is_correct == 1 ? '<i class="fa fa-check correct"></i>':'' ?> <?php if(in_array($choice->id, Survey::getUserResponse($token ,$question->id)) and $choice->is_correct != 1){echo "<i class='fa fa-close incorrect'></i>";} ?> 
                                </label> 
                            </p>
                            <?php } ?>
                        <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php }else{ ?>
        <?php get_alert('warning', trans("Il n'ya aucune question pour ce questionnaire ou vous avez n'avez pas encore répondu !")) ?>
    <?php } ?>
</div>