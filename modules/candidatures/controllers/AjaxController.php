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

namespace modules\candidatures\controllers;

use App\Ajax;

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
    Ajax::add('cand_sendemail_popup', [$this, 'showSendEmailPopup']);
    Ajax::add('cand_send_email', [$this, 'sendEmail']);
    Ajax::add('cand_type_email', [$this, 'getTypeEmail']);
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
    $fields = include_once module_base(__FILE__, 'resources/filter-fields.php');
    $fields = array_merge($fields, json_decode($data['fields'], true));
    $data['fields'] = etalent_array_sort($fields, 'sortOrder');
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
    if( empty($data['candidatures']) ) return;
    $cids = "'". implode("','", $data['candidatures']) ."'";
    $candidatures = getDB()->prepare("
      SELECT cand.id_candidature AS cid, c.email 
      FROM candidats c 
      JOIN candidature AS cand ON cand.candidats_id=c.candidats_id 
      WHERE cand.id_candidature IN({$cids})
      ");
    if( empty($candidatures) ) return;

    ob_start();
    get_view('admin/candidature/popup/send-mail', [
      'candidatures' => $candidatures
    ], __FILE__);
    $content = ob_get_clean();

    return ['content' => $content, 'title' => 'ENVOYER E-MAIL AU CANDIDAT'];
  }


  /**
   * Get email type
   * 
   * @author M'hamed Chanchaf
   */
  public function getTypeEmail($data)
  {
    if(!isset($data['id_email']) || $data['id_email'] == '') return;
    return getDB()->findOne('email_type', 'id_email', $data['id_email']);
  }

  /**
   * Send email to candidat
   * 
   * @author M'hamed Chanchaf
   */
  public function sendEmail($data)
  {
    if( 
      !isset($data['sender'])   || $data['sender'] == '' ||
      !isset($data['receiver']) || $data['receiver'] == '' ||
      !isset($data['subject'])  || $data['subject'] == '' ||
      !isset($data['message'])  || $data['message'] == ''
    ) return;

      $message = $data['message'];
      $parts = explode('|', $data['receiver']);
      if( isset($parts[1]) ) {
        $message = $this->renderTemplate($parts[0], $parts[1], $data['message']);
      }
      
      /*$db->create('corespondances', [
        'sujet' => $data['subject'],
        'nom' => $_SESSION["abb_admin"],
        'date_envoi' => date('Y-m-d H:i:s'),
        'type_email' => 'Envoi manuel',
        'titre' => 'Contacte avec le candidat',
        'message' => $data['message'],
        'ref_filiale' => ''
      ]);*/

      $receiver = (isset($parts[1])) ? $parts[1] : $parts[0];
      return \app\Mail::send($receiver, $data['subject'], $data['message'], [
        'isHTML' => true,
      ]);
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



} // END Class