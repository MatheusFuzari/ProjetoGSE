<?php
require '../vendor/autoload.php';

use Firebase\JWT\JWT;

header("Access-Control-Allow_Origin: *");
header('Access-Control-Allow-Headers: Authoriation, Content-Type, x-xsrf-token, x-csrftoken, Cache-Control, X-Requested-With');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 1));
$dotenv->load();

$authorization = $_SERVER["HTTP_AUTHORIZATION"];

$token = str_replace(' Bearer', '', $authorization);
echo json_encode($authorization);
