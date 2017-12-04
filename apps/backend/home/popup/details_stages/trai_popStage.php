
<?php

											if(isset($_POST['modifier'])&& !empty($_POST['ref_h'])){
											$id_hie=$_POST['ref_h'];
											
											
											$req_com_up="UPDATE `historique_stage` SET `commentaire` = '".$_POST['titre_m']."' WHERE `historique_stage`.`id` = ".$id_hie."";
											$sql_upd=mysql_query($req_com_up);
									 
										
					
		$show=  ' <html><head>'
				.'<link href="'.$cssurl.'/style_admin.php" rel="stylesheet" type="text/css" media="all" /> '
				.'</head><body>' 
					.'<meta http-equiv="refresh" content="0;'.$_SERVER['PHP_SELF'].'" />'	
		 
				.'</body></html>';	
		 
		echo $show;										 
											}
										
											if(isset($_POST['supprimer'])&& !empty($_POST['ref_h_s'])){
											$id_his=$_POST['ref_h_s'];
											
											
											/*$req_com_s="DELETE FROM `etalent`.`historique` WHERE `historique`.`id` = ".$id_his."";*/
											$sql_del="UPDATE `historique_stage` SET `commentaire` ='' WHERE `historique_stage`.`id` = ".$id_his."";
											$sql_delet=mysql_query($sql_del);
											
		$show=  ' <html><head>'
				.'<link href="'.$cssurl.'/style_admin.php" rel="stylesheet" type="text/css" media="all" /> '
				.'</head><body>' 
					.'<meta http-equiv="refresh" content="0;'.$_SERVER['PHP_SELF'].'" />'	
		 
				.'</body></html>';	
		 
					echo $show;	
					
											}
										?>

<script language="javascript">

// -------------------------------------détail
function hideDivDetai() { 
location.reload();
    if (document.getElementById) { // DOM3 = IE5, NS6 
        document.getElementById('rep').style.visibility = 'hidden'; 
		
    } else { 
        if (document.layers) { // Netscape 4 
            document.rep.visibility = 'hidden'; 
			
        } else { // IE 4 
            document.all.rep.style.visibility = 'hidden'; 
			
        } 
    } 
}
 
function showDivDetai(a,b,c,d,e,f,g,h) { 

var ref=a ;		 		
 
var sujet="<p> "+ b +"  </p>";
 
var nom="<p> "+ c +"  </p>";
 //
var date_envoi="<p> "+ d +"  </p>";		
 
var type_envoi="<p> "+ e +"  </p>";		
 
var titre=g;	
var lieu=f;  		
var message=h ;	 	

    if (document.getElementById) { // DOM3 = IE5, NS6 
        document.getElementById('rep').style.visibility = 'visible'; 
    } else { 
        if (document.layers) { // Netscape 4 
            document.rep.visibility = 'visible'; 
        } else { // IE 4 
            document.all.rep.style.visibility = 'visible'; 
        } 
    }  
            $("#sujet").append(sujet);
            $("#nom").append(nom);
            $("#date_envoi").append(date_envoi);
            $("#type_envoi").append(type_envoi);
            
            if (titre == ""){
                $("#titre").append("");
            }else{
                $("#titre").append("<td><b>Commentaire : </b></td><td><p>"+titre+"</p></td>"); 
            }

            if (lieu == ""){
                $("#lieux").append("");
            }else{
                $("#lieux").append("<td><b>Lieux : </b></td><td><p>"+lieu+"</p></td>"); 
            }

}
 /* $(document).ready(function(){
	
   
		
    });*/
// ----------------------------------------end détail

// ------------------------------------------modifier:

function hideDivModif() { 
location.reload();
    if (document.getElementById) { // DOM3 = IE5, NS6 
        document.getElementById('repm').style.visibility = 'hidden'; 
		
    } else { 
        if (document.layers) { // Netscape 4 
            document.repm.visibility = 'hidden'; 
			
        } else { // IE 4 
            document.all.repm.style.visibility = 'hidden'; 
			
        } 
    } 
}

function showDivModif(a,b,c,d,e,f,g,h) { 

var ref=a ;		 		
 
var sujet="<p> "+ b +"  </p>";
 
var nom="<p> "+ c +"  </p>";
 //
var date_envoi="<p> "+ d +"  </p>";		
 
var type_envoi="<p> "+ e +"  </p>";		
 
var titre=g;	
var lieu=f;  		
var message=h ;	 	

    if (document.getElementById) { // DOM3 = IE5, NS6 
        document.getElementById('repm').style.visibility = 'visible'; 
    } else { 
        if (document.layers) { // Netscape 4 
            document.repm.visibility = 'visible'; 
        } else { // IE 4 
            document.all.repm.style.visibility = 'visible'; 
        } 
    }  
			document.getElementById('ref_h').value = a;
            $("#sujet_m").append(sujet);
            $("#nom_m").append(nom);
            $("#date_envoi_m").append(date_envoi);
            $("#type_envoi_m").append(type_envoi);
            
            if (titre == ""){
                $("#titre_m").append("");
            }else{
                $("#titre_m").append(titre); 
            }

            if (lieu == ""){
                $("#lieux_m").append("");
            }else{
                $("#lieux_m").append("<td><b>Lieux : </b></td><td><p>"+lieu+"</p></td>"); 
            }

}

  /*$(document).ready(function(){
	
      
		
    });*/
	
$(document).ready(function(){
   $("#vider").click(function(){
     $("#titre_m" ).empty();
   });
});

// -------------------------------end modifier
// --------------------------------Supprimer:
function hideDivSupri() { 
location.reload();
    if (document.getElementById) { // DOM3 = IE5, NS6 
        document.getElementById('reps').style.visibility = 'hidden'; 
		
    } else { 
        if (document.layers) { // Netscape 4 
            document.reps.visibility = 'hidden'; 
			
        } else { // IE 4 
            document.all.reps.style.visibility = 'hidden'; 
			
        } 
    } 
}

function showDivSupri(a,b,c,d,e,f,g,h){ 

var ref=a ;		 		
 
var sujet="<p> "+ b +"  </p>";
 
var nom="<p> "+ c +"  </p>";
 //
var date_envoi="<p> "+ d +"  </p>";		
 
var type_envoi="<p> "+ e +"  </p>";		
 
var titre=g;	
var lieu=f;  		
var message=h ;	  		
	
   if (document.getElementById) { // DOM3 = IE5, NS6 
        document.getElementById('reps').style.visibility = 'visible'; 
    } else { 
        if (document.layers) { // Netscape 4 
            document.reps.visibility = 'visible'; 
        } else { // IE 4 
            document.all.reps.style.visibility = 'visible'; 
        } 
    }  
	
	
			document.getElementById('ref_h_s').value = a;
			$("#sujet_s").append(sujet);
            $("#nom_s").append(nom);
            $("#date_envoi_s").append(date_envoi);
            $("#type_envoi_s").append(type_envoi);
            
            if (titre == ""){
                $("#titre_s").append("");
            }else{
                $("#titre_s").append("<td><b>Commentaire : </b></td><td><p>"+titre+"</p></td>"); 
            }

            if (lieu == ""){
                $("#lieux_s").append("");
            }else{
                $("#lieux_s").append("<td><b>Lieux : </b></td><td><p>"+lieu+"</p></td>"); 
            }
       
}
//------------------

$(document).ready(function(){
   $("#annuler").click(function(){
      $("#reps").hide();
    location.reload();
   });
});
	

//-----------------


  $(document).ready(function(){
  
       $("#fermer").click(function(){
            $("#rep").hide();
            location.reload();
        });
	
        $("#fermers").click(function(){
            $("#reps").hide();
            location.reload();
        });
		
		  $("#fermerm").click(function(){
            $("#repm").hide();
            location.reload();
        });
		
    });
	


//-------------------end supprimer





  
</script>


<div id="rep"  style="visibility: hidden;" ><div id="fils_dossier">
        <div id="fade_dossier"></div>
        <div class="popup_block_dossier" style="width: 560px; z-index: 999; top: 10%; left: 25%;">
            <div class="titleBar_dossier">
                <div class="title_dossier">Détail de statut </div>
                <a href="javascript:hideDivDetai()" id="fermer"><div class="close_dossier" style="cursor: pointer;">close</div></a>
            </div>
            <div id="content_dossier" class="content_dossier" style="height: 100%;">
			
                    <table border="0" cellspacing="0" cellpadding="2" align="center" width="100%">
					
                        <tr>
                            <td width="30%"> </td>
                            <td width="70%" id="ref"></td>
                        </tr>
                        <tr>
                            <td ><b>Nom et Prenom: </b></td>
                            <td id="nom"></td>
                        </tr>
                        <tr>
                            <td ><b>Statut : </b></td>
                            <td id="sujet"></td>
                        </tr>
                        <tr>
                            <td ><b>Date d’envoi : </b></td>
                            <td id="date_envoi"></td>
                        </tr>
                        <tr>
                            <td ><b>Utilisateur : </b></td>
                            <td id="type_envoi"></td>
                        </tr>
                        <tr id="lieux"></tr> 
                        <tr id="titre"></tr> 
						
                        <tr>
                            <td colspan="2">
                                <div class="ligneBleu"></div>
                               
                            </td>
                        </tr>
						
                    </table>
				 </div>	
            </div>
        </div>
    </div>
    <!--Fin POPUP-->
	<!--POPUP MODIFIER-->
	<div id="repm"  style="visibility: hidden;" ><div id="fils_dossier">
        <div id="fade_dossier"></div>
        <div class="popup_block_dossier" style="width: 560px; z-index: 999; top: 10%; left: 25%;">
            <div class="titleBar_dossier">
                <div class="title_dossier">Modification du commentaire </div>
                <a href="javascript:hideDivModif()" id="fermerm"><div class="close_dossier" style="cursor: pointer;">close</div></a>
            </div>
            <div id="content_dossier" class="content_dossier" style="height: 100%;">
			
         <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table border="0" cellspacing="0" cellpadding="2" align="center" width="100%">
					
                        <tr>
							
                            <td width="30%"> <input type="hidden" value="" name="ref_h" id="ref_h"></td>
							
                            <td width="70%" id="ref"></td>
                        </tr>
                        <tr>
                            <td ><b>Nom et Prenom: </b></td>
                            <td id="nom_m"></td>
                        </tr>
                        <tr>
                            <td ><b>Statut : </b></td>
                            <td id="sujet_m"></td>
                        </tr>
                        <tr>
                            <td ><b>Date d’envoi : </b></td>
                            <td id="date_envoi_m"></td>
                        </tr>
                        <tr>
                            <td ><b>Utilisateur : </b></td>
                            <td id="type_envoi_m"></td>
                        </tr>
                        <tr id="lieux_m"></tr> 
          				<tr>
						<td ><b>Commentaire : </b></td>
						<td>
						<TEXTAREA name="titre_m" id="titre_m" rows=4 cols=40></TEXTAREA>
						<br/>
						<INPUT TYPE="submit" NAME="modifier" VALUE="Modifier" class="espace_candidat">
							
						<INPUT TYPE="reset" NAME="vider" id="vider" VALUE=" Vider " class="espace_candidat">
							
								
						</td>
						</tr> 
						
                        <tr>
                            <td colspan="2">
                                <div class="ligneBleu"></div>
                               
                            </td>
                        </tr>
						
                    </table>
				</form>
			</div>	
        </div>
    </div>
	
	<!--POPUP supprimer-->
	
	<div id="reps"  style="visibility: hidden;" ><div id="fils_dossier">
        <div id="fade_dossier"></div>
        <div class="popup_block_dossier" style="width: 560px; z-index: 999; top: 10%; left: 25%;">
            <div class="titleBar_dossier">
                <div class="title_dossier">Suppression de l'action </div>
                <a href="javascript:hideDivSupri()" id="fermers"><div class="close_dossier" style="cursor: pointer;">close</div></a>
            </div>
            <div id="content_dossier" class="content_dossier" style="height: 100%;">
			
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table border="0" cellspacing="0" cellpadding="2" align="center" width="100%">
                        <tr>
						 <input type="hidden" value="" name="ref_h_s" id="ref_h_s">
                            <td width="30%"> </td>
                            <td width="70%" id="ref"></td>
                        </tr>
                        <tr>
                            <td ><b>Nom et Prenom: </b></td>
                            <td id="nom_s"></td>
                        </tr>
                        <tr>
                            <td ><b>Statut : </b></td>
                            <td id="sujet_s"></td>
                        </tr>
                        <tr>
                            <td ><b>Date d’envoi : </b></td>
                            <td id="date_envoi_s"></td>
                        </tr>
                        <tr>
                            <td ><b>Utilisateur : </b></td>
                            <td id="type_envoi_s"></td>
                        </tr>
                        <tr id="lieux_s"></tr> 
                        <tr id="titre_s"></tr> 
						
						 <tr>
                            <td colspan="2"style="text-align:center;"><b>Voulez vous vraimment supprimer cette action ? </b></td>
                          
                        </tr>
						<br/>
						<br/>
						 <tr>
						 <td colspan="2" style="text-align:center;">
                            <INPUT TYPE="submit" NAME="supprimer" VALUE="Supprimer" class="espace_candidat">
						
                            <INPUT TYPE="reset" NAME="annuler" id="annuler" VALUE=" Annuler" class="espace_candidat">
							</td>
                        </tr>
						
                        <tr>
                            <td colspan="2">
                                <div class="ligneBleu"></div>
                               
                            </td>
                        </tr>
                    </table>
				</form>
            </div>
        </div>
    </div>

