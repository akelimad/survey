<?php

/*





$request = mysql_query("select * from offre where status = 'En cours' ORDER BY date_insertion DESC LIMIT 0 ,5");





$counoff = mysql_num_rows($request);



if($counoff<1)

    echo "<p style='font-size:11px;font-family:arial;text-align:justify;'><center>Aucune offre disponible</center></p>";   



if ($counoff) {



while ($data = mysql_fetch_array($request)) {



    echo '</b></span><a class="titre_offre" 

    href="' . $urloffre . '/index.php?id=' . $data['id_offre'] . '">' . $data['Name'] . ' | '. 

    date("d-m-Y",strtotime($data['date_insertion'])).'</a><br />';



    $description = $data['Details'];



    $apercu_description = substr(strip_tags($description), 0, 300);



    echo "<p style='font-size:11px;font-family:arial;text-align:justify;'>" . $apercu_description . "...</p>";



}



 

 echo '<div style=" background-color: white;width: 645px;height: 20px; "> <span class="csscaree csspuce"></span> <a href="' . $urloffre . '/index.php"><b>TOUTES LES OFFRES</b></a></div>' ;

 }

 */

?>





        <?php

      $request = mysql_query("SELECT * from offre inner join prm_fonctions on prm_fonctions.id_fonc = offre.id_fonc where status = 'En cours' and DATE(date_expiration) >= CURDATE() ORDER BY date_insertion DESC LIMIT 0 ,5");

      

            $ii = 1;

            

            while ( $retour = mysql_fetch_array ( $request ) ) 



            {

                

                $detail = substr ( $retour ['Details'], 0, 280 );

                $profil = substr ( $retour ['Profil'], 0, 280 );

                ?>





<h2>

<b><a style="color:<?php echo $color_bg;?>;" href="<?php echo ''. $urloffre . '/?id=' . $retour['id_offre'] . '' ; ?>">

 <i class="fa fa-location-arrow fa-lg" style="color:<?php echo $color_bg;?>;"></i>

<?php echo $retour['Name'].''; ?></a></b>

<b><?php echo ' || '.date("d.m.Y",strtotime($retour['date_expiration'])); ?></b>

</h2>

<b>Profils recherchés</b>

<p align="justify" style="width: 90%;"><?php  echo strip_tags(stripslashes($profil))."..."; ?>

<a style="color:<?php echo $color_bg;?>;" href="<?php echo $urloffre . '/?id='.$retour['id_offre'].''; ?>" >

voir l'offre</a></p>



<h4> <b>Réf. <?php echo $retour['reference']; ?></b> || 

<b>Date d’expiration: <?php echo date("d.m.Y",strtotime($retour['date_expiration'])); ?></b>

|| <b><?php echo $retour['fonction']; ?></b> </h4>

<div style="margin: 2px 0; background-color: #0B0B0B;"></div>

<br/>

<?php

    }  



  ?>



