<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  

</head>
<body> 


				 <h3> Nombres des visiteurs uniques <h3>

				 <div id="chart_visiteurs_uniques" style="width: 680px; height: 300px;"></div>
	
	

<!-- VISITEURS NON UNIQUES -->


<script type="text/javascript">

      

        google.load('visualization', '1', {'packages':['annotatedtimeline']});

        google.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();

        data.addColumn('date', 'Date');

        data.addColumn('number', 'Nombre de visiteurs');

        data.addRows([

          <?php 
   
 

                $analytics->requestReportData($profileId,$dimensions,$metrics,'date',NULL,'2015-01-01',NULL,NULL,1000);

                
                

                foreach($analytics->getResults() as $result):

                   echo '[new Date('.$result->getYear().','.($result->getMonth()-1).','.$result->getDay().'),'.$result->getVisitors().'],';

                endforeach;

    
            

          ?>

          

         

      

       ]);

        var chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_visiteurs_uniques'));

        chart.draw(data, {displayAnnotations: true});

      }

</script>


	
</body>
</html> 
