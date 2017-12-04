<?php


/* fin modifier probléme signalé*/ 
$requet='';
$query = "SELECT * FROM root_signale_prob_r  WHERE  id_prob ='".$id_action."'  ORDER BY  `date_rprob` DESC";
$req  =  mysql_query($query);
$cc = mysql_num_rows($req);
if($cc){  
mysql_data_seek($req,0);$jj=00;
while($return = mysql_fetch_array($req))
{
$userrole = "SELECT * FROM root_roles  WHERE  id_role ='".$return['id_user']."' ";
$requserrole  =  mysql_query($userrole);
$returnrole = mysql_fetch_array($requserrole);
?>
<!-- -->
<!-- -->
<div style="width:100%; display:inline-table;">
    <div style="width:25%; display:inline-table;">
        <p><b>Utilisateur</b></p>
        <p><b>Status</b></p>
        <p><b>Pourcentage</b></p>
    </div>
    <div style="width:25%; display:inline-table;">
        <p><b><?php echo $returnrole['nom']; ?></b></p>
        <p>
            <?php 
            if($return['status'] =='0'){echo "<b style=\"color:red\">En attente</b>";}
            elseif($return['status'] =='1'){echo "<b style=\"color:#F4702B\">En traitement</b>";}
            elseif($return['status'] =='2'){echo "<b style=\"color:green\">Fermer</b>";}
            ?>
        </p>
        <p><b><?php echo $return['pour']." %"; ?></b></p>
    </div>
    <div style="width:25%; display:inline-table;">
        <p><b>Date envoi</b></p>
        <p><b>Titre</b></p>
        <p><b>Message</b></p>
    </div>
    <div style="width:25%; display:inline-table;">
        <p><b><?php echo $return['date_rprob']; ?></b></p>
        <p><b><?php echo $return['titre']; ?></b></p>
        <p><b><?php echo couperChaine(strip_tags($return['msg']), 10, 10); ?></b>
            <a class="info1" href="#" onclick="return false">
                <i class="fa fa-external-link"></i>
                <span style="width:450px;padding:6px;word-wrap: break-word; "> 
                <b><?php echo $return['msg']; ?></b> 
                </span>
            </a>
        </p>
    </div>
<?php if($return0['etape'] !='2') { ?>
<div style="float:right">
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="form2" name="formulaire<?php echo ++$jj; ?>">
<input type="hidden" name="id_rprob" value="<?php echo $return['id_rprob'] ?>" />
<input type="hidden" name="titre" value="<?php echo $return['titre'] ?>" /> 
<input type="hidden" name="pour" value="<?php echo $return['pour'] ?>" /> 
<input type="hidden" name="msg" value="<?php echo $return['msg'] ?>" /> 
<input type="hidden"  id="edit" name="edit"  value=""   title="Edit ce message" class="cu" /> 
<a href="#" onclick="formulaire<?php echo $jj; ?>.submit()" title="modifier" >
<i class="fa fa-pencil-square-o fa-fw fa-lg"></i> </a>

<a href="<?php echo $_SERVER['REQUEST_URI']; ?>&id_p=<?php echo $return['id_rprob']; ?>"  title="Supprimer">
<i class="fa fa-trash-o fa-lg" style="color:#DB1212;"></i>
</a>
</form>
</div>
<?php } ?>
</div>
<div class="ligneBleu"></div>
<!-- -->
<?php }
}else{  ?><center> <p>Aucune réponse</p> </center>        <?php }    ?>  
<!-- -->
<?php      
if(isset($_GET['id_p']) && $_GET['id_p']!='')  {
//echo $_GET['id_p'];
$id = $_GET['id_p']; 
if (mysql_query("delete from root_signale_prob_r  where id_rprob='$id'")) { 
    echo '<script type="text/javascript">alert("Suppression avec succès");window.location="./?id_action='.$id_action.'";</script>'; 
} else {
    echo '<script type="text/javascript">alert("Une erreur est survenue lors de la suppression "); window.location="../";</script>'; 
} 
} 
?> 