<script type="text/javascript">
      function drawVisualization() {
    
        var data = google.visualization.arrayToDataTable([
          ['Secteurs d\'activités', 'Nombre de Candidats']
      <?php
      
          $req = "SELECT c.status, COUNT( * ) AS nbr 
         FROM  candidature c 
         WHERE  c.id_offre= $co
         GROUP BY status
         ORDER BY nbr DESC";
         
          $reponse = mysql_query($req);
        
         while($donnee = mysql_fetch_array($reponse))
         {
            echo ',[\''.$donnee["status"].'\','.$donnee["nbr"].']';
         }
       ?>
          
        ]);
        var options = {is3D: true,};
        // Create and draw the visualization.
        new google.visualization.PieChart(document.getElementById('visualization_de_candidatures_par_offre_detail_En_attente')).
            draw(data,options, {title:"Détail de l’offre ",width:600,height:300,legend:{position: 'right', textStyle: {color: 'black', fontSize: 10},alignment:'automatic'}});
      }
      
      google.setOnLoadCallback(drawVisualization);
    </script>

  <!-- visualization_de_candidatures_par_offre_detail -->
  
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
          ['Secteurs d\'activités', 'Nombre de Candidats']
      <?php
      
          $req = "SELECT h.status, COUNT( * ) AS nbr 
         FROM historique h,candidature c 
         WHERE h.id_candidature = c.id_candidature  AND c.id_offre= $co and ( h.status IN (SELECT  statut  FROM `prm_statut_candidature`  where  etat_1 ='1'  or  etat_2 ='1'  or  etat_3 ='1'  or  etat_4 ='1'  or  etat_5 ='1'  or  etat_6 ='1'  or  etat_7 ='1'  or  etat_8 ='1'   ) or h.status='En attente' )
         GROUP BY h.status
         ORDER BY nbr DESC";
         
          $reponse = mysql_query($req);
        
         while($donnee = mysql_fetch_array($reponse))
         {
           echo ',[\''.$donnee["status"].'\','.$donnee["nbr"].']';
         }
       ?>
          
        ]);
        var options = {is3D: true,};
        // Create and draw the visualization.
        new google.visualization.PieChart(document.getElementById('visualization_de_candidatures_par_offre_detail')).
            draw(data,options, {title:"Détail des statuts de l’offre  ",width:600,height:300,legend:{position: 'right', textStyle: {color: 'black', fontSize: 10},alignment:'automatic'}});
      }
      
      google.setOnLoadCallback(drawVisualization);
    </script>               
    
  
  
  
  
  
  <!-- NOMBRE D'ACCES A LA CVTHEQUE -->
  <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['semaine', 'nombre Cvtheque']
    
      <?php
      
         $m=array("janvier","fevrier","mars","avril","mai","juin","juillet","aout","septembre","octobre","novembre","decembre");
         
         $req="SELECT MAX(MONTH(expir_cvtheque)) AS max,expir_cvtheque as ladate FROM entreprise  WHERE expir_cvtheque<>'0000-00-00' AND nbr_cvs<>0 AND YEAR(expir_cvtheque)=YEAR(CURDATE()) AND expir_cvtheque<=CURDATE()";
         
         $reponse = mysql_query($req);
         
         while($donnee = mysql_fetch_array($reponse))
          {
          $maxWeek = $donnee['max'];
        }
        
        
         for($i=1;$i<=$maxWeek;$i=$i+1)
       {  
          echo ',[\''.$m[$i-1].'\',';
        
                $sous_req="SELECT COUNT(*) AS nbre FROM entreprise  WHERE  expir_cvtheque<>'0000-00-00' AND nbr_cvs<>0 AND MONTH(expir_cvtheque)>='$i' AND MONTH(date_expiration_compte)>='$i' AND MONTH(date_abonnement)<='$i'AND YEAR(expir_cvtheque)=YEAR(CURDATE())";
        $rep = mysql_query($sous_req);
                while($dat = mysql_fetch_array($rep))
                 {
            echo $dat['nbre'];
                 }    
                 echo ']';         
       }
       ?>
        ]);
        var options = {
          title: 'Nombre d\'accès à La cvtheque',
          hAxis: {title: 'mois', titleTextStyle: {color: 'red'}},
      chartArea: {bottom:0,width:"70%", height:"70%"},
      height: 300,width:600
      };
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_cvs_dans_cvtheque'));
        chart.draw(data, options);
      }
   
    </script>