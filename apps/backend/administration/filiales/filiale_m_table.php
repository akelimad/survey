 

    <body>

	

	

<div class="texte" style="width:720px">



 

						  <div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Gestion des filiales </h1>

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

                        

                              

							 echo '<script type="text/javascript">window.location="'.$_SERVER['HTTP_REFERER'].'";</script>';



                                        if (mysql_query("delete from per_filiale  where id_filiale='$id'")) {



                                          //  $_SESSION['msg'] = "L'agent ou le responsable de communication est supprimé avec succès";

											

                                        } else {



                                            $_SESSION['erreur'] = "Une erreur est survenue lors de la suppression";

											

                                        }



                                     



                                  

                                

                                }





                             

                            }

							

                            









$sql = " select * from per_filiale ".$q_ref_fili." ";

$select = mysql_query($sql);







/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];





$tpc = mysql_num_rows($select);                     

$nbItems = $tpc;

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;

$nbPages = ceil ( $nbItems / $itemsParPage );

if (! isset ( $_GET ['idPage'] ))

$pageCourante = 1;        

elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)

$pageCourante = $_GET ['idPage'];

else

$pageCourante = 1;

// Calcul de la clause LIMIT

$limitstart = $pageCourante * $itemsParPage - $itemsParPage;

 //



$sql_pagination=" select * from per_filiale ".$q_ref_fili."   LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination



?>







<table width="100%" border="0" cellspacing="0" id="ajout_role" class="tablesorter" style="background: none;">







<thead>



                            <tr> 

                                <th scope="col" width="8%" ><b>Réf</b></th>

 

                                <th scope="col" width="20%" ><b>Nom</b></th>

                                <th scope="col" width="20%" ><b>Description</b></th>

 

                                <th scope="col" width="23%" ><b>Date de création</b></th>

								                <th scope="col" width="23%" ><b>Dernière modification</b></th>

 

                                <th scope="col" width="8%" ><b>Actions</b></th>



 

                            </tr>



</thead>

<tbody>



                        <?php





$count = mysql_num_rows($rst_pagination);

if($count<1){

	echo  " <tr><td colspan='5'><center>Aucunes données trouvez</center></td></tr> ";}

else{

                       

                        $trcolor='';

						$oddeven=1;$jj=0;

                            while( $reponse = mysql_fetch_array($rst_pagination)) {

							

							

						

							

							

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











                                        <td align="center" style="border:1px solid #FFFFFF;">

                                        <?php echo $reponse['ref_filiale']; ?></td>

                                        <td align="center" style="border:1px solid #FFFFFF;">

                                        <?php  echo $reponse['nom_filiale']; ?>     </td>

                                        <td align="center" style="border:1px solid #FFFFFF;">

                                        <?php  echo $reponse['description']; ?>     </td>





                                        <td align="center" style="border:1px solid #FFFFFF;">

                                        <?php echo date("d.m.Y", strtotime($reponse['date_creation'])); ?></td>





                                        <td align="center" style="border:1px solid #FFFFFF;">

                                        <?php echo date("d.m.Y", strtotime($reponse['date_modification'])); ?></td>

                                     





                                        <td style="border:1px solid #FFFFFF;" align="center"> 

										

											<div style=" float: left; padding-left: 5px; ">

										

									

                                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" name="formulaire<?php echo ++$jj; ?>">

                                            <input type="hidden" name="id_filiale" value="<?php echo $reponse['id_filiale'] ?>" />

                                            <input type="hidden" name="ref_filiale" value="<?php echo $reponse['ref_filiale'] ?>" />

                                            <input type="hidden" name="nom" value="<?php echo $reponse['nom_filiale'] ?>" />

                                            <input type="hidden" name="desc" value="<?php echo $reponse['description'] ?>" />

                                            <input type="hidden"  id="edit" name="edit"  value=""   title="Edit ce message" class="cu" /> 

                                            <a href="javascript:void(0)" onclick="formulaire<?php echo $jj; ?>.submit()" title="Modifier" name="edit">

                                            <i class="fa fa-pencil-square-o fa-fw "></i></a>&nbsp;

                                        </form>

											</div>

										<!--

										<a href="roleModif.php" title="Editer le role" rel0="<?php echo $reponse['id_role'];?>" rel1="<?php echo $reponse['login'];?>" rel2="<?php echo $type2;?>" rel3="<?php echo date("d-m-Y", strtotime($reponse['date_modification'])); ?>" rel4="<?php echo date("d-m-Y", strtotime($reponse['date_creation'])); ?>" class="email" id="email" ><img src="<?php echo $imgurl ?>/icons/edit.png" alt="Modifier ce profil" /></a> 

										-->

										<?php if($_SESSION['ref_filiale_role'] == '0') {?>

										<?php if($reponse['nom_filiale'] != $_SESSION['abb_admin']) {?>

										<a href="javascript:void(0)" onclick="if(confirm('Êtes-vous sûre de vouloir supprimer ce profil?'))location.href='?action=delete&id=<?php echo $reponse['id_filiale'] ?>'"><i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i></a>

										</td>

                    <?php }?>

                    <?php }?>

                    

                                    </tr>



 <?php

                       

}

}

?>   



</tbody>



                        </table>

												

    <div class="pagination">

			 

			<?php 	if( $count>10  or $nbPages>1 ) { ?>

			<div style="  float: left;" >

				<form id="frm" method='post' >

					<select onchange="this.form.submit()" name="t_p_g"  style="width: 50px; margin-right: 20px;" >

						<option value="10"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='10')  echo "selected"; ?> >10 </option>

						<option value="20"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='20')  echo "selected"; ?> >20 </option>

						<option value="30"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='30')  echo "selected"; ?> >30 </option>

						<option value="40"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='40')  echo "selected"; ?> >40 </option>

						<option value="50"  <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='50')  echo "selected"; ?> >50 </option>

						<option value="100" <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='100') echo "selected"; ?> >100</option>

			<option value="99999" <?php if(isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]=='99999') echo "selected"; ?> >Tous</option>	

					 </select>

				</form>

			</div>

			<?php 	} ?>

			

			<div id="">

					<?php       

					$lapage = '?';

					

					require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination2.php');

					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2 ); 

					 

					/* 

					$lapage = 'pages/'  ;

					require_once (dirname ( __FILE__ ) . $incurl2.'/class.pagination.php');

					 

					Pagination::affiche ( $lapage, 'idPage', $nbPages, $pageCourante, 2,$urladmin.'/accueil' );

			

					//*/

					?>

			</div>

    </div>

						

						<div class="ligneBleu" style="float: left;" ></div>

						

		





                        </div>

						

	 