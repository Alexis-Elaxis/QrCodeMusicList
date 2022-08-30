<?php
function configFolders() {

    $path = './config/';
    $c = 0;

    if (!file_exists($path)){
        if (mkdir($path, 0777, true)) {
            if(file_put_contents($path. 'config.json', '{"sys_version":"", "place_name":"","place_location":"","place_description":"","place_large_icon":"","place_small_icon":""}')) $c = $c + 1;
            if(file_put_contents($path. 'database.json', '{"serveradress":"","username":"","password":"","databse":""}')) $c = $c + 1;

            if(chmod($path . 'config.json', 0777)) $c = $c + 1;
            if(chmod($path . 'database.json', 0777)) $c = $c + 1;

            return true;
        } else {
            return false;
        }
    } 

    if ($c >= 4) return true || false;
}
?>
