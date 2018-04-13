<?php
use Modules\Language\Models\Language;

/**
 * Get string translation
 *
 * @param string $msgid
 * @return string $string_trans
 **/
if (!function_exists('trans')) {
  function trans($msgid) {
    $iso_code = Language::getCurrentLanguage('iso_code', 'fr');
    $file_path = site_base("messages/{$iso_code}.php");

    if (!file_exists($file_path)) {
      // get all strings from database
      $language = getDB()->prepare("SELECT s.name, t.value FROM language_strings s JOIN language_string_trans t ON t.language_string_id=s.id WHERE t.language=?", [$iso_code]);

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
}

/**
 * Echo string translation
 *
 * @param string $msgid
 * @return string $string_trans
 **/
if (!function_exists('trans_e')) {
  function trans_e($msgid) {
    echo trans($msgid);
  }
}