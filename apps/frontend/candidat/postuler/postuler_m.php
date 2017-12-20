<?php



?>

<br/>

<h1  style=' text-transform: uppercase;'>Répondre à l'offre : <b><?php echo "".$offres['Name'].""; ?></b></h1>

<div class="ligneBleu"></div>

<!-- -->

      <div class='texte'>

        <?php

if(!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "")

      { 

      

        $_SESSION["url"] = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];   

		

	echo "<div  class='alert alert-error'><ul><li style='color:#FF0000'>Vous n’été pas encore connecte à votre espace candidats</li></ul></div>";    

    echo '<meta http-equiv="refresh" content="0;URL=../">';

?>



<!--

        <table width="100%" border="0">

          <tr>

            <td><div class="subscription" >

                <h1>Pour postuler à cette offre, vous devez être connecté à votre espace, et avoir créé votre CV</h1>

              </div></td>

          </tr>

          <tr>

            <td align="justify"><ul>

                <li>Si vous avez déjà créé votre compte, <a href="index.php">cliquez ici</a> pour vous connecter.</li>

                <li>Si vous n'avez pas encore créé votre compte, <a href="inscription.php">cliquez ici</a> pour le créer en quelques minutes.</li>

              </ul></td>

          </tr>

        </table>

-->

        <?php

      }

else

 {

 

 /////////////////////////////////////////////////////////////////////

     $id_candidat = $_SESSION['abb_id_candidat'];

    $select_formations = mysql_query("SELECT * from formations where candidats_id = '".safe($id_candidat)."' LIMIT 0 , 1");

    $formations = mysql_fetch_array($select_formations); 

    if(!($formations))  {



        $messagesf=array(); 

        array_push($messagesf,"<ul><li style='color:#FF0000'>Il faut avoir renseigné au moins une formation pour pouvoir pour postuler à une offre, <a href='../cv/' >Ne pas attendre.</li></ul>");

        ?>

        <?php foreach ($messagesf as $messagesf): ?>

            <div class="alert alert-error">

                <?php echo $messagesf; ?>

            </div>

        <?php endforeach; ?>

        <!--<meta http-equiv="refresh" content="10;URL=fiche_profil.php">-->

        <?php

   }   else    {

   

 /////////////////////////////////////////////////////////////////////

 

         if(isset($_POST['send']))

     {

        $id_offre   = isset($_POST['id_offre'])   ? $_POST['id_offre']         : "";

        $motivation = isset($_POST['motivation']) ? trim($_POST['motivation']) : "";

        $p_lieu = isset($_POST['lieu']) ? trim($_POST['lieu']) : "";

        $p_n_region = isset($_POST['n_region']) ? trim($_POST['n_region']) : "";

        

            //$motivation = $_POST['motivation'];

        $select_offre = mysql_query("SELECT * from offre where id_offre = '".safe($id_offre)."' ");

        $offre = mysql_fetch_array($select_offre);

        /*

        if(empty($motivation) )

        {

        $messageerr=array(); 

        array_push($messageerr,"<ul><li style='color:#FF0000'>Vous n'avez pas précisez Votre message pour ce poste !</li></ul>");

        ?>

        <?php foreach ($messageerr as $messageerr): ?>

            <div class="alert alert-error">

                <?php echo $messageerr; ?>

            </div>

        <?php endforeach; ?>

        

        <form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post">

           <?php include('postuler_m_form.php'); ?>

        </form>

        <?php

        }

        else

        {

        */





// calcule la pertinence

include('postuler_m_pertinence.php'); 



$req_civi1 = mysql_query( "SELECT * FROM prm_civilite 

    where id_civi = '".safe($array['id_civi'])."' ");       



$ncivi1 = mysql_fetch_array( $req_civi1 );

$civilite = $ncivi1['civilite'];    

                

$motivation1 =str_replace("'", "\'", $motivation);

        //  echo "INSERT INTO candidature VALUES ('','$id_candidat','$id_offre','".$motivation1."','$date','En attente','$percent','0')";

        if(isset($_POST['Letter']) && $_POST['Letter'] != "")

        $id_lettre= $_POST['Letter'];

        else

        $id_lettre= '0';

                if(isset($_POST['cv']) && $_POST['cv'] != "")

        $id_cv= $_POST['cv'];

        else

        $id_cv= '0';

            $date = date('Y-m-d'); 

            /*$insertion = mysql_query("INSERT INTO candidature VALUES ('','".safe($id_candidat)."', '".safe($id_cv)."', '".safe($id_lettre)."','".safe($id_offre)."','".safe($motivation1)."','".safe($date)."','0', '".safe($r_note_finale)."','' )");*/

            $insertion = getDB()->create('candidature', [
                'candidats_id' => $id_candidat,
                'id_cv' => $id_cv,
                'id_lettre' => $id_lettre,
                'id_offre' => $id_offre,
                'lettre_motivation' => $motivation1,
                'date_candidature' => $date,
                'status' => 0,
                'pertinence' => $r_note_finale,
                'notation' => ''
            ]);



            $id_cd = mysql_insert_id(); 



$insertion_c_region=mysql_query("INSERT INTO candidature_region

 (`id_candidature`, `id_region`,`ville_region`) 

    VALUES ('".safe($id_cd)."','".safe($p_n_region)."','".safe($p_lieu)."')");



$insertion_historique=mysql_query("INSERT INTO historique

 (`id_candidature`, `status`, `date_modification`,`utilisateur`) 

    VALUES ('".safe($id_cd)."','En attente','".safe($date)."','".safe($email)."')");







            $succes = mysql_affected_rows();

           include ( "./postuler_m_note.php"); 

            if($succes > 0)

            {

                getDB()->update('candidats', 'candidats_id', $id_candidat, ['can_update_account'=>0]);

$messagesuc=array(); 

        array_push($messagesuc,"<ul><li style='color:#468847'>Votre candidature a bien été envoyée avec succès</li></ul>");

        ?>

        <?php foreach ($messagesuc as $messagesuc): ?>

            <div class="alert alert-success">

                <?php echo $messagesuc; ?>

            </div>

        <?php endforeach; ?>

        <?php       

include("./postuler_m_email_1.php");

//include("./postuler_m_email_2.php");

            }

            else

            {

                echo '<h3>Une erreur est survenue réessayer plus tard</h3>';

            }

            

$reception_candidature = mysql_query("SELECT * from offre where id_offre=".safe($id_offre)." and send_candidature='true'");

            $reception = mysql_num_rows($reception_candidature);

            $infos_offre = mysql_fetch_array($reception_candidature);

            if($reception > 0)

            {

  //include("./postuler_m_email_2.php");

  }

        /*}*/

     }

     else

     {

        if(isset($_GET['id_offre']) || isset($_POST['id_offre']))

        {       



        if(isset($_POST['id_offre']))

            $id_offre = $_POST['id_offre'];     

            if(isset($_GET['id_offre'] ))

        $id_offre = $_GET['id_offre'];

        $select_offre = mysql_query("SELECT * from offre where id_offre = '".safe($id_offre)."'");

        $exist = mysql_num_rows($select_offre);

        if($exist)

        {

            $offre = mysql_fetch_array($select_offre);

			

			/*

            $select = mysql_query("select * from candidats inner join experience_pro ON candidats.candidats_id = experience_pro.candidats_id   inner join cv ON candidats.candidats_id = cv.candidats_id where candidats.candidats_id = '".$_SESSION['abb_id_candidat']."' And cv.actif=1 ");

            $nbr = mysql_num_rows($select);

            if($nbr)

            {

			//*/

                $select_candidature = mysql_query("SELECT * from candidature where candidats_id = '".safe($_SESSION['abb_id_candidat'])."' 

                    and id_offre = '".safe($id_offre)."' ");

                $count = mysql_num_rows($select_candidature);

                if($count)

                {

        $messagess=array(); 

        array_push($messagess,"<ul><li style='color:#FF0000'>Vous avez déjà postulé à cette offre. Vous ne pouvez postuler qu'une seule fois. Vous allez être redirigé dans quelques secondes à votre compte, <a href='$urlcandidat/compte/' >Ne pas attendre.</li></ul>");

        ?>

        <?php foreach ($messagess as $messagess): ?>

            <div class="alert alert-error">

                <?php echo $messagess; ?>

            </div>

        <?php endforeach; ?>

        <?php

        //echo '<meta http-equiv="refresh" content="10;URL=fiche_profil.php">';

        

                }

                else

                {               

        

        ?>

        <form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post" onsubmit="return confirm('Etes vous sur ? après la confirmation vous ne pouvez plus editer vos informations.');">

          <?php include('postuler_m_form.php'); ?>

        </form>

        <?php

            } 

			/*

        }

        else // profil non complet

        {

        $_SESSION["url"] = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; 

        $messages=array(); 

        array_push($messages,"<ul><li style='color:#FF0000'>Vous n'avez pas la possibilité de répondre à cette offre car vous n'avez pas encore edité votre CV. Vous allez être redirigé dans quelques secondes, <a href='<?php echo $urlcandidat;?>/cv/' >Ne pas attendre.</li></ul>");

        ?>

        <?php foreach ($messages as $message): ?>

            <div class="alert alert-error">

                <?php echo $message; ?>

            </div>

        <?php endforeach; ?>

        <?php

       // echo '<meta http-equiv="refresh" content="10;URL=fiche_profil.php">';

        }

		//*/

       }

       else // l'id de l'offre est vide ou ne correspond à aucune offre

       {

        echo "<h1 style=' text-transform: uppercase;'>Répondre à l'offre : </h1>";

        echo "<h3>Erreur ! Aucune offre ne correspond à votre sélection!</h3>";  

       }        

      }

      else // variable id_offre inexistante

       {

        echo "<h1 style=' text-transform: uppercase;'>Répondre à l'offre : </h1>";

        echo "<h3>Erreur ! Aucune offre ne correspond à votre sélection!</h3>";   

       }

     }

}

}

      ?>

      </div>