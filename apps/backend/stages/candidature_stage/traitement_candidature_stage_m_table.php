 



<?php



 

			

/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

 

 

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









 

  

            <form name="F1" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET">

  

  

<table width="100%"  id="traitement_candidature_stage_table" class="tablesorter" style="background: none;">

<thead>

   <tr>

    <th  width="80%" colspan="5" > <b>Informations Candidats</b></th>

    <th  width="20%" align="center" > <b>Actions</b></th>

  </tr>

  </thead>                                                                                              

  <tbody>

   





    <?php

    

      $count = mysql_num_rows($rst_pagination);

if($count<1){

    echo  " <tr><td colspan='6'><center>Aucunes donn&eacute;es trouvez</center></td></tr> ";}

else{ 







    $ii = 1;

    $i = 0;

                                                                                                            $alter_class = 1;



    while ($resultat = mysql_fetch_array($rst_pagination)) {

        

        



        $ii == 1 ? $ii++ : $ii--;



        $i++;



        $id_candidat = $resultat['candidats_id'];



       

                                                                                                                

           $selecCV = mysql_query("select * from cv  where candidats_id='$id_candidat'  AND principal=1 AND actif=1");



$councv = mysql_num_rows($selecCV);





$result_cv = mysql_fetch_array($selecCV);

            



        //$selectt = mysql_query("select * from cvs_telecharges where  id_candidat='$id_candidat' ");



        //$countt = mysql_num_rows($selectt);



        



        



       

                                                                                                                    if ($councv) {



        ?>



        <tr id="<?php echo $i; ?>"  <?php     if($alter_class==1) {echo 'class="even"'; $alter_class++;} else {echo 'class="odd"';  $alter_class--;}   ?>   id="<?php echo $i; ?>" onmouseover="this.className='marked'" onmouseout="pasdecouleur('<?php echo $i; ?>','<?php echo $ii; ?>')">







            







            <td width="30%">

                    <?php

$date_naissance = str_replace('/', '-', $resultat['date_n']);

$date_naissance_c = date('Y-m-d', strtotime($date_naissance));

$age_c = strtotime($date_naissance_c);

$newformat = date('Y-m-d',$age_c); 

$age = (time() - strtotime($newformat)) / 3600 / 24 / 365; 

?>

<i class="fa fa-user"></i> 

<a class="info" href="../cv/?candid=<?php echo $id_candidat; ?>"  > 

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



echo $exp['pays']; ?><b> | </b> <?php  echo $row02[1].''; ?>

           <br/> <?php 





echo $rcc['FR'].' <b> | </b>'.$row01[1]; ?> <br /><br />





            </td>

                                                                                                                        









 <td width="15%">



<strong>Fra&icirc;cheur du cv :</strong><br />

<strong>Nom de l'école :</strong> <br/>

<strong>Type de stage :</strong> <br/>

<strong>Entité demandée :</strong> <br/>



</td>



              

            <td width="15%">



<?php

        $select_date = mysql_query("select dateMAJ from  candidats where candidats_id =  '" . $resultat['candidats_id'] . "' ");







        $datetime = mysql_fetch_array($select_date);







        $datemaj = $datetime['0'];















        echo time_ago($datemaj);



        

        $req_theme = mysql_query("SELECT * FROM candidature_stage where candidats_id = '" . $resultat['candidats_id'] . "'");







        $data = mysql_fetch_array($req_theme);







        //echo $data['date'];

        

        ?><br/>



                      <?php echo $data['ecole']; ?>



                <br/>

                       <?php echo $data['type']; ?>



                <br/>

                     <?php echo $data['entite']; ?>



                <br/>

                

                     

                

                     

</td>

<td width="12%">

  <strong>Durée du stage :</strong><br/>

<strong>Objet du stage :</strong> <br/>

<strong>Motivation :</strong> <br/>

</td>

<td width="15%">

       <?php echo $data['duree']; ?>



                <br/>

                <?php

                                $motiv = couperChaine(strip_tags($data['objet']), 10, 10);

                                echo $motiv;

                                if(strlen($motiv)<strlen($data['objet']))

                                { 

                                ?>

                                <a class="info1" href="javascript:void(0)" onclick="return false">

                                   <i class="fa fa-external-link"></i>

                                    

                                    <span style="width:450px;padding:6px;word-wrap: break-word; "> 

                                      

                                      <?php echo $data['objet'];?> 

                                    </span>

                                </a>

                                <?php } ?><br/>

                                 <?php

                                $motiv = couperChaine(strip_tags($data['motivations']), 10, 10);

                                echo $motiv;

                                if(strlen($motiv)<strlen($data['motivations']))

                                { 

                                ?>

                                <a class="info1" href="javascript:void(0)" onclick="return false">

                                     <i class="fa fa-external-link"></i>

                                    

                                    <span style="width:450px;padding:6px;word-wrap: break-word; "> 

                                      

                                      <?php echo $data['motivations'];?> 

                                    </span>

                                </a>

                                <?php } ?>

</td>



            

        

        



<td  width="15%">

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

              

              /*

                         

    $sqlcan = mysql_query("select email from candidats where candidats_id = '".$resultat['candidats_id']."'");

    $fetchcan = mysql_fetch_array($sqlcan);

                         

    $sqlRole = mysql_query("select * from root_roles where login = '".$_SESSION["abb_admin"]."'");

    $fetchRole = mysql_fetch_array($sqlRole);

    

    

            //  Editer 

            

            /*

            if($hist['date_modification']=="")

                $his="non définie";

				//* /

                echo '<a href="javascript:showDiv2(\''.$resultat['nom'].'\',\''.$resultat['prenom'].'\',

                    \''.$resultat['candidats_id'] .'\',\''.$resultat['status'] .'\')"

                      title="Editer le statut de cette candidature"  class="email" id="email" >

                         <i class="fa fa-pencil fa-fw fa-lg"></i>

                </a>';

                //* /

            //fin edit statut candidature

    echo '<a href="javascript:showDiv(\''.$resultat['prenom'] .'\',\''.$resultat['nom'] .'\',

         \''.$resultat['candidats_id'] .'\')" title="Affecter à une offre" class="dossier1" 

         id="dossier1"><i class="fa fa-pencil-square-o fa-fw fa-lg"></i> </a>';   

                 //* /   

                      



            $sqlRole = mysql_query("select * from root_roles where login = '".$_SESSION["abb_admin"]."'");

            $fetchRole = mysql_fetch_array($sqlRole);

            $id_candidat = $resultat['candidats_id'];

            $selecCV=mysql_query("select * from cv  join candidature on cv.id_cv= candidature.id_cv 

                where candidature.candidats_id='$id_candidat'  ");

            $councv = mysql_num_rows($selecCV);

            $result_cv =mysql_fetch_array($selecCV);

            echo ' <a href="../email_form_pop_t.php?email='.$fetchRole['email'].'&cv='.$result_cv['lien_cv'].'&lm=" title="Transf&eacute;rer le cv">

                 <i class="fa fa-envelope-o fa-fw fa-lg" ></i>

            </a> ';

			//*/

            //fin envoyer cv

            

            





?>   

	<!--			

    <div style="padding-top: 5px;float: right;">

   

        <input name="select[]" id="select<?php echo $i; ?>" type="checkbox" value="<?php echo $data['id_candidature']; ?>" onclick="colorer('<?php echo $i; ?>')" <?php if(isset($_POST['id_candidature']) && ($data['id_candidature'] == $_POST['id_candidature'])) echo 'checked'; ?> />

     

	</div>

	-->

                </center>

                </td>





        </tr>







        <?php

    }}

    }

    ?>







</tbody>







</table>

 

   

  <!--

    <div id="pager_archive">

        <img  style="float: right" class="selectallarrow" src="<?php echo $imgurl ?>/arrow_ltr_b.png" width="38" height="22"alt="Pour la sélection :">

      

    </div>

     <div style="float: right" >

  Pour la sélection : 

     <input   name="email_tt" class="espace_candidat" type="submit" value="Email avec liste" 

     alt="Email avec liste"/> 

 

     </div> 

     -->

   </form>   





    <div class="pagination">

			 

			<?php 	if( $count>10  or $nbPages>1 ) { ?>

			<div style="  float: left;" >

				<form id="frm" method='POST' >

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

					?>

			</div>

    </div>

						

			

    <div class="ligneBleu" style="  float: left;" ></div>

						

			 

  

 