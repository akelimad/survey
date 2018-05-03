

<?php

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



$sql_pagination=$query_cspont."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);



/////////////   debut pagination





/////////////   fin pagination



?>





<table width="100%" id="traitement_candidature_spontanee_table" class="tablesorter" >

    <thead>

   <tr>

    <th width="5%"><b>N°</b></th>

    <th  width="70%" colspan="3" > <b>Informations Candidats</b></th>

    <th width="12%"><b>Date postulation</b></th>

    <th  width="10%" align="center" ><b>Actions</b></th>

  </tr>

  </thead>  

    <tbody>

    <?php

      $count = mysql_num_rows($rst_pagination);

if($count<1){

    echo  " <tr><td colspan='4'><center>Aucunes donn&eacute;es trouvez</center></td></tr> ";

}

else{ 



$ii = 1;

$i = 0;

$alter_class = 1;

while ($resultat = mysql_fetch_array($rst_pagination)) {

$ii == 1 ? $ii++ : $ii--;

$i++;

$is=$i+$limitstart;

include('traitement_candidature_spontanee_m_table_traitement.php');

if ($councv) {

?>

<tr id="<?php echo $i; ?>"  

<?php     if($alter_class==1) {echo 'class="even"'; $alter_class++;} 

else {echo 'class="odd"';  $alter_class--;}   ?>   id="<?php echo $i; ?>" 

onmouseover="this.className='marked'"

onmouseout="pasdecouleur('<?php echo $i; ?>','<?php echo $ii; ?>')">

<td><span class="badge"><?php echo $is; ?></span></td>

<td width="32%">

<?php


$newformat = eta_date($r_candidats['date_n'], 'Y-m-d'); 

$age = (time() - strtotime($newformat)) / 3600 / 24 / 365; 

?>

<i class="fa fa-user"></i>  

<a class="info" href="<?php echo $urladmin; ?>/cv/?candid=<?php echo $id_candidat; ?>"  > 

<?php echo '<b>' . $r_candidats['prenom'].'&nbsp;'.$r_candidats['nom'] . '  

|  '.number_format($age,0).' ans  </b>';  ?>

 <i class="fa fa-external-link"></i>

<span style="width:90px;padding:6px">  D&eacute;tail du candidat </span> 

</a>

<br />

<?php

echo $r_candidats['titre']."<br/>".$r_prm_experience['intitule']."<br/>";

echo $r_prm_pays['pays']; ?><b> |

 </b> <?php  echo $r_prm_niv_formation['formation'].' 

 <br/> '.$r_prm_sectors['FR']; ?>

<br /><br />

</td>

<td>

<strong>Fra&icirc;cheur du cv :</strong><br />

<strong>Motivations :</strong><br />

</td>

<td>



	<?php 

        $CVdateMAJ = mysql_query("SELECT CVdateMAJ from candidats  where candidats_id = '". $resultat["candidats_id"] ."'  limit 0,1 ");

		$data_CVdateMAJ = mysql_fetch_array($CVdateMAJ);

	?> 

<?php echo time_ago( $data_CVdateMAJ["CVdateMAJ"]); ?> <br /><br />



<!-- début traitement message candidature-->

<?php

$motiv = couperChaine(strip_tags($resultat['message']), 20, 10);

echo $motiv;

if(strlen($motiv)<strlen($resultat['message']))

{ 

?>

<a class="info1" href="javascript:void(0)" onclick="return false">

        <img src="<?php echo $imgurl ?>/info.png" 

                                    alt="details" width="9" height="9" />

                                    

        <span style="width:550px;padding:6px;word-wrap: break-word; "> 

          <div style="padding:6px;word-wrap: break-word; ">

          <?php echo "".utf8_decode($resultat['message']).""; ?> 

          </div>

        </span>

</a>

<?php } ?>

<!-- fin traitement message candidature-->



</td>

<td><center><b>

<?php echo '<b>'.date( "d.m.Y",strtotime($resultat ['date_cs'])).'</b>'; ?>

</b></center></td>

<td width="15%">

<center>

<?php

//  Editer 

/*

if($hist['date_modification']=="")

$his="non définie";

//*/

echo '<a href="javascript:showDiv2(\''.$r_candidats['nom'].'\',\''.$r_candidats['prenom'].'\',

 \''.$r_candidats['candidats_id'].'\',\''.$resultat['status'] .'\')"

  title="Editer le statut de cette candidature"  class="email" id="email" >

 <i class="fa fa-pencil fa-fw fa-lg"></i>

</a>';

                

                

  echo '<a href="javascript:showDiv(\''.$r_candidats['prenom'] .'\',\''.$r_candidats['nom'] .'\',

   \''.$r_candidats['candidats_id'] .'\')" title="Affecter à une offre" class="dossier1"                      

    id="dossier1"> <i class="fa fa-pencil-square-o fa-fw fa-lg"></i></a>';                                     

                   

if ($councv) {

  if (strpos($result_cv['lien_cv'], ".pdf") || strpos($result_cv['lien_cv'], ".PDF") )

      $img = '<i class="fa fa fa-file-pdf-o  fa-fw fa-lg" ></i>';

  if (strpos($result_cv['lien_cv'], ".doc") || strpos($result_cv['lien_cv'], ".DOC")|| 

 strpos($result_cv['lien_cv'], ".DOCX")|| strpos($result_cv['lien_cv'], ".docx")||

strpos($result_cv['lien_cv'], ".rtf")|| strpos($result_cv['lien_cv'], ".RTF"))

      $img = '<i class="fa fa-file-word-o  fa-fw fa-lg" ></i>';

}

else

    $img = '';

echo '<a   href="'.$urladmin.'/cv/dcv/?cv=' . $result_cv['lien_cv'] . '&id_candidat=' . 

      $r_candidats['candidats_id'] . ' &id_cv=' . $result_cv['id_cv'] . '  "   onclick="showUser()">' . $img . '</a>';



echo ' <a href="../../popup/transferer_email/?email='.$r_candidats['email'].'&cv='.$result_cv['lien_cv'].'&lm=" title="Transf&eacute;rer le cv">

 <i class="fa fa-envelope fa-fw fa-lg" ></i>

</a> ';



?>   

      </center>

     </td>

   </tr>

<?php

      }//fin if count

    }//fin while candidature

 }//fin else test table # vide

?>

        </tbody>

    </table>

    <div class="pagination">

       

      <?php   if( $count>10  or $nbPages>1 ) { ?>

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





