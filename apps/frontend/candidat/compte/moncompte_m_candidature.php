<tr>

<td colspan="4" class="subscription"><h1>Mes candidatures </h1></td>

</tr>



<tr style="  background: #A6BFD3;">

<td style="width:10%"><center><b>Date</b></center></td>

<td style="width:37%"><b>Intitul&eacute; du poste</b></td>

<td style="width:13%"><b>Etat</b></td>

<td style="width:6%"><b>Action</b></td> 

</tr>



          <?php 

// select table candidature offre 

$select_candidatures = mysql_query("SELECT * from candidature 

 inner join offre on candidature.id_offre = offre.id_offre 

where candidature.candidats_id = '".safe($_SESSION['abb_id_candidat'])."'   ");

$count = mysql_num_rows($select_candidatures);                               



if ($count){

$ii = 1;$j = 1;

//début while select candidadature

while ($candidature = mysql_fetch_array($select_candidatures)) {                                     

                                 

$hit_sql="SELECT * from historique 

where id_candidature = '".safe($candidature['id_candidature']). "' 

 ORDER BY  `date_modification` DESC";

$select_histo = mysql_query($hit_sql); 



//status de candidature            

if($req_histo = mysql_fetch_array($select_histo)) {

 

 if($status !='En attente'){

 //$status=$req_histo['status'];//afficher le status

 $status='En cours';//casher le status

 }



}

else {

  $status='En attente';

}

//fin status de candidature  

$confirmation_statu='';



/*echo "select * from agenda where 

id_candidature = '".$candidature['id_candidature']. "' |-----------------| ".$_SESSION['abb_id_candidat'].'****';

*/

$select_agenda = mysql_query("SELECT * from agenda 

  where id_candidature = '".safe($candidature['id_candidature']). "' ");



 $status_ag='';

if($req_agenda = mysql_fetch_array($select_agenda)) {



$confirmation_statu=$req_agenda['confirmation_statu'];

$lien_confirmation=$site.'confirmation/?i='.$req_agenda['id_agend'];

$status_ag=$req_agenda['action'];



}

           

//echo  $confirmation_statu.'<--|<br>'; http://localhost/etalent/confirmation_statu.php?id_agenda=0

//

?>



<tr class="sectiontableentry<?php echo $ii;$ii == 1 ? $ii++ : $ii--;?>">



<td>

<center><b><?php echo date('d.m.Y', strtotime($candidature['date_candidature'])); ?></b></center></td>



<td><?php echo $candidature['Name']; ?></td>



<td><?php  echo $status; ?></td>



<td style="text-align:center">

<?php

//confirmation status

if($confirmation_statu=='') { 



$clas='fa-spinner';$conf1='fa-spinner';

$conf0="En attente";$lien_confirmation='#';

$styleCursor='style="cursor: default;"';

                

}else {



if($confirmation_statu==1) {



$clas='fa-paper-plane-o';

$conf1='#01A829';$conf0="Confirmé";

$lien_confirmation='#';$styleCursor='style="cursor: default;"';



}



else { 

  

  $clas='fa-paper-plane-o'; $conf1='#ED0C0C';

  $conf0="Non confirmé";$styleCursor='';



}



}  

//fin confirmation status     

?>

<div style=''>

<a href="<?php echo $lien_confirmation; ?>" title="<?php echo $conf0; ?>">

<i class="fa <?php echo $clas; ?> fa-fw fa-lg" 

style="color : <?php echo $conf1; ?>" <?php echo $styleCursor; ?>></i>

</a><br/>

</div>





</td>

</tr>

<?php                                        

$j++;                                    

}



}  



else {                                    

echo '<tr class="sectiontableentry1"><td colspan="5">Aucune candidature enregistrée</td></tr>';

}

          ?>