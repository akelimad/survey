<?php
/**
 * LanguageController
 *
 * @author mchanchaf
 *
 * @package modules.language.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Language\Controllers;

use App\Ajax;
use App\Controllers\Controller;
use Modules\Language\Models\Language;
use App\Helpers\SimpleXLSX;

class LanguageController extends Controller
{

  private $data = [];

  private $countNew = 0;

  private $countDeleted = 0;


  public function strings()
  {
    $this->data['layout'] = 'admin';
    $this->data['breadcrumbs'] = [
      trans("Langues"),
      trans("Traductions des chaînes")
    ];
    return get_page('admin/language/strings', $this->data, __FILE__);
  }

  public function scan()
  {
    $strings = (new Language())->getStringsFromCode();
    if (empty($strings)) {
      return json_encode([
        'status' => 'info', 
        'title' => '<i class="fa fa-check-circle"></i>&nbsp'. trans("Aucune nouveaux phrases trouvées")
      ]);
    }

    $db = getDB();

    // Add strings if not exists
    $str = '';
    foreach ($strings as $key => $name) {
      $str .= "'". addslashes($name)."',";
      if (!$db->exists('language_strings', 'name', $name)) {
        if ($db->create('language_strings', ['name' => $name])) {
          $this->countNew += 1;
        }
      }
    }

    // delete non exists string
    if (!empty($str)) {
      $toDelete = $db->prepare("
        SELECT id FROM language_strings 
        WHERE name NOT IN (". rtrim($str, ',') .")
      ");
      if (!empty($toDelete)) {
        foreach ($toDelete as $k => $v) {
          $db->delete('language_strings', 'id', $v->id);
          $db->delete('language_string_trans', 'language_string_id', $v->id);
          $this->countDeleted += 1;
        }
      }
    }

    return json_encode([
      'status' => 'success', 
      'title' => '<i class="fa fa-check-circle"></i>&nbsp'. $this->countNew .' '. trans("Nouvelles phrases trouvées") .'<br><i class="fa fa-trash"></i>&nbsp'. $this->countDeleted .' '. trans("phrases supprimées")
    ]);
  }

  public function store($data)
  {
    if (
      !isset($data['sid']) || 
      intval($data['sid']) == 0 || 
      !isset($data['isoCode']) || 
      $data['isoCode'] == ''
    ) return false;

    $db = getDB();
    $trans = $db->prepare("SELECT id FROM language_string_trans WHERE language_string_id=? AND language=?", [$data['sid'], $data['isoCode']], true);

    if (!isset($trans->id)) {
      if (!empty($data['value'])) {
        $db->create('language_string_trans', [
          'language_string_id' => $data['sid'],
          'language' => $data['isoCode'],
          'value' => $data['value']
        ]);
      }
    } else {
      if (!empty($data['value'])) {
        $db->update('language_string_trans', 'id', $trans->id, ['value' => $data['value']]);
      } else {
        $db->delete('language_string_trans', 'id', $trans->id);        
      }
    }

    // Delete cache
    unlinkFile(site_base('messages/'. $data['isoCode'] .'.php'));

    return $this->jsonResponse('success', trans("La phrase a été mis à jour."));
  }

  public function import($params)
  {
    if (form_submited()) {
      header('Content-Type: text/html; charset=utf-8');
      
      // Increase memory limit
      set_time_limit(0);
      ini_set('memory_limit', '-1');

      $newTrans = $overwrited = 0;

      // Get database instance
      $db = getDB();

      // Read file content
      $file = $_FILES['file']['tmp_name'];
      $rows = array_slice(file($file), $params['lines_to_ignore']);

      for ($i=0; $i < count($rows); $i++) { 
        $parts = explode(';', $rows[$i]);
        if (!isset($parts[1]) || empty($parts[1])) continue;

        // Check if string exists
        $string = $db->findOne('language_strings', 'name', trim($parts[0], '"'));
        if (isset($string->id)) {
          $string_trans = $db->prepare("SELECT id FROM language_string_trans WHERE language_string_id=? AND language=?", [
            $string->id, 
            $params['lang']
          ], true);

          if (isset($string_trans->id)) {
            if (isset($params['overwrite']) && $params['overwrite'] == 1) {
              $db->update('language_string_trans', 'id', $string_trans->id, [
                'value' => trim($parts[1], '"')
              ]);
              $overwrited += 1;
            }
          } else {
            $db->create('language_string_trans', [
              'language_string_id' => $string->id,
              'language' => $params['lang'],
              'value' => trim($parts[1], '"')
            ]);
            $newTrans += 1;
          }
        }
      }

      $message = '<i class="fa fa-star"></i>&nbsp'. $newTrans .' '. trans("Phrases traduites") .'<br><i class="fa fa-refresh"></i>&nbsp&nbsp'. $overwrited .' '. trans("Phrases mis à jour");

      return json_encode(['message' => $message]);

    } else {
      return Ajax::renderAjaxView(
        trans("Importer les traductions"), 
        'admin/language/import', 
        $this->data,
        __FILE__
      );
    }
  }

  public function export($params)
  {
    $query = Language::buildQuery($params);
    $trans = getDB()->prepare($query);

    $date = strtoupper($params['lang']) .'_'. date('d.m.Y_H:i');
    $filename = 'Traductions_'. $date;

    if (!empty($trans)) {
      $rows[] = ['Phrases', 'Traductions'];

      foreach ($trans as $key => $t) :
        $rows[] = [$t->name, $t->value];
      endforeach;

      $this->arrayToCSV($rows, $filename, true);
    } else {
      die(trans("Aucune phrase trouvée."));
    }
  }


} // END Class
