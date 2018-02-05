 



<div class="subscription" style="margin: 10px 0pt;">

            <h1>Historique des correspondances </h1>

        </div> 

		

<?php



        

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



$sql_pagination=$sql."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination





?>		

		

<table width="100%" border="0" cellspacing="0" id="histo_corr_table" class="tablesorter" style="background: none;">

    

      <thead>

        <tr>                    

        

          <th scope="col" width="19%" ><b>Nom</b></th>

          <th class="sorter-shortDate dateFormat-ddmmyyyy" width="14%" ><b>Date d’envoi</b></th>

          <th scope="col" width="25%" ><b>Titre message</b></th>

          <th scope="col" width="15%" ><b>Type d’envoi</b></th>

          <th scope="col" width="7%" ><b>Actions</b></th>

        </tr>

      </thead>

      <tbody> 

        <?php





$count = mysql_num_rows($rst_pagination);

if($count<1){

    echo  " <tr><td colspan='6'><center>Aucunes données trouvez</center></td></tr> ";}

else{



 $i=0;

          $trcolor='';

                $oddeven=1;$jj=0;

				$lien_page=$_SERVER['REQUEST_URI'];

          while( $reponse = mysql_fetch_array($rst_pagination)) {

           $i++;$jj=$jj+1;

                               // if($oddeven==1) {$oddeven=2;$trcolor='';}   else    {$oddeven=1;$trcolor='bgcolor="#DDDDDD"';   }   

                                if($reponse['titre']!='') $titre___1=$reponse['titre']; 

                                else $titre___1='';

                                $r_desc=''; 

                            //  echo '$titre___1'.$titre___1;

                                $r_desc =$titre___1;

                         

                if (is_numeric($r_desc)){

                $req_01 = mysql_query( "SELECT * FROM email_type where id_email=".$r_desc." ");                

                 $r01 = mysql_fetch_array( $req_01 );  

                 if($r01!='') { $r_desc = $r01['titre'].""; } 

                }

                 

                

            ?>          

        <tr  >



        

          <td valign="top" ><?php echo $reponse['nom']; ?></td>

          <td  ><?php echo ''.date("d / m / Y", strtotime($reponse['date_envoi'])).''; ?></td>

          <td valign="top" ><?php echo $reponse['sujet']; ?></td>

          <td valign="top" ><?php echo $reponse['type_email']; ?></td>

          

          

          <td style="border:1px solid #FFFFFF;" align="center">

                <div style=" float: left; padding-left: 5px; ">   

					<form method="post" action="<?php echo $lien_page; ?>"  name="formulaire<?php echo $jj+$i; ?>"> </form>				

                                                 

                    

                    <form method="post" action="<?php echo $lien_page; ?>"  name="formulaire<?php echo $jj; ?>">

                       <input type="hidden" name="id_view" value="<?php echo $reponse['id'] ?>" />                  

                       <a href="javascript:void(0)" onclick="formulaire<?php echo $jj; ?>.submit()" title="Ajouter" >

                       <input type="hidden"  id="view" name="ok"  value=""   title="Voir ce message" class="cu" />

                       

                       <i class="fa fa-search fa-fw fa-lg"></i></a>                                      

                    </form>

            </div>

            

                <a href="javascript:void(0)" onclick="if(confirm('Êtes-vous sûre de vouloir supprimer cette message?'))location.href='?action=delete&id=<?php echo $reponse['id'] ?>'">

                 <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i> 

                </a>

                

            



                    <div style="float: right">

                        <input name="select[]" id="select<?php echo $i; ?>" type="checkbox" value="<?php echo $reponse['id']; ?>" onclick="colorer('<?php echo $i; ?>')" <?php if(isset($_GET['id']) && ($reponse['id'] == $_GET['id'])) echo 'checked'; ?> />

                    </div>

                    

            </td>

        </tr>

         <?php

        }

    }

        

        ?>   

      </tbody>

    </table>

    <div >

        <img  style="float: right" class="selectallarrow" src="<?php echo $imgurl ?>/arrow_ltr_b.png" width="38" height="22"alt="Pour la sélection :">

      

    </div>

     <div style="float: right" >

  Pour la sélection : 

     <input   name="email_tt" class="espace_candidat" type="submit" value="Supprimer"    alt="à supprimer" />

     

     <input name="id" type="hidden" value="<?php //echo $reponse['id']; ?>" /> 

     </div>



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

						

			

			<br/>

    <div class="ligneBleu" style="  float: left;" ></div>  