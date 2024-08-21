<?php  header('Content-type: text/html; charset=utf-8');

// TIMEZONE SET
date_default_timezone_set('Europe/Istanbul');
// ERROR LOG
error_reporting(E_ALL ^ E_NOTICE);

require_once __DIR__.'/Database.php';
require_once __DIR__.'/arrays.php';



$db = new Database('localhost', 'onlineusers', 'root', '');

define('SUB_DIR', 'OnlineUsers');