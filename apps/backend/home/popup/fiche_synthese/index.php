<?php  





  session_start();



if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../index.php");

}  

    



require(dirname(__FILE__).'/../../../../../config/config.php');

 



    if (isset($_GET['action']))

        $action = $_GET['action'];

    else

        $action = ""; 

		

 



  $nom_page_site = "NOTATION DE LA CANDIDATURE" ;

 

 

	

	$ariane="Accueil > Candidature > Notation de la candiadture  ";	

 

	

?>





<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>  







</head>

<body>



<!-- START CONTAINER -->

<div id="container">



<?php     include ( dirname(__FILE__) . $tempurl3 . "/header_admin.php");       ?>



<div id='gauche' > 

<?php

if (strpos($_SESSION['page_courant '],'offres') !== false) {

     include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_offres.php"); 

}elseif (strpos($_SESSION['page_courant '],'candidats') !== false) { 

     include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_candidats.php"); 

}elseif (strpos($_SESSION['page_courant '],'candidatures') !== false) {

     include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_candidature.php");  

}elseif (strpos($_SESSION['page_courant '],'backend') !== false) {

     include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_accueil.php");  

}







 

		$id_cnddtr = isset($_GET['id_cnddtr'])? $_GET['id_cnddtr'] : "";

		

        $query65 = mysql_query("SELECT candidats_id from candidature where id_candidature = '".$id_cnddtr."' limit 0,1 "); 

        $start = microtime(true);

        $data65 = mysql_fetch_array($query65);

		

		$id_candidat= $data65['candidats_id'];

        

        $query66 = mysql_query("SELECT * from notation_1 where id_candidature = '".$id_cnddtr."' limit 0,1 "); 

        $start = microtime(true);

        $data66 = mysql_fetch_array($query66);

        $sum_not1 = $data66['note_ecole'] + $data66['note_filiere'] + $data66['note_diplome'] 

        + $data66['note_experience'] + $data66['note_stages'] ;

		//$sum_not1 = number_format($sum_not1, 2, ',', ' ');

		

        $data67 = mysql_query("SELECT * from notation_2 where id_candidature = '".$id_cnddtr."'  limit 0,1 "); 

        $start = microtime(true);

        $data67 = mysql_fetch_array($data67);

        $sum_note2 = ($data67['note_qualif']*0.5) + ($data67['note_commun']*0.3) + ($data67['note_compor']*0.2)  ;

		

		//$sum_note2 = number_format($sum_note2, 2, ',', ' ');

		

        $sum_not = ($sum_not1*0.4)+($sum_note2*0.6) ;

		    

        $sum_not1_final = ($sum_not1 )* 0.4;

        $sum_not1_final1 = $sum_not1_final ;

		//$sum_not1_final1 = number_format($sum_not1_final1, 2, ',', ' ');

		

        $sum_note2_final = ( ( $sum_note2  * 2.5) * 0.6);

        $sum_note2_final1 = $sum_note2_final ;

		//$sum_note2_final1 = number_format($sum_note2_final1, 2, ',', ' ');

		

        $sum_ffinal = $sum_not1_final + $sum_note2_final;

        $sum_ffinal1 = $sum_ffinal ;

		//$sum_ffinal1 = number_format($sum_ffinal1, 2, ',', ' ');

		

		    /* */

        $req_candidat = mysql_query( "SELECT * FROM candidats where candidats_id = '".$id_candidat."'");

        $datacandidat = mysql_fetch_array($req_candidat);

		    

        $date_naissance = str_replace('/', '-', $datacandidat['date_n']);

        $date_naissance_c = date('Y-m-d', strtotime($date_naissance));

        $age_c = strtotime($date_naissance_c);

        $newformat = date('Y-m-d',$age_c); 

        $age = (time() - strtotime($newformat)) / 3600 / 24 / 365;



        $select_candid = mysql_query("select * from candidature where id_candidature = '".$id_cnddtr."'");

        $reponse_candidat = mysql_fetch_array($select_candid);

        $id_offre = $reponse_candidat['id_offre'];

        $select = mysql_query("select * from offre where id_offre = '$id_offre'");

        $reponse = mysql_fetch_array($select);

?> 







</div> 







<center>







<div id='content_d' style="width:720px;">  







			<div class='texte' style="width:825px;">

			

			



					<br/><br/><h1>Notation de la candiadture</h1>

					

						 <div class="subscription" style="margin: 10px 0pt;">  

                                    <div style=" float: left; margin: -2px 0px 0px 10px;">

                                     <a href="#"    title="Imprimer" onclick="PrintElem('#imprime');return false;" style=" border-bottom: none; ">

                                            <img src="<?php echo $imgurl ?>/icons/print.png" title="Imprimer"/> 

                                    </a>

                                    </div> 

                                    <div style=" float: right; margin: -5px 10px 0px 0px;">

                                     <a href="<?php echo $_SESSION['page_courant ']; ?>" style=" border-bottom: none; ">

                                            <img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>

                                    </a>

                                    </div> 

                            </div>



									 

					<div id="imprime">

					

					<div style="position:inherit;float:left; width:0px;">

                    <img src="<?php echo $imgurlban.$logo; ?>" title="LPEE" style="height: 60px;"/></div>

					

								

								<b style="font-size: 20px;"><center><?php echo $titre_site; ?></center></b>

								 <br/>

								<h1><center>FICHE DE SYNTHESE </center></h1>

								 <br/>

						<center><h1> Offre : <b> <?php echo ''.$reponse['Name'].''; ?> </b> </b></h1> </center>

							 

						   <div  class="subscription" style="margin: 10px 0pt;">

                                <h1>informations candidat </h1>

                              </div>

							

							<div style="display:inline-table;width:100%; ">

								<div style="display:inline-table;width:70%;float: left; ">

							<h4 style="padding: 3px;"><b>NOM & PRENOM DU CANDIDAT </b>: 

							<span style="font-weight: normal;font-size: 12px;text-transform: uppercase;"><?php echo $datacandidat['prenom']." ".$datacandidat['nom']; ?></span></h4>

						  </div>	

								<div style="display:inline-table;width:30%;float: right; ">

							<h4 style="padding: 3px;"><b>AGE </b>: 

							<span style="font-weight: normal;font-size: 12px;text-transform: uppercase;"><?php echo number_format($age,0)." ans "; ?></span></h4>



						  </div>		

								<div style="display:inline-table;width:70%;float: left; ">

							<h4 style="padding: 3px;"><b>PROFIL DU CANDIDAT </b>: 

							<span style="font-weight: normal;font-size: 12px;text-transform: uppercase;"><?php echo $datacandidat['titre']." "; ?></span></h4>

						  </div>

						  <div style="display:inline-table;width:30%;float: left; ">

							<h4 style="padding: 3px;"><b>EMAIL </b>: 

							<span style="font-weight: normal;font-size: 12px;"><?php echo $datacandidat['email']." "; ?></span></h4>

						  </div>

						 </div>

						    <div  class="subscription" style="margin: 10px 0pt;">

                                <h1>Critére de notation </h1>

                              </div>

						  <table width="100%" style="  border-collapse: collapse;">

							<thead>

							  <tr>

								<td colspan="3" style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

								<b><center >CRITERES</center></b>

								</td>

								<td colspan="1" style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

								<b><center >NIVEAUX</center></b>

								</td>

							  </tr>

							</thead>

							<tbody>

							  <tr>

								<td width="30%" style="border: 1px solid #ccc;text-align: left;">

								  <b>FORMATION</b>

								</td>

								<td colspan="2" width="40%" style="border: 1px solid #ccc;text-align: left;">

								 Ecole <br/>

								  Filière <br/>

								 Année d’obtention du diplôme

								</td>

								<td width="10%" style="border: 1px solid #ccc;text-align: left;">

								 <center><?php echo $data66['note_ecole']; ?></center>

								 <center><?php echo $data66['note_filiere']; ?></center>

								 <center><?php echo $data66['note_diplome']; ?></center>

					 </td>

							  </tr>

							  <tr>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <b>EXPERIENCE CONFIRMEE</b>

								</td>

								<td colspan="2" style="border: 1px solid #ccc;text-align: left;">

								 Expérience probante <br/>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								<center><?php echo $data66['note_experience']; ?></center>

								</td>

							  </tr>

							   <tr>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <b>STAGES</b>

								</td>

								<td colspan="2" style="border: 1px solid #ccc;text-align: left;">

								  Stages probants  <br/>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <center><?php echo $data66['note_stages']; ?></center>

								</td>

							  </tr>

							  <tr>

								<td></td>

								<td></td> 

								<td  width="20%" style="border: 1px solid #ccc;text-align: left;background: #CFD4D8;;">

								<center><b>TOTAL N° 1</b></center>

								</td>

								

								<td style="border: 1px solid #ccc;text-align: left;">

								 <center><b><?php echo $sum_not1; ?></b></center>

								</td>

							  </tr>

							</tbody>

						  </table>

						

						<div  class="subscription" style="margin: 10px 0pt;">

                       <h1>Notation de commission</h1>

                       </div>

						<table width="100%" style="  border-collapse: collapse;">

						<thead>

							  <tr>

								<td  style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

								<b><center>APTITUDES</center></b>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

								<b><center>NOTES</center></b>

								</td>

								<td colspan="2" style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

								<b><center >COEFFICIENT</center></b>

								</td>

							  </tr>

							</thead>

							<tbody>

							   <tr>





								<td style="border: 1px solid #ccc;text-align: left;">

								  <b>Qualifications techniques</b>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								<center><?php echo $data67['note_qualif']; ?></center>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								 <center>50%</center> 

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <center><?php echo ($data67['note_qualif']*0.5);?></center>

								</td>

							  </tr>

							   <tr>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <b>Communication</b>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <center><?php echo $data67['note_commun']; ?></center>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <center>30% </center>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <center><?php echo ($data67['note_commun']*0.3);?></center>

								</td>

							  </tr>

							   <tr>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <b>Comportement</b>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <center><?php echo $data67['note_compor']; ?></center>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <center>20% </center>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								  <center><?php echo ($data67['note_compor']*0.2);?></center>

								</td>

							  </tr>

							  <tr>

								<td colspan="2"></td> 

								<td   style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;;">

								<center><b>TOTAL N° 2</b></center>

								</td>

								<td style="border: 1px solid #ccc;text-align: left;">

								 <center><b><?php echo $sum_note2; ?></b></center>

								</td>

							  </tr>

							</tbody> 

						  </table><br/>

						  <table width="100%" style="  border-collapse: collapse;">

							<thead>

          <tr>

            <td  style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;?>">

            <b><center>TOTAL</center></b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;?>">

            <b><center>NOTES</center></b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>COEFFICIENT</center></b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>Résultat</center></b>

            </td>

          </tr>

        </thead>

							<tbody>

							  <tr>

								<td  style="border: 1px solid #ccc;text-align: left;">

								  <b>TOTAL N°1</b>

								</td> 

								<td width="15%" style="border: 1px solid #ccc;text-align: left;">

								 <center><b><?php echo $sum_not1; ?></b></center>

								</td>

								<td width="45%" style="border: 1px solid #ccc;text-align: left;">

								 <center> ( TOTAL N°1 / 100 ) * 40 %</center>

								</td>

								<td width="15%" style="border: 1px solid #ccc;text-align: left;">

								 <center><?php echo $sum_not1_final1." % "; ?></center>

								</td>

								

							  </tr>

							  <tr>

								<td  style="border: 1px solid #ccc;text-align: left;">

								  <b>TOTAL N°2</b>

								</td> 

								<td style="border: 1px solid #ccc;text-align: left;">

								<center><b><?php echo $sum_note2; ?></b></center>

								</td>

								 <td style="border: 1px solid #ccc;text-align: left;">

								<center> ( TOTAL N°2 <b>/</b> 40 ) <b>*</b> 2.5 <b>=</b> resultat <b>*</b> 60%</center>

								</td>

								 <td style="border: 1px solid #ccc;text-align: left;">

								<center><?php echo $sum_note2_final1." % "; ?></center>

								</td>

							  </tr>



							  <tr>

								<td colspan="2"></td> 

								<td   style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

							   <center><b>TOTAL FINAL </b></center>

								</td>

								

								<td colspan="1" style="border: 1px solid #ccc;text-align: left;background:#C9E4FC">

								 <center><b><?php echo $sum_ffinal1." %"; ?></b></center>

								</td>

							  </tr>

							</tbody>

						  </table> 

						

									 

									 

										 



								<br/>

								<div style="  margin: 3px 0;width: 100%;height: 1px;font-size: 1px;line-height: 1px;background-color: #1B609C;"></div>

								 

					</div>					

					

					

			</div>

 </div>



</div>





</div>	  



</center>





<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_admin.php"); ?> 



<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_tmp_admin.php"); ?>



</body>

<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script> 

<script type="text/javascript">



    function PrintElem(elem)

    {

        Popup($(elem).html());

    }



    function Popup(data) 

    {

        var mywindow = window.open('', 'my div', 'height=400,width=600');

        mywindow.document.write('<html><head><title>Notation de candidature</title>');

		

        mywindow.document.write('</head><body >');

        mywindow.document.write(data);

        mywindow.document.write('<h3>COMMENTAIRE  </h3><p>...........................................................................................................................</p><p>............................................................................................................................</p></body></html>');



        mywindow.print();

        mywindow.close();



        return true;

    }



</script>

</html> 	  