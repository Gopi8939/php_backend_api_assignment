<?php

include_once  "./REST.api.php";
// include_once './libs/includes/Session.class.php';

// Scan a folder and import .php files automatically
//-----------------------------------------------------
$dir = $_SERVER["DOCUMENT_ROOT"] . '/api/lib/includes/';
$methods = scandir($dir);
foreach ($methods as $m) {
    //$m contains all file in the folder of $dir
    if ($m == "." or $m == "..") {
        continue;
    }
    // Importing file;
    // echo $m . "\n";
    include_once "$dir$m";
}
// -----------------------------------------------------

global $__site_config;
$__site_config_path = $_SERVER["DOCUMENT_ROOT"] . '../../mdu_assignment.json';
$__site_config = file_get_contents($__site_config_path);

function get_config($key, $default = null)
{
    global $__site_config;
    $config = json_decode($__site_config, true);
    if (isset($config[$key])) {
        return $config[$key];
    } else {
        return $default;
    }
}
