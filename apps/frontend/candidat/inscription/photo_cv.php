<?php      include ( "traitment.php");        ?>

<tr>

       <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

      <h1>Joindre la photo</h1>

    </div></td>

     </tr>



     <tr>

       <td><label>Photo</label>

         

        <a  href="#"  class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>



     <em><span></span>  Vous pouvez joindre votre Photo, la taille de chaque Photo ne doit pas dépassé 400 ko</em>



 </a><br />

      <input type="file" class="upload-file" data-max-size="450000" title=" Veuillez joindre la photo " name="photo" id="photo" style="width: 250px;"  

       accept=".gif,.jpeg,.jpg,.png" required/>



        <label  generated="true" class="error" id="error" style="display: none;">la taille ne doit pas dépasser 400 ko.</label>

        

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

         

        <a  href="#"  class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>



     <em><span></span>  Vous pouvez joindre votre CV Word ou PDF, la taille de chaque cv ne doit pas dépassé 400 ko</em>



 </a><br/>  



      

        <input type="file" class="upload-file0" data-max-size="450000" id="cv" name="cv" size="30" class="cvs" 

       title="Vous pouvez joindre votre CV " 

       style="width: 250px;" required  accept=".doc,.docx,.pdf" /><br>

        <label generated="true" class="error"  id="error0" style="display: none;">la taille ne doit pas dépasser 400 ko.</label>   

   </td>

       

   

  

  

        

        

         

      <td style="vertical-align:top;">

<label>Lettre de motivation</label> 

        <a  href="#"  class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>

<br/>

     <em><span></span>  Vous pouvez joindre votre lettres de motivation Word ou PDF, la taille de chaque lettre ne doit pas dépassé 400 ko</em>



 </a> 

      

         

  

  <input type="file" class="upload-file1" data-max-size="450000" id="lm" name="lm" size="30" class="cvs" style="width: 250px;" accept=".doc,.docx,.pdf" /><br>

         <label generated="true" class="error"  id="error1" style="display: none;">la taille ne doit pas dépasser 400 ko.</label>   

        

        </td>

     

  

  </tr>