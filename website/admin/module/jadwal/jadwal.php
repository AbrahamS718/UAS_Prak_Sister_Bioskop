<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pengaturan Movies</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="redirect.php?module=home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Movies</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-body">
                              <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                  <div class="card-body">
                                    <h4 class="card-title">Form Jadwal</h4>
                                    <p class="card-description">
                                      Input Jadwal Baru
                                    </p>
                                    <?php
                                      $aksi = 'module/jadwal/jadwal_action.php';
                                        use GuzzleHttp\Client;

                                        try {
                                            $client = new Client([
                                                'base_uri' => 'http://127.0.0.1:6969',
                                                'timeout' => 5
                                            ]);
            
                                            $response =  $client->request('GET', '/api/list'); //Untuk data film
                                            $body = $response->getBody();
                                            $data_body = json_decode($body, true);

                                            $response2 =  $client->request('GET', '/api/movie'); //Untuk data penjualan
                                            $body2 = $response2->getBody();
                                            $data_body2 = json_decode($body2, true);
                                        } catch (RuntimeException $e) {
                                            echo $e->getMessage();
                                        }

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
                                    <th scope="col">Aksi</th>
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
                                            <a href='$aksi?module=movie&act=hapus&id=$row2[id]' class='btn btn-danger'>Hapus</a>
                                          </td>
                                        </tr>
                                        </tbody>";
                                }
                                echo      '</table>
                                        </div>
                                      </section>';

                                      

                                        echo "<form class='forms-sample' action='$aksi?module=movie&act=insert' method='POST'>
                                            <div class='form-group'>";
                                            echo "<label for='id_movies'>ID Movie</label>
                                            <select name='id_movies' class='form-select'>";
                                            foreach ($data_body['data'] as $row) {
                                              echo "<option value='$row[id]'>ID : '$row[id]', Judul : '$row[judul]'</option>";
                                            }
                                            echo "</select>
                                            <label for='value'>Kursi</label>
                                            <input type='text' class='form-control' name='kursi' placeholder='Kursi Penonton'>
                                            <label for='value'>Tanggal</label>
                                            <input type='date' class='form-control' name='tanggal' placeholder='Tanggal Tayang'>
                                            <label for='value'>Harga</label>
                                            <input type='text' class='form-control' name='harga' placeholder='Harga'>
                                            </div>
                                            <button type='submit' class='btn btn-primary mr-2'>Insert</button>
                                            </form>";


                                            echo "<br><br>";



                                            echo "<form class='forms-sample' action='$aksi?module=movie&act=update' method='POST'>
                                            <div class='form-group'>";
                                            echo "<label for='id_jadwal'>ID Jadwal</label>
                                            <select name='id_jadwal' class='form-select'>";
                                            foreach ($data_body2['data'] as $row2) {
                                              echo "<option value='$row2[id]'>ID : '$row2[id]'</option>";
                                            }
                                            echo "</select>";
                                            echo "<label for='id_movies'>ID Movie</label>
                                            <select name='id_movies' class='form-select'>";
                                            foreach ($data_body['data'] as $row) {
                                              echo "<option value='$row[id]'>ID : '$row[id]', Judul : '$row[judul]'</option>";
                                            }
                                            echo "</select>
                                            <label for='value'>Kursi</label>
                                            <input type='text' class='form-control' name='kursi' placeholder='Kursi Penonton'>
                                            <label for='value'>Tanggal</label>
                                            <input type='date' class='form-control' name='tanggal' placeholder='Tanggal Tayang'>
                                            <label for='value'>Harga</label>
                                            <input type='text' class='form-control' name='harga' placeholder='Harga'>
                                            </div>
                                            <button type='submit' class='btn btn-primary mr-2'>Update</button>
                                            </form>";


                                            echo "<br><br>";
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </main>