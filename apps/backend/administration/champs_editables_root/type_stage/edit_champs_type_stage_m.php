   



      <div class='texte'  style="width:720px">

	  <br/><h1>TYPE DE FORMATION</h1>

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

    <td scope="col" width="13%" style="border:1px solid #FFFFFF;" >Ajouter type de stage : </td>

    <td scope="col" width="23%" style="border:1px solid #FFFFFF;" >

        <textarea required name="type_stage" rows="1" cols="50" maxlength="100" ></textarea>

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



$type_stage = (isset($_POST['type_stage']))? $_POST['type_stage'] : "";

if(isset($_POST['sendAdd_tf']) and $_POST['type_stage']!="")

{

$addSect = mysql_query("INSERT INTO prm_type_stage (n_type_stage) VALUES ('".safe($type_stage)."')");

    if(!$addSect){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';

    $sql = "select * from prm_type_stage ";

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

        <th scope="col" width="23%" style="background-color:#C1B3B0;color:white;"><strong>Intitulé</strong></th>

        <th width="8%"colspan="2" style="background-color:#C1B3B0;color:white;"><strong>Actions</strong></th>

    </tr>

</thead>

<tbody>



<?php



$id = (isset($_POST['id']))? $_POST['id'] : "";

$type_stage = (isset($_POST['type_stage']))? $_POST['type_stage'] : "";

if(isset($_POST['send_tf']) and $_POST['type_stage']!="")

{

$update = mysql_query("UPDATE prm_type_stage set n_type_stage='".safe($type_stage)."' 

  where id_tstage='".safe($id)."' ");



    if(!$update){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';

    }

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes5');";

   echo "</script>";        

// -----------------------------------

}

if(isset($_POST['delet_tf']) and $_POST['delet_tf']!="")

{

$delet = mysql_query("DELETE from prm_type_stage 

  where id_tstage='$id'");

    if(!$delet){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; supprimer </span>';

    }

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes5');";

   echo "</script>";        

// -----------------------------------

}

     ?>

<?php

    $sql = "select * from prm_type_stage ";

    $select = mysql_query($sql);

    if((isset($_POST['send_tf']) and $_POST['send_tf']!="" )or (isset($_POST['delet_tf']) and $_POST['delet_tf']!="") or (isset($_POST['sendAdd_tf']) and $_POST['sendAdd_tf']!="" and $_POST['type_stage']!="" ))

   

        $select = mysql_query($sql);

                 $ii=$jj=0; 

    while( $reponse = mysql_fetch_array($select) ) {

?>

 <tr  onmouseover="this.className='marked'" onmouseout="this.className=''" > 

    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_m<?php echo ++$ii; ?>">

    

    <td style="border:1px solid #FFFFFF;">

    <textarea  name="type_stage" rows="1" cols="50" maxlength="100" ><?php echo $reponse['n_type_stage']; ?></textarea></td>

    <td style="border:1px solid #FFFFFF;">

    <input type="hidden" name="id" value="<?php echo $reponse['id_tstage']; ?>" >

    <input name="send_tf" type="hidden" class="btnEnregistrer"  value="Enregistrer" />               

       <a href="javascript:void(0)" onclick="formulaire_m<?php echo $ii; ?>.submit()" title="Modifier">

          <i class="fa fa-floppy-o fa-fw fa-lg"></i>

       </a> 

  </td>

    </form> 

    <td style="border:1px solid #FFFFFF;">

    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_s<?php echo ++$jj; ?>">

    <input type="hidden" name="id" value="<?php echo $reponse['id_tstage']; ?>" > 

    <input name="delet_tf" type="hidden" class="btnSupprimer"  value="Supprimer" />              

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

