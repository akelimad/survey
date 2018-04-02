<?php

/**
 * Get string translation
 *
 * @param string $msgid
 * @return string $string_trans
 **/
function trans($msgid) {
  $lang_code = 'fr';
  $file_path = site_base("messages/$lang_code.php");

  if (!file_exists($file_path)) {
    // get all strings from database
    $language = getDB()->prepare("SELECT s.name, t.value FROM language_strings s JOIN language_string_trans t ON t.language_string_id=s.id WHERE t.language=?", [$lang_code]);

    $strings = [];
    if (!empty($language)) : foreach ($language as $key => $lang) :
      $strings[$lang->name] = $lang->value;
    endforeach; endif;

    // Store strings to language messages file
    file_put_contents($file_path, serialize($strings));
  }

  // Read strings from cache
  $strings = unserialize(file_get_contents($file_path)) ?: [];

  // Return string translation if exists or it self
  return (isset($strings[$msgid])) ? $strings[$msgid] : $msgid;
}


/**
 * Echo string translation
 *
 * @param string $msgid
 * @return string $string_trans
 **/
function trans_e($msgid) {
  echo trans($msgid);
}