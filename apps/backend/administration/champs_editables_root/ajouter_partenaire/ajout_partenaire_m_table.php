 



 

<!DOCTYPE html>







<html xmlns="http://www.w3.org/1999/xhtml">







    <head>







   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script> 

<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery.tablesorter.min.js"></script>

<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery.tablesorter.pager.min.js"></script>





    </head>







    <body>

	



<div class="texte" style="width:720px">







                        <!--<h1>LISTES DES COMPTES</h1>-->

						  <div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Gestion des roles </h1>

                          </div>



                        







<?php









if (isset($_SESSION['msg']) and !empty($_SESSION['msg'])) {



   echo "<span class='success'>" . $_SESSION['msg'] . "</span>";



    unset($_SESSION['msg']);

}







if (isset($_SESSION['erreur']) and !empty($_SESSION['erreur'])) {







    echo "<span>Des Erreurs ont survenus</span>";



    foreach ($_SESSION['erreur'] as $er) {



        echo "<span class='erreur'>" . $er . "</span>";

    }



    echo "<br>";







    unset($_SESSION['erreur']);

}

                            



                            if (isset($_GET['id']) && !empty($_GET['id'])) {



                              $id = $_GET['id'];



                              if ($_GET['action'] == "delete") {



                                        if (mysql_query("delete from partenaire  where id_parte='$id'")) {

 

											

                                        } else {



                                            $_SESSION['erreur'] = "Une erreur est survenue lors de la suppression";

											

                                        }

										

							 echo '<script type="text/javascript">window.location="./";</script>';

							 

                                }





                             

                            }

							

                            









$sql = " select * from partenaire ";

$select = mysql_query($sql);





?>







<table width="100%" border="0" cellspacing="0" id="parten" class="tablesorter" style="background: none;">







<thead>



                            <tr>

		

                                <th scope="col" width="15%" style="background-color:#C1B3B0;color:white;"><strong>Type de partenaire</strong></th>

								

                                <th scope="col" width="10%" style="background-color:#C1B3B0;color:white;"><strong>Nom</strong></th>

								

                                <th scope="col" width="20%" style="background-color:#C1B3B0;color:white;"><strong>Email</strong></th>

								

								<th scope="col" width="35%" style="background-color:#C1B3B0;color:white;"><strong>Message</strong></th>



								<th width="4%"  style="background-color:#C1B3B0;color:white;"><strong>Actions</strong></th>







                        







                            </tr>



</thead>

<tbody>



                        <?php

                       

                        $trcolor='';

						$oddeven=1;

                            while( $reponse = mysql_fetch_array($select)) {

							

							$sql2 = " select * from prm_type_partenaire where id_tparte= '".$reponse['id_tparte']."' ";

							$select2 = mysql_query($sql2);

							$reponse2 = mysql_fetch_assoc($select2);

							$type_partenaire2 =$reponse2['type_partenaire'];

							





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

									

										

                                        <td style="border:1px solid #FFFFFF;"><?php echo $type_partenaire2; ?></td>

										

                                        <td style="border:1px solid #FFFFFF;"><?php echo $reponse['nom']; ?></td>

										

                                        <td style="border:1px solid #FFFFFF;"><?php echo $reponse['email']; ?></td>

										

                                        <td style="border:1px solid #FFFFFF;"><?php echo $reponse['message']; ?></td>

                                     



                                        <td style="border:1px solid #FFFFFF;" align="center">

										<a href="?action=modifier&id=<?php echo $reponse['id_parte'] ?>&nom=<?php echo $reponse['nom'] ?>&type_partenaire=<?php echo $reponse['id_tparte'] ?>&email=<?php echo $reponse['email'] ?>&message=<?php echo $reponse['message'] ?>&nom_r=<?php echo $reponse['nom_r'] ?>&tel_r=<?php echo $reponse['tel_r'] ?>" >

										<i class="fa fa-pencil-square-o fa-fw fa-lg"></i>

										</a>

										<a href="#" onclick="if(confirm('?es-vous s?re de vouloir supprimer ce profil?'))location.href='?action=delete&id=<?php echo $reponse['id_parte'] ?>'">

										<i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

										</a>

										</td>





                                    </tr>



 <?php

}

?>   



</tbody>



                        </table>

<!--

<div id="pager_archive">

        <form action="edit_champs.php" method="post">

          <img src="<?php echo $imgurl ?>/icons/first.png" class="first"/> 

          <img src="<?php echo $imgurl ?>/icons/prev.png" class="prev"/>

          <input type="text" class="pagedisplay" name="page"/>

          <img src="<?php echo $imgurl ?>/icons/next.png" class="next"/> 

          <img src="<?php echo $imgurl ?>/icons/last.png" class="last"/>

          <select class="pagesize">

            <option selected="selected"  value="10">10</option>

            <option value="20">20</option>

            <option value="30">30</option>

            <option  value="40">40</option>

          </select>

        </form>

    </div>

-->



                        </div>

 

  



  <script type="text/javascript">

    $(document).ready(function() { 

            $("#parten").tablesorter({headers: { 0: { sorter: false}, 3: {sorter: false}, 4: {sorter: false} } , widthFixed: true, widgets: ['zebra']});

           

            $("#parten").tablesorterPager({container: $("#pager_archive"),positionFixed: false <?php if (isset($page)) echo ', page:' . ($page - 1); ?>});

      $("#candidature").tablesorter({widthFixed: true, widgets: ['zebra']});

            $("#candidature").tablesorterPager({container: $("#pager"),positionFixed: false <?php if(isset($_POST['page'])) echo ', page:'.($_POST['page']-1);?>});

                    

                    });

  </script>		

  

</body>  

</html>