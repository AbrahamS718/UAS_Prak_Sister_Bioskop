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

                            echo '<h4 class="mt-4"><i class="fas fa-table me-1"></i>Data</h4>';
                            
                            if ($_GET['module']=='home') {
                              echo '<div class="card-header">
                              <i class="fas fa-table me-1"></i>
                              Daftar Movies
                              </div>
                              <section class="inner-page">
                                <div class="container">
                                  <table class="table">';

                          echo '<thead>
                            <tr>
                              <th scope="col">ID Movies</th>  
                              <th scope="col">Judul</th>
                              <th scope="col">Sinopsis</th>
                            </tr>
                          </thead>';

                          foreach ($data_body['data'] as $row) {
                            echo "<tbody>
                                  <tr>
                                    <td>$row[id]</td>
                                    <td>$row[judul]</td>
                                    <td>$row[sinopsis]</td>
                                  </tr>
                                  </tbody>";
                          }
                          echo      '</table>
                                  </div>
                                </section>';
                            
                            
                            
                            //Data Tiket
                              echo '<div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Tiket
                                  </div>
                            <section class="inner-page">
                              <div class="container">
                                <table class="table">';

                                echo '<thead>
                                  <tr>
                                    <th scope="col">ID Jadwal</th>  
                                    <th scope="col">Judul</th>
                                    <th scope="col">Sinopsis</th>
                                    <th scope="col">Kursi</th>
                                    <th scope="col">Tanggal Tayang</th>
                                    <th scope="col">Harga</th>
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
                                        </tr>
                                        </tbody>";
                                }
                                echo      '</table>
                                        </div>
                                      </section>';



                                      //Data Penjualan
                                echo '<div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Data Penjualan
                                  </div>
                            <section class="inner-page">
                              <div class="container">
                                <table class="table">';

                                echo '<thead>
                                  <tr>
                                    <th scope="col">ID</th>  
                                    <th scope="col">ID Jadwal</th>
                                    <th scope="col">ID User</th>
                                  </tr>
                                </thead>';

                                foreach ($data_body3['data'] as $row3) {
                                  echo "<tbody>
                                  <tr>
                                    <td>$row3[id]</td>
                                    <td>$row3[id_jadwal]</td>
                                    <td>$row3[id_user]</td>
                                    </tr>
                                  </tbody>";
                                }
                                echo      '</table>
                                        </div>
                                      </section>';
                                
                                }
                          ?>
                        </div>
                    </div>
                </main>