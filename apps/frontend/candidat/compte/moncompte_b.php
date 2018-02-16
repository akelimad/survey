            <script type="text/javascript"> 
  var  path_site="<?php echo $site; ?>";
   //////////  - 4 : editAlert, edit_commande, edit_role, detailsEntrepreneur, 
function hideDiv() { 

if (document.getElementById) { // DOM3 = IE5, NS6 

document.getElementById('hideshow').style.visibility = 'hidden'; 



} 

else { 

if (document.layers) { // Netscape 4 

document.hideshow.visibility = 'hidden'; 

} 

else { // IE 4 

document.all.hideshow.style.visibility = 'hidden'; 

} 

}

 

}

   //////////  - 2 :  ajaxedit   -->(frontend\candidat\list_alert.php ; frontend\candidat\moncompte_m.php)
function editAlert(id,titre) { 

var left = (screen.width/2)-(300/2);





element = document.getElementById("hideshow");

if(element)

element.parentNode.removeChild(element);



maDiv = document.createElement("div");

maDiv.id = 'hideshow';

maDiv.style.visibility = 'hidden'; 

maDiv.innerHTML = '<div id="fade"></div><div class="popup_block" style="width: 300px; z-index: 999; top: 30%; left: '+left+'px;"><div class="titleBar"><div class="title">Editer cette alerte</div><a href="javascript:hideDiv()"><div class="close" style="cursor: pointer;">close</div></a></div><div class="content"><table><tr><td align="center" valign="bottom"><div id="display"> </div></td></tr><tr id="tr1"><td align="left" valign="bottom">Description de l\'alerte<br/><input type="text" name="titre" id="titre_alert" value="'+titre+'" style="width:250px;" /></td></tr></table><div style="margin-left:5px;"><input id="input1" type="button" value="Editer cette alerte" tabindex="3" class="espace_candidat" onClick="javascript:ajaxedit(\''+id+'\')" /></div></div></div>';

document.body.appendChild(maDiv);

if (document.getElementById) { // DOM3 = IE5, NS6 

document.getElementById('hideshow').style.visibility = 'visible'; 

} 

else { 

if (document.layers) { // Netscape 4 

document.hideshow.visibility = 'visible'; 

} 

else { // IE 4 

document.all.hideshow.style.visibility = 'visible'; 

} 

} 

}
 
 
   //////////  - 2 : editAlert
function ajaxedit(id){

if(document.getElementById("titre_alert").value=="")

document.getElementById("display").innerHTML="<span style=\"color:red;\">Veuillez entrer une description pour cette alerte</span>";

else

{









    var xhr2=null;

    

    if (window.XMLHttpRequest) { 

        xhr2 = new XMLHttpRequest();

    }

    else if (window.ActiveXObject) 

    {

        xhr2 = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	var titre = document.getElementById("titre_alert").value;

    xhr2.open("GET", ""+path_site+"/apps/frontend/candidat/compte/edit_alert.php?id="+id+"&titre="+titre+"", true);

    xhr2.send(null);

	//on définit l'appel de la fonction au retour serveur

    xhr2.onreadystatechange = function() { 

	if(xhr2.readyState == 4 ) {

		if (xhr2.status == 200){ 

		

		document.getElementById("display").innerHTML=xhr2.responseText;

		afficheralertes();

		} 

		else {

        //alert("problème lors de la mise à jour de la liste des alertes");

		}

	}

	}

		







}

}
 
 
    //////////  - 2 :      -->(frontend\candidat\list_alert.php ; frontend\candidat\moncompte_m.php)
function createAlert(requete) { 

var left = (screen.width/2)-(300/2);





element = document.getElementById("hideshow");

if(element)

element.parentNode.removeChild(element);



maDiv = document.createElement("div");

maDiv.id = 'hideshow';

maDiv.style.visibility = 'hidden'; 

maDiv.innerHTML = '<div id="fade"></div><div class="popup_block" style="width: 300px; z-index: 999; top: 30%; left: '+left+'px;"><div class="titleBar"><div class="title">Création d\'une alerte e-mail</div><a href="javascript:hideDiv()"><div class="close" style="cursor: pointer;">close</div></a></div><div class="content"><table><tr><td align="center" valign="bottom"><div id="display"></div></td></tr><tr id="tr1"><td align="left" valign="bottom">Description de l\'alerte<br/><input type="text" name="titre" id="titre_alert" style="width:250px;" /></td></tr></table><div><input id="input1" type="button" value="Enregistrer" class="espace_candidat" tabindex="3" onClick="javascript:ajaxalert(\''+requete+'\')" /></div></div></div>';

document.body.appendChild(maDiv);

if (document.getElementById) { // DOM3 = IE5, NS6 

document.getElementById('hideshow').style.visibility = 'visible'; 

} 

else { 

if (document.layers) { // Netscape 4 

document.hideshow.visibility = 'visible'; 

} 

else { // IE 4 

document.all.hideshow.style.visibility = 'visible'; 

} 

} 

} 
 
   //////////  - 3 : ajaxedit ajaxalert
function afficheralertes(){



		      var xhr1=null;

    

    if (window.XMLHttpRequest) { 

        xhr1 = new XMLHttpRequest();

    }

    else if (window.ActiveXObject) 

    {

        xhr1 = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

    xhr1.open("GET", ""+path_site+"/apps/frontend/candidat/compte/list_alert.php", true);

    xhr1.send(null);

	//on définit l'appel de la fonction au retour serveur

    xhr1.onreadystatechange = function() { 

	if(xhr1.readyState == 4 ) {

		if (xhr1.status == 200){ 

		

		document.getElementById("table_alertes").innerHTML=xhr1.responseText;

		

		

		

		} 

		else {

        //alert("problème lors de la mise à jour de la liste des alertes");

		}

	}

	}

		

}

    //////////  - 2 :  createAlert
function ajaxalert(requete){

if(document.getElementById("titre_alert").value=="")

document.getElementById("display").innerHTML="<span style=\"color:red;\">Veuillez entrer une description pour cette alerte</span>";

else

{





      var xhr=null;

    

    if (window.XMLHttpRequest) { 

        xhr = new XMLHttpRequest();

    }

    else if (window.ActiveXObject) 

    {

        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }

	var titre = document.getElementById("titre_alert").value;

    if(requete!='norequete')

	requete="&requete="+requete;

	else

	requete="";

    //xhr.open("GET", ""+path_site+"/apps/frontend/candidat/compte/create_alert.php?titre="+titre+requete+"", true);
    xhr.open("GET", ""+path_site+"/candidat/compte/create_alert.php?titre="+titre+requete+"", true);

    xhr.send(null);

	//on définit l'appel de la fonction au retour serveur

    xhr.onreadystatechange = function() { 

	if(xhr.readyState == 4 ) {

		if (xhr.status == 200){ // OK response

       // document.getElementById("tr1").style.display='none';

	   // document.getElementById("input1").style.display='none';

		document.getElementById("display").innerHTML=xhr.responseText;

		

		/////taha actualiser la liste des alertes///////////////

		

		

		

		afficheralertes();

		

		

		

		

		} 

		else {

        alert("Problem: " + xhr.statusText);

 		alert("status: " + xhr.status);

		}

	}

	}





}



}

  
   //////////  - 2 : editAlert
function ajaxedit(id){

if(document.getElementById("titre_alert").value=="")

document.getElementById("display").innerHTML="<span style=\"color:red;\">Veuillez entrer une description pour cette alerte</span>";

else

{









    var xhr2=null;

    

    if (window.XMLHttpRequest) { 

        xhr2 = new XMLHttpRequest();

    }

    else if (window.ActiveXObject) 

    {

        xhr2 = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

	var titre = document.getElementById("titre_alert").value;

    xhr2.open("GET", ""+path_site+"/apps/frontend/candidat/compte/edit_alert.php?id="+id+"&titre="+titre+"", true);

    xhr2.send(null);

	//on définit l'appel de la fonction au retour serveur

    xhr2.onreadystatechange = function() { 

	if(xhr2.readyState == 4 ) {

		if (xhr2.status == 200){ 

		

		document.getElementById("display").innerHTML=xhr2.responseText;

		afficheralertes();

		} 

		else {

        //alert("problème lors de la mise à jour de la liste des alertes");

		}

	}

	}

		







}

}
 
 
   //////////  - 3 : ajaxedit ajaxalert
function afficheralertes(){



		      var xhr1=null;

    

    if (window.XMLHttpRequest) { 

        xhr1 = new XMLHttpRequest();

    }

    else if (window.ActiveXObject) 

    {

        xhr1 = new ActiveXObject("Microsoft.XMLHTTP");

    }

	

    xhr1.open("GET", ""+path_site+"/apps/frontend/candidat/compte/list_alert.php", true);

    xhr1.send(null);

	//on définit l'appel de la fonction au retour serveur

    xhr1.onreadystatechange = function() { 

	if(xhr1.readyState == 4 ) {

		if (xhr1.status == 200){ 

		

		document.getElementById("table_alertes").innerHTML=xhr1.responseText;

		

		

		

		} 

		else {

        //alert("problème lors de la mise à jour de la liste des alertes");

		}

	}

	}

		

}

            </script> 

<img src="" id="screenshot" style="display: none;">

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
	html2canvas($("#account-wrap"), {
        onrendered: function(canvas) {
            var src = canvas.toDataURL("image/png");
            $('#screenshot').attr('src', src)
        }
    });


	$("#print-account").click(function(){
		print($('#screenshot').attr('src'))
	});
});

function print(src) {
    var mywindow = window.open('', 'Mon compte');
    mywindow.document.write('<html><head><title>Mon compte</title>');
    mywindow.document.write('</head><body>');
    mywindow.document.write('<img src="'+ src +'">');
    mywindow.document.write('</body></html>');

    mywindow.print();
    mywindow.close();

    return true;
}
</script>