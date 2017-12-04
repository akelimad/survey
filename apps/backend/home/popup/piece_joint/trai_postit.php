

<?php  





if(isset($_POST['envoi_postit'])){



 $dossier = dirname(__FILE__) . $file_candidature_up;





			$id_candidature = isset($_POST['id_candidature'])  ? $_POST['id_candidature'] : "";

			$c_postit = isset($_POST['c_postit'])  ? $_POST['c_postit'] : "";

			 

			$vr= rand(0, 99999) ;

			//==========================================================================================================

			//Testons si le fichier a bien ete envoye et s'il n'y a pas d'erreur

			$infosfichier1='';

			//*

			

			

			if (isset($_FILES['monfichier1']) AND $_FILES['monfichier1']['error'] == 0);

			 

					{

				  //Testons si le fichier n'est pas trop gros

					if ($_FILES['monfichier1']['size'] <=3000000)

					{

				  //Testons si l'extension est autorisée

					$infosfichier = pathinfo($_FILES['monfichier1']['name']);

					$extension_upload = $infosfichier['extension'];		

					$ptmp = $_FILES['monfichier1']['name'];

					$ext_p = '';//pathinfo($_FILES['monfichier1']['name'] , PATHINFO_EXTENSION);	

					if($ptmp!='')   $infosfichier1=$id_candidature.'1'.$vr.$ptmp;

					$extensions_autorisees = array('txt','pdf','doc','docx','jpg', 'jpeg', 'gif', 'png','');

					if (in_array($extension_upload, $extensions_autorisees))

					{

				  //on peut valider le fichier et le stocker definitivement

				  copy($_FILES['monfichier1']['tmp_name'], $dossier . $infosfichier1 );

				  echo "l'envoi a bien ete effectue !"; 

					}

				  } 

				}  

				 

			//*/

			//==========================================================================================================

			//==========================================================================================================

			//Testons si le fichier a bien ete envoye et s'il n'y a pas d'erreur

			$infosfichier2='';

			//*

			//if( isset($_POST['envoi']) ) {

			

			if (isset($_FILES['monfichier2']) AND $_FILES['monfichier2']['error'] == 0);

			 

					{

				  //Testons si le fichier n'est pas trop gros

					if ($_FILES['monfichier2']['size'] <=3000000)

					{

				  //Testons si l'extension est autorisée

					$infosfichier = pathinfo($_FILES['monfichier2']['name']);

					$extension_upload = $infosfichier['extension'];		

					$ptmp = $_FILES['monfichier2']['name'];

					$ext_p = ''; 					

				    if($ptmp!='')  $infosfichier2=$id_candidature.'2'.$vr.$ptmp;

					$extensions_autorisees = array('txt','pdf','doc','docx','jpg', 'jpeg', 'gif', 'png','');

					if (in_array($extension_upload, $extensions_autorisees))

					{

				  //on peut valider le fichier et le stocker definitivement

				  copy($_FILES['monfichier2']['tmp_name'], $dossier . $infosfichier2 );

				  echo "l'envoi a bien ete effectue !"; 

					}

				  } 

				}  

				 

			//*/

			//==========================================================================================================

			//==========================================================================================================

			//Testons si le fichier a bien ete envoye et s'il n'y a pas d'erreur

			$infosfichier3='';

			//*

			

			

			if (isset($_FILES['monfichier3']) AND $_FILES['monfichier3']['error'] == 0);

			 

					{

				  //Testons si le fichier n'est pas trop gros

					if ($_FILES['monfichier3']['size'] <=3000000)

					{

				  //Testons si l'extension est autorisée

					$infosfichier = pathinfo($_FILES['monfichier3']['name']);

					$extension_upload = $infosfichier['extension'];		

					$ptmp = $_FILES['monfichier3']['name'];

					$ext_p = ''; 					

				    if($ptmp!='')  $infosfichier3=$id_candidature.'3'.$vr.$ptmp;

					$extensions_autorisees = array('txt','pdf','doc','docx','jpg', 'jpeg', 'gif', 'png','');

					if (in_array($extension_upload, $extensions_autorisees))

					{

				  //on peut valider le fichier et le stocker definitivement

				  copy($_FILES['monfichier3']['tmp_name'], $dossier . $infosfichier3 );

				  echo "l'envoi a bien ete effectue !"; 

					}

				  } 

				}  

				 

			//*/

			//==========================================================================================================

			//==========================================================================================================

			//Testons si le fichier a bien ete envoye et s'il n'y a pas d'erreur

			$infosfichier4='';

			//* 

			

			if (isset($_FILES['monfichier4']) AND $_FILES['monfichier4']['error'] == 0);

			 

					{

				  //Testons si le fichier n'est pas trop gros

					if ($_FILES['monfichier4']['size'] <=3000000)

					{

				  //Testons si l'extension est autorisée

					$infosfichier = pathinfo($_FILES['monfichier4']['name']);

					$extension_upload = $infosfichier['extension'];		

					$ptmp = $_FILES['monfichier4']['name'];

					$ext_p = ''; 			

				    if($ptmp!='')  $infosfichier4=$id_candidature.'4'.$vr.$ptmp;

					$extensions_autorisees = array('txt','pdf','doc','docx','jpg', 'jpeg', 'gif', 'png','');

					if (in_array($extension_upload, $extensions_autorisees))

					{

				  //on peut valider le fichier et le stocker definitivement

				  copy($_FILES['monfichier4']['tmp_name'], $dossier . $infosfichier4 );

				  echo "l'envoi a bien ete effectue !"; 

					}

				  } 

				}  

				 

			//*/

			//==========================================================================================================

			//==========================================================================================================

			//Testons si le fichier a bien ete envoye et s'il n'y a pas d'erreur

			$infosfichier5='';

			//* 

			

			if (isset($_FILES['monfichier5']) AND $_FILES['monfichier5']['error'] == 0);

			 

					{

				  //Testons si le fichier n'est pas trop gros

					if ($_FILES['monfichier5']['size'] <=3000000)

					{

				  //Testons si l'extension est autorisée

					$infosfichier = pathinfo($_FILES['monfichier5']['name']);

					$extension_upload = $infosfichier['extension'];		

					$ptmp = $_FILES['monfichier5']['name'];

					$ext_p = ''; 			

				    if($ptmp!='')  $infosfichier5=$id_candidature.'5'.$vr.$ptmp;

					$extensions_autorisees = array('txt','pdf','doc','docx','jpg', 'jpeg', 'gif', 'png','');

					if (in_array($extension_upload, $extensions_autorisees))

					{

				  //on peut valider le fichier et le stocker definitivement

				  copy($_FILES['monfichier5']['tmp_name'], $dossier . $infosfichier5 );

				  echo "l'envoi a bien ete effectue !"; 

					}

				  } 

				}  

				 

			//*/

			//==========================================================================================================

			

			$up_pj='';

			if($infosfichier1!='') $up_pj.="piece_j='$infosfichier1',";if($infosfichier2!='') $up_pj.="piece_j1='$infosfichier2',";if($infosfichier3!='') $up_pj.="piece_j2='$infosfichier3',";if($infosfichier4!='') $up_pj.="piece_j3='$infosfichier4',";if($infosfichier5!='') $up_pj.="piece_j4='$infosfichier5',";

			$up_pj01=substr($up_pj, 0, -1);

					$re_postit = mysql_query(" SELECT * FROM postit WHERE id_candidature='$id_candidature' ");

					if($postit01 = mysql_fetch_assoc($re_postit)){ 

					

					 			

					$sql_2=" UPDATE postit SET  postit='', ".$up_pj01."  WHERE id_candidature='$id_candidature' ";	 				

					 

					} else {

					$date_i = gmdate("Y-m-d H:i:s");

					 

					$sql_2="INSERT INTO postit VALUES ('','".safe($id_candidature)."','".safe($c_postit)."','".safe($date_i)."','".safe($infosfichier1)."','".safe($infosfichier2)."','".safe($infosfichier3)."','".safe($infosfichier4)."','".safe($infosfichier5)."')";	

					

					}

					 

				echo "<br>".$sql_2."<br>";

				$sql_up=mysql_query($sql_2); 

				

			$msg_pop='';

				if ($sql_up){				

					$msg_pop = '<p style=color:#09B34D>Votre action a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s !</p>';

				}else{	

					$msg_pop = '<p style=color:#CC0000>Une erreur est survenu veillez recommencer plus tard</p>';

				}

				

			

	//***************************************************************************************************************************************//

				

				

				

				$show= '	<div id="postit"><div id="fils"> <div id="fade" style="background: #000; " ></div>';

				$show.='<div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%; overflow:auto" >';

				//$show.='<div class="titleBar">  <a href="javascript:fermer()">	  <div class="close" style="cursor: pointer;">close</div></a></div>'; 

				$show.='<div id="content" align="center" class="content" style=" height: 42px; "> <h3>'.$msg_pop.'</h3>'.$mail_msg.' </div></div></div> </div>';  

			 	$show.='  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '].'" />   ';	

				

				

				echo $show;				 

}					



	?>



 <script>

   

function hideDiv3() { 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('postit').style.visibility = 'hidden'; 

		// Lorsque le textarea perdra le focus

		    

			  $("#txt_postit").removeChild(this);

		    

		

    } else { 

        if (document.layers) { // Netscape 4 

            document.postit.visibility = 'hidden'; 

        } else { // IE 4 

            document.all.postit.style.visibility = 'hidden'; 

        } 

    } 

	

            location.reload();

}

 

function showDiv3(a,b) { 



var rel1=a; 

var rel2=b;







    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('postit').style.visibility = 'visible'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.postit.visibility = 'visible'; 

        } else { // IE 4 

            document.all.postit.style.visibility = 'visible'; 

        } 

    } 

	  

            var id_candidat = '<input type="hidden" value="'+rel1+'" name="id_candidature" />';

            $("#id_candidat01").append(id_candidat); 

            var txt_postit = '<textarea name="c_postit" id="c_postit" onclick="modify(this);" style="background-color:rgb(222, 255, 155); width: 99%; height: 100px; cursor:pointer;">'+rel2+'</textarea> ';

            $("#txt_postit").append(txt_postit);

           

 

} 

				

				 

	

</script>

<!--  Début POPUP  -->

<?php

 

 

 

 ?>



<div id="postit"  style="visibility: hidden;">

	<div id="fils">

        <div id="fade_dossier"></div>

        <div class="popup_block" style="width: 460px; z-index: 999; top: 10%; left: 25%;">

            <div class="titleBar">

                <div class="title">Post-it</div>

                <a onClick="location.reload()" id="fermer"><div class="close" style="cursor: pointer;">close</div></a>

            </div>

			

            <div id="content" class="content" style=" height: 145px; ">

                <form action="<?php echo $_SERVER['REQUEST_URI'];  ?>" id="form_postit" method="post" enctype="multipart/form-data" >  

                            <div id="msg"></div> 

                            <div id="id_candidat01"></div>   

							<div >

							<strong>Fichier joint 1:</strong></span>

      <input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="monfichier1" type="file" size="16"> <span class="Style15"><strong>(8Mo Maximum)</strong>

							 </div>	

							<div >

							<strong>Fichier joint 2:</strong></span>

      <input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="monfichier2" type="file" size="16"> <span class="Style15"><strong>(8Mo Maximum)</strong>

							 </div>	

							<div >

							<strong>Fichier joint 3:</strong></span> 

      <input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="monfichier3" type="file" size="16"> <span class="Style15"><strong>(8Mo Maximum)</strong>

							 </div>	

							<div >

							<strong>Fichier joint 4:</strong></span> 

      <input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="monfichier4" type="file" size="16"> <span class="Style15"><strong>(8Mo Maximum)</strong>

							 </div>	

							<div >

							<strong>Fichier joint 5:</strong></span> 

      <input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="monfichier5" type="file" size="16"> <span class="Style15"><strong>(8Mo Maximum)</strong>

							 </div>	

							 <div class="ligneBleu"></div>

							<div >

                                <input name="envoi_postit" type="submit" value="Valider" class="espace_candidat" />

                            </div>	 

                </form>

			</div>

				

        </div>

	</div>

</div>



    <!--Fin POPUP-->

	