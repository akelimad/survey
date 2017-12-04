 



 

<div class='texte' style="  padding: 11px;  width: 95%;"><br/>





<?php





$query="SELECT o.Name as name,o.id_offre as id_offre,o.date_insertion as date_insertion,

p.designation as type_poste

FROM offre o,prm_type_poste p

where o.id_tpost = p.id_tpost and o.id_offre='".$co."'  ".$q_offre_fili_and." ";

$rst_pagination = mysql_query($query);





$sql_candidatures88= "SELECT 

c.nom as nom,c.prenom as prenom,cd.id_offre as id_offre,

cd.status as status,cd.id_candidature as id_candidature

from candidature cd,candidats c

where c.candidats_id = cd.candidats_id

and cd.status !='en attente'

and cd.id_offre = '".$co."' 

ORDER by cd.status desc";

//echo $sql_candidatures;





if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];



$selects = mysql_query($sql_candidatures88);



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



$sql_pagination=$sql_candidatures88."  LIMIT " . $limitstart . ", " . $itemsParPage ."";



$query_candidature123 = mysql_query($sql_pagination);



             

?>

<?php

include('../menu_requeteur.php');

?>

<h1>RAPPORT OFFRE</h1>

<p></p>    

<table width="100%">

    <tr>

        <td align="right">

        <b>Choisissez une offre  :<span style="color:red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>

        </td>

        <td> 

            <form action="" method="post">

                <select name="co" id="co" style="width: 500px;" onchange="this.form.submit()" >

                <option value="" > </option>  

                <?php $req_theme = mysql_query( "SELECT DISTINCT o.Name,o.id_offre,o.reference 

												FROM offre o where o.id_offre in (select id_offre from candidature 

												where status != 'en attente')  ".$q_offre_fili_and."   ORDER by reference ASC  ");   

                while ( $data = mysql_fetch_array( $req_theme ) ) {       

                $id_offre = $data['id_offre'];

                $name = $data['Name'];

                ?>

                <option value="<?php echo $id_offre; ?>" <?php if (isset($co) and $co == $id_offre) echo ' selected="selected"'; ?>>

                <?php echo $name.""; ?></option>

                <?php

                } ?>  

                </select> 

            </form>

        </td>

    </tr>

</table> 

<?php if(isset($co) and  $co!="" ){    ?>

    

<div style="float:right"><button class="espace_candidat" ><a href="#" id="myButtonControlID_txt"  role='button' style="color: #fff;">Exporté la table vers text</button></div>

<div style="float:right"><button class="espace_candidat" ><a href="#" id="myButtonControlID_csv"  role='button' style="color: #fff;">Exporté la table vers CSV</a></button></div>

 

   

<div style="float:right"><button class="espace_candidat" 

id="myButtonControlID">Exporté la table vers Excel</button></div><br><br/>



		<?php include("rapport_offre_m_table.php");?>

  

<?php } ?>



  

      </div>

    </div>

  </div> 

  



 