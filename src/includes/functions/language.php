<?php
if (!isModuleEnabled('language')) {
  function trans($msgid) {
    return $msgid;
  }
  function trans_e($msgid) {
    echo trans($msgid);
  }
}


function getCurrentLanguage($key = null, $default = null) {
  if (isModuleEnabled('language')) {
    return \Modules\Language\Models\Language::getCurrentLanguage($key, $default);
  }
  return $default;
}