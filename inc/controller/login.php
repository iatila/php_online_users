<?php if (!defined('X')) die('Deny Access');
if ($UserId > 0){
    go('home');
    exit;
}
$file = 'pages/login';
require view();