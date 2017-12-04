

                        <div style="float:left; ">



                            <table>



                            



                                  <!-- Formation: -->



                               



                                <tr>



                                    <td ><label>&Eacute;cole ou &eacute;tablissement </label>



                                    </td><td>



                                    <select name="etablissement" id="etablissement" style="font-size:12px;width: 214px;" >



                                    <option value="" ></option>



                                    <?php



                                    $select_pays = mysql_query("select distinct prm_ecoles.id_pays,prm_pays.pays as nom_pays from prm_ecoles 

                                        inner join prm_pays on prm_pays.id_pays=prm_ecoles.id_pays ");



                                    while($pays = mysql_fetch_array($select_pays))



                                    {



                                        echo "<optgroup label='".$pays['nom_pays']."'>";



                                    $select_ecole=mysql_query('select * from prm_ecoles where id_pays='.$pays['id_pays']);



                                    while ($ecole = mysql_fetch_array($select_ecole)) {



                                        echo "<option value='" . $ecole['id_ecole'] . "' >" . $ecole['nom_ecole'] . "</option>";



                                    }



                                    echo " </optgroup>";



                                    }



                                    ?>



                                    </select>



                                    </td>



                                </tr>

 



                                <tr>



                                    <td >



                                        <div id="div_etablissement"  >



                                        <label>Nom École ou établissement </label></div>



                                    </td><td>



                                        <div id="div_etablissement1"   >



                                        <input id="nom_etablissement" type="text" name="nom_etablissement" style="font-size:12px;width:215px;" 

                                        value="" /></div>



                                    </td>



                                </tr>

								

                                <tr>



                                    <td ><label>Nombre d’année de formation </label>



                                    </td><td>







										  <select name="nivformation" style="font-size:12px;width: 214px;">







											<option value="" ></option>



									 <?php



										$req_nf = mysql_query( "SELECT * FROM prm_niv_formation");



											while ( $nf = mysql_fetch_array( $req_nf ) ) {



												$nf_id = $nf['id_nfor'];



												$nf_desc = $nf['formation'];



												



												



												echo "<option value=\"$nf_id\"  >$nf_desc</option>";



											}



									?> 







										  </select>  



                                    </td>



                                </tr>

								

                                <tr>



                                    <td > <br/>

                                    <label>Date de d&eacute;but </label>

                                    </td>



                                    <td> 

                                    <input id="calendar_dbf" style="font-size:12px;width:215px;"  name="date_debut_formation" value="" />

                                      </td>



                                </tr>

                                <tr>



                                    <td ><br/>

										<label>Date de fin </label>

                                      </td>



                                    <td>  

									<input id="calendar_ff" style="font-size:12px;width:215px;"  name="date_fin_formation" value="" /> 

                                    </td>



                                </tr>

								

								<tr>



                                    <td >



                                    </td><td>



                                    </td>



                                </tr>



                                <tr>



                                    <td ><br/><label>Diplôme </label>



                                    </td><td>



                                    <input id="diplome" type="text" name="diplome" style="font-size:12px;width:215px;" value="" />



                                    </td>



                                </tr>











                                </tr>



                                <tr>



                                <td colspan="2"><label>Description de la formation </label> <br />



                                <textarea name="description_formation" rows="3" style="width:435px" id="description_formation"></textarea>                          



                                <script type="text/javascript">



                                                    CKEDITOR.replace( 'description_formation',



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

<td colspan="4"><div class="subscription" style="margin: 10px 0pt;width: 720px;">

<h1> Formation </h1>

</div>

</td>

</tr>

<tr>

<td id="erreurs_formation" colspan="4">



<table  border="0">

<tr height="20px">

<td colspan="4">

<b><u>Dérniere Formation </u></b>

</td>

</tr>

<tr>

<td><label>&Eacute;cole ou &eacute;tablissement </label> 

<span style="color:red;">*</span><br />

<select id="etablissement" name="etablissement" title="Veuillez selectionez école ou établissement" style="font-size:12px;width: 174px;" required/>

<option value="" selected="selected"></option>

<?php

$select_pays = mysql_query("select distinct prm_ecoles.id_pays,prm_pays.pays as nom_pays from prm_ecoles inner join prm_pays on prm_pays.id_pays=prm_ecoles.id_pays ");



while($pays = mysql_fetch_array($select_pays))

{



    echo "<optgroup label='".$pays['nom_pays']."'>";

$select_ecole=mysql_query('select * from prm_ecoles where id_pays='.$pays['id_pays']);



while ($ecole = mysql_fetch_array($select_ecole))  {



  if (isset($etablissement) and $ecole['id_ecole'] == $etablissement)

    $selected = "selected";

  else

    $selected = "";

    

    echo "<option value='" . $ecole['id_ecole'] . "' " . $selected . ">" . $ecole['nom_ecole'] . "</option>";

}



echo " </optgroup>";



}



?>

</select>

</td>



<td>



<div id="div_etablissement" class="show_autre" style="display:none">

<label>Nom &Eacute;cole ou &eacute;tablissement  </label>

<span style="color:red;">*</span><br />

<input id="nom_etablissement" type="text" placeholder="Nom de l'école ou établissement" 

title="Veuillez selectionez votre nom de l'école ou établissement" name="nom_etablissement" style="width:170px;" 

value="<?php if(isset($nom_etablissement)){echo $nom_etablissement;}?>" maxlength="100" />

</div>

</td>



              <td><label>Nombre d’année de formation </label>



                <font style="color:red;">*</font> <br />



                <select id="nivformation" name="nivformation" title="Veuillez selectionez votre nombre d'année de formation"

                style="font-size:12px;width: 174px;" required/>

          <option value=""></option>



                  <?php     $req_niv_formation = mysql_query( "SELECT * FROM prm_niv_formation");       

          while ( $niv_formation = mysql_fetch_array( $req_niv_formation ) ) {          

          $formation_id = $niv_formation['id_nfor'];          

          $formation_desc = $niv_formation['formation'];          

            if(isset($nivformation) and $nivformation==$formation_id )          {         

            echo '<option value="'.$formation_id.'" selected="selected">'.$formation_desc.'</option>';          }         

            else          {         

            echo '<option value="'.$formation_id.'">'.$formation_desc.'</option>';          

            }                       

          }   ?>





                </select></td>







        

</tr>



<tr>

<td><label>Date de début </label>

<span style="color:red;">*</span><br />

<input  placeholder="  01/01/2010  "  id="calendar_dbf"  title="Veuillez selectionez la date de début" 

style="width:170px;"  name="date_debut_formation" value="<?php if(isset($dd_formation)){echo $dd_formation;}?>" required/>

</td>

<td ><label>Date de fin </label>

<span style="color:red;">*</span><br />

<input  placeholder="  01/01/2010  "  id="calendar_ff"  title="Veuillez selectionez la date de fin" 

style="width:170px;"  name="date_fin_formation" value="<?php if(isset($df_formation)){echo $df_formation;}?>" required/>

</td>

<td colspan="2"><label>Diplôme </label>

<span style="color:red;">*</span><br />

<input  id="diplome" type="text" name="diplome" placeholder="titre de diplome" title="Veuillez entrer le titre de diplome"

style="width:170px;" value="<?php if(isset($diplome)){echo $diplome;}?>" maxlength="100" required/>

</td>

</tr>



<tr>

<td colspan="4"><label>Description de la formation</label>

 <br />

<textarea  name="description_formation" rows="5" placeholder="Description de la formation" title="Veuillez entrer la description de la formation"

style="width:500px" id="description_formation" /><?php if(isset($desc_form)){echo stripslashes(htmlentities($desc_form));}?></textarea>

</td>

</tr>



</table>

</table>





  <script src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>

  

-->