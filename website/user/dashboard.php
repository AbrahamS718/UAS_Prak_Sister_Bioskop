                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="card mb-4">
                          <?php
                            //require __DIR__ . '\..\vendor\autoload.php';

                            use GuzzleHttp\Client;

                            try {
                                $client = new Client([
                                    'base_uri' => 'http://127.0.0.1:6969',
                                    'timeout' => 5
                                ]);

                                $client2 = new Client([
                                  'base_uri' => 'http://127.0.0.1:7676',
                                  'timeout' => 5
                                ]);

                                $response =  $client->request('GET', '/api/list'); //Untuk data film
                                $body = $response->getBody();
                                $data_body = json_decode($body, true);

                                $response2 =  $client->request('GET', '/api/movie'); //Untuk data penjualan
                                $body2 = $response2->getBody();
                                $data_body2 = json_decode($body2, true);

                                $response3 = $client2->request('GET', '/api/penjualan');
                                $body3 = $response3->getBody();
                                $data_body3 = json_decode($body3, true);
                            } catch (RuntimeException $e) {
                                echo $e->getMessage();
                            }

                            echo '<h4 class="mt-4"><i class="fas fa-table me-1"></i>Details</h4>';
                            
                            if ($_GET['module']=='home') {
                            echo '<div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Tiket Tersedia
                                  </div>
                            <section class="inner-page">
                              <div class="container">
                                <table class="table">';

                                echo '<thead>
                                  <tr>
                                    <th scope="col">ID</th>  
                                    <th scope="col">Judul</th>
                                    <th scope="col">Sinopsis</th>
                                    <th scope="col">Kursi</th>
                                    <th scope="col">Tanggal Tayang</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Transaksi</th>
                                  </tr>
                                </thead>';

                                foreach ($data_body2['data'] as $row2) {
                                  echo "<tbody>
                                        <tr>
                                          <td>$row2[id]</td>";
                                          foreach ($data_body['data'] as $row) {
                                            if ($row['id'] == $row2['id_movies']) {
                                              echo "<td>$row[judul]</td>
                                                    <td>$row[sinopsis]</td>";
                                            }
                                          }
                                          
                                  echo    "<td>$row2[kursi]</td>
                                          <td>$row2[tanggal]</td>
                                          <td>$row2[harga]</td>
                                          <td>
                                            <a href='user_action.php?action=beli&id=$row2[id]&id_user=$_SESSION[id]' class='btn btn-success'>Beli</a>
                                          </td>
                                        </tr>
                                        </tbody>";
                                }
                                echo      '</table>
                                        </div>
                                      </section>';


                                //Tiket yang dibeli user
                                echo '<div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Tiket yang Dibeli
                                  </div>
                            <section class="inner-page">
                              <div class="container">
                                <table class="table">';

                                echo '<thead>
                                  <tr>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Sinopsis</th>
                                    <th scope="col">Kursi</th>
                                    <th scope="col">Tanggal Tayang</th>
                                    <th scope="col">Transaksi</th>
                                  </tr>
                                </thead>';

                                foreach ($data_body3['data'] as $row3) {
                                  if($row3['id_user'] == $_SESSION['id']) {
                                    foreach ($data_body2['data'] as $row2) {
                                      if($row3['id_jadwal'] == $row2['id']) {
                                        foreach ($data_body['data'] as $row) {
                                          if($row2['id_movies'] == $row['id']) {
                                            echo "<td>$row[judul]</td>
                                                  <td>$row[sinopsis]</td>";
                                          }
                                        }
                                        echo "<td>$row2[kursi]</td>
                                          <td>$row2[tanggal]</td>
                                          <td>
                                            <a href='user_action.php?action=batal&id=$row3[id]' class='btn btn-warning'>Batal</a>
                                          </td>
                                        </tr>
                                        </tbody>";
                                      }
                                    }
                                  }
                                }
                              
                                echo      '</table>
                                        </div>
                                      </section>';



                                      
                              }
                          ?>
                        </div>
                    </div>
                </main>