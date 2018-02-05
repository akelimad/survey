<table>

<tr><td>

    <b style="font-size: 10px;"> * Le point en couleur montre la pertinence de la candidature (<span style="color:#79796A"><a style="color:#00B300">Vert</a>: pertinence bonne, <a style="color:#CC5500;">Orange</a>: Pertinence moyenne,  <a style="color:#CC0000">Rouge</a>: pertinence faible </span>). </b>

    </td></tr></table>      

 

 

 <table   width="100%" border="0" id="matching_offres_resultat" class="tablesorter" style="background: none;">

  <thead>

   <tr>

    <th  class="tableentete" ><b>N°</b></th>

    <th  class="tableentete" colspan="3" ><b>Informations Candidats</b></th>

    <th  width="8%"  ><b>Date</b></th>

    <th class="tableentete" width="1%" ><b>Pertinence</b></th>

    <th class="tableentete" width="11%" ><b>Actions</b></th>

  </tr>

  </thead>

  <tbody>

  <?php

  $cc = mysql_num_rows($req);

  //echo $cc;

  if($cc)

  { 

  $ii = 1;$i=0;

 

  $alter_class=1;$inum=0;

  mysql_data_seek($req,0);$jj=0;

  while($return_g = mysql_fetch_array($req))

     {

		 

	/*	 

	iw__link_begin:

	*/

	

$p_id_offre		= $_SESSION['id_offre']		; 

$p_candidats_id	=  $return_g['candidats_id'];



$prm_titre		= $_SESSION['prm_titre']	; 

$prm_expe		= $_SESSION['prm_expe'] 	; 

$prm_local		= $_SESSION['prm_local'] 	; 

$prm_tpost		= $_SESSION['prm_tpost'] 	; 

$prm_fonc		= $_SESSION['prm_fonc'] 	; 

$prm_nfor		= $_SESSION['prm_nfor'] 	; 

$prm_mobil		= $_SESSION['prm_mobil'] 	; 

$prm_n_mobil 	= $_SESSION['prm_n_mobil'] 	; 

$prm_t_mobil 	= $_SESSION['prm_t_mobil'] 	; 

           

     

$min_p_a_req 	= $_SESSION['min_p_a_req'] 	; 



	

	include ("matching_off_resuta_m_table_m_perti.php"); 	 

		 

		  $inum++;

$is=$inum+$limitstart;

		 

		 /*==================================================================================================================================*/

		   $ref_candidats = mysql_query("SELECT * FROM candidats  WHERE candidats_id = '".$return_g['candidats_id']."' limit 0,1");

            $return = mysql_fetch_array($ref_candidats);

			 

	

			$exxp=mysql_query("select * from prm_experience where id_expe= '".$return['id_expe']."'  limit 0,1"); 

			$xexxp = mysql_fetch_array($exxp);

			

			$select_exp = mysql_query("select * from prm_pays where id_pays = '" . $return['id_pays'] . "'  limit 0,1"); 

			$exp = mysql_fetch_array($select_exp); 

			$result01 = mysql_query("select * from prm_situation where id_situ = '".$return['id_situ']."'  limit 0,1");

			$row01 = mysql_fetch_row($result01);

			$result02 = mysql_query("select * from prm_niv_formation where id_nfor = '".$return['id_nfor']."'  limit 0,1");

			$row02 = mysql_fetch_row($result02);

			$result03 = mysql_query("select * from prm_type_formation where id_tfor = '".$return['id_tfor']."'  limit 0,1");

			$row03 = mysql_fetch_row($result03);

			

			$secc = mysql_query( "SELECT * FROM prm_sectors where id_sect = '".$return['id_sect']."'  limit 0,1");

			$rcc = mysql_fetch_array($secc);

			 

		 

		    $select_salaire = mysql_query("select * from prm_salaires where id_salr = '".$return['id_salr']."'  limit 0,1");

			$salaire = mysql_fetch_array($select_salaire);    

	 

			

			

			

 



            $s_pertinence_sql = "SELECT * FROM pertinence_oc    WHERE candidats_id = '".$return['candidats_id']."'     and id_offre = '".$id_offre."'     and ref_p = 'd' limit 0,1";

            $q_pertinence_g = mysql_query($s_pertinence_sql);

            $s_pertinence_g = mysql_fetch_array($q_pertinence_g);

			

			

			 

	    

			$selecCV=mysql_query("select * from cv  where candidats_id='".$return['candidats_id']."'  "); 

			$result_cv =mysql_fetch_array($selecCV);    

			

			$select_model = mysql_query("select * from lettres_motivation  where  candidats_id = ".$return['candidats_id']." ");           

			$data_lettre = mysql_fetch_array($select_model);

			

		           

		 

		 /*==================================================================================================================================*/

		                       



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



			/*

			 while( empty($r_n_pertinence)) {$return_g = mysql_fetch_array($req);goto iw__link_begin;}

			*/

		 

		 /*==================================================================================================================================*/

		 

         $ii == 1 ? $ii++ : $ii--;

         $i++;

  ?>  

  <tr      class="<?php     if($alter_class==1) {echo 'even1'; $alter_class++;} else {echo 'odd1';  $alter_class--;}   ?>"   id="select<?php echo $i; ?>"  onmouseover="this.className='marked'" onmouseout="pasdecouleur('<?php echo $i; ?>','<?php echo $ii; ?>')">

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

                

    

              

         <a class="info" href="<?php echo $urladmin; ?>/cv/?candid=<?php echo $return['candidats_id']; ?>"  > 

		  <?php

    echo '<b style="font-size: 12px;">'.$return['prenom'].'&nbsp;'.$return['nom'].' |  '.number_format($age,0).' ans </b>'; 

      ?>

	  

         </a>

		 

		 <br/>

         <?php

 



echo $return['titre']."<b> </b><br/>";

?>

<?php



echo $exp['pays']; ?><b> | </b> <?php  echo $row01[1].' <b> | </b> '.$row02[1]; ?>

           <br/> <?php 



echo $rcc['FR']."<b> | </b>".$return['email']; ?> <br />



                  <br /></td>

    <td width="16%"><strong>Fra&icirc;cheur du cv</strong><br />

                  <strong>Exp&eacute;rience</strong><br />

                  <strong>Salaire souhait&eacute;</strong><br />

                <strong>Mobilit&eacute;</strong></td>

                <td width="17%"><?php 



    $datemaj=$return['dateMAJ'];

echo time_ago($datemaj);

        ?>

        <br/>

        <?php 



    echo  $xexxp['intitule'];

        ?>

        <br/>

        <?php 



    echo  $salaire['salaire'];

        ?>

        <br/>        <?php 

        echo  $return['mobilite'];

        ?>    </td>

    

   

    <td><?php echo date('d-m-Y',strtotime($return['dateMAJ'])); ?></td>

    



        

        <td align="center">

		 <?php 

                  

           $color='#000000';  

        if($r_n_pertinence == 100 ) {

            $color='#00B300';  }

        elseif($r_n_pertinence < 100 and $r_n_pertinence >= 40)  {

            $color='#CC5500'; }

        elseif($r_n_pertinence <  40 ){ 

            $color='#D50000'; }

    

        ?> <div style="float: right;margin:1px 20px 1px 0px ;">

          <a href="#" class="info">



          <div style="width: 15px; height: 15px; background: <?php echo $color; ?>;

           -moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;"></div>

          <br/><span id="tableau" style="width: 200px;padding:6px">

          <table>

            <!-- /////////////////////////  -->

            <?php

            

            ?>

            <?php if($prm_titre == "1"){ ?>

            <tr>

            <td style=" background-color: white; width:77% ">Pertinence Titre </td>

            <td style=" background-color: white; width: 10%;">=</td>

            <td style=" background-color: white; width: 20%;">

            <?php echo ''.$percent_titre.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_expe == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence expérience  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_expe.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_local == "1"){ ?>

            <tr>

            <td style=" background-color: white; ">Pertinence Ville  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_ville.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_tpost == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence Type de poste  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_tposte.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_fonc == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence Fonction  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_fonction.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_nfor == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence Formation  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_formation.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_mobil == "1"){?>

            <tr>

            <td style=" background-color: white; ">Pertinence Moblité  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_mobilite.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_n_mobil == "1"){  ?>

            <tr>

            <td style=" background-color: white; ">Pertinence Niveau Mobilité  </td>

            <td style=" background-color: white;  ">=</td>

            <td style=" background-color: white;">

            <?php echo ''.$percent_niveau_mobilite.'%'; ?></td>

            </tr>

            <!-- /////////////////////////  -->

            <?php } if($prm_t_mobil == "1"){?>

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

    

    

        <td align="center">



<form action="../../../candidatures/postuler/" method="POST" name="formulaire<?php echo ++$jj; ?>">

<input type="hidden" name="menu_type" value="offre" />

<input type="hidden" name="offre" value="<?php echo $id_offre; ?>" />

<input type="hidden" name="id_candidature" value="<?php echo $return['candidats_id']; ?>" /> 

<input type="hidden"  id="edit" name="ok"  value=""   title="Edit ce message" class="cu" /> 

<a href="javascript:void(0)" onclick="formulaire<?php echo $jj; ?>.submit()" title="Affecter à l'offre" name="edit">

<i class="fa fa-pencil-square-o fa-fw fa-lg"></i></a>&nbsp;



    <?php  



  



  

        $lettre_a = $data_lettre['lettre'] ;

    

    if($result_cv)

{   if(strpos($result_cv['lien_cv'], ".pdf") or strpos($result_cv['lien_cv'], ".PDF"))

        $img = '<i class="fa fa-file-pdf-o fa-fw fa-lg"></i>';

     if(strpos($result_cv['lien_cv'], ".doc") OR strpos($result_cv['lien_cv'], ".DOC") OR strpos($result_cv['lien_cv'], ".rtf") OR strpos($result_cv['lien_cv'], ".RTF"))

        $img = '<i class="fa fa-file-word-o fa-fw fa-lg"></i>';

        }

else

    $img = '<i class="fa fa-file-pdf-o fa-fw fa-lg"></i>';

 

 

    echo  '<a href="'.$urladmin.'/cv/dcv/?cv='.$result_cv['lien_cv'].'&id_candidat='.$return['candidats_id'].' &id_cv='.$result_cv['id_cv'].'  " title="Voir le CV">'.$img.'</a> ';



    



        



     

if($data_lettre)

 echo '<a href="'.$urladmin.'/cv/dlm/p?cv='.$data_lettre['lettre'].'"   title="Voir la lettre de motivation" style="margin:0 4px 0 0">

<i class="fa fa-file-word-o fa-fw fa-lg"></i></a>';

      





	  echo ' <a href="'.$urladmin.'/popup/transferer_email/?email='.$return['email'].'&cv='.$result_cv['lien_cv'].'&lm='.$lettre_a.'" title="Transf&eacute;rer le cv">

                <i class="fa fa-envelope fa-fw fa-lg"></i>

            </a> '; 



 

?>

</form>

</td>

    



    

  </tr>

     <?php 

     }

           

        ?>

    </tbody>

     </table>

  

<?php   if( $cc>10  or $nbPages>1 ) { ?>

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

      <?php   } ?>

    <div class="pagination">

         <?php        

            $lapage = '?offre='.$id_offre;

            

            require_once (dirname ( __FILE__ ) . $incurl3.'/class.pagination2.php');

            

            Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 );

            

            ?>

    </div>



  

  

     <?php

    }

    else

       echo '<tr class="sectiontableentry1"><td colspan="7" align="center">Aucune candidature</td></tr></tbody></table>'; 



?>





 

  

