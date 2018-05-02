<?php
/**
 * LinkedinTableController
 *
 * @author saleh
 *
 * @package modules.socialshare.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Socialshare\Controllers;

use App\Controllers\Controller;
use Modules\Socialshare\Models\Share;

class LinkedinTableController extends Controller
{


	public function getTable()
	{
    $query = "SELECT id_setting, name, value FROM setting WHERE name LIKE '%linkedin_app%'";
    $table = new \App\Helpers\Table($query, 'name', [
      'actions' => true,
      'show_before_table_form' => false,
    ]);

    $table->setTableClass(['table', 'table-striped', 'table-hover', 'chmTable']);
    $table->setTableId('App_Linkedin_Table');
    $table->setOrderby('id_setting');
    $table->setOrder('DESC');
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $table->setPage($page);
    $table->setPerpage(10);

    $table->addColumn('photo', trans('Photo'), function($row) {
      $app_json = json_decode($row->value, TRUE);
      if ( $app_json['share_in'] == 'profil' OR $app_json['share_in'] == 'company+profil' ) {
        $html = '<img src='. $app_json['pictureUrl'] .' width=50 />';
      } elseif ( $app_json['share_in'] == 'company' ) {
        $html = '<img src='. $app_json['logoUrl'] .' width=50 />';
      }
      return $html;
    });

    $table->addColumn('profil_name', trans('Profil name'), function($row) {
      $app_json = json_decode($row->value, TRUE);
      if ( $app_json['share_in'] == 'profil' OR $app_json['share_in'] == 'company+profil' ) {
        $html = $app_json['firstName'] .' '. $app_json['lastName'];
      } elseif ( $app_json['share_in'] == 'company' ) {
        $html = $app_json['name'];
      }
      return $html; 
    });

    $table->addColumn('share_in', trans('Share in'), function($row) {
      $app_json = json_decode($row->value, TRUE);
      return '<span style="background-color:orange;color:#FFF;padding:4px 6px;border-radius:10px;font-weight:bold">'. $app_json['share_in'] .'</span>'; 
    });

    $table->addColumn('publish_status', trans('Publish status'), function($row) {
      $app_json = json_decode($row->value, TRUE);
      return '<a href="javascript:void(0)" class="set_publish_status" data-publish-status="'. $app_json['publish_status'] .'" id="'. $row->name .'" onclick="return setPublishStatus(\'' . $row->name . '\')"><i class="fa fa-'. ( $app_json['publish_status'] == 'play' ? 'stop' : 'play' ) .'"></i></a>'; 
    });

    $table->setAction('delete',  [
      'patern' => '#',
      'attributes' => [
        'onclick' => "return chmModal.confirm('', '', 'Êtes-vous sûr de vouloir supprimer cette application ?', 'deleteApp', &#123;'app_id': '{name}'&#125;, {width: 386})",
        'id' => '{name}'
      ]
    ]);
  
    $table->removeActions([ 'edit' ]);

    // Run table and get results
    $table->_run();

    $content = $table->render(false);

    return json_encode(['status' => 'success', 'content' => $content]);
  }

} // END Class