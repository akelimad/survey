<div class='texte'>
<?php 
        if (isset($_GET['cpcha']) and $_GET['cpcha']==0 )  {
        foreach ($messages as $messageemail) ?>
            <div class="alert alert-error">
                <?php { echo $messageemail; }?>
            </div>
        <?php } ?>
        <h1>SIGNALER UN PROBLEME</h1> 
        <table width="90%" border="0" cellpadding="0" cellspacing="0">
            <tr>

<td width="303" ><p>
<strong>Formulaire électronique</strong></p></td>
<td align="right"><p>N ° billet :  <strong style="color:red;"><?php echo $code_ticket; ?></strong></p></td>
               </tr>
            <tr>

    </table>
<form name="contact_us" id="form_contact" method="post" action="probleme_form/" onsubmit="return validateBeforeSubmit()"  enctype="multipart/form-data">
<input name="ticket" id="ticket" value="<?php echo $code_ticket; ?>"   type="hidden" />
    
<table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody>

  <table cellspacing="0" width="90%">          
<tr>
    <td width="240"><p style="line-height: 100%">Nom de famille <span style="color:red;">*</span> : </td>
    <td><p style="line-height: 100%"> </td>
    <td><p style="line-height: 100%">
            <input name="user_last_name" id="user_last_name" value="" placeholder="Nom"
            style="width: 350px;" type="text" maxlength="50" required  >
</td>
</tr>
<tr>
    <td height=5></td>
</tr>
<tr>
    <td width="240"><p style="line-height: 100%">Prénom <span style="color:red;">*</span> : </td>
    <td><p style="line-height: 100%"> </td>
    <td><p style="line-height: 100%">
            <input name="user_first_name" id="user_first_name" value="" style="width: 350px;" placeholder="Prénom"
            type="text" maxlength="50"  required  >
</td>
</tr>
<tr>
    <td height=5></td>
</tr>
<tr>
    <td width="240"><p style="line-height: 100%">Courriel <span style="color:red;">*</span> : </td>
    <td><p style="line-height: 100%"> </td>
    <td><p style="line-height: 100%">
            <input name="user_email" id="user_email" value="" style="width: 350px;" type="email"  placeholder="me@example.com" maxlength="50"  required  />
</td>
</tr><tr>   <td width="240"><p style="line-height: 100%">Télephone <span style="color:red;">*</span> : </td>    <td><p style="line-height: 100%"> </td>    <td><p style="line-height: 100%">            <input name="tel" id="tel" value="" style="width: 350px;" type="number"  placeholder="Telephone" maxlength="10" minlength="10"  required  /></td> </tr>
<tr>
    <td height=5></td>
</tr>
<tr>
    <td width="240"><p style="line-height: 100%">Sujet <span style="color:red;">*</span> : </td>
    <td><p style="line-height: 100%"> </td>
    <td><p style="line-height: 100%">
            <input name="subject" id="subject" value="" style="width: 350px;" placeholder="sujet"
            type="text" maxlength="50"  required  >
</td>
</tr>
<tr>
    <td height=5></td>
</tr>
<tr>
    <td style="padding-top: 6px;" valign="top" width="240"><p style="line-height: 100%">Message <span style="color:red;">*</span> : </td>
    <td style="padding-top: 6px;" valign="top"><p style="line-height: 100%"> </td>
    <td><p style="line-height: 100%">
            <textarea name="msg" id="msg" style="width: 350px; height: 132px;" placeholder="Message"></textarea>
            
    </td>
</tr>
<tr>
    <td height=5></td>
</tr>
 <tr> 
	<td style="padding-top: 6px;" valign="top" width="240"> <p style="line-height: 100%">Pi&egrave;ce &agrave; joindre   </p>  </td>
	<td style="padding-top: 6px;" valign="top"><p style="line-height: 100%"> </td>
	<td><p style="line-height: 100%">  
    <label for="piecejointe" style="margin-top:8px; margin-bottom:8px;color: chocolate;">
    Seuls les fichiers (.doc, .jpg, .gif, .png ou .pdf) sont accept&eacute;s</label><br>
			   <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
			   <input type="file" name="piecejointe" id="piecejointe"> 
	 </p>
     </td>
 </tr>
			   

<tr>
    <td height=5></td>
</tr>
 <tr> 
	<td   valign="top"  > <p > Captcha  </p>  </td>
	<td    valign="top"><p  > </td>
	<td><p  >  
    
    <img src="<?php echo $jsurl; ?>/captcha/captcha.php" id="captcha"><br/>
		<!-- CHANGE TEXT LINK -->
		<a href="#" onclick="
			document.getElementById('captcha').src='<?php echo $jsurl; ?>/captcha/captcha.php?'+Math.random();
			document.getElementById('captcha-form').focus();"
			id="change-image">Illisible? Changer le texte.</a><br/><br/>


		<input type="text" name="captcha" id="captcha-form" autocomplete="off"  title="Entrer les caractères générés par l'image "  required /><br/>
		
	 </p>
     </td>
 </tr>
			   
</tbody>
</table>
<div>
<div class="ligneBleu"></div>
    <input class="espace_candidat" name="Submit" type="submit" style="margin-top: 8px;" value="Envoyer">
    <input class="espace_candidat" name="button" type="reset" style="margin-top: 8px;box-shadow:none" value="réinitialiser">
</div>
</form>
</div>