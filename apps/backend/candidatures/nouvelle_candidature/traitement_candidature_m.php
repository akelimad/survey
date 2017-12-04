<div class='texte'>

<br/>

      <h1>TRAITEMENT DES NOUVELLES CANDIDATURES</h1>



<?php   

    if(isset($_POST['select']))

    {

    //include('traitement_candidature_m_emailall.php');

    }





$l= rand(4, 8);

function generateRandomString($length) {

        $r = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

        return $r; 

}

$n_f=generateRandomString($l);

//echo $n_f."<br>";



    ?>





<?php



              $query=$_SESSION["query"];

			  

			  

/////////////   debut pagination

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];



$select = mysql_query($query);

//echo $query;

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



$sql_pagination=$query."  LIMIT " . $limitstart . ", " . $itemsParPage ."";

//echo $sql_pagination;

$rst_pagination = mysql_query($sql_pagination);

 



/////////////   fin pagination



?>



            

           <?php

           

          //* 

           //     Afficher le nbr des nouvelles candidatures ***************************************************************** /

      

   



             echo '<table> <tr class="odd">

                  <td><b> Nombre des nouvelles candidaturess : </b></td>';

                  if ($tpc)

          {echo '<td><span class="badge badge-success">'.$tpc.'</span></td>';}

          else{echo '<td><span class="badge badge-error">0</span></td>';}

          echo '</tr></table>';

             

            

          //*/ 

           

           ?>

            

            

            <div class="subscription" style="margin: 10px 0pt;">



          <h1> Options de filtrage des nouvelles candidatures </h1>

    

     </div>

            

            

            

            

            

            

            

            

   <?php          

            

   //**************************************** filtrage candiddature ***********************/         

       ?> 

         

            

            

            

            

               

          

            <?php

 //*           

         

            if( ($candidature!="encours") || (($candidature=="encours")   

              and (isset($_GET['stat'])) and ($stat=="tel" || $stat=="transmis" 

            || $stat=="rencontre"  || $stat=="entretien"  || $stat="recontact" || $stat=="retenus" )))  {   ?>

            

   <?php        include ( "./traitement_candidature_m_filtre.php");?>



      

   <?php

   

            }

   //*/

   ?>

   



        

            

            

            

            

            

            

            

            





   <?php

//*

    if(isset($_SESSION["query"]))



    { 

            

//*

					$query  =  $_SESSION["query"];  

                

					$query = $query."  ORDER BY  LPAD(notation, 20, '0') desc ";

                

              

/*echo $query;*/

		

		

/* MAJ */



 ?>

   <script>



                                             //   LOAD  LISTE OFFRE



		$(document).ready(function() {

			

			 var data = 'MAJ=1';

         

            // ajax call

            $.ajax({

                type: "POST",

                url: "traitement_candidature_m_ajax.php",

                data: data, 

               success: function(html){}

            });  

			

		});

  </script>

  

  

 <?php



        $req  =  mysql_query($query);

		

		

    $j=0;

      



  while($rep = mysql_fetch_array($req))



     {

      



        $j++;



  ?>



  <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="form<?php echo $j;?>">



    <input name="id_candidature" type="hidden" value="<?php echo $rep['id_candidature']; ?>" />



    <input name="candidature" type="hidden" value="<?php echo $candidature; ?>" />



    <input name="stat" type="hidden" value="<?php echo $stat; ?>" />



  </form>



  <?php



    }

//*/

    ?>

   

   







 







<?php        include ( "./traitement_candidature_m_table.php");?>





     <?php



  





    }

/*

    else



    {







        



    ?>



<table border="0" class="tablesorter" style="width:70%">



<thead>



<tr>



<th>&Eacute;tat des candidatures</th>



<th>Total de candidatures</th>



</tr>



</thead>



<tbody>



  <tr class="odd">



    <td><b>Appel téléphonique :</b></td>



    <td><?php 



    if($count_tel)



        echo '<a href="traitement-candidats.php?candidature=encours&stat=tel">'.$count_tel.'</a>';



    else



        echo $count_tel; 



    ?></td>



   <tr class="even">



    <td><b>Convocation entretien :</b></td>



    <td><?php 



    if($count_convocation)



        echo '<a href="traitement-candidats.php?candidature=encours&stat=entretien">'.$count_convocation.'</a>';



    else



        echo $count_convocation; 



    ?></td>



    </tr>



    <tr class="odd">



    <td><b>Candidatures transmises :</b></td>



    <td><?php 



    if($count_transmis) 



        echo '<a href="traitement-candidats.php?candidature=encours&stat=transmis">'.$count_transmis.'</a>'; 



    else



        echo $count_transmis;



    ?></td>



  </tr>



  <tr class="even">



    <td><b>A recontacter :</b></td>



    <td><?php 



    if($count_recontact)



        echo '<a href="traitement-candidats.php?candidature=encours&stat=recontact">'.$count_recontact.'</a>'; 



    else



        echo $count_recontact;



    ?></td>



    </tr>



    <tr class="odd">



    <td><b>A rencontrer :</b></td>



    <td><?php 



    if($count_rencontre)



        echo '<a href="traitement-candidats.php?candidature=encours&stat=rencontre">'.$count_rencontre.'</a>'; 



    else



        echo $count_rencontre;



    ?></td>



    </tr> 

  </tbody>



</table>



        <br/>



    <?php



    }

//*/

            if(!isset($_POST['envoi']) && isset($_POST['id_candidature']))



            {



                $id_candidature = $_POST['id_candidature'];



                $select = mysql_query("select * from historique where id_candidature = '$id_candidature'");



                $reponse = mysql_fetch_array($select);



    







        



        $select_candidat = mysql_query("SELECT nom,prenom from candidats inner join candidature on candidats.candidats_id = candidature.candidats_id WHERE candidature.id_candidature = '$id_candidature'");



        $nomcomplet = mysql_fetch_array($select_candidat);



    ?>







      <?php



        }



     ?>



    </div>



</div></tr></tbody></table></div>