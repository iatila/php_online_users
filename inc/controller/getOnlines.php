<?php if (!defined('X')) die('Deny Access');
header("Content-type: application/json; charset=utf-8");



$result = [];
$sql = "SELECT 
            ou.online_user_id,
            ou.online_where,
            ou.online_last_time,
            u.user_name,
            u.user_group
        FROM online_user AS ou
        INNER JOIN users AS u ON ou.online_user_id = u.user_id
        WHERE ou.online_last_time >= NOW()
        ORDER BY ou.online_last_time DESC";

$onlines = $db->basicRun($sql);

if (isset($onlines[0])){
    foreach ($onlines as $oo){
        $newDate = strtotime($oo['online_last_time']) - (10 * 60);
        $newFive = strtotime($oo['online_last_time']) - (5 * 60);

        $result[]= [
            'user' =>$groups[$oo['user_group']]['color'].':|:'.$oo['user_name'],
            'where' =>  $menu[$oo['online_where']],
            'date' => TimeTR($newDate),
            'live' => time() > $newFive ? 'text-danger':'text-success'
        ];
    }
}
echo json_encode($result);