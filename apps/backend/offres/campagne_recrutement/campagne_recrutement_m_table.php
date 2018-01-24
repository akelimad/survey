



<table width="100%" border="0" cellspacing="0" id="dossier" class="tablesorter" style="background: none;">



<thead>

        <tr>

            <th width="10%"  ><center><b>Actions</b></center></th>

            <th width="35%"><center><b> Nom de campagne </b></center></th>

            <th width="20%"><center><b> Filiale </b></center></th>

            <th  width="35%" ><center><b>Nombre des offres par campagne de recrutement</b></h2></center></th>

        </tr>

</thead>

<tbody>



                        <?php

  $count = mysql_num_rows($select);

if($count<1){

    echo  ' <tr><td></td><td  ><div style="float:right;">Aucunes données trouvez</div></td><td></td><td></td></tr>';}

else{                     

                        $trcolor='';

                        $oddeven=1;

                            while( $reponse = mysql_fetch_array($select)) {

                            if($oddeven==1)

                            {

                            $oddeven=2;

                            $trcolor='';

                            }

                            else

                            {

                            $oddeven=1;

                            $trcolor='bgcolor="#DDDDDD"';

                            }

        
                            $count = getDB()->prepare("
                              SELECT COUNT(*) AS nbr,
                                SUM(case when (o.status='En cours' AND DATE(o.date_expiration) >= CURDATE()) then 1 else 0 end) encours,
                                SUM(case when (o.status='En cours' AND DATE(o.date_expiration) < CURDATE()) then 1 else 0 end) expire,
                                SUM(case when (o.status='Archivée') then 1 else 0 end) archive
                              FROM campagne_offres as c
                              JOIN offre as o ON o.id_offre=c.id_offre
                              WHERE c.id_compagne=?
                            ", [$reponse['id_compagne']], true);
                            ?>          



                                    <tr <?php echo $trcolor; ?> onmouseover="this.className='marked'" onmouseout="this.className=''" >

                                    

                                        

                                        <td style="border:1px solid #FFFFFF;" align="center">
<a title="Voir les offres" href="<?= site_url('backend/offres/campagne_recrutement/liste_offre/?in_d='.$reponse['id_compagne']) ?>"><i class="fa fa-eye fa-fw fa-lg"></i></a>


<a href="<?= site_url('backend/offres/campagne_recrutement/?action=modifier&id='. $reponse['id_compagne'] .'&titre_compagne='.$reponse['titre_compagne']) ?>" >

                                            <i class="fa fa-pencil-square-o fa-fw fa-lg"></i>

                                            </a>

                                            <a href="<?= site_url('backend/offres/campagne_recrutement/?action=delete&id='.$reponse['id_compagne']) ?>" onclick="confirm('Êtes-vous sûre de vouloir supprimer ce dossier?')">

                                             <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

                                            </a>

                                        </td>

                                        <td align="center" style="border:1px solid #FFFFFF;">

                                            <a href="<?= site_url('backend/offres/campagne_recrutement/liste_offre/?in_d='.$reponse['id_compagne']) ?>"><strong><?= $reponse['titre_compagne']; ?></strong></a>

                                        </td>

                                        <td valign="top" style="border:1px solid #FFFFFF;">

            <center><?php 

$sql_test= "select * from per_filiale where  ref_filiale = '".$reponse['ref_filiale']."' ";

$requete_test= mysql_query($sql_test);

$result_test = mysql_fetch_array($requete_test);

$nom_filiale = $result_test['nom_filiale'];

            echo $nom_filiale; ?></center></td>





                                        <td style="border:1px solid #FFFFFF;">
                                            <span class="label label-primary">Total: (<?= intval($count->nbr); ?>)</span>  
                                            <span class="label label-success">En cours: (<?= intval($count->encours); ?>)</span>  
                                            <span class="label label-warning">Expiré: (<?= intval($count->expire); ?>)</span>  
                                            <span class="label label-danger">Archivé: (<?= intval($count->archive); ?>)</span>  
                                         <?php                                                                  //id_compagnee

                                            /*$s_requ = "SELECT * from campagne_offres inner join

                                            offre on offre.id_offre = campagne_offres.id_offre where  id_compagne = '".$reponse['id_compagne']."' 

                                             ".$q_ref_fili_and." ";

                                            $select_encours = mysql_query($s_requ);

                                            $encours = mysql_num_rows($select_encours);

                                            if ($encours)

                                                echo '<a href="'.$urlad_offr.'/campagne_recrutement/liste_offre/?in_d='.$reponse['id_compagne'].'"> 

                                            <i class="fa fa-file fa-fw " style="color:#47A948;"></i> '.$encours .'</a>';

                                            else

                                                echo '<i class="fa fa-file fa-fw " ></i> '.$encours ; */  

                                                ?>

                                        </td>

                                        

                                    </tr>



 <?php

}

}

?>   



</tbody>



                        </table>

    <div class="pagination">

         <?php        

            $lapage = '?';

            

            require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination2.php');

            

            Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 );

            

            ?>

    </div>