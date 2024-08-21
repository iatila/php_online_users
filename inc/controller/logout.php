<?php if (!defined('X')) die('Deny Access');
if(isset($_SESSION['onlines'])){

    $data = [
        'online_last_time' => date('Y-m-d H:i:s', strtotime('-1 minute'))
    ];

    $where = [
        'online_user_id' => $UserId
    ];

    $db->update('online_user', $data, $where);
    //////////////////
    session_destroy();
    //////////////////
    go('login');
}