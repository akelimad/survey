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
      background-color: #bbbbbb;
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

</style>
<div class="content chm-simple-form">
    <?php if( isset($survey) ) { ?>
        <form action="survey/<?= $survey->id ?>/storeAnswers" method="post" id="quizForm" onsubmit="return chmForm.submit(event)">
            <?php if( $survey->format == "all" ) { ?>
                <?php foreach (Survey::getSurveyGroups($survey->id) as $group) { ?>
                    <div class="form-group mb-0">
                        <p class="groupeTitle"> <?= $group->name; ?> </p>
                        <?php foreach (Survey::getGroupeQuestions($group->id) as $key => $question) { ?>
                            <p class="questionTitle"> <?= $question->name ?> </p>
                            <?php if($question->type == "textarea" ) { ?>
                                <textarea name="<?= $question->id ?>" id="" rows="30" class="form-control" required></textarea> 
                            <?php }elseif($question->type == "text"){ ?>
                                <input type="text" name="<?= $question->id ?>" id="" class="form-control" required>
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
                                    <?php if(($key+1) % 4 == 0 ) { ?>
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
                                <p> <input type="<?= $question->type ?>" name="<?= $question->id."[]" ?>" class="check-radio" value="<?= $choice->id ?>" id="answer-<?= $choice->id ?>" > <label for="answer-<?= $choice->id ?>"> <?= $choice->name ?> </label> </p>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="action">
                    <button type="submit" class="btn btn-primary pull-right"> <i class="fa fa-check"></i> <?= trans("Valider") ?> </button>
                    <div class="clearfix"></div>
                </div>
            <?php }elseif( $survey->format == "byGroup" ){ ?>
                <!-- One "tab" for each group in the form: -->
                <?php foreach (Survey::getSurveyGroups($survey->id) as $group) { ?>
                    <div class="tab">
                        <div class="form-group mb-0">
                            <p class="groupeTitle"> <?= $group->name; ?> </p>
                            <?php foreach (Survey::getGroupeQuestions($group->id) as $key => $question) { ?>
                                <p class="questionTitle"> <?= $question->name ?> </p>
                                <?php if($question->type == "textarea" ) { ?>
                                    <textarea name="<?= $question->id ?>" id="" rows="30" class="form-control" required></textarea> 
                                <?php }elseif($question->type == "text"){ ?>
                                    <input type="text" name="<?= $question->id ?>" oninput="this.className = ''" class="form-control" required>
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
                                        <?php if(($key+1) % 4 == 0 ) { ?>
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
                                    <p class="mb-0"> <input type="<?= $question->type ?>" name="<?= $question->id."[]" ?>" class="check-radio" value="<?= $choice->id ?>" id="answer-<?= $choice->id ?>" > <label for="answer-<?= $choice->id ?>"> <?= $choice->name ?> </label> </p>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" class="btn btn-default" id="prevBtn" onclick="nextPrev(-1)">Précedent</button>
                        <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
                    </div>
                </div>
                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <?php foreach (Survey::getSurveyGroups($survey->id) as $group) { ?>
                        <span class="step"></span>
                    <?php } ?>
                </div>
            <?php }elseif( $survey->format == "byQst" ){ ?>
                <!-- One "tab" for each question in the form: -->
                <?php $c= 0; ?>
                <?php foreach (Survey::getSurveyGroups($survey->id) as $group) { ?>
                    <div class="form-group mb-0">
                        <!-- <p class="groupeTitle"> <?= $group->name; ?> </p> -->
                        <?php foreach (Survey::getGroupeQuestions($group->id) as $key => $question) { ?>
                            <?php $c +=1; ?>
                            <div class="tab">
                            <p class="questionTitle"> <?= $question->name ?> </p>
                            <?php if($question->type == "textarea" ) { ?>
                                <textarea name="<?= $question->id ?>" id="" rows="30" class="form-control" required></textarea> 
                            <?php }elseif($question->type == "text"){ ?>
                                <input type="text" name="<?= $question->id ?>" oninput="this.className = ''" class="form-control" required>
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
                                    <?php if(($key+1) % 4 == 0 ) { ?>
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
                                <p class="mb-0"> <input type="<?= $question->type ?>" name="<?= $question->id."[]" ?>" class="check-radio" value="<?= $choice->id ?>" id="answer-<?= $choice->id ?>" > <label for="answer-<?= $choice->id ?>"> <?= $choice->name ?> </label> </p>
                                <?php } ?>
                            <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" class="btn btn-default" id="prevBtn" onclick="nextPrev(-1)">Précedent</button>
                        <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
                    </div>
                </div>
                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <?php for($i = 0; $i< $c; $i++){ ?>
                        <span class="step"></span>
                    <?php } ?>
                </div>
            <?php } ?>
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
      } else {
        document.getElementById("nextBtn").innerHTML = "Suivant";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
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
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid form-control ";
          // and set the current valid status to false
          valid = false;
        }
      }
      var chx = document.getElementsByClassName('check-radio');
      for (var i=0; i<chx.length; i++) {
        // If you have more than one radio group, also check the name attribute
        // for the one you want as in && chx[i].name == 'choose'
        // Return true from the function on first match of a checked item
        if (chx[i].type == 'radio' && chx[i].checked) {
          valid = false;
        }
        if (chx[i].type == 'checkbox' && chx[i].checked) {
          valid = false;
        } 
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }

</script>