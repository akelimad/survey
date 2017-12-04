
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=500,width=700');
        mywindow.document.write('<html><head><title>Notation de candidature</title>');
		mywindow.document.write('<style> @media print { table.tablesorter thead tr th,  table.tablesorter tbody tr td  {  border: 1px solid #000; } #tab_pop tr td  {  border: 1px solid #fff; } }  </style> ');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>  
  

<script type="text/javascript">
    $("[id$=myButtonControlID]").click(function(e) {
		generateexcel('divTableDataHolder'); 
});
</script>

<script type="text/javascript">

        function showUser()

        {



            if (window.XMLHttpRequest)

            {// code for IE7+, Firefox, Chrome, Opera, Safari

                xmlhttp=new XMLHttpRequest();

            }

            else

            {// code for IE6, IE5

                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

            }

            xmlhttp.onreadystatechange=function()

            {

                if (xmlhttp.readyState==4 && xmlhttp.status==200)

                {

                    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;

                }

            }

            xmlhttp.open("GET","getuser.php?q="+1,true);

            xmlhttp.send();

        }

            </script>