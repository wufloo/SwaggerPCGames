<?php
use Veebiteenus\Application;

require 'vendor/autoload.php';
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // return only the headers and not the content
    // only allow CORS if we're doing a GET - i.e. no saving for now.
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) && $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'GET') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-Requested-With');
    }
    exit;
}


set_error_handler("error_handler", E_ALL);
function error_handler($errno, $errstr, $file, $line, $context)
{
    ob_clean();

    header('HTTP/1.1 500 Internal Server Error');

    $errors[] = 'There was an error processing your request. Please try again later.';

    $msg = "Error $errno\n<b>$errstr</b>\n$file:$line\n\n<pre>" . print_r($context, 1) . '</pre>';

    $live = (!defined('DEBUG_MODE') || !DEBUG_MODE) ? true : false;

    if ($errno === E_USER_ERROR) {

        echo json_encode(['status' => 400, 'error_message' => $errstr], JSON_PRETTY_PRINT);
    }
    if ($live) {

        if ($errno !== E_USER_ERROR) {
            // Send email about the error to develeoper
        }


    } else {

        $errors[] = $msg;
        $errors[] = 'GET: ' . '<pre>' . print_r($_GET, 1) . '</pre>';
        $errors[] = 'POST: ' . '<pre>' . print_r($_POST, 1) . '</pre>';
        $errors[] = 'COOKIE: ' . '<pre>' . print_r($_COOKIE, 1) . '</pre>';
        $errors[] = 'BACKTRACE: ' . '<pre>' . print_r(debug_backtrace(), 1) . '</pre>';
        var_dump($errors);
    }

    exit();
}

$app = new Application;
$app->run();
