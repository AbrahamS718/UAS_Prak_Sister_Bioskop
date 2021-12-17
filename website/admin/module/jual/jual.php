<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Hasil Penjualan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="redirect.php?module=home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Penjualan</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-body">
                              <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                  <div class="card-body">
                                    <h4 class="card-title">Data Pembelian Pelanggan</h4>
                                    <p class="card-description">
                                      Edit dan Hapus data
                                    </p>
                                    <?php
                                      $aksi = 'module/jual/jual_action.php';
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
                                      <th scope="col">Aksi</th>
                                    </tr>
                                  </thead>';
  
                                  foreach ($data_body3['data'] as $row3) {
                                    echo "<tbody>
                                    <tr>
                                      <td>$row3[id]</td>
                                      <td>$row3[id_jadwal]</td>
                                      <td>$row3[id_user]</td>
                                      <td>
                                        <a href='$aksi?module=penjualan&act=hapus&id=$row3[id]' class='btn btn-danger'>Hapus</a>
                                      </td>
                                      </tr>
                                    </tbody>";
                                  }
                                  echo      '</table>
                                          </div>
                                        </section>';



                                        echo "<form class='forms-sample' action='$aksi?module=penjualan&act=update' method='POST'>
                                            <div class='form-group'>";
                                            echo "<label for='id'>ID Penjualan</label>
                                            <select name='id_jual' class='form-select'>";
                                            foreach ($data_body3['data'] as $row3) {
                                              echo "<option value='$row3[id]'>ID : '$row3[id]'</option>";
                                            }
                                            echo "</select>";
                                            echo "<label for='id'>ID Jadwal</label>
                                            <select name='id_jadwal' class='form-select'>";
                                            foreach ($data_body2['data'] as $row2) {
                                              echo "<option value='$row2[id]'>ID : '$row2[id]', Kursi : '$row2[kursi]'</option>";
                                            }
                                            echo "</select>";
                                            echo "<label for='id'>ID User</label>
                                            <select name='id_user' class='form-select'>";
                                            foreach ($data_body3['data'] as $row3) {
                                              echo "<option value='$row3[id_user]'>ID : '$row3[id_user]'</option>";
                                            }
                                            echo "</select>";

                                            echo "</div>
                                            <button type='submit' class='btn btn-primary mr-2'>Update</button>
                                            </form>";
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </main>