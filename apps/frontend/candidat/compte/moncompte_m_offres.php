<tr>



            <td colspan="2" class="subscription"><h1>Offres correspondantes à votre profil </h1></td>



          </tr>



          <tr style="  background: #A6BFD3;">



          



            <td style="text-align:left;width:15%;"><center><b>Date</b></center></td>



            <td><b>Intitul&eacute; du poste</b></td>



          </tr>



          <?php 

          $today = date("Y-m-d"); 

          $selectionner = mysql_query("SELECT * from offre where id_sect = '".safe($reponse['id_sect'])."' And status = 'En cours' 

            AND offre.date_expiration >= '$today' 

            ORDER BY id_offre DESC LIMIT 0 , 5 ");

          $nbr = mysql_num_rows($selectionner);

          if ($nbr) { $ii = 1;

          while ($retour = mysql_fetch_array($selectionner)) {                                                                

              $detail = substr($retour['Details'], 0, 100);                                     

              $req_lieu = mysql_query("SELECT localisation FROM prm_localisation WHERE id_localisation = ".safe($retour['id_localisation']).""); 

              $lieu = mysql_fetch_array($req_lieu);                                        ?>



          <tr class="sectiontableentry<?php                            echo $ii;                            $ii == 1 ? $ii++ : $ii--;                                        ?>">



      



            <td style="text-align:left;width:430px;" valign="middle" >

            <b><?php echo date("d.m.Y", strtotime($retour['date_insertion'])); ?></b> </td>



            <td style="width:525px;"><?php echo '<a href="'.$urloffre.'/?id=' . $retour['id_offre'] . '">' . $retour['Name'] . '</a>'; ?>



              <?php                                                                         

                                                  // echo  '...';                                   

                                                               

                                                         ?>



            </td>



          </tr>



          <?php                                    }                                } else {                                    ?>



          <tr>



            <td colspan="3" class="sectiontableentry1">Aucune offre ne correspond à votre profil</td>



          </tr>



          <?php                                }                                ?>