

<table>

<?php include ("langue.php");?>   

<?php include ("photo_cv.php");?>  



  <tr>

       <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

      <h4></h4>

    </div></td>

     </tr>

      <tr>

                <td colspan="3">

        

<p><strong>Entrer les caractères générés par l'image : </strong><span style="color:red;">*</span></p>





 <img src="<?php echo $jsurl;?>/captcha/captcha.php" id="captcha" /><br/>





<!-- CHANGE TEXT LINK -->

<a href="#" onclick="

    document.getElementById('captcha').src='<?php echo $jsurl; ?>/captcha/captcha.php?'+Math.random();

    document.getElementById('captcha-form').focus();"

    id="change-image">Illisible? Changer le texte.</a><br/><br/>





<input type="text" name="captcha" id="captcha-form" autocomplete="off"  title="Entrer les caractères générés par l'image "  required/><br/>

 

  

        </td>

            </tr>  



      <tr>

                <td colspan="3"><div class="ligneBleu" style=" width: 720px; "></div>

        <input id="send_conditions" name="send_conditions" type="checkbox" title="J'accepte" value="true" style="width:20px;border:none" <?php if ($send_conditions == 'true') echo 'checked'; ?>   required/>

        <font style="color:red;">*</font>

        J'accepte 

        <a target="_blank" id="PrivacyLink"  href="javascript:showDiv0()" > 

        les conditions d'utilisation et les règles de confidentialité  

        </a>

        du site.</td>

            </tr>





<tr>

<td colspan='3' valign="top">

  <br/><div class="ligneBleu" style=" width: 720px; "></div>

 

<input  class="espace_candidat" name="envoi" type="submit" 

                  value="Valider" style="width:170px"  onclick="valider()" />

          

</td>

</tr>

</table>