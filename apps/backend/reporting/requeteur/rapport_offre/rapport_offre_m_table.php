
   
<div class="subscription" style="margin: 10px 0pt;">  
 
<div style=" float: left; margin: -2px 0px 0px 10px;padding-left: 20px;">
    <a href="" >
    <h2 style="color:#fff;">
    Total des candidatures : <span class="badge"><?php echo $tpc; ?></span></h2>
    </a>
  </div> 
  <div style=" float: right; margin: -5px 10px 0px 0px;">
      <a href="javascript:void(0)" title="Imprimer" onclick="PrintElem('#imprime');return false;" 
     style=" border-bottom: none; ">
      <img src="<?php echo $imgurl ?>/icons/print.png" title="Imprimer"/> 
      </a>

     <a href="../" style=" border-bottom: none; ">
       <img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"/>
       <strong style="color:#fff">Retour</strong>
     </a>

  </div>
  
</div>

<div id="imprime"> 


 <div id="divTableDataHolder"> 
 
	
	
<table width="100%" border="0" cellspacing="0" id="note_candidature" class="tablesorter" style="background: none;">  
<thead>
  <tr>
    <td widtd="15%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">OFFRE</b></center>
    </td>
    <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">DATE CREATION</b></center>
    </td>
    <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">TYPE OFFRE</b></center>
    </td>
    <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">NBR CANDIDATURE</b></center>
    </td>
    <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">NBR CV OUVERT</b></center>
    </td>
    <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">NBR CV TELECHARGER</b></center>
    </td>
  </tr>
</thead>
<tbody>
  <?php
  $cc = mysql_num_rows($rst_pagination);
  /*echo $cc;*/
  $cc2 = mysql_num_rows($query_candidature123);
/* echo $cc2; */
  if($cc)
  { 
  while($return = mysql_fetch_array($rst_pagination))
  { 
    $nom=$return['name'];$date_insertion=$return['date_insertion'];$type_poste=$return['type_poste'];
    $id_offre=$return['id_offre'];$utilisateur=$return['utilisateur'];
    
     
    
    $sql_candidats = "SELECT vues from candidats c,candidature cd 
    where cd.candidats_id  = c.candidats_id and cd.id_offre = '".$id_offre."'
     having vues > 1 ";
    //*echo $sql_candidats."<br/>";
    $query_candidats = mysql_query($sql_candidats);
    $nbr_candidats=mysql_num_rows($query_candidats);

    $sql_candidature = "SELECT * from candidature where id_offre = '".$id_offre."' ";
    $query_candidature = mysql_query($sql_candidature);
    $nbr_candidature= mysql_num_rows($query_candidature);

    $sql_cvd= "SELECT SUM(cvd.nbr_tele) as nbr_down,cvd.* 
    from cv_telecharger cvd,candidature cd 
  where  cvd.candidats_id = cd.candidats_id and cd.id_offre = '".$id_offre."' ";
    //*echo $sql_cvd;*//
    $query_cvd = mysql_query($sql_cvd);
    $return_nbr_cvs= mysql_fetch_array($query_cvd);
    $nbr_cvd=$return_nbr_cvs['nbr_down'];

  ?>  
  <tr>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $nom; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $date_insertion; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;"><center><?php echo $type_poste; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;">
      <center><?php if($nbr_candidature != ''){echo $nbr_candidature;}else{ echo '0';} ?></center>
    </td>
    <td style="border: 1px solid #ccc;text-align: left;">
      <center><?php if($nbr_candidats != ''){echo $nbr_candidats;}else{ echo '0';} ?></center>
    </td>
    <td style="border: 1px solid #ccc;text-align: left;">
      <center><?php if($nbr_cvd != ''){echo $nbr_cvd;}else{ echo '0';} ?></center>
    </td>

  </tr>
  <?php } ?>
</tbody>
</table>
<?php }else
  echo '<tr class="sectiontableentry1"><td></td><td colspan="14" align="center">Aucune candidature</td></tr></tbody></table>'; 
?>











<?php
/*==============================================================*/
?>








<!-- -->










<?php
/*==============================================================*/
?>


<?php

$select_status_r = mysql_query("SELECT ref_statut , statut 
    FROM `prm_statut_candidature` 
    WHERE statut IN (SELECT distinct(status) FROM historique) 
    group BY statut  order by order_statut DESC" );
	
	$status_count=mysql_num_rows($select_status_r);
 
	
?>







<table width="100%" border="0" cellspacing="0" id="note_candidature" class="tablesorter" style="background: none;">  
<thead>
  <tr>
    <td widtd="10%" >
    </td>
    <td widtd="90%" colspan="<?php echo $status_count+1; ?>"  style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center>
    <b style="color:#fff">STATUS</b>
    </center>
    </td>
  </tr>
  <tr>
  <td widtd="2%" style="border: 1px solid #ccc;text-align: left;
  background:<?php echo $color_bg;?>" >
  <center><b style="color:#fff">N°</b></center>
  </td>
  <td widtd="10%" style="border: 1px solid #ccc;text-align: left;
  background:<?php echo $color_bg;?>" >
  <center><b style="color:#fff">NOM & PRENOM</b></center>
  </td>
<?php 
 
$select_status_r = mysql_query("SELECT ref_statut , statut 
    FROM `prm_statut_candidature` 
    WHERE statut IN (SELECT distinct(status) FROM historique) 
    group BY statut  order by order_statut DESC" );
$r_status =0;
 while($status_ref_r = mysql_fetch_array($select_status_r))
 {
$ref_statut = $status_ref_r['ref_statut'];
$statut = $status_ref_r['statut'];
$r_status++;
?>
  <td  style="border: 1px solid #ccc;text-align: left;
  background:<?php echo $color_bg;?>">
  <center><b style="color:#fff"><?php echo $statut; ?></b></center>
  </td>
<?php
 } 
?>
  </tr>
</thead>
<tbody>
<?php

$query_candidature12312 = mysql_query($sql_pagination);
$is=0;
while($return_candidature= mysql_fetch_array($query_candidature12312)){
$is++;
$is=$is+$limitstart;

$nom=$return_candidature['nom'];$prenom=$return_candidature['prenom'];
$id_offre=$return_candidature['id_offre'];$status=$return_candidature['status'];
$id_candidatures=$return_candidature['id_candidature'];

 ?>
<tr>
    <td style="border: 1px solid #ccc;text-align: left;width: 2%;vertical-align:middle">
      <center><?php echo $is; ?></center>
    </td>
    <td style="border: 1px solid #ccc;text-align: left;width: 16%;vertical-align:middle">
      <center><?php echo $nom." ".$prenom; ?></center>
    </td>

	
	
	
	

<?php 
 
$select_status_r = mysql_query("SELECT ref_statut , statut 
    FROM `prm_statut_candidature` 
    WHERE statut IN (SELECT distinct(status) FROM historique) 
    group BY statut  order by order_statut DESC" );
$r_status =0;
 while($status_ref_r = mysql_fetch_array($select_status_r))
 {
$ref_statut = $status_ref_r['ref_statut'];
$statut = $status_ref_r['statut'];
$r_status++;

//echo $statut."<br>";
?>


	
    
    <?php
    if($status !='En attente'){
    $sql_enatt = "SELECT * from historique h,root_roles r
    where id_candidature = '".$id_candidatures."' and r.login = h.utilisateur
    and status like '".$statut ."' limit 0,1";
    $sql_query_enatt = mysql_query($sql_enatt);
    $csount = mysql_num_rows($sql_query_enatt);
    $couleurs = array('#ddd', '#e8f0f0');
    $nombre = count($couleurs);
    $i = 0;
    while ($i < $csount)
    {
    while($sql_enatt_num = mysql_fetch_array($sql_query_enatt)){
    $E_TES11=$sql_enatt_num['nom'];$E_TES2=date("d.m.Y H:m",strtotime($sql_enatt_num['date_modification']));
    $E_TES1 = substr ( $sql_enatt_num['nom'], 0, 20 );
    ?>
	
    <td style="border: 1px solid #ccc;text-align: left;width: 14%;">
    <table>
    <tr>
    <td style="border: 1px solid #ccc;text-align: left;width: 16%;background-color : <?php echo $couleurs[ $i % $nombre];?>">
    <center><b><?php echo $E_TES1; ?></b></center>
    </td>
    </tr><tr>
    <td style="border: 1px solid #ccc;text-align: left;width: 16%;background-color : <?php echo $couleurs[ ($i-1) % $nombre];?>">
    <center><b><?php echo $E_TES2; ?></b></center>
    </td>
    </tr>
    </table>
    </td>
	
    <?php }$i++; 
      }
	  
	  if(( $csount == 0)){
    ?>
		
    <td style="border: 1px solid #ccc;text-align: left;width: 14%;"> </td>
	
	<?php
	 } 
	 	
    }?>
	



<?php
 } 
?>	
	
	
	

	
	
	
	
	
	
	
	
	  

</tr>
<?php } ?>
</tbody>
</table>
<table width="100%" border="0" cellspacing="0" id="note_candidature" class="tablesorter" style="background: none;">  
<thead>
  <tr>
    <td widtd="10%" >
    
    </td>
    <td widtd="90%" colspan="<?php echo $status_count+1; ?>" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">COMMENTAIRE</b></center>
    </td>
  </tr>
  <tr>
  
  <td widtd="2%" style="border: 1px solid #ccc;text-align: left;
  background:<?php echo $color_bg;?>" >
  <center><b style="color:#fff">N°</b></center>
  </td>
  
  <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>" >
  <center><b style="color:#fff">NOM & PRENOM</b></center>
  </td>


<?php 
 
$select_status_r = mysql_query("SELECT ref_statut , statut 
    FROM `prm_statut_candidature` 
    WHERE statut IN (SELECT distinct(status) FROM historique) 
    group BY statut  order by order_statut DESC" );
$r_status =0;
 while($status_ref_r = mysql_fetch_array($select_status_r))
 {
$ref_statut = $status_ref_r['ref_statut'];
$statut = $status_ref_r['statut'];
$r_status++;
?>
  <td  style="border: 1px solid #ccc;text-align: left;
  background:<?php echo $color_bg;?>">
  <center><b style="color:#fff"><?php echo $statut; ?></b></center>
  </td>
<?php
 } 
?>
  
  </tr>
</thead>
<tbody>
<?php


$isc=0;

while($return_candidature12= mysql_fetch_array($query_candidature123)){
$isc++;
$isc=$isc+$limitstart;

$nom=$return_candidature12['nom'];$prenom=$return_candidature12['prenom'];
$id_offre=$return_candidature12['id_offre'];$status=$return_candidature12['status'];
$id_candidatures=$return_candidature12['id_candidature'];

 ?>
<tr>

    <td style="border: 1px solid #ccc;text-align: left;width: 2%;vertical-align:middle">
      <center><?php echo $isc; ?></center>
    </td>
	
    <td style="border: 1px solid #ccc;text-align: left;width: 16%;vertical-align:middle">
      <center><?php echo $nom." ".$prenom; ?></center>
    </td>
 
 
 
 
 
 
	
	
	

<?php 
 
$select_status_r = mysql_query("SELECT ref_statut , statut 
    FROM `prm_statut_candidature` 
    WHERE statut IN (SELECT distinct(status) FROM historique) 
    group BY statut  order by order_statut DESC" );
$r_status =0;
 while($status_ref_r = mysql_fetch_array($select_status_r))
 {
$ref_statut = $status_ref_r['ref_statut'];
$statut = $status_ref_r['statut'];
$r_status++;

//echo $statut."<br>";
?>


	
    
 <td style="border: 1px solid #ccc;text-align: left;width: 14%;">
    <?php
    if($status !='En attente'){
    $sql_enatt = "SELECT * from historique h,root_roles r
    where id_candidature = '".$id_candidatures."' and r.login = h.utilisateur
    and status like '".$statut."' limit 0,1";
    $sql_query_enatt = mysql_query($sql_enatt);
    $csount = mysql_num_rows($sql_query_enatt);
    $couleurs = array('#ddd', '#e8f0f0');
    $nombre = count($couleurs);
    $i = 0;
    while ($i < $csount)
    {
    while($sql_enatt_num = mysql_fetch_array($sql_query_enatt)){
    $E_TES1=$sql_enatt_num['commentaire'];$E_TES2 = substr ( $sql_enatt_num['commentaire'], 0, 30 );
    $E_TES3 = substr ( $sql_enatt_num['nom'], 0, 20 ); 
    ?>
    <table>
    <tr>
    <td style="border: 1px solid #ccc;text-align: left;width: 16%;background-color : <?php echo $couleurs[ $i % $nombre];?>">
    <center><b><?php echo " ".$E_TES3; ?></b></center>
    </td>
    </tr>
    </table>
    <center><?php echo utf8_decode($E_TES2); ?></center>
    <?php }$i++; 
      }
	  
	 	
    } 
	 
    ?>
    </td>
	
    
	



<?php
 } 
?>	
	
	
	

	
	
 
 
 
 
 
 
 
 
 
 
 
 
 
 
  
    
     

</tr>
<?php } ?>
</tbody>
</table>
<!-- -->
 
</div>


</div>



<div class="pagination">
       
      <?php   if( $cc2>10  or $nbPages>1 ) { ?>
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
					 
					/* 
					$lapage = 'pages/'  ;
					require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination.php');
					 
					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2,$urladmin.'/accueil' );
			
					//*/
					?>
      </div>
              
    </div>
 

 
