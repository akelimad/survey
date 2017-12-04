



                        <div style="float:left; ">



                            <table>



                             



                                <!-- Exp&eacute;rience professionnelle: -->



                                                            

 

 

                                <tr>



                                    <td > 

                                    <label>Date de d&eacute;but </label> 

                                    </td>



                                    <td>  

									<input id="calendar_dbex" name="date_debut"  value="" style="font-size:12px;width:215px;" />

                                      </td>



                                </tr>

                                <tr>



                                    <td >

										<label>Date de fin </label>

                                      </td>



                                    <td>   

                                    <input id="calendar_fex" name="date_fin"  value="" style="font-size:12px;width:215px;" />

                                    </td>



                                </tr>

								 

								 <tr>



                                    <td>



                                    </td><td>



                                    </td>



                                </tr>



                                <tr>



                                    <td><label>Entreprise </label> 



                                    </td><td>



                                    <input type="text" name="entreprise" id="entreprise" style="font-size:12px;width:215px;"    value="" />



                                    </td>



                                </tr>

								

								<tr>



                                    <td><label>Intitul&eacute; du Poste </label> 



                                    </td><td>



                                    <input type="text" name="poste" id="poste" style="font-size:12px;width:215px;"   value="" />



                                    </td>



                                </tr>



                                <tr>



                                    <td><label>Secteur d'activit&eacute; </label> 



                                                                         </td><td>



                                    <select name="sector" id="sector"  style="font-size:12px;width:214px;"    >



                                    <option selected="selected" value=""></option>



                                    <?php           $req_sec = mysql_query( "SELECT * FROM prm_sectors");               



                                      while ( $sec = mysql_fetch_array( $req_sec ) ) {                  



                                      $sec_id = $sec['id_sect'];                    



                                      $sec_desc = $sec['FR'];                                         



                                          echo '<option value="'.$sec_id.'">'.$sec_desc.'</option>';        



                                      }     



                                      ?>          



                                    </select>







                                    </td>



                                </tr>



                                <tr>    



                                    <td><label>Fonction  </label> 



                                                                     </td><td>



                                    <select name="fonction_exp" id="fonction_exp" style="font-size:12px;width:214px;" >



                                        <option value=""></option>



                                        <?php



                                        $req_fonc = mysql_query("SELECT * FROM prm_fonctions");



                                        while ($fonc = mysql_fetch_array($req_fonc)) {



                                            $fonc_id = $fonc['id_fonc'];



                                            $fonc_desc = $fonc['fonction'];



                                            echo "<option value='$fonc_id' >$fonc_desc</option>";



                                        }



                                        ?>



                                    </select>



                                    </td>



                                </tr>



                                <tr>    



                                    <td><label>Type de contrat  </label> 



                                                                     </td><td>



                                    <select name="type_poste" id="type_poste" style="font-size:12px;width:214px;"  >



                                        <option value=""></option>



                                        <?php



                                        $req_poste = mysql_query("SELECT * FROM prm_type_poste");



                                        while ($poste = mysql_fetch_array($req_poste)) {



                                            $poste_id = $poste['id_tpost'];



                                            $poste_desc = $poste['designation'];



                                            echo "<option value='$poste_id' >$poste_desc</option>";



                                        }



                                        ?>



                                    </select>



                                    </td>



                                </tr>



                                <tr>



                                    <td><label>Ville </label> 



                                    </td><td>



                                        <input type="text" id="ville_exp" name="ville_exp" style="font-size:12px;width:215px;"    value=""/>



                                    </td>



                                </tr><tr>   



                                    <td><label>Pays </label>



                                        </td><td>



                                        <select name="pays_exp" id="pays_exp" style="font-size:12px;width:214px;"  >



                                        <option value=""></option>



                                            <?php



                                                $req_pays = mysql_query("SELECT * FROM prm_pays ORDER BY pays Asc");



                                                while ($pays = mysql_fetch_array($req_pays)) {



                                                $pays_id = $pays['id_pays'];



                                                $pays_desc = $pays['pays'];



                                                echo "<option value='$pays_id' >$pays_desc</option>";



                                                }



                                                ?>



                                        </select>



                                    </td>



                                </tr> 

								

                                <tr>



                                    <td><label>Dernier salaire perçu </label> 



                                    </td><td>



                                    <input type="text"  id="salair_pecu" name="salair_pecu"  style="font-size:12px;width:215px;"   value="" />



                                    </td>



                                </tr>

								

                                <tr>



                                    <td colspan="2"><label>Description du poste </label> 



                                     <br>



                                    <textarea name="description_poste"  rows="3" style="width:435px" id="description_poste"></textarea>         



                                <script type="text/javascript">



                                                    CKEDITOR.replace( 'description_poste',



                                                    {



                                                    width : "450px",



                                                    height : "200px"



                                                    });



                                                    </script>



                                    </td>



                                </tr>



                                



                            



                            </table>    







                        </div>

 



































<!--

<table>

                               

<tr>

  <td colspan="4"><div class="subscription" style="margin: 10px 0pt;width: 720px; ">

      <h1> Expérience professionnelle </h1>

    </div></td>

</tr> 





<tr>

<td colspan="3"> 



<table style="width:580px;">



<tr height="20px">

<td colspan="3">

<!---- >

<div id="div1"  ><b><u>Dérniere Expérience professionnelle </u></b></div>

</td>

</tr>





<tr>

<td colspan="1">

<div id="div2"  ><label>Date de début </label>

 <br />

<input  placeholder="  01/01/2010  "  id="calendar_dbex" name="date_debut" style="width:170px;" value="<?php if(isset($dd_exp)){echo $dd_exp;}?>"/></div>

</td>

<td colspan="1">

<div id="div3"  ><label>Date de fin </label>

 <br />

<input  placeholder="  01/01/2010  "  id="calendar_fex" name="date_fin"  style="width:170px;"  value="<?php if(isset($df_exp)){echo $df_exp;}?>"/></div>

</td>

<td colspan="1">

<div id="div4"  ><label>Entreprise </label>

 <br />

<input type="text" name="entreprise" id="entreprise" style="width:170px;"  value="<?php if(isset($entreprise)){echo $entreprise;}?>" maxlength="100"/></div>

</td>



</tr>

<tr>



<td colspan="1">

<div id="div5"  ><label>Intitulé du Poste </label>

 <br />

<input type="text" name="poste" id="poste" style="width:170px;"  value="<?php if(isset($poste)){echo $poste;}?>" maxlength="100"/></div>

</td>



<td colspan="1">

<div id="div6"  ><label>Secteur d'activité </label>

  <br />

                    

<select id="sector" name="sector" style="width:175px;">

<option selected="selected" value=""></option>

  <?php $req_theme = mysql_query( "SELECT * FROM prm_sectors"); 

          while ( $data = mysql_fetch_array( $req_theme ) ) {   

          $Sector_id = $data['id_sect'];    $Sector = $data['FR'];    

          if(isset($secteur) and $secteur==$Sector_id){   echo '<option value="'.$Sector_id.'" selected="selected">'.$Sector.'</option>';   }   

          else    {   echo '<option value="'.$Sector_id.'">'.$Sector.'</option>';   } }?>

</select></div>

</td>



<td colspan="1">

<label>Fonction </label>

           <br />

          <select   id="fonction_exp" name="fonction_exp" style="width:175px;">

            <option value="" selected="selected"></option>

            <?php

            $req3_theme = mysql_query("SELECT * FROM prm_fonctions");

            while ($data3 = mysql_fetch_array($req3_theme)) {

          $fonc_id = $data3['id_fonc'];

          $fonc = $data3['fonction'];

          if (isset($fonction_exp) and $fonc_id == $fonction_exp)

            $selected = 'selected';

          else

            $selected = '';

          echo "<option value=\"$fonc_id\" " . $selected . ">$fonc</option>";

            }

            ?>

          </select> 

</td>



</tr>

<tr>



<td colspan="1">

<div id="div7"  ><label>Type de contrat </label>

  <br />

<select id="type_poste" name="type_poste" style="width:175px;">

<option value=""></option>

<?php

$req_poste = mysql_query("SELECT * FROM prm_type_poste");

while ($poste = mysql_fetch_array($req_poste)) {

  $poste_id = $poste['id_tpost'];

  $poste_desc = $poste['designation'];

  if (isset($type_poste) and $poste_id == $type_poste)

    $selected = "selected";

  else

    $selected = "";

  echo "<option value='$poste_id' " . $selected . ">$poste_desc</option>";

}

?>

</select></div>

</td>

<td colspan="1">

<div id="div8"  ><label>Ville </label><br /> 



                <select id="ville_exp" name="ville_exp"  style="width:175px;">



                  <option value=""></option>



                  <?php     $req_ville = mysql_query( "SELECT * FROM prm_villes");        

          while ( $ville1 = mysql_fetch_array( $req_ville ) ) {         

          $pays_id = $ville1['id_vill'];          $ville_desc = $ville1['ville'];         

          if(isset($ville_exp) and $ville_exp==$ville_desc)         {         

          echo '<option value="'.$ville_desc.'" selected="selected">'.$ville_desc.'</option>';          }         

          else          {         echo '<option value="'.$ville_desc.'">'.$ville_desc.'</option>';          }             }   ?>



                </select>

</div>

</td>

<td colspan="1">

<div id="div9"  ><label>Pays </label>

  <br />

<select id="pays_exp" name="pays_exp" style="width:175px;">

<option value=""></option>

<?php

$req_pays = mysql_query("SELECT * FROM prm_pays ORDER BY pays Asc");

while ($pays = mysql_fetch_array($req_pays)) {

  $pays_id = $pays['id_pays'];

  $pays_desc = $pays['pays'];

  if (isset($pays_exp) and $pays_id == $pays_exp)

    $selected = "selected";

  else

    $selected = "";

  echo "<option value='$pays_id' " . $selected . ">$pays_desc</option>";

}

?>

</select></div>

</td>

</tr>

<tr>

<td colspan="1"> <label>Dernier salaire perçu </label>

  <br />

<input type="text" id="salair_pecu" name="salair_pecu" style="width:170px;"  value="<?php if(isset($salair_pecu)){echo $salair_pecu;}?>" maxlength="100"/>

</td>

<td></td><td></td></tr>

<tr>

<td colspan="4">

<div id="div10"  ><label>Description du poste </label>

 <br />

<textarea name="description_poste" rows="5" style="width:500px" id="description_poste"><?php if(isset($desc_exp)){echo stripslashes(htmlentities($desc_exp));}?></textarea></div>

</td>

</tr>





</table>

</table>



-->