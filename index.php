<?php
session_start();

include(__DIR__ . '/vendor/autoload.php');
include('app/classes/Session.php');

use app\classes\Router;

include_once('app/config.php');
include_once(__DIR__ . '/resources/templates/header.php');

$route = count($_GET) ? $_GET['route'] : '';
Router::route($route);

include_once(__DIR__ . '/resources/templates/live-search.php');
include_once(__DIR__ . '/resources/templates/modal.php');
include_once(__DIR__ . '/resources/templates/footer.php');