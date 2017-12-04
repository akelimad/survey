



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

                            

                                ?>          



                                    <tr <?php echo $trcolor; ?> onmouseover="this.className='marked'" onmouseout="this.className=''" >

                                    

                                        

                                        <td style="border:1px solid #FFFFFF;" align="center">

<a href="./?action=modifier&id=<?php echo $reponse['id_compagne'] ?>&titre_compagne=<?php echo $reponse['titre_compagne'] ?>" >

                                            <i class="fa fa-pencil-square-o fa-fw fa-lg"></i>

                                            </a>

                                            <a href="#" onclick="if(confirm('Êtes-vous sûre de vouloir supprimer ce dossier?'))location.href='?action=delete&id=<?php echo $reponse['id_compagne'] ?>'">

                                             <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

                                            </a>

                                        </td>

                                        <td align="center" style="border:1px solid #FFFFFF;">

                                            <?php echo $reponse['titre_compagne']; ?>

                                        </td>

                                        <td valign="top" style="border:1px solid #FFFFFF;">

            <center><?php 

$sql_test= "select * from per_filiale where  ref_filiale = '".$reponse['ref_filiale']."' ";

$requete_test= mysql_query($sql_test);

$result_test = mysql_fetch_array($requete_test);

$nom_filiale = $result_test['nom_filiale'];

            echo $nom_filiale; ?></center></td>





                                        <td align="center" style="border:1px solid #FFFFFF;">

                                         <?php                                                                  //id_compagnee

                                            $s_requ = "SELECT * from campagne_offres inner join

                                            offre on offre.id_offre = campagne_offres.id_offre where  id_compagne = '".$reponse['id_compagne']."' 

                                             ".$q_ref_fili_and." ";

                                            $select_encours = mysql_query($s_requ);

                                            $encours = mysql_num_rows($select_encours);

                                            if ($encours)

                                                echo '<a href="'.$urlad_offr.'/campagne_recrutement/liste_offre/?in_d='.$reponse['id_compagne'].'"> 

                                            <i class="fa fa-file fa-fw " style="color:#47A948;"></i> '.$encours .'</a>';

                                            else

                                                echo '<i class="fa fa-file fa-fw " ></i> '.$encours ;   

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