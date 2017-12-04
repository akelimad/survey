  



<?php





/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

 

$select = mysql_query($selectString);



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



$sql_pagination=$selectString."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination



?>











<form name="F1" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

    <table width="100%" border="0" cellspacing="0" id="canadidats_historiquetable" class="tablesorter" style="background: none;">





<thead>



   <tr>



    

    <th ><b>Informations Candidats</b></th>

    <th   colspan="3" ><b>Détails</b></th>

    

    <th  align="center" width="10%" ><b> Actions </b></th>

  </tr>



  </thead>

<tbody>

<?php



$count = mysql_num_rows($rst_pagination);

if($count<1){

    echo  " <tr><td colspan='5'><center>Aucunes données trouvez</center></td></tr> ";}

else{

    ?>





<?php







 $ii = 1;

 $i = 0;

 $alter_class = 1;

 



 while ($resultat = mysql_fetch_array($rst_pagination)) {



 $ii == 1 ? $ii++ : $ii--;



 $i++;



 $id_candidat = $resultat['candidats_id'];



 

                                                                                                                

         $selecCV = mysql_query("select * from cv  where candidats_id='" . $resultat['candidats_id'] . "'  AND principal=1 AND actif=1".$g_by2);



         $councv = mysql_num_rows($selecCV);



         $result_cv = mysql_fetch_array($selecCV);

     



 //$selectt = mysql_query("select * from cvs_telecharges where id_candidat='$id_candidat' ");



// $countt = mysql_num_rows($selectt);



    



    



   

if (($councv) || (!$councv)) {

 ?>



 <tr id="<?php echo $i; ?>"  <?php     if($alter_class==1) {echo 'class="even"'; $alter_class++;} 

 else {echo 'class="odd"';  $alter_class--;}   ?>   id="<?php echo $i; ?>" onmouseover="this.className='marked'"   >



 



     <td width="47%">

                    <?php

$date_naissance = str_replace('/', '-', $resultat['date_n']);

$date_naissance_c = date('Y-m-d', strtotime($date_naissance));

$age_c = strtotime($date_naissance_c);

$newformat = date('Y-m-d',$age_c); 

$age = (time() - strtotime($newformat)) / 3600 / 24 / 365; 

?>

<i class="fa fa-user"></i> 

<a class="info" href="<?php echo $urladmin; ?>/cv/?candid=<?php echo $id_candidat; ?>"  > 

<?php   echo '<b>' . $resultat['prenom'].'&nbsp;'.$resultat['nom'] . '  |  '.number_format($age,0).' ans  </b> ';  ?>

		 <i class="fa fa-external-link"></i>

			<span style="width:90px;padding:6px">  D&eacute;tail du candidat </span> 

         </a>

		 

		 

     <br />

 <?php

$select_exp = mysql_query("select * from candidats where candidats_id = '" . $resultat['candidats_id'] . "' ");

$exp = mysql_fetch_array($select_exp);

$exxp=mysql_query("select * from prm_experience where id_expe= '".$resultat['id_expe']."' "); 

$xexxp = mysql_fetch_array($exxp);

echo $exp['titre']."<br/>".$xexxp['intitule']."<br/>";

?>

<?php

$select_exp = mysql_query("select * from prm_pays where id_pays = '" . $resultat['id_pays'] . "' "); 

$exp = mysql_fetch_array($select_exp); 

$result01 = mysql_query("select * from prm_situation where id_situ = '".$resultat['id_situ']."' ");

$row01 = mysql_fetch_row($result01);

$result02 = mysql_query("select * from prm_niv_formation where id_nfor = '".$resultat['id_nfor']."' ");

$row02 = mysql_fetch_row($result02);

$result03 = mysql_query("select * from prm_type_formation where id_tfor = '".$resultat['id_tfor']."' ");

$row03 = mysql_fetch_row($result03);

$secc = mysql_query( "SELECT * FROM prm_sectors where id_sect = '".$resultat['id_sect']."' ");

$rcc = mysql_fetch_array($secc);



echo $exp['pays']; ?><b> | </b> <?php  echo $row02[1].' | '.$rcc['FR']; ?>

           <br/> <?php 





echo $row01[1]; ?> <br /><br /></td>

                                                                                                                        



    <td >

     <center>

     





         <?php

         $selecCV = mysql_query("select * from cv  where candidats_id='" . $resultat['candidats_id'] . "'  AND principal=1 AND actif=1" .$g_by2  );



         $councv = mysql_num_rows($selecCV);



         $result_cv = mysql_fetch_array($selecCV);

         if ($councv) {



             if (strpos($result_cv['lien_cv'], ".pdf") || strpos($result_cv['lien_cv'], ".PDF") )

                 $img = '<i class="fa fa fa-file-pdf-o  fa-fw fa-lg" ></i>';







             if (strpos($result_cv['lien_cv'], ".doc") || strpos($result_cv['lien_cv'], ".DOC")|| strpos($result_cv['lien_cv'], ".DOCX")|| strpos($result_cv['lien_cv'], ".docx")|| strpos($result_cv['lien_cv'], ".rtf")|| strpos($result_cv['lien_cv'], ".RTF"))

                 $img = '<i class="fa fa-file-word-o  fa-fw fa-lg" ></i>';

         

         }



         else

         $img = '';

                           





     

             echo '<a   href="'.$urladmin.'/cv/dcv/?cv=' . $result_cv['lien_cv'] . '&id_candidat=' . 

             $resultat['candidats_id'] . ' &id_cv=' . $result_cv['id_cv'] . '  "   onclick="showUser()">' . $img . '</a>';

   

         ?>





         </center>

         </td>



     <td width="16%">

        <strong>Fra&icirc;cheur du cv</strong><br />







         <strong>Exp&eacute;rience</strong><br />







         <strong>Salaire souhait&eacute;</strong><br />







         <strong>Mobilit&eacute;</strong><br /></td>







     <td width="22%"><?php

 $select_date = mysql_query("select dateMAJ from candidats  where candidats_id = '" . $resultat['candidats_id'] . "' ");







 $datetime = mysql_fetch_array($select_date);







 $datemaj = $datetime['0'];















 echo time_ago($datemaj);

         ?><br />







         <?php

         $select_exp = mysql_query("select * from prm_experience where id_expe = '" . $resultat['id_expe'] . "' ");







         $exp = mysql_fetch_array($select_exp);







         echo $exp['intitule'];

         ?>







         <br /><?php

 $select_exp = mysql_query("select * from prm_salaires where id_salr = '" . $resultat['id_salr'] . "' ");







 $exp = mysql_fetch_array($select_exp);







 echo $exp['salaire'];

         ?>







         <br /><?php

 $select_exp = mysql_query("select mobilite from candidats where candidats_id = '" . $resultat['candidats_id'] . "' ");







 $exp = mysql_fetch_array($select_exp);







 echo $exp['0'];

         ?></td>







         <td align="center">

             

	<?php

	 $query_M="select * from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id   where  candidats.candidats_id = '".$resultat['candidats_id']."'   LIMIT 0,1 ";

			$req  =  mysql_query($query_M);

			$cc_matching = mysql_num_rows($req);

			$info_entr = ($cc_matching>0) ? 'color:#090' : 'color:#FF0016' ; 

	?>

			<form action="candidats/" method="post" >

                <input name="id" type="hidden" value="<?php echo $resultat['candidats_id'];?>" />

                <input name="action_offre" type="hidden" value="view" />



                <a href="candidats/?btn_a=m&idcand=<?php echo $resultat['candidats_id'] ?>" 

                 title="Historique des candidatures"> 

                  <i class="fa fa-user fa-fw fa-lg" style="<?php echo $info_entr;?> "></i></a>&nbsp;  

             </form>

			 

         </td>

 </tr>



<?php

 }}

 }

 ?>

       </tbody>

   </table>

   

 



    <div class="pagination">

			 

			<?php 	if( $count>10  or $nbPages>1 ) { ?>

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

					$lapage = '?';

					

					require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination2.php');

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

  

  </form> 