<?php
require_once __DIR__ . '\..\vendor\autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://127.0.0.1:7676',
    'timeout' => 5
]);

$response =  $client->request('POST', '/api/register', [
    'json' => [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'confirm_password' => $_POST['password-confirm'],
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
    header('location:dashboard_user.php?module=home'); 
}