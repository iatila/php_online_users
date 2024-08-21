<?php if (!defined('X')) die('Deny Access');
require view('static/header');

if (file_exists(view($file))) {
    require view($file);
} else {
   $alert = Alert('View Dosyası Eksik');
}
if (isset($alert)){
    echo $alert;
}
require view('static/footer');