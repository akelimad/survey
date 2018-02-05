<?php 



function IsChecked($chkname,$value)

    {

        if(!empty($_POST[$chkname]))

        {

            foreach($_POST[$chkname] as $chkval)

            {

                if($chkval == $value)

                {

                    return true;

                }

            }

        }

        return false;

    }

?> 

<style type="text/css"   >

#addrole tr td{width:50%;height:20px;}

input{width:200px;}

select{width:206px;}

.btn{width:70px;}

.erreur{color:red;}

.success{color:green;}

</style>	

<br/>

   <H1>GESTION DES PERMISSIONS</H1>

<!--	##############################################	-->

<div class="subscription" style="margin: 10px 0pt;">

                                 <h1>LA LISTE DES PERMISSIONS </h1>

                          </div>

      <div class='texte' style="width:720px">

<table width="100%" border="1">

	

	  

	

  <tr bgcolor="#F7F7F7">

    <td><div align="center"><strong>Permissions</strong></div></td>

    <td width="10%"><div align="center"><strong>Acceuil</strong></div></td>

    <td width="10%"><div align="center"><strong>Offres</strong></div></td>

    <td width="12%"><div align="center"><strong>Candidats</strong></div></td>

    <td width="14%"><div align="center"><strong>Candidatures</strong></div></td>

    <td width="12%"><div align="center"><strong>Reporting</strong></div></td>

    <td width="14%"><div align="center"><strong>Courriers</strong></div></td>

    <td width="8%"><div align="center"><strong>Admin</strong></div></td>

    <td style=" padding: 5px 0; "><div align="center"><strong>Action</strong></div></td>

  </tr>

 <?php

							

							$req_theme = mysql_query("select * from root_type_role");$jj=0;

							while ($data = mysql_fetch_array($req_theme)) {

								$role_id = $data['id_type_role'];

								$role_l = $data['role'];

																

										

										$req_permission = mysql_query("select * from root_permission where id_role=$role_id ");

										$donne1 = mysql_fetch_assoc($req_permission);

										

                                                            ?> 



<form id="g_roles" name="formulaire<?php echo ++$jj; ?>" method="post" action="">

	

<tr bgcolor="#F7F7F7">

    <td style=" padding-left: 5px; "><input name="ID_ROLE" id="ID_ROLE" type="hidden" value="<?php echo $role_id; ?> " /><?php echo $role_l; ?> </td>

    <td>

      <div align="center">

        <input type="checkbox" name="menu[]" value="menu1" <?php if ($donne1['menu1']=="1" ) echo "checked"; ?> style="width: 20px;" disabled="true" />

      </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu[]" value="menu2" <?php if ($donne1['menu2']=="1") echo "checked"; ?> style="width: 20px;" />

    </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu[]" value="menu3" <?php if ($donne1['menu3']=="1") echo "checked"; ?> style="width: 20px;" />

    </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu[]" value="menu4" <?php if ($donne1['menu4']=="1") echo "checked"; ?> style="width: 20px;" />

    </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu[]" value="menu5" <?php if ($donne1['menu5']=="1") echo "checked"; ?> style="width: 20px;" />

    </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu[]" value="menu6" <?php if ($donne1['menu6']=="1") echo "checked"; ?> style="width: 20px;" />

    </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu[]" value="menu7" <?php if ($donne1['menu7']=="1") echo "checked"; ?> style="width: 20px;" <?php if( $role_l =='Administrateur' ) echo  'disabled="true"'; ?> />

    </div></td>

    <td>

      <div align="center"><input type="hidden" name="Sauvegarder" id="Sauvegarder" title="Enregistrer" value="" class="imgClass" />

       <a href="javascript:void(0)" onclick="formulaire<?php echo $jj; ?>.submit()" title="Enregistrer" >

       <i class="fa fa-floppy-o fa-fw fa-2x"></i> </a>

	  </div></td>

</tr>

  

</form>

  

 <?php

                                                            }

                                                            ?> 

  

  

</table>





<?php





if (isset($_POST['Sauvegarder']) ){



$miseajours1="menu1=1";



if(IsChecked('menu','menu2'))

{ 

$miseajours2="menu2=1";

}

else $miseajours2="menu2=0";



if(IsChecked('menu','menu3'))

{ 

$miseajours3="menu3=1";

}

else $miseajours3="menu3=0";



if(IsChecked('menu','menu4'))

{ 

$miseajours4="menu4=1";

}

else $miseajours4="menu4=0";



if(IsChecked('menu','menu5'))

{ 

$miseajours5="menu5=1";

}

else $miseajours5="menu5=0";



if(IsChecked('menu','menu6'))

{ 

$miseajours6="menu6=1";

}

else $miseajours6="menu6=0";



$id=$_POST['ID_ROLE'];



$sql="UPDATE root_permission SET  ". $miseajours1  ." ,  ". $miseajours2  ." ,  ". $miseajours3  ." ,  ". $miseajours4  ." ,  ". $miseajours5  ." ,  ". $miseajours6  ."  WHERE id_role=' ". $id  ." '";

$result=mysql_query($sql);



if($result){

      echo '<div id="repertoire">



                <div id="fils">



                  <div id="fade"></div>



                  <div class="popup_block"  style="width: 40%; z-index: 999; top: 30%; left: 30%;height:100px; " >



                    <div class="titleBar">

                      <a href="javascript:fermer()">



                      <div class="close" style="cursor: pointer;">close</div>



                      </a> </div>

                              <div id="content" class="content" style="margin-left:10px;height: 45px;">

                           

                              <center><h3>Mise à jour effectuée avec succès</h3></center>

                        </div> </div> </div>	  <meta http-equiv="refresh" content="2;'.$_SERVER['HTTP_REFERER'].'" />   ';

}



else {

echo "ERROR";



}

}



?>



<!--</div>-->

<br/>

		<div class="subscription" style="margin: 10px 0pt;">

                  <h1>Permissions de la rubrique candidatures pour les compte temporaire </h1>

        </div>



<table width="100%" border="1">

	

	  

	

  <tr bgcolor="#F7F7F7">

    <td><div align="center"><strong>Rubrique candidatures </strong></div></td>

    <td width="10%"><div align="center"><strong>Nouvelles<br>candidatures</strong></div></td>

    <td width="10%"><div align="center"><strong>Candidatures<br> en cours</strong></div></td>

    <td width="10%"><div align="center"><strong>Candidatures<br> retenues</strong></div></td>

    <td width="10%"><div align="center"><strong>Candidatures<br> recruté</strong></div></td>

    <td width="10%"><div align="center"><strong>Candidatures<br> non retenues</strong></div></td>

    <td width="10%"><div align="center"><strong>Candidatures<br> spontanées</strong></div></td>

    <td width="10%"><div align="center"><strong>Candidatures<br> pour stage</strong></div></td>

    <td style=" padding: 5px 0; "><div align="center"><strong>Action</strong></div></td>

  </tr>

 

 <?php

							

	  												

			 $role_id = $_SESSION['id_role'];

			 $req_permission = mysql_query("select * from root_permission_c  limit 0,1 ");

			 $donne1_c = mysql_fetch_assoc($req_permission);

										

  ?> 

															

															

<form id="g_roles" name="formulaire<?php echo ++$jj; ?>" method="post" action="">

	

<tr bgcolor="#F7F7F7">

    <td style=" padding-left: 5px; "><input name="id_p_c" id="id_p_c" type="hidden" value="<?php echo $donne1_c['id_p_c']; ?>" />

		Compte temporaire

	</td>

    <td>

      <div align="center">

        <input type="checkbox" name="menu_c[]" value="menu1_c" <?php if ($donne1_c['menu1_c']=="1" ) echo "checked"; ?> style="width: 20px;"   />

      </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu_c[]" value="menu2_c" <?php if ($donne1_c['menu2_c']=="1") echo "checked"; ?> style="width: 20px;" />

    </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu_c[]" value="menu3_c" <?php if ($donne1_c['menu3_c']=="1") echo "checked"; ?> style="width: 20px;" />

    </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu_c[]" value="menu4_c" <?php if ($donne1_c['menu4_c']=="1") echo "checked"; ?> style="width: 20px;" />

    </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu_c[]" value="menu5_c" <?php if ($donne1_c['menu5_c']=="1") echo "checked"; ?> style="width: 20px;" />

    </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu_c[]" value="menu6_c" <?php if ($donne1_c['menu6_c']=="1") echo "checked"; ?> style="width: 20px;" />

    </div></td>

    <td><div align="center">

      <input type="checkbox" name="menu_c[]" value="menu7_c" <?php if ($donne1_c['menu7_c']=="1") echo "checked"; ?> style="width: 20px;"   />

    </div></td>

    <td>

      <div align="center"><input type="hidden" name="Sauvegarder_candidature" id="Sauvegarder_candidature" title="Enregistrer" value="" class="imgClass" />

       <a href="javascript:void(0)" onclick="formulaire<?php echo $jj; ?>.submit()" title="Enregistrer" >

       <i class="fa fa-floppy-o fa-fw fa-2x"></i> </a>

	  </div></td>

</tr>

  

</form>

 

  

  

</table>







<?php





if (isset($_POST['Sauvegarder_candidature']) ){



 



if(IsChecked('menu_c','menu1_c'))

{ 

$miseajours1_c="menu1_c=1";

}

else $miseajours1_c="menu1_c=0";



if(IsChecked('menu_c','menu2_c'))

{ 

$miseajours2_c="menu2_c=1";

}

else $miseajours2_c="menu2_c=0";



if(IsChecked('menu_c','menu3_c'))

{ 

$miseajours3_c="menu3_c=1";

}

else $miseajours3_c="menu3_c=0";



if(IsChecked('menu_c','menu4_c'))

{ 

$miseajours4_c="menu4_c=1";

}

else $miseajours4_c="menu4_c=0";



if(IsChecked('menu_c','menu5_c'))

{ 

$miseajours5_c="menu5_c=1";

}

else $miseajours5_c="menu5_c=0";



if(IsChecked('menu_c','menu6_c'))

{ 

$miseajours6_c="menu6_c=1";

}

else $miseajours6_c="menu6_c=0";





if(IsChecked('menu_c','menu7_c'))

{ 

$miseajours7_c="menu7_c=1";

}

else $miseajours7_c="menu7_c=0";



$id=$_POST['id_p_c'];

$sql="";

 if(empty($id)){ 

 

	$sql ="INSERT INTO `root_permission_c`(  `id_role`, `menu1_c`, `menu2_c`, `menu3_c`, `menu4_c`, `menu5_c`, `menu6_c`, `menu7_c`)

			VALUES ( ". $role_id  ." , ". $miseajours1_c  ." ,  ". $miseajours2_c  ." ,  ". $miseajours3_c  ." ,  ". $miseajours4_c  ." ,  ". $miseajours5_c  ." ,  ". $miseajours6_c  .",  ". $miseajours7_c  ." )";

			

 } else {



	$sql ="UPDATE root_permission_c SET  ". $miseajours1_c  ." ,  ". $miseajours2_c  ." ,  ". $miseajours3_c  ." ,  ". $miseajours4_c  ." ,  ". $miseajours5_c  ." ,  ". $miseajours6_c  ." ,  ". $miseajours7_c  ." 

			WHERE id_p_c='". $id  ."'";

			

 }

 

  /*

 echo "<br>".$sql."<br>";

*/

$result=mysql_query($sql);



	

	 

		if($result){

			  echo '<div id="repertoire">



						<div id="fils">



						  <div id="fade"></div>



						  <div class="popup_block"  style="width: 40%; z-index: 999; top: 30%; left: 30%;height:100px; " >



							<div class="titleBar">

							  <a href="javascript:fermer()">



							  <div class="close" style="cursor: pointer;">close</div>



							  </a> </div>

									  <div id="content" class="content" style="margin-left:10px;height: 45px;">

								   

									  <center><h3>Mise à jour effectuée avec succès</h3></center>

								</div> </div> </div>	  <meta http-equiv="refresh" content="2;'.$_SERVER['HTTP_REFERER'].'" />   ';

		}



		else {

		echo "ERROR";



		}

		

	 



}



?>







<br/>

<div class="ligneBleu"></div>

<br>





<div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Gestion des permissions </h1>

                          </div>

<!--<div style="border: 1px solid black; background-color: #fff; padding: 5px;">-->

<?php ///////////////////////////////////////////////////////////////////////////////////  -d  ?>	



<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="formulaire<?php echo ++$jj; ?>" method="post">

<table  width="100%"  border="0" cellspacing="2" cellpadding="2">

	<tr> 

    <td scope="col" width="10%" style="border:1px solid #FFFFFF;" ><center>Type de profil : </center></td>

    <td scope="col" width="10%" style="border:1px solid #FFFFFF;" >

		<input  type="text" name="type_role" rows="1" cols="50" maxlength="100" title="type de profil" required/>

    </td>

    <td scope="col" width="10%" style="border:1px solid #FFFFFF;">

          <input name="sendAdd_trole" type="hidden" class="btnEnregistrer"  style="width: 90px;" value=" Ajouter " />

        <a href="javascript:void(0)" onclick="formulaire<?php echo $jj; ?>.submit()" title="Ajouter" >

       <i class="fa fa-floppy-o fa-fw fa-2x"></i> </a>

    </td>

    </tr>

</table>

</form>



<?php



if(isset($_POST['type_role']))  $type_role = $_POST['type_role'];

if(isset($_POST['sendAdd_trole']) && $_POST['sendAdd_trole']!=""  && isset($_POST['type_role'])&& $_POST['type_role']!="" )

{

$addSect = mysql_query("INSERT INTO root_type_role (id_type_role,role) VALUES ('','".safe($type_role)."')");

 

	if(!$addSect){

	echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

	$maj=0;

	}else{

	echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';

	

    $sql = "select * from root_type_role ";

	$select = mysql_query($sql);

	

	}

	

    $result = mysql_query("SELECT MAX(id_type_role) FROM root_type_role");

    $row = mysql_fetch_row($result);

    $highest_id = $row[0];  

	

$sqla="INSERT INTO  root_permission VALUES ('','$highest_id', '1', '0', '0', '0', '0', '0', '0' )" ;

$resulta=mysql_query($sqla);

 

   echo '<meta http-equiv="refresh" content="0;'.$_SESSION['page_courant '].'" />';

}

?>



<div class="ligneBleu"></div>

<table width="100%" border="0" cellspacing="0" id="type_profil" class="tablesorter" style="background: none;">

<thead>

	<tr>

		<th scope="col" width="1%" style="border:1px solid #FFFFFF;"></th>

		<th scope="col" width="23%" style="background-color:#C1B3B0;color:white;"><strong>Intitulé</strong></th>

        <th width="8%"colspan="2" style="background-color:#C1B3B0;color:white;"><strong>Actions</strong></th>

	</tr>

</thead>

<tbody>



<?php



if(isset($_POST['id']))  $id	= $_POST['id'];

if(isset($_POST['type_role'])) $type_role = $_POST['type_role'];



if(isset($_POST['send_trole']) && $_POST['send_trole']!="")

{

$update = mysql_query("update root_type_role set role='".safe($type_role)."' where id_type_role='".safe($id)."' ");



	if(!$update){

	echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

	$maj=0;

	}else{

	echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';

	}

 	



   echo '<meta http-equiv="refresh" content="0;'.$_SESSION['page_courant '].'" />';

}



if(isset($_POST['delet_trole']) && $_POST['delet_trole']!="")

{

$delet = mysql_query("delete from root_type_role where id_type_role='$id'");



 mysql_query("delete from root_permission where id_role='$id'");

	if(!$delet){

	echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';

	$maj=0;

	}else{

	echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; supprimer </span>';

	}

   



   echo '<meta http-equiv="refresh" content="0;'.$_SERVER['HTTP_REFERER'].'" />';

}

     ?>

<?php

    $sql = "select * from root_type_role ";

	$select = mysql_query($sql);

	

if((isset($_POST['send_trole']) && $_POST['send_trole']!='') or ( isset($_POST['delet_trole']) && $_POST['delet_trole']!='') or (isset($_POST['sendAdd_trole']) && $_POST['sendAdd_trole']!='') or (isset($_POST['type_role']) && $_POST['type_role']!="" ))

		$select = mysql_query($sql);

	

	while( $reponse = mysql_fetch_array($select) ) {

	if( $reponse['role']=='Administrateur') $reponse = mysql_fetch_array($select);

?>

 <tr   onmouseover="this.className='marked'" onmouseout="this.className=''" >

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire<?php echo ++$jj; ?>">

	<td style="border:1px solid #FFFFFF;"><input type="hidden" name="id" value="<?php echo $reponse['id_type_role']; ?>" ></td>

	<td style="border:1px solid #FFFFFF;"><input  name="type_role" rows="1" cols="50" maxlength="100" value="<?php echo $reponse['role']; ?>"></td>

	<td style="border:1px solid #FFFFFF;">

  <input name="send_trole" type="hidden" class="btnEnregistrer"  title="Enregistrer" value="Enregistrer" />



 <a href="javascript:void(0)" onclick="formulaire<?php echo $jj; ?>.submit()" title="Enregistrer" >

       <i class="fa fa-floppy-o fa-fw fa-lg"></i> </a>

  </td>

 </form>

 <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire<?php echo ++$jj; ?>">

 <?php if($_SESSION['ref_filiale_role'] == '0') { ?>

  

	<td style="border:1px solid #FFFFFF;"><input type="hidden" name="id" value="<?php echo $reponse['id_type_role']; ?>" >

   <input name="delet_trole" type="Hidden" class="btnSupprimer"  title="Supprimer"  value="Supprimer" /> 

<a href="javascript:void(0)" onclick="formulaire<?php echo $jj; ?>.submit()" title="Supprimer" >

       <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i> </a>

   </td>

 <?php } ?>

</form> 

</tr>

<?php

	}

?>

</tbody>

</table>

<div class="ligneBleu"></div>



<?php ///////////////////////////////////////////////////////////////////////////////////  -f  ?>	









</div>						





 