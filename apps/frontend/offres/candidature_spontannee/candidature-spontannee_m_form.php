
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="form_standard" method="post" >
						
<table style="width: 690px;">
<tr> 
<td colspan="5" valign="top" >Choisissez un CV :   <font style="color:red;">*</font></td>
<td colspan="9" >
<select  id="cv" name="cv"  style="width:400px;">
<?php 
$select_cv_principale= mysql_query("select * from cv where candidats_id = '".safe($_SESSION['abb_id_candidat'])."' AND actif=1 AND principal=1");
$cv_principale = mysql_fetch_array($select_cv_principale);
$succes = mysql_num_rows($select_cv_principale);
if($succes)
$cv1 = $cv_principale['id_cv'];
 else
$cv1= "";
$select_model=mysql_query("select * from cv  where candidats_id='".safe($_SESSION['abb_id_candidat'])."'  AND actif=1");
while($cv2 = mysql_fetch_array($select_model))
 {
if($cv1 == $cv2['id_cv'] )  $selected =  "selected";
else $selected =  "";
echo "<option value='".$cv2['id_cv']."'     ".$selected."     >".$cv2['titre_cv']."</option>";
}
?>
</select>
</td>
</tr>
<tr>
    <td><br></td><td><br></td>
</tr>
<tr>
<td colspan="5" valign="top">Vos motivations: <font style="color:red;">*</font>
<br/>
</td>
<td colspan="9">
<textarea name="motivation" id="editor2" cols="60" rows="40"  style="width: 398px;  height: 200px;resize: none;" required></textarea>
<script type="text/javascript">
CKEDITOR.replace( 'editor2',
                                {  width: '398px' 
                                });
 </script>
</td>
</tr>
<tr>
<td colspan="8">
<div class="ligneBleu"></div>
<p style="color:#CC0000">
            P.S: les champs marqu&eacute;s par (*) sont obligatoires
</p>
<div style="float: left;"> <input name="send" type="submit" value="Envoyer ma candidature" class="espace_candidat" /></div>
</td>
</tr>
</table>
						</form>