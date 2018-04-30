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
        border-bottom: 2px solid #c7ac8a;
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
    label:hover{
        color: #e88435;
    }
    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #efd3d3 !important; 
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

</style>
<div class="content chm-simple-form">
    <?php if( isset($survey) ) { ?>
        <div class="errorForm mb-10">
            <?php get_alert('danger', trans("Veuillez cocher au moins un choix pour chaque question")) ?>
        </div>
        <form action="survey/<?= $survey->id ?>/storeAnswers" method="post" id="quizForm" onsubmit="return chmForm.submit(event)">
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
                            <?php if( $survey->format == "byQst" ) {$c += 1; ?>
                            <div class="tab">
                            <?php } ?>
                            <p class="questionTitle"> <?= $question->name ?> </p>
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
                                        <select name="<?= $question->id."[".$image->id."]" ?>" id="" class="form-control" >
                                            <option value="0"> <?= trans("Selectionnez") ?> </option>
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
                                        <option value="0"> <?= trans("Selectionnez") ?> </option>
                                        <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                                            <option value="<?= $choice->id ?>"> <?= $choice->name ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            <?php }else{ ?> <!-- checkbox or radio -->
                                <?php foreach (Survey::getQuestionChoices($question->id) as $key => $choice) { ?>
                                <p class="mb-0"> <input type="<?= $question->type ?>" data-id="<?= $question->id ?>" name="<?= $question->id."[]" ?>" class="check-radio" value="<?= $choice->id ?>" id="answer-<?= $choice->id ?>" > <label for="answer-<?= $choice->id ?>"> <?= $choice->name ?> </label> </p>
                                <?php } ?>
                            <?php } ?>
                            <?php if( $survey->format == "byQst" ) { ?>
                            </div>
                            <?php } ?>
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
                    <button type="button" class="btn btn-default" id="prevBtn" onclick="nextPrev(-1)">Précedent</button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
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
</div>

<script>
    $(document).ready(function() {
        $('form').on('chm_form_success', function(event){
            $(this).remove()
            $(".success").show().slideDown()
        })
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
        document.getElementById("nextBtn").innerHTML = "Envoyer";
        document.getElementById("nextBtn").type = "submit";
        document.getElementById("nextBtn").setAttribute('onclick','');
        }else if( n == (x.length) ) {
        } else {
        document.getElementById("nextBtn").innerHTML = "Suivant";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        console.log(validateForm())
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("quizForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
        return chmForm.submit(event)
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = false;
        x = document.getElementsByClassName("tab");
        step = document.getElementsByClassName("step");
        input = x[currentTab].getElementsByTagName("input");
        select = x[currentTab].getElementsByTagName("select");
        var checkInput = false;
        var checkRadio = false;
        var checkCheckbox = false;
        var checkSelect = false;
        for (i = 0; i < input.length; i++) {
            if (input[i].type == "text" && input[i].value != "") {
              valid = true;
              checkInput = true;
            }else if(input[i].type == "checkbox" && input[i].checked){
                valid = true;
                checkRadio = true;
            }else if(input[i].type == "radio" && input[i].checked){
                valid = true;
                checkCheckbox = true;
            }
        }
        for (i = 0; i < select.length; i++) {
            if(select[i].value != 0){
                valid = true;
                checkSelect = true;
            }
        }
        if(!checkInput || !checkRadio || !checkCheckbox || !checkSelect ){
            $(".errorForm").fadeIn()
            $('html, body').animate({
                scrollTop: $(".errorForm").offset().top
            }, 1000);
        }else{
            valid = true;
        }
        if (valid) {
            if(step.length>0){
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            $(".errorForm").fadeOut()
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