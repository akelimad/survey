

<script type="text/javascript">

function generateexcel(tableid) {

  var table= document.getElementById(tableid);

  var html = table.outerHTML;



  //add more symbols if needed...

  while (html.indexOf('à') != -1) html = html.replace('à', '&agrave;');

  while (html.indexOf('á') != -1) html = html.replace('á', '&aacute;');

  while (html.indexOf('â') != -1) html = html.replace('â', '&acirc;');

  while (html.indexOf('ç') != -1) html = html.replace('ç', '&ccedil;');

  while (html.indexOf('è') != -1) html = html.replace('è', '&egrave;');

  while (html.indexOf('é') != -1) html = html.replace('é', '&eacute;');

  while (html.indexOf('ê') != -1) html = html.replace('ê', '&ecirc;');

  while (html.indexOf('î') != -1) html = html.replace('î', '&icirc;');

  while (html.indexOf('ô') != -1) html = html.replace('ô', '&ocirc;');

  while (html.indexOf('û') != -1) html = html.replace('û', '&ucirc;');  

  while (html.indexOf('º') != -1) html = html.replace('º', '&ordm;'); 

  while (html.indexOf('\'') != -1) html = html.replace('\'', '&#39;'); 

  while (html.indexOf('’') != -1) html = html.replace('’', '&#8217;'); 

  while (html.indexOf('‘') != -1) html = html.replace('‘', '&#8216;'); 

  while (html.indexOf('°') != -1) html = html.replace('°', '&deg;');



  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));

}

</script>



<script type="text/javascript">

    $("[id$=myButtonControlID_xsl]").click(function(e) {

		generateexcel('divTableDataHolder'); 

});

</script>

 

        <script type='text/javascript'>

        $(document).ready(function () {

           // console.log("HELLO");



            function exportTableToCSV($table, filename) {

                var $headers = $table.find('tr:has(th)')

                    ,$rows = $table.find('tr:has(td)')

                    // Temporary delimiter characters unlikely to be typed by keyboard

                    // This is to avoid accidentally splitting the actual contents

                    ,tmpColDelim = String.fromCharCode(11) // vertical tab character

                    ,tmpRowDelim = String.fromCharCode(0) // null character

                    // actual delimiter characters for CSV format

                    ,colDelim = '","'

                    ,rowDelim = '"\r\n"';

                    // Grab text from table into CSV formatted string

                    var csv = '"';

                    csv += formatRows($headers.map(grabRow));

                    csv += rowDelim;

                    csv += formatRows($rows.map(grabRow)) + '"';

                    // Data URI

                    var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

                $(this)

                    .attr({

                    'download': filename

                        ,'href': csvData

                        //,'target' : '_blank' //if you want it to open in a new window

                });

                //------------------------------------------------------------

                // Helper Functions 

                //------------------------------------------------------------

                // Format the output so it has the appropriate delimiters

                function formatRows(rows){

                    return rows.get().join(tmpRowDelim)

                        .split(tmpRowDelim).join(rowDelim)

                        .split(tmpColDelim).join(colDelim);

                }

                // Grab and format a row from the table

                function grabRow(i,row){

                     

                    var $row = $(row);

                    //for some reason $cols = $row.find('td') || $row.find('th') won't work...

                    var $cols = $row.find('td'); 

                    if(!$cols.length) $cols = $row.find('th');  

                    return $cols.map(grabCol)

                                .get().join(tmpColDelim);

                }

                // Grab and format a column from the table 

                function grabCol(j,col){

                    var $col = $(col),

                        $text = $col.text();

                    return $text.replace('"', '""'); // escape double quotes

                }

            }

            // This must be a hyperlink

            $("#myButtonControlID_txt").click(function (event) {

                // var outputFile = 'export'

                //var outputFile = window.prompt("What do you want to name your output file (Note: This won't have any effect on Safari)") || 'export';

                //outputFile = outputFile.replace('.csv','') + '.csv'

                 var outputFile =Math.floor(Date.now() / 1000)+ '.txt'

                // CSV

                exportTableToCSV.apply(this, [$('#divTableDataHolder>table'), outputFile]);

                

                // IF CSV, don't do event.preventDefault() or return false

                // We actually need this to be a typical hyperlink

            });

            $("#myButtonControlID_csv").click(function (event) {

                // var outputFile = 'export'

                //var outputFile = window.prompt("What do you want to name your output file (Note: This won't have any effect on Safari)") || 'export';

                //outputFile = outputFile.replace('.csv','') + '.csv'

                 var outputFile =Math.floor(Date.now() / 1000)+ '.csv'

                // CSV

                exportTableToCSV.apply(this, [$('#divTableDataHolder>table'), outputFile]);

                

                // IF CSV, don't do event.preventDefault() or return false

                // We actually need this to be a typical hyperlink

            });

        });

    </script>	







	<script type="text/javascript" src="https://www.google.com/jsapi"></script>



        <script type="text/javascript">



      // Load the Visualization API and the piechart package.

      google.load('visualization', '1.0', {'packages':['corechart']});



      // Set a callback to run when the Google Visualization API is loaded.

      google.setOnLoadCallback(drawChart);



      // Callback that creates and populates a data table,

      // instantiates the pie chart, passes in the data and

      // draws it.

      function drawChart() {



        // Create the data table.

        var data = new google.visualization.DataTable();

        data.addColumn('string', 'Topping');

        data.addColumn('number', 'Slices');

        data.addRows([

          <?php

// Create connection



        $sqltype = "SELECT DISTINCT o.Name , count( historique.id_candidature) as nbr

FROM offre o

inner join candidature on o.id_offre = candidature.id_offre

inner join historique on candidature.id_candidature = historique.id_candidature 

".$requet."  ".$q_offre_fili_and."

group by o.Name order by nbr ASC ";

        $resulttype =  mysql_query($sqltype);

        while($row = mysql_fetch_assoc($resulttype))

          {  $type_ps=$row["Name"];

        $nbr=$row['nbr'];

         echo "[' ".$nbr." || ".$type_ps." "." ',".$nbr."],";    

          }

        

       ?>

          

        ]);



        // Set chart options

        var options = {is3D: true,pieHole: 0.4,'title':'Nombre des candidats pour chaque offre'};



        // Instantiate and draw our chart, passing in some options.

var chart = new google.visualization.PieChart(document.getElementById('visualization_de_candidatures_par_offre_detail'));

        chart.draw(data, options);

      }

    </script>