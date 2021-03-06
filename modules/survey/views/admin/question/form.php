<?php
use Modules\Survey\Models\Survey;
use App\Form;
?>
<style>
    textarea{
        resize: vertical;
    }
    .p5{
        padding: 0 5px !important;
    }
    #addLine-wrap, #addLine-wrap2{
        counter-reset: counter-choice;
    }
    #addLine-wrap span.badge::before, #addLine-wrap2 span.badge::before{
        counter-increment: counter-choice;
        content: counter(counter-choice);
    }
    .isCorrect input{
        width: 12px !important;
    }
    .required:after{
        content: '*';
        color: #d43939;
        margin-left: 4px;
        font-size: 13px;
    }
    .badge{
        padding: 1px 3px;
    }
    .answerImage{
        position: relative;
        max-width: 50%;
        border: 1px solid #eae9e9;
    }
    .answerImage span.deleteImage{
        position: absolute;
        top: 0;
        right: 0;
        color: #923434;
        cursor: pointer;
    }
</style>
<div class="content">
    <input type="hidden" name="sid" value="<?= (isset($sid)) ? $sid : 0 ?>">
    <input type="hidden" name="gid" value="<?= (isset($gid)) ? $gid : 0 ?>">
    <input type="hidden" name="qid" value="<?= (!empty($question->id)) ? $question->id : 0 ?>">
    <div class="styled-title mt-0 mb-10">
      <h3><?php trans_e("Question") ?></h3>
    </div>
    <div class="form-group mb-0">
        <label for="name" class="col-md-2 control-label required pl-0"> <?= trans("Titre") ?> </label>
        <div class="col-md-10">
            <input type="text" name="name" id="name" class="form-control" value='<?= isset($question->name) ? $question->name : '' ?>' required>
        </div>
    </div>
    <div class="form-group mb-0">
        <label for="type" class="col-md-2 control-label required pl-0"> <?= trans("Type") ?> </label>
        <div class="col-md-10">
            <select name="type" id="questionType" class="form-control " <?php echo !empty($question->id) ? '' : '' ?>>
                <option value="text" <?= (isset($question->type) and $question->type == "text") ? 'selected': '' ?> > Text  </option>
                <option value="textarea" <?= (isset($question->type) and $question->type == "textarea") ? 'selected': '' ?> > Textarea   </option>
                <option value="select" <?= (isset($question->type) and $question->type == "select") ? 'selected': '' ?> > Liste déroulante   </option>
                <option value="checkbox" <?= (isset($question->type) and $question->type == "checkbox") ? 'selected': '' ?> > Case à cocher  </option>
                <option value="radio" <?= (isset($question->type) and $question->type == "radio") ? 'selected': 'n' ?> > Radio button   </option>
                <option value="file" <?= (isset($question->type) and $question->type == "file") ? 'selected': '' ?> > Image   </option>
            </select>
        </div>
    </div>

<!--     <div class="form-group mb-0 answerBy" style="display: none;">
        <label for="type" class="col-md-2 control-label required pl-0"> <?= trans("Comment répondre") ?> </label>
        <div class="col-md-10">
            <select name="answerBy" class="form-control">
                <option value="select"> <?= trans("Selection") ?> </option>
                <option value="write"> <?= trans("Ecriture") ?> </option>
            </select>
        </div>
    </div> -->
    <div id="addLine-wrap">
        <div class="styled-title mt-0 mb-10">
          <h3><?php trans_e("Réponses") ?></h3>
        </div>
        <?php foreach ($choices as $key => $choice) { ?>
            <?php if( !empty($question->id) and $key == 0 ){ ?>
            <input type="hidden" name="firstanswerId" value="<?= $choice->id ?>" >
            <?php } ?>
            <div class="form-group mb-10" >
                <label class="col-md-2 control-label required pl-0"><?= trans_e("Choix") ?> : <span class="badge"> </span></label>
                <div class="col-md-8 answer">
                    <input type="text" class="form-control" name="<?= (!empty($question->id) && $key != 0) ? "answers[$choice->id][choice]":"answers[0][choice]" ?>" value="<?php if (!empty($question->id) and $question->type=='file'){echo$choice->title;}elseif(!empty($question->id) and in_array($question->type, ['radio', 'select', 'checkbox']) ){echo$choice->name;}  ?>"  required />
                </div>
                <div class="col-md-1 isCorrect pl-5" >
                    <input type="radio" class="form-control" name="<?= (!empty($question->id) and $key != 0 and !in_array($question->type,["radio", "select"]) ) ? "answers[$choice->id][isCorrect]":"answers[0][isCorrect]" ?>" title="<?= trans_e("Cochez si ce choix fait partie de la bonne réponse") ?>" <?= !empty($question->id) && $question->type != 'file' && $choice->is_correct == 1 ? 'checked':'' ?> value="<?php echo (!empty($question->id)) ? $choice->id : 0  ?>" />
                </div>
                <div class="imageTypeRow">
                    <div class="col-md-5">
                        <?php if(!empty($question->id) and $question->type == "file" and !empty($choice->file_name)){ ?>
                            <div class="answerImage" id="<?= (!empty($question->id) and $question->type == "file") ? $choice->id:'' ?>">
                                <img src="<?= site_url("uploads/survey/questions/".$question->id."/".$choice->file_name) ?>" class="img-responsive" width="50" alt="image choice" required>
                                <span class="deleteImage" data-id="<?= !empty($question->id) ? $choice->id : '' ?>" onclick="return chmModal.confirm('', '', '<?php trans_e("Êtes-vous sûr de vouloir supprimer cette question ?") ?>', 'Question.deleteImage', &#123;'sid': <?= $sid ?>, 'gid':<?= $gid ?>, 'qid':<?= $question->id ?>, 'attachmentId':<?= $choice->id ?> &#125;, {width: 335})" >
                                    <i class="fa fa-close"></i> 
                                </span>
                            </div>
                        <?php }else{ ?>
                            <div class="input-group file-upload" id="<?= (!empty($question->id) and $question->type == "file") ? $choice->id:'' ?>" >
                                <input type="text" class="form-control" name="fileName[0]" disabled placeholder="<?= trans_e("Choisissez l'image") ?>">
                                <label class="input-group-btn">
                                <span class="btn btn-success btn-sm">
                                    <i class="fa fa-upload"></i>
                                    <input type="file" class="form-control attachments" name="attachments[]" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" name="<?php if((!empty($question->id) and $question->type == "file")){echo "attachmentsId[]";} ?>" value="<?= (!empty($question->id) and $question->type == "file") ? $choice->id:'' ?>">
                                </span>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control attachments" name="<?= (!empty($question->id) and $question->type=="file") ? "answers[$choice->id][attachmentLabels]" : "attachmentLabels[]" ?>" value="<?= (!empty($question->id) and $question->type == 'file') ? $choice->title : '' ?>" placeholder="<?php trans_e("La bonne réponse") ?>" required />
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="button" data-answerid="<?= (!empty($question->id) and $key != 0) ? $choice->id:"" ?>" class="btn btn-default btn-sm <?= $key == 0 ? 'addLine':'deleteLine' ?> pull-right" title="<?= $key == 0 ? trans("Ajouter un choix"): trans("Supprimer ce choix") ?>" ><i class="fa <?= $key == 0 ? 'fa-plus':'fa-minus' ?>"></i></button>
                </div>
            </div>
        <?php } ?>
    </div>

    <div id="addLine-wrap2" style="display: none;">
        <div class="styled-title mt-0 mb-10">
          <h3><?php trans_e("Mots clés") ?></h3>
        </div>
        <p class="help-block"> <i class="fa fa-info-circle"></i> <?php trans_e("Les bonnes réponses seront melangées avec les mot clés.") ?> </p>
        <?php foreach ($keywords as $key => $keyword) { ?>
            <?php if( !empty($question->id) and $key == 0 ){ ?>
            <input type="hidden" name="firstKeyWordId" value="<?= $keyword->id ?>" >
            <?php } ?>
            <div class="form-group mb-0" >
                <label class="col-md-2 control-label required pl-0"><?= trans_e("Mot clé") ?> : <span class="badge"> </span></label>
                <div class="col-md-9 answer">
                    <input type="text" class="form-control" name="<?= !empty($question->id) && $key != 0 ? "answers[$keyword->id][key]":"answers[0][key]" ?>" value="<?= (!empty($question->id) and $question->type=="file") ? $keyword->name : '' ?>" placeholder="<?php trans_e("Mot clé") ?>" required />
                </div>
                <div class="col-md-1">
                    <button type="button" data-answerid="<?= (!empty($question->id) and $key != 0) ? $keyword->id : "" ?>" class="btn btn-default btn-sm <?= $key == 0 ? 'addLine2':'deleteLine2' ?> pull-right" title="<?= $key == 0 ? trans("Ajouter un mot clé"): trans("Supprimer ce mot clé") ?>" ><i class="fa <?= $key == 0 ? 'fa-plus':'fa-minus' ?>"></i></button>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
$(function() {
    <?php if(!empty($question->id)){ ?>
    $('select#questionType').attr('disabled', 'disabled');
    $(':submit').on('click', function() {
        $('select#questionType').removeAttr('disabled');
    });
    <?php } ?>

    $("#questionType").change(function(){
        value = $(this).val()
        if(value == "text" || value == "textarea" ){
            $("#addLine-wrap2").hide()
            $("#addLine-wrap").hide()
            $(".answerBy").hide()
            $(".imageTypeRow").hide()
            $("#addLine-wrap .imageTypeRow input.attachments").prop('required', false)
            $("#addLine-wrap .answer input, #addLine-wrap2 .answer input").prop('required', false)
            $("#addLine-wrap .imageTypeRow input.attachments").prop('required', false)
        }else if(value == "file"){
            $("#addLine-wrap2 .answer input").prop('required', true)
            $(".answerBy").show()
            $("#addLine-wrap2").show()
            $("#addLine-wrap").show()
            $("#addLine-wrap .answer").css('display', 'none')
            $(".isCorrect").hide()
            $(".imageTypeRow").show()
            $("#addLine-wrap .isCorrect input:first-of-type").attr('type', 'radio')
            $("#addLine-wrap .answer input").prop('required', false)
            // $("#addLine-wrap .imageTypeRow input.attachments").prop('required', true)
        }else if(value == "radio" || value == "select"){
            $(".answerBy").hide()
            $("#addLine-wrap").show()
            $("#addLine-wrap2").hide()
            $(".answer").show()
            $(".isCorrect").show()
            $(".imageTypeRow").hide()
            $("#addLine-wrap .isCorrect input:first-of-type").attr('type', 'radio')
            $("#addLine-wrap .imageTypeRow input.attachments").prop('required', false)
            $("#addLine-wrap2 .answer input").prop('required', false)
            $("#addLine-wrap .answer input").prop('required', true)
        }else if(value == "checkbox"){
            $(".answerBy").hide()
            $("#addLine-wrap .imageTypeRow input.attachments").prop('required', false)
            $(".answer").show()
            $(".isCorrect").show()
            $("#addLine-wrap").show()
            $("#addLine-wrap2").hide()
            $(".imageTypeRow").hide()
            $("#addLine-wrap .answer input, #addLine-wrap2 .answer input").prop('required', false)
            $("#addLine-wrap .isCorrect input:first-of-type").attr('type', 'checkbox')
        }
    })
    $("#questionType").change()

    function uuidv4() {
        return ([1e7]+-1e3).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        )
    }
    $(".addLine").click(function(event){
        event.preventDefault()
        var copy = $('#addLine-wrap').find(".form-group:first").clone()
        copy.find('input').val('')
        copy.find('input:checkbox').prop('checked', false)
        copy.find('input:radio').prop('checked', false)
        copy.find('img').remove()
        copy.find('.answerImage').hide()
        copy.find(".file-upload").show().attr('id', '')
        copy.find('button').toggleClass('addLine deleteLine')
        copy.find('button>i').toggleClass('fa-plus fa-minus')
        var uid = uuidv4()
        $.each(copy.find('input'), function(){
            var name = $(this).attr('name')
            console.log(value)
            if($(this).attr("type") != "radio" ){
                $(this).attr('name', name.replace('[0]', '['+uid+']'))  
            }else{
                $(this).val(uid)
            }
        })
        $('#addLine-wrap').append(copy)
    })
    $('#addLine-wrap').on('click', '.deleteLine', function(){
        $(this).closest('.form-group').remove();
    });

    $(".addLine2").click(function(event){
        event.preventDefault()
        var copy = $('#addLine-wrap2').find(".form-group:first").clone()
        copy.find('input').val('')
        copy.find('input:checkbox').prop('checked', false)
        copy.find('input:radio').prop('checked', false)
        copy.find('img').remove()
        copy.find('button').toggleClass('addLine2 deleteLine2')
        copy.find('button>i').toggleClass('fa-plus fa-minus')
        var uid = uuidv4()
        $.each(copy.find('input'), function(){
            var name = $(this).attr('name')
            if($(this).attr("type") != "radio"){
                $(this).attr('name', name.replace('[0]', '['+uid+']'))  
            }
        })
        $('#addLine-wrap2').append(copy)
    })
    $('#addLine-wrap2').on('click', '.deleteLine2', function(){
        $(this).closest('.form-group').remove();
    });

    $('form').on('chmFormSuccess', function(){
        chmTable.refresh('#questionsTable')
    })
    

    $(".deleteLine ,.deleteLine2").on('click', function(){
        var $this = $(this);
        var aid = $(this).data('answerid');
        var url = "backend/survey/group/question/answer/"+ aid;
        var confirmText = "Etês-vous sûr de vouloir supprimer ?";
        if( aid != "" ){
            if(confirm(confirmText) ) {
                $.ajax({
                    type:"POST",
                    url: url,
                    data: aid,
                    success:function () {
                        $this.closest('.form-group').remove();
                    },
                });
            }
            return false;
        }else{
            $this.closest('.form-group').remove();
        }
    })


})
</script>