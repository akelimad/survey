    <div class='texte'>

<?php 

        if (isset($_GET['cpcha']) and $_GET['cpcha']==0 )  {

        foreach ($messages as $messageemail) ?>

            <div class="alert alert-error">

                <?php { echo $messageemail; }?>

            </div>

        <?php } ?>

        <h1>NOUS CONTACTER</h1>



        <p>Vos questions, commentaires et suggestions sont les bienvenues ! </p>

 

        <table width="354" border="0" cellpadding="0" cellspacing="0">



            <tr>



<td width="303" ><p> 



           <strong>Courriel : </strong>

           

               <a href="mailto:<?php echo $info_contact; ?>/" class="contentsans"><?php echo $info_contact; ?></a> </p></td>



               </tr>



               </table>



               <p><b><u>Formulaire électronique</u></b></p>



               <form name="contact_us" id="form_contact" data-toggle="validate" method="post" action="./contact_form/" >



   <table cellspacing="0" width="90%">



       <tbody>

          <?php $showDestinations = (get_setting('show_contact_destination') == 1); ?>

           <tr style="display:<?= ($showDestinations) ? 'block' : 'none' ?>">



               <td width="240"><p>A <span style="color:red;">*</span> : </td>



               <td><p style="line-height: 100%"> </td>



               <td><p style="line-height: 100%">



       <select name="destination" id="destination" style="width: 354px;" required>



           <option selected="selected" value="">   [Sélectionner]</option>



                <?php           $req_ci = mysql_query( "SELECT * FROM prm_destination");                

                  while ( $ci = mysql_fetch_array( $req_ci ) ) {                    

                  $ci_id = $ci['id_destination'];                 $ci_desc = $ci['titre'];                  

                      if(isset($destination) and $destination==$ci_desc){                   
                      echo '<option value="'.$ci_desc.'" selected="selected">'.$ci_desc.'</option>';

                      }     else    {                   
                        $selected = (!$showDestinations && $ci_desc=='DIRECTION DES RESSOURCES HUMAINES') ? 'selected' : '';
                      echo '<option value="'.$ci_desc.'" '.$selected.'>'.$ci_desc.'</option>';                    

                      }

                  }     

                  ?>



       </select>



               </td>



           </tr>


           <tr>



               <td height=5></td>



           </tr>



           <tr>



               <td width="240"><p style="line-height: 100%">Nom de famille <span style="color:red;">*</span> : </td>



               <td><p style="line-height: 100%"> </td>



               <td><p style="line-height: 100%">



       <input name="user_last_name" id="user_last_name"  style="width: 350px;" placeholder="Nom" type="text" maxlength="50"   required/>



           </td>



           </tr>



           <tr>



               <td height=5></td>



           </tr>



           <tr>



               <td width="240"><p style="line-height: 100%" for="user_first_name">Prénom <span style="color:red;">*</span> : </td>



               <td><p style="line-height: 100%"> </td>



               <td><p style="line-height: 100%">



  <input type="text" name="user_first_name" id="user_first_name"  style="width: 350px;" placeholder="Prénom" required/>



      </td>



      </tr>



      <tr>



          <td height=5></td>



      </tr>



      <tr>



          <td width="240"><p style="line-height: 100%">Courriel <span style="color:red;">*</span> : </td>



          <td><p style="line-height: 100%"> </td>



          <td><p style="line-height: 100%">



  <input name="user_email" id="user_email"  style="width: 350px;" type="email"  placeholder="me@example.com" maxlength="50"  required>



      </td>



      </tr>



      <tr>



          <td height=5></td>



      </tr>



      <tr>



          <td width="240"><p for="subject" style="line-height: 100%">Sujet <span style="color:red;">*</span> : </p></td>



          <td><p style="line-height: 100%"> </td>



          <td><p style="line-height: 100%">



  <input name="subject" id="subject"  style="width: 350px;" type="text" placeholder="Sujet" maxlength="50"   required>



      </td>



      </tr>



      <tr>



          <td height=5></td>



      </tr>



      <tr>



          <td style="padding-top: 6px;" valign="top" width="240"><p style="line-height: 100%">Message <span style="color:red;">*</span> : </td>



          <td style="padding-top: 6px;" valign="top"><p style="line-height: 100%"> </td>



          <td><p style="line-height: 100%">



  <textarea name="msg" id="msg" style="width: 350px; height: 132px;" placeholder="Message" required></textarea>



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

		<a href="javascript:void(0)" onclick="

			document.getElementById('captcha').src='<?php echo $jsurl; ?>/captcha/captcha.php?'+Math.random();

			document.getElementById('captcha-form').focus();"

			id="change-image">Illisible? Changer le texte.</a><br/><br/>





		<input type="text" name="captcha" id="captcha-form" autocomplete="off"  title="Entrer les caractères générés par l'image "  required /><br/>

		

	 </p>

     </td>

 </tr>

			   



  



 </tbody>



 </table>

<div class="ligneBleu"></div>

<input class="espace_candidat" name="Submit" type="submit" style="margin-top: 8px;" value="Envoyer"  >

<input class="espace_candidat" name="button" type="reset" style="margin-top: 8px;box-shadow: none;" value="réinitialiser">

 </form>



 </div>