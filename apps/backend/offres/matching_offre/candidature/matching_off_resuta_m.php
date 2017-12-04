<div class='texte' >
        <br/><h1>MATCHING DES OFFRES</h1>

 <div class="haha">
 <?php
 

    if( isset($_GET['offre'])  )
    {
		$ref_pertinence = mysql_query("SELECT min_p_a FROM prm_pertinence WHERE ref_p = 'm' limit 0,1");
        $prm_p_candidat = mysql_fetch_array($ref_pertinence);
		
		$query_M="	select candidats.candidats_id from candidats ,pertinence_oc 
				where  candidats.candidats_id=pertinence_oc.candidats_id 
        and  pertinence_oc.id_offre=".$id_offre." 
        and pertinence_oc.total_p>".$prm_p_candidat['min_p_a']."
        AND pertinence_oc.ref_p LIKE  'm'
				ORDER BY LPAD(pertinence_oc.total_p, 20, '0') DESC ";
 	  
//echo  "<br>".$query_M;
 
/////////////   debut pagination
if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

$select = mysql_query($query_M);

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

$sql_pagination=$query_M."  LIMIT " . $limitstart . ", " . $itemsParPage ."";
//echo $sql_pagination; 
 

/////////////   fin pagination

echo '<div style=" float: right; padding: 2px 5px 0px 0px;">
        <a href="../?p=ec" style=" border-bottom: none; ">
        <img src="'.$imgurl.'/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>
      </a>  </div>';
              echo '<div class="subscription" style="margin: 10px 0pt;">
          <h1>LA LISTE DES CANDIDATURES 
          <span class="badge">'.$tpc.'</span></h1>
          </div>  ';

  //--------------------------------------------------------- 
   
//echo "<br>". $sql_pagination;
    if(isset($sql_pagination))
    { 
        
        $req  =  mysql_query($sql_pagination);
        
  ?>
   
  
  
            
            
            

 
 
 
 
 
  <?php include("matching_off_resuta_m_table.php");?>
 
 
 
 
 <?php
    } 
	
 ?>
 
 </div>
 
 
        <?php
 
        
    }
 
     ?>
      </div>
    </div>
  </div> 
  

 