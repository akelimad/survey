<?php
/**
 * PartnerController
 * 
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.offer.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Offer\Controllers;

use App\Mail\Mailer;
use App\Ajax;
use App\Media;

class PartnerController extends \App\Controllers\Controller
{


  public function actionOffers()
  {
    $this->data['table'] = (new TableController())->getOffersTable();
    $this->data['breadcrumbs'] = ['Accueil', 'Offres partagés avec moi'];
    return get_page('admin/partner/offer/index', $this->data, __FILE__);
  }


  public function actionOfferEntries()
  {
    $offre = getDB()->prepare("SELECT o.Name FROM offre o JOIN role_offre rf ON rf.id_offre=o.id_offre WHERE rf.id_role=? AND rf.id_role_offre=?", [$id_role, $_GET['id']], true);
   
    $this->data['table'] = (new TableController())->getEntriesTable();
    $this->data['breadcrumbs'] = ['Accueil', 'Offre', $offre->Name];
    return get_page('admin/partner/offer/entries', $this->data, __FILE__);
  }


  public function actionEntry()
  {
    $id_entry = (isset($_POST['id_entry'])) ? $_POST['id_entry'] : 0;
    $entry = new \stdClass();
    $title = "Création d'un nouveau dossier candidat";
    if ($id_entry > 0) {
      $title = "Mettre à jour de dossier candidat";
      $entry = getDB()->findOne('role_offre_entry', 'id_entry', $id_entry);
    }
    
    echo Ajax::renderAjaxView($title, 'admin/partner/popup/entry', [
      'entry' => $entry,
      'id_role_offre' => $_POST['id_role_offre']
    ], __FILE__);
  }
  

  public function actionStoreEntry()
  {
    if (!isset($_POST['id_role_offre'])) die();

    $db = getDB();
    $id_role_offre = $_POST['id_role_offre'];
    $id_entry = isset($_POST['id_entry']) ? $_POST['id_entry'] : 0;
    
    if ($id_entry == 0 && $_FILES['attachments']['size'][0] <= 0 ) {
      die(json_encode(['status' => 'error', 'message' => 'Vous devez envoyer au moin une pièce jointe.']));
    }

    $entryData = [
      'id_role_offre' => $_POST['id_role_offre'],
      'first_name' => $_POST['first_name'],
      'last_name' => $_POST['last_name'],
      'cin' => $_POST['cin'],
      'mobile' => $_POST['mobile']
    ];

    // create new entry
    if ($id_entry == 0) {
      $entryData['created_at'] = date("Y-m-d H:i:s");
      $id_entry = $db->create('role_offre_entry', $entryData);
    } else {
      $entry = $db->findOne('role_offre_entry', 'id_entry', $id_entry);
      if(!isset($entry->id_entry)) {
        die(json_encode(['status' => 'error', 'message' => 'Impossible de trouver ce dossier.']));
      }
      $entryData['updated_at'] = date("Y-m-d H:i:s");
      $db->update('role_offre_entry', 'id_entry', $id_entry, $entryData);
    }
    
    // insert attachements
    if ($id_entry > 0) {
      $attachments = [];
      $files = $_FILES['attachments'];

      $upload = Media::upload($files, [
        'extensions' => ['jpg', 'gif', 'png', 'doc', 'docx', 'xlsx', 'pdf'],
        'uploadDir' => 'uploads/partner/entries/'. $id_entry .'/',
      ]);

      if(isset($upload['files'][0]) && $upload['files'][0] != '') : for ($i=0; $i < count($files['name']); $i++) :
        $title = isset($_POST['titles'][$i]) ? $_POST['titles'][$i] : 'Sans-titre-'. $i;
        $attachments[$title] = $upload['files'][0];
      endfor; endif;

      // Update attachements list
      if(!empty($attachments)) {
        if(isset($entry->attachments) && $entry->attachments != '') {
          $atts = json_decode($entry->attachments, true);
          $attachments = array_merge($attachments, $atts);
        }
        $db->update('role_offre_entry', 'id_entry', $id_entry, [
          'attachments' => json_encode($attachments)
        ]);
      }
    }
    die(json_encode(['status' => 'success', 'message' => 'Le dossier de candidat a été bien enregistré.']));
  }


  public function actionDeleteEntryAttachement()
  {
    // dump($_POST);
  }
  

} // END Class