<?php
use App\Permission;

// Désactiver DEPRECATED ERROR 
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Site base uri
define('SITE_BASE', dirname(__DIR__));

// Include bootstrap
include_once SITE_BASE .'/config/bootstrap.php';

$GLOBALS['etalent'] = new \stdClass;

// Get root configuration
$reponse = getDB()->prepare('SELECT * from root_configuration', [], true);
$nom_site            = $reponse->nom_site;
$seo_description     = $reponse->seo_description;
$seo_keywords        = $reponse->seo_keywords;
$banniere            = "/".$reponse->banniere;
$logo                = "/".$reponse->logo;
$titre_site          = $reponse->titre_site;
$fb_url              = $reponse->fb_url;
$tw_url              = $reponse->tw_url;
$li_url              = $reponse->li_url;
$via_url             = $reponse->via_url;
$site_url            = $reponse->site_url;
$date_expiration_off = $reponse->duree_offres;
$color_bg_body       = $reponse->color_bg_body;
$color_bg            = $reponse->color_bg;
$color_bg_menu       = $reponse->color_bg_menu;
$info_contact        = $reponse->email_site;

// Get website configuartion
$prm_config = getDB()->prepare('SELECT * from prm_config', [], true);
$nom_serveur         = $prm_config->nom_serveur;
$nom_user            = $prm_config->nom_user;
$password            = $prm_config->password;
$nom_bdd             = $prm_config->nom_bdd;
$lien_google_d       = $prm_config->lien_google_d;
$app_id_fb           = $prm_config->app_id_fb;
$app_secret_fb       = $prm_config->app_secret_fb;
$site_e              = $prm_config->site_e;
$email_e             = $prm_config->email_e;
$variable_r          = $prm_config->variable_r;

$GLOBALS['etalent']->config = array_merge((array)$prm_config, (array)$reponse);
$GLOBALS['etalent']->settings = [];
$GLOBALS['etalent']->site =  [];

// Redirect to backend homepage
if (isBackend() && \App\Route::getRoute() != 'backend/login') {
	$ips = get_setting('admin_whitelist_ip_addresses', null);
	if (!empty($ips)) {
		$ips = explode(',', str_replace(' ', '', $ips));
		if (!in_array(getRealIpAddr(), $ips)) {
			set_flash_message('warning', 'Vous n\'avez pas les permissions pour accèder à cette page.');
			$logout = (new \App\Controllers\Admin\AuthController())->logout([]);
		}
	} elseif (\App\Route::getRoute() == 'backend/logout' || !isLogged('admin')) {
		$logout = (new \App\Controllers\Admin\AuthController())->logout([]);
	} else if (!Permission::canViewPage()) {
		redirect('backend/accueil/');
	}
}

define('SITE_NAME', $nom_site);
define('SITE_EMAIL', $info_contact);

// Get site url
$url                 = SITE_URL;
$rep_path            = $variable_r;
$site_url_lycom      = $site_e; 

// google Analytics
$conf_login          = '';
$conf_pass           = '';
$conf_profileId      = '';     
  
// lien pour lecture de document par :google viewer . ( %3A == :  )    ( 2F% == /  )
$google_doc = "http://docs.google.com/viewer?url=http%3A%2F%2F".$lien_google_d."%2Fbackend%2Fcv_import_uploads%2F";

// Facebook API
$app_id                  = $app_id_fb;
$app_secret              = $app_secret_fb;

// configuration emails
$conf_admin_email        = $email_e; 
$admin_email             = $email_e; // email admin
$conf_admin_email_s_prob = 'hamza.idrissi@gmail.com,karim.idrissi@idcgroup.ca,karim.idrissi@hec.ca,dev2@lycom.ma'; 
$conf_info_email_contact = $email_e;
$conf_signature_email    = 'E-etalent';

// Website URL
$site = $site1 = SITE_URL;

// Assets urls
$cssurl               = $site."assets/css";
$jsurl                = $site."assets/js";
$imgurl               = $site."assets/images";
$imgurlban            = $site."assets/images/bannier";

// directoriers path
$url_photo_candidat   = $site."apps/upload/frontend/photo_candidats/";
$url_photo_offres     = $site."apps/upload/backend/offres/";

$file_photos          = '/../../apps/upload/frontend/photo_candidats/';
$file_cv              = '/../../apps/upload/frontend/cv/';
$file_lm              = '/../../apps/upload/frontend/lmotivation/'; 
$file_probleme        = '/../../apps/upload/frontend/signale_probleme/';

$file_photos2         = '/../../../apps/upload/frontend/photo_candidats/';
$file_cv2             = '/../../../apps/upload/frontend/cv/';
$file_lm2             = '/../../../apps/upload/frontend/lmotivation/';
$file_probleme2       = '/../../../apps/upload/frontend/signale_probleme/';

$file_photos3         = '/../../../../apps/upload/frontend/photo_candidats/';
$file_cv3             = '/../../../../apps/upload/frontend/cv/';
$file_lm3             = '/../../../../apps/upload/frontend/lmotivation/';
$file_probleme3       = '/../../../../apps/upload/frontend/signale_probleme/';

$file_photos4         = '/../../../../../apps/upload/frontend/photo_candidats/';
$file_cv4             = '/../../../../../apps/upload/frontend/cv/';
$file_lm4             = '/../../../../../apps/upload/frontend/lmotivation/';
$file_probleme4       = '/../../../../../apps/upload/frontend/signale_probleme/';

$file_dwn_cv_mass     = '/../../apps/upload/frontend/dwn_cv_mass/'; 
$file_dwn_cv_mass2    = '/../../../apps/upload/frontend/dwn_cv_mass/'; 
$file_dwn_cv_mass3    = '/../../../../apps/upload/frontend/dwn_cv_mass/'; 
$file_dwn_cv_mass4    = '/../../../../../apps/upload/frontend/dwn_cv_mass/'; 

$file_bnr             = '/../../../assets/images/bannier/';
$file_bnr2            = '/../../../../assets/images/bannier/';

$file_candidature_up  = '/../../apps/upload/backend/candidature_uploads/';
$file_cv_import       = '/../../apps/upload/backend/cv_import_uploads/';
$file_courrier        = '/../../apps/upload/backend/upload_courrier/';
$file_upload_pj       = '/../../apps/upload/frontend/signale_probleme/';
$file_offres          = '/../../apps/upload/backend/offres/';

$file_candidature_up2 = '/../../../apps/upload/backend/candidature_uploads/';
$file_cv_import2      = '/../../../apps/upload/backend/cv_import_uploads/';
$file_courrier2       = '/../../../apps/upload/backend/upload_courrier/';
$file_upload_pj2      = '/../../../apps/upload/frontend/signale_probleme/';
$file_offres2         = '/../../../apps/upload/backend/offres/';
 
$file_candidature_up3 = '/../../../../apps/upload/backend/candidature_uploads/';
$file_cv_import3      = '/../../../../apps/upload/backend/cv_import_uploads/';
$file_courrier3       = '/../../../../apps/upload/backend/upload_courrier/';
$file_upload_pj3      = '/../../../../apps/upload/frontend/signale_probleme/';
$file_offres3         = '/../../../../apps/upload/backend/offres/';

$urlhome              = site_url();
$urloffre             = $urlhome ."offres";
$urlcandidat          = $urlhome ."candidat";
$urlinfos             = $urlhome."infos";

$urladmin             = $urlhome ."backend";
$urlad_offr           = $urlhome ."backend/offres";
$urlad_cand           = $urlhome ."backend/candidats";
$urlad_candatur       = $urlhome ."backend/candidatures";
$urlad_repor          = $urlhome ."backend/reporting";
$urlad_coresp         = $urlhome ."backend/courriers";
$urlad_admi           = $urlhome ."backend/administration";

$incurl               = '/../../../lib/include';
$tempurl              = '/../../../lib/template';
$menuurl              = '/../../../lib/menu';

$incurl2              = '/../../../../lib/include';
$tempurl2             = '/../../../../lib/template';
$menuurl2             = '/../../../../lib/menu';

$incurl3              = '/../../../../../lib/include';
$tempurl3             = '/../../../../../lib/template';
$menuurl3             = '/../../../../../lib/menu';

$incurl4              = '/../../../../../../lib/include';
$tempurl4             = '/../../../../../../lib/template';
$menuurl4             = '/../../../../../../lib/menu';

$tempurladmin         = '/../../lib/template';  

// Temp account 
if(isset( $_SESSION['compte_v']) AND  $_SESSION['compte_v'] > 0) $urlad_candatur = $urlhome ."backend/candidatures_f"; 
 
// Get root parametters
if( \App\Session::get('r_prm_note') == null ) {
	$sql = " SELECT * FROM root_parametrage";
	$select = mysql_query($sql); 
	while( $reponse_prm = mysql_fetch_array($select) ) { 
		$_SESSION[$reponse_prm['ref_r_prm']] = $reponse_prm['etat_r_prm']; 
	}
}

// Set last connexion
if(isset($_SESSION['abb_login_candidat']) and $_SESSION['abb_login_candidat']!=''){
	if((isset($_SESSION['timestamp'])) AND (time() - $_SESSION['timestamp'] > 900)) { 
		if(isset($_SESSION['abb_id_candidat']) and $_SESSION['abb_id_candidat']!=''){
			mysql_query("INSERT INTO `his_connexion` (`id_log`, `login`,  `action`, `type_connexion`) VALUES ('" . $_SESSION['abb_id_candidat'] . "','" . $_SESSION['abb_login_candidat'] . "', 'deconnexion',0)");
		}
		if(isset($_SESSION['id_role']) and $_SESSION['id_role']!=''){
			mysql_query("INSERT INTO `his_connexion` (`id_log`, `login`,  `action`, `type_connexion`) VALUES ('" . $_SESSION['id_role'] . "','" . $_SESSION['abb_admin'] . "', 'deconnexion',1)");
		}
		session_unset();
		session_destroy();
		redirect( site_url() );
	} else {
		$_SESSION['timestamp'] = time();
	}
}

// Candidat auth    
/*$compte_desactive = false;
if (isset($_POST['login']) && isset($_POST['pass'])) {
	$login = $_POST['login']; 
	$pass = md5($_POST['pass']);
	$requet_c = mysql_query("select * from candidats WHERE  email = '".safe($login)."' AND mdp = '".safe($pass)."' AND status=2");  
	$reponse = mysql_fetch_array($requet_c);   

	if(is_array($reponse)) {
		$status_t = $reponse['status'];
		if($status_t=='2') {
			$_SESSION['compte_non_confirm'] = '1';	
			$_SESSION['id_compte_non_confirm'] = $reponse['candidats_id'];
			header("Location: ".$site." ") ; 	 
		}
		if($status_t=='0') {
			$prenom = ucfirst($reponse['prenom']);
			$nom = strtoupper($reponse['nom']); 
			$_SESSION['login_candidat_desactive'] = $login ;
			$_SESSION['nom_desactive'] = $prenom.'&nbsp;'.$nom;
			$_SESSION['id_candidat_desactive'] = $reponse['candidats_id'];
			$compte_desactive = true;
		}
	}
}*/