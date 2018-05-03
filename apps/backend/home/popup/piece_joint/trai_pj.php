

<?php  





if(isset($_POST['envoi_trait_pj_down'])){

 





			$id_candidature = isset($_POST['id_candidature'])  ? $_POST['id_candidature'] : "";

			$pj = isset($_POST['pj'])  ? $_POST['pj'] : "";

			

					$re_postit = mysql_query(" SELECT * FROM postit WHERE id_candidature='".$id_candidature."' ");

					if($postit01 = mysql_fetch_assoc($re_postit)){ $postit_c=$postit01['postit']; }

					$piece_j = $postit01['piece_j'] ; $piece_j1 = $postit01['piece_j1'] ; $piece_j2 = $postit01['piece_j2'] ; $piece_j3 = $postit01['piece_j3'] ; $piece_j4 = $postit01['piece_j4'] ; 

			  

			  if($pj=='1') $up_pj=$piece_j; if($pj=='2') $up_pj=$piece_j1;  if($pj=='3') $up_pj=$piece_j2;  if($pj=='4') $up_pj=$piece_j3;  if($pj=='5') $up_pj=$piece_j4; 

			  

			  

				if (header('Location: down_postit.php?id='.$up_pj.'')){				

					$msg_pop = '<p style=color:#09B34D>Votre action a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s !</p>';

				}else{	

					$msg_pop = '<p style=color:#CC0000>Une erreur est survenu veillez recommencer plus tard</p>';

				}

				

			

	//***************************************************************************************************************************************//

				

				

				

				$show= '	<div id="trait_pj"><div id="fils"> <div id="fade" style="background: #000; " ></div>';

				$show.='<div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%; overflow:auto" >';

				//$show.='<div class="titleBar">  <a href="javascript:fermer()">	  <div class="close" style="cursor: pointer;">close</div></a></div>'; 

				$show.='<div id="content" align="center" class="content" style=" height: 42px; "> <h3>'.$msg_pop.'</h3>  </div></div></div> </div>';  

			 	$show.='  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '].'" />   ';	

				

				

				echo $show;				

  

}





if(isset($_POST['envoi_trait_pj_sup'])){ 





			$id_candidature = isset($_POST['id_candidature'])  ? $_POST['id_candidature'] : "";

			$pj = isset($_POST['pj'])  ? $_POST['pj'] : "";

			

			

			$up_pj='';

			

			if($pj=='1') $up_pj=" piece_j='' "; if($pj=='2') $up_pj=" piece_j1='' ";  if($pj=='3') $up_pj=" piece_j2='' ";  if($pj=='4') $up_pj=" piece_j3='' ";  if($pj=='5') $up_pj=" piece_j4='' "; 

			 	 				

					$sql_2=" UPDATE postit SET   ".$up_pj."  WHERE id_candidature='$id_candidature' ";	

					

				echo $sql_2;

				$sql_up=mysql_query($sql_2);

			$msg_pop='';

				if ($sql_up){				

					$msg_pop = '<p style=color:#09B34D>Votre action a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s !</p>';

				}else{	

					$msg_pop = '<p style=color:#CC0000>Une erreur est survenu veillez recommencer plus tard</p>';

				}

				

			

	//***************************************************************************************************************************************//

				

				

				

				$show= '	<div id="trait_pj"><div id="fils"> <div id="fade" style="background: #000; " ></div>';

				$show.='<div class="popup_block"   style="width: 25%; z-index: 999; top: 30%; left: 40%; overflow:auto" >';

				//$show.='<div class="titleBar">  <a href="javascript:fermer()">	  <div class="close" style="cursor: pointer;">close</div></a></div>'; 

				$show.='<div id="content" align="center" class="content" style=" height: 42px; "> <h3>'.$msg_pop.'</h3> </div></div></div> </div>';  

			 	$show.='  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '].'" />   ';	

				

				

				echo $show;				

 //}	

}					



	?>



 <script>

   

function hideDiv4() { 

    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('trait_pj').style.visibility = 'hidden'; 

		// Lorsque le textarea perdra le focus 

		    

		

    } else { 

        if (document.layers) { // Netscape 4 

            document.trait_pj.visibility = 'hidden'; 

        } else { // IE 4 

            document.all.trait_pj.style.visibility = 'hidden'; 

        } 

    } 

	

            location.reload();

}

 

function showDiv4(a,b,c) { 



var rel1=a; 

var rel2=b;  

var rel3=c;  







    if (document.getElementById) { // DOM3 = IE5, NS6 

        document.getElementById('trait_pj').style.visibility = 'visible'; 

    } else { 

        if (document.layers) { // Netscape 4 

            document.trait_pj.visibility = 'visible'; 

        } else { // IE 4 

            document.all.trait_pj.style.visibility = 'visible'; 

        } 

    } 

	  

            var id_candidat = '<input type="hidden" value="'+rel1+'" name="id_candidature" />';

            $("#id_candidat001").append(id_candidat);

            var pj = '<input type="hidden" value="'+rel2+'" name="pj" />';

            $("#pj").append(pj);

			 var btnpj = '<a href="../../popup/piece_joint/down_postit.php?id='+rel3+'" title="Voir la pièce jointe 1" style="border-style: outset;background-color: yellowgreen;padding: 1px 15px;" > Télécharger </a>';

            $("#btnpj").append(btnpj);

            

           

 

} 

				

			 

	

</script>

<!--  Début POPUP  -->

<?php

 

 

 

 ?>



<div id="trait_pj"  style="visibility: hidden;">

	<div id="fils">

        <div id="fade_dossier"></div>

        <div class="popup_block" style="width: 250px; z-index: 999; top: 50%; left: 45%;">

            <div class="titleBar">

                <div class="title">Action</div>

                <a onClick="location.reload()" id="fermer"><div class="close" style="cursor: pointer;">close</div></a>

            </div>

			

            <div id="content" class="content" style=" height: 50px; ">

                <form action="<?php echo $_SERVER['REQUEST_URI'];  ?>" id="form_trait_pj" method="post" enctype="multipart/form-data" >  

                            <div id="msg"></div> 

                            <div id="id_candidat001"></div>  

                            <div id="pj"></div>  

							<div style="float:left">							

								<div id="btnpj" style="    margin-top: 4px;"></div>   </div>	

							<div style="float:right">

                                <input name="envoi_trait_pj_sup" type="submit" value="Supprimer" style="width: 100px;background-color: darkgoldenrod;" />

                            </div>	 

                </form>

			</div>

				

        </div>

	</div>

</div>



    <!--Fin POPUP-->

	