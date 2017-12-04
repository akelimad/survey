<div class='texte' >



<?php

include('matching_off_m_menu.php');

?>



        <br/><h1>MATCHING DES OFFRES</h1>

        <div class="subscription" style="margin: 10px 0pt; width:99.9%">

          <h1>Liste des offres </h1>

        </div>



     

<?php include ("./matching_off_m_table.php"); ?>



         

  <?php 

 

    if(isset($_GET['ref']) || isset($_GET['offre']) || isset($_POST['select']))

    {

     

  ?>

  

   

 <div class="haha">

 <?php

 

           

            $id_offre = isset($_GET['offre'])  ? $_GET['offre'] : "";

           $sql = mysql_query("select * from offre where id_offre = '$id_offre'  ".$q_ref_fili_and."  ");



            $offre_exist = mysql_num_rows($sql);

            if($offre_exist){   

                $offre = mysql_fetch_array($sql);

            }

    ?>       

           



             <div class="subscription" style="margin: 10px 0pt;">

				<h1>voir l'offre</h1>

			</div> 

			<table style="width: 820px;">

				<tr>

					<td><h1>Offre :   <?php echo $offre['Name']; ?> </h1> </td>

				</tr>  

			</table>

			

      

      <table width="100%" border="0">



    <tr>



    <td colspan="2"><div class="subscription" style="margin: 10px 0pt;">



          <h1>informations g&eacute;n&eacute;rales  </h1>



     </div></td>



    </tr>





 <tr>



  <td><b>Type de poste</b></td>



  <td>



  <?php



    $qry = mysql_query("select designation from prm_type_poste where id_tpost = '".$offre['id_tpost']."'");



    $type = mysql_fetch_array($qry);



    echo ': '.$type['designation'];



    ?>



  </td>



  </tr>

 <tr>

<td><b>Niveau d'expérience</b></td>

<td>

<?php

$req = mysql_query("SELECT * FROM prm_experience where id_expe = '".$offre['id_expe']."'");

$niv = mysql_fetch_array($req);

echo ': '.$niv['intitule'];

  ?>        

  </td>

  </tr>

   <tr>

<td><b>Niveau de formation</b></td>

<td>

<?php

$req = mysql_query("SELECT * FROM prm_niv_formation where id_nfor = '".$offre['id_nfor']."'");

$niv = mysql_fetch_array($req);

echo ': '.$niv['formation'];

  ?>        

  </td>

  </tr>

  <!--

 <tr>



  <td><b>Secteur d'activité</b></td>



  <td>



  <?php 



   $select_sec = mysql_query("select FR from prm_sectors where id_sect = '".$offre['id_sect']."'");



   $secteur = mysql_fetch_array($select_sec);



   echo ': '.$secteur['FR'];



  ?>



  </td>



  </tr>

  -->

  <tr>



  <td><b>Fonction</b></td>



  <td>



  <?php 



   $select_sec = mysql_query("SELECT * FROM prm_fonctions where id_fonc = '".$offre['id_fonc']."'");



   $secteur = mysql_fetch_array($select_sec);



   echo ': '.$secteur['fonction'];



  ?>



  </td>



  </tr>



  <tr>



  <td><b>Région</b></td>



  <td>



  <?php



  $req = mysql_query("select localisation from prm_localisation where id_localisation = '".$offre['id_localisation']."'");



    $lieu = mysql_fetch_array($req);



    echo ': '.$lieu['localisation'];



  ?>        



  </td>



  </tr>



 



  <tr>



  <td><b>Date de publication</b></td>



  <td>



  <?php



    echo ': '.date("d / m / Y",strtotime($offre['date_insertion']));



  ?>        



  </td>



  </tr>

  <tr>



  <td><b>Date d’expiration</b></td>



  <td>



  <?php



    echo ': '.date("d / m / Y",strtotime($offre['date_expiration']));



  ?>        



  </td>



  </tr> 

  

  

  <tr>



    <td colspan="2"><div class="subscription" style="margin: 10px 0pt;">



          <h1>Description du poste</h1>



     </div></td>



  </tr>



  <tr>



    <td colspan="2"><?php echo stripslashes($offre['Details']); ?></td>



    </tr>



  <tr>



    <td colspan="2"><div class="subscription" style="margin: 10px 0pt;">



          <h1>Profils recherchés </h1>



     </div></td>



  </tr>



  <tr>



    <td colspan="2"><?php echo stripslashes($offre['Profil']); ?></td>



    </tr>



  <tr>



    <td colspan="2">



    </td>



    </tr>



</table>



      </div>

  

  <?php  

    } 

  ?>

      </div>

    </div>

 