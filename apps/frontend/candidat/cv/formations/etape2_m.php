 

	<div class='texte'>

      <h1>FORMATION</h1>

 <span>Créez ou modifiez les différentes formations de votre CV ci-dessous.</span>



<?php	

	

	



//pour formation				 

$messages_succc=array();

$messages=array();  

  $id_candidat = $_SESSION['abb_id_candidat'];

$requeteformations28 = mysql_query("SELECT * from formations where candidats_id ='".safe($id_candidat)."' order by id_formation asc ");

$count8 = mysql_num_rows($requeteformations28);



   

$id__e = isset($_POST['id__e']) ? trim($_POST['id__e']) : "";

$dd_formation = isset($_POST['date_debut_formation']) ? trim($_POST['date_debut_formation']) : "";

//$dd_formation = htmlspecialchars($dd_formation, ENT_QUOTES);

$month_dd = isset($_POST['mois_formation']) ? trim($_POST['mois_formation']) : "";

$year_dd = isset($_POST['anne_formation']) ? trim($_POST['anne_formation']) : "";

$dd_formation=$month_dd."/".$year_dd;



$df_formation = isset($_POST['date_fin_formation']) ? trim($_POST['date_fin_formation']) : "";

$month_df = isset($_POST['mois_fin_formation']) ? trim($_POST['mois_fin_formation']) : "";

$year_df =isset($_POST['anne_fin_formation']) ? trim($_POST['anne_fin_formation']) : "";

$df_formation=$month_df."/".$year_df;



//$df_formation = htmlspecialchars($df_formation, ENT_QUOTES);

$etablissement = isset($_POST['etablissement']) ? $_POST['etablissement'] : "";

$nom_etablissement = isset($_POST['nom_etablissement']) ? $_POST['nom_etablissement'] : "";

$nivformation = isset($_POST['nivformation']) ? $_POST['nivformation'] : "";

$diplome = isset($_POST['diplome']) ? trim($_POST['diplome']) : "";

$desc_form = isset($_POST['description_formation']) ?  $_POST['description_formation'] : "";



$today= isset($_POST['subscribe']) ? trim($_POST['subscribe']) : "";

if($today == 'oui'){$df_formation='';}









//$df_formation =(!empty($month_df) and !empty($year_df)) ? "$month_df/$year_df" : "" ;

/*    

$id__e = isset($_POST['id__e']) ? trim($_POST['id__e']) : "";



/*$dd_formation = isset($_POST['date_debut_formation']) ? trim($_POST['date_debut_formation']) : "";

$dd_formation = htmlspecialchars($dd_formation, ENT_QUOTES);

$df_formation = isset($_POST['date_fin_formation']) ? trim($_POST['date_fin_formation']) : "";

$df_formation = htmlspecialchars($df_formation, ENT_QUOTES);

*//*$etablissement = isset($_POST['etablissement']) ? $_POST['etablissement'] : "";

$nom_etablissement = isset($_POST['nom_etablissement']) ? $_POST['nom_etablissement'] : "";

$nivformation = isset($_POST['nivformation']) ? $_POST['nivformation'] : "";

$diplome = isset($_POST['diplome']) ? trim($_POST['diplome']) : "";



$month_dd= isset($_POST['mois_debut']) ? trim($_POST['mois_debut']) : "";

$year_dd = isset($_POST['annee_debut']) ? trim($_POST['annee_debut']) : "";

$dd_formation =(!empty($month_dd) and !empty($year_dd)) ? "$month_dd/$year_dd" : "" ;



$month_df = isset($_POST['mois_fin']) ? trim($_POST['mois_fin']) : "";

$year_df = isset($_POST['annee_fin']) ? trim($_POST['annee_fin']) : "";

$today= isset($_POST['subscribe']) ? trim($_POST['subscribe']) : "";

if($today == 'oui'){$year_df='';$month_df='';}



$df_formation =(!empty($month_df) and !empty($year_df)) ? "$month_df/$year_df" : "" ;



//$diplome = htmlspecialchars($diplome, ENT_QUOTES);  

//$diplome=htmlspecialchars_decode($diplome);

$desc_form = isset($_POST['description_formation']) ?  htmlspecialchars($_POST['description_formation'], ENT_QUOTES) : "";

*/ 

 

if (isset($_POST['ok']) AND isset($_POST['id']) AND ($_POST['id']!='') ) {

$dd_formation =  $formation1['date_debut'];

$df_formation =  $formation1['date_fin'];



$etablissement =  $formation1['id_ecol'];

$nom_etablissement =  $formation1['ecole'];

$nivformation =  $formation1['nivformation'];

$diplome =  $formation1['diplome'];

$desc_form=  $formation1['description'];



$month_dd = isset($_POST['mois_formation']) ? trim($_POST['mois_formation']) : "";

$year_dd = isset($_POST['anne_formation']) ? trim($_POST['anne_formation']) : "";





$month_df = isset($_POST['mois_fin_formation']) ? trim($_POST['mois_fin_formation']) : "";

$year_df =isset($_POST['anne_fin_formation']) ? trim($_POST['anne_fin_formation']) : "";





$id__e = isset($_POST['id__e']) ? trim($_POST['id__e']) : "";





}





  $msg = '';

if(!empty($dd_formation) and !empty($df_formation)){

$orderdate_dd = explode('/', $dd_formation); 

$month_dd=(empty($orderdate_dd[2])) ? $orderdate_dd[0] : $orderdate_dd[1];

$year_dd=(empty($orderdate_dd[2])) ? $orderdate_dd[1] : $orderdate_dd[2];



$orderdate_dd = explode('/', $df_formation); 

$month_df=(empty($orderdate_dd[2])) ? $orderdate_dd[0] : $orderdate_dd[1];

$year_df=(empty($orderdate_dd[2])) ? $orderdate_dd[1] : $orderdate_dd[2];



if ($year_dd > $year_df )

  $msg .= "<ul><li style='color:#FF0000'>L'année de la date de début est supérieure à la date fin</li></ul>";



elseif ($month_dd > $month_df and $year_dd == $year_df)

  $msg .= "<ul><li style='color:#FF0000'>Le mois de la date de début est supérieure à la date fin</li></ul>";



}



if(!empty($msg))

   array_push($messages,'<div class="alert alert-error">'.$msg.'</div>');





if (isset($_POST['envoi'])) {

	

	if (!((empty($dd_formation)) AND (empty($df_formation))  AND (empty($etablissement))  AND (empty($diplome))  AND (empty($desc_form))   ) )	{	

		

      $id_candidat = $_SESSION['abb_id_candidat'];  



         $last_connexion = date('Y-m-d');                  



 

                       

	/////	===================================================    formations	

											   

   

		    //$dd_formation = addslashes($dd_formation);

			//$df_formation = addslashes($df_formation);

			$etablissement = addslashes($etablissement);

			$diplome = addslashes($diplome);

			$desc_form = addslashes($desc_form);

			$nom_etablissement = addslashes($nom_etablissement);	

		      $last_connexion = date('Y-m-d'); 

if( $msg == '') {		 


	// Prepare attachements
	$uploadFiles = [
	  'copie_diplome' => [
	      'errorMessage' => "Impossible d'envoyer le copie du diplôme",
	      'name' => (isset($formation1['copie_diplome'])) ? $formation1['copie_diplome'] : '',
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



/*$s__r1="UPDATE formations SET  candidats_id='".safe($id_candidat)."',id_ecol='".safe($etablissement)."',

date_debut='".safe($dd_formation)."',date_fin='".safe($df_formation)."',diplome='".safe($diplome)."',

description='".safe($desc_form)."',nivformation='".safe($nivformation)."',ecole='".safe($nom_etablissement)."'  

WHERE  id_formation = '".safe($id__e)."'";*/


echo "";

mysql_query("UPDATE candidats SET last_connexion = '".safe($last_connexion)."' WHERE candidats_id = '".safe($id_candidat)."'");



// $insertion_formation = mysql_query( $s__r1);

$insertion_formation = getDB()->update('formations', 'id_formation', $id__e, [
	'candidats_id' => $id_candidat,
	'id_ecol' => $etablissement,
	'date_debut' => $dd_formation,
	'date_fin' => $df_formation,
	'diplome' => $diplome,
	'description' => $desc_form,
	'nivformation' => $nivformation,
	'ecole' => $nom_etablissement,
	'copie_diplome' => $uploadFiles['copie_diplome']['name']
]);



array_push($messages_succc,"<li style='color:#468847'>la formation à été modifié avec succés</li>");

$id__e ='';$dd_formation ='';$df_formation ='';

$etablissement  ='';$nom_etablissement ='';

$nivformation ='';$diplome ='';$desc_form='';

$month_dd='';$year_dd='';$month_df='';$year_df='';

//echo '<meta http-equiv="refresh" content="1;./" />';



			 }	else	{	

/*$s__r2="INSERT INTO formations VALUES ('','".safe($id_candidat)."','".safe($etablissement)."','".safe($dd_formation)."',

    '".safe($df_formation)."','".safe($diplome)."','".safe($desc_form)."','".safe($nivformation)."','".safe($nom_etablissement)."')";*/


    $insertion_formation = getDB()->create('formations', [
		'candidats_id' => $id_candidat,
		'id_ecol' => $etablissement,
		'date_debut' => $dd_formation,
		'date_fin' => $df_formation,
		'diplome' => $diplome,
		'description' => $desc_form,
		'nivformation' => $nivformation,
		'ecole' => $nom_etablissement,
		'copie_diplome' => $uploadFiles['copie_diplome']['name']
    ]);

mysql_query("UPDATE candidats SET last_connexion = '".safe($last_connexion)."' WHERE candidats_id = '".safe($id_candidat)."'");	



// $insertion_formation = mysql_query($s__r2);

array_push($messages_succc,"<li style='color:#468847'>la formation à été ajoutée avec succés</li>");

$id__e ='';$dd_formation ='';$df_formation ='';

$etablissement  ='';$nom_etablissement ='';

$nivformation ='';$diplome ='';$desc_form='';

$month_dd='';$year_dd='';$month_df='';$year_df='';

$mmss = false;

//echo '<meta http-equiv="refresh" content="1;./" />';



			 }

 

           include ( "../postuler_m_note.php"); 

		   			 

  }



    

	}





} elseif(!isset($_POST['ok'])){

 

			 $dd_formation = '';

			 $df_formation = '';

			 $etablissement = '';

			 $diplome = '';

			 $desc_form = '';

			 $nom_etablissement = '';  

			 $nivformation='';

$month_dd= '';

$year_dd= '';

$month_df= '';

$year_df= '';

}

if($count8 == 0 and empty($messages_succc))

{

array_push($messages,"<li style='color:#FF0000'>Il faut avoir renseigné au moins une formation pour pouvoir déposer une candidature</li>");



}

	

?>

<script type="text/javascript">

    $(document).ready(function () {

    setInterval(function () {

        $("#IDs").load();

    }, 1000);

});

</script>

<div id="IDs">

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

  </div> 



<form id="form_standard"  action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">

<?php include('etape2_m_form.php');?>

</form>



	

	 

	

	 

	</div>

 <tr>

<div class="subscription" style="margin: 10px 0pt;">

<h1>FORMATION </h1>

</div>

 

 

 

 

 

 

<div class="texte" style="width:720px">

 

						  <!--<div class="subscription" style="margin: 10px 0pt;">

                                   <h1>Gestion des courriers type </h1>

                          </div>-->



 

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



                                        if (mysql_query("delete from formations  where id_formation='$id'")) {

											

												   include ( "../postuler_m_note.php"); 

												   

											// header("location:./");
											redirect(site_url('candidat/cv/formations/'));

											

                                        } else {



                                            $_SESSION['erreur'] = "Une erreur est survenue lors de la suppression";

											

                                        }

										 

							 

                                }





                             

                            }

							

 

 

?>

             



<table width="100%" border="0" cellspacing="0" id="corriers_type" class="tablesorter" style="background: none;">





<thead>



                            <tr>

								

								<th scope="col" width="35%" style="background-color:#2B579A;padding: 5px 5px;"><strong style="color:white;">Diplôme </strong></th>

		

                                <th scope="col" width="35%" style="background-color:#2B579A;padding: 5px 5px;"><strong style="color:white;">École ou établissement</strong></th> 

								

                                <th scope="col" width="15%" style="background-color:#2B579A;padding: 5px 5px;"><strong style="color:white;">Date de début</strong></th>

								

								<th scope="col" width="15%" style="background-color:#2B579A;padding: 5px 5px;"><strong style="color:white;">Date de fin </strong></th>



								<th width="5%"  style="background-color:#2B579A;padding: 5px 5px;"><strong style="color:white;">Actions</strong></th>







                        







                            </tr>



</thead>

<tbody>



                        <?php



$count = $count_formations;

if($count<1){

	echo  " <tr><td colspan='5'><center>Aucunes données trouvez</center></td></tr> ";}

else{



                       

                        $trcolor='';

						$oddeven=1;

						$id_candidat = $_SESSION['abb_id_candidat'];

						$requeteformations2 = mysql_query("select * from formations where candidats_id ='$id_candidat' order by id_formation asc ");

			                 $countdelet = mysql_num_rows($requeteformations2);$ii=0;

                            while( $reponse = mysql_fetch_array($requeteformations2)) {

							

					$req_03 = mysql_query( "SELECT * FROM prm_ecoles where id_ecole=".$reponse['id_ecol']." ");		 

                    $r03 = mysql_fetch_array( $req_03 )	;	

					if ($reponse['id_ecol']!='290') { $type=$r03['nom_ecole'];} else {$type=$reponse['ecole'];}

								

							

							if($oddeven==1)

							{	$oddeven=2;	$trcolor='';	}

							else

							{	$oddeven=1;	$trcolor='bgcolor="#DDDDDD"';	}

							$req_filiere = mysql_query("SELECT * FROM prm_filieres where id_fili = ".$reponse['diplome']."");

                            $datafiliere = mysql_fetch_array($req_filiere);





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

										

                                        <td style="border:1px solid #FFFFFF;"><?php echo $datafiliere['filiere']; ?></td>

									 

                                        <td style="border:1px solid #FFFFFF;"><?php echo $type; ?></td> 

										

                                        <td style="border:1px solid #FFFFFF;"><?php echo $m_dd .'.'.$year_dd; ?></td>

										

                                        <td style="border:1px solid #FFFFFF;">

                                        <?php if(empty($reponse['date_fin'])){echo "Aujourd'hui";}

                                        else{echo $m_df .'.'.$year_df;} ?></td>

                                     



                                        <td style="border:1px solid #FFFFFF;" align="center">

										  

										<div style=" float: left; padding-left: 5px; ">

											

											<form method="post" action="" id="form2" name="formulaire_m<?php echo ++$ii; ?>">

											<input type="hidden" name="id" value="<?php echo $reponse['id_formation']; ?>" /> 

<input type="hidden"  id="month_dd" name="month_dd"  value="<?php echo $month_dd; ?>"    /> 

<input type="hidden"  id="year_dd" name="year_dd"  value="<?php echo $year_dd; ?>"    /> 

<input type="hidden"  id="month_df" name="month_df"  value="<?php echo $month_df; ?>"    /> 

<input type="hidden"  id="year_df" name="year_df"  value="<?php echo $year_df; ?>"    /> 

<input type="hidden"  id="edit" name="ok"  value=""   title="Edit ce message" class="cu" /> 



                                            <a href="#" onclick="formulaire_m<?php echo $ii; ?>.submit()">

                                            <i class="fa fa-pencil-square-o fa-fw fa-lg"></i>

                                            </a>

											</form>

										</div>

										

										

										<div style=" float: left; padding-left: 5px; "><?php if ($count >1){?>

											<a href="#" onclick="if(confirm('Êtes-vous sûre de vouloir supprimer ce profil?'))location.href='./?action=delete&id=<?php echo $reponse['id_formation'] ?>'">

											

                                             <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

											</a><?php }?>

										</div>

										

										</td>





                                    </tr>



 <?php

}

}

?>   



</tbody>



                        </table>

  <div class="ligneBleu"></div>

 </div>

