<tr>
<td colspan="4">
<div class="subscription" style="margin: 10px 0pt;">
        <h1>Langues </h1>
</div>
</td>
</tr>
<tr>
<td colspan="4">
      
<table width="100%">
        <tr>
          <td>
             <ul>
      <li style="list-style-type: none;" ><label>Arabe </label> </li>
      <li style="list-style-type: none;" >
      <select  id="ar" name="ar" title=" Veuillez selectionnez Votre niveau " style="width:120px">
        <option value=""></option>
        <option value="Maîtrisé" <?php if (isset($arabic) and $arabic == 'Maîtrisé') echo 'selected'; ?>>Maîtrisé</option>
        <option value="Courant" <?php if (isset($arabic) and $arabic == 'Courant') echo 'selected'; ?>>Courant</option>
        <option value="Basique" <?php if (isset($arabic) and $arabic == 'Basique') echo 'selected'; ?>>Basique</option>
        <option value="Néant" <?php if (isset($arabic) and $arabic == 'Néant') echo 'selected'; ?>>Néant</option>
      </select>
      </li>

      </ul>
          </td>
          <td>
            <ul >

      <li style="list-style-type: none;" ><label>Fran&ccedil;ais </label>  </li>
      <li style="list-style-type: none;" >
      <select  id="fr" name="fr" title=" Veuillez selectionnez Votre niveau " style="width:120px">
        <option value=""></option>
        <option value="Maîtrisé" <?php if (isset($french) and $french == 'Maîtrisé') echo 'selected'; ?>>Maîtrisé</option>
        <option value="Courant" <?php if (isset($french) and $french == 'Courant') echo 'selected'; ?>>Courant</option>
        <option value="Basique" <?php if (isset($french) and $french == 'Basique') echo 'selected'; ?>>Basique</option>
        <option value="Néant" <?php if (isset($french) and $french == 'Néant') echo 'selected'; ?>>Néant</option>
      </select></li>

      </ul>
          </td>
          <td>
            <ul >

      <li style="list-style-type: none;" ><label>Anglais </label> </li>
      <li style="list-style-type: none;" >
      <select  id="en" name="en" title=" Veuillez selectionnez Votre niveau " style="width:120px">
        <option value=""></option>
        <option value="Maîtrisé" <?php if (isset($english) and $english == 'Maîtrisé') echo 'selected'; ?>>Maîtrisé</option>
        <option value="Courant" <?php if (isset($english) and $english == 'Courant') echo 'selected'; ?>>Courant</option>
        <option value="Basique" <?php if (isset($english) and $english == 'Basique') echo 'selected'; ?>>Basique</option>
        <option value="Néant" <?php if (isset($english) and $english == 'Néant') echo 'selected'; ?>>Néant</option>
      </select></li>

      </ul>
          </td>
        </tr>
  
     <tr>
       <td>
           <ul>

      <li style="list-style-type: none;" ><label>Autres 1 : </label> <a href="javascript:void(0)" class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>        <em><span></span>  Veuillez entrer une langue avant de préciser le niveau de maîtrise </em> </a></li>
      <li style="list-style-type: none;" >
      <input id="autre" name="autre" type="text" value="<?php if (isset($autre))  echo $autre; ?>" style="width: 115px;" maxlength="100"/>
        </li>
      <li style="list-style-type: none;" class='odd'>
      <select id="autre_n" name="autre_n" title=" Veuillez selectionnez Votre niveau " style="width:120px" >   <!--   disabled="disabled">  --> 
         <option value=""></option>
        <option value="Maîtrisé" <?php if (isset($autre_n) and $autre_n == 'Maîtrisé') echo 'selected'; ?>>Maîtrisé</option>
        <option value="Courant" <?php if (isset($autre_n) and $autre_n == 'Courant') echo 'selected'; ?>>Courant</option>
        <option value="Basique" <?php if (isset($autre_n) and $autre_n == 'Basique') echo 'selected'; ?>>Basique</option>
        <option value="Néant" <?php if (isset($autre_n) and $autre_n == 'Néant') echo 'selected'; ?>>Néant</option>
          </select></li>
      </ul>
       </td>
       <td>
         <ul>

      <li style="list-style-type: none;" ><label>Autres 2 : </label>  <a href="javascript:void(0)" class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>        <em><span></span>  Veuillez entrer une langue avant de préciser le niveau de maîtrise </em> </a></li>
      <li style="list-style-type: none;" >
      <input id="autre1" name="autre1" type="text" value="<?php if (isset($autre1))  echo $autre1; ?>" style="width: 115px;" maxlength="100"/>
       </li>
      <li style="list-style-type: none;" class='odd'>
      <select id="autre1_n" name="autre1_n" title=" Veuillez selectionnez Votre niveau " style="width:120px" >   <!--   disabled="disabled">  --> 
         <option value=""></option>
        <option value="Maîtrisé" <?php if (isset($autre1_n) and $autre1_n == 'Maîtrisé') echo 'selected'; ?>>Maîtrisé</option>
        <option value="Courant" <?php if (isset($autre1_n) and $autre1_n == 'Courant') echo 'selected'; ?>>Courant</option>
        <option value="Basique" <?php if (isset($autre1_n) and $autre1_n == 'Basique') echo 'selected'; ?>>Basique</option>
        <option value="Néant" <?php if (isset($autre1_n) and $autre1_n == 'Néant') echo 'selected'; ?>>Néant</option>
          </select></li>
      </ul>  
       </td>
       <td>
          <ul>

      <li style="list-style-type: none;" ><label>Autres 3 : </label> <a href="javascript:void(0)" class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>        <em><span></span>  Veuillez entrer une langue avant de préciser le niveau de maîtrise </em> </a></li>
      <li style="list-style-type: none;" >
      <input id="autre2" name="autre2" type="text" value="<?php if (isset($autre2))  echo $autre2; ?>" style="width: 115px;" maxlength="100" />
        </li>
      <li style="list-style-type: none;" >
      <select id="autre2_n" name="autre2_n" title=" Veuillez selectionnez Votre niveau " style="width:120px" >    <!--   disabled="disabled">  -->
         <option value=""></option>
        <option value="Maîtrisé" <?php if (isset($autre2_n) and $autre2_n == 'Maîtrisé') echo 'selected'; ?>>Maîtrisé</option>
        <option value="Courant" <?php if (isset($autre2_n) and $autre2_n == 'Courant') echo 'selected'; ?>>Courant</option>
        <option value="Basique" <?php if (isset($autre2_n) and $autre2_n == 'Basique') echo 'selected'; ?>>Basique</option>
        <option value="Néant" <?php if (isset($autre2_n) and $autre2_n == 'Néant') echo 'selected'; ?>>Néant</option>
          </select></li>
      </ul>
       </td>
     </tr>
   </table>
 
      </td>
      </tr>