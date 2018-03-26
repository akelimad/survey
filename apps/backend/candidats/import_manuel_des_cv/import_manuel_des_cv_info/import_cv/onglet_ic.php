



                        <div style="float:left; ">



                        <table>



                            <tr>    



                                <td width="40%">



                                <label>Nom du CV   </label>  



                                </td><td> 



                                <?php echo $_SESSION['f_name0']; ?><br>



                                </td>



                            </tr>

							

							<!--

                            <tr>    



                                <td colspan="2">



                                <label>Choisir un CV   </label> <font style="color:red;">*</font>



                                 



                                <input type="file" name="upload1[]" size="30" class="cvs" value=""/>



                                </td>



                            </tr>

							-->



                            <tr><td> <br><br>  </td></tr>





                            <!--

							<tr> 

								<td>

						

										<p><strong>Écrivez le mot suivant </strong><span style="color:red;">*</span></p>





										 <img src="<?php echo $urlcandidat; ?>/captcha/captcha.php" id="captcha" /><br/>





										<! -- CHANGE TEXT LINK -- >

										<a href="javascript:void(0)" onclick="

											document.getElementById('captcha').src='<?php echo $urlcandidat; ?>/captcha/captcha.php?'+Math.random();

											document.getElementById('captcha-form').focus();"

											id="change-image">Illisible? Changer le texte.</a><br/><br/>

 	   

								</td>

								<td>

										<input type="text" name="captcha" id="captcha-form" autocomplete="off"   required/><br/>

										   

								</td>

		 

							</tr>  

						-->

                            <tr><td> <br>  </td></tr>

						



                            <tr>



                                <td colspan="2"><input name="send_conditions" type="checkbox" value="true" style="width:20px;border:none;display:none" checked    />



                                <!--



                                J'accepte <a target="_blank" id="PrivacyLink" href='<?php echo $urlinfos; ?>/conditions.php'> les Conditions d'utilisation et les Règles de confidentialité </a> du site.



                                -->



                                </td>



                            </tr>



                        </table>



                        </div>



                        

						

						

						

						

						

						



















































<!--

<tr>

       <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

      <h1>Joindre la photo</h1>

    </div></td>

     </tr>



     <tr>

       <td><label>Photo</label><br />

       <input type="file" title=" Veuillez joindre la photo " name="photo" id="photo" style="width: 250px;" />

        

       </td>

       <td colspan="2"> 

       </td>

       <td></td>

     </tr> 

          



            <tr>



              <td colspan="3"><input style="width:30px;display:none;" type="checkbox" name="nl_emploi" value="true" 

              <?php if(isset($nl_emploi) and $nl_emploi=="true") echo "checked" ;?>/></td>



              



            </tr>

<tr>

     <td colspan="4"><div class="subscription" id="lettre_cvs" style="margin: 10px 0pt;">

<h1>Les CVs et les lettres de motivation</h1>

       </div></td>

   </tr>

          <tr>  

          <td style="vertical-align:top;">

          <label>CVs </label> <font style="color:red;">*</font>

         

        <a href="javascript:void(0)" class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>



     <em><span></span>  Vous pouvez joindre votre CV Word ou PDF, la taille de chaque cv ne doit pas dépassé 400 ko</em>



 </a><br/>  



      

       <input type="file"  id="cv" name="cv" size="30" class="cvs" style="width: 250px;" required/><br>

   </td>

       

   

  

  

        

        

         

      <td style="vertical-align:top;">

<label>Lettre de motivation</label> 

        <a href="javascript:void(0)" class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>

<br/>

     <em><span></span>  Vous pouvez joindre votre lettres de motivation Word ou PDF, la taille de chaque lettre ne doit pas dépassé 400 ko</em>



 </a> 

      

         

  

  <input type="file"  id="lm" name="lm" size="30" class="cvs" style="width: 250px;"/><br>

        

        </td>

     

  

  </tr>

  

  -->