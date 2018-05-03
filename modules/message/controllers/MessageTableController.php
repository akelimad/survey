<?php
/**
 * StringTableController
 *
 * @author saleh
 *
 * @package modules.language.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Message\Controllers;

use App\File;
use App\Controllers\Controller;
use Modules\Message\Models\Message;

class MessageTableController extends Controller
{
  

	public function getTable()
	{
    $query = "SELECT * FROM `messages` WHERE `candidature_id`='". $_GET['id'] ."'";
    $table = new \App\Helpers\Table($query, 'id', [
      'actions' => false,
      'show_before_table_form' => false,
      'show_links_first_last' => false,
      // 'show_links_prev_next_if_dead' => false,
      'text_prev' => '<i class="fa fa-long-arrow-left"></i>',
      'text_next' => '<i class="fa fa-long-arrow-right"></i>'
    ]);

    $table->setTableId('messageTable');
    $table->setOrderby('created_at');
    $table->setOrder('DESC');
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $table->setPage($page);
    $table->setPerpage(10);

    $table->addColumn('message', '', function($row) {
      $db = getDB();
      $fromType = Message::getFromType();
      // Mark it as seen
      if ($row->is_read == 0 && $row->sender_type != $fromType) {
        Message::seen($row->candidature_id, $row->sender_type, $row->id);
      }
      $direction = ($fromType == $row->sender_type) ? 'pull-right block-right' : 'pull-left block-right colored-msg';
      $name = ( isLogged('candidat') && $row->sender_type != 'admin' ? '' : get_setting()['email_site'] );
      if( isLogged('candidat') && $row->sender_type != 'admin' || isLogged('admin') && $row->sender_type == 'admin' ) $name = '';
      elseif( isLogged('candidat') && $row->sender_type == 'admin' ) $name = get_setting()['email_site'];
      elseif( isLogged('admin') && $row->sender_type != 'admin' ) $name = Message::getCandidatName($row->candidature_id);
      $html = '<div class="message-wrap '. $direction .'">';
      $html .= '<span class="text-muted pull-right" style="font-size: 8px;">'. trans("Il y a") .' '. timeAgo($row->created_at) .'</span>';
      $html .= '<span class="message-conversation"><strong>'. $name .'</strong> '. $row->message .'</span>';
      $attachements = $db->findByColumn('message_attachements', 'id_message', $row->id);
      if (!empty($attachements)) {
        if (!empty($row->message)) {
          $html .= '<span class="separate-line"></span>';
        }
        $html .= '<ul>';
        foreach ($attachements as $key => $attachments) {
        $icon = File::getIconClass($attachments->name);
        $url = site_url('uploads/message/'. $row->candidature_id. '/'. $row->id .'/attachments/'. $attachments->name);
        $html .= '<li class="fa-icon-message"><a href="'. $url .'" target="_blank" class="btn btn-default btn-xs"><i class="'. $icon .'" title="'. $attachments->title .'"></i></li></a>';
        }
        $html .= '</ul>'; 
      }
      $html .= '</div>';

      return $html; 
    });

    // Run table and get results
    $table->_run();

    $content  = $table->render(false);
    //$content .="<style>.pagination li:not(:first-child), .pagination li:not(:last-child) {display: none!important;}</style>";

    return json_encode(['status' => 'success', 'content' => $content]);
	}
	
} // END Class