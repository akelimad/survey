 

	

	

<div class="texte" style="width:720px">

 

						  <div class="subscription" style="margin: 10px 0pt;">

                                   <h1>Gestion des courriers type </h1>

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



                                        if (mysql_query("delete from root_email_auto  where id_email='$id'")) {

 

											

                                        } else {



                                            $_SESSION['erreur'] = "Une erreur est survenue lors de la suppression";

											

                                        }

										 

							 

                                }





                             

                            }

							

                            







 



$sql = " select * from root_email_auto  ";



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



$sql_pagination=" select * from root_email_auto   LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination



?>









<table width="100%" border="0" cellspacing="0" id="corriers_type" class="tablesorter" style="background: none;">





<thead>



                            <tr>

		

                                <th scope="col" width="4%" style="background-color:#C1B3B0;padding: 5px 5px;color:white;"><strong>Ref</strong></th> 

		

                                <th scope="col" width="30%" style="background-color:#C1B3B0;padding: 5px 5px;color:white;"><strong>Type Email</strong></th> 

								

                                <th scope="col" width="20%" style="background-color:#C1B3B0;padding: 5px 5px;color:white;"><strong>Expéditeur</strong></th>

								

								<th scope="col" width="20%" style="background-color:#C1B3B0;padding: 5px 5px;color:white;"><strong>Objet</strong></th>

								

								<th scope="col" width="5%" style="background-color:#C1B3B0;padding: 5px 5px;color:white;"><strong>P.J</strong></th>



								<th width="4%"  style="background-color:#C1B3B0;padding: 5px 5px;color:white;"><strong>Actions</strong></th>







                        







                            </tr>



</thead>

<tbody>



                        <?php



$count = mysql_num_rows($rst_pagination);

if($count<1){

	echo  " <tr><td colspan='5'><center>Aucunes données trouvez</center></td></tr> ";}

else{



                       

                        //$trcolor='';		$oddeven=1;

						      $jj=0;

                            while( $reponse = mysql_fetch_array($rst_pagination)) {

							 

							

							//if($oddeven==1)	{	$oddeven=2;	$trcolor='';	}	else	{	$oddeven=1;	$trcolor='bgcolor="#DDDDDD"';	} < ? p h p echo $trcolor; ? >

							

                                ?>          



                                    <tr  onmouseover="this.className='marked'" onmouseout="this.className=''" >

									 

                                        <td style="border:1px solid #FFFFFF;"><?php echo $reponse['ref']; ?></td> 

									 

                                        <td style="border:1px solid #FFFFFF;"><?php echo $reponse['titre']; ?></td> 

										

                                        <td style="border:1px solid #FFFFFF;"><?php echo $reponse['email']; ?></td>

										

                                        <td style="border:1px solid #FFFFFF;"><?php echo $reponse['objet']; ?></td>

										

                                        <td style="border:1px solid #FFFFFF;">

										<?php

										if($reponse['p_joint']!='')

										echo '<a href="'.$urladmin.'/down_c.php?id='.$reponse['p_joint'].' " title="Voir le CV">

                                    <i class="fa fa-file-text fa-lg"></i> </a>';

										?>

										</td>

                                     



                                        <td style="border:1px solid #FFFFFF;" align="center">

										

										<div style=" float: left; padding-left: 5px; ">	

										 

											<?php			

														$message = str_replace("'", "", $reponse['message']);	 

										?>	 </div>

										



										

										

										<div style=" float: left; padding-left: 5px; ">

										

										<form method="post" action="" id="form2" name="formulaire<?php echo ++$jj; ?>">

										<input type="hidden" name="id" value="<?php echo $reponse['id_email'] ?>" />

                                        <input type="hidden" name="ref" value="<?php echo $reponse['ref'] ?>" /> 

										<input type="hidden" name="titre" value="<?php echo $reponse['titre'] ?>" /> 

										<input type="hidden" name="expediteur" value="<?php echo $reponse['email'] ?>" />

										<input type="hidden" name="objet" value="<?php echo $reponse['objet'] ?>" />

										<input type="hidden" name="msg" value="<?php echo $reponse['message'] ?>" />

										<input type="hidden"  id="edit" name="ok"  value=""   title="Edit ce message" class="cu" /> 

                                        <a href="#" onclick="formulaire<?php echo $jj; ?>.submit()" title="Ajouter" >

                                        <i class="fa fa-pencil-square-o fa-fw fa-lg"></i> </a>

										</form>

										</div>

										

										

										<div style=" float: left; padding-left: 5px; "><a href="#" onclick="if(confirm('Êtes-vous sûre de vouloir supprimer ce profil?'))location.href='./?action=delete&id=<?php echo $reponse['id_email'] ?>'">

										<i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

										</a></div>

										

										</td>





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

					?>

			</div>

    </div>

						

						



						<div class="ligneBleu" style="  float: left;" ></div>

						

		





                        </div>

						

		 