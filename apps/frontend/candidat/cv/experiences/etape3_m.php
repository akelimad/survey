 

	<div class='texte'>

	

	

<?php	

	

	



$messages_succc=array();

$messages=array();  

//pour experience

$id_candidat = $_SESSION['abb_id_candidat'];

$requeteexperiences28 = mysql_query("SELECT * from experience_pro where candidats_id ='".safe($id_candidat)."' order by id_exp asc ");

$count8 = mysql_num_rows($requeteexperiences28);





$id__e = isset($_POST['id__e']) ? trim($_POST['id__e']) : "";

//$dd_exp = isset($_POST['date_debut']) ? trim($_POST['date_debut']) : "";

$month_dd = isset($_POST['mois_debut_experience']) ? trim($_POST['mois_debut_experience']) : "";

$year_dd = isset($_POST['anne_debut_experience']) ? trim($_POST['anne_debut_experience']) : "";

$dd_exp= (!empty($month_dd) and !empty($year_dd)) ? "01/".$month_dd."/".$year_dd : "";

//$dd_exp = htmlspecialchars($dd_exp, ENT_QUOTES);



//$df_exp = isset($_POST['date_fin']) ? trim($_POST['date_fin']) : "";

$month_df = isset($_POST['mois_fin_experience']) ? trim($_POST['mois_fin_experience']) : "";

$year_df =isset($_POST['anne_fin_experience']) ? trim($_POST['anne_fin_experience']) : "";

$df_exp= (!empty($month_df) and !empty($year_df)) ? "01/".$month_df."/".$year_df : "";

//$df_exp = htmlspecialchars($df_exp, ENT_QUOTES);



$today= isset($_POST['todayexp']) ? trim($_POST['todayexp']) : "";

if($today == 'oui'){$df_exp='';}



$entreprise = isset($_POST['entreprise']) ? trim($_POST['entreprise']) : "";

//$entreprise = htmlspecialchars($entreprise, ENT_QUOTES);

$poste = isset($_POST['poste']) ? trim($_POST['poste']) : "";

//$poste = htmlspecialchars($poste, ENT_QUOTES);

$secteur = isset($_POST['sector']) ? $_POST['sector'] : "";

$fonction_exp = isset($_POST['fonction_exp']) ? $_POST['fonction_exp'] : "";

$type_poste = isset($_POST['type_poste']) ? $_POST['type_poste'] : "";

$ville_exp = isset($_POST['ville_exp']) ? trim($_POST['ville_exp']) : "";

//$ville_exp = htmlspecialchars($ville_exp, ENT_QUOTES);

$pays_exp = isset($_POST['pays_exp']) ? $_POST['pays_exp'] : "";

$salair_pecu = isset($_POST['salair_pecu']) ? $_POST['salair_pecu'] : "";

$desc_exp = isset($_POST['description_poste']) ?  $_POST['description_poste'] : "";



if (isset($_POST['ok']) AND isset($_POST['id']) AND ($_POST['id']!='') ) {

			 $dd_exp =  $experience1['date_debut'];

			 $df_exp =  $experience1['date_fin'];

			 $entreprise =  $experience1['entreprise'];

			 $poste =  $experience1['poste'];

			 $secteur =  $experience1['id_sect'];

			 $type_poste =  $experience1['id_tpost'];

			 $ville_exp =  $experience1['ville'];

			 $pays_exp =  $experience1['id_pays'];

			 $desc_exp =  $experience1['description'];

			 $fonction_exp =  $experience1['id_fonc'];

			 $salair_pecu =  $experience1['salair_pecu'];

}



$msg = '';

if(!empty($dd_exp) and !empty($df_exp)){

$orderdate_dd = explode('/', $dd_exp); 

$month_dd=(empty($orderdate_dd[2])) ? $orderdate_dd[0] : $orderdate_dd[1];

$year_dd=(empty($orderdate_dd[2])) ? $orderdate_dd[1] : $orderdate_dd[2];



$orderdate_dd = explode('/', $df_exp); 

$month_df=(empty($orderdate_dd[2])) ? $orderdate_dd[0] : $orderdate_dd[1];

$year_df=(empty($orderdate_dd[2])) ? $orderdate_dd[1] : $orderdate_dd[2];



if ($year_dd > $year_df )

  $msg .= "<ul><li style='color:#FF0000'>L'année de la date de début est supérieure à la date fin</li></ul>";



elseif ($month_dd > $month_df and $year_dd == $year_df)

  $msg .= "<ul><li style='color:#FF0000'>Le mois de la date de début est supérieure à la date fin</li></ul>";



}



if(!empty($msg))

  array_push($messages, '<div class="alert alert-error">'.$msg.'</div>' );



if (isset($_POST['envoi'])) {

	

	if (!((empty($dd_exp)) AND (empty($df_exp))  AND (empty($entreprise))  AND (empty($poste))  AND (empty($secteur))  AND (empty($type_poste))  AND (empty($ville_exp))  AND (empty($pays_exp))  AND (empty($desc_exp)) AND (empty($salair_pecu))     ) ){	

		

      $id_candidat = $_SESSION['abb_id_candidat'];  



         $last_connexion = date('Y-m-d');                  

                       



		/////	===================================================    experience_pro					

				



			 $dd_exp = addslashes($dd_exp);

			 $df_exp = addslashes($df_exp);

			 $entreprise = addslashes($entreprise);

			 $poste = addslashes($poste);

			 $secteur = addslashes($secteur);

			 $type_poste = addslashes($type_poste);

			 $ville_exp = addslashes($ville_exp);

			 $pays_exp = addslashes($pays_exp);

			 $desc_exp = addslashes($desc_exp);

			 $salair_pecu = addslashes($salair_pecu);

                $last_connexion = date('Y-m-d');

			 

	if( $msg == '') {	


		// Prepare attachements
		$uploadFiles = [
		  'copie_attestation' => [
		      'errorMessage' => "Impossible d'envoyer la copie de l’attestation de l’expérience",
		      'name' => (isset($experience1['copie_attestation'])) ? $experience1['copie_attestation'] : '',
		      'extensions' => ['doc', 'docx', 'pdf', 'gif', 'jpeg', 'jpg', 'png']
		  ]
		];

		// upload attachements
		foreach ($uploadFiles as $key => $file) {
		  if( isset($_FILES[$key]) && intval($_FILES[$key]['size']) > 0 ) {
		  		$uploadDir = 'apps/upload/frontend/candidat/'. $key .'/';
			    $upload = \App\Media::upload($_FILES[$key], [
			        'uploadDir' => $uploadDir,
			        'extensions' => $file['extensions'],
			        'maxSize' => (isset($file['maxSize'])) ? $file['maxSize'] : 0.300
			    ]);
		      if( isset($upload['files'][0]) ) {
		      	unlinkFile(site_base($uploadDir.$uploadFiles[$key]['name']));
		        $uploadFiles[$key]['name'] = $upload['files'][0];
		      } else {
		          $errorMessage = $uploadFiles[$key]['errorMessage'];
		          if( isset($upload['errors'][0][0]) ) $errorMessage .= ': ('. $upload['errors'][0][0] .')';
		          array_push($messages,"<li style='color:#FF0000'>". $errorMessage ."</li>");
		      }
		  }
		}	 

             if ($id__e!='' ) {

			 

			  /*$s__r1="UPDATE experience_pro SET  candidats_id='".safe($id_candidat)."',id_sect='".safe($secteur)."',id_fonc='".safe($fonction_exp)."',

              id_tpost='".safe($type_poste)."',id_pays='".safe($pays_exp)."',date_debut='".safe($dd_exp)."',date_fin='".safe($df_exp)."',

              poste='".safe($poste)."',entreprise='".safe($entreprise)."',

              ville='".safe($ville_exp)."',description='".safe($desc_exp)."',salair_pecu='".safe($salair_pecu)."'  WHERE  id_exp = '".safe($id__e)."'";*/



mysql_query("UPDATE candidats SET last_connexion = '".safe($last_connexion)."' WHERE candidats_id = '".safe($id_candidat)."'");

			 //echo $s__r1;

// $insertion_exp = mysql_query($s__r1);


$insertion_exp = getDB()->update('experience_pro', 'id_exp', $id__e, [
	'candidats_id' => $id_candidat,
	'id_sect' => $secteur,
	'id_fonc' => $fonction_exp,
	'id_tpost' => $type_poste,
	'id_pays' => $pays_exp,
	'date_debut' => $dd_exp,
	'date_fin' => $df_exp,
	'poste' => $poste,
	'entreprise' => $entreprise,
	'ville' => $ville_exp,
	'description' => $desc_exp,
	'salair_pecu' => $salair_pecu,
	'copie_attestation' => $uploadFiles['copie_attestation']['name']
], false);

array_push($messages_succc,"<li style='color:#468847'>L'expérience professionnelle à été modifié avec succés</li>");

$secteur ='';$pays_exp ='';$type_poste ='';

$dd_exp  ='';$df_exp ='';$fonction_exp ='';

$poste ='';$entreprise ='';$ville_exp='';$desc_exp='';$salair_pecu='';

			 }	else	{	

			 

/*$s__r2="INSERT INTO experience_pro VALUES ('','".safe($id_candidat)."','".safe($secteur)."','".safe($fonction_exp)."',

                '".safe($type_poste)."','".safe($pays_exp)."','".safe($dd_exp)."','".safe($df_exp)."','".safe($poste)."',

                '".safe($entreprise)."','".safe($ville_exp)."','".safe($desc_exp)."','".safe($salair_pecu)."')";*/


$insertion_exp = getDB()->create('experience_pro', [
	'candidats_id' => $id_candidat,
	'id_sect' => $secteur,
	'id_fonc' => $fonction_exp,
	'id_tpost' => $type_poste,
	'id_pays' => $pays_exp,
	'date_debut' => $dd_exp,
	'date_fin' => $df_exp,
	'poste' => $poste,
	'entreprise' => $entreprise,
	'ville' => $ville_exp,
	'description' => $desc_exp,
	'salair_pecu' => $salair_pecu,
	'copie_attestation' => $uploadFiles['copie_attestation']['name']
], false);


mysql_query("UPDATE candidats SET last_connexion = '".safe($last_connexion)."' WHERE candidats_id = '".safe($id_candidat)."'");



// $insertion_exp = mysql_query($s__r2);

array_push($messages_succc,"<li style='color:#468847'>l'expérience professionnelle à été ajoutée avec succés</li>");

$secteur ='';$pays_exp ='';$type_poste ='';

$dd_exp  ='';$df_exp ='';$fonction_exp ='';

$poste ='';$entreprise ='';$ville_exp='';$desc_exp='';$salair_pecu='';

			 }

   

 $id_candidat = $_SESSION['abb_id_candidat'];

 

           include ( "../postuler_m_note.php"); 

		   

		   

echo '<meta http-equiv="refresh" content="1;./" />';

    

	}

}



} elseif(!isset($_POST['ok'])){



			 $dd_exp = '';

			 $df_exp = '';

			 $entreprise = '';

			 $poste = '';

			 $secteur = '';

			 $type_poste = '';

			 $ville_exp = '';

			 $pays_exp = '';

			 $desc_exp = '';

			 $salair_pecu='';

}







if($count8 == 0 and empty($messages_succc))

{

array_push($messages,"<div class='alert alert-error'>

<li style='color:#FF0000'>Il faut avoir renseigné au moins une expérience professionnelle</li></div>");

}

	

?>	

	

	

	

	  <h1>EXPERIENCES PROFESSIONNELLES </h1>

	 <span>Créez ou modifiez les expériences professionnelles de votre CV ci-dessous.</span>

<?php

if(isset($messages) and !empty($messages))  {

        foreach($messages as $m) 

        ?><?php    

          {     echo $m;    } 

           ?><?php

      } 

      

?>

<ul>

<?php foreach ($messages_succc as $messages_succc): ?>

    <div class="alert alert-success">

    <?php echo $messages_succc; ?>

    </div>

<?php endforeach; ?>

</ul> 	  	   

	   

<form id="form_standard" action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">

<?php include('etape3_m_form.php'); ?>

</form>



	 

	 

	 

	 

	 

	</div>

 

 

 

 

 

 

 

 

 

<div class="texte" style="width:720px">

 

						  <!--<div class="subscription" style="margin: 10px 0pt;">

                                   <h1>Gestion des courriers type </h1>

                          </div>-->



     <div class="subscription" style="margin: 10px 0pt;">

            <h1> EXPERIENCES PROFESSIONNELLES </h1>

        </div>                   







<?php









if (isset($_SESSION['msg']) and !empty($_SESSION['msg'])) {



   //echo "<span class='success'>" . $_SESSION['msg'] . "</span>";



    unset($_SESSION['msg']);

}







if (isset($_SESSION['erreur']) and !empty($_SESSION['erreur'])) {







    //echo "<span>Des Erreurs ont survenus</span>";



    foreach ($_SESSION['erreur'] as $er) {



        echo "<span class='erreur'>" . $er . "</span>";

    }



    echo "<br>";







    unset($_SESSION['erreur']);

}

                            



                            if (isset($_GET['id']) && !empty($_GET['id'])) {



                              $id = $_GET['id'];



                              if ($_GET['action'] == "delete") {



                                        if (mysql_query("DELETE from experience_pro  where id_exp='".safe($id)."' ")) {

 

											include ( "../postuler_m_note.php"); 

		   

											// header("location:./");

											redirect(site_url('candidat/cv/experiences/'));

                                        } else {



                                            $_SESSION['erreur'] = "Une erreur est survenue lors de la suppression";

											

                                        }

										 

							 

                                }





                             

                            }

							

                            





?>









<table width="100%" border="0" cellspacing="0" id="corriers_type" class="tablesorter" style="background: none;">





<thead>



                            <tr>

		

                                <th scope="col" width="30%" style="background-color:#2B579A;padding: 5px 5px;"><strong style="color:white;">Intitulé du Poste</strong></th> 

								

								<th scope="col" width="15%" style="background-color:#2B579A;padding: 5px 5px;"><strong style="color:white;">Entreprise  </strong></th>

								

                                <th scope="col" width="10%" style="background-color:#2B579A;padding: 5px 5px;"><strong style="color:white;">Date de début</strong></th>

								

								<th scope="col" width="10%" style="background-color:#2B579A;padding: 5px 5px;"><strong style="color:white;">Date de fin </strong></th>



								<th width="10%"  style="background-color:#2B579A;padding: 5px 5px;"><strong style="color:white;">Actions</strong></th>







                        







                            </tr>



</thead>

<tbody>



                        <?php



$count = $count_experiences;

if($count<1){

	echo  " <tr><td colspan='5'><center>Aucunes données trouvez</center></td></tr> ";}

else{



                       

                        $trcolor='';

						$oddeven=1;

						

						$id_candidat = $_SESSION['abb_id_candidat'];

						$requeteexperiences2 = mysql_query("SELECT * from experience_pro where candidats_id ='".safe($id_candidat)."' order by id_exp asc ");

			            $ii=0;

                            while( $reponse = mysql_fetch_array($requeteexperiences2)) {

							

									  /*

									  $req_03 = mysql_query( "SELECT * FROM prm_ecoles where id_ecole=".$reponse['id_ecol']." ");		 $r03 = mysql_fetch_array( $req_03 )	;	

									  if ($reponse['id_ecol']!='290') { $type=$r03['nom_ecole'];} else {$type=$reponse['ecole'];}

									  */

								

							

							if($oddeven==1)

							{	$oddeven=2;	$trcolor='';	}

							else

							{	$oddeven=1;	$trcolor='bgcolor="#DDDDDD"';	}

$month_df=$month_dd=$m_dd=$m_df=$year_df="";                            

$orderdate_dd = explode('/', $reponse['date_debut']); 





$month_dd=(empty($orderdate_dd[2])) ? $orderdate_dd[0] : $orderdate_dd[1];

$year_dd=(empty($orderdate_dd[2])) ? $orderdate_dd[1] : $orderdate_dd[2];

                        

if(!empty($reponse['date_fin'])){

$orderdate_df = explode('/', $reponse['date_fin']); 



$month_df=(empty($orderdate_df[2])) ? $orderdate_df[0] : $orderdate_df[1];

$year_df=(empty($orderdate_df[2])) ? $orderdate_df[1] : $orderdate_df[2];



}

//echo $reponse['date_fin'];

$m_dd=$m_df='';



                            switch( $month_dd){case '01': $m_dd='Janvier';break;case '02': $m_dd='Février';break;case '03': $m_dd='Mars';break;case '04': $m_dd='Avril';break;case '05': $m_dd='Mai';break;case '06': $m_dd='Juin';break;case '07': $m_dd='Juillet';break;case '08': $m_dd='Août';break;case '09': $m_dd='Septembre';break;case '10': $m_dd='Octobre';break;case '11': $m_dd='Novembre';break;case '12': $m_dd='Décembre';break;}

                            switch( $month_df){case '01': $m_df='Janvier';break;case '02': $m_df='Février';break;case '03': $m_df='Mars';break;case '04': $m_df='Avril';break;case '05': $m_df='Mai';break;case '06': $m_df='Juin';break;case '07': $m_df='Juillet';break;case '08': $m_df='Août';break;case '09': $m_df='Septembre';break;case '10': $m_df='Octobre';break;case '11': $m_df='Novembre';break;case '12': $m_df='Décembre';break;}

                            

                            

                                ?>            



                                    <tr <?php echo $trcolor; ?> onmouseover="this.className='marked'" onmouseout="this.className=''" >

									 

                                        <td style="border:1px solid #FFFFFF;"><?php echo  $reponse['poste']; ?></td> 

										

                                        <td style="border:1px solid #FFFFFF;"><?php echo $reponse['entreprise']; ?></td>

										

                                        <td style="border:1px solid #FFFFFF;"><?php echo $m_dd .'.'.$year_dd; ?></td>

                                        

                                        <td style="border:1px solid #FFFFFF;">

                                        <?php if(empty($reponse['date_fin'])){echo "Aujourd'hui";}

                                        else{echo $m_df .'.'.$year_df;} ?></td>

                                     



                                        <td style="border:1px solid #FFFFFF;" align="center">

										  

										<div style=" float: left; padding-left: 5px; ">

											<form method="post" action="" id="form2" name="formulaire_m<?php echo ++$ii; ?>">

											<input type="hidden" name="id" value="<?php echo $reponse['id_exp'] ?>" /> 

											<input type="hidden"  id="edit" name="ok"  value=""   title="Edit ce message" class="cu" /> 

                                            <a href="#" onclick="formulaire_m<?php echo $ii; ?>.submit()">

                                            <i class="fa fa-pencil-square-o fa-fw fa-lg"></i>

                                            </a>

											</form>

										</div>

										

										

										<div style=" float: left; padding-left: 5px; ">

											<a href="#" onclick="if(confirm('Êtes-vous sûre de vouloir supprimer ce profil?'))location.href='./?action=delete&id=<?php echo $reponse['id_exp'] ?>'">

											 <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

											</a>

										</div>

										

										</td>





                                    </tr>



 <?php

}

}

?>   



</tbody>



                        </table><div class="ligneBleu"></div>

 

 </div>



 

 