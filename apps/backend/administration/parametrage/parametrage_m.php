







      <div class='texte'  style="width:720px">



	  <br/><h1>PARAMETRAGE DE L'APPLICATION</h1>



						  <div class="subscription" style="margin: 10px 0pt;">



                                 <h1>Configuration des modules de l'application </h1>



                          </div>



<?php



$id = (isset($_POST['id']))? $_POST['id'] : "";

$ref_r_prm = (isset($_POST['ref_r_prm']))? $_POST['ref_r_prm'] : "";

$titre_r_prm = (isset($_POST['titre_r_prm']))? $_POST['titre_r_prm'] : "";

$etat_r_prm = (isset($_POST['etat_r_prm']))? $_POST['etat_r_prm'] : "";



if(isset($_POST['send_r_prm']) )

{

$update = mysql_query("update root_parametrage  set ref_r_prm='".safe($ref_r_prm)."',titre_r_prm='".safe($titre_r_prm)."',etat_r_prm='".safe($etat_r_prm)."' where id_r_prm='".safe($id)."' ");



    if(!$update){

    echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

    $maj=0;

    }else{

    echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';

    }

 

} 

     ?>



 

<br><div class="ligneBleu"></div><br>



<table width="100%" border="0" cellspacing="0" id="ecoles" class="tablesorter" style="background: none;">

<thead>

    <tr>

	

        <th scope="col" width="20%" style="background-color:#C1B3B0;color:white;"><strong>Ref</strong></th>

        <th scope="col" width="50%" style="background-color:#C1B3B0;color:white;"><strong>Titre</strong></th>

        <th scope="col" width="15%" style="background-color:#C1B3B0;color:white;"><strong>Etat</strong></th>

        <th width="4%" colspan="2" style="background-color:#C1B3B0;color:white;"><strong></strong></th>

		

    </tr>

</thead>

<tbody>



<?php

    $sql = " SELECT * FROM root_parametrage ";

     //echo $sql;

    $select = mysql_query($sql);

    if((isset($_POST['send_r_prm']) and $_POST['send_r_prm']!="" ) ) {$select = mysql_query($sql);}

    $ii=$jj=0;

    while( $reponse = mysql_fetch_array($select) ) {

		/*

		echo "<br>".$reponse['ref_r_prm']; 

		echo "<br>".$reponse['titre_r_prm']; 

		echo "<br>".$reponse['etat_r_prm']; 

		*/

?>

 <tr  onmouseover="this.className='marked'" onmouseout="this.className=''" > 

		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_m<?php echo ++$ii; ?>">

     

						<td>

						

							<input  required name="ref_r_prm" value="<?php echo $reponse['ref_r_prm']; ?>"    >



						</td>

						<td>

						

							<input  required name="titre_r_prm" value="<?php echo $reponse['titre_r_prm']; ?>"  style="width: 350px;" >



						</td>

						<td>

								

						<select name="etat_r_prm"  >

							<option value=""></option> 

							<option value="0" <?php if( $reponse['etat_r_prm']==0 ) echo "selected" ; ?>>Activé</option> 

							<option value="1" <?php if( $reponse['etat_r_prm']!=0 ) echo "selected" ; ?>>Desactivé</option> 

						</select> 



						</td>

						<td>

							<input type="hidden" name="id" value="<?php echo $reponse['id_r_prm']; ?>" >

							<input name="send_r_prm" type="hidden" class="btnEnregistrer"  value="Enregistrer" />               

								 <a href="#" onclick="formulaire_m<?php echo $ii; ?>.submit()" title="Modifier">

									  <i class="fa fa-floppy-o fa-fw fa-lg"></i>

								 </a> 

						</td>

		</form> 

 

</tr> 





<?php

    }

?>





</tbody>

</table>







      </div>



 