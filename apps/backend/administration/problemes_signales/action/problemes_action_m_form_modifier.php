<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
<div class="subscription" style="margin: 10px 0pt;">
<h1>Modifier la r�ponse</h1>
</div>
<input id="titre" type="hidden"  name="id_rprob"  maxlength="80" style=" width:298px "  value="<?php echo $dsii; ?>" required/>
<div style="width:100%; display:inline-table;">
<div style="width:33%; display:inline-table;margin: 5px;">
<b>Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><span style="color:red">*</span>
</div>
<div style="width:33%; display:inline-table;margin: 5px;">
<input id="titre" type="text" name="titre"  maxlength="80" style=" width:298px " value="<?php echo $titre; ?>"  required/>
</div>
</div>
<div style="width:100%; display:inline-table;">
<div style="width:33%; display:inline-table;margin: 5px;">
<b>Pourcentage :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><span style="color:red">*</span>
</div>
<div style="width:33%; display:inline-table;margin: 5px;">
<input id="titre" type="text" min="0" max="100" name="pour"  maxlength="80" style=" width:298px "  value="<?php echo $pour; ?>" required/>
</div>
</div>
<div style="width:100%; display:inline-table; ">
<div style="width:33%; display:inline-table;margin: 5px; ">
<b>Message :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><span style="color:red">*</span>
</div>
<div style="width:33%; display:inline-table;margin: 5px; ">
<textarea id="msg"  name="msg" value="" maxlength="80" style=" width:298px;resize: none;height: 100px;"   required/><?php echo $msg; ?></textarea>
</div>
</div>

<div style="width:100%; display:inline-table;margin: 0px 250px;">
<input id="valider" type="submit" name="modifier" value="modifier"  class="espace_candidat" />
</div>
</form>
