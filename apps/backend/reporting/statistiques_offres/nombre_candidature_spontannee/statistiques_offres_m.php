<div class='texte'><br/><br/><h1>STATISTIQUE OFFRE:</h1><p>Cette section vous permet d'afficher le nombre des candidatures spontanées.</p>            <div  class="subscription" style="margin: 10px 0pt;">			<h1> candidatures spontanées </h1>			</div>			<table width="100%"><tr>                            <td width="25%"><b>Indicateur :</b></td>                            <td width="75%">                             <select onChange="window.location.href=this.value">                                <option value="<?= site_url('backend/reporting/statistiques_offres/nombre_offre/'); ?>"> Nombre des offres</option>                                <option value="<?= site_url('backend/reporting/statistiques_offres/offres_details/'); ?>"> Statistiques pour chaque offre</option>                                <option value="<?= site_url('backend/reporting/statistiques_offres/nombre_candidature/'); ?>"  > Nombre des candidatures par offre</option>                                <option value="<?= site_url('backend/reporting/statistiques_offres/nombre_candidature_spontannee/'); ?>"  selected > Nombre des candidatures spontanées</option>                                <option value="<?= site_url('backend/reporting/statistiques_offres/nombre_candidature_stage/'); ?>"> Nombre des candidatures pour stage</option>                            </select>                                                     </tr></table><br/><div class="ligneBleu"></div>         <?php   $select_nbr = mysql_query("Select count(*) As nbr from candidats c, candidature_spontanee cs where c.candidats_id=cs.candidats_id AND last_connexion<>'0000-00-00' AND mdp<>'' ");        $num_rows_sp = mysql_num_rows($select_nbr);                       $count_nbr = mysql_fetch_array($select_nbr);                       ?>        <?php if($count_nbr['nbr'] < 1 ){ ?>             <h3 style="  color: red;"> Nombre des candidatures spontanées : <?php echo $count_nbr['nbr']; ?></h3>        <?php }else { ?>            <h3> Nombre des candidatures spontanées : <?php echo $count_nbr['nbr']; ?></h3>            <h3>            <div id='chart_div_candidatures_spontanees' style='width: 680px; height: 300px;'></div>           </h3>                            <!-- NOMBRES DE candidatures_spontanees  -->    <script type='text/javascript'>      google.load('visualization', '1', {'packages':['annotatedtimeline']});      google.setOnLoadCallback(drawChart);      function drawChart() {        var data = new google.visualization.DataTable();        data.addColumn('date', 'Date');        data.addColumn('number', 'Nombre des candidatures ');        data.addRows([      <?php  $sql_cs = "  SELECT DATE_FORMAT(date_cs,'%Y, %m-1 ,%d'),count(*)   FROM candidats c, candidature_spontanee cs                        where c.candidats_id=cs.candidats_id AND last_connexion<>'0000-00-00' AND mdp<>''  group By date_cs  " ;                              $result = mysql_query($sql_cs);while($row = mysql_fetch_array($result))  {   echo '[new Date('.$row['0'].'),'. $row['1'].'],';    }  ?>                  ]);        var chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_div_candidatures_spontanees'));        chart.draw(data, {displayAnnotations: true});      }    </script>                     <?php                       } ?></div>