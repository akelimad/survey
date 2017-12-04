

<?php     //if( $_POST['co']!='')    {     

if(isset($_POST['co']) and  $_POST['co']!="" ){    ?>   

                             

    <center>  

  <div class="datepicker_top"><b>Le</b> 

                <strong><?php switch( date("D")){case 'Sat':echo 'Dimanche';break;case 'Mon':echo 'Lundi';break;case 'Tue':echo 'Mardi';break;case 'Wed':echo 'Mercredi';break;case 'Thu':echo 'Jeudi';break;case 'Fri':echo 'Vendredi';break;case 'Sun':echo 'Samedi';break;}?>

                 <?php echo date("j");?>

                 <?php switch( date("M")){case 'Jan':echo 'Janvier';break;case 'Feb':echo 'Février';break;case 'Mar':echo 'Mars';break;case 'Apr':echo 'Avril';break;case 'May':echo 'Mai';break;case 'Jun':echo 'Juin';break;case 'Jul':echo 'Juillet';break;case 'Aug':echo 'Août';break;case 'Sep':echo 'Septembre';break;case 'Oct':echo 'Octobre';break;case 'Nov':echo 'Novembre';break;case 'Dec':echo 'Décembre';break;}?></strong>

                <B><?php echo date("Y");?></B> </div>                            



  </center>                          

    

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" > 



<table  style="width: 50%;" class="tablesorter" > 

<thead>

   <tr>

    <th width="50%"><h2><b>Status</b></h2></th>

    <th width="50%" ><h2><b>Nombre des candidatures</b></h2></th>  

  </tr>



  </thead>



  <tbody>



  

  

  

  

<?php





$query  =   (isset($_SESSION["query"])) ?  $_SESSION["query"] : '' ; 

 

                 

                $co = $_POST['co'];

              

 $statut="En attente";

    

                $query = "SELECT h.status as status,h.date_modification as datee,count(*) as nbr

                 FROM historique h,candidature c 

                 WHERE h.id_candidature = c.id_candidature  AND c.id_offre= ".$co." and h.status = '".$statut."'

                 GROUP BY h.status ORDER BY `h`.`date_modification` DESC 

                 ";

  $ccc ="";

				$query_status = mysql_query($query); 

				while($return_status = mysql_fetch_array($query_status)) {  

					  $ccc = $return_status["nbr"];

				}

 

 

?>

  <tr>

  <td><?php echo $statut;  ?></td>

  <td><?php if($ccc==''){echo '<center>0</center>';}else echo "<center><b>".$ccc."</b></center>"; ?></td>

  <td></td>

</tr>

  

  

  

  

  

  

<?php





$query  =   (isset($_SESSION["query"])) ?  $_SESSION["query"] : '' ; 

 

                 

                $co = $_POST['co'];

              

           







$select_status_r = mysql_query("SELECT ref_statut , statut 

FROM `prm_statut_candidature` 

where  etat_1 ='1'  or  etat_2 ='1'  or  etat_3 ='1'  or  etat_4 ='1'  or  etat_5 ='1'  or  etat_6 ='1'  or  etat_7 ='1'  or  etat_8 ='1'   

group BY statut  order by order_statut DESC" );

while($status_ref_r = mysql_fetch_array($select_status_r))

{

  $nbr_ent1s=$return_status["nbr"];

$ref_statut = $status_ref_r['ref_statut'];$statut = $status_ref_r['statut'];

 

 

    

                $query = "SELECT h.status as status,h.date_modification as datee,count(*) as nbr

                 FROM historique h,candidature c 

                 WHERE h.id_candidature = c.id_candidature  AND c.id_offre= ".$co." and h.status = '".$statut."'

                 GROUP BY h.status ORDER BY `h`.`date_modification` DESC 

                 ";

  $ccc ="";

				$query_status = mysql_query($query); 

				while($return_status = mysql_fetch_array($query_status)) {  

					  $ccc = $return_status["nbr"];

				}

 

 

?>



<tr>

  <td><?php echo $statut;  ?></td>

  <td><?php if($ccc==''){echo '<center>0</center>';}else echo "<center><b>".$ccc."</b></center>"; ?></td>

  <td></td>

</tr>

<?php } ?>    



  

   



    </tbody>



     </table>

    <div>

      <div id="visualization_de_candidatures_par_offre_detail" style="width: 680px; height: 300px;"></div>

    </div>





  

                 

    

    



</form>

    



                        

      

              

<?php } ?>



