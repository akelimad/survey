<div class="subscription" style="margin: 10px 0pt;">
<h1>Action sur l’étape de billet  : </h1>
</div>
<div style="width:100%; display:inline-table;">

<div style="width:33%; display:inline-table;margin: 5px;">
<b>Changer de l’étape de billet :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
</div>

<div style="width:33%; display:inline-table;margin: 5px;">
<select name="c" id="c"  style="width: 300px;" > 
<option></option> 
<option value="1" <?php if(isset($_POST['c']) and $_POST['c']=='1') echo ' selected="selected"'; ?>>En traitement</option>
<?php if($return0['etape'] !='0') { ?>
<option value="2" <?php if(isset($_POST['c']) and $_POST['c']=='2') echo ' selected="selected"'; ?>>Fermer</option>
<?php } ?>
</select>
</div>

</div>

<div style="width:100%; display:inline-table;">
<div style="width:33%; display:inline-table;margin: 5px;">
<b>Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><span style="color:red">*</span>
</div>
<div style="width:33%; display:inline-table;margin: 5px;">
<input id="titre" type="text" name="titre" value="" maxlength="80" style=" width:298px "   required/>
</div>
</div>
<div style="width:100%; display:inline-table;">
<div style="width:33%; display:inline-table;margin: 5px;">
<b>Pourcentage :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><span style="color:red">*</span>
</div>
<div style="width:33%; display:inline-table;margin: 5px;">
<input id="titre" type="number" min="0" max="100" name="pour" value="" maxlength="80" style=" width:298px "   required/>
</div>
</div>
<div style="width:100%; display:inline-table; ">
<div style="width:33%; display:inline-table;margin: 5px; ">
<b>Message :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><span style="color:red">*</span>
</div>
<div style="width:33%; display:inline-table;margin: 5px; ">
<textarea id="msg"  name="msg" value="" maxlength="80" style=" width:298px;resize: none;height: 100px;"   required/></textarea>
</div>
</div>

<div style="width:100%; display:inline-table;margin: 0px 250px;">
<input id="valider" type="submit" name="Valider" value="Valider"  class="espace_candidat" />
</div>