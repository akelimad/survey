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
        margin-bottom: 0;
        margin-top: 0;
    }
    .question-wrap {
        border: 1px solid #d6d1d1;
        margin-bottom: 10px;
        padding: 0 20px;
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
    .table {
        display: table;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        background-color: transparent;
        border-collapse: collapse;
        border-spacing: 0;
    }
    .table-bordered{
        border: 2px solid #ddd;
    }
    .table thead tr td{
        padding: 8px;
        line-height: 1.42857;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .text-center{
        text-align: center;
    }

</style>
<div class="content chm-simple-form">
    <?php if( count(Survey::getSurveyGroups($survey->id))>=1 ) { ?>
        <div class="header-infos">
            <div class="col-md-10 text-center">
                <h3 style="color: #e1a04e"><?= $survey->name ?></h3>
            </div>
            <?php if($route == "backend/survey/".$survey->id."/show"){ ?>
            <div class="col-md-2">
                <a href="<?= site_url('survey/'.$survey->id.'/generatePDF') ?>" class="btn btn-primary btn-xs pull-right mb-10" target="_blank"> <i class="fa fa-file-pdf-o"></i> <?php trans_e('Télécharger') ?></a>
            </div>
            <?php } ?>
            <div class="cleafix"></div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td><?php trans_e("Nom & Prénom : ") ?></td>
                        <td><?php trans_e("Manger : ") ?></td>
                    </tr>
                    <tr>
                        <td><?php trans_e("Date d'entrée : ") ?></td>
                        <td><?php trans_e("Service : ") ?></td>
                    </tr>
                </thead>
            </table>
        </div>
        <?php foreach (Survey::getSurveyGroups($survey->id) as $group) { ?>
        <div class="form-group mb-0">
            <p class="groupeTitle"> <?= $group->name; ?> </p>
            <?php foreach (Survey::getGroupeQuestions($group->id) as $key => $question) { ?>
                <div class="question-wrap">
                <p class="questionTitle"> <i class="fa fa-caret-right"></i> <?= $question->name ?> </p>
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
                        <?php if(($key ++) % 4 == 0 ) { ?>
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
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    <?php }else{ ?>
        <?php get_alert('warning', trans("Il n'ya aucune question pour ce questionnaire !")) ?>
    <?php } ?>
</div>
