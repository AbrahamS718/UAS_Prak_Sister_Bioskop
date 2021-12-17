<?php
require_once __DIR__ . '\..\vendor\autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://127.0.0.1:6969', //Port USER
    'timeout' => 5
]);

$response =  $client->request('POST', '/api/login', [
    'json' => [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ]
]);

$body = $response->getBody();
$data_body = json_decode($body, true);
// $token = $data_body_login['data']['token'];
//var_dump($response);

if ($data_body['success'] = true) {
    session_start();
    $_SESSION["user"] = $data_body['data']['name'];
    // $_SESSION["user_id"] = $data_body['data']['id'];
    $_SESSION["token"] = $data_body['data']['token'];
    $_SESSION["id"] = $data_body['data']['id'];
    header('location:dashboard_user.php?module=home');
}