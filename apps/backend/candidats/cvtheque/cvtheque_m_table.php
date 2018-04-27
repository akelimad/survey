



<form name="F1" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <table width="100%" border="0" cellspacing="0" id="cvthequetable" class="tablesorter" style="background: none;">


<thead>

   <tr>

    <th><b>N°</b></th>
    <th ><b>Informations Candidats</b></th>
    <th   colspan="3" ><b>Détails</b></th>
    <th></th>
    <th  align="center" width="13%" ><b> Actions </b></th>
  </tr>

  </thead>
<tbody>
<?php

$count = mysql_num_rows($select);
if($count<1){
    echo  " <tr><td colspan='5'><center>Aucunes données trouvez</center></td></tr> ";}
else{
    ?>


<?php



 $ii = 1;
 $i = 0;
 $alter_class = 1;
 
$inum=0;

 while ($resultat = mysql_fetch_array($select)) {

 $ii == 1 ? $ii++ : $ii--;
 $i++;
$inum++;
$is=$inum+$limitstart;

 $id_candidat = $resultat['candidats_id'];

 
                                                                                                                
         $selecCV = mysql_query("select * from cv  where candidats_id='" . $resultat['candidats_id'] . "'  AND principal=1 AND actif=1".$g_by2);

         $councv = mysql_num_rows($selecCV);

         $result_cv = mysql_fetch_array($selecCV);
     

 //$selectt = mysql_query("select * from cvs_telecharges where id_candidat='$id_candidat' ");

 //$countt = mysql_num_rows($selectt);

    

    

   
if (($councv) || (!$councv)) {
 ?>

 <tr id="<?php echo $i; ?>"  <?php     if($alter_class==1) {echo 'class="even"'; $alter_class++;} 
 else {echo 'class="odd"';  $alter_class--;}   ?>   id="<?php echo $i; ?>" onmouseover="this.className='marked'"   >

 
<td width="3%"><span class="badge"><?php echo $is; ?></span></td>
     <td width="47%">



            <?php 
$newformat = eta_date($resultat['date_n'], 'Y-m-d');

    $age = (time() - strtotime($newformat)) / 3600 / 24 / 365;
?>
<?php
$query_M="SELECT * from candidats 
inner join candidature on candidats.candidats_id = candidature.candidats_id 
where  candidats.candidats_id = '".$resultat['candidats_id']."'   LIMIT 0,1 ";

$req  =  mysql_query($query_M);
$cc_matching = mysql_num_rows($req);
$info_entr = ($cc_matching>0) ? 'color:#090' : 'color:#FF0016' ; 
$lien_candidats =  ($cc_matching>0) ? 
''.$urladmin.'/historique_candidats/candidats/?btn_a=m&idcand='.$id_candidat.'' : '#' ; 
?>
<?php if($lien_candidats=="#"){ ?>
<i class="fa fa-user fa-fw fa-lg" style="<?php echo $info_entr;?> "></i>
<i class="fa fa-external-link" style="<?php echo $info_entr;?> "></i>
<?php }else{ ?>
<a class="info" href="<?php echo $lien_candidats; ?>" > 
    <i class="fa fa-user fa-fw fa-lg" style="<?php echo $info_entr;?> "></i>
    <i class="fa fa-external-link" style="<?php echo $info_entr;?> "></i>
    <span style="width:127px;padding:6px"> Historique de candidature </span> 
</a> 
<?php } ?>

        

        <a class="info" href="<?php echo $urladmin; ?>/cv/?candid=<?php echo $id_candidat; ?>"  > 
         <?php     echo '<b>' . $resultat['prenom'].'&nbsp;'.$resultat['nom'] . '    |  '.number_format($age,0).' ans </b>';  ?>
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
echo $exp['pays']; ?><b> || </b> <?php  echo $row01[1].' <b> | </b> '.$row02[1]; ?>
           <br/> <?php 
$secc = mysql_query( "SELECT * FROM prm_sectors where id_sect = '".$resultat['id_sect']."' ");
$rcc = mysql_fetch_array($secc);
$sdispon = mysql_query( "SELECT * FROM prm_disponibilite where id_dispo = '".$resultat['id_dispo']."' ");
$rdispon = mysql_fetch_array($sdispon);
echo $rdispon['intitule']."<b> || </b> ".$xexxp['intitule']."<br/>";
echo $rcc['FR']."<b> || </b>".$resultat['email']; ?> <br /><br />



        </td>
                                                                                                                       
    <td >
		<!-- Historique de vue-->
	 <a class="info" href="javascript:void(0)" id="lien"> 
	<?php 
	$s_historique_cvtheq ="SELECT * FROM `his_cvtheq_rol` WHERE `id_candidat`= '".$resultat['candidats_id']."' ORDER BY date_action ASC";
	//echo $s_historique_cvtheq;
$r_historique_cvtheq = mysql_query($s_historique_cvtheq);
 $cpt_historique_cvtheq = mysql_num_rows($r_historique_cvtheq);
	

    if($resultat['vues']>0){ ?>
    <i class="fa fa-check-square-o fa-fw fa-2x" style="color: #006003;" title="vues"></i>
    <?php } ?>
	
	<span style="width:200px;padding:6px"> 
	 <?php
	 if($cpt_historique_cvtheq){
	 ?>
	 <h2 style="color:#000;">
  <b>Historique de vue</b>
  </h2>
  <div style="background-color: #ddd;">
	 <table>
	 <?php
	   echo '<table style="width:auto;"><thead>

   <tr>

    <th><b>N°</b></th>
    <th ><b>User</b></th>
    <th width="100%"><b>Date</b></th>
   
  </tr>

  </thead><tbody>';
	
  	     //debut while
	//$s_historique_cvtheq ="SELECT * FROM `his_cvtheq_rol` WHERE `id_candidat`= '".$resultat['id_candidat']."' ORDER BY date ASC";

	$r_historique_cvtheq = mysql_query($s_historique_cvtheq);
  while($data_historique_cvtheq = mysql_fetch_array($r_historique_cvtheq))
  {
	$id=$data_historique_cvtheq['id'];
  $role_v = $data_historique_cvtheq['id_role'];
  $date_m = $data_historique_cvtheq['date_action'];

  $s_historique_cvtheq_role="SELECT nom FROM root_roles WHERE `id_role`= '".$role_v."'";
//echo $s_historique_cvtheq_role;
  $r_historique_cvtheqnom=mysql_query($s_historique_cvtheq_role);
  while($data_historique_cvtheq_nom=mysql_fetch_array($r_historique_cvtheqnom)){
  $nom=$data_historique_cvtheq_nom['nom'];

  }
  
  $date_mdf=date('d-m-Y H:i:s',strtotime($date_m));
  

  echo '<tr>
    <td style=" background-color: #ddd; padding-left: 20px; ">'.$id.'</td> 
  <td style=" background-color: #ddd; padding-left: 20px; ">'.$nom.'</td> 
  <td style=" background-color: #ddd;" >'.$date_mdf.'</td>

  
  </td></tr>';
  				
	 
	   }
  // fin while
  echo '</tbody> </table>';
  ?>
	
	 
  </div> <br/>
		  <?php
  }
  //fin if
  ?>
    
     <center>
     


         <?php
         $selecCV = mysql_query("select * from cv  where candidats_id='" . $resultat['candidats_id'] . "'  AND principal=1 AND actif=1" .$g_by2  );

         $councv = mysql_num_rows($selecCV);

         $result_cv = mysql_fetch_array($selecCV);
         if ($councv) {

             if (strpos($result_cv['lien_cv'], ".pdf") || strpos($result_cv['lien_cv'], ".PDF") )
                 $img = '<i class="fa fa fa-file-pdf-o  fa-fw fa-2x" style="color: #f42323;" title="Télécharger CV"></i>';



             if (strpos($result_cv['lien_cv'], ".doc") || strpos($result_cv['lien_cv'], ".DOC")|| strpos($result_cv['lien_cv'], ".DOCX")|| strpos($result_cv['lien_cv'], ".docx")|| strpos($result_cv['lien_cv'], ".rtf")|| strpos($result_cv['lien_cv'], ".RTF"))
                 $img = '<i class="fa fa-file-word-o  fa-fw fa-2x" style="color: #003B60;" title="Télécharger CV"></i>';
         
         }

         else
         $img = '';
                           


     
             // echo '<a   href="'.$urladmin.'/cv/dcv/?cvtheq=oui&cv='.$result_cv['lien_cv'].'&id_candidat='.$resultat['candidats_id'].'&id_cv=' . $result_cv['id_cv'] . '  "   onclick="showUser()">' . $img . '</a>';

       echo '<a href="'. site_url('backend/module/candidatures/candidat/cv/'. $resultat['candidats_id']) .'" title="Télécharger le CV">'. $img .'</a>';
   
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


         <td width="5%" align="center">
          <?php $canUpdateAccount = \Modules\Candidat\Models\Candidat::canUpdateAccount($resultat); ?>
           <form method="post" action="">
              <input type="hidden" name="cua" value="<?= $resultat['can_update_account']; ?>">
              <input type="hidden" name="cua_cid" value="<?= $resultat['candidats_id']; ?>">
              <button type="submit"><i class="fa fa-<?= ($canUpdateAccount) ? 'unlock' : 'lock'; ?>"></i></button>
            </form>
         </td>
         <td >

             <?php

             
        
            if ($councv) {
				
                
                    echo '<a href="javascript:showDiv(\''.$resultat['prenom'] .'\',\''.$resultat['nom'] .'\',\''.$resultat['candidats_id'] .'\')" title="Affecter à une offre" class="dossier1" 
                    id="dossier1"> <i class="fa fa-pencil-square-o fa-fw fa-lg"></i></a>';   
                   
                   
				
            echo '<a href="javascript:showDivd(\''.$resultat['nom'].'\',\''.$resultat['prenom'].'\',\''.$resultat['candidats_id'].'\')" title="Choisir un dossier" 
                class="dossier1" id="dossier1">
                <i class="fa fa-file fa-fw fa-lg " style="color:#47A948;"></i></a>';

           
            $sqlRole = mysql_query("select * from root_roles where login = '".$_SESSION["abb_admin"]."'");
            $fetchRole = mysql_fetch_array($sqlRole);
			/*
            echo ' <a href="javascript:sendCandidature1(\''.$fetchRole['email'].'\' ,
                \''.$result_cv['lien_cv'].'\' , \''.$lettre_a.'\')" title="Transf&eacute;rer le cv">
                <img src="'.$imgurl.'/icons/email.png" alt="Envoyer le CV"/>
            </a> ';
			//*/
            echo ' <a href="'.$urladmin.'/popup/transferer_email/?email='.$fetchRole['email'].'&cv='.$result_cv['lien_cv'].'&lm= " title="Transf&eacute;rer le cv">
               <i class="fa fa-envelope fa-fw fa-lg" ></i>
            </a> ';
            }
            $sqlcan = mysql_query("select email from candidats where candidats_id = '".$resultat['candidats_id']."'");
            $fetchcan = mysql_fetch_array($sqlcan);
                                 
            $sqlRole = mysql_query("select * from root_roles where login = '".$_SESSION["abb_admin"]."'");
            $fetchRole = mysql_fetch_array($sqlRole);
            /*
            echo ' <a href="javascript:sendCandidatureCandidat(\''.$fetchRole['email'].'\' , \''.$fetchcan['email'].'\')" 
            title="Envoyer un email au candidat"><img src="'.$imgurl.'/icons/emaile.png" alt="Envoyer le CV"/></a> ';
			//*/
            echo ' <a href="'.$urladmin.'/popup/envoyer_email/?email='.$fetchRole['email'].'&emailc='.$fetchcan['email'].' " 
            title="Envoyer un email au candidat"> <i class="fa fa-envelope-o fa-fw fa-lg" ></i> </a> ';

         ?> 
         <div style="float: right">
        <input name="select[]" id="select<?php echo $i; ?>" type="checkbox" 
        value="<?php echo $resultat['candidats_id']; ?>" onclick="colorer('<?php echo $i; ?>')" 
        <?php if(isset($_POST['id_candidat']) && ($resultat['candidats_id'] == $_POST['id_candidat'])) 
        echo 'checked'; ?> />
    </div>
    
         </td>
 </tr>

<?php
 }}
 }
 ?>
       </tbody>
   </table>
   
  <div id="pager_archive">
        <img  style="float: right" class="selectallarrow" src="<?php echo $imgurl ?>/arrow_ltr_b.png" 
        width="38" height="22"alt="Pour la sélection :">
      
    </div>
     <div style="float: right" >
  Pour la sélection : 
     <input  class="espace_candidat" name="email_tt" type="submit" value="Choisir un dossier"    alt="Choisir un dossier"/>
     
     <!--<input name="candidature" type="hidden" value="<?php echo $return['candidats_id']; ?>" />-->


     
     </div>
  
  </form>

                <div <?php  if($nbPages>1) echo 'style="float:left"'; ?>>
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
     <div class="pagination">
         <?php        
$la_page = '?' ;
require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination2.php');            
Pagination::affiche($la_page, 'idPage', $nbPages, $pageCourante, 2);
            ?>
    </div>