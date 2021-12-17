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
            'base_uri' => 'http://127.0.0.1:6969',
            'timeout' => 5
        ]);
        $response =  $client->request('DELETE', '/api/list/' . $id , [
            'json' => []
        ]);

        $body = $response->getBody();
        // $data_body = json_decode($body, true);

        header('location:..\..\dashboard_user.php?module=movie');
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}elseif ($action=='insert') {
    try {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:6969',
            'timeout' => 5
        ]);
        $response =  $client->request('POST', '/api/list/', [
            'json' => [
                'judul' => $_POST['judul'],
                'sinopsis' => $_POST['sinopsis']
            ]
        ]);

        $body = $response->getBody();
        // $data_body = json_decode($body, true);

        header('location:..\..\dashboard_user.php?module=movie');
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}elseif ($action=='update') {
    try {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:6969',
            'timeout' => 5
        ]);
        $response =  $client->request('PUT', '/api/list/' . $_POST['id'] , [
            'json' => [
                'judul' => $_POST['judul'],
                'sinopsis' => $_POST['sinopsis']
            ]
        ]);

        $body = $response->getBody();
        // $data_body = json_decode($body, true);

        header('location:..\..\dashboard_user.php?module=movie');
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}
?>