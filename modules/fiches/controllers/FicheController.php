<?php
/**
 * FicheController
 * 
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.fiches.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Fiches\Controllers;

use App\Session;
use Modules\Fiches\Models\Fiche;
use Modules\Fiches\Controllers\TableController;

class FicheController extends \App\Controllers\Controller
{

  private $data;

  private $savedItemsIds;


  /**
   * Display fiches
   * 
   * @author M'hamed Chanchaf
   */
  public function actionIndex()
  {
    $table = (new TableController() )->getTable();
    $this->data->types = Fiche::getTypes();

    return get_page('admin/fiche/index', [
      'table' => $table,
      'data' => $this->data,
      'breadcrumbs' => ['Fiches', 'Fiches de présélection / evaluation']
    ], __FILE__);
  }


  /**
   * Create new fiche
   * 
   * @author M'hamed Chanchaf
   */
  public function actionCreate()
  {
    $this->initData();
    $this->submitForm();

    return get_page('admin/fiche/form', [
      'data' => $this->data,
      'breadcrumbs' => ['Fiches', 'Créer une fiche']
    ], __FILE__);
  }


  /**
   * Update existing fiche
   * 
   * @author M'hamed Chanchaf
   */
  public function actionEdit($id_fiche)
  {
    
    $fiche = getDB()->findOne('fiches', 'id_fiche', $id_fiche);
    if( !isset($fiche->id_fiche) ) {
      Session::setFlash('danger', "Impossible de trouver cette fiche.");
      redirect('backend/module/fiches/fiche');
    }
    $this->data = (object) array_replace_recursive((array)$this->data, (array)$fiche);

    $this->initData();
    $this->submitForm();

    return get_page('admin/fiche/form', [
      'data' => $this->data,
      'breadcrumbs' => ['Fiches', 'Modifier une fiche']
    ], __FILE__);
  }

  /**
   * Delete existing fiche
   * 
   * @author M'hamed Chanchaf
   */
  public function actionDelete($id_fiche)
  {
    $db = getDB();
    $fiche = $db->findOne('fiches', 'id_fiche', $id_fiche);
    if( !isset($fiche->id_fiche) ) {
      Session::setFlash('danger', "Impossible de trouver cette fiche.");
    }
    
    $ficheUsed = $db->exists('fiche_offre', 'id_fiche', $id_fiche);
    if( $ficheUsed ) {
      Session::setFlash('danger', "Impossible de supprimer une fiche déja lié à un offre.");
    }

    // delete fiche
    $db->delete('fiches', 'id_fiche', $id_fiche);
    $db->delete('fiche_items', 'id_fiche', $id_fiche);
    
    Session::setFlash('success', "La fiche a été bien supprimer.");
    
    redirect('backend/module/fiches/fiche');
  }


  private function initData()
  {
    if( is_null($this->data) ) $this->data = new \stdClass;

    if( !isset($this->data->fiche_type) ) {
      $this->data->reference = (new Fiche())->genReference();
      $this->data->fiche_type = (isset($_GET['type']) && in_array($_GET['type'], [0,1])) ? $_GET['type'] : 0;
    }
    
    $this->data->types  = Fiche::getTypes();
    $this->data->blocks = Fiche::getBlocksByFicheType($this->data->fiche_type);
  }

  private function submitForm()
  {
    if( form_submited() ) {
      if( $this->saveFiche() ) {
        Session::setFlash('success', "La fiche a été bien sauvegardé.");
        redirect('backend/module/fiches/fiche');
      }
    }
  }

  private function saveFiche()
  {
    $db = getDB();

    $this->data = (object) array_replace_recursive((array)$this->data, $_POST);

    if( !isset($this->data->id_fiche) ) {
      $this->data->id_fiche = $db->create('fiches', [
        'reference'  => $this->data->reference,
        'fiche_type' => $this->data->fiche_type,
        'name'       => $this->data->name,
        'created_at' => date('Y-m-d H:i:s')
      ]);
    } else {
      $db->update('fiches', 'id_fiche', $this->data->id_fiche, [
        'name'       => $this->data->name,
        'updated_at' => date('Y-m-d H:i:s')
      ]);
    }
      
    if( !$this->data->id_fiche ) {
      Session::setFlash('danger', "Une erreur est survenu lors de sauvegarde de la fiche.");
      return false;
    }
    
    $saveItems = $this->saveItems($this->data->block_items, $this->data->id_fiche);

    if( !$saveItems ) {
      Session::setFlash('danger', "Une erreur est survenu lors de sauvegarde des criteres de l’annonce.");
      redirect('backend/module/fiches/fiche/edit/'.$this->data->id_fiche);
    }

    return $saveItems;
  }

  private function saveItems($block_items, $id_fiche)
  {
    $db = getDB();
    $saveItems = true;
    foreach ($block_items as $id_block => $items) {
      foreach ($items as $id_item => $name) {
        if( $name == '' ) continue;
        if( !$this->saveItem($id_item, $id_fiche, $id_block,	$name) ) {
          $saveItems = false;
        }
      }
    }
    // delete old items
    if( !empty($this->savedItemsIds) ) {
      $ids = implode(',', $this->savedItemsIds);
      $db->prepare("DELETE FROM fiche_items WHERE id_fiche=? AND id_item NOT IN({$ids})", [$id_fiche]);
    } else {
      $db->delete('fiche_items', 'id_fiche', $id_fiche);
    }

    return $saveItems;
  }


  private function saveItem($id_item,	$id_fiche, $id_block,	$name)
  {
    $db = getDB();
    if( strpos($id_item, 'new_') === 0 ) {
      $saveItem = $db->create('fiche_items', [
        'id_fiche'  => $id_fiche,
        'id_block'  => $id_block,
        'name'  => $name
      ]);
      if( $saveItem > 0 ) {
        $arr[$newkey] = $arr[$oldkey];
        $this->data->block_items[$id_block][$saveItem] = $name;
        unset($this->data->block_items[$id_block][$id_item]);
        $this->savedItemsIds[] = $saveItem;
      } else {
        return false;
      }
    } else {
      $db->update('fiche_items', 'id_item', $id_item, [
        'name' => $name
      ]);
      $this->savedItemsIds[] = $id_item;
    }
    return true;
  }




} // END Class