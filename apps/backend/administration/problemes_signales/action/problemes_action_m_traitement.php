<?php



$query0 = "SELECT * FROM root_signale_probleme  WHERE  id_prob ='".$id_action."'  ";

$req0  =  mysql_query($query0);

$return0 = mysql_fetch_array($req0);

?>

<h1><?php echo $return0['sujet']; ?></h1>

<!-- -->

<div style="width:100%; display:inline-table;">

    <div class="subscription" style="margin: 10px 0pt;">

    <h1>Le probléme signalé : </h1>

    </div>



    <div style="width:25%; display:inline-table;">

        <p><b>Email</b></p>

        <p><b>Utilisateur</b></p>

        <p><b>Status</b></p>

    </div>

    <div style="width:25%; display:inline-table;">

        <p><b><?php echo $return0['email_visi']; ?></b></p>

        <p><b><?php echo $return0['type_user']; ?></b></p>

        <p>

            <?php 

            if($return0['etape'] =='0'){echo "<b style=\"color:red\">En attente</b>";}

            elseif($return0['etape'] =='1'){echo "<b style=\"color:#F4702B\">En traitement</b>";}

            elseif($return0['etape'] =='2'){echo "<b style=\"color:green\">Fermer</b>";}

            ?>

        </p>

    </div>

    <div style="width:25%; display:inline-table;">

        <p><b>Date envoi</b></p>

        <p><b>Sujet</b></p>

        <p><b>Message</b></p>

    </div>

    <div style="width:25%; display:inline-table;">

        <p><b><?php echo $return0['date_prob']; ?></b></p>

        <p><b><?php echo $return0['sujet']; ?></b></p>

        <p><b><?php echo couperChaine(strip_tags($return0['message']), 10, 10); ?></b>

            <a class="info1" href="#" onclick="return false">

                <i class="fa fa-external-link"></i>

                <span style="width:450px;padding:6px;word-wrap: break-word; "> 

                <b><?php echo $return0['message']; ?></b> 

                </span>

            </a>

        </p>

    </div>

</div>