<?php if (!defined('X')) die('Deny Access');
OnlineProcess($UserId, route(0));
$file = 'pages/settings';
require view();