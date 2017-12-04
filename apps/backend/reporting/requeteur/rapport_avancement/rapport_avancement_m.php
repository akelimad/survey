 





<div class='texte' style="  padding: 11px;  width: 95%;"><br/>



<?php



$query="SELECT o.Name as name,o.reference as reference,

o.id_offre as id_offre,o.date_insertion as date_insertion,

o.email as utilisateur,p.designation as type_poste

FROM offre o,prm_type_poste p

where o.id_tpost = p.id_tpost ".$q_offre_fili_and." ";

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

<h1>RAPPORT AVANCEMENT</h1>

<p></p> 



<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" > 

    

<div style="float:right"><button class="espace_candidat" ><a href="#" id="myButtonControlID_txt"  role='button' style="color: #fff;">Exporté la table vers text</button></div>

<div style="float:right"><button class="espace_candidat" ><a href="#" id="myButtonControlID_csv"  role='button' style="color: #fff;">Exporté la table vers CSV</a></button></div>

 



<div style="float:right"><button class="espace_candidat" 

id="myButtonControlID">Exporté la table vers Excel</button></div><br><br/>





 

 

  <?php include("rapport_avancement_m_table.php");?>

 

 

</form> 





  

      </div>

    </div>

  </div> 

  



 