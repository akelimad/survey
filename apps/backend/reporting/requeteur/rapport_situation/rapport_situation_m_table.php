
   
<div class="subscription" style="margin: 10px 0pt;">  

<div style=" float: left; margin: -2px 0px 0px 10px;">
<h2 style="color:#fff;">
Total des candidatures : <span class="badge"><?php echo $tpc; ?></span>
</h2>
</div> 

<div style=" float: right; margin: -5px 10px 0px 0px;">
<a href="#"    title="Imprimer" onclick="PrintElem('#imprime');return false;" style=" border-bottom: none; ">
<img src="<?php echo $imgurl ?>/icons/print.png" title="Imprimer"/> 
</a>

<a href="../" style=" border-bottom: none; ">
<img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>
</a>
</div>

</div>
<div id="imprime"> 

 <div id="divTableDataHolder"> 
 <table width="100%" border="0" cellspacing="0" id="note_candidature" class="tablesorter" style="background: none;">  

  
  <thead>
   <tr>
   <td widtd="2%" style="border: 1px solid #ccc;text-align: left;
    background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">N°</b></center>
    </td> 
   <td widtd="30%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
   <center><b style="color:#fff">OFFRE</b></center></td>
   <td widtd="15%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
   <center><b style="color:#fff">NOM & PRENOM</b></center></td>
   <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
   <center><b style="color:#fff">DATE CANDIDATURE</b></center></td>
   <td widtd="15%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
   <center><b style="color:#fff">CHARG&#201; DE RECRUTEMENT</b></center></td>
   <td widtd="20%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
   <center><b style="color:#fff">ETAT ATTEINT</b></center></td>
   <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
   <center><b style="color:#fff">DATE D'AFFECTATION</b></center></td>
  </tr>
  </thead>
  
  
  <tbody>
  <?php


  $cc = mysql_num_rows($rst_pagination);
  //echo $cc;
  if($cc)
  { 
  $ii = 1;$i=0;
  $iss=0;

  $alter_class=1;
  mysql_data_seek($rst_pagination,0);
  while($return = mysql_fetch_array($rst_pagination))
     {
      $iss++;
      $is=$iss+$limitstart;
		 
		  
		 
		 /*=============================================================================================*/
		  
		 
		 
	$tbl_candidats = mysql_query("SELECT prenom,nom FROM candidats WHERE candidats_id = '".$return['candidats_id']."' limit 0,1");
	$r_candidats = mysql_fetch_array($tbl_candidats);
		 
		
	$tbl_historique = mysql_query("select status, date_modification,utilisateur from historique where id_candidature = '".$return['id_candidature']."' order by  `historique`.`id` DESC limit 0,1");
	$r_historique = mysql_fetch_array($tbl_historique);
		  
		 
		  
	$tbl_root_roles = mysql_query("select  nom  from  root_roles  where  login = '".$r_historique['utilisateur']."' limit 0,1");
	$r_root_roles = mysql_fetch_array($tbl_root_roles);
		 
		   
		 /*=============================================================================================*/
		 
         
		 $NOM_C='<a class="info" href="'.$urladmin.'/cv/?candid='.$return['candidats_id'].'"  > '.
       '<b>' . $r_candidats['nom'].'&nbsp;'.$r_candidats['prenom'].'  </b></a>';
 
		 $OFFRE=$return['Name'];
		 $DATE_CAND=$return['date_candidature'];
		 $CHAR_RUC=  $r_root_roles['nom'];
		 $ETAT_ATT= $r_historique['status'] ; 
		 $DATE_AFF=$r_historique['date_modification']; 
		 
		





/*
	  echo $return['id_offre']; 
*/	

 
  ?>  
  
  <tr>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $is; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $OFFRE; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $NOM_C; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $DATE_CAND; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $CHAR_RUC; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $ETAT_ATT; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $DATE_AFF; ?></center></td>
 
  </tr>
  
     <?php 
     }
           
        ?>
    </tbody>
     </table>
     </div>
     </div>

     <p> 
 
     </p>
  
     <?php
    }
    else
       echo '<tr class="sectiontableentry1"><td></td><td colspan="14" align="center">Aucune candidature</td></tr></tbody></table>'; 

?>
    <div class="pagination">
       
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
           
      <div id=""> 
					<?php       
					$lapage = '?offre='.$id_offre;
					
					require_once (dirname ( __FILE__ ) . $incurl3.'/class.pagination2.php');
					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 ); 
	
	
					?>
      </div>
              
    </div>
 

 
 
