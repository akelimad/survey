<?php
/**
 * MessageController
 *
 * @author saleh
 *
 * @package modules.Message.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Message\Controllers;

use App\Media;
use App\File;
use App\Models\Candidature;
use App\Controllers\Controller;
use Modules\Message\Models\Message;

class MessageController extends Controller
{

  private $data = [];

  public function messages()
  {
    $this->addAssets();
    $this->data['layout'] = (isBackend()) ? 'admin' : 'front';
    $this->data['breadcrumbs'] = [
      trans("Candidature"),
      trans("Messages")
    ];

    $this->data['colored_msg'] = get_setting('color_bg_menu', 'e1a04e');
    if ( isBackend() ) :
      $this->data['tabs_conversation'] = Message::getConversationTabs();
    endif;
    ( !isBackend() ? $this->checkOpenConversation($_GET['id']) : '' );
    return get_page('common/messages/index', $this->data, __FILE__);
  }

  public function store($data)
  {
    if ( empty($data['message']) && (isset($_FILES['attachments']) && $_FILES['attachments']['size'][0] == 0) ){
      return $this->jsonResponse('error', trans('Veuillez saisir un message ou joindre un fichier.'));
    }

    // Store message
    $msg_id = getDB()->create('messages', [
      'candidature_id' => $data['cand_id'],
      'from_id' => Message::getFromId(),
      'sender_type' => Message::getFromType(),
      'message' => (isset($data['message'])) ? $data['message'] : null,
      'is_read' => 0,
      'created_at' => date('Y-m-d H:i:s')
    ]);

    if ( intval($msg_id) < 1 ) {
      return $this->jsonResponse('error', trans("Impossible d'envoyer le message."));
    }

    $attachments = [];
    if ( $_FILES['attachments']['size'][0] > 0 && isset($data['cand_id']) ) {
      $uploadDir = 'uploads/message/'. $data['cand_id'] .'/'. $msg_id .'/attachments/';
      $upload = Media::upload($_FILES['attachments'], [
        'extensions' => ['jpg', 'jpeg', 'gif', 'png', 'doc', 'docx', 'xlsx', 'pdf'],
        'uploadDir' => $uploadDir
      ]);

      if ( isset($upload['files']) ) {
        $attachments = $upload['files'];
      } else {
          // TODO - delete root directory
        getDB()->delete('messages', 'id', $msg_id);
        foreach ($this->getDirectoryFiles( site_base($uploadDir) ) as $key => $file) {
          File::deleteFile($file);
        }
        return $this->jsonResponse('error', $upload['errors'][0]);
      }
    }

    // Store attachments
    if ( !empty($attachments)) : foreach ($attachments as $key => $name ) :
      getDB()->create('message_attachements', [
        'id_message' => $msg_id,
        'name' => $name,
        'title' => (!empty($data['att_labels'][$key]) ? $data['att_labels'][$key] : null)
      ]);
    endforeach; endif;

    return $this->jsonResponse('success', trans("Le message a été envoyé."));
  }

  public function notification($data)
  {
    // Get count messages not read
    $msg_count = Message::notification($data['candidature_id']);
    if ( isset($data['isTab']) && $data['isTab'] == true ) :
      $tabs = array();
      foreach ( Message::getConversationTabs() as $tab ) :
        $tabs []= [ 'candidature_id' => $tab->id_candidature, 'count_not_seen' => Message::getTotalMsgNotRead($tab->id_candidature) ];
      endforeach;
      return json_encode( [ 'notifications_tabs' => $tabs ] );
    else :
      return json_encode( [ 'count_msg_not_readed' => $msg_count->count_not_readed ] );
    endif;
  }

  public function checkOpenConversation($id)
  {
    $currentuserCands = Candidature::findAllByCandidatId();
    $exist = 0;
    foreach ($currentuserCands as $cand) :
      if ($cand->id_candidature == $_GET['id']) :
        $exist++;
      endif;
    endforeach;

    if ($exist === 0) redirect( site_url('candidat/compte') );
  }

  public static function addAssets()
  {
    \App\Assets::addCss('fiches', [
      'src' => module_url(__FILE__, 'assets/css/custom.css'),
      'admin' => true,
      'front' => true,
      'version' => ETA_ASSETS_VERSION
    ]);
  }

} // END Class