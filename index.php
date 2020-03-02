<?php

require "./vendor/autoload.php";

use Monolog\Handler\Streamhandler;
use  Monolog\Logger;
use Monolog\Handler\NativeMailerHandler;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\FirePHPHandler;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
//create  a log channel
$log = new Logger('main');

//check what type of error it is and push in right file
if(isset($_GET['type'])){
$get = $_GET['type'];

    $to = 'benbenimane@hotmail.com';
    $subject  = 'alert';
    $from =  'benbenimane@hotmail.com';
    $level = logger::EMERGENCY;
    $bubble = true;
    $maxColumnWidth= 70;


switch ($get){
    case 'DEBUG':
        $log->pushHandler(new StreamHandler(__DIR__ . '../logs/blue.log', Logger::DEBUG));
        $log->pushHandler(new BrowserConsoleHandler(Logger::DEBUG ));
        $log->debug($_GET['message']);
        break;
    case 'INFO':
        $log->pushHandler(new StreamHandler(__DIR__ . '../logs/blue.log', Logger::INFO));
        $log->pushHandler(new BrowserConsoleHandler(Logger::INFO ));
        $log->info($_GET['message']);
        break;
    case 'NOTICE':
        $log->pushHandler(new StreamHandler(__DIR__ . '../logs/blue.log', Logger::NOTICE));
        $log->pushHandler(new BrowserConsoleHandler(Logger::NOTICE ));
        $log->notice($_GET['message']);
        break;
    case 'WARNING':
        $log->pushHandler(new StreamHandler(__DIR__ . '../logs/yellow.log', Logger::WARNING));
        $log->pushHandler(new BrowserConsoleHandler(Logger::WARNING ));
        $log->warning($_GET['message']);
        $nativeMailHandler = new NativeMailerHandler($to, $subject,  $from, $level, $bubble, $maxColumnWidth);
        break;
 case 'ERROR':
        $log->pushHandler(new StreamHandler(__DIR__ . '../logs/red.log', Logger::ERROR));
        $log->pushHandler(new BrowserConsoleHandler(Logger::ERROR ));
        $log->error($_GET['message']);
        $nativeMailHandler = new NativeMailerHandler($to, $subject,  $from, $level, $bubble, $maxColumnWidth);
        break;
 case 'CRITICAL':
        $log->pushHandler(new StreamHandler(__DIR__ . '../logs/red.log', Logger::CRITICAL));
        $log->pushHandler(new BrowserConsoleHandler(Logger::CRITICAL ));
        $log->critical($_GET['message']);
        $nativeMailHandler = new NativeMailerHandler($to, $subject,  $from, $level, $bubble, $maxColumnWidth);
        break;
case 'ALERT':
        $log->pushHandler(new StreamHandler(__DIR__ . '../logs/red.log', Logger::ALERT));
        $log->pushHandler(new BrowserConsoleHandler(Logger::ALERT ));
        $log->alert($_GET['message']);
        $nativeMailHandler = new NativeMailerHandler($to, $subject,  $from, $level, $bubble, $maxColumnWidth);
        break;
case 'EMERGENCY':
        $log->pushHandler(new StreamHandler(__DIR__ . '../logs/black.log', Logger::EMERGENCY));
        $log->pushHandler(new BrowserConsoleHandler(Logger::EMERGENCY));
        $log->emergency($_GET['message']);
        $nativeMailHandler = new NativeMailerHandler($to, $subject,  $from, $level, $bubble, $maxColumnWidth);
        break;
}
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logger</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
</head>
<body>
<form method="get">
    <h1>Using Monolog with Composer</h1>

    <input type="text" name="message" placeholder="My log message" class="form-control" required />

    <button type="submit" name="type" value="DEBUG" class="btn btn-info">DEBUG (100): Detailed debug information.</button>
    <button type="submit" name="type" value="INFO" class="btn btn-info">INFO (200): Interesting events. Examples: User logs in, SQL logs.
    </button>
    <button type="submit" name="type" value="NOTICE" class="btn btn-info">NOTICE (250): Normal but significant events.
    </button>
    <button type="submit" name="type" value="WARNING" class="btn btn-warning">WARNING (300): Exceptional occurrences that are not errors. Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
    </button>
    <button type="submit" name="type" value="ERROR" class="btn btn-danger">ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.
    </button>
    <button type="submit" name="type" value="CRITICAL" class="btn btn-danger">CRITICAL (500): Critical conditions. Example: Application component unavailable, unexpected exception.
    </button>
    <button type="submit" name="type" value="ALERT" class="btn btn-danger">ALERT (550): Action must be taken immediately. Example: Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
    </button>
    <button type="submit" name="type" value="EMERGENCY" class="btn btn-dark">EMERGENCY (600): Emergency: system is unusable.
    </button>
</form>

<style>
    button {
        display: block;
        margin: 12px 0px;
    }
</style>








</body>
</html>
