<div class='texte'>

      <br/>

      <h1>TRAITEMENT DES CANDIDATURES RECRUTÉ</h1>



        



<?php   



    if(isset($_POST['select']))



    {



        $affected = 0;



        if(isset($_POST['archive']))



        {



            for ($i = 0; $i < count($_POST["select"]); $i++)



            {   



                mysql_query("Update candidature SET status = 'Archivée' where id_candidature = '".$_POST["select"][$i]."'");



                $select = mysql_query("select id_candidat from candidature where id_candidature = '".$_POST["select"][$i]."'");



                $rows = mysql_fetch_array($select);



                $id_candidat = $rows['id_candidat'];



                $insert = mysql_query("INSERT INTO archive_cvs values ('".safe($id)."','".safe($id_candidat)."')");



                $affected += mysql_affected_rows();



            }



            if($affected >= 0)



                echo $affected.' Candidature(s) archivée(s).';



        }



        if(isset($_POST['delete']))     



        {



            $deleted = 0; $affected = 0;



            for ($i = 0; $i < count($_POST["select"]); $i++)



            {   



                $id_candidature = $_POST["select"][$i];



                $date_modification = date("Y-m-d H:i");



                $my_sql = mysql_query("SELECT status from candidature where id_candidature = '$id_candidature'");



                $test = mysql_fetch_array($my_sql);



                if($test['status'] == 'Cloturé')



                {



                mysql_query("DELETE from candidature where id_candidature = '$id_candidature'");



                $deleted += mysql_affected_rows();



                mysql_query("DELETE from historique where id_candidature = '$id_candidature'");             



                }



                else



                { 



                mysql_query("Update candidature SET status = 'Cloturé' where id_candidature = '$id_candidature'");



                mysql_query("INSERT INTO historique VALUES ('".safe($id_candidature)."','Non retenu','".safe($date_modification)."','')");



                $affected += mysql_affected_rows();



                }               



            }



            if($affected > 0)



                echo $affected.' Candidature(s) non retenue(s).';



            elseif($deleted > 0)



                echo $deleted.' Candidature(s) supprimée(s).';



        }



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



    ?>





            

           <?php

           

            

              echo '<table> <tr class="odd">

                  <td><b>Nombre des candidatures recruté : </b></td>';

                  if ($tpc)

          {echo '<td><span class="badge badge-success">'.$tpc.'</span></td>';}

          else{echo '<td><span class="badge badge-error">0</span></td>';}

          echo '</tr></table>';

             

              

           

           ?>

            

            

            <div class="subscription" style="margin: 10px 0pt;">



          <h1>Options de filtrage des CANDIDATURES RECRUTÉ </h1>

    

     </div>

            

            

            

            

            

            

            

            

   <?php          

            

   //**************************************** filtrage candiddature ***********************/         

       ?> 

         

            

            

            

            

               

          

            <?php

            

         

            if( ($candidature!="encours") || (($candidature=="encours")   and (isset($_GET['stat'])) and ($stat=="tel" || $stat=="transmis" || $stat=="rencontre"  || $stat=="entretien"  || $stat="recontact" || $stat=="retenus" || $stat=="recruter" )))  {   ?>

            

   

      

   <?php

   include("./traitement_candidature_recruter_m_filtre.php");

            }

   

   ?>

   



        

            

            

            

            

            

            

            

            





   <?php



    if(isset($_SESSION["query"]))



    {

            



        $query  =  $_SESSION["query"];  

                

                

        //$query = $query."  ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC  LIMIT ".$limitstart.",".$itemsParPage." ";

          $query = $query."  ORDER BY pertinence ";

                

                

               //  echo '<h1> '.$query.'</h1>';  DESC  LIMIT ".$limitstart.",".$itemsParPage."

                

               

                if(isset($_GET['tridate']) and  $_GET['tridate']=="ASC" )

            {

                

          //     echo '<h1> '.$query.'</h1><br/><br/><br/><br/><br/>';

                

            

                $query = str_replace("ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC", "ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' )  ASC ", $query);

           

                   

                

                

                

      //         echo '<h1> '.$query.'</h1>';

                

                }

                

                

                

                

                

                    if(isset($_GET['tri_titreposte']) and ( $_GET['tri_titreposte']=="ASC"  or  $_GET['tri_titreposte']=="DESC" )  )

            {

                        $tri_titre=$_GET['tri_titreposte'];

                        

                    $query = str_replace("ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' ) DESC", "ORDER BY offre.Name ".$tri_titre." ", $query);

                    $query = str_replace("ORDER BY STR_TO_DATE( replace( date_candidature, '/', '-' ) , '%d-%m-%Y' )  ASC ", "ORDER BY  offre.Name ".$tri_titre." ", $query);

                        

                        

                        

                    }

              

               

          



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

//echo $query;

    ?>

   

   

 















































 <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" >  

      <b> * Le point en couleur montre la pertinence de la candidature (<span style="color:#79796A"><a style="color:#00B300">Vert</a>: pertinence bonne, <a style="color:#CC5500;">Orange</a>: pertinence moyenne,  <a style="color:#CC0000">Rouge</a>: pertinence faible </b><b>).</b>

<?php 

include("./traitement_candidature_recruter_m_table.php");



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



        echo '<a href="'.$_SERVER['REQUEST_URI'].'?candidature=encours&stat=tel">'.$count_tel.'</a>';



    else



        echo $count_tel; 



    ?></td>



   <tr class="even">



    <td><b>Convocation entretien :</b></td>



    <td><?php 



    if($count_convocation)



        echo '<a href="'.$_SERVER['REQUEST_URI'].'?candidature=encours&stat=entretien">'.$count_convocation.'</a>';



    else



        echo $count_convocation; 



    ?></td>



    </tr>



    <tr class="odd">



    <td><b>Candidatures transmises :</b></td>



    <td><?php 



    if($count_transmis) 



        echo '<a href="'.$_SERVER['REQUEST_URI'].'?candidature=encours&stat=transmis">'.$count_transmis.'</a>'; 



    else



        echo $count_transmis;



    ?></td>



  </tr>



  <tr class="even">



    <td><b>A recontacter :</b></td>



    <td><?php 



    if($count_recontact)



        echo '<a href="'.$_SERVER['REQUEST_URI'].'?candidature=encours&stat=recontact">'.$count_recontact.'</a>'; 



    else



        echo $count_recontact;



    ?></td>



    </tr>



    <tr class="odd">



    <td><b>A rencontrer :</b></td>



    <td><?php 



    if($count_rencontre)



        echo '<a href="'.$_SERVER['REQUEST_URI'].'?candidature=encours&stat=rencontre">'.$count_rencontre.'</a>'; 



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



</div>