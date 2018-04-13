<?php
if (!isModuleEnabled('language')) {
  function trans($msgid) {
    return $msgid;
  }
  function trans_e($msgid) {
    echo trans($msgid);
  }
}