<?php 
 /* */
 session_start();
 
require(dirname(__FILE__) . "/../../../../../config/config.php");

    $result_unique =  array_keys(array_flip($_POST['select_candidat'])); 
		for ($i = 0; $i < count($result_unique); $i++){	
				echo "<br>test : ".$result_unique[$i]."<br>"; 
				$id_cd_cv = explode("_", $result_unique[$i]);
					$var_id_cand =$id_cd_cv[0];  
					$var_id_cv =$id_cd_cv[1];
					echo "<br>link : ".$urladmin.'/cv/dcv/?cv='.$var_id_cv.'&id_candidat='.$var_id_cand.'&id_cv=' . $var_id_cv . "<br>"; 
					header('Location: '.$urladmin.'/cv/dcv/?cv='.$var_id_cv.'&id_candidat='.$var_id_cand.'&id_cv=' . $var_id_cv . '  ');
					
					if(!empty($var_id_cand)  ){
					$s_sql="UPDATE candidats SET vues=vues+1 WHERE candidats_id='".$var_id_cand."'";
					$upd=mysql_query($s_sql);
					}

					if (!empty($var_id_cv)) {	  $chmm=$var_id_cv;

					   $fichier=dirname(__FILE__).$file_cv3.$chmm;
					   $fp = fopen($fichier,"r" ); 
					   $buff = ""; 
						if(filesize($fichier) > 0){
						$buff = fread($fp,filesize($fichier));
							
							} if($upd){
						   header("Content-Type: application/x-octet-stream\n" ); header( "Content-Disposition: attachment;filename=$chmm" );
							  header('Pragma: no-cache'); header('Expires: 0');  echo $buff;fclose($fp); 
						}
							  
							}
			} 
							/*
    $affected = 0;

 
    
	
$id_list='';
    $result_unique =  array_keys(array_flip($_POST['select_candidat'])); 
		for ($i = 0; $i < count($result_unique); $i++){	
				echo "<br>test : ".$result_unique[$i]."<br>"; 
				$id_cd_cv = explode("_", $result_unique[$i]);
					$var_id_cand =$id_cd_cv[0];  
					$var_id_cv =$id_cd_cv[1];
					echo "<br>link : ".$urladmin.'/cv/dcv/?cv='.$var_id_cv.'&id_candidat='.$var_id_cand.'&id_cv=' . $var_id_cv . "<br>"; 
					header('Location: '.$urladmin.'/cv/dcv/?cv='.$var_id_cv.'&id_candidat='.$var_id_cand.'&id_cv=' . $var_id_cv . '  ');
					
					if(!empty($var_id_cand)  ){
					$s_sql="UPDATE candidats SET vues=vues+1 WHERE candidats_id='".$var_id_cand."'";
					$upd=mysql_query($s_sql);
					}

					if (!empty($var_id_cv)) {	  $chmm=$var_id_cv;

					   $fichier=dirname(__FILE__).$file_cv3.$chmm;
					   $fp = fopen($fichier,"r" ); 
					   $buff = ""; 
						if(filesize($fichier) > 0){
						$buff = fread($fp,filesize($fichier));
							
							} if($upd){
						   header("Content-Type: application/x-octet-stream\n" ); header( "Content-Disposition: attachment;filename=$chmm" );
							  header('Pragma: no-cache'); header('Expires: 0');  echo $buff;fclose($fp); 
						}
							  
							}
			} 
 
							//*/
							
							
							/*
if(isset($_GET["id_candidat"]) and $_GET["id_candidat"]!=''){
$s_sql="UPDATE candidats SET vues=vues+1 WHERE candidats_id='".$_GET["id_candidat"]."'";
$upd=mysql_query($s_sql);
}

if (isset($_GET["cv"])) {	  $chmm=$_GET["cv"];

   $fichier=dirname(__FILE__).$file_cv3.$chmm;
   $fp = fopen($fichier,"r" ); 
   $buff = ""; 
    if(filesize($fichier) > 0){
	$buff = fread($fp,filesize($fichier));
		
		} if($upd){
       header("Content-Type: application/x-octet-stream\n" ); header( "Content-Disposition: attachment;filename=$chmm" );
          header('Pragma: no-cache'); header('Expires: 0');  echo $buff;fclose($fp); 
    }
          
        } 	
							//*/
?> 