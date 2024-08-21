<?php

function controller($controllerName)
{
    return  realpath('.') . '/inc/controller/' . $controllerName . '.php';
}

function view($viewName = 'home')
{
    return realpath('.') . '/inc/view/' . $viewName . '.php';
}

function route($index)
{
    global $route;
    return $route[$index] ?? false;
}

//FORMS İNPUTS//
function p($name, $key = false)
{
    if ($key && isset($_POST[$name][$key])) {
        return strip_tags(trim($_POST[$name][$key]));
    }
    if (isset($_POST[$name])) {
        if (is_array($_POST[$name]))
            return array_map(function ($item) {
                return strip_tags(trim($item));
            }, $_POST[$name]);
        return strip_tags(trim($_POST[$name]));
    }
}


//PHP REDIRECT
function go($url, $time = 0){
    if ($time) {
        header("Refresh: {$time}; url={$url}");
    } else {
        header("Location: {$url}");
    }
}

function Alert($message, $type = "danger")
{
    return '<div class="alert alert-'.$type.'" role="alert">'.$message.'</div>';
}

//10 => DB ye kaydedilen süreye 10 dakika eklenecek anlamındadır
function OnlineProcess($user, $page)
{
    global $db;
    $sql = "CALL sp_OnlineUsers(:user, :page, 10)";
    return $db->basicRun($sql, ['user' => $user, 'page' => $page]);
}

//TIME CONVERT
function TimeTR($time, bool $notime = false)
{
    $time = ($time == NULL ? 1 : $time);
    $format = $notime ? 'dd.MM.YYYY' : 'dd.MM.YYYY HH:mm:ss';
    if (class_exists('IntlDateFormatter')) {
        $formatter = new IntlDateFormatter(
            Locale::getDefault(),
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            date_default_timezone_get(),
            IntlDateFormatter::GREGORIAN,
            $format
        );
        return $formatter->format($time);
    }else{
        $time = ($time === NULL ? new DateTime() : new DateTime("@$time"));
        $format = $notime ? 'd.m.Y' : 'd.m.Y H:i:s';
        return $time->format($format);
    }
}