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
        margin-bottom: 0;
        margin-top: 0;
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
        display: inline !important;
        cursor: pointer;
        margin-left: 7px
    }
    label:hover{
        color: #e88435;
    }
    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #eadddd !important; 
    }
    select.invalid {
      color : #a71414 !important;
    }
    /* Hide all steps by default: */
    .tab {
      display: none;
    }
    button {
      background-color: #4CAF50;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      font-size: 17px;
      cursor: pointer;
    }
    button:hover {
      opacity: 0.8;
    }
    #prevBtn {
      background-color: #bbbbbb;
    }
    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #e1a06d;
      border: none;  
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }
    .step.active {
      opacity: 1;
    }
    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #4CAF50;
    }
    input[type="text"] {
      height: 28px;
      font-size: 12px;
      width: 100%;
      padding: 0 5px;
      border: 1px solid #aaaaaa;
      outline: none;
    }
    .errorForm{
        display: none ;
    }
    #sendBtn{
        display: none;
    }

</style>
<div class="content chm-simple-form">
    <?php if(!Survey::checkUserResponse($token->token)) { ?>
        <?php if( isset($survey) ) { ?>
            <div class="row">
                <div class="col-md-12">
                    <p> 
                        <span class="mr-10"><i class="fa fa-edit"></i> <strong><?php trans_e("Questionnaire : ") ?></strong> <?= $survey->name ?></span>
                        <span class="mr-10"><i class="fa fa-user"></i> <strong><?php trans_e("Nom du candidat : ") ?></strong> <?= $token->firstname ?></span>
                        <span class="mr-10"><i class="fa fa-user"></i> <strong><?php trans_e("Prénom du candidat : ") ?></strong> <?= $token->lastname ?></span>
                    </p>
                </div>
            </div>
            <div class="errorForm mb-10">
                <?php get_alert('danger', trans("Veuillez cocher au moins un choix pour chaque question")) ?>
            </div>
            <form action="<?=site_url().'survey/'.$data["params"][1].'/'.$data["params"][2].'/storeAnswers' ?>" method="POST" id="quizForm" onsubmit="return chmForm.submit(event)">
                <?php $c = 0; ?>
                <?php if( $survey->format == "all" ) {  ?>
                <div class="tab">
                <?php } ?>
                <?php foreach (Survey::getSurveyGroups($survey->id) as $group) { ?>
                    <?php if( $survey->format == "byGroup" ) { $c += 1; ?>
                    <div class="tab">
                    <?php } ?>
                        <div class="form-group mb-0">
                            <?php if($survey->format != "byQst"){ ?>
                            <p class="groupeTitle"> <?= $group->name ?> </p>
                            <?php } ?>
                            <?php foreach (Survey::getGroupeQuestions($group->id) as $key => $question) {  ?>
                                <?php if( $survey->format == "byQst" ) { $c += 1; ?>
                                <div class="tab">
                                <?php } ?>
                                <div class="question-wrap <?php if($question->type == 'radio'){ echo 'radio-wrap';}else if($question->type == 'checkbox'){echo 'checkbox-wrap';} ?>" id="q-<?= $question->id ?>">
                                <p class="questionTitle"> <i class="fa fa-caret-right"></i> <?= $question->name ?> </p>
                                <?php if($question->type == "textarea" ) { ?>
                                    <textarea name="<?= $question->id ?>" id="" rows="30" class="form-control" ></textarea> 
                                <?php }elseif($question->type == "text"){ ?>
                                    <input type="text" name="<?= $question->id ?>" oninput="this.className = ''" class="form-control" >
                                <?php }elseif($question->type == "file"){ ?> <!-- file -->
                                    <?php foreach (Survey::getQuestionAttachmnts($question->id) as $key => $image) { ?>
                                        <div class="col-md-3">
                                            <div class="imgBox mb-10">
                                                <img src="<?= site_url("uploads/survey/questions/".$question->id."/".$image->file_name) ?>" class="img-responsive" alt="image choice">
                                            </div>
                                            <select name="<?= $question->id."[".$image->id."]" ?>" id="" class="form-control" required>
                                                <option value=""> <?= trans("Selectionnez") ?> </option>
                                                <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                                                    <option value="<?= $choice->name ?>"> <?= $choice->name ?> </option>
                                                <?php } ?>
                                                <?php foreach (Survey::getQuestionAttachmnts($question->id) as $key => $choice) { ?>
                                                    <option value="<?= $choice->title ?>"> <?= $choice->title ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php if(($key ++) % 4 == 0 ) { ?>
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
                                    <p class="mb-0 mt-0"> <input type="<?= $question->type ?>" data-id="<?= $question->id ?>" name="<?= $question->id."[]" ?>" class="check-radio" value="<?= $choice->id ?>" id="answer-<?= $choice->id ?>" > <label for="answer-<?= $choice->id ?>"> <?= $choice->name ?> </label> </p>
                                    <?php } ?>
                                <?php } ?>
                                <?php if( $survey->format == "byQst" ) { ?>
                                </div>
                                <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php if( $survey->format == "byGroup" ) { ?>
                    </div>
                    <?php } ?>
                <?php } ?>
                <?php if( $survey->format == "all" ) { ?>
                </div>
                <?php } ?>
                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" class="btn btn-default" id="prevBtn" onclick="nextPrev(-1)">Précédent</button>
                        <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
                        <button type="submit" class="btn btn-primary" id="sendBtn">Envoyer</button>
                    </div>
                </div>
                <div style="text-align:center;margin-top:40px;">
                    <?php for ($i = 0; $i < $c; $i++) { ?>
                        <span class="step"></span>
                    <?php } ?>
                </div>
            </form>
        <?php }else{ ?>
            <?php get_alert('warning', trans("Il n'ya aucune question pour ce questionnaire !")) ?>
        <?php } ?>
        <div class="success" style="display: none;">
            <?php get_alert('success', trans("Merci pour votre réponse !")) ?>
        </div>
    <?php }else{ ?>
        <?php get_alert('warning', trans("Vous avez déjà répondu sur ce questionnaire !")) ?>
    <?php } ?>
</div>

<script>
    $(document).ready(function() {
        $('form').on('chmFormSuccess', function(event, response){
            if(response.status == "success"){
                $(this).remove()
                $(".success").show().slideDown()
                $(".errorForm").hide()
            }
        })

        // $("#sendBtn").on("click", function(){
        //     if (!validateForm()){
        //         $(this).attr('type', 'button')
        //         return false;
        //     }else{
        //         $(this).attr('type', 'submit')
        //         return true
        //     }
        // })
    })
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the crurrent tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            $("#nextBtn").hide()
            $("#sendBtn").show()
            $(".errorForm").fadeOut()
        } else {
            $("#nextBtn").show()
            $("#sendBtn").hide()
            document.getElementById("nextBtn").innerHTML = "Suivant";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        console.log(validateForm())
        // This function will figure out which tab to display
        var tab = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        // if ( n == 1 && !validateForm()) return false;
        // Hide the current tab:
        tab[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        // if (currentTab >= tab.length) {
        //     // // ... the form gets submitted:
        //     document.getElementById("quizForm").submit();
        //     return false;
        // }
        // Otherwise, display the correct tab:
        showTab(currentTab);
        // return chmForm.submit(event)
    }

    function validateForm() {
        var tabs, y, i, j, valid = true;
        tabs = document.getElementsByClassName("tab");
        step = document.getElementsByClassName("step");
        input = tabs[currentTab].getElementsByClassName("input");
        inputRadio = tabs[currentTab].getElementsByClassName("radio-wrap");
        inputCheckbox = tabs[currentTab].getElementsByClassName("checkbox-wrap");
        select = tabs[currentTab].getElementsByTagName("select");
        var checkInput = true;
        var checkCheckbox = true;
        var checkRadio = true;
        var checkSelect = true;
        var checkedradiocount = 0
        var checkedCheckboxcount = 0
        radioLength = $('.tab .radio-wrap').length
        $('.tab .radio-wrap').each(function(){
            if($(this).find('input[type="radio"]:checked').length > 0){
                checkedradiocount ++
            }
        });
        checkboxLength = $('.tab .checkbox-wrap').length
        $('.tab .checkbox-wrap').each(function(){
            if($(this).find('input[type="checkbox"]:checked').length > 0){
                checkedCheckboxcount ++
            }
        });
        for (i = 0; i < input.length; i++) {
            if (input[i].type == "text" && input[i].value == "" ) {
                valid = false;
                checkInput = false;
                input[i].className += " invalid";
            }else if(input[i].type == "text"){
                console.log()
            }
        }
        for (i = 0; i < select.length; i++) {
            if(select[i].value == ""){
                select[i].className += " invalid";
                valid = false
                checkSelect = false
            }
        }
        if(checkedradiocount != radioLength){
            checkRadio = false;
            valid = false
        }
        if(checkedCheckboxcount != checkboxLength){
            checkCheckbox = false;
            valid = false
        }
        // if(checkSelect && checkRadio && checkCheckbox){
        //     valid = true;
        // }else{
        //     $(".errorForm").fadeIn()
        //     $('html, body').animate({
        //         scrollTop: $(".errorForm").offset().top
        //     }, 1000);
        // }
        if (valid) {
            if(step.length>0){
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
        }
        return valid;
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        if(x.length>0){
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    }

</script>