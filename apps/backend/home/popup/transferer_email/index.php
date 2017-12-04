<?php 
  session_start();


if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {
    header("Location: ../index.php");
}  

$_SESSION['page_courant_t']=$_SERVER['REQUEST_URI'];


    require_once dirname(__FILE__) . "/../../../../../config/config.php";
 
	
	
	$email=(isset($_GET['email'])) ? $_GET['email'] : '' ;
	$cv=(isset($_GET['cv'])) ? $_GET['cv'] : '' ;
	$lm=(isset($_GET['lm'])) ? $_GET['lm'] : '' ;
	
	


	$tmail=(isset($_POST['tmail'])) ? $_POST['tmail'] : '' ;
	
	
?>

<html>
<head>
<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>
<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>  
</head>
<body>

<div id="fils">
<div id="fade" style="background: rgba(0, 0, 0, 1)"></div>
<div class="popup_block" style="width: 470px;/*height: 670px;*/ z-index: 999; top: 10%; left: 30%;">
<div class="titleBar"><div class="title">Transfère le CV par email </div><a href="<?php echo $_SESSION['page_courant '] ; ?>"><div class="close" style="cursor: pointer;">close</div></a></div>

<div id="contenu" class="content" style="width: 460px;height:100%;padding: 5px 0 0 10px;margin: 0;">
  
  
<table>
		<tr><td align="center" valign="bottom"><div id="display"></div></td></tr>                
		<tr><td align="left" valign="bottom">Type Email :<font style="color:red">*</font><br/></td></tr>
		<tr><td align="left" valign="bottom">  
									<form  action="<?php echo $_SERVER['REQUEST_URI']; ?>"  method="POST"> 
                                        <select name="tmail" id="tmail"  style="width:452px" onchange="this.form.submit()" /> 
										<option value=""></option> 
										 <?php  
                                            $req_theme = mysql_query("SELECT * FROM  email_type ");
                                            while ($data = mysql_fetch_array($req_theme)) {
                                             $sf=''; $m_id = $data['id_email']; $obj = $data['titre']; 
												if ($tmail != $m_id)
												$sf = "";
												else
												$sf = ' selected="selected"'; 
                                            echo "<option value=\"$m_id\" " . $sf . ">$obj</option>";
                                            }
                                            ?> 
										</select>  
									</form> 
		</td></tr>   
</table> 
<br>
<div class="ligneBleu" style="    width: 450px;"></div>
<?php

		$r_id = "";		$r_titre = "";		$r_email = "";		$r_pj = "";		$r_obj = "";		$r_msg = "";	

	$tmail=(isset($_POST['tmail'])) ? $_POST['tmail'] : '' ;
	 
if($tmail!='') {	 
//============================================================================================================================== 
		$option_tmail='';		$v='';	 $req_01 = mysql_query( "SELECT * FROM email_type where id_email=".$tmail." ");				
		 $r01 = mysql_fetch_array( $req_01 );				
		$r_id = $r01['id_email'];		$r_titre = $r01['titre'];		$r_email = $r01['email'];		$r_pj = $r01['p_joint'];		
		$r_obj = $r01['objet'];		$r_msg = $r01['message'];	$pj	= $r01['p_joint'];	
//==============================================================================================================================
}
?>
 
<form action="./emailtrans_a.php" method="post" >
<table>
               <tr><td align="center" valign="bottom"><div id="display"></div></td></tr>                                 
			   <tr><td align="left" valign="bottom">Votre email <font style="color:red">*</font> </td></tr>
			   <tr><td align="left" valign="bottom">
			   <input type="text" name="email1" id="email1" value="<?php echo $r_email; ?>"  style="width:450px"/>	  	
			   </td></tr>
			   <tr><td> </td></tr>
			   <tr><td align="left" valign="bottom">Email du destinataire<font style="color:red">*</font> </td></tr>
			   <tr><td align="left" valign="bottom"><input type="text" id="email2" name="email2" value="" style="width:450px" required /></td></tr>
			   <tr><td> </td></tr>
			   <tr><td align="left" valign="bottom">Sujet<font style="color:red">*</font> </td></tr>
			   <tr><td align="left" valign="bottom"> 	<input type="text" id="sujet" name="sujet" value="<?php echo $r_obj; ?>"  style="width:450px"/>	 	</td></tr> 
			   
			   <tr><td colspan="2"> </td></tr>
			   <tr><td align="left" valign="bottom"><i class="fa fa-file-text fa-lg"></i> <?php echo $cv; ?>
			    <input type="hidden" name="cv" id="cv" value="<?php echo $cv; ?>"   /></td> </tr>	<!--disabled-->
				<tr><td colspan="2"></td></tr>
			   <?php if($lm!='') {  ?>
			   <tr><td align="left" valign="bottom"><i class="fa fa-file-text fa-lg"></i> <?php echo $lm; ?>
			    <input type="hidden" name="lm" id="lm" value="<?php echo $lm; ?>"   /></td></tr>
				<?php } ?>
				<tr><td colspan="2"></td></tr>
				<?php if($pj!='') {  ?>
               <tr><td align="left" valign="bottom"><i class="fa fa-file-text fa-lg"></i> <?php echo $pj; ?>
                <input type="hidden" name="pj" id="pj" value="<?php echo $pj; ?>"   /></td> </tr>
			   <tr><td> <br> </td></tr>
               <?php } ?>
			   <tr><td align="left" valign="bottom"><p>Votre message</p>
			   <p><textarea style="width:450px;height: 280px;" name="message" id="message" cols="30" rows="5" ><?php echo $r_msg; ?></textarea>
					<script type="text/javascript">
							CKEDITOR.replace( 'message') 
					</script> </p></td></tr>
			<tr>
				<td>
					<input type="submit" class="espace_candidat"   name="envoyer" value="Envoyer"     />	
				</td>
				<td></td>
			</tr>
</table> 
  

					

</form>

</div>
</div>
</div>


</body>
</html>