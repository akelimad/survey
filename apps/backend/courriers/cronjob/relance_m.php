<!DOCTYPE html>

<html>

<head>

  <title></title>

  <script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script> 

<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery.tablesorter.min.js"></script>

<script type="text/javascript" src="<?php echo $jsurl; ?>/jquery/jquery.tablesorter.pager.min.js"></script>



</head>

<body>

<div class='texte' style="width:760px"><br/>

              <h1>Relance des candidats</h1>   

                            <div class="subscription" style="margin: 10px 0pt;">

                  <h1>la liste des candidats </h1>

              </div>    

 <table width="100%" id="matching_offres_resultat" class="tablesorter">

 <thead>

   <tr>

     <th>Nom</th>

     <th>Email</th>

     <th>dérniere connexion </th>

   </tr>

</thead>

<tbody>

<?php 

$year = date('Y');



$query = mysql_query("SELECT * from candidats 

where year(last_connexion) = $year - 2  "); // ou autre bien sûr...

$count = mysql_num_rows($query);

echo "Nombre des candidats : ".$count;

?>



<br/>





<?php

$start = microtime(true);

while($data3 = mysql_fetch_assoc($query)){

?>

  <tr>

    <td>

      <?php echo $data3['nom'];?>

      <?php echo $data3['prenom'];?>

    </td>

    <td>

      <?php echo $data3['email'];?>

    </td>

    <td>

      <?php echo $data3['last_connexion'];?>

    </td>

  </tr>

<?php } ?>

</tbody>

 </table>





<div id="pagination_matching_offres_resultat">

      <form action="matching_off.php" method="post">

        <img src="<?php echo $imgurl ?>/icons/first.png" class="first"/> 

        <img src="<?php echo $imgurl ?>/icons/prev.png" class="prev"/>

        <input type="text" class="pagedisplay" name="page"/>

        <img src="<?php echo $imgurl ?>/icons/next.png" class="next"/> 

        <img src="<?php echo $imgurl ?>/icons/last.png" class="last"/>

        <select class="pagesize">

          <option selected="selected"  value="10">10</option>

          <option value="20">20</option>

          <option value="30">30</option>

          <option  value="40">40</option>

        </select>

      </form>

      </div>

</div><br/>

  <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">



<input class="espace_candidat" type="submit"  style="width:190px" 

            name="envoi" value="envoyer un email" />

</form>

<?php

 if (isset($_POST['envoi'])) {

$query4 = mysql_query("SELECT * from candidats where year(last_connexion) = $year- 2  ");

while($data4 = mysql_fetch_assoc($query4)){

//echo $data4['email'];

$email = $data4['email'];

 if(!empty($email)){



//////////////////////////

$message = "<p>Bonjour </p>

<p></p>

<p>Cordialement</p>";

$from_emaiil = $conf_admin_email;

$objet = "fzefzef";         

$headers1  = 'MIME-Version: 1.0' . "\r\n";      

$headers1 .= 'Content-type: text/html; charset=utf-8' . "\r\n";

$headers1 .= "From: relance candidats <$info_contact>" . "\r\n";

$headers1 .= 'Bcc: '.$from_emaiil."\r\n";

mail($email, $objet, $message, $headers1);

'X-Mailer: PHP/'.phpversion();

 }

 /////////////////////////////////////

 }

}

?>

<script type="text/javascript">

    $(document).ready(function() { 

        $("#matching_offres_resultat").tablesorter({sortList: [[0,1]], 

                    widgets: ['zebra'], 

                    dateFormat: 'uk', 

              headers: {2: {sorter:'text'}  ,0: {sorter:false}  ,

              1: {sorter: "shortDate"}} ,

               widthFixed: true, widgets: ['zebra']});

            $("#matching_offres_resultat").tablesorterPager({container: $("#pagination_matching_offres_resultat"),positionFixed: false <?php if (isset($page)) echo ', page:' . ($page - 1); ?>});



                    

                    });



  </script>

</body>

</html>