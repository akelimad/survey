<?php
/**
 * AjaxController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.fiches.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Fiches\Controllers;

use App\Ajax;

class AjaxController
{

  private static $_instance = null;


  public function __construct()
  {
    Ajax::add('fiche_evaluation_popup', [$this, 'showFicheEvaluationPopup']);
  }
  

  public static function getInstance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self;
    }
    return self::$_instance;
  }


  /**
   * Show change status
   * 
   * @author M'hamed Chanchaf
   */
  public function showFicheEvaluationPopup($data)
  {
    if( empty($data['candidatures']) ) return [];

    $candidature = getDB()->prepare("
      SELECT cand.id_candidature AS cid, concat(c.nom, ' ', c.prenom) AS displayName 
      FROM candidats c 
      JOIN candidature AS cand ON cand.candidats_id=c.candidats_id 
      WHERE cand.id_candidature=?
    ", [$data['candidatures'][0]], true);

    if( empty($candidature) ) return [];

    ob_start();
    get_view('admin/fiche/popup/evaluation', [
      'candidature' => $candidature,
      'fiche_type' => 1,
      'name' => 'Fiches d\'evaluation'
    ], __FILE__);
    $content = ob_get_clean();

    return ['content' => $content, 'title' => 'FICHES D\'EVALUATION'];
  }
  


} // END Class