<div class="subscription" style="margin: 10px 0pt;">

<h1>CV DES CANDIDATS  </h1>

</div>

<?php





/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];



$select =  mysql_query($query_M);

		

$tpc = mysql_num_rows($select);                     

$nbItems = $tpc;

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;

$nbPages = ceil ( $nbItems / $itemsParPage );

if (! isset ( $_GET ['idPage'] ))

$pageCourante = 1;        

elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)

$pageCourante = $_GET ['idPage'];

else

$pageCourante = 1;

// Calcul de la clause LIMIT

$limitstart = $pageCourante * $itemsParPage - $itemsParPage;

 //



$sql_pagination=$query_M."  LIMIT " . $limitstart . ", " . $itemsParPage ." ";

 // echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination





?>

  

	  <form action="<?php echo $url44; ?>" method="post" name="global" >  

  	<table><tr><td>

    <b style="font-size: 10px;"> * Le point en couleur montre la pertinence de la candidature (<span style="color:#79796A"><a style="color:#00B300">Vert</a>: pertinence bonne, <a style="color:#CC5500;">Orange</a>: Pertinence moyenne,  <a style="color:#CC0000">Rouge</a>: pertinence faible </span>). </b>

  	</td></tr></table> 		





<table   width="100%" border="0" cellspacing="0" id="resulta_offres" class="tablesorter" style="background: none;" >

  <thead>

   <tr>

    <th  class="tableentete" ><b>N°</b></th>

    <th  class="tableentete" colspan="3" ><b>Informations Candidats</b></th>			

<?php  



	if($_SESSION['r_prm_note']==0){

		 

		

?>

    <th class="tableentete" width="1%"><b>Note</b></th>			

<?php  



	}	 

		

?>

			

<?php  



	if($_SESSION['r_prm_pertinenc_cnddtr']==0){

	 

?>	



    <th class="tableentete" width="1%" ><b>Pertinence</b></th>



<?php  



	} 

	 

?>





    <th  class="tableentete" width="8%"   ><b>Date</b></th>

    <th class="tableentete" width="10%" ><b>Actions</b></th>

  </tr>

  </thead>

  <tbody>

  <?php

  $cc = mysql_num_rows($rst_pagination);

  //echo $cc;

  if($cc)

  { 

  $ii = 1;$i=0;

  

  $alter_class=1;$inum=0;

  mysql_data_seek($rst_pagination,0);

  while($return = mysql_fetch_array($rst_pagination))

     {

      $inum++;

$is=$inum+$limitstart;

         $ii == 1 ? $ii++ : $ii--;

         $i++;

  ?>  

 

  <tr>

    <td width="3%"><span class="badge"><?php echo $is; ?></span></td>

    <td width="30%">

      

    <?php 

$date_naissance = str_replace('/', '-', $return['date_n']);

$date_naissance_c = date('Y-m-d', strtotime($date_naissance));

$age_c = strtotime($date_naissance_c);

$newformat = date('Y-m-d',$age_c);

        $nomPre = $return['prenom'].'&nbsp;'.$return['nom'];

    $age = (time() - strtotime($newformat)) / 3600 / 24 / 365;

    ?>



 <i class="fa fa-user"></i> 



                

                

   

                      

         <a class="info" href="../../../cv/?candid=<?php echo $return['candidats_id']; ?>"  > 

       <?PHP

    echo "<b>".$return['prenom'].'&nbsp;'.$return['nom'].' |  '.number_format($age,0).' ans</b>'; ?>

         <i class="fa fa-external-link"></i>

            <span style="width:280px;padding:6px"> 

            <?php 

                $historique = mysql_query("SELECT * from historique 

                    where id_candidature = '".$return['id_candidature']."' ORDER BY date_modification ASC");

                $cpt = mysql_num_rows($historique);

                if($cpt){

                  echo ' <h2 style="color:#000;"><b>Historique des actions effectu&eacute;es</b> </h2><div style="background-color: #ddd;"><table >';

      

                while($data = mysql_fetch_array($historique))

                { 

                  $idst = $data['id'];          $date = $data['date_modification'];      $commentaire = $data['commentaire'];

                  $stat = $data['status'];      $utilisateur = $data['utilisateur'];     $comment = $data['commentaire'];  

                  echo '<tr><td style=" background-color: #ddd;" >'.date('d-m-Y H:i',strtotime($date)).'</td>

                  <td style=" background-color: #ddd; padding-left: 20px; ">'.$stat.'</td> <!--<td> '.$comment.'</td>--><td style=" background-color: #ddd; padding-left: 20px;"><a href="javascript:showDivDetai(\''.$idst.'\',\''.$stat.'\',\''.$nomPre.'\',\''.$date.'\',\''.$utilisateur.'\',\''.$commentaire.'\',\'\')"  title="Voir ce message"><i class="fa fa-search fa-fw fa-lg"></i> </a></td></tr>';

                

                }

                echo '</table></div> <br/>';

                }

            ?>

             D&eacute;tail du candidat 

            </span> 

         </a><br/>

         <?php

         $select_exp = mysql_query("select * from candidats where candidats_id = '" . $return['candidats_id'] . "' ");

$exp = mysql_fetch_array($select_exp);

$exxp=mysql_query("select * from prm_experience where id_expe= '".$return['id_expe']."' "); 

$xexxp = mysql_fetch_array($exxp);

echo $exp['titre']."<b> | </b>".$xexxp['intitule']."<br/>";

?>

<?php

$select_exp = mysql_query("select * from prm_pays where id_pays = '" . $return['id_pays'] . "' "); 

$exp = mysql_fetch_array($select_exp); 

$result01 = mysql_query("select * from prm_situation where id_situ = '".$return['id_situ']."' ");

$row01 = mysql_fetch_row($result01);

$result02 = mysql_query("select * from prm_niv_formation where id_nfor = '".$return['id_nfor']."' ");

$row02 = mysql_fetch_row($result02);

$result03 = mysql_query("select * from prm_type_formation where id_tfor = '".$return['id_tfor']."' ");

$row03 = mysql_fetch_row($result03);

echo $exp['pays']; ?><b> | </b> <?php  echo $row01[1].' <b> | </b> '.$row02[1]; ?>

           <br/> <?php 

$secc = mysql_query( "SELECT * FROM prm_sectors where id_sect = '".$return['id_sect']."' ");

$rcc = mysql_fetch_array($secc);



echo $rcc['FR']."<b> | </b>".$return['email']; ?> <br />



                  <br />

</td>

    <td width="14%"><strong>Fra&icirc;cheur du cv</strong><br />

                  <strong>Exp&eacute;rience</strong><br />

                  <strong>Salaire souhait&eacute;</strong><br />

                <strong>Mobilit&eacute;</strong>

	</td>

     <td width="17%">

			<?php 

    $select_fiche = mysql_query("select * from  candidats where  candidats_id = '".$return['candidats_id']."' ");

    $fiche = mysql_fetch_array($select_fiche);

    $datemaj=$fiche['dateMAJ'];

echo time_ago($datemaj);

        ?>

        <br/>

        <?php 

    $select_exp = mysql_query("select * from prm_experience where id_expe = '".$return['id_expe']."' ");

    $exp = mysql_fetch_array($select_exp);

    echo  $exp['intitule'];

        ?>

        <br/>

        <?php 

    $select_salaire = mysql_query("select * from prm_salaires where id_salr = '".$return['id_salr']."' ");

    $salaire = mysql_fetch_array($select_salaire);

    echo  $salaire['salaire'];

        ?>

        <br/>        <?php 

        echo  $fiche['mobilite'];

        ?>    

		</td>

    

 

    			

<?php  



	if($_SESSION['r_prm_note']==0){

		 

		

?>

    <td>

        <center>

    <?php

         $sum_not='0';

                $his="non définie";

        $query66 = mysql_query("SELECT * from notation_1 where id_candidature = '".$return['id_candidature']."' "); 

        $start = microtime(true);

        if($data66 = mysql_fetch_array($query66)){

        $sum_not = $data66['note_ecole'] + $data66['note_filiere'] + $data66['note_diplome'] + $data66['note_experience'] + $data66['note_stages'] ;

    }

        if(!empty($data66['id_candidature']))

        {



          

         ?>

        <?php

        $color_note = '';

        if($sum_not >= 75 ){  

        $color_note = "style='color: #00B300;'";}

          if($sum_not >= 50 and $sum_not < 75 ){

        $color_note = "style='color: #CC5500;'"; }

          if($sum_not >=25 and $sum_not <50){ 

        $color_note = "style='color: #CC0000;'"; }

          if($sum_not <25){ 

        $color_note = "style='color: #000000;'"; } 

     

       //  Editer 

            $select  = mysql_query("select * from historique where id_candidature = '".$return['id_candidature']."'");

            $hist = mysql_fetch_array($select);

            $his=$hist['date_modification']; 

                $a =$data66['note_ecole'];$b =$data66['note_filiere'];$c =$data66['note_diplome'];

                $d =$data66['note_experience'];$e =$data66['note_stages'];$f =$sum_not;

        /*if(!(isset($sum_not) OR $sum_not!=''))*/;

                /*echo '<a href="javascript:showDiv2_note(\''.$return['nom'].'\',\''.$return['prenom'].'\',

                    \''.$return['id_candidature'].'\',\''.$reponse['status'] .'\',\''.$his .'\',\''.$percent .'\'

                    ,\''.$a .'\',\''.$b .'\',\''.$c .'\',\''.$d .'\',\''.$e .'\',\''.$f .'\',\''.$sum_not .'\')"

                      title="Modifier la notation"  class="info"   >  ';*/

              echo '<a href=""

                      title="Modifier la notation"  class="info"   >  ';

            //fin edit statut candidature



      ?>

    

        <p> <?php    

            //  Editer 

          echo ' <b '.$color_note.'>'.$sum_not.'</b> ';/*echo $return['notation'];*/

			//mysql_query("UPDATE notation_1 SET obs='".safe($sum_not)."' where id_candidature = '".$return['id_candidature']."' ");

		  

				/* =========== update table candidature =========== */	

						/*$sum_not = $note_ecole + $note_filiere + $note_diplome + $note_experience + $note_stages ; */

				//mysql_query("UPDATE `candidature` SET  `notation`='".$sum_not."'  WHERE `id_candidature`='".$return['id_candidature']."' ");

        /*echo "UPDATE `candidature` SET  `notation`='".$sum_not."'  WHERE `id_candidature`='".$return['id_candidature']."'";*/

            //fin edit statut candidature

      ?> </p>

     <!--<img src="<?php echo $imgurl ?>/icons/<?php echo $color ?>.png" alt="details"  />-->

      <span style="width:320px;padding:6px">

      <div id="idTable2" class="subscription" style="margin: 10px 0pt;">

                                    <h1>Critére de notation</h1>

      </div>

      <table width="100%" style="  border-collapse: collapse;">

        <thead>

          <tr>

            <td colspan="2" style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>CRITERES</center></b>

            </td>

            <td colspan="1" style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>NIVEAUX</center></b>

            </td>

          </tr>

        </thead>

        <tbody>

          <tr>

            <td width="30%" style="border: 1px solid #ccc;text-align: left;">

              <b>FORMATION</b>

            </td>

            <td width="40%" style="border: 1px solid #ccc;text-align: left;">

              <b>Ecole </b><br/>

              <b>Filière </b><br/>

              <b>Année d’obtention du diplôme </b>

            </td>

            <td width="10%" style="border: 1px solid #ccc;text-align: left;">

             <center><?php echo $data66['note_ecole']; ?></center>

             <center><?php echo $data66['note_filiere']; ?></center>

             <center><?php echo $data66['note_diplome']; ?></center>

 



            </td>

          </tr>

          <tr>

            <td style="border: 1px solid #ccc;text-align: left;">

              <b>EXPERIENCE CONFIRMEE</b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

              <b>Expérience probante  </b><br/>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

            <center><?php echo $data66['note_experience']; ?></center>

            </td>

          </tr>

           <tr>

            <td style="border: 1px solid #ccc;text-align: left;">

              <b>STAGES</b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

              <b>Stages probants </b><br/>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

              <center><?php echo $data66['note_stages']; ?></center>

            </td>

          </tr>

          <tr>

          <td>

            

          </td> 

            <td  style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

           <b <?php echo $color_note;?> >TOTAL</b>

            </td>

            

            <td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

              <center><b <?php echo $color_note;?> ><?php echo $sum_not; ?></b></center>

            </td>

          </tr>

        </tbody>

      </table> 

      </span></a> 

        <?php } else {

    echo '<p><b><a href="javascript:showDiv2_note(\''.$return['nom'].'\',\''.$return['prenom'].'\',

                    \''.$return['id_candidature'].'\',\''.$reponse['status'] .'\',\''.$his .'\',\''.$percent .'\'

                    ,\'0\',\'0\',\'1\',\'0\',\'0\',\'0\')"

                      title="Editer la note de cette candidature"  class="info"   > 0 </a></b></p>';

    }?><br/> 

     

        </center>

    </td>

			

<?php  



	}	 

		

?>

  

			

<?php  



	if($_SESSION['r_prm_pertinenc_cnddtr']==0){

	 

?>	    

<td>

        <?php 

            

            $ref_pertinence = mysql_query("SELECT * FROM prm_pertinence 

              WHERE ref_p = 'p' limit 0,1");

            $prm_p_candidat = mysql_fetch_array($ref_pertinence);



            $s_pertinence_sql = "SELECT * FROM pertinence_oc 

              WHERE candidats_id = '".$return['candidats_id']."' 

              and id_offre = '".$return['id_offre']."' 

              and ref_p = 'p' limit 0,1";

            $q_pertinence_g = mysql_query($s_pertinence_sql);

            $s_pertinence_g = mysql_fetch_array($q_pertinence_g);

            

            

            

            $percent_titre 				= 	( empty($s_pertinence_g['prm_titre'])	)		?	0	:	$s_pertinence_g['prm_titre']			;

            $percent_expe 				= 	( empty($s_pertinence_g['prm_expe'])	)		?	0	:	$s_pertinence_g['prm_expe']		    	;

            $percent_ville 				= 	( empty($s_pertinence_g['prm_local'])	)		?	0	:	$s_pertinence_g['prm_local']	    	;

            $percent_tposte 			= 	( empty($s_pertinence_g['prm_tpost'])	)		?	0	:	$s_pertinence_g['prm_tpost']	    	;

            $percent_fonction 			= 	( empty($s_pertinence_g['prm_fonc'])	)		?	0	:	$s_pertinence_g['prm_fonc']		    	;

            $percent_formation 			= 	( empty($s_pertinence_g['prm_nfor'])	)		?	0	:	$s_pertinence_g['prm_nfor']		    	;

            $percent_mobilite 			= 	( empty($s_pertinence_g['prm_mobil'])	)		?	0	:	$s_pertinence_g['prm_mobil']	    	;

            $percent_niveau_mobilite 	= 	( empty($s_pertinence_g['prm_n_mobil'])	)		?	0	:	$s_pertinence_g['prm_n_mobil']	    	;

            $percent_taux_mobilite 		= 	( empty($s_pertinence_g['prm_t_mobil'])	)		?	0	:	$s_pertinence_g['prm_t_mobil']	    	;

            $n_pertinence 				= 	( empty($s_pertinence_g['total_p'])		)		?	0	:	$s_pertinence_g['total_p']		    	;

            $r_n_pertinence 			= 		number_format($n_pertinence,0)	;  



           $color='#000000';  

        if($r_n_pertinence == 100 ) {

            $color='#00B300';  }

        elseif($r_n_pertinence < 100 and $r_n_pertinence >= 40)  {

            $color='#CC5500'; }

        elseif($r_n_pertinence <  40 ){ 

            $color='#D50000'; }

    

        ?>

        <div style="float: right;margin:1px 20px 1px 0px ;">

          <a href="javascript:void(0)" class="info">



          <div style="width: 15px; height: 15px; background: <?php echo $color; ?>;

           -moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;"></div>

          <br/><span id="tableau" style="width: 200px;padding:6px">

          <table>

            <!-- /////////////////////////  -->

            <?php

            

            ?>

            <?php if($prm_p_candidat['prm_titre'] == "1"){ ?>

            <tr>

            <td style=" background-color: white; width:77% ">Pertinence Titre </td>

            <td style=" background-color: white; width: 10%;">=</td>

            <td style=" background-color: white; width: 20%;">

            <?php echo ''.$percent_titre.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_p_candidat['prm_expe'] == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence expérience  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_expe.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_p_candidat['prm_local'] == "1"){ ?>

            <tr>

            <td style=" background-color: white; ">Pertinence Ville  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_ville.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_p_candidat['prm_tpost'] == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence Type de poste  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_tposte.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_p_candidat['prm_fonc'] == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence Fonction  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_fonction.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_p_candidat['prm_nfor'] == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence Formation  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_formation.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_p_candidat['prm_mobil'] == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence Moblité  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_mobilite.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_p_candidat['prm_n_mobil'] == "1"){  ?>

            <tr>

            <td style=" background-color: white; ">Pertinence Niveau Mobilité  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_niveau_mobilite.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_p_candidat['prm_t_mobil'] == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence Taux Mobilité   </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_taux_mobilite.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } ?>

            <tr>

            <td style=" background-color: white; ">

            <strong>Pertinence total </strong></td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white; ">

            <?php echo ''.$n_pertinence.'%'; ?></td>

            </tr>

            </table>

            </span>



            </a>

        </div>



    </td>



<?php  



	} 

	 

?>



  

    

    <td><?php echo "<b>".date('d.m.Y',strtotime($return['dateMAJ']))."</b>"; ?></td>

        <td align="center">

 

    <?php 

        $select  = mysql_query("select * from historique where id_candidature = '".$return['id_candidature']."'");

            $hist = mysql_fetch_array($select);

            $his=$hist['date_modification'];

            if($hist['date_modification']=="")

    $his="non définie";

 

        $select_cv = mysql_query("select * from  candidats where  candidats_id = '".$return['candidats_id']."' ");

    $cv = mysql_fetch_array($select_cv);

 

    $id_candidat = $return['candidats_id'];

    $selecCV=mysql_query("select * from cv  join candidature on cv.id_cv= candidature.id_cv where cv.candidats_id='$id_candidat'  ");

$councv = mysql_num_rows($selecCV);

  $result_cv =mysql_fetch_array($selecCV);

  

              $select_model = mysql_query("select * from lettres_motivation  join candidature on lettres_motivation.id_lettre= candidature.id_lettre where  candidature.id_candidature = ".$return['id_candidature']." ");

           

    $data_lettre = mysql_fetch_array($select_model);

  

        $lettre_a = $data_lettre['lettre'] ;

    

    if($councv)

{   if(strpos($result_cv['lien_cv'], ".pdf") or strpos($result_cv['lien_cv'], ".PDF"))

        $img = '<i class="fa fa-file-pdf-o fa-fw fa-lg"></i>';

     if(strpos($result_cv['lien_cv'], ".doc") OR strpos($result_cv['lien_cv'], ".DOC") OR strpos($result_cv['lien_cv'], ".rtf") OR strpos($result_cv['lien_cv'], ".RTF"))

        $img = '<i class="fa fa-file-word-o fa-fw fa-lg"></i>';

        }

else

    $img = '<i class="fa fa-file-pdf-o fa-fw fa-lg"></i>';

  //fin code

 

    echo  '<a href="'.$urladmin.'/cv/dcv/?cv='.$result_cv['lien_cv'].'&id_candidat='.$id_candidat.' &id_cv='.$result_cv['id_cv'].'  " title="Voir le CV">'.$img.'</a> ';



     

        $select  = mysql_query("select * from candidature where id_candidature = '".$return['id_candidature']."'  ");

            $reponse = mysql_fetch_array($select);

        

         

        $selecLettre=mysql_query("select * from lettres_motivation  join candidature on lettres_motivation.id_lettre = candidature.id_lettre where lettres_motivation.candidats_id='$id_candidat'  ");

$counlettre = mysql_num_rows($selecLettre);

     

if($counlettre)

 echo '<a href="'.$urladmin.'/cv/dlm/?cv='.$data_lettre['lettre'].'"   title="Voir la lettre de motivation" style="margin:0 4px 0 0">

<i class="fa fa-file-word-o fa-fw fa-lg"></i></a>';

    

	

    echo ' <a href="'.$urladmin.'/popup/transferer_email/?email='.$select_cv['email'].'&cv='.$result_cv['lien_cv'].'&lm='.$lettre_a.'" title="Transf&eacute;rer le cv">

                <i class="fa fa-envelope fa-fw fa-lg"></i>

            </a> ';

?>



<div style="float: right">        <input name="select_candidat[]" id="select<?php echo $i; ?>" type="checkbox" 		value="<?php echo $resultat['candidats_id']; ?>_<?php echo $result_cv['id_cv']; ?>" onclick="colorer('<?php echo $i; ?>')" 		<?php if(isset($_POST['id_candidat']) && ($return['candidats_id'] == $_POST['id_candidat'])) echo 'checked'; ?> />    </div>





</td>

    



    

  </tr>

     <?php

         

         

         

         

        

     }

          

         

        ?>

    </tbody>

     </table>

 

          <div id="pager_archive">        

		  <img  style="float: right" class="selectallarrow" src="<?php echo $imgurl ?>/arrow_ltr_b.png" alt="<?php echo $lang['ADMIN_CANDIDATURE_ZONE5_33']; ?>">          

		  </div>	     

		  <div style="float: right; padding-right: 5px;" >     

		  Pour la sélection :      <input   name="cv_mass_tt" class="espace_candidat" type="submit" value="Télécharger les CV en masse"      alt="Emails avec pièce joint" style="    width: 200px;"/>	       

		  <!--

		  <br/>       

		  Pour la sélection :      <input  class="espace_candidat" name="email_tt" type="submit" value="Choisir un dossier"    alt="Choisir un dossier" style=" width: 200px; " />   	   

		  -->		  

		  </div><br/>	 

<?php

}

  else

    echo '<tr class="sectiontableentry1"><td colspan="6" align="center">Aucune candidature</td></tr></tbody></table>'; 

    

    

  

?>

     <p>

     <input name="candidature" type="hidden" value="<?php echo $candidature; ?>" />

 

     </p></form>

	 

	 



    <div class="pagination">

			 

			<?php 	if( $cc>10  or $nbPages>1 ) { ?>

			<div style="  float: left;" >

				<form id="frm" method='post' >

					<select onchange="this.form.submit()" name="t_p_g"  style="width: 50px; margin-right: 20px;" >

						<option value="10"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='10')  echo "selected"; ?> >10 </option>

						<option value="20"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='20')  echo "selected"; ?> >20 </option>

						<option value="30"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='30')  echo "selected"; ?> >30 </option>

						<option value="40"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='40')  echo "selected"; ?> >40 </option>

						<option value="50"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='50')  echo "selected"; ?> >50 </option>

						<option value="10000" <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='10000') echo "selected"; ?> >100</option>

			<option value="99999" <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='99999') echo "selected"; ?> >Tous</option>	

					 </select>

				</form>

			</div>

			<?php 	} ?>

           

			<div id="">

					<?php        

					$lapage = '?offre='. $_GET['offre'];

					

					require_once (dirname ( __FILE__ ) . $incurl3.'/class.pagination2.php');

					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 ); 

				/*

         $lapage = 'pages/'  ;

           require_once (dirname ( __FILE__ ) . $incurl3.'/class.pagination.php');

                     

          Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2,$urladmin.'/offres/liste_offre/candidature' );

              */

          ?>

			</div>

    </div>

