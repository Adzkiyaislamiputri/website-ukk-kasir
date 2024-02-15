<?php
include("header.php");
?>
      <body>
        
        <div class="p-4 col-6">
          <div class="card mt-5">
            <div class="card-body">
            <table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal Transaksi</th>
                <th>Nama Pemesan</th>
				<th>Menu</th>	
			</tr>
		</thead>
		<tbody>
        <?php
            include("conn/koneksi.php");

            $query = "SELECT penjualan_id, tanggal_penjualan FROM penjualan ORDER BY  penjualan_id DESC LIMIT 1";
            $result = mysqli_query($koneksi, $query);
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['penjualan_id'] . "</td>";
                echo "<td>" . $row['tanggal_penjualan'] . "</td>";
                ?>
                <td>
                  <?php
                  $query1 = "SELECT nama_pelanggan FROM pelanggan WHERE pelanggan_id = '".$row['penjualan_id']."'";
                  $result1 = mysqli_query($koneksi, $query1);
                  
                  while ($row1 = mysqli_fetch_assoc($result1)) {
                    echo $row1['nama_pelanggan'];
                  }
                  ?>
                </td>
                <td>
                    <table class="table table-bordered">
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
                            $query2 = "SELECT produk_id, penjualan_id, jumlah_produk, sub_total FROM detail_penjualan WHERE detail_id = '" . $row['penjualan_id'] . "'";
                            $result2 = mysqli_query($koneksi, $query2);

                            // Inisialisasi total harga
                            $totalHarga = 0;

                            while ($detailrow = mysqli_fetch_assoc($result2)) {
                                echo "<tr>";
                                
                                // Fetch NamaProduk
                                $query3 = "SELECT nama_produk FROM produk WHERE produk_id = '" . $detailrow['produk_id'] . "' ";
                                $result3 = mysqli_query($koneksi, $query3);

                                while ($row2 = mysqli_fetch_assoc($result3)) {
                                    echo "<td>" . $row2['nama_produk'] . "</td>";
                                }

                                echo "<td>" . $detailrow['jumlah_produk'] . " Pcs</td>";
                                echo "<td>RP." . $detailrow['sub_total'] . "</td>";
                                echo "</tr>";

                                // Tambahkan Subtotal ke total harga
                                $totalHarga += $detailrow['sub_total'];
                            }

                            // Menampilkan total harga di luar loop
                            echo "<tr>";
                            echo "<td colspan='2'><strong>Total Harga:</strong></td>";
                            echo "<td colspan='2'><strong>RP." . $totalHarga . ",00</strong></td>";
                            echo "</tr>";
                        ?>
                            
                        </tbody>
                    </table>
                </td>
                <?php
                echo "</tr>";
              }
              
        ?>
		</tbody>
	</table>
            </div>
          </div>
        </div>
      </body>
      
      <script>
        window.print()
      </script>