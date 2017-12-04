<div id="imprime" style="display: none;">

   <div id="divTableDataHolder"> 

<table width="100%"  id="nouvelle_candidature_table" class="tablesorter" >

<thead>

    <tr>

        <th>Civilité</th>

        <th>Nom</th>

        <th>Prénom</th>

        <th>Adresse</th>

        <th>Ville</th>

        <th>Pays de résidence</th>

        <th>Date de naissance</th>

        <th>Nationalité</th>

        <th>Téléphone</th>

        <th>Situation actuelle</th>

        <th>Secteur souhaité</th>

        <th>Fonction</th>

        <th>Salaire souhaité en Dh</th>

        <th>Niveau de formation</th>

        <th>Type de formation</th>

        <th>Disponibilité</th>

        <th>Durée d'expérience</th>

        <?php if($_SESSION['r_prm_cin_candidat']==0){ ?> 

        <th>CIN</th>

        <?php } ?>

        <?php if($_SESSION['r_prm_region_off']==0){ ?>

        <th>ville d'affectation</th>

        <th>Région de l'offre</th>

        <?php } ?>

        <th>Réf de l'offre</th>

        <th>Nom de l'offre</th>

        <th>Status</th>

    </tr>

</thead>

<tbody>

    <?php //   $select

while($return = mysql_fetch_array($rst_pagination)){

include('traitement_candidatures_en_cours_m_table_traitement.php');

    ?>

    <tr>

        <td><?php echo $r_prm_civilite['civilite']; ?></td>

        <td><?php echo $r_candidats['nom']; ?></td>

        <td><?php echo $r_candidats['prenom']; ?></td>

        <td><?php echo $r_candidats['adresse']; ?></td>

        <td><?php echo $r_candidats['ville']; ?></td>

        <td><?php echo $r_prm_pays['pays']; ?></td>

        <td><?php echo $r_candidats['date_n']; ?></td>

        <td><?php echo $r_candidats['nationalite']; ?></td>

        <td><?php echo $r_candidats['tel1']; ?></td>

        <td><?php echo $r_prm_situation['situation']; ?></td>

        <td><?php echo $r_prm_sectors['FR']; ?></td>

        <td><?php echo $r_prm_fonction['fonction']; ?></td>

        <td><?php echo $r_prm_salaires['salaire']; ?></td>

        <td><?php echo $r_prm_niv_formation['formation']; ?></td>

        <td><?php echo $r_prm_formation['formation']; ?></td>

        <td><?php echo $r_prm_disponibilite['intitule']; ?></td>

        <td><?php echo $r_prm_experience['intitule']; ?></td>

        <?php if($_SESSION['r_prm_cin_candidat']==0){ ?>

        <td><?php echo $r_candidats['tel2']; ?></td>

        <?php } ?>

        <?php if($_SESSION['r_prm_region_off']==0){ ?>

        <td><?php echo $r_prm_region_ville['ville_region']; ?></td>

        <td><?php echo $r_prm_region['nom_region']; ?></td>

        <?php } ?>    

        <td><center><?php echo $r_offre['reference']; ?></center></td>

        <td><?php echo $r_offre['Name']; ?></td>

        <td><?php echo $s_r_historique['status']; ?></td>

    </tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

 







 



 



































