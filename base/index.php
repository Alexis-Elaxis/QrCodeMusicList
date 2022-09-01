<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$get_config = json_decode(file_get_contents('./config/config.json'));

if($get_config->place_name === "" && $get_config->place_description === "") header('Location: ./install/');
?>