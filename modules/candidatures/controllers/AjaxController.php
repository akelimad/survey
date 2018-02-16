<?php
/**
 * AjaxController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use App\Ajax;
use App\Models\Cv;
use App\Media;

class AjaxController
{

  private static $_instance = null;

  private $civilite = array(
    1 => 'M.',
    2 => 'Mlle.',
    4 => 'Mme.'
  );


  public function __construct()
  {
    Ajax::add('cand_filter_form', [$this, 'showCandidaturesFilterForm']);
    Ajax::add('cand_send_email', [$this, 'sendEmail']);
    Ajax::add('cand_type_email', [$this, 'getTypeEmail']);

    Ajax::add('cand_sendemail_popup', [$this, 'showSendEmailPopup']);
    Ajax::add('cand_send_cv_email_popup', [$this, 'showSendCVEmailPopup']);
    Ajax::add('cand_change_status_popup', [$this, 'showChangeSatatusPopup']);
    Ajax::add('cand_attachments_popup', [$this, 'showAttachmentsPopup']);

    Ajax::add('cand_save_attachments', [$this, 'saveAttachement']);
    Ajax::add('cand_save_attachement_title', [$this, 'saveAttachementTitle']);
    Ajax::add('cand_delete_attachement', [$this, 'deleteAttachement']);

    Ajax::add('cand_note_ecrit_popup', [$this, 'showNoteEcritPopup']);

    Ajax::add('cand_share_candidature_popup', [$this, 'showShareCandidaturePopup']);

    Ajax::add('cand_change_offre_popup', [$this, 'showChangeOffrePopup']);
  }
  

  public static function getInstance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self;
    }
    return self::$_instance;
  }



  /**
   * Show Candidatures Filter Form
   * 
   * @author M'hamed Chanchaf
   */
  public function showCandidaturesFilterForm($data)
  {
    ob_start();
    $customFields = (isset($data['fields']) && is_array($data['fields'])) ? json_decode($data['fields'], true) : [];
    $fields = include_once module_base(__FILE__, 'resources/filter-fields.php');
    $fields = array_merge($fields, $customFields);
    $data['fields'] = \etalent_array_sort($fields, 'sortOrder');
    $data['url_params'] = json_decode($data['params'], true);

    get_view('admin/candidature/partials/filter', $data, __FILE__);
    $content = ob_get_clean();
    return ['content' => $content];
  }


  /**
   * Show SendEmail Popup
   * 
   * @author M'hamed Chanchaf
   */
  public function showSendEmailPopup($data)
  {
    if( empty($data['candidatures']) ) return [];
    $cids = "'". implode("','", $data['candidatures']) ."'";
    $candidatures = getDB()->prepare("
      SELECT cand.id_candidature AS cid, c.email 
      FROM candidats c 
      JOIN candidature AS cand ON cand.candidats_id=c.candidats_id 
      WHERE cand.id_candidature IN({$cids})
      ");
    if( empty($candidatures) ) return [];

    return $this->renderAjaxView(
      'Envoyer e-mail au candidat', 
      'admin/candidature/popup/send-mail', [
        'candidatures' => $candidatures
    ]);
  }



  /**
   * Show CV per email Popup
   * 
   * @author M'hamed Chanchaf
   */
  public function showSendCVEmailPopup($data)
  {
    if( empty($data['candidatures']) ) return [];
    $cids = "'". implode("','", $data['candidatures']) ."'";
    $candidature = getDB()->prepare("
      SELECT  cand.*, cand.id_candidature AS cid, c.email 
      FROM candidats c 
      JOIN candidature AS cand ON cand.candidats_id=c.candidats_id 
      WHERE cand.id_candidature=?
      ", [$data['candidatures'][0]], true);
    if( empty($candidature) ) return [
      'status' => 'error',
      'message' => 'Impossible de trouver cette candidature.'
    ];

    $cv = Cv::getByID($candidature->id_cv);
    if( !isset($cv->lien_cv) ) return [
      'status' => 'error',
      'message' => 'Impossible de trouver le CV de ce candidat.'
    ];

    return $this->renderAjaxView(
      'Transfère le cv par email', 
      'admin/candidature/popup/send-mail', [
        'candidatures' => [$candidature],
        'cv_name' => $cv->titre_cv,
        'cv_path' => 'apps/upload/frontend/cv/'.$cv->lien_cv
    ]);
  }


  /**
   * Show attachments popup
   * 
   * @author M'hamed Chanchaf
   */
  public function showAttachmentsPopup($data)
  {
    if( empty($data['candidatures']) ) return [];
    $id_candidature = $data['candidatures'][0];
    $options['currentPage'] = (isset($data['page']) && is_valid_int($data['page'])) ? $data['page'] : 1;
    $table = (new AttachmentController())->getTable($id_candidature, $options);

    return $this->renderAjaxView('Pièces jointes', 'admin/candidature/popup/attachments', [
      'id_candidature' => $id_candidature,
      'table' => $table,
      'currentPage' => $options['currentPage']
    ]);
  }
  

  /**
   * Show change status
   * 
   * @author M'hamed Chanchaf
   */
  public function showChangeSatatusPopup($data)
  {
    if( empty($data['candidatures']) ) return [];

    $candidature = getDB()->prepare("
      SELECT cand.id_candidature AS cid, cand.id_offre, concat(c.nom, ' ', c.prenom) AS displayName, c.email AS candidat_email
      FROM candidats c 
      JOIN candidature AS cand ON cand.candidats_id=c.candidats_id 
      WHERE cand.id_candidature=?
      ", [$data['candidatures'][0]], true);

    if( empty($candidature) ) return [];

    return $this->renderAjaxView(
      'Formulaire d\'édition de statut de la candidature', 
      'admin/candidature/popup/change-status', [
        'candidature' => $candidature,
        'id_statut' => $data['id_statut']
    ]);
  }
  

  /**
   * Show note ecrit popup
   * 
   * @author M'hamed Chanchaf
   */
  public function showNoteEcritPopup($data)
  {
    if( empty($data['id_candidature']) ) return [];

    $candidature = getDB()->findOne('candidature', 'id_candidature', $data['id_candidature']);

    if( !isset($candidature->id_candidature) ) return [];

    return $this->renderAjaxView(
      'Changer la note écrit', 
      'admin/candidature/popup/update-note-ecrit', [
        'id_candidature' => $data['id_candidature'],
        'note_ecrit' => $candidature->note_ecrit
    ]);
  }
  

  /**
   * Show Share Candidature Popup
   * 
   * @author M'hamed Chanchaf
   */
  public function showShareCandidaturePopup($data)
  {
    if( empty($data['candidatures']) ) return [];

    if(isset($data['candidatures']['id_offre']) && !empty($data['candidatures']['id_offre'])) {
      $candidatures = getDB()->findByColumn('candidature', 'id_offre', $data['candidatures']['id_offre']);
      unset($data['candidatures']['id_offre']);
      if(!empty($candidatures)) : foreach ($candidatures as $key => $c) :
        $data['candidatures'][] = $c->id_candidature;
      endforeach; endif;
    }
    return $this->renderAjaxView(
      'Partager les candidatures', 
      'admin/candidature/popup/share-candidatures', [
        'candidatures' => $data['candidatures']
    ]);
  }


  /**
   * Show change offre popup
   * 
   * @author M'hamed Chanchaf
   */
  public function showChangeOffrePopup($data)
  {
    if( !isset($data['id_candidature']) || !isset($data['id_offre'])) return [];

    return $this->renderAjaxView(
      'Changer l\'offre de candidature', 
      'admin/candidature/popup/change-offre', [
        'id_candidature' => $data['id_candidature'],
        'id_offre' => $data['id_offre'],
        'offres' => getDB()->read('offre')
    ]);
  }
  

  /**
   * Get email type
   * 
   * @author M'hamed Chanchaf
   */
  public function getTypeEmail($data)
  {
    if(!isset($data['id_email']) || $data['id_email'] == '') return [];
    return getDB()->findOne('email_type', 'id_email', $data['id_email']);
  }


  /**
   * Send email to candidat
   * 
   * @author M'hamed Chanchaf
   */
  public function sendEmail($data, $args=[])
  {
    if( 
      !isset($data['sender'])   || $data['sender'] == '' ||
      !isset($data['receiver']) || $data['receiver'] == '' ||
      !isset($data['subject'])  || $data['subject'] == '' ||
      !isset($data['message'])  || $data['message'] == ''
    ) return [];

    $message = $data['message'];
    $parts = explode('|', $data['receiver']);
    if( isset($parts[1]) ) {
      $message = $this->renderTemplate($parts[0], $parts[1], $data['message']);
    }

    $attachements = (isset($data['cv_path']) && $data['cv_path']!='') ? [site_base($data['cv_path'])] : [];  
    if(isset($data['attachements']) && is_array($data['attachements'])) {
      $attachements = array_merge($attachements, $data['attachements']);
    }

    $args = array_replace_recursive([
      'isHTML' => true,
      'attachements' => $attachements
    ], $args);
    
    $receiver = (isset($parts[1])) ? $parts[1] : $parts[0];
    return \App\Mail\Mailer::send($receiver, $data['subject'], $data['message'], $args);
  }


  /**
   * upload new attachments
   * 
   * @author M'hamed Chanchaf
   */
  public function saveAttachement($data)
  {
    if( $_FILES['attachments']['size'][0] <= 0 || !isset($data['id_candidature']) ) return [
      'status' => 'error',
      'message' => 'Aucun fichier choisi.',
    ];

    $id_candidature = $data['id_candidature'];

    $upload = Media::upload($_FILES['attachments'], [
      'extensions' => ['jpg', 'gif', 'png', 'doc', 'docx', 'xlsx', 'pdf'],
      'uploadDir' => 'uploads/candidatures/'.$id_candidature.'/attachments/',
    ]);

    $db = getDB();
    if( isset($upload['files']) ) : foreach ($upload['files'] as $key => $file) :

      $date = date("Y-m-d H:i:s");
      $rowData = [
        'id_candidature' => $id_candidature,
        'file_name' => $file,
        'title' => (isset($data['titles'][$key])) ? $data['titles'][$key] : '',
        'created_at' => $date,
        'updated_at' => $date
      ];
      $db->create('candidature_attachments', $rowData);

    endforeach; endif;
    
    return [
      'status' => 'success',
      'message' => 'Les fichiers ont été bien attaché.',
    ];
  }


  /**
   * Save attachments title
   * 
   * @author M'hamed Chanchaf
   */
  public function saveAttachementTitle($data)
  {
    if( 
      (!isset($data['id_attachement']) || $data['id_attachement'] == '') || 
      (!isset($data['title']) || $data['title'] == '')
    ) return [
      'status' => 'error',
      'message' => 'Le titre ne peut pas être vide.'
    ];

    // update attachement
    $updated_at = date("Y-m-d H:i:s");

    getDB()->update('candidature_attachments', 'id_attachment', $data['id_attachement'], [
      'title' => $data['title'],
      'updated_at' => $updated_at
    ]);

    return [
      'status' => 'success',
      'message' => 'Le titre a été bien mise à jour.',
      'updated_at' => date ("d.m.Y H:i", strtotime($updated_at))
    ];
  }


  /**
   * Delete attachments
   * 
   * @author M'hamed Chanchaf
   */
  public function deleteAttachement($data)
  {
    if(!isset($data['id_attachement']) || $data['id_attachement'] == '') return [
      'status' => 'error',
      'message' => 'Impossible de supprimer cette pièce joint.'
    ];

    $db = getDB();
    $table = 'candidature_attachments';
    $id_attachement = $data['id_attachement'];
    $attachment = $db->findOne($table, 'id_attachment', $id_attachement);

    if( !isset($attachment->id_attachment) ) {
      return [
        'status' => 'error',
        'message' => 'Impossible de trouver cette pièce joint.'
      ];
    }

    if( $db->delete($table, 'id_attachment', $id_attachement) ) {
      $path = site_base('uploads/candidatures/'.$attachment->id_candidature.'/attachments/'.$attachment->file_name);
      unlinkFile($path);
    }
    
    return [
      'status' => 'success',
      'message' => 'La pièce joint a été supprimé.'
    ];
  }



  /**
   * Render email template
   * 
   * @param string $receiver
   * @param string $message
   *
   * @return string $message
   * 
   * @author M'hamed Chanchaf
   */
  public function renderTemplate($id_candidature, $receiver, $message)
  {
    $db = getDB();
    $candidat = $db->findOne('candidats', 'email', $receiver);
    if( isset($candidat->candidats_id) ) {

      $c = $db->prepare("SELECT c.date_candidature, h.status, h.date_modification, h.lieu, o.Name AS titre_offre, o.reference AS ref_offre, a.id_agend FROM candidature AS c JOIN historique AS h ON h.id_candidature=c.id_candidature JOIN offre AS o ON o.id_offre=c.id_offre LEFT JOIN agenda AS a ON a.id_candidature=c.id_candidature WHERE c.id_candidature=? ORDER BY h.date_modification DESC", [$id_candidature], true);

      $civilite = $this->civilite[$candidat->id_civi];
      $date_statut = date('d.m.Y H:i:s', strtotime($c->date_modification));
      $variables = array(
        'nom_candidat' => $civilite .' '. $candidat->prenom .' '. $candidat->nom,
        'nom' => $candidat->nom,
        'prenom' => $candidat->prenom,
        'civilite' => $civilite,
        'titre_offre' => $c->titre_offre,
        'ref_offre' => $c->ref_offre,
        'date_postulation' => date('d.m.Y', strtotime($c->date_candidature)),
        'statut_candidature' => $c->status,
        'date_statut' => $date_statut,
        'date_statu' => $date_statut,
        'lieu_statut' => $c->lieu,
        'lieu_statu' => $c->lieu,
        'lien_confirmation' => '<a href="'. site_url('confirmation/?i='.$c->id_agend) .'"> <b>Confirmer</b></a>'
      );

      return preg_replace_callback('#{{([^}]+)}}#', function($m) use ($message, $variables){
        if(isset($variables[$m[1]])){
          return $variables[$m[1]];
        }else{
          return $m[0];
        }
      }, $message);
    }
    return $message;
  }


  private function renderAjaxView($title, $viewPath, $variables=[])
  {
    ob_start();
    get_view($viewPath, $variables, __FILE__);
    $content = ob_get_clean();
    return ['content' => $content, 'title' => $title];
  }




} // END Class