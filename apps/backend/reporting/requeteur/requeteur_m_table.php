<?php

if($_SESSION["i_val_requet"]!='')    {

$req  =  mysql_query($query);

$tpc = mysql_num_rows($req);

?>

<div class="subscription" style="width:100%; margin: 10px 0pt;">

<h1>Nombre des candidatures : <span class="badge"><?php echo $tpc; ?></span></h1>

</div>

                       

<div class="b1" style="width:690px;">                      

<div id="visualization_de_candidatures_par_offre_detail" 

style="width: 915px; height: 300px;"></div>

</div>

<?php



/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];









                    

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



$sql_pagination=$query."   LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination





            ?>   

                             

                             

    

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" > 



    

<div style="float:right"><button class="espace_candidat" ><a href="#" id="myButtonControlID_txt"  role='button' style="color: #fff;">Exporté la table vers text</button></div>

<div style="float:right"><button class="espace_candidat" ><a href="#" id="myButtonControlID_csv"  role='button' style="color: #fff;">Exporté la table vers CSV</a></button></div>

 





<div style="float:right"><button class="espace_candidat" id="myButtonControlID_xsl">Exporté la table vers Excel</button></div><br><br/>





 

<div id="divTableDataHolder">   

<table width="100%" border="0" cellspacing="0" id="requeteur_table" class="tablesorter" style="background: none;"> 

<thead>

   <tr>

    <th width="2%"><b>N°</b></th>

    <th width="22%" ><b>Informations Candidats</b></th>

    <th  align="center" width="12%" ><b>Status </b></th> 

    <th  align="center" width="4%" ><b>Référence</b></th> 

    <th  align="center" width="15%" ><b>Titre de poste</b></th>

    <th  align="center" width="5%" ><b>Pertinence </b></th> 

    <th  align="center" width="10%" ><b>Date</b></th>



    

    



  </tr>



  </thead>



  <tbody>



  <?php

        $cc = mysql_num_rows($rst_pagination);

        //echo $cc;

        if($cc)

        { 

          $i=0;//$ii = 1;

          //$alter_class=1;

          //mysql_data_seek($rst_pagination,0);

          while($return = mysql_fetch_array($rst_pagination))

             {

                 //$ii == 1 ? $ii++ : $ii--;

                 $i++;

$is=$i+$limitstart;

          ?>  

  <tr >

    <td  width="2%"><center><b><?php echo $is; ?></b></center></td>

    <td width="20%">

    <?php

$req00_theme = mysql_query( "SELECT * FROM candidats 

  where candidats_id = '".$return['candidats_id']."'");

$data00 = mysql_fetch_array($req00_theme);



$date_naissance = str_replace('/', '-', $data00['date_n']);

$date_naissance_c = date('Y-m-d', strtotime($date_naissance));

$age_c = strtotime($date_naissance_c);

$newformat = date('Y-m-d',$age_c); 

$age = (time() - strtotime($newformat)) / 3600 / 24 / 365;

    ?>

<a class="info" href="<?php echo $urladmin; ?>/cv/?candid=<?php echo $data00['candidats_id']; ?>"  > 

        <?php 





        echo '<b>' . $data00['prenom'].'&nbsp;'.$data00['nom'].'   |  '.number_format($age,0).' ans </b> '; ?> 

            </a><br/> 

              

              <?php

          $select_exp = mysql_query("SELECT * from prm_pays 

            where id_pays = '" . $data00['id_pays'] . "' "); 

          $exp = mysql_fetch_array($select_exp); 

          echo $exp['pays'];

          

                  $result01 = mysql_query("SELECT * from prm_situation 

                    where id_situ = '".$data00['id_situ']."' ");

                    $row01 = mysql_fetch_row($result01);

                  $result02 = mysql_query("SELECT * from prm_niv_formation 

                    where id_nfor = '".$data00['id_nfor']."' ");

                    $row02 = mysql_fetch_row($result02);

                  $result03 = mysql_query("SELECT * from prm_type_formation 

                    where id_tfor = '".$data00['id_tfor']."' ");

                    $row03 = mysql_fetch_row($result03);

          ?> 

                  <br />

           <?php         echo $row01[1].' | '.$row02[1]; ?><br/> 

           

           

           </a>

    </td>

    <td align="center"><?php echo $return['status']; ?></td> 

    <td ><center><?php echo $return['reference']; ?></center></td>

    <td width="15%"><?php echo $return['Name']; ?></td>

<td>

        <?php 

            

            $ref_pertinence = mysql_query("SELECT * FROM prm_pertinence 

              WHERE ref_p = 'p' limit 0,1");

            $prm_p_candidat = mysql_fetch_array($ref_pertinence);



            $s_pertinence_sql = "SELECT * FROM pertinence_oc 

              WHERE candidats_id = '".$data00['candidats_id']."' 

              and id_offre = '".$return['id_offre']."' 

              and ref_p = 'p' limit 0,1";

            $q_pertinence_g = mysql_query($s_pertinence_sql);

            $s_pertinence_g = mysql_fetch_array($q_pertinence_g);

            

            $n_pertinence         =   ( empty($s_pertinence_g['total_p'])   )   ? 0 : $s_pertinence_g['total_p']          ;

            $r_n_pertinence       =     number_format($n_pertinence,0)  ;  



           $color='#000000';  

        if($r_n_pertinence == 100 ) {

            $color='#00B300';  }

        elseif($r_n_pertinence < 100 and $r_n_pertinence >= 40)  {

            $color='#CC5500'; }

        elseif($r_n_pertinence <  40 ){ 

            $color='#D50000'; }

    

        ?>

        <div style="float: right;margin:1px 20px 1px 0px ;">

          <a href="#" class="info">

          <div style="width: 15px; height: 15px; background: <?php echo $color; ?>;

           -moz-border-radius: 10px; -webkit-border-radius: 10px;  border-radius: 10px;"></div>

          <br/></a>

        </div>



    </td> 

    <td><b><?php echo $return['date_modification']; ?></b></td>

    

  </tr>



     <?php

         

         

         

         

        



     }

     

         

        ?>



    </tbody>



     </table> 

						

    <div class="pagination">

			

			<?php 	if( $cc>10  or $nbPages>1 ) { ?>

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



						<div class="ligneBleu" style="  float: left;" ></div>







    

</div> 

</form>



     <div style="float: right" >



     

      

     <input name="candidature" type="hidden" value="<?php //echo $candidature; ?>" />

 



     </div> 



  <br>



 

                        <br> 

     <?php  }   else  {  ?> 

        <tr class="sectiontableentry1">

        <td></td></td><td><td  align="center">Aucune candidature</td><td></td><td></td><td></td><td></td>

        </tr></tbody></table>        

     <?php }    ?>                  

     

                             

      <?php

      } else  {

      if($val_status!='')

        echo '<script> alert("Veuillez choisir une requête avant de valider!!"); </script>';

      }

      ?>                    

      

                            

                        </div>



<div class="ligneBleu"></div>

