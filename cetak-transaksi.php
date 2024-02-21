<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplikasi Kasir</title>
  <link href="bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

        <div class="p-4 main-content">
          
          <div class="card col-6">
            <div class="card-body">
              <p style="text-align: center"> Korean Resto</p>
            ============================
        <?php
            include("conn/koneksi.php");

            $sql = $koneksi->query("SELECT * FROM penjualan ORDER BY penjualan_id DESC LIMIT 1");
            while ($data= $sql->fetch_assoc()) {
        ?>
               <p>ID Transaksi: <?php echo $data['penjualan_id']?></p>
                <p>Tanggal Transaksi: <?php echo $data['tanggal_penjualan']?></p>
                
                <?php
                    $sql2 = $koneksi->query("SELECT * FROM pelanggan WHERE pelanggan_id = '".$data['penjualan_id']."'");
                    while ($data2= $sql2->fetch_assoc()) { ?>
                      <p>Nama Pemesan: <?php echo $data2['nama_pelanggan'];?></p>
                      <P>No Meja: <?php echo $data2['no_meja'];?></p>
                    <?php } ?>
                    <tr>
                      ============================
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th class="col-1">Jumlah</th>
                                <th class="col-1">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                          // Fetch details for the current Penjualan
                          $sql3 = $koneksi->query("SELECT * FROM detail_penjualan WHERE detail_id = '" . $data['penjualan_id'] . "'");
                            
                          $totalharga = 0;

                          while ($data3= $sql3->fetch_assoc()) {
                        ?>
                            <tr>
                              <td>
                              <?php
                                $sql4 = $koneksi->query("SELECT * FROM produk WHERE produk_id = '" . $data3['produk_id'] . "' ");
                                while ($data4= $sql4->fetch_assoc()) {
                                    echo $data4['nama_produk'];
                                }
                              ?>
                              </td>
                              <td><?php echo $data3['jumlah_produk']?> Pcs</td>
                              <td>RP.<?php echo number_format($data3['sub_total']) ?></td>
                             
                            </tr>

                            <?php
                              $totalproduk = $data3['jumlah_produk'] * $data3['sub_total'];
                              $totalharga += $totalproduk;
                            }
                            ?>

                            <tr>
                            <td colspan='2'><strong>Total Harga:</strong></td>
                            <td colspan='2'><strong>RP.<?php echo number_format("$totalharga") ?></strong></td>
                            </tr>
                            

                        </tbody>
                    </table>
                    <?php } ?>
            ============================
            <p style="text-align: center"><?php  echo date('d-m-Y H:i:s'); ?></p>
            ============================
            <p style="text-align: center">Kritik & Saran Whatsapp: 085773115016</p>
            </div>
          </div>
        </div>
        <script>
        window.print()
      </script>
        
</body>
</html>
