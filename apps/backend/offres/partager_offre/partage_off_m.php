<div class='texte' >

        <br/><h1>PARTAGER DES OFFRES</h1>

        <div class="subscription" style="margin: 10px 0pt; width:99.9%">

          <h1>Liste des offres </h1>

        </div>



  

<?php include("./partage_off_m_table.php");?>



<div class="ligneBleu"></div>

<?php

if(isset($action_offre ) and $action_offre == 'partager')

                    {

            $id_offre = isset($_POST['id'])  ? $_POST['id'] : "";

            $select = mysql_query("select * from offre where id_offre = '$id_offre'  ".$q_ref_fili_and."  ");

            $reponse = mysql_fetch_array($select);

            $select2 = mysql_query("select * from partenaire ");

 include("./partage_off_m_if_partage.php");

}    

        if(isset($_POST['envoi']))

        {

            $id_offre = isset($_POST['id_offre'])  ? $_POST['id_offre'] : "";

            $select = mysql_query("select * from offre where id_offre = '$id_offre'  ".$q_ref_fili_and."  ");

            $reponse = mysql_fetch_array($select);

            $intitule = isset($_POST['intitule'])  ? trim($_POST['intitule']): "";

            $fonction =   isset($_POST['fonction'])  ? $_POST['fonction']       : "";

            $secteur  = isset($_POST['secteur'])  ? $_POST['secteur']    : "";

            $details = isset($_POST['details'])  ? trim($_POST['details']): "";

            $profils = isset($_POST['profils'])  ? trim($_POST['profils']): "";

            $exp =   isset($_POST['exp'])  ? $_POST['exp']       : "";

            $formation =   isset($_POST['formation'])  ? $_POST['formation']       : "";

            $lieu =  isset($_POST['lieu'])  ? $_POST['lieu']       : "";

            $poste =  isset($_POST['poste'])  ? $_POST['poste']       : "";

            $mobilite= isset($_POST['mobilite'])? $_POST['mobilite']  : "non";

            $niveau  = isset($_POST['niveau'])  ? $_POST['niveau']       : "";

            $taux    = isset($_POST['taux'])    ? $_POST['taux']         : "";

            $nom      = isset($_POST['nom'])  ? trim($_POST['nom'])      : "";

            $tel = isset($_POST['tel'])  ? trim($_POST['tel'])           : "";

            $email = isset($_POST['email'])  ? trim($_POST['email'])     : "";

            $anonymat= true; 

            $send_candidature= isset($_POST['send_candidature'])? $_POST['send_candidature']     : "false"; 

            

           

           

        }

        else

        {

            if(isset($action_offre) && isset($id) && $action_offre != 'relancer')

            {

                $select = mysql_query("select * from offre where id_offre = '$id'  ".$q_ref_fili_and."  ");

                $reponse = mysql_fetch_array($select);

                if ($action_offre != 'archive' && $action_offre != 'desarchive')

                {



            }

         }

    }

    if(isset($_GET['ref']) || isset($_GET['offre']) || isset($_POST['select']))

    {



    if(isset($_GET['offre']) && !empty($_GET['offre'])      )

        $id_o = $_GET['offre'];

    else

        $id_o = $_GET['ref'];

    if(isset($_POST['archive']))

        {

            for ($i = 0; $i < count($_POST["select"]); $i++)

            {   

                mysql_query("Update candidature SET status = 'En cours' where id_candidature = '".$_POST["select"][$i]."'");

            }

        }

        if(isset($_POST['delete']))     

        {

            for ($i = 0; $i < count($_POST["select"]); $i++)

            {   

                $id_candidature = $_POST["select"][$i];

                $date_modification = date("Y-m-d H:i");

                $my_sql = mysql_query("SELECT status from candidature where id_candidature = '$id_candidature'");

                $test = mysql_fetch_array($my_sql);

                if($test['status'] == 'Cloturé')

                {

                mysql_query("DELETE from candidature where id_candidature = '$id_candidature'");

                mysql_query("DELETE from historique where id_candidature = '$id_candidature'");

                }

                else

                { 

                mysql_query("Update candidature SET status = 'Cloturé' where id_candidature = '$id_candidature'");

                mysql_query("INSERT INTO historique VALUES ('$id_candidature','Non retenu','$date_modification','')");

                }

            }

     

        }

     

      if(isset($_GET['offre']) )

      {

        $id_offre = $_GET['offre'];

       

          }  

     ?>

  

   

 <div class="haha">

 <?php

//include("./partage_off_m_if_view.php");   

    }

?>

</div> 



</div>