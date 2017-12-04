



          

<table width="70%" border="0" cellspacing="0" id="dossier" class="tablesorter" style="background: none;">



<thead>

        <tr>

            <th  width="45%" ><center><b> Détail de la requéte </b></h2></center></th>

            <th width="25%"  ><center><b> Date </b></center></th>

            <th width="25%" ><center><b> Nom </b></center></th>

            <th width="5%"><center><b> Action </b></h2></center></th>

        </tr>

</thead>

<tbody>



                        <?php

$sql="SELECT * FROM  `historique_cvtheque` ORDER BY  `historique_cvtheque`.`date` DESC";

$select1 = mysql_query($sql);

$dfs = mysql_num_rows($select1);

$nbItems = $dfs;

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

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

$sql.=" LIMIT " . $limitstart . "," . $itemsParPage . " "; 

$select1 = mysql_query($sql);

$countdelet = mysql_num_rows($select1);

if($countdelet==0){

?>

<tr>

<td colspan="4"><center>Aucunes données trouvez</center></td></tr>

<?php

}

while( $reponse = mysql_fetch_array($select1)) { ?>

<tr>

<td>

<a class="info" href="../?a=2&b=24&idcvh=<?php echo $reponse['id_hit_cvtheq']; ?>" > 

<?php 

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



echo " D&eacute;tail de la requéte :";

if($desc ==''){}else{

echo ' par mot cle : <b>'.$desc.'</b> ';

}

/*

if($sidt1 ==0){}else{

$select_1 = mysql_query("SELECT * FROM prm_sectors where id_sect = '$sidt1'");

$sa1 = mysql_fetch_array($select_1);

$saa1 = $sa1['FR'];

echo ' Par secteur d’activité : <b>'.$saa1.'</b>';

}*/

?>



<img src="<?php echo $imgurl ?>/info.png" alt="details" width="9" height="9" />

<span style="width:650px;padding:16px;word-wrap: break-word; ">  D&eacute;tail de la requéte

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

<td><center><?php echo date('d/m/Y H:i:s',strtotime($reponse['date'])); ?></center></td>  

<td><center><?php echo $reponse['user']; ?></center></td>

<td>

  <a href="#" onclick="if(confirm('Êtes-vous sûre de vouloir supprimer ?'))location.href='./?action=delete&id=<?php echo $reponse['id_hit_cvtheq'] ?>'">

 <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

</a>

<div style="float: right">

<input name="select[]"  type="checkbox" value="<?php echo $reponse['id_hit_cvtheq']; ?>" 

 <?php if(isset($_POST['id_hit_cvtheq']) && ($reponse['id_hit_cvtheq'] == $_POST['id_hit_cvtheq'])) echo 'checked'; ?> />

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

     <input   name="email_tt" class="espace_candidat" type="submit" 

     value="Supprimer"    alt="à supprimer" />

     <input name="id" type="hidden" value="<?php echo $reponse['id']; ?>" /> 

     </div>

     

                <div <?php  if($dfs>1) echo 'style="float:left"'; ?>>

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

require_once (dirname ( __FILE__ ) . $incurl3.'/class.pagination2.php');      

Pagination::affiche($la_page, 'idPage', $nbPages, $pageCourante, 2);

            ?>

    </div>