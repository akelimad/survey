<table width="100%" border="0" cellspacing="0" id="lieux" class="tablesorter" style="background: none;">

<thead>

    <tr>

        <th scope="col" width="10%" style="background-color:#C1B3B0;color:white;"><b>Réf</b></th>

        <th scope="col" width="35%" style="background-color:#C1B3B0;color:white;"><b>Statut</b></th>

        <th scope="col" width="15%" style="background-color:#C1B3B0;color:white;"><b>Pages</b></th> 

        <th width="10%"  colspan="2" style="background-color:#C1B3B0;color:white;"><b>Actions</b></th>

        <th scope="col" width="20%"  style="background-color:#C1B3B0;color:white;"><b>MAJ</b></th>

    </tr>

</thead>

<tbody>



<?php

$id = (isset($_POST['id']))? $_POST['id'] : "";



$ref_statut = (isset($_POST['ref_statut']))? $_POST['ref_statut'] : "";

$type_p = (isset($_POST['type_p']))? $_POST['type_p'] : "";



$prm_titre= (isset($_POST['prm_titre']))? $_POST['prm_titre'] : "";

$prm_expe = (isset($_POST['prm_expe']))? $_POST['prm_expe'] : "";

$prm_local = (isset($_POST['prm_local']))? $_POST['prm_local'] : "";

$prm_tpost = (isset($_POST['prm_tpost']))? $_POST['prm_tpost'] : "";

$prm_fonc = (isset($_POST['prm_fonc']))? $_POST['prm_fonc'] : "";

$prm_nfor = (isset($_POST['prm_nfor']))? $_POST['prm_nfor'] : "";

$prm_mobil = (isset($_POST['prm_mobil']))? $_POST['prm_mobil'] : "";

$prm_n_mobil = (isset($_POST['prm_n_mobil']))? $_POST['prm_n_mobil'] : "";

$prm_t_mobil = (isset($_POST['prm_t_mobil']))? $_POST['prm_t_mobil'] : "";





$min_p_a = (isset($_POST['min_p_a']))? $_POST['min_p_a'] : "";





if(isset($_POST['send_trole']) and $_POST['send_trole']!="")

{

$sql_update ="	UPDATE prm_pertinence 

				set ref_p='".safe($ref_statut)."', type_p='".safe($type_p)."',

				prm_titre='".safe($prm_titre)."',prm_expe='".safe($prm_expe)."',

				prm_local='".safe($prm_local)."',prm_tpost='".safe($prm_tpost)."',

				prm_fonc='".safe($prm_fonc)."',prm_nfor='".safe($prm_nfor)."',

				prm_mobil='".safe($prm_mobil)."' ,prm_n_mobil='".safe($prm_n_mobil)."',

				prm_t_mobil='".safe($prm_t_mobil)."',min_p_a='".safe($min_p_a)."'

				where id_prm_p='".safe($id)."' ";

  

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

$delet = mysql_query("DELETE from prm_pertinence where id_prm_p='$id'");



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

    $sql = "SELECT * from prm_pertinence     order by id_prm_p DESC ";

    $select = mysql_query($sql);

     if((isset($_POST['send_trole']) and $_POST['send_trole']!="" )or (isset($_POST['delet_trole']) and $_POST['delet_trole']!="") or (isset($_POST['sendAdd_trole']) and $_POST['sendAdd_trole']!="" 

        and $_POST['type_p']!=""  and $_POST['ref_statut']!="" ))

        $select = mysql_query($sql);

    $ii=$jj=0;

    while( $reponse = mysql_fetch_array($select) ) {

?>

 <tr  onmouseover="this.className='marked'" onmouseout="this.className=''" > 

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_m<?php echo ++$ii; ?>">

    

	

    <td style="border:1px solid #FFFFFF;">

    <input  name="ref_statut"  maxlength="100" style="width:80%" value="<?php echo $reponse['ref_p']; ?>">

    </td>

	

    <td style="border:1px solid #FFFFFF;">

		<select name="type_p" class="form-control input-sm" style="width: 30%;">

			<option value="">Selectionner la page</option>

			<option value="1" <?php if ($reponse['type_p']=="1" ) echo "selected"; ?>>Postulation</option>

			<option value="2" <?php if ($reponse['type_p']=="2" ) echo "selected"; ?>>Matching</option>

        </select>

		<?php if ($reponse['type_p']=="2" ) { ?>

			<input  name="min_p_a"  maxlength="100" style="width:65%" value="<?php echo $reponse['min_p_a']; ?>" placeholder="Minimum pertinence affichable">

		<?php } ?>

    </td>

	

    <td style="border:1px solid #FFFFFF;">

        <input name="prm_titre" <?php if ($reponse['prm_titre']=="1" ) echo "checked"; ?>

        value="1"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" >  Titre <br/>



        <input name="prm_expe" <?php if ($reponse['prm_expe']=="1" ) echo "checked"; ?>

        value="1"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" >  Expérience <br/>



        <input name="prm_local" <?php if ($reponse['prm_local']=="1" ) echo "checked"; ?>

        value="1"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" >  Ville  <br/>



        <input name="prm_tpost" <?php if ($reponse['prm_tpost']=="1" ) echo "checked"; ?>

        value="1"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" >  Type de poste  <br/>



        <input name="prm_fonc" <?php if ($reponse['prm_fonc']=="1" ) echo "checked"; ?>

        value="1"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" >  Fonction  <br/>



        <input name="prm_nfor" <?php if ($reponse['prm_nfor']=="1" ) echo "checked"; ?>

        value="1"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" >  Formation  <br/>





        <input name="prm_mobil" <?php if ($reponse['prm_mobil']=="1" ) echo "checked"; ?>

        value="1"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" >  Mobilité (Oui/Non) <br/>



        <input name="prm_n_mobil" <?php if ($reponse['prm_n_mobil']=="1" ) echo "checked"; ?>

        value="1"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" >  Niveau Mobilité <br/>



        <input name="prm_t_mobil" <?php if ($reponse['prm_t_mobil']=="1" ) echo "checked"; ?>

        value="1"

        type="checkbox" maxlength="100" style="width: 20px;height: 17px;" >  Taux Mobilité



    </td>

    



		





	

    <td style="border:1px solid #FFFFFF;">

        <input type="hidden" name="id" value="<?php echo $reponse['id_prm_p']; ?>" >

        <input name="send_trole" type="hidden" class="btnEnregistrer"  value="Enregistrer" />               

             <a href="#" onclick="formulaire_m<?php echo $ii; ?>.submit()" title="Modifier">

                  <i class="fa fa-floppy-o fa-fw fa-lg"></i>

             </a> 

    </td>

        </form> 

    <td style="border:1px solid #FFFFFF;">

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_s<?php echo ++$jj; ?>">

        <input type="hidden" name="id" value="<?php echo $reponse['id_prm_p']; ?>" > 

        <input name="delet_trole" type="hidden" class="btnSupprimer"  value="Supprimer" />              

             <a href="#" onclick="formulaire_s<?php echo $jj; ?>.submit()" title="Modifier">

                  <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

             </a> 

        </form> 

    </td> 

    <td style="border:1px solid #FFFFFF;">

	

	

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_s<?php echo ++$jj; ?>">

	<input  name="min_p_a_req"  maxlength="100" style="width:80%" value="" placeholder="Minimum pertinence">

        <input type="hidden" name="ref_p"       value="<?php echo $reponse['ref_p']; ?>" /> 

        <input type="hidden" name="p_trole"  value="pertinences" />              

             <a href="#" onclick="formulaire_s<?php echo $jj; ?>.submit()" title="Modifier pertinences des candidats">

                  <i class="fa fa-tasks fa-fw fa-lg"  ></i>

             </a> 

        </form> 

    </td>

</tr> 

<?php

    }

?>

</tbody>

</table> 





<?php



if(isset($_POST['p_trole']) and $_POST['p_trole']!="")

{

 include ( "./edit_champs_pertinence_m_table_p.php");

}



?>