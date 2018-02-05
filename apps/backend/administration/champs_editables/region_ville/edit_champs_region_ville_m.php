 



      <div class='texte'  style="width:720px">

	  <br/><h1>Ville de région</h1>

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

    <td scope="col" width="15%" style="border:1px solid #FFFFFF;" >Ajouter une ville  : </td>

    <td scope="col" width="20%" style="border:1px solid #FFFFFF;" >

        <input required name="n_ville"  maxlength="100" type="text">

    </td>

    <td scope="col" width="13%" style="border:1px solid #FFFFFF;" >Région  : </td>

    <td scope="col" width="23%" style="border:1px solid #FFFFFF;" >

               <select name="n_region" style="width:160px;">

                    <option value=""></option>

                    <?php

                    $req_region = mysql_query("SELECT * FROM prm_region ORDER BY nom_region Asc");

                    while ($r_region = mysql_fetch_array($req_region)) {

                      $id_region = $r_region['id_region'];

                      $nom_region = $r_region['nom_region'];

                      if ($pays_id == $r_region['nom_region'])

                    $selected = "selected";

                      else

                    $selected = "";

                      echo "<option value=\"$id_region\" " . $selected . ">$nom_region</option>";

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



$n_ville = (isset($_POST['n_ville']))? $_POST['n_ville'] : "";

$n_region = (isset($_POST['n_region']))? $_POST['n_region'] : "";



if(isset($_POST['sendAdd_ecol']) and $_POST['n_ville']!="")

{



$addSect = mysql_query("INSERT INTO prm_region_ville  VALUES ('','".safe($n_region)."','".safe($n_ville)."')");

    if(!$addSect){

    echo '<div class="alert alert-error"><ul><li>Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration.</li></ul></div>';

    $maj=0;

    }else{

    echo '<div class="alert alert-success"><ul><li>

     Cette configuration a bien &eacute;t&eacute; mise &agrave; jour.</li></ul></div>';

    $sql = "SELECT * from prm_region_ville 

ORDER BY id_region asc";

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

	      <th scope="col" width="2%" style="background-color:#C1B3B0;color:white;"><strong>N°</strong></th> 

        <th scope="col" width="23%" style="background-color:#C1B3B0;color:white;"><strong>Ville</strong></th>

        <th scope="col" width="23%" style="background-color:#C1B3B0;color:white;"><strong>Région</strong></th>

        <th width="8%"colspan="2" style="background-color:#C1B3B0;color:white;"><strong>Actions</strong></th>

    </tr>

</thead>

<tbody>



<?php



$id = (isset($_POST['id']))? $_POST['id'] : "";

$n_region = (isset($_POST['n_region']))? $_POST['n_region'] : "";

$n_ville = (isset($_POST['n_ville']))? $_POST['n_ville'] : "";



if(isset($_POST['send_ecol']) )

{

$update = mysql_query("UPDATE prm_region_ville  

  set id_region='".safe($n_region)."',ville='".safe($n_ville)."' where id_r_ville='".safe($id)."' ");



    if(!$update){

    echo '<div class="alert alert-error"><ul><li>

     Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration.</li></ul></div>';

    $maj=0;

    }else{

    echo '<div class="alert alert-success"><ul><li>

    Cette configuration a bien &eacute;t&eacute; mise &agrave; jour.</li></ul></div>';

    }

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes12');";

   echo "</script>";        

// -----------------------------------

}

if(isset($_POST['delet_ecol']) )

{



$delet = mysql_query("DELETE from prm_region_ville  where id_r_ville='$id'");

    if(!$delet){

    echo '<div class="alert alert-error"><ul><li>

    Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </li></ul></div>';

    $maj=0;

    }else{

    echo '<div class="alert alert-success">

    Cette configuration a bien &eacute;t&eacute; supprimer </li></ul></div>';

    }







}

     ?>

<?php

    $sql = "SELECT * from prm_region_ville 

ORDER BY id_region asc";

    $select = mysql_query($sql);

    if((isset($_POST['send_ecol']) and $_POST['send_ecol']!="" )or (isset($_POST['delet_ecol']) and $_POST['delet_ecol']!="") or (isset($_POST['sendAdd_ecol']) and $_POST['sendAdd_ecol']!="" and $_POST['n_ville']!="" ))

        $select = mysql_query($sql);

    $ii=$jj=0;

    while( $reponse = mysql_fetch_array($select) ) {//$ii++;

if ($reponse['id_region']%2) {$c_b = "#FFFFFF";$c_b_1="";}

else {$c_b = "#FFFFFF";$c_b_1="#BFD2DB";}

?>

 <tr  onmouseover="this.className='marked'" onmouseout="this.className=''" > 

		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_m<?php echo ++$ii; ?>">

    <td style="border:1px solid <?php echo $c_b; ?>;background-color: <?php echo $c_b_1; ?>;"><span class="badge"><?php echo $ii; ?></span></td>

    <td style="border:1px solid <?php echo $c_b; ?>;background-color: <?php echo $c_b_1; ?>;">

    <input  name="n_ville" value="<?php echo $reponse['ville']; ?>" style="width: 300px;"> 

    </td>

    <td style="border:1px solid <?php echo $c_b; ?>;background-color: <?php echo $c_b_1; ?>;">

                 <select name="n_region" style="width:160px;">

                    <option value=""></option>

                    <?php

                    $req_region = mysql_query("SELECT * FROM prm_region ORDER BY nom_region Asc");

                    while ($r_region = mysql_fetch_array($req_region)) {

                      $id_region = $r_region['id_region'];

                      $nom_region = $r_region['nom_region'];

                      if ($reponse['id_region'] == $id_region)

                    $selected = "selected";

                      else

                    $selected = "";

                      echo "<option value=\"$id_region\" " . $selected . ">$nom_region</option>";

                    }

                    ?>

                </select>

    </td>

    <td style="border:1px solid <?php echo $c_b; ?>;background-color: <?php echo $c_b_1; ?>;">

		<input type="hidden" name="id" value="<?php echo $reponse['id_r_ville']; ?>" >

		<input name="send_ecol" type="hidden" class="btnEnregistrer"  value="Enregistrer" />               

			 <a href="javascript:void(0)" onclick="formulaire_m<?php echo $ii; ?>.submit()" title="Modifier">

				  <i class="fa fa-floppy-o fa-fw fa-lg"></i>

			 </a> 

	</td>

		</form> 

    <td style="border:1px solid <?php echo $c_b; ?>;background-color: <?php echo $c_b_1; ?>;">

		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_s<?php echo ++$jj; ?>">

		<input type="hidden" name="id" value="<?php echo $reponse['id_r_ville']; ?>" > 

		<input name="delet_ecol" type="hidden" class="btnSupprimer"  value="Supprimer" />              

			 <a href="javascript:void(0)" onclick="formulaire_s<?php echo $jj; ?>.submit()" title="Supprimer">

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

 

