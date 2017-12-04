 





<div class='texte' style="  padding: 11px;  width: 95%;"><br/>



					

 <?php



$query="SELECT c.nom as nom,c.prenom as prenom,

h.status as status,h.date_modification as date_modification,

o.Name as Name,h.utilisateur as utilisateur,h.commentaire as commentaire

FROM offre o,candidature cd,historique h,candidats c

where o.id_offre = cd.id_offre

and  cd.id_candidature = h.id_candidature 

and  c.candidats_id = cd.candidats_id  ".$q_offre_fili_and." 

and h.status <> 'en attente' and h.status <> 'Notation manuelle' and h.status <> 'Notation commission'";

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



<?php

include('../menu_requeteur.php');

?>    

<h1>RAPPORT ENTRETIEN</h1>

<p></p>    

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" > 

    

<div style="float:right"><button class="espace_candidat" ><a href="#" id="myButtonControlID_txt"  role='button' style="color: #fff;">Exporté la table vers text</button></div>

<div style="float:right"><button class="espace_candidat" ><a href="#" id="myButtonControlID_csv"  role='button' style="color: #fff;">Exporté la table vers CSV</a></button></div>

 



<div style="float:right"><button class="espace_candidat" 

id="myButtonControlID">Exporté la table vers Excel</button></div><br><br/>





 

 

  <?php include("rapport_entretien_m_table.php");?>

 

 

</form> 





  

      </div>

    </div>

  </div> 

  



 