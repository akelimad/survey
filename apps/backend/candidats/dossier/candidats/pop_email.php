<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <title>Document sans nom</title></head><body><script language="javascript">            $(document).ready(function(){                $('#form_pop_mail').submit(function(){                    var variable = $(this).serialize();                    $.ajax({                 		type: 'POST',                        url: 'mail_envoie.php',                        data:  variable,              		success: function(msg){                        	                            if(msg=="vide")                            {                     		$('#msg').empty();                                $('#msg').append('<p style=color:#CC0000>Remplissez tous les champs SVP</p>');                     		}							                            else                            {			                                if(msg=="ok")                		{                              		$('#msg').empty();                                    $('#msg').append('<p style=color:#009900>Email envoy� avec succ�s</p>');             		$("#repertoire").fadeIn("slow");                                                       		}                                                       		else                                {                                    $('#msg').empty();                              		$('#msg').append('<p style=color:#CC0000>Une erreur est survenu veillez recommencer plus tard</p>');                          		}                            }				                        }                                            });					  		return false;		                });	                $("#fermer").click(function(){	                    $("#repertoire").hide();                    		});                           $(".email").click(function(){                               		var titre=$(this).attr('rel');           			var nometprenom=$(this).attr('rel1');             		var ht = "<input name='email' type='hidden' style='width:250px' value='"+ titre +"' readonly='readonly'/>";            			var ht1 = "<p> "+ nometprenom +"<p/>"; 		$("#champ_email").html(ht);         $("#nom_prenom").html(ht1);         $("#repertoire").show();                return false;              });            });    		</script> <div id="repertoire" style="display:none" >  <div id="fils">    <div id="fade"></div>    <div class="popup_block" style="width: 500px; z-index: 999; top: 30%; left: 32%;">      <div class="titleBar">        <div class="title">Formulaire de contact des candidats</div>        <a id="fermer">        <div class="close" style="cursor: pointer;">close</div>        </a> </div>      <div id="content" class="content" style=" height: 310px; ">        <form action="" id="form_pop_mail" method="post">          <table border="0" cellspacing="0" cellpadding="2" align="center">            <tr>              <th scope="row" colspan="2" align="center"><div align="left">Envoie d'email: </div></th>            </tr>            <tr>              <td colspan="2"><div id="msg">                <div></td>            </tr>            <tr>              <td><b>&Agrave;:</b></td>			   <td id="nom_prenom"></td>              <td id="champ_email"></td>            </tr>            <tr>              <td><b>Objet:</b></td>              <td><input name="subject" type="text" style="width:250px"/></td>            </tr>            <tr>              <td><b>Message</b></td>              <td><textarea name="message" id="editor1" cols="29" rows="14" style=" width: 252px; "></textarea>               </td>            </tr>            <tr>              <td colspan="2"><input name="envoyer" type="submit" value="envoyer" /></td>            </tr>          </table>        </form>      </div>    </div>  </div></div><!--Fin POPUP--></body></html>