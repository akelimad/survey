<?php
/**
 * PublishedOffersAlertCronController
 *
 * @author mchanchaf
 *
 * @package modules.cronjob.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Message\Controllers;

use App\Mail\Mailer;
use Modules\Message\Models\Message;

class MessageSeenCronController
{

  const CRON_NAME = 'message-no-seen-alert';
  const OBJECT_NAME = 'seen';

  private $count = 0;


  public function run()
  {
    foreach ( Message::msgNotSeenByCandidature() as $msg ) :
      if ( intval(Message::checkCronJobExist($msg->candidature_id, $msg->not_seen)->exist) === 0 ) :
        $email_to_sent = ( $msg->sender_type === 'admin' ? 'admin@lycom.ma' : Message::getEmailCandidat($msg->candidature_id)->email );
        $send = Mailer::send(
         $email_to_sent, 
         'discussion', 
         $this->getMessage($msg)
       );
        if ( $send['response'] == 'success' ) :
          $this->createCronJob($msg->candidature_id, $msg->not_seen);
          $this->count += 1;
        endif;
      endif;
    endforeach;

    echo $this->count;
  }

  private function getMessage($obj)
  {
    $message = "<p>Bonjour";
    $displayName = Message::getCandidatName($obj->candidature_id);
    $message .= "&nbsp;<strong>{$displayName}</strong>";
    $message .= ",</p>";
    $message .= "<p>Vous avez {$obj->not_seen} message". ( intval($obj->not_seen) > 1 ? 's' : '' ) ." non lu dans l'offre <strong>". Message::getOffreName($obj->candidature_id) ."</strong></p>";
    $message .= "<a href=\"". site_url('message/candidature/'.$obj->candidature_id.'/messages') ."\">Cliquer ici pour voir les messages</a></p>";
    $message .= "<p>Cordialement<br><strong>L’équipe RH</strong></p>";

    return $message;
  }

  private function createCronJob($candidature_id, $count_not_seen)
  {
    return getDB()->create('cron_jobs', [
      'object_id' => $candidature_id,
      'object_name' => self::OBJECT_NAME,
      'name' => self::CRON_NAME,
      'value' => $count_not_seen,
      'created_at' => date('Y-m-d H:i:s')
    ]);
  }

} // END Class