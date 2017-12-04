<script language="javascript">
    $(document).ready(function(){
        $('#form_pop_status').submit(function(){
            var variable = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'state.php',
                data:  variable,
                success: function(msg){
                    if(msg=="vide")
                    {
                        $('#msg').empty();
                        $('#msg').append('<p style=color:#CC0000>Remplissez tous les champs SVP</p>');
                    }
                    else
                    {			
                        if(msg=="ok")
                        {
                            $('#msg').empty();	
                            $('#msg').append('<h3>Commentaire ajouté avec succès</h3>');
                            $("#repertoire").fadeIn("slow"); 
                        }
                        else
                        {
                            if(msg=="ok")
                            {
                                $('#msg').empty();	
                                $('#msg').append('<h3>Commentaire ajouté avec succès</h3>');
                                $("#repertoire").fadeIn("slow"); 
                            }
                            else
                            {
                                $('#msg').empty(); 
                                $('#msg').append(msg);
                            }
                        }
                    }				
                }
            });
            return false;
        });
        $("#fermer").click(function(){
            $("#repertoire").hide();
            location.reload();
        });
        $(".email").click(function(){
		
            $("#repertoire_dossier").hide();
			
            var titre=$(this).attr('rel');
            var ht = "<p> "+ titre +" </p>";
            $("#champ_email").append(ht);
            var rel2=$(this).attr('rel2');
            var id_candidat = '<input type="hidden" value="'+rel2+'" name="id_candidature" />';
            $("#id_candidat").append(id_candidat);
            var rel4=$(this).attr('rel4');
            date_modification = rel4;
            $("#date_modification").append(date_modification);
            $("#repertoire").show();
            return false;
        });
    });
</script> 
<div id="repertoire" style="display:none" ><div id="fils">
        <div id="fade"></div>
        <div class="popup_block" style="width: 560px; z-index: 999; top: 10%; left: 25%;">
            <div class="titleBar">
                <div class="title">Formulaire d'édition de statut de la candidature</div>
                <a id="fermer"><div class="close" style="cursor: pointer;">close</div></a>
            </div>
            <div id="content" class="content">
                <form action="" id="form_pop_status" method="post">
                    <table border="0" cellspacing="0" cellpadding="2" align="center">
                        <tr>
                            <td colspan="2">
                                <div id="msg"></div>
                            </td>
                        </tr>
                        <tr>
                            <td width="38%"><b>Nom et prénom du candidat : </b></td>
                            <td id="champ_email"></td>
                            <td id="id_candidat"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="subscription" style="margin: 10px 0pt;">
                                    <h1>Commentaire sur la candidature</h1>
                                </div>
                            </td>
                        </tr>		                     
                        <tr>
                            <td width="35%"><b>Date de modification </b></td>
                            <td id="date_modification"></td>
                            <td width="15%">
                                <span style="color:#000000;font-weight:normal">
                                </span>
                                <Br>
                                <Br>
                                <Br>
                            </td>
                        </tr> 
                        <tr>
                            <td valign="top"><b>Commentaire</b></td>
                            <td style="height:100px">
                                <textarea name="commentaire" id="editor1" style="height:30px"></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace( 'editor1',
                                    {
                                        enterMode : CKEDITOR.ENTER_DIV,
                                        entities: false,
                                        entities_additional : '',
                                        toolbar : 'Basic',
                                        resize_enabled : false
                                    });
                                </script>
                            </td>		
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="subscription" style="margin: 10px 0pt;">
                                    <h1>Statut de la candidature</h1>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%"><b>Statut</b></td>
                            <td width="75%">
                                <select name="status" id="status">
                                    <option value=""></option>
                                    <option value="Appel telephonique" <?php if ($_GET['stat'] == 'tel') echo 'selected'; ?>>Appel téléphonique</option>
                                    <option value="Convocation entretien" <?php if ($_GET['stat'] == 'entretien') echo 'selected'; ?>>Convocation entretien</option>
                                    <option value="A recontacter" <?php if ($_GET['stat'] == 'recontact') echo 'selected'; ?>>A recontacter</option>
                                    <option value="A rencontrer" <?php if ($_GET['stat'] == 'rencontre') echo 'selected'; ?>>A rencontrer</option>
                                    <option value="Candidature transmise" <?php if ($_GET['stat'] == 'transmis') echo 'selected'; ?>>Candidature transmise</option>
                                    <option value="Retenu" <?php if ($_GET['stat'] == 'tel') echo 'retenus'; ?>>Retenu</option>
                                    <option value="Non retenu" <?php if ($_GET['candidature'] == 'refus') echo 'selected'; ?>>Non retenu</option>
                                    <option value="Non retenu" <?php if ($_GET['candidature'] == 'refus') echo 'selected'; ?>>Non retenu</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="ligneBleu"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input name="envoi" type="submit" value="Valider" style="width:170px" />
                            </td>	
                            <td>
                                <input name="" type="reset" style="width:170px"/>
                            </td>
                        </tr>					  
                    </table>
                </form>
            </div>
        </div>
    </div>
    <!--Fin POPUP-->