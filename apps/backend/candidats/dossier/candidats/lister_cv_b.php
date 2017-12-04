            <script type="text/javascript">

                function colorer(i){

                    document.getElementById(i).className = "marked";

                }

                function pasdecouleur(i,j){

                    if(document.getElementById('select'+i).checked == false)

                    {

                        if(j==1)

                        document.getElementById(i).className = "odd";

                    else

                    document.getElementById(i).className = "even";

            }

        }

            </script>
 

            <!-- ajax -->



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



    



            <script>

        function showmenu(menu) {

            if (menu.style.display == 'none') menu.style.display = 'block';

            else menu.style.display = 'none';

        }

            </script>



            <script language="javascript">

        function toutcocher()

        {

            for(i=0;i<document.F1.length;i++)

            {

                if(document.F1.elements[i].type=="checkbox")

                document.F1.elements[i].checked=true;

        }   

    }

    function toutdecocher()

    {

        for(i=0;i<document.F1.length;i++)

        {

            if(document.F1.elements[i].type=="checkbox")

            document.F1.elements[i].checked=false;

    }   

    }

            </script>
 
