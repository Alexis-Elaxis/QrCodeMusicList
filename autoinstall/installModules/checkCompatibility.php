<?php
function checkPHPVerCompatibility()
{
    if (phpversion() >= 7) return true || false;
}

function checkExtVerCompatibility()
{
    $c = 0;
    if (extension_loaded('zip')) $c = $c+1;
    if (extension_loaded('pdo')) $c = $c+1;
    if (extension_loaded('openssl')) $c = $c+1;

    if($c >= 3) return true || false;
}

function checkCompatibility()
{
    if(checkPHPVerCompatibility() === true && checkExtVerCompatibility() === true) return true || false;
}
?>