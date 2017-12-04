



        

<?php

if (isset($_GET['a'])) $_SESSION['rad2']=''; 

if (isset($_POST['radio'])) $_SESSION['rad2']=$_POST['radio'];



    $ck0="checked";     $ck1="";            $ck2="";            $ck3="";            $ck4="";

if (isset($_SESSION['rad2'])) {

    if ($_SESSION['rad2'] == 'off_tous')     {    $ck0="checked";     $ck1="";            $ck2="";            $ck3="";            $ck4="";            }

    if ($_SESSION['rad2'] == 'off_cours')    {    $ck0="";            $ck1="checked";     $ck2="";            $ck3="";            $ck4="";            }

    if ($_SESSION['rad2'] == 'off_archiv')   {    $ck0="";            $ck1="";            $ck2="checked";     $ck3="";            $ck4="";            }

    if ($_SESSION['rad2'] == 'off_stages')   {    $ck0="";            $ck1="";            $ck2="";            $ck3="checked";     $ck4="";            }

    if ($_SESSION['rad2'] == 'off_echeance') {    $ck0="";            $ck1="";            $ck2="";            $ck3="";            $ck4="checked";     }

}

if (isset($_GET['r'])) {

    if ($_GET['r'] == 'c') {    $ck1="checked";     $ck2="";        $ck3="";        $ck4="";        }

    if ($_GET['r'] == 'a') {    $ck1="";        $ck2="checked";     $ck3="";        $ck4="";        }

    if ($_GET['r'] == 's') {    $ck1="";        $ck2="";        $ck3="checked";     $ck4="";        }

    if ($_GET['r'] == 'e') {    $ck1="";        $ck2="";        $ck3="";        $ck4="checked";     }

}

?>   

<form enctype="multipart/form-data" action="" method="post">   



<table>

<tr>

<td>

<input name="radio" type="radio" value="off_tous" <?php echo $ck0; ?> onchange="submit(this.form)"/>

 Tous:&nbsp;(<?php

$select_all = mysql_query("SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and  ( status = 'En cours' OR  status = 'Archivée')  ".$q_ref_fili_and." ");                         

$all = mysql_num_rows($select_all);

echo $all;?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

<td>

<input name="radio" type="radio" value="off_cours" <?php echo $ck1; ?> onchange="submit(this.form)"/>

 En cours:&nbsp;(<?php

$select_encours = mysql_query("SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and   status = 'En cours'  ".$q_ref_fili_and." ");

$encours = mysql_num_rows($select_encours);

echo $encours;?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

<td>

<input name="radio" type="radio" value="off_archiv"  <?php echo $ck2; ?> onchange="submit(this.form)"/>

 Archivées:&nbsp;(<?php

$select_archive = mysql_query("SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and   status = 'Archivée'  ".$q_ref_fili_and."  ");

$archive = mysql_num_rows($select_archive);

echo $archive;?>)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

 

<td>

<input name="radio" type="radio" value="off_echeance" <?php echo $ck4; ?> onchange="submit(this.form)"/>

 Arrivant à échéance dans moins de 7 jours:&nbsp;(<?php

$select_accept1 = mysql_query("SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and  (DATEDIFF(date_expiration,CURDATE())>0 And DATEDIFF(date_expiration,CURDATE())<7) ".$q_ref_fili_and." ");

$accept1 = mysql_num_rows($select_accept1);

echo $accept1;?>)</td>  

</tr>

</table>

</form>





<!--  ajout du tri à la table des offers  -->

        <table width="100%" border="0" cellspacing="0" id="matching_offres" class="tablesorter" style="background: none;">

    <thead>

          <tr>

           

             

            <th width="6%"  align="center"><b>Actions<b></th>

            <th width="4%"  align="center"><b>N°</b></th>

            <th width="14%"><center><b>Date de publication<b> </center></th>

        

            <th width="30%"><b>Titre<b></th>

            <th width="7%"><b>Réf<b></th>

            <th width="8%"><b>Etat<b></th>

            <th width="4%"><center><b>Vues<b></center></th>

            <th width="8%"><center><b>Candidatures<b></center></th> 

          </tr>

    </thead>

   <tbody>  

   

          <?php 





        

 

         

            if(isset($_GET['action']))

                $action = $_GET['action'];

            elseif(isset($_POST['action']))

                $action = $_POST['action'];

            else

                $action = '';

            if($action  == "encours")

                $sql = "SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and   status = 'En cours' ".$q_ref_fili_and."  ORDER BY date_insertion DESC";

            elseif($action == "archive")

                $sql = "SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and   status = 'Archivée' ".$q_ref_fili_and."  ORDER BY date_insertion DESC";

            else

                $sql = "SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  )   ".$q_ref_fili_and."   ORDER BY date_insertion DESC";

                

	// debut btn radio



	if (isset($_SESSION['rad2']) || isset($_GET['r'])) {

		if ($_SESSION['rad2'] == 'off_cours' || (isset($_GET['r']) and $_GET['r'] == 'c')) {

		$sql = "SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and   status = 'En cours' ".$q_ref_fili_and."  ORDER BY date_insertion DESC";



		}

		if ($_SESSION['rad2'] == 'off_archiv' || (isset($_GET['r']) and $_GET['r'] == 'a')) {

		$sql = "SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and   status = 'Archivée' ".$q_ref_fili_and."  ORDER BY date_insertion DESC";



		}

		if ($_SESSION['rad2'] == 'off_stages' || (isset($_GET['r']) and $_GET['r'] == 's')) {

		$sql = "SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and  id_tpost ='4'  ".$q_ref_fili_and."   ORDER BY date_insertion DESC";



		}

		if ($_SESSION['rad2'] == 'off_echeance' || (isset($_GET['r']) and $_GET['r'] == 'e')) {

		$sql = "SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and  ( DATEDIFF(date_expiration,CURDATE())>0  And DATEDIFF(date_expiration,CURDATE())<7 ) ".$q_ref_fili_and."   ORDER BY date_insertion DESC";



		}

	} 

	

	// fin btn radio   





/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];



$selects = mysql_query($sql);



$tpc = mysql_num_rows($selects);                     

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



	

            $rows = mysql_num_rows($rst_pagination);

            if($rows)

            {

                $ii=1;$j=0;$jj=0;$i=0;

                while($result = mysql_fetch_array($rst_pagination))

                {

                    $i++;

            $is=$i+$limitstart;

        ?>

          <tr   class="sectiontableentry<?php echo $ii; $ii == 1 ? $ii++ : $ii--; ?>" >

        

              

              

            

              <td valign="top" style="border:1px solid #FFFFFF;" >

                  <table width="100%" border="0" cellspacing="0" >

        <tr>

        <?php

		  /*$id_offre_M = $result['id_offre'];

            $select_M = mysql_query("SELECT * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and  id_offre = '$id_offre_M' ".$q_ref_fili_and." ");

            $reponse_M = mysql_fetch_array($select_M);

            $candition_off =" ( candidats.id_sect=".$reponse_M['id_sect']." and  candidats.id_fonc=".$reponse_M['id_fonc']." and  candidats.id_nfor=".$reponse_M['id_nfor']." )   OR ( candidats.id_sect=".$reponse_M['id_sect']." and  candidats.id_fonc=".$reponse_M['id_fonc']." ) OR (candidats.id_fonc=".$reponse_M['id_fonc']." and  candidats.id_nfor=".$reponse_M['id_nfor'].") OR ( candidats.id_sect=".$reponse_M['id_sect']." and  candidats.id_nfor=".$reponse_M['id_nfor']." ) ";

            $query_M="SELECT * from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id   where ".$candition_off." group by candidats.candidats_id  ORDER BY    STR_TO_DATE( replace( candidature.date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC LIMIT 0,10 ";

			$req  =  mysql_query($query_M);

			$cc_matching = mysql_num_rows($req);

			$info_entr = ($cc_matching>0) ? 'notation.png' : 'notation.png' ;

			$info_entr =   'notation.png' ;*/

		?>

        <tr>

        

        

            <td valign="top" width="20px" width="16%" style="border:0px solid #FFFFFF;">

            <form action="view_offres.php" method="post" name="formulaire<?php echo ++$jj; ?>">

                <input name="id" type="hidden" value="<?php echo $result['id_offre'];?>" />

                <input name="action_offre" type="hidden" value="view" />

                <input name="action" type="hidden" value="<?php echo $action;?>" />

                <a href="../../offres/consulter_offre/?offre=<?php echo $result['id_offre'] ?>" onclick="formulaire<?php echo $jj; ?>.submit()" title="Voir l’offre "> 

                <i class="fa fa-search fa-fw fa-lg"></i></a>&nbsp;  

             </form>

            </td>

            

        

            <td valign="top" width="20px" width="16%" style="border:1px ;">

            <form action="candidature/" method="post" name="formulaire<?php echo ++$jj; ?>">

                <input name="id" type="hidden" value="<?php echo $result['id_offre'];?>" />

                <input name="action_offre" type="hidden" value="view" />

                <input name="action" type="hidden" value="<?php echo $action;?>" />

                <a href="candidature/?offre=<?php echo $result['id_offre'] ?>" onclick="formulaire<?php echo $jj; ?>.submit()" 

                title="Notation des candidatures"> 

                <i class="fa fa-eyedropper fa-fw fa-lg" style="color: #1D9900;"></i></a>&nbsp;  

             </form>

            </td>

            

            

           



        </tr>

                  </table>

              </td>

              

            

              

              

              

              

            <td><span class="badge"><?php echo $is; ?></span></td>

            <td valign="top" style="border:1px solid #FFFFFF;">

<?php echo "<center><b>".date("d.m.Y",strtotime($result['date_insertion']))."</b></center>";?>

            </td>

        

        

        

        

            <td valign="top" style="border:1px solid #FFFFFF;">

            

            

            

            <?php ///////////////////////////////////////////////// ?>

            <table><tr>

            <td width="25%">           

				<?php echo $result['Name'];?>

			</td>

              

            <?php ///////////////////////////////////////////////// ?>

            </tr></table>

            </td>

            

            

            

            

            

            <td valign="top" style="border:1px solid #FFFFFF;"><?php echo $result['reference']; ?></td>

            <td valign="top" style="border:1px solid #FFFFFF;"><?php 

          if($result['status'] == 'En cours') 

            echo '<font style="color:#009900 ;" >'.$result['status'].'</font>';

          else

            echo '<font style="color:#FF0000 ;">'.$result['status'].'</font>';

          ?>

            </td>

            <td align="center" valign="top" style="border:1px solid #FFFFFF;"><?php if(empty($result['vue'])) echo 0; else echo "<b>".$result['vue']."</b>";?></td>

            <td align="center" valign="top" style="border:1px solid #FFFFFF;"><?php 

			

 

$query="SELECT * 

FROM candidature

INNER JOIN offre ON offre.id_offre = candidature.id_offre

INNER JOIN notation_1 ON notation_1.id_candidature = candidature.id_candidature

WHERE offre.id_offre =".$result['id_offre']."   

GROUP BY candidature.id_candidature ";



          $select_candidature = mysql_query( $query );

$select_candidature1 = $select_candidature;

          $count = mysql_num_rows($select_candidature);

          if($count)

          {

          echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post" name="form'.$j.'">'; 

          ?>

          <b><?php echo $count; ?></b>

          <?php

          echo '</form>';

          }

          else

          echo '0';

          ?>

            </td> 

          </tr>

          <?php

            $j++;

                          

                }

            }

            else

            {

        ?>

          <tr>

            <td colspan="11" align="center" class="sectiontableentry2" style="border:1px solid #FFFFFF;"> Aucune offre disponible</td>

          </tr>

          <?php

            }

            ?>

</tbody>

        </table>

        

    <div class="pagination">

       

      <?php   if( $rows>10  or $nbPages>1 ) { ?>

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

      <?php   } ?>

           

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







        

        <?php 

        if(isset($action_offre) and $action_offre == 'relancer')

                    {

                                $id_offre = isset($_POST['id'])  ? $_POST['id'] : "";

            $select = mysql_query("select * FROM offre WHERE id_offre IN ( SELECT   id_offre   FROM   candidature  GROUP BY  id_offre  ) and  id_offre = '$id_offre' ".$q_ref_fili_and." ");

            $reponse = mysql_fetch_array($select);

        ?>

        

         

    <div class="subscription" style="margin: 10px 0pt;">

                  <h1>Personnalisation du message envoyé aux candidats postulant</h1>

                </div>    <form method="post" action="<?php echo($_SERVER['REQUEST_URI']); ?>">

         <table>

            <tr>

              <td width="25%">Intitulé de l'offre <font style="color:#FF0000 ;">*</font></td>

              <td width="75%"><?php echo '<input type="text" name="intitule" style="width:534px" value="'.$reponse['Name'].'" readonly="readonly"/>'; ?>

                <input name="id_offre" type="hidden" value="<?php echo $id_offre; ?>" />

              </td>

            </tr>

            <tr>

              <td width="25%">Date de publication </td>

              <td width="75%"><span style="color:#000000;font-weight:normal"><?php echo $reponse['date_insertion']; ?></span></td>

            </tr>

         

         <tr>

             <td valign="top">Message personnalisé <font style="color:#FF0000 ;">*</font></td>

             

        <?php 

            $select1 = mysql_query("select * from message_offre where id_offre = '$id_offre'");

$reponse1 = mysql_fetch_array($select1);

            $a = mysql_num_rows($select1);

if($a)

$details=$reponse1['message'];

else

        $details="Bonjour,<br/>

Nous vous remercions d'avoir postuler à l'offre : ".$reponse['Name'].".<br/>

Sans réponse de notre part dans un délai de 30 jours, vous pourrez considérer que votre candidature n'a pas été retenue pour le poste demandé.

Cordialement." ;

?>

              <td><textarea name="message" id="editor1"><?php echo stripslashes($details); ?></textarea>

                <script type="text/javascript">

                CKEDITOR.replace( 'editor1',

                {

                enterMode : CKEDITOR.ENTER_DIV,

                entities: false,

                entities_additional : '',

                toolbar : 'Basic',

                resize_enabled : false

                });

            </script>

              </td>

        </tr>

        <tr>

        <td>

        </td>

        <td>

        <input name="envoimessage" type="submit" value="Valider" style="width:100px" />

                  <input name="reset" type="reset" style="width:100px"/>

               </td>

        </tr>

        </table>

        <?php

            }  ?>

			

			</form>

			

			



