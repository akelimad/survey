

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

    <th  align="center" width="6%" ><b>Détails</b></th>

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

$date_naissance = str_replace('/', '-', $data00['date_n']);

$date_naissance_c = date('Y-m-d', strtotime($date_naissance));

$age_c = strtotime($date_naissance_c);

$newformat = date('Y-m-d',$age_c); 

$age = (time() - strtotime($newformat)) / 3600 / 24 / 365;

$nomPre = $return['prenom'].'&nbsp;'.$return['nom'];



        

        ?>

       

         <i class="fa fa-user"></i> 

       <a class="info" href="<?php echo $urladmin; ?>/cv/?candid=<?php echo $data00['candidats_id']; ?>"  > 

       <?php echo '<b>' . $data00['prenom'].'&nbsp;'.$data00['nom'].'   |  '.number_format($age,0).' ans  </b>';  ?>

		 <i class="fa fa-external-link"></i>

			<span style="width:90px;padding:6px">  D&eacute;tail du candidat </span> 

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

            $select_fiche = mysql_query("select * from  candidats where candidats_id = '".$return['candidats_id']."' ");

            $fiche = mysql_fetch_array($select_fiche);

            $datemaj=$fiche['dateMAJ'];

            echo time_ago($datemaj);

        ?>

        <br/>

        <?php 

        //////////////////////

            $select_experience = mysql_query("select * from  candidats where candidats_id = '".$return['candidats_id']."' ");

            $r_expe = mysql_fetch_array($select_experience);

            $id_expe01=$r_expe['id_expe']; 

            $select_exp = mysql_query("select * from prm_experience where id_expe = '".$id_expe01."' ");

            $exp = mysql_fetch_array($select_exp);

            echo  $exp['intitule'];

        ///////////////////// 

        ?>

        <br/>

        <?php 

            $select_salaire = mysql_query("select * from prm_salaires where id_salr = '".$return['id_salr']."' ");

            $salaire = mysql_fetch_array($select_salaire);

            echo  $salaire['salaire'];

        ?>

        <br/>

        <?php 

            echo  $fiche['mobilite'];

        ?>    

    </td>

    <td>

       

             

       <?php 

             

            $select_cv = mysql_query("select * from  candidats where candidats_id = '".$return['candidats_id']."' ");

            $cv = mysql_fetch_array($select_cv);

           

            $id_candidat = $return['candidats_id'];

            $selecCV=mysql_query("select * from cv  join candidature on cv.id_cv= candidature.id_cv 

                where candidature.candidats_id='$id_candidat'  ");

            $councv = mysql_num_rows($selecCV);

            $result_cv =mysql_fetch_array($selecCV);

             

            if($councv)

            {

                if(strpos($result_cv['lien_cv'], ".pdf") or strpos($result_cv['lien_cv'], ".PDF"))

                    $img = '<i class="fa fa fa-file-pdf-o  fa-fw fa-2x" ></i>';

                if(strpos($result_cv['lien_cv'], ".doc") OR strpos($result_cv['lien_cv'], ".DOC") 

                    OR strpos($result_cv['lien_cv'], ".rtf") OR strpos($result_cv['lien_cv'], ".RTF"))

                    $img = '<i class="fa fa-file-word-o  fa-fw fa-2x" ></i>';

            }

            else

            $img = '<i class="fa fa fa-file-pdf-o  fa-fw fa-2x" ></i>';

            echo  '<a href="'.$urladmin.'/cv/dcv/?cv='.$result_cv['lien_cv'].'&id_candidat='.$id_candidat.' 

                &id_cv='.$result_cv['id_cv'].'

              " title="Voir le CV">'.$img.'</a> ';

            $select_model = mysql_query("select * from lettres_motivation  join candidature 

                on lettres_motivation.id_lettre= candidature.id_lettre 

                where  candidature.id_candidature = ".$return['id_candidature']." ");

            $data_lettre = mysql_fetch_array($select_model);

            $lettre_a = $data_lettre['lettre'] ; 

            $selecLettre=mysql_query("select * from lettres_motivation  

                join candidature on lettres_motivation.id_lettre = candidature.id_lettre 

                where candidature.candidats_id='$id_candidat'  ");

            $counlettre = mysql_num_rows($selecLettre); 

            if($counlettre)

                echo '<a href="'.$urladmin.'/down_lm.php?cv='.$data_lettre['lettre'].'"   

                    title="Voir la lettre de motivation" style="margin:0 4px 0 0">

                    <i class="fa fa fa-file-pdf-o  fa-fw fa-2x" ></i>

                </a>';

              

            $select  = mysql_query("select * from candidature where id_candidature = '".$return['id_candidature']."'");

            $reponse = mysql_fetch_array($select);

             

         

           //fin pertinence   

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

    <th  colspan="2"><b>Informations Candidatures</b></th> 

    <th  colspan="2"><b>Détails</b></th>

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

    <td width="15%">

          

        <?php    

		

		$selectString1 = "select * from   candidature    WHERE  id_candidature = '".$return['id_candidature']."' LIMIT 0 , 1";   

        $select1 = mysql_query( $selectString1); 

		$data001 = mysql_fetch_array($select1);

		echo '<strong>' .$data001['status'].'  </strong>   ' ; 

		

		?>

		 

    </td>



    <td width="2%">

  

    </td>   

    <td width="20%">

             

       <table><?php 



		if($data001['status'] == 'En attente'){

		

			     echo '<tr> <td> ---  </td> <td></td></tr> ' ; 

				 

		}	else	 {

              

			  $req00_theme = mysql_query( "SELECT * FROM historique where id_candidature = '".$return['id_candidature']."' ORDER BY   date_modification  ASC");

        		

            while($data00 = mysql_fetch_array($req00_theme) )

             {

			     echo '<tr> <td> ' .$data00['status'].'   </td>   ' ; 

			     //echo '<tr> <td> ' .$data00['utilisateur'].'   </td>   ' ; 

           //echo '<tr> <td> ' .$data00['commentaire'].'   </td>   ' ; 

            

			     echo '<td> ' .$data00['date_modification'].'  </td> </tr> ' ; 

			 }

			 

		 }

         

    ?></table>

    </td>

    <td width="2%">

           

    </td>

    <td>

        <?php 

            $percent = $return['pertinence'];

      /*echo $percent;*/

            $percent_for = 0;

            $percent_sec = 0;

            $percent_exp = 0;

            if($percent == 100 ) {

                $percent_for = 100;$percent_exp = 100; }

        

            /*if($percent == 33 || $percent == 65 || $percent == 67 || $percent == 99 ) 

                $percent_sec = 33;*/

            if($percent == 60 ) {

                $percent_exp = 100; }             

            if($percent == 40 ) {

                $percent_for = 100; }

            $percent = ($percent_for + $percent_exp)/2;



            $color='#000000';  

        if($percent == 100 ) {

            $color='#00B300';  }

        elseif($percent < 70 and $percent > 30)  {

            $color='#CC5500'; }

        elseif($percent ==  0 ){ 

            $color='#D50000'; }

        /*if($percent >= 90 and $percent = 100) 

            $color='#00B300';  

        elseif($percent >= 60 and $percent <= 70) 

            $color='#CC5500';  

        elseif($percent >= 30 and $percent <= 40) 

            $color='#D50000'; 

        elseif($percent >=  0 and $percent <= 10) 

            $color='#000000';                  

          */          

    

        echo '<div style="float: right;margin:1px 20px 1px 0px ;">';    

            echo '<a href="javascript:void(0)" class="info"><div style="width: 15px; height: 15px; background: '.$color.'; -moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;"></div><br/><span id="tableau" ><table>

            <tr><td style=" background-color: white; width:77% ">Pertinence formation </td>

            <td style=" background-color: white; width: 10%;">=</td><td style=" background-color: white; width: 20%;">

            '.$percent_for.'%</td></tr><tr><td style=" background-color: white; ">Pertinence experience </td>

            <td style=" background-color: white;  ">=</td><td style=" background-color: white;">

            '.$percent_exp.'%</td></tr><tr><td style=" background-color: white; "><strong>Pertinence total </strong></td>

            <td style=" background-color: white;  ">=</td><td style=" background-color: white; ">

            '.$percent.'%</td></tr></table></span></a>';                    

        echo '</div>';

        ?>

    </td>

    <td>

        <?php echo $return['reference']; ?>

    </td>

    <td>

        <?php echo $return['Name']; ?>

    </td>

    <td>

        <?php echo ' ' . date ( "d / m / Y", strtotime ( $return ['date_candidature'] ) ); ?>

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

 