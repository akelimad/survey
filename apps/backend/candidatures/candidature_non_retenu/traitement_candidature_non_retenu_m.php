<div class='texte'>
<br/>
      <h1>TRAITEMENT DES CANDIDATURES NON RETENUES</h1>

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
/*
if(isset($_POST['envoyer_emails'])){
include("traitement_candidature_m_email_1.php");
} 
    if(isset($_POST['envoi']))

    {

            $id_candidature = isset($_POST['id_candidature'])  ? $_POST['id_candidature'] : "";

            $select  = mysql_query("select * from candidature where id_candidature = '$id_candidature'");

            $reponse = mysql_fetch_array($select);

            $commentaire = isset($_POST['commentaire']) ? trim($_POST['commentaire']): "";

            $status      = isset($_POST['status'])      ? $_POST['status']           : "";

            $date_modification = gmdate("Y-m-d H:i:s");

            if($status !='Non retenu')

                mysql_query("UPDATE candidature SET status = 'En cours' where id_candidature = '$id_candidature'");

            else

                mysql_query("UPDATE candidature SET status = 'Cloturé' where id_candidature = '$id_candidature'");

            $affected = mysql_affected_rows();

            mysql_query("INSERT INTO historique VALUES ('".safe($id_candidature)."','".safe($status)."','".safe($date_modification)."','".safe($commentaire)."')");

            if ($affected >= 0)

                echo '<h3>Commentaire ajouté avec succès</h3>';         

    }
*/
    ?>


            
           <?php
           
           
           // taha   aficher le nbr des nouvelles candidatures *****************************************************************/
           
           if($candidature!="encours" and $candidature!="refus" and $candidature!="spont")
           {
           
               $query_nbr=$_SESSION["query"];
               /*echo $query_nbr;*/
              $nombre_candidature=  mysql_query($query_nbr);

    $nbr_n_n_r =mysql_num_rows($nombre_candidature);
             echo '<table> <tr class="odd">
                  <td><b>Nombre des candidatures non retenues : </b></td>';
                  if ($nbr_n_n_r)
          {echo '<td><span class="badge badge-success">'.$nbr_n_n_r.'</span></td>';}
          else{echo '<td><span class="badge badge-error">0</span></td>';}
          echo '</tr></table>';
             
           }
           
           
           ?>
            
            
            <div class="subscription" style="margin: 10px 0pt;">

          <h1> Options de filtrage des candidatures non retenues</h1>
    
     </div>
            
            
            
            
            
            
            
            
   <?php          
            
   //**************************************** filtrage candiddature ***********************/         
       ?> 
         
            
            
            
            
               
          
            <?php
            
         
            if( ($candidature!="encours") || (($candidature=="encours")   
              and (isset($_GET['stat'])) and ($stat=="tel" || $stat=="transmis" 
            || $stat=="rencontre"  || $stat=="entretien"  || $stat="recontact" || $stat=="retenus" )))  {   ?>
            
   <?php       include ( "./traitement_candidature_non_retenu_m_filtre.php");?>

      
   <?php
   
            }
   
   ?>
   

        
            
            
            
            
            
            
            
            


   <?php

    if(isset($_SESSION["query"]))

    { 
            

        $query  =  $_SESSION["query"];  
                
                  $query = $query."  ORDER BY  LPAD(notation, 20, '0') desc ";
                
              //   echo '<h1> '.$query.'</h1>'; LIMIT ".$limitstart.",".$itemsParPage."
                
               
                if(isset($_GET['tridate']) and  $_GET['tridate']=="ASC" )
            {
                
          //     echo '<h1> '.$query.'</h1><br/><br/><br/><br/><br/>';
                
            
                $query = str_replace("ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC", "ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' )  ASC ", $query);
           
                   
                 
                
                }
                
                
                
                
                
                    if(isset($_GET['tri_titreposte']) and ( $_GET['tri_titreposte']=="ASC"  or  $_GET['tri_titreposte']=="DESC" )  )
            {
                        $tri_titre=$_GET['tri_titreposte'];
                        
                    $query = str_replace("ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC", "ORDER BY offre.Name ".$tri_titre." ", $query);
                    $query = str_replace("ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' )  ASC ", "ORDER BY  offre.Name ".$tri_titre." ", $query);
                        
                        
                        
                    }
               
/*echo $query;*/
        $req  =  mysql_query($query);
/* MAJ */
while($return_maj = mysql_fetch_array($req))
             {
$querymaj = mysql_query("SELECT * from notation_1 where id_candidature = '".$return_maj['id_candidature']."' "); 
$start = microtime(true);
if($data66 = mysql_fetch_array($querymaj)){
$sum_not = $data66['note_ecole'] + $data66['note_filiere'] + $data66['note_diplome'] + $data66['note_experience'] + $data66['note_stages'] ;    
 // mysql_query("UPDATE candidature SET notation='".safe($sum_not)."' where id_candidature = '".$return_maj['id_candidature']."' ");
}
/* */
$select_offre = mysql_query("SELECT * from offre where id_offre = '".safe($return_maj['id_offre'])."' limit 0,1");
$offre = mysql_fetch_assoc($select_offre);
/* */
$pertinence = mysql_query("SELECT *  FROM candidats  WHERE   candidats_id = '".$return_maj['candidats_id']."' limit 0,1");

$array = mysql_fetch_assoc($pertinence);
$percent_for = 0;
$percent_exp = 0;

if($array['id_nfor'] == $offre['id_nfor']) $percent_for = 60;
if($array['id_expe'] == $offre['id_expe']) $percent_exp = 40;
$percent = $percent_for +  $percent_exp;
 // mysql_query("UPDATE candidature SET pertinence='".safe($percent)."' where id_candidature = '".$return_maj['id_candidature']."' ");

/*echo "".$array['id_nfor'] ."== ".$offre['id_nfor']." <br/>";
echo "UPDATE candidature SET pertinence='".safe($percent)."' where id_candidature = '".$return_maj['id_candidature']."' <br/>";*/
/* */    
}             

   

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

    ?>
   
   



 



<?php       include ( "./traitement_candidature_non_retenu_m_table.php");?>


     <?php

  


    }

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