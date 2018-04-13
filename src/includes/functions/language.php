<?php
if (!function_exists('trans')) {
  function trans($msgid) {
    return $msgid;
  }
}

if (!function_exists('trans_e')) {
  function trans_e($msgid) {
    echo trans($msgid);
  }
}