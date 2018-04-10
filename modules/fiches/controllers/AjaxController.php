<?php
/**
 * AjaxController
 *
 * @author mchanchaf
 *
 * @package modules.fiches.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Fiches\Controllers;

use App\Ajax;
use Modules\Fiches\Models\Fiche;

class AjaxController
{

  private static $_instance = null;


  public function __construct()
  {
    Ajax::add('fiche_evaluation_popup', [$this, 'showFicheEvaluationPopup']);

    Ajax::add('cand_note_orale_popup', [$this, 'showNoteOralePopup']);

    Ajax::add('cand_show_fiche_details', [$this, 'showFicheDetails']);
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

    if( !isset($fiche_offre->id_fiche) ) {
      return [
        'status' => 'error',
        'title' => trans("Aucune fiche n'a été attaché à cette offre.")
      ];
    }

    $fiche_candidature = $db->prepare("SELECT id_fiche_candidature, comments FROM fiche_candidature WHERE id_fiche=? AND id_candidature=? AND id_evaluator=?", [$fiche_offre->id_fiche, $candidature->cid, read_session('id_role')], true);

    ob_start();
    get_view('admin/fiche/popup/evaluation', [
      'candidature' => $candidature,
      'fiche_candidature' => $fiche_candidature,
      'fiche_type' => 1,
      'id_fiche' => $fiche_offre->id_fiche,
      'name' => rans("Fiches d'evaluation:") .' ('.$fiche_offre->name.')'
    ], __FILE__);
    $content = ob_get_clean();

    return ['content' => $content, 'title' => trans("FICHES D'EVALUATION")];
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

    return ['content' => $content, 'title' => trans("Historique de fiches d'evaluation")];
  }
  

  /**
   * Show Fiche Details
   * 
   * @author M'hamed Chanchaf
   */
  public function showFicheDetails($data)
  {
    if( !isset($data['key']) || !isset($data['value']) ) return [];

    $db = getDB();


    $fiche_candidature = $db->prepare("SELECT * FROM fiche_candidature WHERE {$data['key']}=?", [$data['value']], true);


    if( !isset($fiche_candidature->id_fiche_candidature) ) return [];


    $candidature = $db->prepare("
      SELECT cand.id_candidature AS cid, cand.id_offre, concat(c.nom, ' ', c.prenom) AS displayName 
      FROM candidats c 
      JOIN candidature AS cand ON cand.candidats_id=c.candidats_id 
      WHERE cand.id_candidature=?
    ", [$fiche_candidature->id_candidature], true);

    if( empty($candidature) ) return [];

    $fiche_type = Fiche::getTypeById($fiche_candidature->id_fiche);

    // Check if offre has a fiche
    $fiche_offre = $db->prepare("SELECT f.name, f.id_fiche FROM fiche_offre fo JOIN fiches f ON f.id_fiche=fo.id_fiche WHERE f.fiche_type=? AND fo.id_offre=?", [$fiche_type, $candidature->id_offre], true);

    return $this->renderAjaxView(
      'Détails de la fiche', 
      'admin/candidature/popup/fiche-details', [
        'candidature' => $candidature,
        'fiche_candidature' => $fiche_candidature,
        'id_fiche' => $fiche_offre->id_fiche,
        'fiche_type' => $fiche_type,
        'name' => Fiche::getTypeName($fiche_type) .'&nbsp;('.$fiche_offre->name.')'
    ]);
  }


  private function renderAjaxView($title, $viewPath, $variables=[])
  {
    ob_start();
    get_view($viewPath, $variables, __FILE__);
    $content = ob_get_clean();
    return ['content' => $content, 'title' => $title];
  }


} // END Class