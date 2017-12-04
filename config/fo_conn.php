<?php 

//premier visiteur
    session_start(); 
 ob_start();
 
     require dirname(__FILE__) . "/config.php";

 

//traiteiement session 				 

if (isset($_GET['action']) && $_GET['action'] == 'logout') { 

			if(isset($_SESSION['abb_id_candidat']) and $_SESSION['abb_id_candidat']!=''){
            mysql_query("INSERT INTO `his_connexion`(  `id_log`, `login`,  `action`, `type_connexion`) VALUES ( '" . $_SESSION['abb_id_candidat'] . "','" . $_SESSION['abb_login_candidat'] . "', 'deconnexion',0)");
			}
			
			if(isset($_SESSION['id_role']) and $_SESSION['id_role']!=''){
            mysql_query("INSERT INTO `his_connexion`(  `id_log`, `login`,  `action`, `type_connexion`) VALUES (  '" . $_SESSION['id_role'] . "','" . $_SESSION['abb_admin'] . "', 'deconnexion',1)");
			}
			
    session_unset();

    session_destroy();

    header("location: ".$site." ");

} 



//traitment desaction compte

if (isset($_POST['oui']) || isset($_POST['non'])) // Si les variables existent

    {

         if (isset($_POST['oui']))  {

         $displayerror = false;    

        $_SESSION['abb_login_candidat'] =   $_SESSION['login_candidat_desactive'] ;

        $_SESSION['abb_nom'] = $_SESSION['nom_desactive'];

        $_SESSION['abb_id_candidat'] =$_SESSION['id_candidat_desactive'];

        $last_connexion = date('Y-m-d');

        mysql_query("UPDATE candidats SET last_connexion = '$last_connexion' , status=1 WHERE candidats_id = '".$_SESSION['abb_id_candidat'] ."'");

            if(isset($_SESSION["url"]) && $_SESSION["url"] != "")

                header("Location: ".$_SESSION["url"]) ; 

            else

                header("Location: ./") ; 

         }

          if (isset($_POST['non']))  {

                header("Location: ./candidat/inscription/") ;

         }

    unset($_SESSION['login_candidat_desactive']) ;

    unset($_SESSION['nom_desactive']);

    unset($_SESSION['id_candidat_desactive']); 

    }

//fin code

    $compte_desactive = false;

    if (isset($_POST['login']) && isset($_POST['pass'])) {

        $login = $_POST['login'];

        $pass = md5($_POST['pass']);

        //modification ajouter par mohamed status = 1 pour le cas des comptes desactives

		$sql = mysql_query("SELECT * from candidats where  email = '".safe($login)."' AND mdp = '".safe($pass)."' and status=1");

        $numrows = mysql_num_rows($sql);

		if ($numrows) {

            $data = mysql_fetch_array($sql);

            $_SESSION['abb_id_candidat'] = $data['candidats_id'];

            $_SESSION['abb_login_candidat'] = $login;

            $_SESSION['abb_nom'] = $data['prenom'] . '&nbsp;' . $data['nom'];

            $last_connexion = date('Y-m-d');

            mysql_query("UPDATE candidats SET last_connexion = '$last_connexion' WHERE candidats_id = '" . $data['candidats_id'] . "'");
			
            mysql_query("INSERT INTO `his_connexion`(  `id_log`, `login`,  `action`, `type_connexion`) VALUES ( '" . $_SESSION['abb_id_candidat'] . "','" . $_SESSION['abb_login_candidat'] . "', 'connexion',0)");

        }
 
    }

    ob_end_flush();
?>