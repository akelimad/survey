      <div class='texte'><div  class="subscription" style="margin: 10px 0pt;"><h1> Nombre des candidats  </h1></div><?php       $result = mysql_query("Select COUNT(DISTINCT(candidats_id)) As nbr from candidats WHERE date_inscription<>'0000-00-00' AND mdp<>'' ");    $num_rows = mysql_num_rows($result);    $count_nbr = mysql_fetch_array($result);    $msgdiv=($num_rows<1)?'Aucune donnée.':'';?>    <?php       if($count_nbr['nbr'] < 1 ){       ?>                   <h3 style="  color: red;"> Nombre des candidats inscrits sur le site : <?php echo $count_nbr['nbr']; ?> </h3>     <?php } else {?>  <h3 > Nombre des candidats inscrits sur le site : <?php echo $count_nbr['nbr']; ?> </h3>				<div style="visibility:hidden;">					<form name="frm2">					   <input id ="an2" name="an2" type="test" value="" />					   <input type="text" id="week2" name="week2" value="" />					   <input type="text" id="sem2" name="sem2" value="" />					</form>				    </div>										 <div id='chart_div' style='width: 680px; height: 300px;'></div>					 					 	<!-- NOMBRE DE CANDIDATS INSCRITS !-->    <script type='text/javascript'>      google.load('visualization', '1', {'packages':['annotatedtimeline']});      google.setOnLoadCallback(drawChart);      function drawChart() {        var data = new google.visualization.DataTable();        data.addColumn('date', 'Date');        data.addColumn('number', 'Nombre de candidats inscrits');        data.addRows([      <?php   $result = mysql_query("SELECT DATE_FORMAT(date_inscription,'%Y, %m-1 ,%d'),count(*) FROM candidats where date_inscription<>0000-00-00 AND mdp<>'' group By date_inscription");while($row = mysql_fetch_array($result))  {   echo '[new Date('.$row['0'].'),'. $row['1'].'],';    }?>                  ]);        var chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_div'));        chart.draw(data, {displayAnnotations: true});      }    </script>	<?php } ?></div>