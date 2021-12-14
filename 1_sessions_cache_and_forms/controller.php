<?php
session_start();

require_once 'config.php';

$_SESSION['validation'] = '';
$_SESSION['fails'] = [];
$md5 = '';

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $cache = getCacheByKey($_POST['email']);
    $cache['attempt'] += 1;

    if ($cache['attempt'] > ATTEMPTS_FOR_SMS) {
        $validation = isset($_POST['sms']) && $_POST['sms'] == CHECK_SMS;
        $_SESSION['validation'] = 'sms';
        $_SESSION['fails'][] = 'Code from ' . strtoupper($_SESSION['validation']) . ' is incorrect';
    } elseif ($cache['attempt'] > ATTEMPTS_FOR_EMAIL) {
        $validation = isset($_POST['code_email']) && $_POST['code_email'] == CHECK_EMAIL;
        $_SESSION['validation'] = 'email';
        $_SESSION['fails'][] = 'Code from ' . strtoupper($_SESSION['validation']) . ' is incorrect';
    } elseif ($cache['attempt'] > ATTEMPTS_FOR_CAPTCHA) {
        $validation = isset($_POST['captcha']) && $_POST['captcha'] == ATTEMPTS_FOR_CAPTCHA;
        $_SESSION['validation'] = 'captcha';
        $_SESSION['fails'][] = 'Code from ' . strtoupper($_SESSION['validation']) . ' is incorrect';
    } else {
        $validation = true;
        $_SESSION['fails'] = [];
    }

    // Check login, password and secure code, expected place of validation against the DB
    $validation = ($_POST['email'] == EMAIL && $_POST['password'] == PASSWORD && $validation);

    // Update the cache depending on the result
    if ($validation) {
        clearCache($_POST['email']);
        $md5 = md5($_POST['password']);
        $_SESSION['is_logged_in'] = $md5;
    } else {
        $cache['last_attempt'] = time();
        putCache($_POST['email'], $cache);
        $_SESSION['fails'][] = 'Access denied';
    }
}

// If user is logged in - redirect to admin panel
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == $md5) {
    header('Location: cpanel.php');
}

if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] !== $md5) {
    $_SESSION['fails'][] = 'Access denied';
}

/**
 * Get data from cache by key
 * @param $key
 * @return array|mixed
 */
function getCacheByKey($key) {
    $empty = ['attempt' => 0, 'last_attempt' => 0];
    $cache = getAllCache();

    return isset($cache[$key]) ? $cache[$key] : $empty;
}


/**
 * Get all cached data
 * @return array|mixed
 */
function getAllCache() {
    if (file_exists(CACHE)) {
        $cache = json_decode(file_get_contents(CACHE), true);
        return $cache;
    } elseif (@touch(CACHE)) {
        return [];
    } elseif (isset($_SESSION['cache'])) {
        return $_SESSION['cache'];
    } else {
        return [];
    }
}

/**
 * Save cache data
 * @param $key
 * @param $value
 */
function putCache($key, $value) {
    $key = strtolower($key);
    if (empty($key)) return;

    if (file_exists(CACHE)) {
        // Try to get cache data from file
        $cache = json_decode(file_get_contents(CACHE), true);
        $cache[$key] = $value;
    } elseif (isset($_SESSION['cache'])) {
        // Get cache data from session
        $cache = $_SESSION['cache'];
        $cache[$key] = $value;
    }

    if (!@file_put_contents(CACHE, json_encode($cache))) $_SESSION['cache'] = $cache;
}

/**
 * Clear expired cache or cache by email
 * @param string $withEmail
 */
function clearCache($withEmail = '') {
    $withEmail = strtolower($withEmail);

    $cache = getAllCache();
    foreach ($cache as $key => $value) {
        if ($value['last_attempt'] + CACHE_EXPIRE < time() || $key == $withEmail) {
            unset($cache[$key]);
        }
    }

    if (!@file_put_contents(CACHE, json_encode($cache))) $_SESSION['cache'] = $cache;
}

require "template.tpl";