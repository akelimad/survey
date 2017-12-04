

<br/>



     <h1> CV THEQUE </h1>

 <div class="texte">

<form action="./" method="post">



         <input name="email" id="email" type="hidden" />



     </form>

<?php

///////////////////////

if(isset($_POST["motcle"]) and $_POST["motcle"]!='')  $_SESSION["motcle"]=$_POST["motcle"];

if(isset($_POST["secteur"]) and $_POST["secteur"]!='')  $_SESSION["secteur"]=$_POST["secteur"];

if(isset($_POST["exp"]) and $_POST["exp"]!='')  $_SESSION["exp"]=$_POST["exp"];

if(isset($_POST["salaire"]) and $_POST["salaire"]!='')  $_SESSION["salaire"]=$_POST["salaire"]; 

if(isset($_POST["formation"]) and $_POST["formation"]!='')  $_SESSION["formation"]=$_POST["formation"]; 

if(isset($_POST["fraicheur"]) and $_POST["fraicheur"]!='')  $_SESSION["fraicheur"]=$_POST["fraicheur"]; 

if(isset($_POST["etablissement"]) and $_POST["etablissement"]!='')  $_SESSION["etablissement"]=$_POST["etablissement"]; 

if(isset($_POST["dispo"]) and $_POST["dispo"]!='')  $_SESSION["dispo"]=$_POST["dispo"];

if(isset($_POST["situation"]) and $_POST["situation"]!='')  $_SESSION["situation"]=$_POST["situation"]; 

if(isset($_POST["type_formation"]) and $_POST["type_formation"]!='')  $_SESSION["type_formation"]=$_POST["type_formation"]; 

if(isset($_POST["pays"]) and $_POST["pays"]!='')  $_SESSION["pays"]=$_POST["pays"];

if(isset($_POST["ville"]) and $_POST["ville"]!='')  $_SESSION["ville"]=$_POST["ville"];  

if(isset($_POST["envoi"]) and $_POST["envoi"]!='')  $_SESSION["envoi"]=$_POST["envoi"];  

//------------------------------------------------------------------------------------------

if(isset($_POST["fonction"]) and $_POST["fonction"]!='')  $_SESSION["fonction"]=$_POST["fonction"];  

if(isset($_POST["age"]) and $_POST["age"]!='')  $_SESSION["age"]=$_POST["age"];  

if(isset($_POST["sexe"]) and $_POST["sexe"]!='')  $_SESSION["sexe"]=$_POST["sexe"];  

/////////////////////////////////////////////////////////////////////////////////////////////



    if (isset($_GET['idcvh'])) {

$idcv = $_GET['idcvh'];

$select_99 = mysql_query("SELECT * FROM historique_cvtheque where id_hit_cvtheq = '$idcv'");

$sa879 = mysql_fetch_array($select_99);

$saa879 = $sa879['motcle'];

$w1=$sa879['id_sect'];

$w2=$sa879['id_expe'];

$w3=$sa879['id_salr'];

$w4=$sa879['id_for'];

$w5=$sa879['id_etab'];

$w6=$sa879['id_dispo'];

$w7=$sa879['id_situ'];

$w8=$sa879['id_tfor'];

$w9=$sa879['id_pays'];

//$w10=$sa879['id_tfor'];

$fcv=$sa879['id_frai'];



$_SESSION['motcle'] = $saa879;

$_SESSION['secteur'] = $w1;

$_SESSION['exp'] = $w2;

$_SESSION['salaire'] = $w3;

$_SESSION['formation'] = $w4;

$_SESSION['fraicheur'] = $fcv;

$_SESSION['etablissement'] = $w5;

$_SESSION['dispo'] = $w6;

$_SESSION['situation'] = $w7;

$_SESSION['type_formation'] = $w8;

$_SESSION['pays'] = $w9;



     }

       if (isset($_POST['historique'])) {

        ?>

<meta http-equiv="refresh" content="0; url=./historique/">

        <?php

        //header('location:historique_des_requetes.php');

     }

     if (isset($_POST['actualiser'])) {



         $_SESSION['motcle'] = "";



         $_SESSION['fonction'] = "";



         $_SESSION['pays'] = "";



         $_SESSION['exp'] = "";



         $_SESSION['secteur'] = "";



         $_SESSION['fraicheur'] = "";



         $_SESSION['situation'] = "";



         $_SESSION['etablissement'] = "";



         $_SESSION['type_formation'] = "";



         $_SESSION['formation'] = "";



         $_SESSION['salaire'] = "";



         $_SESSION['dispo'] = "";



         $_SESSION['datecv'] = "";

         $_SESSION['ville'] = "";

		 //*************************

		    $_SESSION['age'] = "";

			$_SESSION['sexe'] = "";



     }

 

 



//*  

  

      if( isset($_POST['envoi_d'])){

	   

	  

		if(isset($_POST['id_list']) &&  !empty($_POST['dossier']))

		{

		

		

					$id_lists = isset($_POST['id_list'])  ? $_POST['id_list'] : "";

					$dossier      = isset($_POST['dossier'])  	? $_POST['dossier']    		 : "";

					

$id_list = explode(",", $id_lists);

foreach ($id_list as &$id_candidat) { 

					$req_sql = "SELECT * FROM dossier_candidat WHERE candidats_id = '$id_candidat' AND id_dossier = '$dossier'  ";

					$select  = mysql_query($req_sql);

					$count=0;

					while ($row = mysql_fetch_assoc($select)) {

							$count=$count+1;

						}

						

						if ($count > 0)

								{ 

									$msg_p = '<div id="repertoire0">'.

											 '<div id="fils">'.

											 '<div id="fade" style="background: #000; " ></div>'.

											 '<div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%;height:100px; overflow:auto" >'.

											 '<!--<div class="titleBar">  <a href="javascript:fermer()">  <a href="javascript:hideDiv0()" > <div class="close" style="cursor: pointer;">close</div> </a> </div>-->'.

											 '<div id="content" align="center" class="content" style=" height: 42px; "> '.

											 '<h3><p style=color:#CC0000>Candidate existe dans ce dossier</p> </h3>'.

											 '</div></div></div> </div> ';

									$msg_p .= ' <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '].'" /> '; 

							

									echo $msg_p;

								}

						if ($count == 0) 

								{	

								mysql_query("INSERT INTO dossier_candidat VALUES ('".safe($dossier)."','".safe($id_candidat)."')");

								

									$msg_p = '<div id="repertoire0">'.

											 '<div id="fils">'.

											 '<div id="fade" style="background: #000; " ></div>'.

											 '<div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%;height:100px; overflow:auto" >'.

											 '<!--<div class="titleBar">  <a href="javascript:fermer()">  <a href="javascript:hideDiv0()" > <div class="close" style="cursor: pointer;">close</div> </a> </div>-->'.

											 '<div id="content" align="center" class="content" style=" height: 42px; "> '.

											 '<h3><p style=color:#09B34D>Votre action a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s !</p> </h3>'.

											 '</div></div></div> </div> ';

									$msg_p .= ' <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '].'" /> '; 

							

									echo $msg_p;

							 

								}

}



						

								

					}

					

			else	 

									$msg_p = '<div id="repertoire0">'.

											 '<div id="fils">'.

											 '<div id="fade" style="background: #000; " ></div>'.

											 '<div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%;height:100px; overflow:auto" >'.

											 '<!--<div class="titleBar">  <a href="javascript:fermer()">  <a href="javascript:hideDiv0()" > <div class="close" style="cursor: pointer;">close</div> </a> </div>-->'.

											 '<div id="content" align="center" class="content" style=" height: 42px; "> '.

											 '<h3><p style=color:#CC0000>Le choix du dossier est obligatoire !</p> </h3>'.

											 '</div></div></div> </div> ';

									$msg_p .= ' <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '].'" /> '; 

							

									echo $msg_p;

		

	  }



       if(isset($_POST['select']) )  {



	   

    $affected = 0;



      if(isset($_POST['email_tt']) ){

    

	

$id_list='';

    $result_unique =  array_keys(array_flip($_POST['select'])); 

		for ($i = 0; $i < count($result_unique); $i++){	

				$c=($i == 0)? '' : ', ' ;

				$id_list .=$c.$result_unique[$i]; 

			} 

?>

          

   

                    <div id="repertoire0">

                    <div id="fils">

                     <div id="fade"></div>



        <div class="popup_block_dossier" style="width: 560px; z-index: 999; top: 10%; left: 25%;">

            <div class="titleBar_dossier">

                <div class="title_dossier">Formulaire d'affectation au dossier </div>

                <a href="./?a=2&b=24" id="fermer2">

                <div class="close_dossier" style="cursor: pointer;">close</div></a>

            </div>

            <div id="content_dossier" class="content_dossier" style="height: 100%;">

                <form action="" id="form_pop_dossier12" method="post">

                    <table border="0" cellspacing="0" cellpadding="2" align="center">

                        <tr>

                            <td colspan="2">

                                <div id="msg1"></div>

                            </td>

                        </tr>

                        <tr>

                            <td width="38%"><b>Id sélectionnés : </b><?php echo $id_list;  ?></td>

                            <td id="champ_email1"></td>

                            <td id="id_candidat1"><input type="hidden" name="id_list"  value="<?php echo $id_list;  ?>"/></td>

                        </tr>

                        <tr>

                            <td colspan="2">

                                <div class="subscription" style="margin: 10px 0pt;">

                                    <h1>Affectation au dossier  </h1>

                                </div>

                            </td>

                        </tr>                        

                        

                        <tr>

                            <td width="35%"><b>Nom du dossier  </b></td>

                            <td width="75%">

                                <select name="dossier" required>

                   <option value=""></option>

                  <?php     $req_ci = mysql_query( "SELECT * FROM dossier");        

                  while ( $ci = mysql_fetch_array( $req_ci ) ) {  

                  

                  $ds_nom = $ci['nom_dossier'];  $ds_id = $ci['id_dossier'];            

                  

                    echo '<option value="'.$ds_id.'">'.$ds_nom.'</option>'; 

                  }   

                  ?>

                  </select>

                            </td>

                        </tr>

                        <tr>

                            <td colspan="2">

                                <div class="ligneBleu"></div>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <input name="envoi_d" type="submit" class="espace_candidat"  value="Valider" style="width:170px" />

                            </td> 

                            <td>

                                <input name="" type="reset" class="espace_candidat"  style="width:170px"/>

                            </td>

                        </tr>           

                    </table>

                </form>

            </div>

        </div>



                  </div>

                  </div>



  <?php 

    }

    

     

 



  }

  

//*/



 



  

                            ?>

<div class="subscription" style="margin: 10px 0pt;">



                                <h1>Options de filtrage des CV </h1>



                            </div>



<form enctype="multipart/form-data" action="./?a=2&b=24" method="post">

<?php include('cvtheque_m_filtre.php'); ?>

</form>

        <?php



include('cvtheque_m_filtre_traitement.php');







$select =  mysql_query($selectString);

    

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



$sql_pagination=$selectString."  LIMIT " . $limitstart . ", " . $itemsParPage ." ";

 // echo $sql_pagination;

$select = mysql_query($sql_pagination);

















/*

echo $sql_pagination;

$select = mysql_query($selectString);



$count_candidats = mysql_query("SELECT count(*) as nbr from  candidats ");

$nbr_candidats_c = mysql_fetch_array($count_candidats);

*/

?>

<div class="subscription" style="margin: 10px 0pt;">

<h1>CV des candidats  <span class="badge"><?php echo $tpc; ?></span></h1>

</div>

<?php

include("./cvtheque_m_table.php");

   //Système de pagination







 ?>

         

         