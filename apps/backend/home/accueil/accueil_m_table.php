

				  
<?php if(isAdmin()) : ?>
<article style="width:100%;">

<div style=" float:left;width:100%;">

                                        <div class="subscription" style="width:100%; ">

<?php if(isset($_POST['date']) && $_POST['date']!=''){ ?>

<h1>La liste des candidatures en cours  </h1>

<?php }else{?>  

<h1>La liste des candidatures en cours dans moins d'une semaine </h1>

<?php } ?>

</div>

                                        

<div style="float:left"> 



    <b style="font-size: 10px;"> * Le point en couleur montre la pertinence de la candidature (<span style="color:#79796A"><a style="color:#00B300">Vert</a>: pertinence bonne, <a style="color:#CC5500;">Orange</a>: Pertinence moyenne,  <a style="color:#CC0000">Rouge</a>: pertinence faible </span>). </b>

</div>

<br>

                                            



<?php 

$count_test=0;

$result_array =  $array_test =  array();

//filter accueil status    

$select_popup_3 = mysql_query("SELECT statut FROM `prm_statut_candidature` where  popup_1=1 " );

$result_array = array();

while($status_popup_3 = mysql_fetch_array($select_popup_3))

{

$result_array[] = $status_popup_3['statut'];

}

$sql_c_a="SELECT  candidature.id_candidature FROM  candidature,agenda  ". $tbl____o . $q_offre_fili .$where____and.$o____c.$where____and2."     agenda.id_candidature=candidature.id_candidature  and  candidature.status = 'En cours'  ";

/*echo $sql_c_a;*/

$select_candidature = mysql_query($sql_c_a);

while($id_candid = mysql_fetch_array($select_candidature))

{

$last_status = ''; $last_id = 0;

$select_count_hist = mysql_query("SELECT id_candidature,status from historique where id_candidature = '".$id_candid['id_candidature']."' order by  `historique`.`id` DESC limit 0,1");

if($status = mysql_fetch_array($select_count_hist))

{

$last_id = $status['id_candidature'];

$last_status = $status['status'];

}

if(in_array($last_status, $result_array) )

{ 

$array_test[] = $last_id;

$count_test++;  

} 

}

        

if(isset($array_test) And $count_test!=0){      $s_test = implode(",",array_unique($array_test));    }

             

if (isset( $s_test) and  $s_test!='')    {      $condition = rtrim($s_test," , ");  } 

	



$date_f=(isset($_POST['date']) && $_POST['date']!='') ? " 

and ( `start` BETWEEN '".$_POST['date']." 00:00:00"."' 

  AND '".$_POST['date']." 23:59:59"."' ) " : " " ; 

  

$sql_cand=(!empty($condition))? "where  

agenda.id_candidature  in ( ". $condition." ) " : "where  agenda.id_candidature  in ( -1 ) " ; 

 

$sqll_000="SELECT * from    agenda   ".$sql_cand."  

 ".$date_f." group by agenda.id_agend  ORDER BY agenda.start DESC";



 



 

		

/*

		echo "<br>"."-->  :  ".$sqll_000."<br>";

*/



$sqql = mysql_query($sqll_000);



/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];



$select = mysql_query($sqll_000);



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



$sql_pagination=$sqll_000."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

// echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination



 





if($rst_pagination)

  $cpt = mysql_num_rows($rst_pagination);

 

?>

                                        <div> 



<table width="100%" style="background: none;" id="accueila" class="tablesorter">

<thead> 

                                        <tr >    

                                            <th  width="3%" ><b>N°</b></th>

                                            <th  width="28%" ><b>Nom Candidat</b></th>

                                            <th width="25%" ><b>Titre de poste</b></th>

                                            <th  width="15%" ><b>Status</b></th>

                                            <th width="12%" ><b>Date et Heure</b></th>			

<?php  



	if($_SESSION['r_prm_pertinenc_cnddtr']==0){

	 

?>	



                                            <th  width="6%" ><b>Pertinence</b></th>    

 <?php  



	}

	 

?>	

											<th  width="6%" ><b>Confirmation</b></th>    

											

                                            <th  width="6%" > <b>Action </b></th>  

                                        </tr>

</thead>

<tbody>

<?php

$inbr=0;

 while($data_accueil = mysql_fetch_array($rst_pagination))

{  

$inbr++;

$is=$inbr+$limitstart;

include('accueil_m_table_traitement.php');                                          

?>



<tr style="background-color: #F4F5CC;">                                                      

<td width="3%">

<span class="badge"><?php echo $is; ?></span>

</td>

<td>

<?php

$info_entr = 'color:#090'  ;

$lien_candidats = ''.$urladmin.'/historique_candidats/

candidats/?btn_a=m&idcand='.$data_accueil['candidats_id'].''; 

?>



<a class="info" href="<?php echo $lien_candidats; ?>" title="Historique de toutes les candidatures"> 

<i class="fa fa-user fa-fw fa-lg" style="<?php echo $info_entr;?> "></i>

</a> 

<!-- -->                         

<a class="info" href="../cv/?candid=<?php echo $candidats__id; ?>" title="D&eacute;tail du candidat" > 

 <?php 

$age = '-';

$age = (time() - strtotime($r_candidats['date_n'])) / 3600 / 24 / 365;

echo '<b>'.$r_c_nom.' |  '.number_format($age,0).' ans </b>'; ?>

<i class="fa fa-external-link"></i>

<span  style="width:400px;padding:6px;margin-top:-120px;margin-left:100px;">

<i class="fa fa-envelope-square fa-fw fa-lg"></i>

<b><?php echo$r_c_email;  ?></b><br>

<i class="fa fa-phone fa-fw fa-lg"></i>

<b><?php echo $r_c_tel_1;  ?></b><br>

  <?php if($r_c_tel_2!=''){  ?> 

    <i class="fa fa-phone fa-fw fa-lg"></i> 

    <b><?php echo $r_c_tel_2;  ?> </b>

    <br>

  <?php }  ?> 

</span>

</a><br/>

<!-- -->

</td>

<td>

<?php echo $offre_name; ?>

</td>

                             

<td>

<a class="info" href="">



<i class="fa fa-external-link"></i>

      <span style="width:450px;padding:6px"> 

      <?php 

        

        if($cpt){

          echo ' <h2 style="color:#000;"><b>Historique des actions effectu&eacute;es</b> </h2><div style="background-color: #ddd;"><table >';

    

                 //debut while

  while($data_historique = mysql_fetch_array($r_historique))

  { 

  $idst = $data_historique['id'];

  $date_m = $data_historique['date_modification'];

  $commentaire = $data_historique['commentaire'];

  $stat = $data_historique['status'];

  $utilisateur = $data_historique['utilisateur'];

  $comment = $data_historique['commentaire'];

  $lieu = $data_historique['lieu'];



  $date_mdf=date('d-m-Y H:i:s',strtotime($date_m));

  

  $commentaire =safe_show($commentaire) ;

 



  echo '<tr>

  <td width="20%" style=" background-color: #ddd;" >

  <b>'.$date_mdf.'</b></td>

  <td width="40%" style=" background-color: #ddd; padding-left: 20px; ">

  '.$stat.'</td> 

  <td width="40%" style=" background-color: #ddd; padding-left: 20px; ">

  '.$utilisateur.'</td>

  </tr>';

          

  }

  // fin while

        echo '</table></div> <br/>';

        }

      ?>

      </span>

      <?php echo $stat; ?> 

      </a>

</td>

<td>

		<b><?php echo date('d.m.Y H:i',strtotime($debut)); ?></b>

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

          <a href="#" class="info">



          <div style="width: 15px; height: 15px; background: <?php echo $color; ?>;

           -moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;"></div>

          <br/><span id="tableau" style="width: 216px;padding:6px">

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

<td> 

<?php

    

    if($confirmation_statu==1) { $conf1='#15CD41'; $conf0="Confirmé";}

    else { $conf1='#ED0C0C'; $conf0="Non confirmé";}

    



            echo '<center><a href="#" title="'.$conf0.'"><i class="fa fa-paper-plane-o fa-fw fa-lg" style="color : '.$conf1.'"></i></a> </center>';                  



    ?>

</td>

                              

<td> 

<?php     

$dd=date('d-m-Y H:i',strtotime($debut));

$df=date('d-m-Y H:i',strtotime($fin));

$dd1=date('d-m-Y H:i',strtotime($debut));

$df1=date('d-m-Y H:i',strtotime($fin));

//$mssg = str_replace("'", "", $msg);

$mssg=substr(strip_tags($msg), 0, 40);

$mssg1 = str_replace("'", "", $msg1);

$da =$data_accueil['lieu'];

$da1 =$data_accueil['lieu'];

$id_agend =$data_accueil['id_agend']; 

//  Editer 

//*



  $mssg1 =safe_show($mssg1) ;



echo '<a href="javascript:showDiv2(\''.$r_candidats['nom'].'\',\''.$r_candidats['prenom'].'\',\''.$candidature__id.'\',\''.$offre_name.'\',\''.$action.'\',\''.$reponse02['pertinence'] .'\',\''.$dd1.'\', \''.$da1.'\',\''.$mssg1.'\',\''.$id_agend.'\')"

title="Editer le status de cette candidature"  class="email" id="email" >

<i class="fa fa-pencil fa-fw fa-lg"></i>

</a>';

//*/

//fin edit statut candidature 

       

  

  $mssg =safe_show($mssg) ;

 

echo '<a href="javascript:showDiv(\''.$candidats__id.'\' ,\''.$r_c_nom .'\',\''.$offre_name.'\', \''.$action.'\',\''.$dd.'\', \''.$da.'\', \''.$r_c_email.'\', \''.$r_c_tel_1.'\', \''. $mssg .'\')"

      title="Voir detail"><i class="fa fa-search fa-fw fa-lg"></i></a>';

?>

</td>

</tr>

<?php 

}        

if($cpt<1) {

echo ' <tr style=" background-color: #ededed; "> <td colspan="6">';

echo '<center>Aucune donnée</center>';

echo '</td></tr>';

}

?>



</tbody>



</table> 



    <div class="pagination">

			 

			<?php 	if( $cpt>10  or $nbPages>1 ) { ?>

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

					 

					?>

			</div>

    </div> 



 </div>

</div>          

</div>

</article>
<?php endif; ?>


