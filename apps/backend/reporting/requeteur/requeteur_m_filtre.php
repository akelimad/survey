



<table width="100%">

<tr colspan="2">

<div class="subscription" style="width:100%; margin: 10px 0pt;">

<h1>Choix de requête :</h1>

</div>

</tr>

<tr>

<td align="right">

<b>Requête pour  :<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

</td>

<td> 

<select name="c" id="c"  style="width: 300px;" onchange="this.form.submit()"

                                        title="Veuillez selectionnez un type" required/>

<option value="" ></option>  

<?php

$select_status_r = mysql_query("SELECT ref_statut , statut 

    FROM `prm_statut_candidature` 

    WHERE statut IN (SELECT status FROM historique) 

    ORDER BY id_prm_statut_c  ASC" );

 while($status_ref_r = mysql_fetch_array($select_status_r))

 { 

$ref_statut = $status_ref_r['ref_statut'];

$statut = $status_ref_r['statut']; 

?>

<option value="<?php echo $statut; ?>" 

<?php if (isset($_SESSION["i_val_requet"]) and  $_SESSION["i_val_requet"] == $statut) 

echo ' selected="selected"'; ?>>

<?php echo $statut; ?></option>

<?php

 }

 ?>

</select>

</td>

                            </tr>

                            

<?php if($_SESSION["i_val_requet"]!="" ){  ?>                  

                            <tr>

                                    <td colspan="2"><div class="ligneBleu"></div></td>

                            </tr>

                            <tr>

                                <td colspan="2">

                                    <h2><strong>Critère de filtrage :</strong></h2>

                                     <br>

                                </td>

                            </tr>

                            

                            <tr>

                                <td align="right">

                                    <b>Crée entre le :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

                                </td>

                                

                                <td>

                                    <input id="dd" type="date" name="dd" value="" maxlength="80" style="/*width:450px*/"   />

                                </td>

                            </tr>

                            

                            <tr>

                                <td align="right">

                                    <b>et le :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

                                </td>

                                

                                <td>

                                    <input id="df" type="date" name="df" value="" maxlength="80" style="/*width:450px*/"   />

                                </td>

                            </tr>

                            

                            <tr>

                                <td align="right">

                                    <b>Choisissez une offre  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

                                </td>

                                

                                <td>

                            

<select name="co" id="co" style="width: 300px;" onchange="this.form.submit()">

<option value="" ></option>  

<?php 

$req_theme = mysql_query( "SELECT DISTINCT o.Name,o.id_offre,o.reference 

    FROM offre o where o.id_offre in (select id_offre from candidature )

    ".$q_offre_fili_and." 

    ORDER by reference ASC");

 

while ( $data = mysql_fetch_array( $req_theme ) ) {       

$id_offre = $data['id_offre'];

$ref = $data['reference'];

$name = $data['Name'];  /*  */

?>

<option value="<?php echo $id_offre; ?>" <?php if (isset( $_SESSION["i_co"]) and  $_SESSION["i_co"] == $id_offre) echo ' selected="selected"'; ?>>

<?php echo "<b>".$ref."</b> || ".$name; ?></option>

<?php 

                                                        //echo '<option value="'.$id_offre.'" '.$selected.' >'.$name.'</option>';                 

}?>  

                                        </select> 

                                </td>

                            </tr>

                                                        

                            

                            

                            <tr>

                                <td></td>

                                <td>

                            <input type="submit" class="espace_candidat" 

                            id="valider" type="submit" name="valider" value="valider" />

                            <input type="submit" class="espace_candidat" name="actualiser" 

                            OnClick="javascript:window.location.reload()" value="Actualiser "> 

                                </td>

                            </tr>

                            

                                                    

                            <tr>

                                    <td colspan="2"><div class="ligneBleu"></div>

                                      <b><span style="color:red">P.S: les champs marqués par (*) sont obligatoires</span></b>   </td>

                            </tr>

                               <?php   }  ?>   

                        </table>  

                        

