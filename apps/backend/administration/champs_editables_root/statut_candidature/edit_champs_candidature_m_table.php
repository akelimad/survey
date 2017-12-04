<table width="100%" border="0" cellspacing="0" id="lieux" class="tablesorter" style="background: none;">

<thead>

    <tr>

        <th scope="col" width="10%" style="background-color:#C1B3B0;color:white;"><b>Réf</b></th>

        <th scope="col" width="30%" style="background-color:#C1B3B0;color:white;"><b>Statut</b></th>

        <th scope="col" width="20%" style="background-color:#C1B3B0;color:white;"><b>Pages</b></th> 

        <th scope="col" width="20%" style="background-color:#C1B3B0;color:white;"><b>Popup</b></th> 

        <th scope="col" width="15%" style="background-color:#C1B3B0;color:white;"><b>Réf email</b></th>

        <th scope="col" width="8%"  style="background-color:#C1B3B0;color:white;"><b>Order</b></th>

        <th width="8%"colspan="2" style="background-color:#C1B3B0;color:white;"><b>Actions</b></th>

    </tr>

</thead>

<tbody>



<?php



$id = (isset($_POST['id']))? $_POST['id'] : "";

$ref_statut = (isset($_POST['ref_statut']))? $_POST['ref_statut'] : "";

$statut = (isset($_POST['statut']))? $_POST['statut'] : "";

$ref_email = (isset($_POST['ref_email']))? $_POST['ref_email'] : "";



$popup_1 = (isset($_POST['popup_1']))? $_POST['popup_1'] : "";

$popup_2 = (isset($_POST['popup_2']))? $_POST['popup_2'] : "";

$popup_3 = (isset($_POST['popup_3']))? $_POST['popup_3'] : "";

$popup_4 = (isset($_POST['popup_4']))? $_POST['popup_4'] : "";

$popup_5 = (isset($_POST['popup_5']))? $_POST['popup_5'] : "";

$popup_6 = (isset($_POST['popup_6']))? $_POST['popup_6'] : "";

$popup_7 = (isset($_POST['popup_7']))? $_POST['popup_7'] : "";

$popup_8 = (isset($_POST['popup_8']))? $_POST['popup_8'] : "";



$etat_1= (isset($_POST['etat_1']))? $_POST['etat_1'] : 0 ;

$etat_2= (isset($_POST['etat_2']))? $_POST['etat_2'] : 0 ;

$etat_3= (isset($_POST['etat_3']))? $_POST['etat_3'] : 0 ;

$etat_4= (isset($_POST['etat_4']))? $_POST['etat_4'] : 0 ;

$etat_5= (isset($_POST['etat_5']))? $_POST['etat_5'] : 0 ;

$etat_6= (isset($_POST['etat_6']))? $_POST['etat_6'] : 0 ;

$etat_7= (isset($_POST['etat_7']))? $_POST['etat_7'] : 0 ;

$etat_8= (isset($_POST['etat_8']))? $_POST['etat_8'] : 0 ;



$order_statut = (isset($_POST['order_statut']))? $_POST['order_statut'] : "";



if(isset($_POST['send_trole']) and $_POST['send_trole']!="")

{

$sql_update ="UPDATE prm_statut_candidature   set ref_statut='".safe($ref_statut)."', statut='".safe($statut)."',ref_email='".safe($ref_email)."',

  popup_1='".safe($popup_1)."',etat_1='".safe($etat_1)."',popup_2='".safe($popup_2)."',etat_2='".safe($etat_2)."',popup_3='".safe($popup_3)."',etat_3='".safe($etat_3)."' ,

  popup_4='".safe($popup_4)."',etat_4='".safe($etat_4)."', popup_5='".safe($popup_5)."',etat_5='".safe($etat_5)."',popup_6='".safe($popup_6)."',etat_6='".safe($etat_6)."',popup_7='".safe($popup_7)."',etat_7='".safe($etat_7)."',

  popup_8='".safe($popup_8)."',etat_8='".safe($etat_8)."',order_statut='".safe($order_statut)."'   where id_prm_statut_c='".safe($id)."' ";

  

$update = mysql_query($sql_update);



    if(!$update){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';

    }

    

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes10');";

   echo "</script>";        

// -----------------------------------      

}



if(isset($_POST['delet_trole']) and $_POST['delet_trole']!="")

{

$delet = mysql_query("delete from prm_statut_candidature where id_prm_statut_c='$id'");



 //mysql_query("delete from root_permission where id_role='$id'");

    if(!$delet){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; supprimer </span>';

    }

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes10');";

   echo "</script>";        

// -----------------------------------   

}

     ?>

<?php

    $sql = "select * from prm_statut_candidature     order by order_statut DESC ";

    $select = mysql_query($sql);

     if((isset($_POST['send_trole']) and $_POST['send_trole']!="" )or (isset($_POST['delet_trole']) and $_POST['delet_trole']!="") or (isset($_POST['sendAdd_trole']) and $_POST['sendAdd_trole']!="" and $_POST['statut']!=""  and $_POST['ref_statut']!="" ))

        $select = mysql_query($sql);

    $ii=$jj=0;

    while( $reponse = mysql_fetch_array($select) ) {

?>

 <tr  onmouseover="this.className='marked'" onmouseout="this.className=''" > 

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_m<?php echo ++$ii; ?>">

    

	

    <td style="border:1px solid #FFFFFF;">

    <input  name="ref_statut"  maxlength="100" style="width:80%" value="<?php echo $reponse['ref_statut']; ?>">

    </td>

	

    <td style="border:1px solid #FFFFFF;">

    <input  name="statut"  maxlength="100" style="width:80%" value="<?php echo $reponse['statut']; ?>">

    </td>

	

    <td style="border:1px solid #FFFFFF;">

        <input name="popup_1" <?php if ($reponse['popup_1']=="1" ) echo "checked"; ?>

        value="1"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" required>  Accueil <br/>



        <input name="popup_2" <?php if ($reponse['popup_2']=="2" ) echo "checked"; ?>

        value="2"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" required>  N.Candidature <br/>



        <input name="popup_3" <?php if ($reponse['popup_3']=="3" ) echo "checked"; ?>

        value="3"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" required>  C.En cours  <br/>



        <input name="popup_4" <?php if ($reponse['popup_4']=="4" ) echo "checked"; ?>

        value="4"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" required>  C.Retenu  <br/>



        <input name="popup_5" <?php if ($reponse['popup_5']=="5" ) echo "checked"; ?>

        value="5"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" required>  C.Recruter  <br/>



        <input name="popup_6" <?php if ($reponse['popup_6']=="6" ) echo "checked"; ?>

        value="6"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" required>  C.Non retenu  <br/>





        <input name="popup_7" <?php if ($reponse['popup_7']=="7" ) echo "checked"; ?>

        value="7"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" required>  C.Spontanée <br/>



        <input name="popup_8" <?php if ($reponse['popup_8']=="8" ) echo "checked"; ?>

        value="8"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" required>  C.Stage 



    </td>

    <td style="border:1px solid #FFFFFF;">

	

        

		<select name="etat_1" class="form-control input-sm" > 

			<option value="0" <?php if ($reponse['etat_1']=="0" ) echo "selected"; ?>></option>

			<option value="1" <?php if ($reponse['etat_1']=="1" ) echo "selected"; ?>> Actif</option>

			<option value="2" <?php if ($reponse['etat_1']=="2" ) echo "selected"; ?>> Inactif</option> 

		</select><br/>

		

        

		<select name="etat_2" class="form-control input-sm" > 

			<option value="0" <?php if ($reponse['etat_2']=="0" ) echo "selected"; ?>></option>

			<option value="1" <?php if ($reponse['etat_2']=="1" ) echo "selected"; ?>> Actif</option>

			<option value="2" <?php if ($reponse['etat_2']=="2" ) echo "selected"; ?>> Inactif</option> 

		</select><br/>

		

        

		

		<select name="etat_3" class="form-control input-sm" > 

			<option value="0" <?php if ($reponse['etat_3']=="0" ) echo "selected"; ?>></option>

			<option value="1" <?php if ($reponse['etat_3']=="1" ) echo "selected"; ?>> Actif</option>

			<option value="2" <?php if ($reponse['etat_3']=="2" ) echo "selected"; ?>> Inactif</option> 

		</select><br/>

		

        

		

		<select name="etat_4" class="form-control input-sm" > 

			<option value="0" <?php if ($reponse['etat_4']=="0" ) echo "selected"; ?>></option>

			<option value="1" <?php if ($reponse['etat_4']=="1" ) echo "selected"; ?>> Actif</option>

			<option value="2" <?php if ($reponse['etat_4']=="2" ) echo "selected"; ?>> Inactif</option> 

		</select><br/>

		

        

		

		<select name="etat_5" class="form-control input-sm" > 

			<option value="0" <?php if ($reponse['etat_5']=="0" ) echo "selected"; ?>></option>

			<option value="1" <?php if ($reponse['etat_5']=="1" ) echo "selected"; ?>> Actif</option>

			<option value="2" <?php if ($reponse['etat_5']=="2" ) echo "selected"; ?>> Inactif</option> 

		</select><br/>

		

        

		

		<select name="etat_6" class="form-control input-sm" > 

			<option value="0" <?php if ($reponse['etat_6']=="0" ) echo "selected"; ?>></option>

			<option value="1" <?php if ($reponse['etat_6']=="1" ) echo "selected"; ?>> Actif</option>

			<option value="2" <?php if ($reponse['etat_6']=="2" ) echo "selected"; ?>> Inactif</option> 

		</select><br/>

		

        

		<select name="etat_7" class="form-control input-sm" >

			<option value="0" <?php if ($reponse['etat_7']=="0" ) echo "selected"; ?>></option> 

			<option value="1" <?php if ($reponse['etat_7']=="1" ) echo "selected"; ?>> Actif</option>

			<option value="2" <?php if ($reponse['etat_7']=="2" ) echo "selected"; ?>> Inactif</option> 

		</select><br/>



        <select name="etat_8" class="form-control input-sm" >

            <option value="0" <?php if ($reponse['etat_8']=="0" ) echo "selected"; ?>></option> 

            <option value="1" <?php if ($reponse['etat_8']=="1" ) echo "selected"; ?>> Actif</option>

            <option value="2" <?php if ($reponse['etat_8']=="2" ) echo "selected"; ?>> Inactif</option> 

        </select><br/>

		

  

  

    </td>

    <td style="border:1px solid #FFFFFF;">

<select name="ref_email" class="form-control input-sm" style="width: 200px;">



<option value="">Ne pas envoyer de mail</option>



<?php

$req_secteur = mysql_query("SELECT * FROM root_email_auto");

while ($secteur = mysql_fetch_array($req_secteur)) {

$ref_id = $secteur['ref'];

$objet_desc = $secteur['objet']; 

?>

<option value="<?php echo $ref_id; ?>" 

<?php if ($reponse['ref_email'] == $ref_id) echo ' selected="selected"'; ?>>

<?php echo $ref_id; ?> || <?php echo $objet_desc; ?></option>

<?php

}

?>

</select>



	

    </td>

		



    <td style="border:1px solid #FFFFFF;">

    <input  name="order_statut"  maxlength="100" style="width:80%" value="<?php echo $reponse['order_statut']; ?>">

    </td>

	

    <td style="border:1px solid #FFFFFF;">

        <input type="hidden" name="id" value="<?php echo $reponse['id_prm_statut_c']; ?>" >

        <input name="send_trole" type="hidden" class="btnEnregistrer"  value="Enregistrer" />               

             <a href="#" onclick="formulaire_m<?php echo $ii; ?>.submit()" title="Modifier">

                  <i class="fa fa-floppy-o fa-fw fa-lg"></i>

             </a> 

    </td>

        </form> 

    <td style="border:1px solid #FFFFFF;">

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_s<?php echo ++$jj; ?>">

        <input type="hidden" name="id" value="<?php echo $reponse['id_prm_statut_c']; ?>" > 

        <input name="delet_trole" type="hidden" class="btnSupprimer"  value="Supprimer" />              

             <a href="#" onclick="formulaire_s<?php echo $jj; ?>.submit()" title="Modifier">

                  <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

             </a> 

        </form> 

    </td>

</tr> 

<?php

    }

?>

</tbody>

</table> 