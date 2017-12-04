<tr>



            <td colspan="4" class="subscription"><h1>Candidature pour stage </h1></td>



          </tr>



          <tr style="  background: #A6BFD3;">



            <td style="width:10%"><center><b>Date</b></center></td>



            <td style="width:35%"><b>Intitul&eacute; du poste</b></td>



            <td style="width:12%"><b>Etat</b></td>



            <td style="width:3%"><b>Supprimer</b></td>



          </tr>



          <?php                      

          $idcand= $_SESSION['abb_id_candidat'];          

          $select_candidatures = mysql_query("SELECT * from candidature_stage  where candidats_id='".safe($idcand)."' ");                

                          $count =mysql_num_rows($select_candidatures);  

                          $select_candidaturess = mysql_fetch_array($select_candidatures);

                          $date =  $select_candidaturess['date'];

        $var = array("/");

        $replace   = array(".");

        $new_msg = str_replace($var, $replace, $date);

                           if ($count) {  

                          

                                                                                    ?>





          <tr class="sectiontableentry1">



            <td><center><b> <?php echo $new_msg; ?></b></center></td>



            <td>Candidature pour stage</td>



            <td>En cours </td>



            <td style="text-align:center">





  <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formidstage" >



             <div>   <input name="remove_cand_stage" type="hidden" value="remove_cand_stage" /> </div>



                <?php echo '<a href="#" onclick="if(confirm(\'Etes-vous sûr de vouloir supprimer cette candidature?\')) formidstage.submit();"><i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i></a>'; ?>



              </form>

            </td>



          </tr>



          <?php

        }

  else



           {                                    echo '<tr class="sectiontableentry1"><td colspan="5">Aucune candidature enregistrée</td></tr>';                                }                                ?>