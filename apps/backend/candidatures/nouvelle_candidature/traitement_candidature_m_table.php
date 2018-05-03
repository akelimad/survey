







  <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" >  

  

      <b> * Le point en couleur montre la pertinence de la candidature (<span style="color:#79796A"><a style="color:#00B300">Vert</a>: pertinence bonne, <a style="color:#CC5500;">Orange</a>: pertinence moyenne,  <a style="color:#CC0000">Rouge</a>: pertinence faible  </b><b>).</b>

<!-- ///////////////////////////////////////////////////////////// -->

<?php if($_SESSION['r_prm_export_candidature']==0){ ?>

<?php include('traitement_candidature_m_table_excel.php'); ?>

<?php } ?>

<!-- ///////////////////////////////////////////////////////////// -->

<table width="100%"  id="nouvelle_candidature_table" class="tablesorter" >

  



  <thead>



   <tr>

    <th  colspan="3"><b>Informations Candidats</b></th> 

    <th  align="center" width="6%" ><b>Détails</b></th>

			

<?php  



	if($_SESSION['r_prm_pertinenc_cnddtr']==0){

	 

?>	

    <th width="1%"><b>P</b></th>



<?php  



	} 

	 

?>



			

<?php  



	if($_SESSION['r_prm_note']==0){

		 

		

?>



    <th width="1%"><b>Notation</b></th>

	

<?php  

 

		}

		

?>

    <th  width="2%"><b>Réf  </b></th>

    <th  width="15%" ><b>Titre du poste</b></th>

    <th  width="8%" class="sorter-shortDate dateFormat-ddmmyyyy"><center><b>Date</b></center></th>

    <th  width="15%"><center><b>Actions</b></center></th>

  </tr>



  </thead>



  <tbody>



  <?php

        $cc = mysql_num_rows($rst_pagination);

        if($cc)

        { 

          $ii = 1;$i=0;

          $alter_class=1;

          mysql_data_seek($rst_pagination,0);

          while($return = mysql_fetch_array($rst_pagination))

             {

                 $ii == 1 ? $ii++ : $ii--;

                 $i++;

				 

				 

				 

				 /*========================================================================================================================*/

				include('traitement_candidature_m_table_traitement.php');

				 /*========================================================================================================================*/

				 

				 

				  

				 

				 

				 

          ?>  

  <tr

      <?php

      if($alter_class==1) {echo 'style="background-color:#E8F0F0"'; $alter_class++;} 

      else {echo 'style="background-color:#DDDDDD"';  $alter_class--;}

      ?> id="<?php echo $i; ?>"  onmouseover="this.className='marked'" onmouseout="this.className=''" >

    <td width="18%">

          

        <?php 

        

         

$newformat = eta_date($r_candidats['date_n'], 'Y-m-d'); 

$age = (time() - strtotime($newformat)) / 3600 / 24 / 365;

 ?>

		

<?php



$info_entr = 'color:#090'  ;

$lien_candidats =  ''.$urladmin.'/historique_candidats/candidats/?btn_a=m&idcand='.$r_candidats['candidats_id'].''; 

?>



<a class="info" href="<?php echo $lien_candidats; ?>" title="Historique de toutes les candidatures"> 

<i class="fa fa-user fa-fw fa-lg" style="<?php echo $info_entr;?> "></i>

</a> 

         <a class="info" href="<?php echo $urladmin; ?>/cv/?candid=<?php echo $r_candidats['candidats_id']; ?>"  >

         <?php echo '<b>' . $r_candidats['prenom'].'&nbsp;'.$r_candidats['nom'].'<br/>'.number_format($age,0).' ans </b>'; ?>

		 <i class="fa fa-external-link"></i>

			<span style="width:90px;padding:6px">  D&eacute;tail du candidat </span> 

         </a>

		 

		 <br/> 

              

<?php

 

 

?>

<?php

 



echo $r_prm_pays['pays']; ?><b> | </b> <?php  echo $r_prm_niv_formation['formation'].' <br/> '.$r_prm_sectors['FR'];



 ?>

           <br/> <?php 





echo $r_prm_situation['situation'];



 ?> <br />

 <?php if($_SESSION['r_prm_region_off']==0){ ?>

        <strong>Ville d'affectation</strong><br/>

        <?php echo "".$r_prm_region_ville['ville_region']."";?>

        <?php } ?>

        <br /><br/>

    </td>



    <td width="12%">

        

        <strong>Exp&eacute;rience</strong><br />

        <strong>Salaire souhait&eacute;</strong><br />

        <strong>Mobilit&eacute;</strong><br />

        <strong>Fra&icirc;cheur du cv</strong><br/>

        

    </td>   

    <td width="14%">

        

       

        <?php 

        //////////////////////

 

            echo  $r_prm_experience['intitule'];

        ///////////////////// 

        ?>

        <br/>

        <?php 

 

            echo  $r_prm_salaires['salaire'];

        ?>

        <br/>

        <?php 

  

            echo  $r_candidats['mobilite'];

        ?>

        <br/>

        <?php 

            

            echo "".time_ago($r_candidats['dateMAJ'])."";

        ?> 

        

        

    </td>

    <td>

       

             

       <?php 

             

 

             

            if($r_cv['lien_cv'])

            {

                if(strpos($r_cv['lien_cv'], ".pdf") or strpos($r_cv['lien_cv'], ".PDF"))

                    $img = '<i class="fa fa fa-file-pdf-o  fa-fw fa-lg" ></i>';

                if(strpos($r_cv['lien_cv'], ".doc") OR strpos($r_cv['lien_cv'], ".DOC") 

                    OR strpos($r_cv['lien_cv'], ".rtf") OR strpos($r_cv['lien_cv'], ".RTF"))

                    $img = '<i class="fa fa-file-word-o  fa-fw fa-lg" ></i>';

            }

            else

            $img = '<i class="fa fa fa-file-pdf-o  fa-fw fa-lg" ></i>';

            echo  '<a href="'.$urladmin.'/cv/dcv/?cv='.$r_cv['lien_cv'].'&id_candidat='.$id_candidat.' 

                &id_cv='.$r_cv['id_cv'].'

              " title="Voir le CV">'.$img.'</a> ';

			  

			  

            

			

            if($r_lettres_motivation["lettre"])

                echo '<a href="'.$urladmin.'/cv/dlm/?cv='.$r_lettres_motivation['lettre'].'"   

                    title="Voir la lettre de motivation" style="margin:0 4px 0 0">

                    <i class="fa fa fa-file-pdf-o  fa-fw fa-lg" ></i>

                </a>';

              

 

             

         

           //fin pertinence   

    ?>    

        

    </td>		

  

		

			

<?php  



	if($_SESSION['r_prm_pertinenc_cnddtr']==0){

	 

?>

	<td>

        <?php 

            

			      $ref_pertinence = mysql_query("SELECT * FROM prm_pertinence 

              WHERE ref_p = 'p' limit 0,1");

            $prm_p_candidat = mysql_fetch_array($ref_pertinence);



            $s_pertinence_sql = "SELECT * FROM pertinence_oc 

              WHERE candidats_id = '".$r_candidats['candidats_id']."' 

              and id_offre = '".$r_offre['id_offre']."' 

              and ref_p = 'p' limit 0,1";

			  //echo $s_pertinence_sql ;

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





<?php  



	if($_SESSION['r_prm_note']==0){

		 

		

?>

  

    <td>

        <center>

    <?php

         $sum_not='0';

                $his="non définie";



				

        if($r_notation_1){

        $sum_not = $r_notation_1['note_ecole'] + $r_notation_1['note_filiere'] + $r_notation_1['note_diplome'] + $r_notation_1['note_experience'] + $r_notation_1['note_stages'] ;

		}

        if(!empty($r_notation_1['id_candidature']))

        {



          

         ?>

        <?php

        $color_note = '';

        if($sum_not >= 70 ){  

        $color_note = "style='color: #00B300;'";}

          if($sum_not >= 40 and $sum_not < 70 ){

        $color_note = "style='color: #CC5500;'"; }

          if($sum_not >=10 and $sum_not <40){ 

        $color_note = "style='color: #CC0000;'"; }

          if($sum_not <10){ 

        $color_note = "style='color: #000000;'"; } 

     

		   //  Editer 

		   

            $his=$r_historique['date_modification']; 

                $a =$r_notation_1['note_ecole'];$b =$r_notation_1['note_filiere'];$c =$r_notation_1['note_diplome'];

                $d =$r_notation_1['note_experience'];$e =$r_notation_1['note_stages'];$f =$sum_not;

				/*if(!(isset($sum_not) OR $sum_not!=''))*/;

                echo '<a href="javascript:showDiv2_note(\''.$r_candidats['nom'].'\',\''.$r_candidats['prenom'].'\',

                    \''.$return['id_candidature'].'\',\''.$r_candidature['status'] .'\',\''.$his .'\',\''.$percent .'\'

                    ,\''.$a .'\',\''.$b .'\',\''.$c .'\',\''.$d .'\',\''.$e .'\',\''.$f .'\',\''.$sum_not .'\')"

                      title="Modifier la notation"  class="info"   >  ';

            //fin edit statut candidature



      ?>

	  

        <p> <?php		 

            //  Editer 

          echo ' <b '.$color_note.'>'.$sum_not.'</b> ';

		  

            //fin edit statut candidature

      ?> </p>

 

      <span style="width:420px;padding:6px">

      <?php include('traitement_candidature_m_table_notation.php'); ?>

      </span></a> 

        <?php } else {

		echo '<p><b><a href="javascript:showDiv2_note(\''.$r_candidats['nom'].'\',\''.$r_candidats['prenom'].'\',

                    \''.$return['id_candidature'].'\',\''.$r_candidature['status'] .'\',\''.$his .'\',\''.$percent .'\'

                    ,\'0\',\'0\',\'1\',\'0\',\'0\',\'0\')"

                      title="Editer la note de cette candidature"  class="info"   > 0 </a></b></p>';

		}?><br/> 

     

        </center>

    </td>

<?php  

 

		}

		

?>

    <td>

        <?php echo $r_offre['reference']; ?>

    </td>

    <td>

        <?php echo $r_offre['Name']; ?>

    </td>

    <td>

        <?php echo '<b>' . date ( "d.m.Y", strtotime ( $r_candidature ['date_candidature'] ) ).'</b>'; ?>

    </td>

    <td>



    <div style="float: left">

        <input name="select_candidat[]" id="select<?php echo $i; ?>" type="checkbox" value="<?php echo $return['candidats_id']; ?>" onclick="colorer('<?php echo $i; ?>')" <?php if(isset($_POST['id_candidat']) && ($return['candidats_id'] == $_POST['id_candidat'])) echo 'checked'; ?> />

    </div>

			<!--  -->

        <?php

            echo '<div style="float: left">';

            

            //  Editer 

        

            $his=$r_historique['date_modification'];

            if($r_historique['date_modification']=="")  $his="non définie";

                $a =$r_notation_1['note_ecole'];$b =$r_notation_1['note_filiere'];$c =$r_notation_1['note_diplome'];

                $d =$r_notation_1['note_experience'];$e =$r_notation_1['note_stages'];$f =$sum_not;

                echo '<a href="javascript:showDiv2(\''.$r_candidats['nom'].'\',\''.$r_candidats['prenom'].'\',

                    \''.$return['id_candidature'].'\',\''.$r_candidature['status'] .'\',\''.$his .'\',\''.$percent .'\'

                    ,\''.$a .'\',\''.$b .'\',\''.$c .'\',\''.$d .'\',\''.$e .'\',\''.$f .'\')"

                      title="Editer le statut de cette candidature"  class="email" id="email" >

                      <i class="fa fa-pencil fa-fw fa-lg"></i>

                </a>';

            //fin edit statut candidature

            

            

			

            echo ' <a href="'.$urladmin.'/popup/transferer_email/?email='.$r_root_roles['email'].'&cv='.$r_cv['lien_cv'].'&lm='.$r_lettres_motivation['lettre'].'" title="Transf&eacute;rer le cv">

               <i class="fa fa-envelope fa-fw fa-lg" ></i>

            </a> ';

			

            //fin envoyer cv

            echo ' <a href="'.$urladmin.'/popup/envoyer_email/?email='.$r_root_roles['email'].'&emailc='.$r_candidats['email'].' " 

            title="Envoyer un email au candidat">

             <i class="fa fa-envelope-o fa-fw fa-lg" ></i></a> '; 

			 

				 

				 

            echo '<a href="javascript:showDivd(\''.$r_candidats['nom'].'\',\''.$r_candidats['prenom'].'\',

                \''.$return['candidats_id'].'\')" title="Choisir un dossier" 

                class="dossier1" id="dossier1"><i class="fa fa-file fa-fw fa-lg" style="color:#47A948;"></i>

            </a>';

			

                echo '</div>';

        //fin code

        ?>



    <div style="float: right">

        <input name="select_candidature[]" id="select<?php echo $i; ?>" type="checkbox" value="<?php echo $return['id_candidature']; ?>" onclick="colorer('<?php echo $i; ?>')" <?php if(isset($_POST['candidature']) && ($return['id_candidature'] == $_POST['candidature'])) echo 'checked'; ?> />

    </div>

    </td>

  </tr>



     <?php

         

         

         

         

        



     }



         

       //   echo '<h1>'.$query.'</h1>';

         

        ?>



    </tbody>



     </table>



    <div id="pager_archive">

        <img  style="float: right" class="selectallarrow" src="<?php echo $imgurl ?>/arrow_ltr_b2.png" alt="Pour la sélection :">

      

    </div>

	

	

     <div style="float: right; padding-right: 5px;" >

  Pour la sélection : 

     <input   name="email_tt" class="espace_candidat" type="submit" value="Emails avec la pièce jointe" 

     alt="Email envoyé aux candidats" style="    width: 175px;"/>

	 

 

     <br/>

 

 

  Pour la sélection : 

     <input   name="partage_tt" class="espace_candidat" type="submit" value="Partager les candidatures" 

     alt="Partager les candidatures" style="    width: 175px;"/>

	 

 

     </div><br/>

     

    

    </form>





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

						<option value="100" <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='100') echo "selected"; ?> >100</option>

			<option value="99999" <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='99999') echo "selected"; ?> >Tous</option>	

					 </select>

				</form>

			</div>

			<?php 	} ?>

           

			<div id="">

					<?php        

					$lapage = basename($_SERVER['PHP_SELF']).'?';

					

					require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination2.php');

					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 ); 

					?>

			</div>

    </div>

						

			

    <div class="ligneBleu" style="  float: left;" ></div>

    <?php   }



    else



        echo '<tr class="sectiontableentry1"><td colspan="8" align="center">Aucune candidature</td></tr></tbody></table>'; 

?>



