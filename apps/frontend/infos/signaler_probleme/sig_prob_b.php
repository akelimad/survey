        <script>
            function validateBeforeSubmit()
            {
if(document.getElementById("destination").value == "")
{
    alert("Veuillez entrer votre destination");
    return false;
}
            
if(document.getElementById("user_last_name").value == "")
{
    alert("Veuillez entrer votre nom de famille");
    return false;
}
            
if(document.getElementById("user_first_name").value == "")
{
    alert("Veuillez entrer votre prénom");
    return false;
}
            
<!--verification email-->
ctl = /^[A-Z0-9a-z._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,3}$/;
if (document.getElementById("user_email").value.search(ctl) == -1)
{
    alert("Votre email est invalide. Veuillez ressayer encore");
    return false;
}
if(document.getElementById("subject").value == "")
{
    alert("Veuillez entrer le sujet");
    return false;
}
            
if(document.getElementById("msg").value == "")
{
    alert("Veuillez entrer votre message");
    return false;
}
document.getElementById("contact_us").submit();
            }
        </script> 
        <script type="text/javascript">
                                CKEDITOR.replace( 'msg',
                                {
                                width : "350px"
                                });
                                </script>