<tr>



            <td colspan="4" class="subscription"><h1>Candidature spontanée </h1></td>



          </tr>



          <tr style="  background: #A6BFD3;">



            <td style="width:10%"><center><b>Date</b></center></td>



            <td style="width:35%"><b>Intitul&eacute; du poste</b></td>



            <td style="width:12%"><b>Etat</b></td>



            <td style="width:3%"><b>Supprimer</b></td>



          </tr>



          <?php                                

          $select_candidatures = mysql_query("SELECT * from candidature_spontanee where candidats_id = '".safe($_SESSION['abb_id_candidat'])."' ");                

                          $count = mysql_num_rows($select_candidatures);                               

                           if ($count) {  

                             $ii = 1;    $j = 1;  

                               while ($candidature = mysql_fetch_array($select_candidatures)) {      

                                                    $nom =   $nom_site;                                     ?>





          <tr class="sectiontableentry<?php  echo $ii;     $ii == 1 ? $ii++ : $ii--;    ?>">



            <td><center><b><?php echo date('d.m.Y', strtotime($candidature['date_cs'])); ?></b></center></td>



            <td>Candidature spontanée</td>



            <td>En cours</td>



            <td style="text-align:center"><form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formidspontanee" >



             <div>   <input name="id_candidature_spo" type="hidden" value="<?php echo $candidature['id_candidature']; ?>" /> </div>



                <?php echo '<a href="#" onclick="if(confirm(\'Etes-vous sûr de vouloir supprimer cette candidature?\')) formidspontanee.submit();">

                <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i></a>'; ?>



              </form>



            </td>



          </tr>



          <?php                                        $j++;                                    }                                }                                else {                                    echo '<tr class="sectiontableentry1"><td colspan="5">Aucune candidature enregistrée</td></tr>';                                }                                ?>