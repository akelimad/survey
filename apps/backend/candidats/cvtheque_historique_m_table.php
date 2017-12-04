<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script> 
<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery.tablesorter.pager.min.js"></script>

</head>
<body>

          
<table width="100%" border="0" cellspacing="0" id="dossier" class="tablesorter" style="background: none;">

<thead>
        <tr>
            <th width="10%" >Nom</th>
            <th  width="60%" ><center><b> Détails </b></h2></center></th>
            <th width="20%"  ><center><b> Date </b></center></th>
            <th width="5%"><center><b> Action </b></h2></center></th>
        </tr>
</thead>
<tbody>

                        <?php
$select1 = mysql_query("SELECT * FROM  `historique_cvtheque` ");
$countdelet = mysql_num_rows($select1);

while( $reponse = mysql_fetch_array($select)) { ?>
<tr>
<td><?php echo $reponse['user']; ?></td>
<td><?php 
$di=$reponse['id_hit_cvtheq'];
$desc = $reponse['motcle'];
$sidt1 = $reponse['id_sect'];
$sidt2 = $reponse['id_expe'];
$sidt3 = $reponse['id_salr'];
$sidt4 = $reponse['id_for'];
$sidt5 = $reponse['id_etab'];
$sidt6 = $reponse['id_dispo'];
$sidt7 = $reponse['id_situ'];
$sidt8 = $reponse['id_tfor'];
$sidt9 = $reponse['id_pays'];
$sidt10 = $reponse['id_frai'];
?>
<?php 
//$apercu_description = substr(strip_tags($saa56), 0, 80);
//echo $apercu_description;
echo " D&eacute;tail de l'historique <br/>";
if($desc ==''){}else{
echo ' Par mot cle : <b>'.$desc.'</b><br/>';
}
if($sidt1 ==0){}else{
$select_1 = mysql_query("SELECT * FROM prm_sectors where id_sect = '$sidt1'");
$sa1 = mysql_fetch_array($select_1);
$saa1 = $sa1['FR'];
echo ' Par secteur d’activité : <b>'.$saa1.'</b>';
}
?>
<a class="info" href="cvtheque.php?a=2&b=24&idcvh=<?php echo $reponse['id_hit_cvtheq']; ?>" > 
<img src="<?php echo $imgurl ?>/info.png" alt="details" width="9" height="9" />
<span style="width:650px;padding:16px;word-wrap: break-word; ">  D&eacute;tail de l'historique 
<ul>
<?php 
if($desc ==''){}else{
echo '<li> Par mot cle : <b>'.$desc.'</b></li>';
}
if($sidt1 ==0){}else{
$select_1 = mysql_query("SELECT * FROM prm_sectors where id_sect = '$sidt1'");
$sa1 = mysql_fetch_array($select_1);
$saa1 = $sa1['FR'];
echo '<li> Par secteur d’activité : <b>'.$saa1.'</b></li>';
}
if($sidt2 ==0){}else{
$select_2 = mysql_query("SELECT * FROM prm_experience where id_expe = '$sidt2'");
$sa2 = mysql_fetch_array($select_2);
$saa2 = $sa2['intitule'];
echo '<li> Par années d expérience : <b>'.$saa2.'</b></li>';
}
if($sidt3 ==0){}else{
$select_3 = mysql_query("SELECT * FROM prm_salaires where id_salr = '$sidt3'");
$sa3 = mysql_fetch_array($select_3);
$saa3 = $sa3['salaire'];
echo '<li> Par salaire souhaité en DH : <b>'.$saa3.'</b></li>';
}
if($sidt4 ==0){}else{
$select_4 = mysql_query("SELECT * FROM prm_niv_formation where id_nfor = '$sidt4'");
$sa4 = mysql_fetch_array($select_4);
$saa4 = $sa4['formation'];
echo '<li> Par niveau d étude : <b>'.$saa4.'</b></li>';
}
if($sidt10 ==30){
  $fcv='Moins 1 mois';
  echo '<li> Par fraicheur du CV : <b>'.$fcv.'</b></li> ';
}
if($sidt10 ==90){
  $fcv='Moins 2 mois';
echo '<li> Par fraicheur du CV : <b>'.$fcv.'</b></li> ';}
if($sidt10 ==180){
  $fcv='Moins 6 mois';
echo '<li> Par fraicheur du CV : <b>'.$fcv.'</b></li> ';}
if($sidt10 ==360){
  $fcv='Moins 12 mois';
echo '<li> Par fraicheur du CV : <b>'.$fcv.'</b></li> ';}

if($sidt5 ==0){}else{
$select_5 = mysql_query("SELECT * FROM prm_ecoles where id_ecole = '$sidt5'");
$sa5 = mysql_fetch_array($select_5);
$saa5 = $sa5['nom_ecole'];
echo '<li> Par école ou établissement : <b>'.$saa5.'</b></li>';
}
if($sidt6 ==0){}else{
$select_6 = mysql_query("SELECT * FROM prm_disponibilite where id_dispo = '$sidt6'");
$sa6 = mysql_fetch_array($select_6);
$saa6 = $sa6['intitule'];
echo '<li> Par disponibilité : <b>'.$saa6.'</b></li> ';
}
if($sidt7 ==0){}else{
$select_7 = mysql_query("SELECT * FROM prm_situation where id_situ = '$sidt7'");
$sa7 = mysql_fetch_array($select_7);
$saa7 = $sa7['situation'];
echo '<li> Par situation actuelle : <b>'.$saa7.'</b></li> ';
}
if($sidt8 ==0){}else{
$select_8 = mysql_query("SELECT * FROM prm_type_formation where id_tfor = '$sidt8'");
$sa8 = mysql_fetch_array($select_8);
$saa8 = $sa8['formation'];
echo '<li> Par type de formation : <b>'.$saa8.'</b></li> ';
}
if($sidt9 ==0){}else{
$select_9 = mysql_query("SELECT * FROM prm_pays where id_pays = '$sidt9'");
$sa9 = mysql_fetch_array($select_9);
$saa9 = $sa9['pays'];
echo '<li> Par pays de résidence : <b>'.$saa9.'</b></li> ';
}
 ?>
</ul>


            </span> 
         </a>
</td>
<td><?php echo date('d/m/Y H:i:s',strtotime($reponse['date'])); ?></td>        
<td>
  <a href="#" onclick="if(confirm('Êtes-vous sûre de vouloir supprimer ce profil?'))location.href='rechercher_can.php?action=delete&id=<?php echo $reponse['id_hit_cvtheq'] ?>'">
<img src="<?php echo $imgurl ?>/icons/delete.png" title="Supprimer ce message"/>
</a>
<div style="float: right">
<input name="select[]" id="select<?php echo $i; ?>" type="checkbox" value="<?php echo $reponse['id_hit_cvtheq']; ?>" onclick="colorer('<?php echo $i; ?>')" <?php if(isset($_POST['id_hit_cvtheq']) && ($reponse['id_hit_cvtheq'] == $_POST['id_hit_cvtheq'])) echo 'checked'; ?> />
</div>
</td>
                                    </tr>

 <?php
}

?>   

</tbody>

                        </table>
<div>
<img  style="float: right" class="selectallarrow" src="<?php echo $imgurl ?>/arrow_ltr_b.png" width="38" height="22" alt="Pour la sélection :"></div>
<div style="float: right" > Pour la sélection : 
     <input   name="email_tt" class="espace_candidat" type="submit" value="Supprimer"    alt="à supprimer" />
     <input name="id" type="hidden" value="<?php echo $reponse['id']; ?>" /> 
     </div>
                       
        <div id="dossier_pagination">
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
              <img src="<?php echo $imgurl ?>/icons/first.png" class="first"/> 
              <img src="<?php echo $imgurl ?>/icons/prev.png" class="prev"/>
              <input type="text" class="pagedisplay" name="page"/>
              <img src="<?php echo $imgurl ?>/icons/next.png" class="next"/> 
              <img src="<?php echo $imgurl ?>/icons/last.png" class="last"/>
              <select class="pagesize">
                <option selected="selected"  value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option  value="40">40</option>
              </select>
            </form>
        </div>



</body>
<script type="text/javascript">
$(document).ready(function() { 
        $("#dossier").tablesorter({headers: { 0: {sorter:'text'} ,1: { sorter: false}, 2: {sorter:false}}, widthFixed: true, widgets: ['zebra']});
  
        $("#dossier").tablesorterPager({container: $("#dossier_pagination"),positionFixed: false <?php if (isset($page)) echo ', page:' . ($page - 1); ?>});

                });
</script>
</html>