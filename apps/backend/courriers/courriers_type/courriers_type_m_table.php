 <?php

 



 

$sql = " select * from email_type  ";

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



$sql_pagination= " select * from email_type   LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination





 ?>





<table width="100%" border="0" cellspacing="0" id="corr_type_table" class="tablesorter" style="background: none;">





<thead>



                            <tr>

        

                                <th scope="col" width="30%" ><h2><b>Type email</b></h2></th> 

                                

                                <th scope="col" width="20%" ><h2><b>Expéditeur</b></h2></th>

                                

                                <th scope="col" width="30%" ><h2><b>Objet</b></h2></th>

                                

                                <th scope="col" width="4%" ><h2><b>P.J</b></h2></th>



                                <th width="4%"  ><h2><b>Actions</b></h2></th>







                        







                            </tr>



</thead>

<tbody>



                        <?php



$count = mysql_num_rows($select);

if($count<1){

    echo  " <tr><td colspan='5'><center>Aucunes données trouvez</center></td></tr> ";}

else{



                       

                        $trcolor='';

                        $oddeven=1;$jj=0;

                            while( $reponse = mysql_fetch_array($select)) {

                            

                                    $req_03 = mysql_query( "SELECT * FROM email_type 

                                        where id_email=".$reponse['id_email']." ");               

                                      if ( $r03 = mysql_fetch_array( $req_03 ) ) { $type=$r03['titre'];} 

                                      else {$type='';}   

                            

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

                                    

                                        <?php

                                        $phrase=$reponse['titre'];

                                        $org = array("spontane", "Reponse", "recu", " a " ); 

                                        $mod   = array("spontané", "Réponse", "reçu", " à " );

                                        $newphrase = str_replace($org, $mod, $phrase);

                                        

                                        ?>

                                        <td style="border:1px solid #FFFFFF;"><?php echo $type; ?></td> 

                                        

                                        <td style="border:1px solid #FFFFFF;"><?php echo $reponse['email']; ?></td>

                                        

                                        <td style="border:1px solid #FFFFFF;"><?php echo $reponse['objet']; ?></td>

                                        

                                        <td style="border:1px solid #FFFFFF;">

                                        <?php

                                        if($reponse['p_joint']!='')

                                        echo '<a href="'.$urladmin.'/down_c/?id='.$reponse['p_joint'].' " title="Voir piece joint"><i class="fa fa-file-text fa-lg"></i> </a>';

                                        ?>

                                        </td>

                                     



                                        <td style="border:1px solid #FFFFFF;" align="center">

                                        

                                        <div style=" float: left; padding-left: 5px; "> 

                                         

                                            <?php           

                                                        $message = str_replace("'", "", $reponse['message']);    

                                        ?>   </div>

                                        



                                        

                                        

                                        <div style=" float: left; padding-left: 5px; ">

                                       

                                        

                                        <form action="" method="POST" name="formulaire<?php echo ++$jj; ?>">

                                           <input type="hidden" name="id" value="<?php echo $reponse['id_email'] ?>" />

                                        <input type="hidden" name="type_cand" value="<?php echo $reponse['titre'] ?>" /> 

                                        <input type="hidden" name="expediteur" value="<?php echo $reponse['email'] ?>" />

                                        <input type="hidden" name="objet" value="<?php echo $reponse['objet'] ?>" />

                                        <input type="hidden" name="msg" value="<?php echo $reponse['message'] ?>" />

                                        <input type="hidden"  id="edit" name="ok"  value=""   title="Edit ce message" class="cu" /> 

                                        <a href="#" onclick="formulaire<?php echo $jj; ?>.submit()" title="Modifier" name="edit">

                                            <i class="fa fa-pencil-square-o fa-fw fa-lg"></i></a>&nbsp;

                                        </form>

                                        </div>

                                        

                                        

                                        <div style=" float: left; padding-left: 5px; "><a href="#" onclick="if(confirm('Êtes-vous sûre de vouloir supprimer ce message?'))location.href='?action=delete&id=<?php echo $reponse['id_email'] ?>'">

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

 

 