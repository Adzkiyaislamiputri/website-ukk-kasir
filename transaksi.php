<?php
include('conn/koneksi.php');
include("header.php");

if (isset($_POST['tambah'])) {
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $no_meja = $_POST['no_meja'];

    $sql = $koneksi->query("INSERT INTO penjualan (tanggal_penjualan) VALUES ('$tanggal')");
    $id_transaksi_baru = mysqli_insert_id($koneksi);
    
    $sql = $koneksi->query("INSERT INTO pelanggan (pelanggan_id, nama_pelanggan, no_meja) VALUES ('$id_transaksi_baru', '$nama', '$nomeja')");
    $id_pelanggan_baru = mysqli_insert_id($koneksi);
    
    $menu_jumlah = $_POST['menu'];
    $jumlah_array = $_POST['jumlah'];
    foreach ($menu_jumlah as $i => $item) {
        $item_parts = explode("|", $item);
        $produk_id = $item_parts[0];
        $harga = $item_parts[1];
        $jumlah = $jumlah_array[$i];

        $sql3 = $koneksi->query("INSERT INTO detail penjualan (detail_id, produk_id, jumlah_produk, sub_total) VALUES ('$id_pelanggan_baru', '$produk_id', '$jumlah', '$harga')");
        $sql4 = $koneksi->query("UPDATE produk SET stok = stok - $jumlah  WHERE produk_id = '$produk_id'");
        $sql5 = $koneksi->query("UPDATE produk SET Terjual = Terjual + $jumlah WHERE produk_id = '$produk_id'");
    }

    header("Location: daftar-transaksi.php");
    exit();
}


?>

  
        <script>
            // Fungsi untuk menambahkan input field untuk menu
            function tambahMenu() {
                var container = document.getElementById("menuContainer");
                var newMenuInput = document.createElement("div");

                newMenuInput.innerHTML = `
                          <div class="">
                              <label for="menu" class="form-label">Menu</label>
                              <select id="menu" name="menu[]" class="form-control">
                                <option>Pilih Menu</option>
                                  <?php
                                  $sql6 = $koneksi->query("SELECT * FROM produk");
                                  while ($data= $sql6->fetch_assoc()) {
                                      echo "<option value='" . $data['produk_id'] . "|" . $data['harga'] . "'>" . $data['nama_produk'] . " - Rp." . number_format($data['harga']) ." - stok:" . $data['stok'] . "</option>";
                                  }
                                  ?>
                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="jumlah" class="form-label">jumlah</label>
                              <input type="number" min="1" class="form-control" id="jumlah" name="jumlah[]">
                          </div>
                `;

                container.appendChild(newMenuInput);
            }
        </script>        
      </head>
    
      <nav class="navbar navbar-expand-lg navbar-primary bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pelanggan</a>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="pilih-menu.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaksi.php">Transaksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <div class="p-4" id="main-content">
          <div class="card mt-5">
            <div class="card-body">
                <div class="container mt-5">
                    <h2>Tambah Transaksi</h2>
                    <form action="" method="POST">
                        <div class="col-2">
                            <label for="tanggal" class="form-label">Tanggal Transaksi</label>
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="tanggal" name="tanggal" readonly required>
                        </div>
                        <div>
                            <label for="nama" class="form-label">Nama Anda</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div>
                            <label for="nomeja" class="form-label">No Meja</label>
                            <input type="number" min="1" class="form-control" id="no_meja" name="no_meja" required>
                        </div>
                        <div id="menuContainer">
                          <div>
                              <label for="menu" class="form-label">Menu</label>
                              <select id="menu" name="menu[]" class="form-control">
                                <option>Pilih Menu</option>
                                <?php
                                    $sql7 = $koneksi->query("SELECT * FROM produk WHERE stok > 0");
                                    while ($data = $sql7->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $data['produk_id'] . '|' . $data['harga']; ?>"><?php echo $data['nama_produk'] . " - Rp." . number_format($data['harga']) . " - stok:" . $data['stok']; ?></option>

                                <?php } ?>

                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="jumlah" class="form-label">jumlah</label>
                              <input type="number" min="1" class="form-control" id="jumlah" name="jumlah[]" required>
                          </div>
                          
                        </div>

                        <button type="button" class="btn btn-warning me-3" onclick="tambahMenu()">Tambah Menu+</button>

                        <button type="submit" name="tambah" class="btn btn-primary">pesan</button>
                    </form>
                </div>            
            </div>
          </div>
        </div>
      </body>
    </html>