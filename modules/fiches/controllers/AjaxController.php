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

    Ajax::add('cand_note_orale_popup', [$this, 'showNoteOralePopup']);
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

    $db = getDB();

    $candidature = $db->prepare("
      SELECT cand.id_candidature AS cid, cand.id_offre, concat(c.nom, ' ', c.prenom) AS displayName 
      FROM candidats c 
      JOIN candidature AS cand ON cand.candidats_id=c.candidats_id 
      WHERE cand.id_candidature=?
    ", [$data['candidatures'][0]], true);

    if( empty($candidature) ) return [];

    // Check if offre has a fiche
    $fiche_offre = $db->prepare("SELECT f.name, f.id_fiche FROM fiche_offre fo JOIN fiches f ON f.id_fiche=fo.id_fiche WHERE f.fiche_type=? AND fo.id_offre=?", [1, $candidature->id_offre], true);

    $fiche_candidature = $db->prepare("SELECT id_fiche_candidature, comments FROM fiche_candidature WHERE id_fiche=? AND id_candidature=? AND id_evaluator=?", [$fiche_offre->id_fiche, $candidature->cid, read_session('id_role')], true);

    if( !isset($fiche_offre->id_fiche) ) {
      return [
        'status' => 'error',
        'title' => 'Fiche introuvable !',
        'message' => 'Il y a aucune fiche attaché à cet offre.'
      ];
    }

    ob_start();
    get_view('admin/fiche/popup/evaluation', [
      'candidature' => $candidature,
      'fiche_candidature' => $fiche_candidature,
      'fiche_type' => 1,
      'id_fiche' => $fiche_offre->id_fiche,
      'name' => 'Fiches d\'evaluation ('.$fiche_offre->name.')'
    ], __FILE__);
    $content = ob_get_clean();

    return ['content' => $content, 'title' => 'FICHES D\'EVALUATION'];
  }
  


  /**
   * Show note orale popup
   * 
   * @author M'hamed Chanchaf
   */
  public function showNoteOralePopup($data)
  {
    if( empty($data['id_candidature']) ) return [];

    $candidature = getDB()->findOne('candidature', 'id_candidature', $data['id_candidature']);

    if( !isset($candidature->id_candidature) ) return [];

    $table = (new TableController() )->getNoteOraleTable();

    $content  = '<input type="hidden" id="note_id_candidature" value="'.$candidature->id_candidature.'">' ;
    $content .= $table->render(false);

    return ['content' => $content, 'title' => 'Historique de fiches d\'evaluation'];
  }


} // END Class