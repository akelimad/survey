    



      <div class='texte'  style="width:720px">

	  <br/><h1>FORMATIONS</h1>

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

    <td scope="col" width="13%" style="border:1px solid #FFFFFF;" >Ajouter  fonction : </td>

    <td scope="col" width="23%" style="border:1px solid #FFFFFF;" >

        <textarea required name="fonctions" rows="1" cols="50" maxlength="100" ></textarea>

    </td>

    <td scope="col" width="8%" style="border:1px solid #FFFFFF;">

        <input name="sendAdd_tfonc" type="hidden" class="btnEnregistrer"  value=" Enregistrer " />             

			 <a href="#" onclick="formulaire_a.submit()" title="Modifier">

				  <i class="fa fa-floppy-o fa-fw fa-2x"></i>

			 </a> 

    </td>

    

    </tr>

</table>

</form> 



 



<?php



$fonctions = (isset($_POST['fonctions']))? $_POST['fonctions'] : "";



if(isset($_POST['sendAdd_tfonc']) and $_POST['fonctions']!="")

{

$addSect = mysql_query("INSERT INTO prm_fonctions VALUES ('','".safe($fonctions)."')");



//$id=0;

    if(!$addSect){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';

    

    $sql = "select * from prm_fonctions ";

    $select = mysql_query($sql);

    

    }

/*  

    $result = mysql_query("SELECT MAX(id_fonc) FROM prm_fonctions");

    $row = mysql_fetch_row($result);

    $highest_id = $row[0];  

    

$sqla="INSERT INTO  root_permission VALUES ('','$highest_id', '1', '0', '0', '0', '0', '0' )" ;

$resulta=mysql_query($sqla);

*/

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes11');";

   echo "</script>";        

// -----------------------------------

}

?>



<br><div class="ligneBleu"></div><br>



<table width="100%" border="0" cellspacing="0" id="fonctions" class="tablesorter" style="background: none;">

<thead>

    <tr>

	

        <th scope="col" width="23%" style="background-color:#C1B3B0;color:white;"><strong>Intitulé</strong></th>

        <th width="8%"colspan="2" style="background-color:#C1B3B0;color:white;"><strong>Actions</strong></th>

    </tr>

</thead>

<tbody>



<?php



$id = (isset($_POST['id']))? $_POST['id'] : "";

$fonctions = (isset($_POST['fonctions']))? $_POST['fonctions'] : "";



if(isset($_POST['send_tfonc']) and $_POST['send_tfonc']!="")

{

$update = mysql_query("update prm_fonctions set fonction='".safe($fonctions)."' where id_fonc='".safe($id)."' ");



    if(!$update){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';

    }

    

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes11');";

   echo "</script>";        

// -----------------------------------      

}



if(isset($_POST['delet_tfonc']) and $_POST['delet_tfonc']!="")

{

$delet = mysql_query("delete from prm_fonctions where id_fonc='$id'");



    /*

        mysql_query("delete from root_permission where id_role='$id'");

    */

    if(!$delet){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; supprimer </span>';

    }

// -----------------------------------

   echo "<script>";

   echo "showonlyone('newboxes11');";

   echo "</script>";        

// -----------------------------------   

}

     ?>

<?php

    $sql = "select * from prm_fonctions ";

    $select = mysql_query($sql);

    if((isset($_POST['send_tfonc']) and $_POST['send_tfonc']!="" )or (isset($_POST['delet_tfonc']) and $_POST['delet_tfonc']!="") or (isset($_POST['sendAdd_tfonc']) and $_POST['sendAdd_tfonc']!="" and $_POST['fonctions']!="" ))

        $select = mysql_query($sql);



    $ii=$jj=0;

    while( $reponse = mysql_fetch_array($select) ) {

?>

 <tr  onmouseover="this.className='marked'" onmouseout="this.className=''" > 

		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_m<?php echo ++$ii; ?>">

    

    <td style="border:1px solid #FFFFFF;">

    <textarea  name="fonctions" rows="1" cols="50" maxlength="100" ><?php echo $reponse['fonction']; ?></textarea></td>

    <td style="border:1px solid #FFFFFF;">

		<input type="hidden" name="id" value="<?php echo $reponse['id_fonc']; ?>" >

		<input name="send_tfonc" type="hidden" class="btnEnregistrer"  value="Enregistrer" />               

			 <a href="#" onclick="formulaire_m<?php echo $ii; ?>.submit()" title="Modifier">

				  <i class="fa fa-floppy-o fa-fw fa-lg"></i>

			 </a> 

	</td>

		</form> 

    <td style="border:1px solid #FFFFFF;">

		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_s<?php echo ++$jj; ?>">

		<input type="hidden" name="id" value="<?php echo $reponse['id_fonc']; ?>" > 

		<input name="delet_tfonc" type="hidden" class="btnSupprimer"  value="Supprimer" />              

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





<?php ///////////////////////////////////////////////////////////////////////////////////  -f  ?>   

</div>





 </td>

<?php ///////////////////////////////////////////////////////////////////////////////////  -f body ?>   

</tr>

</table>        

<?php ///////////////////////////////////////////////////////////////////////////////////  -fin  ?>

<br>







      </div>



	  