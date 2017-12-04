 <!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml">

<head>  



</head>

<body> 





                                      <h3> Temps moyen passé sur le site</h3>



                                      <div id="chart_temps_moyen" style="width: 680px; height: 300px;"></div>				   





<!-- TEMPS MOYEN PASSE -->



<script type="text/javascript">



     

        google.load('visualization', '1', {'packages':['annotatedtimeline']});



      google.setOnLoadCallback(drawChart);



       function drawChart() {



        var data = new google.visualization.DataTable();



        data.addColumn('date', 'Date');



        data.addColumn('number', 'Taux de rebond');



        data.addRows([



          <?php 

              

     			  $analytics->requestReportData($profileId,$dimensions,$metrics,'date',NULL,'2015-01-01',NULL,NULL,1000);  





                



                foreach($analytics->getResults() as $result):



                     if($result->getVisits() == 0)



                        $var = 0;



                     else



                        $var = $result->getAvgTimeOnSite();



           



                        $time = mktime(0,0,$var,0,0,0);



                        



                        $var = $var/60;



                        



                        echo '[new Date('.$result->getYear().','.($result->getMonth()-1).','.$result->getDay().'),'.$var.'],';



                    



                endforeach;



                            



          ?>



          



        



      ]);



        var chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_temps_moyen'));



        chart.draw(data, {displayAnnotations: true});



      }



      



</script>





</body>

</html> 

