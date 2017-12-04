 

<script type="text/javascript">



    function PrintElem(elem)

    {

        Popup($(elem).html());

    }



    function Popup(data) 

    {

        var mywindow = window.open('', 'my div', 'height=500,width=700');

        mywindow.document.write('<html><head><title>Notation de candidature</title>');

		

        mywindow.document.write('</head><body >');

        mywindow.document.write(data);

        mywindow.document.write('</body></html>');



        mywindow.print();

        mywindow.close();



        return true;

    }



</script>  

  

<!--

<script type="text/javascript">

    $("[id$=myButtonControlID]").click(function(e) {

    window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('div[id$=divTableDataHolder]').html()));

    e.preventDefault();

});

</script>

-->





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

    $("[id$=myButtonControlID]").click(function(e) {

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



