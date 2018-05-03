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
    if (isBackend()) return $msgid;
    
    $strings = Language::getStrings();

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