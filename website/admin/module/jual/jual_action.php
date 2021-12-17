<?php
require __DIR__ . '\..\..\..\vendor\autoload.php';

use GuzzleHttp\Client;

$module =$_GET['module'];
$action = $_GET['act'];
$id = $_GET['id'];

//$id = $_POST['id'];
//$nama = $_POST['nama'];

if ($action=='hapus') {
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

        header('location:..\..\dashboard_user.php?module=penjualan');
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}elseif ($action=='update') {
    try {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:7676',
            'timeout' => 5
        ]);
        $response =  $client->request('PUT', '/api/penjualan/' . $_POST['id_jual'] , [
            'json' => [
                'id_user' => $_POST['id_user'],
                'id_jadwal' => $_POST['id_jadwal']
            ]
        ]);

        $body = $response->getBody();
        // $data_body = json_decode($body, true);

        header('location:..\..\dashboard_user.php?module=penjualan');
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}
?>