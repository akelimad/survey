<?php
/**
 * Message
 *
 * @author saleh
 *
 * @package modules.message.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Message\Models;

class Message {

  public static function insert($candidature_id, $message){
  	$currentDate = date("Y-m-d H:i:s");
  	$message = trim(addslashes($message));
    $sendertype = Message::getFromType();
  	if(Message::getFromId() == 0) echo FALSE;
  	else $from_id = Message::getFromId();
    return getDB()->create('messages', 
      ['candidature_id' => $candidature_id,
       'sender_type' => $sendertype,
       'message' => $message,
       'from_id' => $from_id,
       'is_read' => 0,
       'created_at' => $currentDate
      ],
      FALSE);
  }

  public static function getCandidatName($cand_id)
  {
    $candidat = getDB()->prepare("
      SELECT CONCAT(c.nom, ' ', c.prenom) as candidat_name
      FROM `messages` m
      JOIN candidature cand ON m.candidature_id=cand.id_candidature
      JOIN candidats c ON c.candidats_id=cand.candidats_id
      WHERE cand.id_candidature = ?
      GROUP BY candidat_name",
      [ $cand_id ], 
      TRUE
    );
    return $candidat->candidat_name;
  }

  public static function getConversationTabs() {
    $tabs = getDB()->prepare("
      SELECT CONCAT(c.nom, ' ', c.prenom) as candidat_name, o.Name, cand.id_candidature
      FROM `messages` m
      JOIN candidature cand ON m.candidature_id=cand.id_candidature
      JOIN candidats c ON c.candidats_id=cand.candidats_id
      JOIN offre o ON o.id_offre=cand.id_offre
      GROUP BY m.candidature_id"
    );
    return $tabs;
  }

  public static function getOffreName($cand_id)
  {
    $offre = getDB()->prepare("
      SELECT o.Name as name
      FROM `candidature` cand
      JOIN offre o ON o.id_offre = cand.id_offre
      WHERE cand.id_candidature = ?",
      [ $cand_id ], 
      TRUE
    );
    return $offre->name;
  }

  public static function getTotalMsgNotRead($cand_id) 
  {
    $is_not_read = getDB()->prepare("
      SELECT count(is_read) as count 
      FROM messages 
      WHERE candidature_id = ? 
      AND is_read = ? 
      AND sender_type = ?",
      [ $cand_id, 0, 'candidat' ], 
      TRUE
    );
    return $is_not_read->count;
  }

  public static function getEmailCandidat($cand_id)
  {
    $email_candidat = getDB()->prepare("
      SELECT email
      FROM candidats c1
      JOIN candidature c2 ON c1.candidats_id = c2.candidats_id AND c2.id_candidature = $cand_id",
      NULL, 
      TRUE
    );

    return $email_candidat;
  }

  public static function notification($cand_id)
  {
    // Get count messages not read
    $msg_count = getDB()->prepare("
      SELECT count(*) as count_not_readed
      FROM messages
      WHERE candidature_id = ? AND sender_type != ? AND is_read = ?",
      [ $cand_id, Message::getFromType(), 0 ],
      TRUE
    );

    return $msg_count;
  }

  public static function msgNotSeenByCandidature()
  {
    // Get count messages not seen grouping by sender_type and candidature_id
    $msg_count_not_seen = getDB()->prepare("
      SELECT id, count(is_read) as not_seen, sender_type, candidature_id
      FROM messages
      WHERE is_read = ?
      GROUP BY candidature_id, sender_type", 
      [ 0 ],
      FALSE
    );

    return $msg_count_not_seen;
  }

  public static function checkCronJobExist($candidature_id, $count_not_seen)
  {
    $exist = getDB()->prepare("
      SELECT count(*) as exist 
      FROM cron_jobs 
      WHERE object_id = $candidature_id AND value = $count_not_seen",
      NULL,
      TRUE
    );

    return $exist;
  }

  public static function AdminIsStartingDiscussion($cand_id)
  {
    $started = getDB()->prepare("
      SELECT count(*) as total
      FROM messages 
      WHERE sender_type = 'admin' AND candidature_id = $cand_id",
      NULL,
      TRUE
    );

    return ( $started->total > 0 ? TRUE : FALSE );
  }

  public static function seen($cand_id, $sender_type, $message_id)
  {
    return getDB()->prepare("UPDATE messages SET is_read = 1 WHERE candidature_id = $cand_id AND sender_type = '$sender_type' AND id = $message_id");
  }

  public static function getFromId()
  {
    $from_id = 0;
    if (isbackend() && isLogged('admin')) {
      $from_id = read_session('abb_admin');
    } else if (isLogged('candidat')) {
      $from_id = get_candidat_id();
    }
    return $from_id;
  }

  public static function getFromType()
  {
  	if ( isLogged('admin') ) {
  		return 'admin';
  	} else if (isLogged('candidat')) {
  		return 'candidat';
  	}
  }

} // End Class