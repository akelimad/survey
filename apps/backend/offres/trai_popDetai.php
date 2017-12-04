

<script language="javascript">



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

 

function showDivDetai(a,b,c,d,e,f,g) { 



var ref=a ;		 		

 

var sujet="<p> "+ b +"  </p>";

 

var nom="<p> "+ c +"  </p>";

 //

var date_envoi="<p> "+ d +"  </p>";		

 

var type_envoi="<p> "+ e +"  </p>";		

 

var titre="<p> "+ f +"  </p>";			

var message=g ;	 	



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

            $("#titre").append(titre); 

			

			

}





    $(document).ready(function(){

	

        $("#fermer").click(function(){

            $("#rep").hide();

            location.reload();

        });

		

    });

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

                            <td ><b>Nom et Prénom: </b></td>

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

                        <tr>

                            <td ><b>Commentaire : </b></td>

                            <td id="titre"></td>

                        </tr> 

						

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

