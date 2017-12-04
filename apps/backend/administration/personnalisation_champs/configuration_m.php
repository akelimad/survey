







      <div class='texte'  style="width:720px">



	  <br/><h1>PERSONNALISATION DES CHAMPS</h1>



						  <div class="subscription" style="margin: 10px 0pt;">



                                 <h1>Configuration des variables de site</h1>



                          </div>







<?php







if(isset($_FILES['avatar']['name']))



{



$dossier = dirname(__FILE__) . $file_bnr2;



$fichier = basename($_FILES['avatar']['name']);



$taille_maxi = 10000000;



$taille = filesize($_FILES['avatar']['tmp_name']);



$extensions = array('.png', '.gif', '.jpg', '.jpeg');



$extension = strrchr($_FILES['avatar']['name'], '.'); 



//Début des vérifications de sécurité...



if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau



{



     $erreur = 'Uploader une Bannière de type png, gif, jpg ou jpeg avec dimention(L : 1035  ;  H : 188)';



}



if($taille>$taille_maxi)



{



     $erreur = 'Le fichier est trop gros...';



}



if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload



{



     //On formate le nom du fichier ici...



     $fichier = strtr($fichier, 



          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ', 



          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy_');



     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);



	 echo $fichier;



	 //*



     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...



     {



			chmod($dossier . $fichier, 0666);

          echo 'Upload effectué avec succès !';



     }



     else //Sinon (la fonction renvoie FALSE).



     {



          echo 'Echec de l\'upload !';



     }



	 //*/



}



    



}



if(isset($_FILES['logo']['name']))



{



$dossier5 = dirname(__FILE__) . $file_bnr2;



$fichier5 = basename($_FILES['logo']['name']);



$taille_maxi5 = 10000000;



$taille5 = filesize($_FILES['logo']['tmp_name']);



$extensions5 = array('.png', '.gif', '.jpg', '.jpeg');



$extension5 = strrchr($_FILES['logo']['name'], '.'); 



//Début des vérifications de sécurité...



if(!in_array($extension5, $extensions5)) //Si l'extension n'est pas dans le tableau



{



     $erreur5 = 'Uploader un logo de type png, gif, jpg ou jpeg avec dimention(L : 1035  ;  H : 188)';



}



if($taille5>$taille_maxi5)



{



     $erreur5 = 'Le fichier est trop gros...';



}



if(!isset($erreur5)) //S'il n'y a pas d'erreur, on upload



{



     //On formate le nom du fichier ici...



     $fichier5 = strtr($fichier5, 



          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ', 



          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy_');



     $fichier5 = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier5);



     echo $fichier5;



     //*



     if(move_uploaded_file($_FILES['logo']['tmp_name'], $dossier5 . $fichier5)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...



     {

		

			chmod($dossier5 . $fichier5, 0666);

          echo 'Upload effectué avec succès !';



     }



     else //Sinon (la fonction renvoie FALSE).



     {



          echo 'Echec de l\'upload !';



     }



     //*/



}



    



}



?>







		<?php 











$id					= $reponse['id_config'];



$nom_site     		= (!empty($_POST['nom_site']))?$_POST['nom_site']:$reponse['nom_site'];



$color_bg_body      = (!empty($_POST['color_bg_body']))?  '#'.$_POST['color_bg_body']:$reponse['color_bg_body'];



$color_bg     		= (!empty($_POST['color_bg']))?  '#'.$_POST['color_bg']:$reponse['color_bg'];



$color_bg_menu     		= (!empty($_POST['color_bg_menu']))?  '#'.$_POST['color_bg_menu']:$reponse['color_bg_menu'];



$seo_description    = (!empty($_POST['seo_description']))?$_POST['seo_description']:$reponse['seo_description'];



$seo_keywords 		= (!empty($_POST['seo_keywords']))?$_POST['seo_keywords']:$reponse['seo_keywords'];



	$fb_url         = (isset($_POST['fb_url']))?$_POST['fb_url']:$reponse['fb_url'];



	$tw_url         = (isset($_POST['tw_url']))?$_POST['tw_url']:$reponse['tw_url'];



	$li_url         = (isset($_POST['li_url']))?$_POST['li_url']:$reponse['li_url'];



	$via_url        = (isset($_POST['via_url']))?$_POST['via_url']:$reponse['via_url'];



	$site_url       = (!empty($_POST['site_url']))?$_POST['site_url']:$reponse['site_url'];



	$duree_offres   = (!empty($_POST['duree_offres']))?$_POST['duree_offres']:$reponse['duree_offres'];



	$email_site   = (!empty($_POST['email_site']))?$_POST['email_site']:$reponse['email_site'];



	$banniere  		= (isset($_FILES['avatar']['name']) and basename($_FILES['avatar']['name'])!="") ? $fichier :  $reponse['banniere'];



    $logo       = (isset($_FILES['logo']['name']) and basename($_FILES['logo']['name'])!="") ? $fichier5 :  $reponse['logo'];



    $titre_site           = (!empty($_POST['titre_site']))?$_POST['titre_site']:$reponse['titre_site'];











	



	



if(isset($_POST['send']) and $_POST['send']!="")



{



$sql_up="update root_configuration set nom_site='".safe($nom_site)."',seo_description='".safe($seo_description)."',seo_keywords='".safe($seo_keywords)."',fb_url='".safe($fb_url)."',tw_url='".safe($tw_url)."',li_url='".safe($li_url)."',via_url='".safe($via_url)."',site_url='".safe($site_url)."',banniere='".safe($banniere)."',duree_offres='".safe($duree_offres)."',color_bg_body='".safe($color_bg_body)."',color_bg='".safe($color_bg)."',color_bg_menu='".safe($color_bg_menu)."',logo='".safe($logo)."',titre_site='".safe($titre_site)."' ,email_site='".safe($email_site)."' where id_config='".safe($id)."' ";



 //echo $sql_up;



$update = mysql_query($sql_up);



	if(!$update){



	echo '<span style="color:red"  > Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </span>';



	$maj=0;



	}else{



	echo '<span style="color:green"  > Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </span>';



	$sql = "select * from root_configuration ";



	$select = mysql_query($sql);



	$reponse = mysql_fetch_assoc($select);



	}



echo '<meta http-equiv="refresh" content="0; url=./">';



}















     ?>  



	 



	  <form action="./" method="post"  enctype="multipart/form-data" name="form1"> 







		



		



<table>







	<tr> 



    <td colspan="3" valign="top" >Nom du site  </td>



    <td colspan="9" >



		<input required name="nom_site"   maxlength="50" style="width: 500px;" value="<?php echo $nom_site; ?>">



	</td>



    </tr>



 <tr> 



        <td colspan="3"  valign="top" >Logo  </td>



        <td colspan="9">



             <!-- On limite le fichier à 100Ko -->



             <input type="hidden" name="MAX_FILE_SIZE5" value="100000">



             



             



             <input type="file" name="logo">



        <input type="text" disabled value="<?php echo $logo; ?>">



        </td>     



    </tr>



    <tr> 



    <td colspan="3" valign="top" >Titre du site  </td>



    <td colspan="9" >



        <input required name="titre_site"   maxlength="50" style="width: 500px;" value="<?php echo $titre_site; ?>">



    </td>



    </tr>



	<tr> 



    <td colspan="3" valign="top" >Couleur d’arrière-plan  </td>



    <td colspan="9" > 



	 <input class="color" required name="color_bg_body" value="<?php echo $color_bg_body; ?>"  style= "width: 500px;">



	</td>



    </tr>







	<tr> 



    <td colspan="3" valign="top" >Couleur des bandeaux  </td>



    <td colspan="9" > 



	 <input class="color" required name="color_bg" value="<?php echo $color_bg; ?>"  style= "width: 500px;">



	</td>



    </tr>







	<tr> 



    <td colspan="3" valign="top" >Couleur des menus  </td>



    <td colspan="9" > 



	 <input class="color" required name="color_bg_menu" value="<?php echo $color_bg_menu; ?>"  style= "width: 500px;">



	</td>



    </tr>







	<tr> 



    <td colspan="3" valign="top" >Description SEO  </td>



    <td colspan="9" >



		<textarea required name="seo_description" rows="1" cols="90" maxlength="100" style="    width: 500px;"  ><?php echo $seo_description; ?></textarea>



	</td>



    </tr>







	<tr> 



    <td colspan="3"  valign="top" >Mot clé de SEO   </td>



    <td colspan="9">



		<textarea required name="seo_keywords" rows="1" cols="90" maxlength="100" style="    width: 500px;"  ><?php echo $seo_keywords; ?></textarea>



	</td>



    </tr>







 



	<tr> 



    <td colspan="3"  valign="top" >Lien FaceBook  </td>



    <td colspan="9">



		<textarea  name="fb_url" rows="1" cols="90" maxlength="100" style="    width: 500px;"  ><?php echo $fb_url; ?></textarea>



	</td>



    </tr>







	<tr> 



    <td colspan="3"  valign="top" >Lien Twitter  </td>



    <td colspan="9">



		<textarea  name="tw_url" rows="1" cols="90" maxlength="100" style="    width: 500px;"  ><?php echo $tw_url; ?></textarea>



	</td>



    </tr>







	<tr> 



    <td colspan="3"  valign="top" >Lien LinkedIn  </td>



    <td colspan="9">



		<textarea  name="li_url" rows="1" cols="90" maxlength="100" style="    width: 500px;"  ><?php echo $li_url; ?></textarea>



	</td>



    </tr>







	<tr> 



    <td colspan="3"  valign="top" >Lien Viadeo  </td>



    <td colspan="9">



		<textarea  name="via_url" rows="1" cols="90" maxlength="100" style="    width: 500px;"  ><?php echo $via_url; ?></textarea>



	</td>



    </tr>



 







	<tr> 



    <td colspan="3"  valign="top" >Lien Site  </td>



    <td colspan="9">



		<textarea required name="site_url" rows="1" cols="90" maxlength="100" style="    width: 500px;"  ><?php echo $site_url; ?></textarea>



	</td>



    </tr>







	 	







	<tr> 



    <td colspan="3"  valign="top" >Durée de l’offres (par jours )</td>



    <td colspan="9">



		<textarea required name="duree_offres" rows="1" cols="90" maxlength="100" style="    width: 500px;"  ><?php echo $duree_offres; ?></textarea>



	</td>



	</tr>	



		







	 	







	<tr> 



    <td colspan="3"  valign="top" >Email site</td>



    <td colspan="9">



		<textarea required name="email_site" rows="1" cols="90" maxlength="100" style="    width: 500px;"  ><?php echo $email_site; ?></textarea>



	</td>



	</tr>	



		



	<tr> 



    <td colspan="3"  valign="top" ></td>



    <td colspan="9">



		<br><?php if(isset($erreur)) echo $erreur;?><br>



	</td>



    </tr>



	 



	



	<tr> 



	    <td colspan="3"  valign="top" >Bannière du site  </td>



		<td colspan="9">



			 <!-- On limite le fichier à 100Ko -->



			 <input type="hidden" name="MAX_FILE_SIZE" value="100000">



			 <input type="file" name="avatar">



		<input type="text" disabled value="<?php echo $banniere; ?>">



		</td>	



    </tr>



   



	<tr> 



    <td colspan="3"  valign="top" ></td>



    <td colspan="9">



		<br><br>



	</td>



    </tr>		  















            <tr>







              <td colspan="8"><div class="ligneBleu"></div>







                <input name="send" class="espace_candidat" type="submit" value="Enregistrer les modifications" />







              </td>







            </tr>







          </table>



		







       </form> 











      </div>



 