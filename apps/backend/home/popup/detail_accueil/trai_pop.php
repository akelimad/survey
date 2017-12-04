

<script language="javascript">



function hideDiv() { 

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

 

function showDiv(a,b,c,d,e,f,g,h,k) { 



var ref="<p> "+ a +"  </p>";

var nom="<p> "+ b +"  </p>";

var offe="<p> "+ c +"  </p>";

var action="<p> "+ d +"  </p>";

var dd="<p> "+ e +"  </p>";

var da="<p> "+ f +"  </p>";

var email1="<p> "+ g +"  </p>";

var tel1="<p> "+ h +"  </p>";

var mssg="<p> "+ k +"  </p>";



    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('rep').style.visibility = 'visible'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.rep.visibility = 'visible'; 

        } else { // IE 4 

            document.all.rep.style.visibility = 'visible'; 

        } 

    }  

           $("#offe").append(offe);

            $("#action").append(action);

            $("#nom").append(nom);

            $("#dd").append(dd);

            

			$("#da").append(da);

			$("#email1").append(email1);

            $("#tel1").append(tel1);

            $("#mssg").append(mssg);

}





    $(document).ready(function(){

	   $("#fermer1").click(function(){ 

            document.getElementById('rep').style.visibility = 'hidden'; 

            location.reload();

        }); 

    });

</script>





<div id="rep"  style="visibility: hidden;" ><div id="fils_dossier">

        <div id="fade_dossier"></div>

        <div class="popup_block_dossier" style="width: 560px; z-index: 999; top: 10%; left: 25%;">

            <div class="titleBar_dossier">

                <div class="title_dossier"> Status de candidature  </div>

                <a href="<?php echo $_SERVER['REQUEST_URI']; ?>"><div class="close_dossier" style="cursor: pointer;">close</div></a>

            </div>

            <div id="content_dossier" class="content_dossier" style="height: 100%;">

			

                    <table border="0" cellspacing="0" cellpadding="2" align="center" width="100%">

 

                        <tr>

                            <td width="30%" ><b>Nom et prenom : </b></td>

                            <td width="70%" id="nom"></td>

                        </tr>

                        <tr>

                            <td ><b>Email : </b></td>

                            <td id="email1"></td>

                        </tr>

                        <tr>

                            <td ><b>Téléphone: </b></td>

                            <td  id="tel1"></td>

                        </tr>

                        <tr>

                            <td ><b>Titre de poste : </b></td>

                            <td id="offe"></td>

                        </tr>

                        <tr>

                            <td ><b>Status : </b></td>

                            <td id="action"></td>

                        </tr>

                        <tr>

                            <td ><b>Date de mofication : </b></td>

                            <td id="dd"></td>

                        </tr>

                        <tr>

                            <td ><b>Lieux </b></td>

                            <td id="da"></td>

                        </tr>

		 

                        <tr>

                            <td ><b>Message </b></td>

                            <td id="mssg"></td>

                        </tr>

						

						

                        

						

                    </table>

				 </div>	

            </div>

        </div>

    </div>

    <!--Fin POPUP-->

