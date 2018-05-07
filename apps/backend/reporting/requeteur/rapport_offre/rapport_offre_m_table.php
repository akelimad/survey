
   
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

     <a href="javascript:void(0)" onclick="window.history.go(-1); return false;" style=" border-bottom: none; ">
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
$history = getDB()->prepare("SELECT c.candidats_id, c.nom, c.prenom, c.date_n, c.id_expe, h.status, h.motif_rejet FROM candidature cand JOIN candidats c ON c.candidats_id=cand.candidats_id JOIN historique h ON h.id_candidature=cand.id_candidature WHERE cand.id_offre=? GROUP BY cand.id_candidature ORDER BY h.date_modification DESC", [$_POST['co']]);
?>

<table width="100%" border="0" cellspacing="0" id="note_candidature" class="tablesorter tablesorter-default" style="background: none;" role="grid">
  <thead>
    <tr>
      <th>N°</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Etablissement</th>
      <th>Spécialité</th>
      <th>Age</th>
      <th>Expérience</th>
      <th>Statut</th>
      <th>Motif rejet</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($history)) : ?>
      <?php $i=1; foreach ($history as $key => $h) : 
        $school = $specialty = '';
        $forma = App\Models\Candidat::getLastFormation($h->candidats_id);
        if (isset($forma->id_formation)) {
          $school = App\Models\School::getNameById($forma->id_ecol);
          if (!empty($forma->specialty_other)) {
            $specialty = $forma->specialty_other;
          } elseif (!empty($forma->specialty_id)) {
            $specialty = App\Models\Specialty::getNameById($forma->specialty_id);
          }
        }
      ?>
      <tr role="row">
        <td><?= $i ?></td>
        <td><?= $h->nom ?></td>
        <td><?= $h->prenom ?></td>
        <td><?= $school; ?></td>
        <td><?= $specialty; ?></td>
        <td><?= eta_date($h->date_n) ?></td>
        <td><?= App\Models\Experience::getNameById($h->id_expe) ?></td>
        <td><?= $h->status ?></td>
        <td><?= $h->motif_rejet ?></td>
      </tr>
      <?php $i++; endforeach; ?>
    <?php else : ?>
      <tr>
        <td colspan="9">Aucune donnée trouvée</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>