<!--
<script>
function removeSpecials(str) {
    var lower = str.toLowerCase();
    var upper = str.toUpperCase();

    var res = "";
    for(var i=0; i<lower.length; ++i) {
        if(lower[i] != upper[i] || lower[i].trim() === '')
            res += str[i];
    }
    return res;
}



function valider_contact()
{


        if(document.getElementById("destination").value == ""){
            alert("Veuillez entrer votre destination");
            return false;
        }else {
        document.getElementById("destination").value=removeSpecials(document.getElementById("destination").value);
        }

        if(document.getElementById("user_last_name").value == ""){
            alert("Veuillez entrer votre nom de famille");
            return false;
        }else {
        document.getElementById("user_last_name").value=removeSpecials(document.getElementById("user_last_name").value);
        }
        if(document.getElementById("user_first_name").value == ""){
            alert("Veuillez entrer votre prénom");
            return false;
        }else {
        document.getElementById("user_first_name").value=removeSpecials(document.getElementById("user_first_name").value);
        }


        ctl = /^[A-Z0-9a-z._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,3}$/;
        if (document.getElementById("user_email").value.search(ctl) == -1){
            alert("Votre email est invalide. Veuillez ressayer encore");
            return false;
        }else {
        document.getElementById("user_email").value= document.getElementById("user_email").value;
        }
        
        if(document.getElementById("subject").value == ""){
            alert("Veuillez entrer le sujet");
            return false;
        }else {
        document.getElementById("subject").value=removeSpecials(document.getElementById("subject").value);
        } 

}

        </script>
        -->