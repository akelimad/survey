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
    $this->data['strings'] = [];
    $this->data['breadcrumbs'] = [trans('Langues'), trans('Traductions des chaînes')];

    return get_page('admin/language/strings', $this->data, __FILE__);
  }


  public function synchronize()
  {
    $strings = (new Language())->getStringsFromCode();



  }

  



} // END Class