<?php

function checkMaj() {
  $data = file_get_contents("https://cdn.alexiis.fr/projects/qrcodemusiclist/getinfos.json");
  $obj = json_decode($data);

  if($obj->dl_version > json_decode(file_get_contents("./config/config.json"))->sys_version) return true || false;
}
