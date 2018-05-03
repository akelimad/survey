

<?php





/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

   

$tpc = mysql_num_rows($req);                     

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



$sql_pagination=$query."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination



?>







<table width="100%"  id="nouvelle_candidature_table" class="tablesorter" >

  



  <thead>



   <tr>

    <th  colspan="3"><b>Informations Candidats</b></th> 

  </tr>



  </thead>



  <tbody>



  <?php

        $cc = mysql_num_rows($select);

        if($cc)

        { 

          $ii = 1;$i=0;

          $alter_class=1;

          mysql_data_seek($select,0);

          while($return = mysql_fetch_array($select))

             {

                 $ii == 1 ? $ii++ : $ii--;

                 $i++;

          ?>  

  <tr

      <?php

      if($alter_class==1) {echo 'style="background-color:#E8F0F0"'; $alter_class++;} 

      else {echo 'style="background-color:#DDDDDD"';  $alter_class--;}

      ?> id="<?php echo $i; ?>"  onmouseover="this.className='marked'" onmouseout="this.className=''" >

    <td width="20%">

          

        <?php 

    

                $req00_theme = mysql_query( "SELECT * FROM candidats where candidats_id = '".$return['candidats_id']."'");

                $data00 = mysql_fetch_array($req00_theme);

        

$select_exp = mysql_query("select * from prm_pays where id_pays = '" . $data00['id_pays'] . "' "); 

$exp = mysql_fetch_array($select_exp); 

$newformat = eta_date($data00['date_n'], 'Y-m-d'); 

$age = (time() - strtotime($newformat)) / 3600 / 24 / 365;

$nomPre = $return['prenom'].'&nbsp;'.$return['nom'];



        

        ?>

       

         <i class="fa fa-user"></i> 

       <?php echo '<b>' . $data00['prenom'].'&nbsp;'.$data00['nom'].'   |  '.number_format($age,0).' ans  </b>';  ?>

       <a class="info" href="<?php echo $urladmin; ?>/cv/?candid=<?php echo $data00['candidats_id']; ?>"  > 

       

		 <!--<i class="fa fa-external-link"></i>

			<span style="width:90px;padding:6px">  D&eacute;tail du candidat </span> -->

         </a>

		 

     <br/> 

 <?php

$select_exp = mysql_query("select * from candidats where candidats_id = '" . $data00['candidats_id'] . "' ");

$exp = mysql_fetch_array($select_exp);

$exxp=mysql_query("select * from prm_experience where id_expe= '".$data00['id_expe']."' "); 

$xexxp = mysql_fetch_array($exxp);

echo $exp['titre']."<br/>".$xexxp['intitule']."<br/>";

?>

<?php

$select_exp = mysql_query("select * from prm_pays where id_pays = '" . $data00['id_pays'] . "' "); 

$exp = mysql_fetch_array($select_exp); 

$result01 = mysql_query("select * from prm_situation where id_situ = '".$data00['id_situ']."' ");

$row01 = mysql_fetch_row($result01);

$result02 = mysql_query("select * from prm_niv_formation where id_nfor = '".$data00['id_nfor']."' ");

$row02 = mysql_fetch_row($result02);

$result03 = mysql_query("select * from prm_type_formation where id_tfor = '".$data00['id_tfor']."' ");

$row03 = mysql_fetch_row($result03);

$secc = mysql_query( "SELECT * FROM prm_sectors where id_sect = '".$data00['id_sect']."' ");

$rcc = mysql_fetch_array($secc);



echo $exp['pays']; ?><b> | </b> <?php  echo $row02[1].' | '.$rcc['FR']; ?>

           <br/> <?php 





echo $row01[1]; ?> <br /><br />

    </td>



    <td width="11%">

        <strong>Fra&icirc;cheur du cv</strong><br />

        <strong>Exp&eacute;rience</strong><br />

        <strong>Salaire souhait&eacute;</strong><br />

        <strong>Mobilit&eacute;</strong>

    </td>   

    <td width="15%">

        <?php 

            $select_fiche = mysql_query("select * from  candidats where candidats_id = '".$data00['candidats_id']."' ");

            $fiche = mysql_fetch_array($select_fiche);

            $datemaj=$fiche['dateMAJ'];

            echo time_ago($datemaj);

        ?>

        <br/>

        <?php 

        //////////////////////

            $select_experience = mysql_query("select * from  candidats where candidats_id = '".$data00['candidats_id']."' ");

            $r_expe = mysql_fetch_array($select_experience);

            $id_expe01=$r_expe['id_expe']; 

            $select_exp = mysql_query("select * from prm_experience where id_expe = '".$id_expe01."' ");

            $exp = mysql_fetch_array($select_exp);

            echo  $exp['intitule'];

        ///////////////////// 

        ?>

        <br/>

        <?php 

            $select_salaire = mysql_query("select * from prm_salaires where id_salr = '".$data00['id_salr']."' ");

            $salaire = mysql_fetch_array($select_salaire);

            echo  $salaire['salaire'];

        ?>

        <br/>

        <?php 

            echo  $fiche['mobilite'];

        ?>    

    </td>

    

 </tr>



     <?php

         

         

         

         

        



     }



         

       //   echo '<h1>'.$query.'</h1>';

         

        ?>



    </tbody>



     </table>

	    <?php   }



    else



        echo '<tr class="sectiontableentry1"><td colspan="8" align="center">Aucune information</td></tr></tbody></table>'; 

?>



















 

	 

	 

  <form action="../email_form_pop_p.php" method="post" name="global" >  

      <b> * Le point en couleur montre la pertinence de la candidature (<span style="color:#79796A"><a style="color:#00B300">Vert</a>: pertinence bonne, <a style="color:#CC5500;">Orange</a>: Pertinence moyenne,  <a style="color:#CC0000">Rouge</a>: pertinence faible. </b>

<table width="100%"  id="nouvelle_candidature_table" class="tablesorter" >

  



  <thead>



   <tr>

    <th  colspan="2"><b>Informations Candidats</b></th> 

   

    <th width="1%"><b>P</b></th>

    <th  width="2%"><b>Réf  </b></th>

    <th  width="15%" ><b><b>Titre du poste</b></th>

    <th  width="8%" class="sorter-shortDate dateFormat-ddmmyyyy"><b>Date</b></th>

    <!--<th  width="11%"><h2><b>Actions</b></h2></th>-->

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

          ?>  

  <tr style="background-color:#E8F0F0;border: 1px solid #FFF;" >

    <td width="10%">

          

        <?php    

		

		$selectString1 = "select * from   candidature    WHERE  id_candidature = '".$return['id_candidature']."' LIMIT 0 , 1";   

        $select1 = mysql_query( $selectString1); 

		$data001 = mysql_fetch_array($select1);

		$state_global=$data001['status'];

          if($state_global=='Cloturé') $state_global='Non retenu';

          if($state_global=='Non retenu') $state_global='Non retenu';

          if($state_global=='Non retenu') $state_global='Non retenu';



    echo '<strong>' .$state_global.'  </strong>   ' ; 

		

		?>

		 

    </td>



       

    <td width="30%">

             

       <table width="100%" ><?php 



		if($data001['status'] == 'En attente'){

		

			     echo '<tr> <td> ---  </td> <td></td></tr> ' ; 

				 

		}	else	 {

              

			  $req00_theme = mysql_query( "SELECT * FROM historique where id_candidature = '".$return['id_candidature']."' ORDER BY   date_modification  ASC");

       		echo '<tr>

          <th style="background-color: rgba(197, 209, 216, 0.25) !important;"><b>Date</b></th> 

          <th style="background-color: rgba(197, 209, 216, 0.25) !important;"><b>Action</b></th>

          <th style="background-color: rgba(197, 209, 216, 0.25) !important;"><b>Commentaire</b></th>

          </tr> ' ; 

            while($data00 = mysql_fetch_array($req00_theme) )

             {

			    $stat=$data00['status'];

          if($stat=='Présélection') $stat='Présélection';

          if($stat=='Entretien Métier') $stat='Entretien Métier';

          if($stat=='Entretien Direction Métier') $stat='Entretien Direction Métier';



        $selectusers = " SELECT * FROM root_roles a,per_filiale b

        where a.ref_filiale like b.ref_filiale

        AND a.login = '".$data00['utilisateur']."' LIMIT 0 , 1";  

        $selectusers = mysql_query($selectusers); 

        $datausers = mysql_fetch_array($selectusers);

        $nom_users=$datausers['nom'];$email_users=$datausers['login'];$filiale_users=$datausers['nom_filiale'];

        $nom_users="Nom : <b>".$nom_users." </b>";

        $email_users="Email : <b> ".$email_users."</b>";

        $filiale_users="Filiale : <b> ".$filiale_users."</b>";

           echo '<tr style="border: 1px solid #FFF;">

           <td width="20%"> <b>' .date("d.m.Y H:m:s",strtotime($data00['date_modification'])).'</b></td>

           <td width="30%"> 

           <b> ';  

           if($stat == 'En attente'){

            echo '' .$stat.'';

           }else{

           echo '' .$stat.'';

           /*<a class="info1" href="javascript:void(0)" onclick="return false">

           <i class="fa fa-external-link"></i>';

           

           <span style="width:280px;padding:6px;word-wrap: break-word; "> 

           <p>'.$nom_users.'</p>

           <p> '.$email_users.' </p>

           <p> '.$filiale_users.' </p>

          </span>

           echo '</a>';*/

           }

           echo '</b> 

           </td>   ' ; 

			     //echo '<td> ' .$data00['utilisateur'].'   </td>  ' ; 

           

            $motiv = couperChaine(strip_tags($data00['commentaire']), 10, 10);

            echo ' <td width="60%"> ' .$data00['commentaire'].'     </td>' ; 

                                /*

                                if(strlen($motiv)<strlen($data00['commentaire']))

                                { 

                                ?>

                                <a class="info1" href="javascript:void(0)" onclick="return false">

                                     <i class="fa fa-external-link"></i>

                                    

                                    <span style="width:450px;padding:6px;word-wrap: break-word; "> 

                                      

                                      <p>Commentaire : <b><?php echo $data00['commentaire'];?></b></p>

                                    </span>

                                </a></td> 

                                <?php } */?>

           <?php



           //echo ' <td width="70%"> ' .$profil = substr ( $data00['commentaire'], 0, 280 ).'   </td>   ' ; 

            

			     echo ' </tr> ' ; 

			 }

			 

		 }

         

    ?></table>

    </td>

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

          <br/>



            </a>

        </div>



    </td>

    <td>

        <?php echo $return['reference']; ?>

    </td>

    <td>

        <?php echo $return['Name']; ?>

    </td>

    <td>

        <?php echo ' ' . date ( "d.m.Y", strtotime ( $return ['date_candidature'] ) ); ?>

    </td>

	

  </tr>



     <?php

         

         

         

         

        



     }



         

       //   echo '<h1>'.$query.'</h1>';

         

        ?>



    </tbody>



     </table>

     



	 <br/>

     

    

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

					$lapage = '?idcand='.$idcand;

					

					require_once (dirname ( __FILE__ ) . $incurl3.'/class.pagination2.php');

					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 ); 

					 

					/* 

					$lapage = 'pages/'  ;

					require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination.php');

					 

					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2,$urladmin.'/accueil' );

			

					//*/

					?>

			</div>

    </div>

						

			

    <div class="ligneBleu" style="  float: left;" ></div>

  

    <?php   }



    else



        echo '<tr class="sectiontableentry1"><td colspan="8" align="center">Aucune candidature</td></tr></tbody></table>'; 

?>

 