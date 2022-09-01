<?php

function install() {
    $data = file_get_contents("https://cdn.alexiis.fr/projects/qrcodemusiclist/getinfos.json");
    $obj = json_decode($data);

    $filename = $obj->dl_url;
    file_put_contents($filename, fopen($obj->dl_name, 'r'));

    chmod($filename, 0777);

    $zip = new ZipArchive;
    $res = $zip->open($filename);

    switch ($res) {
        case true:
            if (!$zip->extractTo($path)){ return false; break; }
            $zip->close();
            unlink($filename);
            return true;
            break;
        default:
            return false;
            break;
    }
}
