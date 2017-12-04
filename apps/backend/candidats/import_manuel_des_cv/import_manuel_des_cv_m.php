    <div class="texte"><br/>

    <h1>IMPORT MANUEL DES CVS</h1>

    <br>                

<div>

<?php 

if(isset($_GET['e']) and $_GET['e']!='')  { 

$messages  = $_SESSION['msg_erreur_impcv'] ;

if(isset($messages) and !empty($messages))  {

foreach ($messages as $message) ?>

        <?php echo $message; ?>

<?php }

} ?>

<form action="<?php  echo $urlad_cand  ?>/import_manuel_des_cv/import_manuel_des_cv_info/" method="post" 

enctype="multipart/form-data" >

<div style="width: 715px; height: 30px; " >

<label for="file" style="" >Téléchargement de fichier:</label> 

<input type="file"  name="file" id="file" title="veuillez selectionnez CV" required accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf" />

<input type="submit" name="submit" class="espace_candidat" value="Importer"  >

<br>Taille maximale (en kilo-octets): 1000

</form>

</div>

<br><br>

<iframe src="<?php echo $imgurl ?>/logocv.jpg" style="width:715px; height:220px;" 

frameborder="100"></iframe>

<br><br>

</div>