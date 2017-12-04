<?php 


session_start();

$msg_alert ='';

    require_once(dirname(__FILE__) . "/../../../config/config.php");
 
	 if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['pass']) && !empty($_POST['pass'])) {
	 
 
    session_unset();
    session_destroy();

    session_start();
	    $login = $_POST['login'];
        $pass = md5($_POST['pass']); 
        $sql = mysql_query(" SELECT * from liste_stage where login = '$login' and pass = '$pass' LIMIT 0 , 1 ");
		$role = mysql_fetch_assoc($sql);
		//echo $login;
        //echo $pass;
    if($role)
    {

    if(($role['login']==$login) and ($role['pass']==$pass))
    {

            session_start();
            $_SESSION['abb_admin_stage'] = $login;   
			$_SESSION['id_stg']	= $role['id_stage'];  		
            
            header("Location: ./candidature_stage/");
    }
    
    }else{
        $messages=array();
$msgs ="<div class='alert alert-error'>
<ul><li style='color:#FF0000'>Votre Email et/ou votre mot de passe est incorrect !</li></ul>
</div>";
array_push($messages,$msgs);
    }
    
		
		
	 }	
	 $ariane="Utilisateur > Authentification  ";	
	 
?>