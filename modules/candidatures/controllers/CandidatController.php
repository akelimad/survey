<?php
/**
 * CandidatController
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use App\Models\Resume;
use App\Models\MotivationLetter;

class CandidatController
{


  /**
   * Download candidat CV
   * 
   * @param int $id_cv
   * @author M'hamed Chanchaf
   */
  public function actionCv($id_cv)
  {
  	if( !isLogged('admin') ) redirect( site_url('backend/login') );
    $cv = Resume::getByID($id_cv);
    if (!isset($cv->lien_cv) || empty($cv->lien_cv)) {
      die("Impossible de trouvez ce CV.");
    }
    $cvPath = site_base('apps/upload/frontend/cv/'. $cv->lien_cv);
    if(file_exists($cvPath)) {
	    header("Content-Description: Téléchargement de CV"); 
	    header("Content-Type: application/octet-stream"); 
	    header("Content-Disposition: attachment; filename=". basename($cvPath));
	    readfile($cvPath);
	    exit;
    } else {
      die("Impossible de trouvez ce CV.");
    }
  }


  /**
   * Download candidat lettre
   * 
   * @param int $id_lettre
   * @author M'hamed Chanchaf
   */
  public function actionLettre($id_lettre)
  {
  	if( !isLogged('admin') ) redirect( site_url('backend/login') );
    $lettre = MotivationLetter::getByID($id_lettre);
    if (!isset($lettre->lettre) || empty($lettre->lettre)) {
      die("Impossible de trouvez ce CV.");
    }
    $lettrePath = site_base('apps/upload/frontend/lmotivation/'. $lettre->lettre);
    if(file_exists($lettrePath)) {
	    header("Content-Description: Téléchargement de lettre de motivation"); 
	    header("Content-Type: application/octet-stream"); 
	    header("Content-Disposition: attachment; filename=". basename($lettrePath));
	    readfile($lettrePath);
	    exit;
    } else {
      die("Impossible de trouvez cette lettre de motivation.");
    }
  }




  
} // END Class