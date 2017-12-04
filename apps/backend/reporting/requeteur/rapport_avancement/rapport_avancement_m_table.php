
   
<div class="subscription" style="margin: 10px 0pt;">  
  <div style=" float: left; margin: -2px 0px 0px 10px;">
  
  <a href="" >
    <h2 style="color:#fff;">
    Total des offres : <span class="badge"><?php echo $tpc; ?></span></h2>
    </a>
  </div> 
  <div style=" float: right; margin: -5px 10px 0px 0px;">
    <a href="#"    title="Imprimer" onclick="PrintElem('#imprime');return false;" style=" border-bottom: none; ">
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
    <td widtd="2%" style="border: 1px solid #ccc;text-align: left;
    background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">REF</b></center>
    </td>
    <td widtd="15%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">OFFRE</b></center>
    </td>
    <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">DATE CREATION</b></center>
    </td>
    <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">CHARG&#201; DE RECRUTEMENT</b></center>
    </td>
    <td widtd="10%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">TYPE OFFRE</b></center>
    </td>
    <td widtd="5%" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">
    <center><b style="color:#fff">CANDIDATURE</b></center>
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
  $cc = mysql_num_rows($rst_pagination);
  /*echo $cc;*/
   
  if($cc)
  { $iss=0;
  while($return = mysql_fetch_array($rst_pagination))
  { 
    $nom=$return['name'];
    $reference=$return['reference'];$date_insertion=$return['date_insertion'];
    $id_offre=$return['id_offre'];
    $utilisateur=$return['utilisateur'];$type_poste=$return['type_poste'];

$iss++;
$is=$iss+$limitstart;   
     
	 
	 
	 	 $array_status =  array();
 
    
 $sql_entretien = "SELECT h.status AS  STATUS , h.date_modification AS datee, COUNT( * ) AS nbr FROM historique h, candidature c, offre o 
					WHERE h.id_candidature = c.id_candidature AND c.id_offre = o.id_offre AND o.id_offre ='".$id_offre."' GROUP BY h.status  ";
    // echo $sql_entretien."<br/>";
				$query_status = mysql_query($sql_entretien); 
				while($return_status = mysql_fetch_array($query_status)) {  
					$array_status[$return_status["STATUS"]] = $return_status["nbr"];
				}
	  

 
 
 $nbr_status =0;
while ($array_status_var = current($array_status)) {
    if (key($array_status) == 'En attente') {
        $nbr_status = $array_status_var;
    }
    next($array_status);
} 
 
  ?>  
  <tr>
    <td style="border: 1px solid #ccc;text-align: left;">
    <?php echo $reference; ?></td>
    <td style="border: 1px solid #ccc;text-align: left;">
    <b><center><?php echo $nom; ?></center></b></td>
    <td style="border: 1px solid #ccc;text-align: left;">
    <center><?php echo date("d.m.Y",strtotime($date_insertion)); ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;">
    <center><?php echo $utilisateur; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;">
    <center><?php echo $type_poste; ?></center></td>
    <td style="border: 1px solid #ccc;text-align: left;">
    <center><?php echo $nbr_status; ?></center></td>

<?php
$select_status_r = mysql_query("SELECT ref_statut , statut 
FROM `prm_statut_candidature` 
WHERE statut IN (SELECT distinct(status) FROM historique) 
group BY statut  order by order_statut DESC" );
while($status_ref_r = mysql_fetch_array($select_status_r))
{
  $nbr_ent1s=$return_status["nbr"];
$ref_statut = $status_ref_r['ref_statut'];$statut = $status_ref_r['statut'];





	 
	 	 $array_status =  array();
 
    
 $sql_entretien = "SELECT h.status AS  STATUS , h.date_modification AS datee, COUNT( * ) AS nbr FROM historique h, candidature c, offre o 
					WHERE h.id_candidature = c.id_candidature AND c.id_offre = o.id_offre AND o.id_offre ='".$id_offre."' GROUP BY h.status  ";
    // echo $sql_entretien."<br/>";
				$query_status = mysql_query($sql_entretien); 
				while($return_status = mysql_fetch_array($query_status)) {  
					$array_status[$return_status["STATUS"]] = $return_status["nbr"];
				}






 $nbr_status =0;
while ($array_status_var = key($array_status)) {
    if ($array_status_var == $statut) {
        $nbr_status = $array_status[$array_status_var];
    }
 
    next($array_status);
}

 
?>

    <td style="border: 1px solid #ccc;text-align: left;">
    <center><?php echo $nbr_status; ?></center></td> 
<?php } ?>    

  </tr>
  <?php } ?>
</tbody>
</table>
</div>
</div>
<?php }else
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
					 
					/* 
					$lapage = 'pages/'  ;
					require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination.php');
					 
					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2,$urladmin.'/accueil' );
			
					//*/
					?>
      </div>
              
    </div>
 

 
