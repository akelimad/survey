      <div class='texte'><div  class="subscription" style="margin: 10px 0pt;"><h1> Nombre des CVs  </h1></div><?php   $select_nbr = mysql_query("Select COUNT(DISTINCT(candidats_id)) As nbr from candidats WHERE date_inscription<>'0000-00-00' AND mdp<>''");    $num_rows = mysql_num_rows($select_nbr);    $count_nbr = mysql_fetch_array($select_nbr);    $msgdiv=($num_rows<1)?'Aucune donnée.':'';?>    <?php       if($count_nbr['nbr'] < 1 ){       ?>                   <h3 style="  color: red;"> Nombre des CVs dans la CV-Thèque: <?php echo $count_nbr['nbr']; ?> </h3>     <?php } else {?>  <h3 > Nombre des CVs dans la CV-Thèque : <?php echo $count_nbr['nbr']; ?> </h3><h3>					  					  <div id='chart_div_candidats_cvtheque' style='width: 680px; height: 300px;'></div>					 </h3>   <!-- NOMBRES DE CVs Dans la CVThéques -->    <script type='text/javascript'>      google.load('visualization', '1', {'packages':['annotatedtimeline']});      google.setOnLoadCallback(drawChart);      function drawChart() {        var data = new google.visualization.DataTable();        data.addColumn('date', 'Date');        data.addColumn('number', 'Nombre de CV');        data.addRows([      <?php   $result = mysql_query("SELECT DATE_FORMAT(last_connexion,'%Y, %m-1 ,%d'),count(*) FROM candidats, cv where candidats.candidats_id=cv.candidats_id AND last_connexion<>'0000-00-00' AND mdp<>''  group By last_connexion");while($row = mysql_fetch_array($result))  {   echo '[new Date('.$row['0'].'),'. $row['1'].'],';    }  ?>                  ]);        var chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_div_candidats_cvtheque'));        chart.draw(data, {displayAnnotations: true});      }    </script>	       <?php } ?></div>