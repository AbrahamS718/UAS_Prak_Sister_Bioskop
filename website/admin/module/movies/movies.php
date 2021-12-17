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
                                    <h4 class="card-title">Form Movies</h4>
                                    <p class="card-description">
                                      Input Movies Baru
                                    </p>
                                    <?php
                                      $aksi = 'module/movies/movies_action.php';
                                        use GuzzleHttp\Client;

                                        try {
                                            $client = new Client([
                                                'base_uri' => 'http://127.0.0.1:6969',
                                                'timeout' => 5
                                            ]);
            
                                            $response =  $client->request('GET', '/api/list'); //Untuk data film
                                            $body = $response->getBody();
                                            $data_body = json_decode($body, true);
                                        } catch (RuntimeException $e) {
                                            echo $e->getMessage();
                                        }

                                        echo '<div class="card-header">
                                                  <i class="fas fa-table me-1"></i>
                                                  List Movies
                                              </div>
                                              <section class="inner-page">
                                                <div class="container">
                                                  <table class="table">';

                                                  echo '<thead>
                                                  <tr>
                                                    <th scope="col">ID Movies</th>  
                                                    <th scope="col">Judul</th>
                                                    <th scope="col">Sinopsis</th>
                                                    <th scope="col">Aksi</th>
                                                  </tr>
                                                </thead>';
                      
                                                foreach ($data_body['data'] as $row) {
                                                  echo "<tbody>
                                                        <tr>
                                                          <td>$row[id]</td>
                                                          <td>$row[judul]</td>
                                                          <td>$row[sinopsis]</td>
                                                          <td>
                                                            <a href='$aksi?module=movie&act=hapus&id=$row[id]' class='btn btn-danger'>Hapus</a>
                                                          </td>
                                                        </tr>
                                                        </tbody>";
                                                }
                                                echo      '</table>
                                                        </div>
                                                      </section>';

                                        echo "<form class='forms-sample' action='$aksi?module=movie&act=insert' method='POST'>
                                            <div class='form-group'>
                                            <label for='value'>Judul</label>
                                            <input type='text' class='form-control' name='judul' placeholder='Judul Film'>
                                            <label for='value'>Sinopsis</label>
                                            <input type='text' class='form-control' name='sinopsis' placeholder='Sinopsis Film'>
                                            </div>
                                            <button type='submit' class='btn btn-primary mr-2'>Insert</button>
                                            </form>";


                                            echo "<br><br>";



                                        echo "<form class='forms-sample' action='$aksi?module=movie&act=update' method='POST'>
                                            <div class='form-group'>";
                                          echo "<label for='id'>ID Movie</label>
                                          <select name='id' class='form-select'>";
                                            foreach ($data_body['data'] as $row) {
                                              echo "<option value='$row[id]'>ID : '$row[id]', Judul : '$row[judul]'</option>";
                                            }
                                            echo "</select>
                                            <label for='value'>Judul</label>
                                            <input type='text' class='form-control' name='judul' placeholder='Judul Film'>
                                            <label for='value'>Sinopsis</label>
                                            <input type='text' class='form-control' name='sinopsis' placeholder='Sinopsis Film'>
                                            </div>
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