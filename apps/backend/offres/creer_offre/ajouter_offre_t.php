<?php







session_start();

if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../../login/"); 

}    



        require_once dirname(__FILE__) . "/../../../../config/config.php";

   

        $sql = mysql_query("select * from offre ");

        $cpt = mysql_num_rows($sql);

        

        $sql_roles = mysql_query("SELECT * FROM  root_roles where login = '".$_SESSION['abb_admin']."' ");

        $rep_roles = mysql_fetch_assoc($sql_roles);

        

 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];

 $_SESSION['link_bak_a']=1;

 $_SESSION['link_bak_b']=10;

 

 

//==============================================================================================================================  

 

  $id_offr_s=(isset($_POST['id_offr_s'])) ? $_POST['id_offr_s'] : '' ;

    



  $id__off=$id_offr_s ;

   

$id_secteur=$id_fonction=$id_formation=$id_exp=$id_poste=$id_lieu='';



if($id__off!='') {   

$option_id__off='';$v='';

	$sql__01="SELECT * from offre where id_offre=".$id__off." limit 0,1 ";

				   //echo '<br>test -- : '.$sql__01;

    $req_01 = mysql_query($sql__01);

    $r01 = mysql_fetch_array($req_01);

 

$r_name = $r01['Name'];$mobilite = $r01['mobilite'];$niveau = $r01['niveau_mobilite'];$taux = $r01['taux_mobilite'];

$r_details = $r01['Details']; $r_profil= $r01['Profil'];$r_date_expiration= $r01['date_expiration'];



$id_secteur= $r01['id_sect'];$id_fonction = $r01['id_fonc'];

$id_formation = $r01['id_nfor'];$id_exp = $r01['id_expe'];

$id_poste = $r01['id_tpost'];$id_lieu = $r01['id_localisation'];



	$sql__02="SELECT * from prm_sectors where id_sect=".$id_secteur." limit 0,1 "; 

				   //echo '<br>test -- : '.$sql__02;

    $req_02 = mysql_query($sql__02);

    $r02 = mysql_fetch_array($req_02);



$secteur= $r02['id_sect'];

				   //echo '<br>test -- : '.$secteur;



	$sql__03="SELECT * from prm_fonctions where id_fonc=".$id_fonction." limit 0,1 ";

				   //echo '<br>test -- : '.$sql__03;

    $req_03 = mysql_query($sql__03);

    $r03 = mysql_fetch_array($req_03);



$fonction= $r03['id_fonc'];

				   //echo '<br>test -- : '.$fonction;



	$sql__04="SELECT * from prm_niv_formation where id_nfor=".$id_formation." limit 0,1 ";

				   //echo '<br>test -- : '.$sql__04;

    $req_04 = mysql_query($sql__04);

    $r04 = mysql_fetch_array($req_04);



$formation= $r04['id_nfor'];

				   //echo '<br>test -- : '.$formation;

	

	$sql__05="SELECT * from prm_experience where id_expe=".$id_exp." limit 0,1 ";

				   //echo '<br>test -- : '.$sql__05;

    $req_05 = mysql_query($sql__05);

    $r05 = mysql_fetch_array($req_05);



$exp= $r05['id_expe'];

				   //echo '<br>test -- : '.$exp;

	

	$sql__06="SELECT * from prm_type_poste where id_tpost=".$id_poste." limit 0,1 ";

				   //echo '<br>test -- : '.$sql__06;

    $req_06 = mysql_query($sql__06);

    $r06 = mysql_fetch_array($req_06);



$poste= $r06['id_tpost'];

				   //echo '<br>test -- : '.$poste;

	

	$sql__07="SELECT * from prm_villes where id_vill=".$id_lieu." limit 0,1 ";

				   //echo '<br>test -- : '.$sql__07;

    $req_07 = mysql_query($sql__07);

    $r07 = mysql_fetch_array($req_07);



$lieu= $r07['id_vill']; 

				   //echo '<br>test -- : '.$lieu;





}

//==============================================================================================================================

 /*//////////////////////////////////////////////////////////////////////////////////////*/     



      $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;

      $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;    

 /*//////////////////////////////////////////////////////////////////////////////////////*/			

 

  $nom_page_site = "OFFRES || CREER DES OFFRES " ;

 

  

$ariane=" Offres > Créer une offre"; 

?>