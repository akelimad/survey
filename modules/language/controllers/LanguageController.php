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

use App\Controllers\Controller;
use Modules\Language\Models\Language;

class LanguageController extends Controller
{

  private $data = [];


  public function strings()
  {
    // $trans = 'trans("Text")';
    // $trans = 'trans_e(\'Text\'ee\')';
    /*$trans = 'bla <?php trans_e(\'<strong>Text\'ee\'); ?> foo';

    $pattern = '/trans[_]?[_e]?\([\'"](.*)[\'"]\)/uis';
    $matches = preg_match($pattern, $trans, $res);

  dump($res);*/




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
        'title' => '<i class="fa fa-check-circle"></i>&nbsp'. trans("Aucune nouveaux phrases trouvée")
      ]);
    }

    // Add strings if not exists
    $count = 0;
    $db = getDB();
    foreach ($strings as $key => $name) {
      if (!$db->exists('language_strings', 'name', $name)) {
        if ($db->create('language_strings', ['name' => $name])) {
          $count += 1;
        }
      }
    }

    return json_encode([
      'status' => 'success', 
      'title' => '<i class="fa fa-check-circle"></i>&nbsp'. $count .' '. trans("nouveaux phrases trouvée")
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
      $db->create('language_string_trans', [
        'language_string_id' => $data['sid'],
        'language' => $data['isoCode'],
        'value' => $data['value']
      ]);
    } else {
      $db->update('language_string_trans', 'id', $trans->id, ['value' => $data['value']]);
    }

    return $this->jsonResponse('success', trans("La phrase a été mis à jour."));
  }

  



} // END Class