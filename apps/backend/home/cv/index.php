<?php  





  session_start();



if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../index.php");

}  

    



    require_once dirname(__FILE__) . "/../../../../config/config.php";

 



    if (isset($_GET['action']))

        $action = $_GET['action'];

    else

        $action = ""; 

		

    $id_cnadidat    = isset($_GET['candid'])   ? $_GET['candid']      : "";

	

		 

    $sql = mysql_query("SELECT * from candidats where candidats_id = " . $id_cnadidat  . "");

    $reponse = mysql_fetch_array($sql);

	

$a = mysql_num_rows($sql);

	

if ( empty($a)  ) {

    header("Location: ../index.php");

	exit;

}  



	$ariane="Accueil > CV du candidat  ";	

	

	

?>





<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php include ( dirname(__FILE__) . $tempurl2 . "/header_tmp_admin.php"); ?>  

</head>

<body>



<!-- START CONTAINER -->

<div id="container">



<?php     include ( dirname(__FILE__) . $tempurl2 . "/header_admin.php");       ?>



<div id='gauche' > 

<?php

if (strpos($_SESSION['page_courant '],'offres') !== false) {

     include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_offres.php"); 

}elseif (strpos($_SESSION['page_courant '],'candidats') !== false) { 

     include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_candidats.php"); 

}elseif (strpos($_SESSION['page_courant '],'candidatures') !== false) {

     include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_candidature.php");  

}

elseif (strpos($_SESSION['page_courant '],'reporting') !== false) {

     include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_reporting.php");  

}

elseif (strpos($_SESSION['page_courant '],'backend') !== false) {

     include ( dirname(__FILE__) . $menuurl2 . "/menu_g_a_accueil.php");  

}



?> 







</div> 







<center>







<div id='content_d' style="width:720px;">  







			<div class='texte'>



					<h1>CV DU CANDIDAT</h1>

						 <div class="subscription" style="margin: 10px 0pt;">  

                                    <div style=" float: right; margin: -5px 10px 0px 0px;">

                                     <a href="<?php echo $_SESSION['page_courant ']; ?>" style=" border-bottom: none; ">

                                            <img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>

                                    </a>

                                    </div> 

                            </div>



				 



					<table border="0" width="100%">

					<tr>

					  <td class="subscription" style="width:50%"><h1>Informations : </h1></td>

					  <td class="subscription" style="width:50%"><h1> </h1></td>

					</tr>

					<tr>

					  <td>

					  <ul>

						

						<li style="list-style-type: none;"><i class="fa fa-plus"></i><span class="Style2"> Titre du CV</span> :

						<b><?php echo $reponse['titre'];?></b>

						</li>

						<li style="list-style-type: none;"><i class="fa fa-plus"></i><span class="Style2"> Situation actuelle</span> :

						<b><?php 

						  $requet0=mysql_query("select * from prm_situation where id_situ= ".$reponse['id_situ']." "); 

						  if($requet0){ 

						  $resutl0=mysql_fetch_assoc($requet0) ;   echo $resutl0['situation'];

						  }?></b>

						</li>

						<li style="list-style-type: none;">

						  <i class="fa fa-plus"></i><span class="Style2"> Fonctions souhaités</span> :

						<b><?php

						$requet11=mysql_query("select * from prm_fonctions where id_fonc= ".$reponse['id_fonc']." "); 

						if($requet11){ 

						$result11=mysql_fetch_assoc($requet11) ;   echo $result11['fonction'];

						}?></b>

						</li>

						<li style="list-style-type: none;">

						  <i class="fa fa-plus"></i><span class="Style2"> Secteur souhaité :</span> :

						<b><?php

						$requet13=mysql_query("select * from prm_sectors where id_sect= ".$reponse['id_sect']." "); 

						if($requet13){ 

						$result13=mysql_fetch_assoc($requet13) ;   echo $result13['FR'];

						}?></b>

						</li>

						<li style="list-style-type: none;"><i class="fa fa-plus"></i><span class="Style2"> Type de formation : </span> :

						<b><?php

						$requet22=mysql_query("select * from prm_type_formation where id_tfor= ".$reponse['id_tfor']." "); 

						if($requet22){ 

						$result22=mysql_fetch_assoc($requet22) ;   echo $result22['formation'];

						}?></b>

						</li>

						<li style="list-style-type: none;"><i class="fa fa-plus"></i><span class="Style2"> Niveau de formation : </span> :

						<b><?php

						$requet23=mysql_query("select * from prm_niv_formation where id_nfor= ".$reponse['id_nfor']." "); 

						if($requet23){ 

						$result23=mysql_fetch_assoc($requet23) ;   echo $result23['formation'];

						}?></b>

						</li>

					  </ul>

					  </td>

					  <td>

						<ul>

						<li style="list-style-type: none;"><i class="fa fa-plus"></i><span class="Style2"> Disponibilité : </span> :

						<b><?php

						$requet16=mysql_query("select * from prm_disponibilite where id_dispo= ".$reponse['id_dispo']." "); 

						if($requet16){ 

						$result16=mysql_fetch_assoc($requet16) ;   echo $result16['intitule'];

						}?></b>

						</li>

						<li style="list-style-type: none;">

						  <i class="fa fa-plus"></i><span class="Style2"> Salaire souhaité :</span> :

						<b><?php

						$requet14=mysql_query("select * from prm_salaires where id_salr= ".$reponse['id_salr']." "); 

						if($requet14){ 

						$result14=mysql_fetch_assoc($requet14) ;   echo $result14['salaire'];

						}?></b>

						</li>

						<li style="list-style-type: none;">

						  <i class="fa fa-plus"></i><span class="Style2"> Situation actuelle : </span> :

						<b><?php

						$requet15=mysql_query("select * from prm_situation where id_situ= ".$reponse['id_situ']." "); 

						if($requet15){ 

						$result15=mysql_fetch_assoc($requet15) ;   echo $result15['situation'];

						}?></b>

						</li>

						<li style="list-style-type: none;"><i class="fa fa-plus"></i><span class="Style2"> Cv crée le </span> :

						<b><?php echo ''.date("d/m/Y", strtotime($reponse['date_inscription'])).''; ?></b>

						</li>

						<li style="list-style-type: none;"><i class="fa fa-plus"></i><span class="Style2"> Mise à jour le </span> :

						<b><?php echo ''.date("d/m/Y", strtotime($reponse['last_connexion'])).'';?></b>

						</li>

						<?php

						$requet17=mysql_query("select * from prm_mobi_niv where id_mobi_niv= ".$reponse['niveau_mobilite']." ");

						$requet18=mysql_query("select * from prm_mobi_taux where id_mobi_taux= ".$reponse['taux_mobilite']." "); 

						if($requet17){ 

						$result17=mysql_fetch_assoc($requet17) ;

						}

						if($requet18){ 

						$result18=mysql_fetch_assoc($requet18) ;

						} ?>

						<li style="list-style-type: none;"><i class="fa fa-plus"></i><span class="Style2"> Mobilit&eacute;</span> :

						<b><?php if($reponse['mobilite']=='non'){

						echo $reponse['mobilite']; }else if($reponse['mobilite']=='oui'){

						echo ''.$reponse['mobilite'].'&nbsp;|&nbsp;'.$result17['niveau'].'&nbsp;|&nbsp; '.$result18['taux'].''; }?></b>

						</li>

						</ul>

					  </td>

					</tr>

					</table>

					

					

					

					

					<br/>

					<div class="ligneBleu"></div>

					<br/>

					

					

					

					

					<table border="0" width="100%">

					<thead>

					  <tr>



						<td class="subscription" style="width:88%"><h1>CV : </h1></td>



						<td class="subscription" ><h1>Photo</h1></td>



					  </tr>

					</thead>

					<tbody>

					  <?php 

				  $requetcv=mysql_query("select * from cv where actif='1' and candidats_id='$id_cnadidat'");

				  $cvnbr=mysql_num_rows($requetcv);

				  $requetlettre=   mysql_query("select * from lettres_motivation where candidats_id = '". $id_cnadidat."'  AND actif=1");

				  $nbr=mysql_num_rows($requetlettre);

			   $i=1;

					while($resutcv=mysql_fetch_assoc($requetcv))

					{

					$id_cv=$resutcv['id_cv'];

					$lien_cv=$resutcv['lien_cv'];

					}

					while($resutlettre=mysql_fetch_assoc($requetlettre))

					{

					$id_lettre=$resutlettre['id_lettre'];

					$lien_lettre=$resutlettre['lettre']; }

				  ?>



					 

					<tr>

						



						<td >

						<?php

						$requet12=mysql_query("select * from prm_civilite where id_civi= ".$reponse['id_civi']." "); 

						if($requet12){ 

						$result12=mysql_fetch_assoc($requet12) ;

						}?>

						<ul>

						

						  <li style="list-style-type: none;">

							<i class="fa fa-user"></i> 

						<b><?php echo $result12['civilite'].'&nbsp;'.$reponse['prenom'] . '&nbsp;' . $reponse['nom']; ?></b>

						  </li>



						  <li style="list-style-type: none;"><i class="fa fa-envelope"></i>

							<span class="Style2">E-mail</span> :<a href="mailto:<?php echo $reponse['email']; ?>">

							  <b><?php echo $reponse['email']; ?></b></a>

						  </li>

						  <li style="list-style-type: none;"><i class="fa fa-phone"></i>

                <span class="Style2">Télephone</span> : 

                <b><?php echo ''.$reponse['tel1'].'&nbsp;';

                if($reponse['tel2'] ==''){} else {echo '|&nbsp;'.$reponse['tel2'].'';  }?></b>

              </li>

						  <li style="list-style-type: none;"><i class="fa fa-plus"></i>

							<span class="Style2">Adresse</span> :

						<b><?php echo $reponse['adresse'];?></b>

						  </li>

						  <li style="list-style-type: none;"><i class="fa fa-plus"></i>

							<span class="Style2">Ville</span> :

						<b><?php echo $reponse['ville'];?></b>

						  </li>

						  <?php

						$requet19=mysql_query("select * from prm_pays where id_pays= ".$reponse['id_pays']." "); 

						if($requet19){ 

						$result19=mysql_fetch_assoc($requet19) ;

						}?>

						  <li style="list-style-type: none;"><i class="fa fa-plus"></i>

							<span class="Style2">Pays de résidance</span> :

							<b><?php echo $result19['pays'];?></b>

						  </li>

						  <li style="list-style-type: none;"><i class="fa fa-plus"></i>

							<span class="Style2">Nationalité</span> :

							<b><?php echo $reponse['nationalite'];?></b>

						  </li>

						   <?php

						$requet20=mysql_query("select * from prm_experience where id_expe= ".$reponse['id_expe']." "); 

						if($requet20){ 

						$result20=mysql_fetch_assoc($requet20) ;

						}?>

						  <li style="list-style-type: none;"><i class="fa fa-plus"></i>

							<span class="Style2">Durée d'expérience</span> :

							<b><?php echo $result20['intitule'];?></b>

						  </li>

						</ul>



						</td>



						<td>

						

						<?php $req = mysql_query("select * from  candidats where candidats_id = '" . $reponse['candidats_id'] . "'");

						$rep = mysql_fetch_array($req); 

								           $photo_cand      = (!empty($reponse['photo']) OR $reponse['photo']!="")      ? $reponse['photo']      : "";   

			echo '<img src="'.$url_photo_candidat.$photo_cand.'" alt="Image not found" onError="this.onerror=null;this.src=\''.$url_photo_candidat.'default/photo.gif\';"   width="100" height="120"  />'	?></li>

						

							<span class="Style2">Date de naissance  <b><?php echo ''.$reponse['date_n'].'';?></b></span>  

							

						  </td>

					  </tr>

					  

					  </tbody>

					</table>



					<table border="0" width="100%">

					<thead>

					  <tr>



						<td class="subscription" style="width:88%"><h1>FORMATIONS</h1></td>



						<td class="subscription" ><h1></h1></td>



					  </tr>

					</thead>

					<tbody>

					<tr>

					  <table border="0" width="100%">

						<thead>

						<tr>



						  <td style="width:22%"></td>

						  <td></td>



						</tr>

						</thead>

						<tbody>

						<?php 



						 $formation=mysql_query("select * from formations where candidats_id= ".$reponse['candidats_id']." order by date_fin desc");

						 $count = mysql_num_rows($formation);



						 ?>

						 <tr>

									  <td>

										<?php if($count<1){?>

						<center style="color: #C33;">aucune formations trouvée</center>

						<?php }?>

									  </td>

									</tr><tr><td><br/></td></tr>

						<?php 

						 while ($resultatform = mysql_fetch_array($formation)) {

						$req_03 = mysql_query( "SELECT * FROM prm_ecoles where id_ecole=".$resultatform['id_ecol']." ");    

						$r03 = mysql_fetch_array( $req_03 ) ; 

						if ($resultatform['id_ecol']!='290') { $type=$r03['nom_ecole'];} else {$type=$resultatform['ecole'];}

						$ecole=mysql_query("select * from prm_ecoles where id_ecole= ".$resultatform['id_ecol']." "); 

						if($ecole){ 

						$resultecole=mysql_fetch_assoc($ecole) ;}

						$paysecole=mysql_query("select * from prm_pays where id_pays= ".$resultecole['id_pays']." "); 

						if($paysecole){ 

						$resultpaysecole=mysql_fetch_assoc($paysecole) ;}

						$nivformation=mysql_query("select * from prm_niv_formation where id_nfor= ".$resultatform['nivformation']." "); 

						if($nivformation){ 

						$resultnivformation=mysql_fetch_assoc($nivformation) ;}

						 

						$req_theme = mysql_query("SELECT * FROM prm_filieres where id_fili= ".$resultatform['diplome']." "); 

						  while ($data = mysql_fetch_array($req_theme)) {      $filiere = $data['filiere'];			}

///////////////////////////////////////////////////





$month_df=$month_dd=$m_df=$year_df="";                

$orderdate_dd = explode('/', $resultatform['date_debut']); 

 

$month_dd=(empty($orderdate_dd[2])) ? $orderdate_dd[0] : $orderdate_dd[1];

$year_dd=(empty($orderdate_dd[2])) ? $orderdate_dd[1] : $orderdate_dd[2];

          

                        

if(!empty($resultatform['date_fin'])){

$orderdate_df = explode('/', $resultatform['date_fin']);



$month_df=(empty($orderdate_df[2])) ? $orderdate_df[0] : $orderdate_df[1];

$year_df=(empty($orderdate_df[2])) ? $orderdate_df[1] : $orderdate_df[2];



 

}

/*echo $resultatform['date_fin'];*/

$m_dd=$m_df='';

switch( $month_dd){case '01': $m_dd='Janvier';break;case '02': $m_dd='Février';break;case '03': $m_dd='Mars';break;

case '04': $m_dd='Avril';break;case '05': $m_dd='Mai';break;case '06': $m_dd='Juin';break;case '07': $m_dd='Juillet';break;

case '08': $m_dd='Août';break;case '09': $m_dd='Septembre';break;case '10': $m_dd='Octobre';break;case '11': $m_dd='Novembre';break;

case '12': $m_dd='Décembre';break;}



switch( $month_df){case '01': $m_df='Janvier';break;case '02': $m_df='Février';break;case '03': $m_df='Mars';break;

case '04': $m_df='Avril';break;case '05': $m_df='Mai';break;case '06': $m_df='Juin';break;case '07': $m_df='Juillet';break;

case '08': $m_df='Août';break;case '09': $m_df='Septembre';break;case '10': $m_df='Octobre';break;case '11': $m_df='Novembre';break;

case '12': $m_df='Décembre';break;}

///////////////////////////////////////////////////////////

						?>

						

						

						<tr>

						  <td><b><?php echo $m_dd .' '.$year_dd."";

              				if(empty($resultatform['date_fin'])){echo " - Aujourd'hui";}

                                        else{echo " - ".$m_df .' '.$year_df;} ?></b></td>

						  <!--

						  <td><b><?php echo ''.$resultatform['date_debut'].'&nbsp; - &nbsp;'.$resultatform['date_fin'].'';?></b></td>

						  -->

						  <td>

						  <ul>

						  <li style="list-style-type: none;"><b><?php echo $filiere.'&nbsp; - &nbsp;'.$resultnivformation['formation'].'';?></b></li>

						  <li style="list-style-type: none;">

						  <span><?php echo ''.$type.'&nbsp;|&nbsp;'.$resultpaysecole['pays'].'';?></span></li>

						  

						  </ul><br/>

						  </td>

						</tr>

						<?php }?>

						</tbody>

					  </table>

					</tr>

					</tbody>

					</table>



					<table border="0" width="100%">

					<thead>

					  <tr>



						<td class="subscription" style="width:88%"><h1>EXPERIENCES</h1></td>



						<td class="subscription" ><h1></h1></td>



					  </tr>

					</thead>

					<tbody>

					<tr>

					  <table border="0" width="100%">

						<thead>

						<tr>



						  <td style="width:22%"></td>

						  <td></td>



						</tr>

						</thead>

						<tbody>

						<?php 



						 $experience=mysql_query("select * from experience_pro where candidats_id= ".$reponse['candidats_id']." order by date_fin desc"); 

						  $countexp = mysql_num_rows($experience);

					 ?>

						 <tr>

									  <td >

										<?php if($countexp<1){?>

						<center style="color: #C33;">Aucune expérience trouvée</center>

						<?php }?>

									  </td>

									</tr><tr><td><br/></td></tr>

						<?php 

						 while ($resultat = mysql_fetch_array($experience)) {



						$secteur=mysql_query("select * from prm_sectors where id_sect= ".$resultat['id_sect']." "); 

						if($secteur){ 

						$resultexteur=mysql_fetch_assoc($secteur) ;}

						$fonction=mysql_query("select * from prm_fonctions where id_fonc= ".$resultat['id_fonc']." "); 

						if($fonction){ 

						$resultfonction=mysql_fetch_assoc($fonction) ;}

						$typeposte=mysql_query("select * from prm_type_poste where id_tpost= ".$resultat['id_tpost']." "); 

						if($typeposte){ 

						$resulttypeposte=mysql_fetch_assoc($typeposte) ;}

						$payseexp=mysql_query("select * from prm_pays where id_pays= ".$resultat['id_pays']." "); 

						if($payseexp){ 

						$resultpayseexp=mysql_fetch_assoc($payseexp) ;}



$expdate_dd = explode('/', $resultat['date_debut']); 

 

$expemonth_dd=(empty($expdate_dd[2])) ? $expdate_dd[0] : $expdate_dd[1];

$expyear_dd=(empty($expdate_dd[2])) ? $expdate_dd[1] : $expdate_dd[2];

          

                        

if(!empty($resultat['date_fin'])){

$experdate_df = explode('/', $resultat['date_fin']);



$expmonth_df=(empty($experdate_df[2])) ? $experdate_df[0] : $experdate_df[1];

$expyear_df=(empty($experdate_df[2])) ? $experdate_df[1] : $experdate_df[2];

}

/*

$expdate_dd = explode('/', $resultat['date_debut']); 

$expday_dd  = $expdate_dd[0];$expemonth_dd = $expdate_dd[1]; $expyear_dd  = $expdate_dd[2];



$expemonth_dd=$expmonth_df='';

if(!empty($resultat['date_fin'])){

$experdate_df = explode('/', $resultat['date_fin']); 

$expday_df  = $experdate_df[0];$expmonth_df = $experdate_df[1]; $expyear_df  = $experdate_df[2];

$expemonth_dd=$expmonth_df='';

}

*/





switch( $expemonth_dd){case '01': $m_dd='Janvier';break;case '02': $m_dd='Février';break;case '03': $m_dd='Mars';break;

case '04': $m_dd='Avril';break;case '05': $m_dd='Mai';break;case '06': $m_dd='Juin';break;case '07': $m_dd='Juillet';break;

case '08': $m_dd='Août';break;case '09': $m_dd='Septembre';break;case '10': $m_dd='Octobre';break;case '11': $m_dd='Novembre';break;

case '12': $m_dd='Décembre';break;}



switch( $expmonth_df){case '01': $m_df='Janvier';break;case '02': $m_df='Février';break;case '03': $m_df='Mars';break;

case '04': $m_df='Avril';break;case '05': $m_df='Mai';break;case '06': $m_df='Juin';break;case '07': $m_df='Juillet';break;

case '08': $m_df='Août';break;case '09': $m_df='Septembre';break;case '10': $m_df='Octobre';break;case '11': $m_df='Novembre';break;

case '12': $m_df='Décembre';break;}



	

						?>

						<tr>

						  <td><b><?php echo $expday_dd.' '.$m_dd .' '.$expyear_dd."";

              				if(empty($resultat['date_fin'])){echo " - Aujourd'hui";}

                                        else{echo " - ".$expday_df." ".$m_df .' '.$expyear_df;} ?></b></td>

						  <!--<td><b><?php echo ''.$resultat['date_debut'].'&nbsp; - &nbsp;'.$resultat['date_fin'].'';?></b></td>-->

						  <td>

						  <ul>

						  <li style="list-style-type: none;"><b><?php echo ''.$resultat['poste'].'&nbsp;|&nbsp;'.$resultat['entreprise'].'&nbsp;|&nbsp;'.$resultat['ville'].'';?></b></li>

						  <li style="list-style-type: none;"><?php echo ''.$resultexteur['FR'].'&nbsp;|&nbsp;'.$resultfonction['fonction'].'';?></li>

						  <li style="list-style-type: none;"><?php echo ''.$resulttypeposte['designation'].'&nbsp;|&nbsp;'.$resultpayseexp['pays'].'';?></li>

						  </ul><br/>

						  </td>

						</tr>

						<?php }?>

						</tbody>

					  </table>

					</tr>

					</tbody>

					</table>

					

					<table border="0" width="100%">

					<thead>

					  <tr>



						<td class="subscription" style="width:50%"><h1>LANGUES</h1></td>



						<td class="subscription" style="width:50%"><h1></h1></td>



					  </tr>

					</thead>

					<tbody>

					<tr>

					  <td>

						

						<ul>

						<li style="list-style-type: none;">  

						<?php if($reponse['arabic'] == ''){}else{echo  '<i class="fa fa-plus"></i>  '.'Arabe &nbsp;('.$reponse['arabic'].')';} ?>

						</li>

						  <li style="list-style-type: none;"> 

						  <?php if($reponse['french'] ==''){}else{echo  '<i class="fa fa-plus"></i>  '.'Français &nbsp;('.$reponse['french'].')';} ?>

						  </li>

						  <li style="list-style-type: none;"> 

						  <?php if($reponse['english'] ==''){}else{echo  '<i class="fa fa-plus"></i>  '.'Anglais &nbsp;('.$reponse['english'].')';} ?>

						  </li>

						 

						</ul>

						

					  </td>

					  <td>

						<ul>

						   <li style="list-style-type: none;">

						<?php if($reponse['autre'] == ''){}else{echo  '<i class="fa fa-plus"></i>  '.$reponse['autre'] .'&nbsp;('.$reponse['autre_n'] .')';} ?>

						</li>

						  <li style="list-style-type: none;">

						  <?php if($reponse['autre1'] ==''){}else{echo  '<i class="fa fa-plus"></i>  '.$reponse['autre1'] .'&nbsp;('.$reponse['autre1_n'] .')';} ?>

						  </li>

						  <li style="list-style-type: none;">

						  <?php if($reponse['autre2'] ==''){}else{echo  '<i class="fa fa-plus"></i>  '.$reponse['autre2'] .'&nbsp;('.$reponse['autre2_n'] .')';} ?>

						  </li>

						</ul>

					  </td>

					</tr>

					</tbody>

					</table>





			<br/>

			<div class="ligneBleu"></div>

			<br/>



			   

					<table border="0" width="100%">

					<tr>

					  <td class="subscription" style="width:50%"><h1>Fichiers joints : </h1></td>

					  <td class="subscription" style="width:50%"><h1> </h1></td>

					</tr>

					<tr>

					

				   <tr>  

					  <td style="vertical-align:top;">

					  <label>CVs </label> <br/>  

					

					<br/> 

				  <?php 

				  $requet=mysql_query("select * from cv where actif='1' and candidats_id='$id_cnadidat'");

				  $cvnbr=mysql_num_rows($requet);

				  if($requet)

				  {

				  

				  ?>



				  <table class='cvs'>

						 

				  <?php 

			   $i=1;

					while($resutl=mysql_fetch_assoc($requet))

					{

					$id_cv=$resutl['id_cv'];

					$lien_cv=$resutl['lien_cv'];  

				  ?>

			   <tr>

			   <td  class="cvlettre" id="sup_cv0_<?php echo $id_cv; ?>" >

				  <?php 

				  

				  /*

				  echo '<a href="'.$urladmin.'/cv/dcv/?cv='.$lien_cv.'"><i class="fa fa-download fa-lg" ></i></a>';*/



				  echo '<a   href="'.$urladmin.'/cv/dcv/?cv='.$lien_cv.'&id_candidat='.$reponse['candidats_id'].'&id_cv='.$id_cv.'  "   onclick="showUser()"><i class="fa fa-download fa-lg" ></i></a>';

				  

				  $principal=$resutl['principal'];

				  if($principal!=true)

					{ 

					 // echo '&nbsp;&nbsp;<a href="#lettre_cvs" rel="'.$id_cv.'" class="supprimer_cv" id="cv_'.$id_cv.'" ><img src="'.$imgurl.'/icons/delete.png" alt="Supprimer" title="Supprimer "/></a>';

					  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

					  echo '<input name="principal" type="radio" value="'.$id_cv.'" class="radio_principal" title="Rendre principal" disabled />';

					   

					}

				  else

					{

					// echo '&nbsp;&nbsp;<a href="#lettre_cvs" rel="'.$id_cv.'" class="supprimer_cv" id="cv_'.$id_cv.'" ><img src="'.$imgurl.'/icons/delete.png" alt="Supprimer" title="Supprimer "/></a>';

					 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

					  echo '<input name="principal" type="radio" value="'.$id_cv.'" checked class="radio_principal" title="Rendre principal" disabled />';

					  

					} 

			   ?>

			   </td>

				  

			   <td id="sup_cv_<?php echo $id_cv; ?>"><?php echo "CV".$i.": " ;?></td>

			   <td id="sup_cv1_<?php echo $id_cv; ?>"><?php if(strlen($resutl['titre_cv'])>15) echo substr($resutl['titre_cv'],0,15).".." ; else echo $resutl['titre_cv'];?></td>

				

			   </tr>

			   <?php  

					$i++;   

					} 

					 

					?>

					

					

					</table>

				  <?php

			   }



			  ?>

			  

			  

					</td>

					<td style="vertical-align:top;">

			  

			  

			  

			  <?php 



				  $requet=   mysql_query("select * from lettres_motivation where candidats_id = '". $id_cnadidat."'  AND actif=1");

				  $nbr=mysql_num_rows($requet);

				  if($requet)

				  {

				  ?>

			<label>Lettre de motivation</label> <br/>

				  

				  <br /> 

				  <table class='cvs'>

						 

				  <?php 

			   $i=1;

					while($resutl=mysql_fetch_assoc($requet))

					{

					$id_cv=$resutl['id_lettre'];

					$lien_cv=$resutl['lettre']; 

				  ?>

			   <tr>

			   <td class="cvlettre" id="sup_lettre_<?php echo $id_cv; ?>" >

				  <?php 

				  

				  echo '<a href="'.$urladmin.'/cv/dlm/?cv='.$lien_cv.'"><i class="fa fa-download fa-lg" ></i></a>';

				  

				  $principal=$resutl['principal'];

				  if($principal==true)

					{ 

				   //   echo '&nbsp;&nbsp;<a href="#lettre_cvs" rel1="'.$id_cv.'" class="supprimer_lettre" id="lettre_'.$id_cv.'" ><img src="'.$imgurl.'/icons/delete.png" alt="Supprimer" title="Supprimer "/></a>';

					 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

					  echo '<input name="principal1" type="radio" value="'.$id_cv.'" checked class="radio_principal1" title="Rendre principale" disabled />';

					  

					}

				  else

					{

					 // echo '&nbsp;&nbsp;<a href="#lettre_cvs" rel1="'.$id_cv.'" class="supprimer_lettre" id="lettre_'.$id_cv.'" ><img src="'.$imgurl.'/icons/delete.png" alt="Supprimer" title="Supprimer " /></a>';

						 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

					  echo '<input name="principal1" type="radio" value="'.$id_cv.'" class="radio_principal1" title="Rendre principale" disabled />';

					  

					} 

			   ?>

			   </td>

			   <td id="sup_lettre0_<?php echo $id_cv; ?>" ><?php echo "Lettre".$i.": " ;?></td>

			   <td id="sup_lettre1_<?php echo $id_cv; ?>" ><?php if(strlen($resutl['titre'])>15) echo substr($resutl['titre'],0,15).".." ; else echo $resutl['titre'];?></td>

			   </tr>

			   <?php  

					$i++;   

					}

					  

				  

					?>

					</table>

				  <?php

			   }



			  ?>

			  

					</td>

			  </tr>



					</tbody>

					</table>

				



			<br/>

			<div class="ligneBleu"></div>

			<br/>

					

			</div>



 



</div> 

</div>	  



</center>





<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_admin.php"); ?> 



<?php include ( dirname(__FILE__) . $tempurl2 . "/footer_tmp_admin.php"); ?>











</body>

</html> 	  