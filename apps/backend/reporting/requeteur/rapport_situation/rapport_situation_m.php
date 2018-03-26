 





<div class='texte' style="  padding: 11px;  width: 95%;">



<?php

 

 $query="SELECT c.id_candidature, c.id_offre, c.candidats_id, c.date_candidature, o.Name FROM candidature c ,offre o where c.id_offre=o.id_offre and c.status<>'En attente'  ".$q_offre_fili_and." ORDER BY date_candidature DESC";

     

	 // echo $query;

	 

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

   

        <br/><h1>RAPPORT SITUATION</h1>

     

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" > 

    

<div style="float:right"><button class="espace_candidat" ><a href="javascript:void(0)" id="myButtonControlID_txt"  role='button' style="color: #fff;">Exporté la table vers text</button></div>

<div style="float:right"><button class="espace_candidat" ><a href="javascript:void(0)" id="myButtonControlID_csv"  role='button' style="color: #fff;">Exporté la table vers CSV</a></button></div>

 



<div style="float:right"><button class="espace_candidat" 

id="myButtonControlID">Exporté la table vers Excel</button></div><br><br/>





 

 

  <?php include("rapport_situation_m_table.php");?>

 

 

</form> 





  

      </div>

    </div>

  </div> 

  



 