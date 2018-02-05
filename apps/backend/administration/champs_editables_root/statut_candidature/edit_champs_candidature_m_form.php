<table  width="100%"  border="0" cellspacing="2" cellpadding="2">	



	<tr>

		<td scope="col" width="30%" style="border:1px solid #FFFFFF;">

		  Réf Statut

		</td>

		<td scope="col" width="70%" style="border:1px solid #FFFFFF;">

		  

			<input required name="ref_statut"  maxlength="100" style="width: 200px;">



		</td>

    </tr>

	

    <tr> 

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;" >Ajouter un statut :  </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;" >

        <input required name="statut"  maxlength="100" style="width: 200px;">

    </td>

    </tr>

	



	

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      Réf email

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;">

      <select name="ref" class="form-control input-sm" style="width: 200px;">

<option value="">Choisir votre réf</option>

<?php

$req_secteur = mysql_query("SELECT * FROM root_email_auto");

while ($secteur = mysql_fetch_array($req_secteur)) {

$ref_id = $secteur['ref'];

$objet_desc = $secteur['objet']; 

?>

<option value="<?php echo $ref_id; ?>" 

<?php if (isset($ref_email) and $ref_email == $ref_id) echo ' selected="selected"'; ?>>

<?php echo $ref_id; ?> || <?php echo $objet_desc; ?></option>

<?php

}

?>



<option value="">Ne pas envoyer de mail</option>



</select>



    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      Selectionnez popup

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;">

		<select name="etat_1" class="form-control input-sm" style="width: 200px;">

            <option value="0">Choisir un état</option>

            <option value="1">Actif</option>

            <option value="2">Inactif</option> 

        </select>

        <input name="popup_1" type="checkbox" value="1" style="width: 20px;height: 17px;" required>  Accueil

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		<select name="etat_2" class="form-control input-sm" style="width: 200px;">

            <option value="0">Choisir un état</option>

            <option value="1">Actif</option>

            <option value="2">Inactif</option>

        </select>

        <input name="popup_2" type="checkbox" value="2" style="width: 20px;height: 17px;" required>  N.Candidature

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		<select name="etat_3" class="form-control input-sm" style="width: 200px;">

            <option value="0">Choisir un état</option>

            <option value="1">Actif</option>

            <option value="2">Inactif</option>

        </select>

        <input name="popup_3" type="checkbox" value="3" style="width: 20px;height: 17px;" required>  C.En cours

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		<select name="etat_4" class="form-control input-sm" style="width: 200px;">

            <option value="0">Choisir un état</option>

            <option value="1">Actif</option>

            <option value="2">Inactif</option>

        </select>

        <input name="popup_4" type="checkbox" value="4" style="width: 20px;height: 17px;" required>  C.Retenu 

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		<select name="etat_5" class="form-control input-sm" style="width: 200px;">

            <option value="0">Choisir un état</option>

            <option value="1">Actif</option>

            <option value="2">Inactif</option>

        </select>

        <input name="popup_5" type="checkbox" value="5" style="width: 20px;height: 17px;" required>  C.Recruter

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		<select name="etat_6" class="form-control input-sm" style="width: 200px;">

            <option value="0">Choisir un état</option>

            <option value="1">Actif</option>

            <option value="2">Inactif</option>

        </select>

        <input name="popup_6" type="checkbox" value="6" style="width: 20px;height: 17px;" required>  C.Non retenu 

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

		<select name="etat_7" class="form-control input-sm" style="width: 200px;">

            <option value="0">Choisir un état</option>

            <option value="1">Actif</option>

            <option value="2">Inactif</option>

        </select>

        <input name="popup_7" type="checkbox" value="7" style="width: 20px;height: 17px;" required>  C.Spontanée

		

    </td>

    </tr>

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

      

    </td>

    <td scope="col" width="70%" style="border:1px solid #FFFFFF;"> 

        <select name="etat_8" class="form-control input-sm" style="width: 200px;">

            <option value="0">Choisir un état</option>

            <option value="1">Actif</option>

            <option value="2">Inactif</option>

        </select>

        <input name="popup_8" type="checkbox" value="8" style="width: 20px;height: 17px;" required>  C.Stage

        

    </td>

    </tr>

 

 

	<tr>

		<td scope="col" width="30%" style="border:1px solid #FFFFFF;">

		  Order Statut

		</td>

		<td scope="col" width="70%" style="border:1px solid #FFFFFF;">

		  

			<input required name="order_statut"  maxlength="100" style="width: 200px;">



		</td>

    </tr>

	

    <tr>

    <td scope="col" width="30%" style="border:1px solid #FFFFFF;">

    </td>

    <td scope="col" width="8%" style="border:1px solid #FFFFFF;">

        <input name="sendAdd_trole" type="hidden" class="btnEnregistrer"  />             

             <a href="javascript:void(0)" onclick="formulaire_a.submit()" title="Ajouter">

                  <i class="fa fa-floppy-o fa-fw fa-2x"></i> Ajouter

             </a> 

    </td>

    

    </tr>

</table>