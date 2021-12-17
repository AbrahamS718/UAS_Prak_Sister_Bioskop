<?php
session_start();
require __DIR__ . '\..\vendor\autoload.php';

use GuzzleHttp\Client;

$action = $_GET['action'];
$id = $_GET['id'];
$id_user = $_SESSION['id'];

//$id = $_POST['id'];
//$nama = $_POST['nama'];

if ($action=='beli') {
    try {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:7676',
            'timeout' => 5
        ]);
        $response =  $client->request('POST', '/api/penjualan', [
            'json' => [
                'id_jadwal' => $_GET['id'],
                'id_user' => $_GET['id_user']
            ]
        ]);

        $body = $response->getBody();
        // $data_body = json_decode($body, true);

        header('location:dashboard_user.php?module=home');
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}elseif ($action == 'batal'){
    try {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:7676',
            'timeout' => 5
        ]);
        $response =  $client->request('DELETE', '/api/penjualan/' . $id , [
            'json' => []
        ]);

        $body = $response->getBody();
        // $data_body = json_decode($body, true);

        header('location:dashboard_user.php?module=home');
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}
?>