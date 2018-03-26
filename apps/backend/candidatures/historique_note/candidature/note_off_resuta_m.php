 





<div class='texte' style="  padding: 11px;  width: 95%;">

        <br/><h1>HISTORIQUE DES NOTES</h1>

<?php

 $id_offre_M = isset($_GET['offre'])  ? $_GET['offre'] : "";

 

 

 $select_M = mysql_query("select * from offre where id_offre = '$id_offre_M'");

$reponse_M = mysql_fetch_array($select_M);



$candition_off =" ( candidats.id_sect=".$reponse_M['id_sect']." and  candidats.id_fonc=".$reponse_M['id_fonc']." and  candidats.id_nfor=".$reponse_M['id_nfor']." )   OR ( candidats.id_sect=".$reponse_M['id_sect']." and  candidats.id_fonc=".$reponse_M['id_fonc']." ) OR (candidats.id_fonc=".$reponse_M['id_fonc']." and  candidats.id_nfor=".$reponse_M['id_nfor'].") OR ( candidats.id_sect=".$reponse_M['id_sect']." and  candidats.id_nfor=".$reponse_M['id_nfor']." ) ";



$query_M="select * from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id   where ".$candition_off." group by candidats.candidats_id  ORDER BY    STR_TO_DATE( replace( candidature.date_candidature, '/', '-' ) , '%d-%m-%Y' ) ";

   //DESC LIMIT 0,10

 $nombre_candidature=  mysql_query($query_M);

 

 ?>

 

               

						

 <?php

 

 

 

 

$query="SELECT * 

FROM candidature

INNER JOIN offre ON offre.id_offre = candidature.id_offre 

WHERE offre.id_offre =".$reponse['id_offre']."   

GROUP BY candidature.id_candidature ";

     

	 //echo $query;

	 

        //$req  =  mysql_query($query);

      /////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];



$selects = mysql_query($query);



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



$sql_pagination=$query."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

       

        

  ?>

   

  

   

     

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" > 

  

    

<div style="float:right"><button class="espace_candidat" ><a href="javascript:void(0)" id="myButtonControlID_txt"  role='button' style="color: #fff;">Exporté la table vers text</button></div>

<div style="float:right"><button class="espace_candidat" ><a href="javascript:void(0)" id="myButtonControlID_csv"  role='button' style="color: #fff;">Exporté la table vers CSV</a></button></div>

 



<div style="float:right"><button class="espace_candidat"  id="myButtonControlID">Exporté la table vers Excel</button></div><br><br/>





 

 

  <?php  include("note_off_resuta_m_table.php");?>

  

  <?php //include("note_off_resuta_m_table_tst.php");?>

 

 

</form> 





  

      </div>

    </div>

  </div> 

  



 