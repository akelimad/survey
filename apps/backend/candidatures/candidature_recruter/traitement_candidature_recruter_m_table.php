 




<?php if($_SESSION['r_prm_export_candidature']==0){ ?>
<?php include('traitement_candidature_recruter_m_table_excel.php'); ?>
<?php } ?>
<table width="100%" id="traitement_candidature_en_recruter_table" class="tablesorter">

<thead>

   <tr>
    <th  colspan="3"><b>Informations Candidats</b></th> 
    <th  align="center" width="6%" ><b>D�tails</b></th>
			
<?php  

	if($_SESSION['r_prm_pertinenc_cnddtr']==0){
	 
?>	
    <th width="3%"><b>P</b></th>	

<?php  

	} 
	 
?>

		
<?php  

	if($_SESSION['r_prm_note']==0){
		 
		
?>

    <th width="3%"><b>Note</b></th>
	
<?php  
 
		}
		
?>
    <th  width="6%"><b>R�f  </b></th>
    <th  width="18%" ><b>Titre du poste</b></th>
    <th  width="9%" class="sorter-shortDate dateFormat-ddmmyyyy"><center><b>Date</b></center></th>
    <th  width="4%"><center><b>Actions</b></center></th>
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
  <tr
<?php
if($alter_class==1) {echo 'style="background-color:#E8F0F0"'; $alter_class++;} 
else {echo 'style="background-color:#DDDDDD"';  $alter_class--;}
?> id="<?php echo $i; ?>"  onmouseover="this.className='marked'" onmouseout="this.className=''" >
<td width="20%">
<?php 
include('traitement_candidature_recruter_m_table_traitement.php'); 
?>

<!-- Historique de toutes les candidatures-->
<a class="info" href="<?php echo $lien_candidats; ?>" title="Historique de toutes les candidatures"> 
<i class="fa fa-user fa-fw fa-lg" style="<?php echo $info_entr;?> "></i>
</a> 
<!-- nom + pr�nom .....-->
<!--<i class="fa fa-user"></i>   -->
<a class="info" href="<?php echo $urladmin; ?>/cv/?candid=<?php echo $r_candidats['candidats_id']; ?>"  > 
<?php 
echo '<b>' . $r_candidats['prenom'].'&nbsp;'.$r_candidats['nom'].'
<br/>  '.number_format($age,0).' ans  </b>'; 
?>
  <i class="fa fa-external-link"></i>
  <span style="width:580px;padding:6px"> 
  <?php 
  
  //debut if
  if($cpt_historique){
  ?>
  <h2 style="color:#000;">
  <b>Historique des actions effectu&eacute;es</b>
  </h2>
  <div style="background-color: #ddd;">
  <table width="100%">
  <?php
   echo ' <thead style="color:#000;text-align:center;"><tr style="background-color: #ccc;"><td><b>Date</b></td><td><b>Statut</b></td><td><b>Utilisateur</b></td><td colspan="3"><b>Actions sur commentaires</b></td></tr></thead>';
 
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
  <td style=" background-color: #ddd;" >'.$date_mdf.'</td>
  <td style=" background-color: #ddd; padding-left: 20px; ">'.$stat.'</td> 
  <td style=" background-color: #ddd; padding-left: 20px; "> '.$utilisateur.'</td>
  <!--<td> '.$comment.'</td>-->
  <td style=" background-color: #ddd; padding-left: 20px;"><a href="javascript:showDivDetai(\''.$idst.'\',\''.$stat.'\',\''.$nomPre.'\',\''.$date_mdf.'\',\''.$utilisateur.'\',\''.$lieu.'\',\''.utf8_decode($commentaire).'\',\'\')"  title="Voir ce message"><i class="fa fa-search fa-fw fa-lg"></i> </a></td>
  <td style=" background-color: #ddd; padding-left: 20px;"><a href="javascript:showDivModif(\''.$idst.'\',\''.$stat.'\',\''.$nomPre.'\',\''.$date_mdf.'\',\''.$utilisateur.'\',\''.$lieu.'\',\''. $commentaire .'\',\'\')"  title="Voir ce message"><i class="fa fa-pencil fa-fw fa-lg"></i></a></td>
  <td style=" background-color: #ddd; padding-left: 20px;"><a href="javascript:showDivSupri(\''.$idst.'\',\''.$stat.'\',\''.$nomPre.'\',\''.$date_mdf.'\',\''.$utilisateur.'\',\''.$lieu.'\',\''. $commentaire .'\',\'\')"  title="Voir ce message"><i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i></a></td> 
  </tr>';
          
  }
  // fin while
  ?>
  </table>
  </div> <br/>
  <?php
  }
  //fin if
  ?>
  D&eacute;tail du candidat 
  </span> 
</a>
<br/> 
<?php
echo $r_candidats['titre']."<br/>".$r_prm_experience['intitule']."<br/>";
echo $r_prm_pays['pays']; ?><b> | </b>
<?php echo $r_prm_niv_formation[1].' | '.$r_prm_sectors['FR']; ?>
<br/> <?php echo $r_prm_situation[1]; ?>
 <?php if($_SESSION['r_prm_region_off']==0){ ?>
        <strong>Ville d'affectation</strong><br/>
        <?php echo "".$r_prm_region_ville['ville_region']."";?>
        <?php } ?>
        <br /><br/>
</td>

    <td width="11%">
        
        <strong>Exp&eacute;rience</strong><br />
        <strong>Salaire souhait&eacute;</strong><br />
        <strong>Mobilit&eacute;</strong><br />
        <strong>Fra&icirc;cheur du cv</strong>
    </td>   
    <td width="11%"> 
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
            <td style=" background-color: white; ">Pertinence exp�rience  </td>
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
            <td style=" background-color: white; ">Pertinence Moblit�  </td>
            <td style=" background-color: white;  ">=</td>
            <td style=" background-color: white;">
            <?php echo ''.$percent_mobilite.'%'; ?></td>
            </tr>
            <!-- /////////////////////////  -->
            <?php } if($prm_p_candidat['prm_n_mobil'] == "1"){  ?>
            <tr>
            <td style=" background-color: white; ">Pertinence Niveau Mobilit�  </td>
            <td style=" background-color: white;  ">=</td>
            <td style=" background-color: white;">
            <?php echo ''.$percent_niveau_mobilite.'%'; ?></td>
            </tr>
            <!-- /////////////////////////  -->
            <?php } if($prm_p_candidat['prm_t_mobil'] == "1"){?>
            <tr>
            <td style=" background-color: white; ">Pertinence Taux Mobilit�   </td>
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
      <?php
        //d�but if traitement id_candidature notation 1
        if(!empty($r_notation_1['id_candidature']))
        {
        ?>
        <!-- notation -->
        <div>
        <a class="info" href="<?php echo $urladmin; ?>/popup/fiche_synthese/?id_cnddtr=<?php echo $return['id_candidature']; ?>&id=<?php echo $r_candidats['candidats_id']; ?>"  > 
       <?php
        //color notation
        $color_note = '';
        if($sum_ffinal2 >= 70 ){  
        $color_note = "style='color: #00B300;'";}
          if($sum_ffinal2 >= 40 and $sum_ffinal2 < 70 ){
        $color_note = "style='color: #CC5500;'"; }
          if($sum_ffinal2 >=10 and $sum_ffinal2 <40){ 
        $color_note = "style='color: #CC0000;'"; }
          if($sum_ffinal2 <10){ 
        $color_note = "style='color: #000000;'"; } 
        //fin color notation
        // affichage notation
         echo "<center><b ".$color_note.">".number_format($sum_ffinal2,0)." % </b></center>";
        //fin affichage
          ?>
      
      <span style="width:500px;padding:6px">
      <?php include('traitement_candidature_recruter_m_table_notation.php'); ?>
      D&eacute;tail de notation  
      </span>
      </a>
      </div>
      <!-- -->
      <?php } 
      // fin if traitement id_candidature notation 1
      ?><br/>  
    </td>

	
<?php  
 
		}
		
?>
    
    <td>
        <?php echo $r_offre['reference']; ?>
    </td>
    <td>  
<?php  
$info_entr_ture = 'color:#030'  ;
$lien_candidats_ture =  ''.$urladmin.'/historique_candidats/candidature/?btn_a=m&idcand='.$return['candidats_id'].'&idture='.$return['id_candidature'].''; 
?>   
<a class="info" href="<?php echo $lien_candidats_ture; ?>" title="Historique de cette candidature"> 
<i class="fa fa-user fa-fw fa-lg" style="<?php echo $info_entr_ture;?> "></i>
</a>  
<?php echo $r_offre['Name']; ?>
</td>

<td>
<?php echo '<b>' . date ( "d.m.Y", strtotime ( $r_candidature ['date_candidature'] ) ).'</b>';?>
</td>
    <td>
        <?php
            echo '<div style="float: left">';

echo '<a href="'.$urladmin.'/popup/transferer_email/?email='.$r_root_roles['email'].'&cv='.$r_cv['lien_cv'].'&lm='.$r_lettres_motivation['lettre'].'" title="Transf&eacute;rer le cv">
<i class="fa fa-envelope fa-fw fa-lg" ></i>
</a>';
             
            //fin envoyer cv
echo '<a href="'.$urladmin.'/popup/envoyer_email/?email='.$r_root_roles['email'].'&emailc='.$r_candidats['email'].' " 
title="Envoyer un email au candidat">
<i class="fa fa-envelope-o fa-fw fa-lg" ></i></a> '; 
                 
                echo '</div>';
        //fin code
        ?>
 
    </td>
  </tr>

     <?php
         
         
         
         
        

     }

         
       //   echo '<h1>'.$query.'</h1>';
         
        ?>

    </tbody>

     </table>

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
     <div style="float: right" >

     
     
     
     <input name="candidature" type="hidden" value="<?php echo $candidature; ?>" />
 
     </div></form>


  

     <?php

    }

    else

        echo '<tr class="sectiontableentry1"><td colspan="8" align="center">Aucune candidature</td></tr></tbody></table>'; 
?> 