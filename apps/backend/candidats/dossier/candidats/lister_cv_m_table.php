

<?php





/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

   //$select = mysql_query($selectString)



$count = 0;

if($select = mysql_query($selectString)){

 $count = mysql_num_rows($select);



//echo '<h2>'.$selectString.'</h2>';

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

 

}

/////////////   fin pagination



?>







<?php

if (isset($in_d) ) {

?>



<form name="F1" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET">

<table width="100%" border="0" cellspacing="0" id="listercv" class="tablesorter" style="background: none;">



<thead>



   <tr>

    <th>N°</th>

    <th   colspan="3" ><b>Informations Candidats</b></th>



    <th  width="9%" ><center><b>Actions</b></center></th>

    

  </tr>



  </thead>

<tbody>

<?php



	if($count > 0){



            if (isset($_GET['id']) and $_GET['id'] != '' )

            {       $id = $_GET['id'];

                        mysql_query("DELETE FROM dossier_candidat where candidats_id = '$id'"); 

                        $affected = mysql_affected_rows();

                        	echo '<meta http-equiv="refresh" content="0; url=./">';	

                 

            }  

    

            //echo $selectString; 



            $ii = 1;

            $i = 0;

            $alter_class = 1;

            $inum=0;



            while ($resultat = mysql_fetch_array($rst_pagination)) {



                $ii == 1 ? $ii++ : $ii--;



                $i++;



                $id_candidat = $resultat['candidats_id'];





                $inum++;

                $is=$inum+$limitstart;



            

                                                                                                                

            $selecCV = mysql_query("select * from cv  where candidats_id='" . $resultat['candidats_id'] . "'  AND principal=1 AND actif=1");



                        $councv = mysql_num_rows($selecCV);



                        $result_cv = mysql_fetch_array($selecCV);

                    



                //$selectt = mysql_query("select * from cvs_telecharges where id_candidat='$id_candidat' ");



                //$countt = mysql_num_rows($selectt);



               



               



              

             if ($councv) {

                ?>



                <tr id="<?php echo $i; ?>"  <?php     if($alter_class==1) {echo 'class="even"'; $alter_class++;} else {echo 'class="odd"';  $alter_class--;}   ?>   id="<?php echo $i; ?>" >







                    <td width="3%"><span class="badge"><?php echo $is; ?></span></td>

                    <td width="48%">





	<?php  

	


$newformat = strtotime(eta_date($resultat['date_n'], 'Y-m-d'));


	$age = (time() - strtotime($newformat)) / 3600 / 24 / 365;

	?> <i class="fa fa-user"></i> <?php

     ?>



                        









                       

         <a class="info" href="<?php echo $urladmin; ?>/cv/?candid=<?php echo $id_candidat; ?>"  > 

         <?php echo "<b>" .$resultat['prenom'].'&nbsp;'.$resultat['nom'].'  |  '.number_format($age,0).' ans </b>'; ?>

		  <i class="fa fa-external-link"></i>

			<span style="width:90px;padding:6px">  D&eacute;tail du candidat </span> 

         </a>

		 

		 <br />

<?php

$select_exp = mysql_query("select * from candidats where candidats_id = '" . $resultat['candidats_id'] . "' ");

$exp = mysql_fetch_array($select_exp);

$exxp=mysql_query("select * from prm_experience where id_expe= '".$resultat['id_expe']."' "); 

$xexxp = mysql_fetch_array($exxp);

echo $exp['titre']."<br/>";

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

echo $exp['pays']; ?><b> | </b> <?php  echo $row01[1].' <b> | </b> '.$row02[1]; ?>

           <br/> <?php 

$secc = mysql_query( "SELECT * FROM prm_sectors where id_sect = '".$resultat['id_sect']."' ");

$rcc = mysql_fetch_array($secc);



echo $rcc['FR']."<b> | </b>".$resultat['email']; ?> <br /><br />

</td>

                                                                                                                        







                    <td width="16%"><strong>Fra&icirc;cheur du cv</strong><br />







                        <strong>Exp&eacute;rience</strong><br />







                        <strong>Salaire souhait&eacute;</strong><br />







                        <strong>Mobilit&eacute;</strong><br /></td>







                    <td width="22%"><?php

                    

                $datemaj = $resultat['dateMAJ'];















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







                     <td width="9%">

            <center>

             





                <?php

                $selecCV = mysql_query("select * from cv  where candidats_id='" . $resultat['candidats_id'] . "'  AND principal=1 AND actif=1");



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

                           





                                                                                                      

                    echo '<a   href="'.$urladmin.'/cv/dcv/?cv=' . $result_cv['lien_cv'] . '&id_candidat=' . $resultat['candidats_id'] . ' &id_cv=' . $result_cv['id_cv'] . '  "   onclick="showUser()">' . $img . '</a>';

                                                                                          

                ?>



                <?php 

                   

                         

    $sqlcan = mysql_query("select email from candidats where candidats_id = '".$resultat['candidats_id']."'");

    $fetchcan = mysql_fetch_array($sqlcan);

                         

    $sqlRole = mysql_query("select * from root_roles where login = '".$_SESSION["abb_admin"]."'");

    $fetchRole = mysql_fetch_array($sqlRole);

    

   echo ' <a href="'.$urladmin.'/popup/envoyer_email/?email='.$fetchRole['email'].'&emailc='.$fetchcan['email'].' " 

            title="Envoyer un email au candidat"><i class="fa fa-envelope-o fa-fw fa-lg" ></i></a> ';

                 



                ?>   

                       

						<a href=" <?php echo $_SERVER['REQUEST_URI'].'&id='.$resultat['candidats_id']; ?>" onclick="if(confirm('Êtes-vous sûre de vouloir Supprimer ?')) " title="Supprimer"> 

						<i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i></a> 

					  

					  

                </center>

 

                </td>







                </tr>



<?php

            }}

			}

			else

			{

			

?>

		<tr><td></td><td></td><td><center>Aucune information</center></td><td></td></tr>	

<?php

			}

            ?>

        </tbody>

    </table>

</form>

     



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

					 //$lapage = basename($_SERVER['PHP_SELF']).'?in_d='.$in_d; 

					 $lapage = '?'; 

					

					require_once (dirname ( __FILE__ ) . $incurl3.'/class.pagination2.php');

					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 ); 

					?>

			</div>

    </div>

						

<?php

	}

?>

		

    <div class="ligneBleu" style="  float: left;" ></div>

	