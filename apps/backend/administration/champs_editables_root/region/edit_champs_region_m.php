   



      <div class='texte'  style="width:720px">

	  <br/><h1>Région</h1>

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



<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_a">

<table  width="100%"  border="0" cellspacing="2" cellpadding="2">

    <tr> 

    <td scope="col" width="13%" style="border:1px solid #FFFFFF;" >Ajouter une région : </td>

    <td scope="col" width="23%" style="border:1px solid #FFFFFF;" >

        <input required name="c_region"  maxlength="100" type="text" style="width:300px;">

    </td>

    <td scope="col" width="8%" style="border:1px solid #FFFFFF;">

        <input name="sendAdd_tf" type="hidden" class="btnEnregistrer"  value=" Enregistrer " />

        <a href="javascript:void(0)" onclick="formulaire_a.submit()" title="Modifier">

          <i class="fa fa-floppy-o fa-fw fa-2x"></i>

              </td>

    

    </tr>

</table>

</form>



<?php



$c_region = (isset($_POST['c_region']))? $_POST['c_region'] : "";

if(isset($_POST['sendAdd_tf']) and $_POST['c_region']!="")

{

  $ref = "R".rand(1, 100);

$addSect = mysql_query("INSERT INTO prm_region (ref_region,nom_region) 

  VALUES ('".safe($ref)."','".safe($c_region)."')");

    if(!$addSect){

    echo '<div class="alert alert-error"><ul><li>

     Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration.</li></ul></div>';

    $maj=0;

    }else{

    echo '<div class="alert alert-success"><ul><li>

    Cette configuration a bien &eacute;t&eacute; mise &agrave; jour.</li></ul></div>';

    $sql = "select * from prm_region ";

    $select = mysql_query($sql);

    }

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes5');";

   echo "</script>";        

// -----------------------------------

}

?>



<br><div class="ligneBleu"></div><br>



<table width="100%" border="0" cellspacing="0" id="type_formation" class="tablesorter" style="background: none;">

<thead>

    <tr>

        <th scope="col" width="2%" style="background-color:#C1B3B0;color:white;">

        <strong>N°</strong></th>

        <th scope="col" width="23%" style="background-color:#C1B3B0;color:white;">

        <strong>Nom région</strong></th>

        <th width="8%"colspan="2" style="background-color:#C1B3B0;color:white;">

        <strong>Actions</strong></th>

    </tr>

</thead>

<tbody>



<?php



$id = (isset($_POST['id']))? $_POST['id'] : "";

$c_region = (isset($_POST['c_region']))? $_POST['c_region'] : "";

if(isset($_POST['send_tf']) and $_POST['c_region']!="")

{

$update = mysql_query("UPDATE prm_region set nom_region='".safe($c_region)."' 

  where id_region ='".safe($id)."' ");



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

   echo "showonlyone('newboxes5');";

   echo "</script>";        

// -----------------------------------

}

if(isset($_POST['delet_tf']) and $_POST['delet_tf']!="")

{



$r_prm_region_ville = "SELECT * from prm_region_ville where id_region ='".$id."' ";

$s_prm_region_ville = mysql_query($r_prm_region_ville);

$count_region_ville = mysql_num_rows($s_prm_region_ville);



$r_candidature_region = "SELECT * from candidature_region where id_region ='".$id."' ";

$s_candidature_region = mysql_query($r_candidature_region);

$count_candidature_region = mysql_num_rows($s_candidature_region);

//echo $count_region_ville." || ".$count_candidature_region;

if($count_region_ville== 0 || $count_candidature_region == 0){

$delet = mysql_query("DELETE from prm_region where id_region ='".$id."'");

    if(!$delet){

    echo '<div class="alert alert-error"><ul><li>

    Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </li></ul></div>';

    $maj=0;

    }else{

    echo '<div class="alert alert-success">

    Cette configuration a bien &eacute;t&eacute; supprimer </li></ul></div>';

    }

}else{

  echo '<div class="alert alert-error"><ul><li>

    Une erreur de suppression de région  </li></ul></div>';

}





}

     ?>

<?php

    $sql = "SELECT * from prm_region ";

    $select = mysql_query($sql);

    if((isset($_POST['send_tf']) and $_POST['send_tf']!="" )or (isset($_POST['delet_tf']) and $_POST['delet_tf']!="") or (isset($_POST['sendAdd_tf']) and $_POST['sendAdd_tf']!="" and $_POST['c_region']!="" ))

   

        $select = mysql_query($sql);

                 $ii=$jj=0; 

    while( $reponse = mysql_fetch_array($select) ) {

if ($reponse['id_region']%2) {$c_b = "#FFFFFF";$c_b_1="";}

else {$c_b = "#FFFFFF";$c_b_1="#BFD2DB";}

?>

 <tr  onmouseover="this.className='marked'" onmouseout="this.className=''" > 

    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_m<?php echo ++$ii; ?>">

    <td style="border:1px solid <?php echo $c_b; ?>;background-color: <?php echo $c_b_1; ?>;">

    <span class="badge"><?php echo $ii; ?></span></td>

    <td style="border:1px solid <?php echo $c_b; ?>;background-color: <?php echo $c_b_1; ?>;">

    <input  name="c_region" style="width:300px;" maxlength="100" 

    value="<?php echo $reponse['nom_region']; ?>"></td>

    <td style="border:1px solid <?php echo $c_b; ?>;background-color: <?php echo $c_b_1; ?>;">

    <input type="hidden" name="id" value="<?php echo $reponse['id_region']; ?>" >

    <input name="send_tf" type="hidden" class="btnEnregistrer"  value="Enregistrer" />               

       <a href="javascript:void(0)" onclick="formulaire_m<?php echo $ii; ?>.submit()" title="Modifier">

          <i class="fa fa-floppy-o fa-fw fa-lg"></i>

       </a> 

  </td>

    </form> 

    <td style="border:1px solid <?php echo $c_b; ?>;background-color: <?php echo $c_b_1; ?>;">

    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_s<?php echo ++$jj; ?>">

    <input type="hidden" name="id" value="<?php echo $reponse['id_region']; ?>" > 

    <input name="delet_tf" type="hidden" class="btnSupprimer"  value="Supprimer" />              

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

