 



      <div class='texte'  style="width:720px">

	  <br/><h1>ECOLES</h1>

						  <div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Configuration des  champs editables </h1>

                          </div>



						  

<?php ///////////////////////////////////////////////////////////////////////////////////  -debut  ?>

<?php include('../edit_champs_m_menu.php');?>

<?php ///////////////////////////////////////////////////////////////////////////////////  -f head ?>	



<?php

$af0="block";

$af="none";

$p = (isset($_GET["p"])) ? $_GET["p"] :  "no" ;

if($p=='ec') {

// -----------------------------------

   $af0="none";

   $af="block";

   // -----------------------------------

} 

?>

<tr>

<td COLSPAN=5>

<?php ///////////////////////////////////////////////////////////////////////////////////  -d body ?>	



                 <div   style="border: 1px solid black; background-color: #fff; padding: 5px;">



<?php ///////////////////////////////////////////////////////////////////////////////////  -d  ?>   



<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_a" >

<table  width="100%"  border="0" cellspacing="2" cellpadding="2">

    <tr> 

    <td scope="col" width="11%" style="border:1px solid #FFFFFF;" >Ajouter une école  : </td>

    <td scope="col" width="23%" style="border:1px solid #FFFFFF;" >

        <textarea required name="ecole" rows="1" cols="48" maxlength="100" ></textarea>

    </td>

    <td scope="col" width="13%" style="border:1px solid #FFFFFF;" >Pays de l'école  : </td>

    <td scope="col" width="23%" style="border:1px solid #FFFFFF;" >

               <select name="pays_ecole" style="width:160px;">

                    <option value=""></option>

                    <?php

                    $req_pays = mysql_query("SELECT * FROM prm_pays ORDER BY pays Asc");

                    while ($pays = mysql_fetch_array($req_pays)) {

                      $pays_id = $pays['id_pays'];

                      $pays_desc = $pays['pays'];

                      if ($pays_id == $pays['pays'])

                    $selected = "selected";

                      else

                    $selected = "";

                      echo "<option value=\"$pays_id\" " . $selected . ">$pays_desc</option>";

                    }

                    ?>

                </select>

    </td>

    <td scope="col" width="8%" style="border:1px solid #FFFFFF;">

        <input name="sendAdd_ecol" type="hidden" class="btnEnregistrer"  value=" Enregistrer " />             

			 <a href="javascript:void(0)" onclick="formulaire_a.submit()" title="Modifier">

				  <i class="fa fa-floppy-o fa-fw fa-2x"></i>

			 </a> 

    </td>

    

    </tr>

</table>

</form> 









<?php



$ecole = (isset($_POST['ecole']))? $_POST['ecole'] : "";

$pays_ecole = (isset($_POST['pays_ecole']))? $_POST['pays_ecole'] : "";



if(isset($_POST['sendAdd_ecol']) and $_POST['ecole']!="")

{

$addSect = mysql_query("INSERT INTO prm_ecoles  VALUES ('','".safe($ecole)."','".safe($pays_ecole)."')");

    if(!$addSect){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';

    $sql = "select id_ecole, nom_ecole, prm_pays.pays from prm_ecoles , prm_pays  where prm_ecoles.pays=prm_pays.id_pays  ORDER BY pays.pays, nom_ecole ";

    $select = mysql_query($sql);

    }

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes12');";

   echo "</script>";

// -----------------------------------

}

?>

<br><div class="ligneBleu"></div><br>



<table width="100%" border="0" cellspacing="0" id="ecoles" class="tablesorter" style="background: none;">

<thead>

    <tr>

	

        <th scope="col" width="23%" style="background-color:#C1B3B0;color:white;"><strong>Intitulé</strong></th>

        <th scope="col" width="23%" style="background-color:#C1B3B0;color:white;"><strong>Pays</strong></th>

        <th width="8%"colspan="2" style="background-color:#C1B3B0;color:white;"><strong>Actions</strong></th>

    </tr>

</thead>

<tbody>



<?php



$id = (isset($_POST['id']))? $_POST['id'] : "";

$ecole = (isset($_POST['ecole']))? $_POST['ecole'] : "";

$pays_ecole = (isset($_POST['pays_ecole']))? $_POST['pays_ecole'] : "";



if(isset($_POST['send_ecol']) )

{

$update = mysql_query("update prm_ecoles  set nom_ecole='".safe($ecole)."',id_pays='".safe($pays_ecole)."' where id_ecole='".safe($id)."' ");



    if(!$update){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';

    }

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes12');";

   echo "</script>";        

// -----------------------------------

}

if(isset($_POST['delet_ecol']) )

{

$delet = mysql_query("delete from prm_ecoles  where id_ecole='$id'");

    if(!$delet){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; supprimer </span>';

    }

    

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes12');";

   echo "</script>";        

// -----------------------------------

}

     ?>

<?php

    $sql = "select id_ecole, nom_ecole, prm_pays.pays from prm_ecoles , prm_pays  where prm_ecoles.id_pays=prm_pays.id_pays ORDER BY prm_pays.pays, nom_ecole ";

    //echo $sql;

    $select = mysql_query($sql);

    if((isset($_POST['send_ecol']) and $_POST['send_ecol']!="" )or (isset($_POST['delet_ecol']) and $_POST['delet_ecol']!="") or (isset($_POST['sendAdd_ecol']) and $_POST['sendAdd_ecol']!="" and $_POST['ecole']!="" ))

        $select = mysql_query($sql);

    $ii=$jj=0;

    while( $reponse = mysql_fetch_array($select) ) {

?>

 <tr  onmouseover="this.className='marked'" onmouseout="this.className=''" > 

		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_m<?php echo ++$ii; ?>">

    

    <td style="border:1px solid #FFFFFF;">

    <textarea  name="ecole" rows="1" cols="50" maxlength="100" ><?php echo $reponse['nom_ecole']; ?></textarea></td>

    <td style="border:1px solid #FFFFFF;">

                   <select name="pays_ecole" style="width:160px;">

                    <option value=""></option>

                    <?php

                    $req_pays = mysql_query("SELECT * FROM prm_pays ORDER BY pays Asc");

                    while ($pays = mysql_fetch_array($req_pays)) {

                      $pays_id = $pays['id_pays'];

                      $pays_desc = $pays['pays'];

                      if ($pays_desc == $reponse['pays'])

                    $selected = "selected";

                      else

                    $selected = "";

                      echo "<option value=\"$pays_id\" " . $selected . ">$pays_desc</option>";

                    }

                    ?>

                </select>

    </td>

    <td style="border:1px solid #FFFFFF;">

		<input type="hidden" name="id" value="<?php echo $reponse['id_ecole']; ?>" >

		<input name="send_ecol" type="hidden" class="btnEnregistrer"  value="Enregistrer" />               

			 <a href="javascript:void(0)" onclick="formulaire_m<?php echo $ii; ?>.submit()" title="Modifier">

				  <i class="fa fa-floppy-o fa-fw fa-lg"></i>

			 </a> 

	</td>

		</form> 

    <td style="border:1px solid #FFFFFF;">

		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_s<?php echo ++$jj; ?>">

		<input type="hidden" name="id" value="<?php echo $reponse['id_ecole']; ?>" > 

		<input name="delet_ecol" type="hidden" class="btnSupprimer"  value="Supprimer" />              

			 <a href="javascript:void(0)" onclick="formulaire_s<?php echo $jj; ?>.submit()" title="Modifier">

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

 

<?php ///////////////////////////////////////////////////////////////////////////////////  -f  ?>   

</div>





 </td>

<?php ///////////////////////////////////////////////////////////////////////////////////  -f body ?>   

</tr>

</table>        

<?php ///////////////////////////////////////////////////////////////////////////////////  -fin  ?>

<br>

</div>

 

