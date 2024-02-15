<div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar pengguna</h4>
                        <?php 
                        if ($_SESSION['level'] == "Admin") {
                        ?>
                        <a href="?page=tambah-user" class="btn btn-primary btn-sm">Tambah User</a>
                        <?php
                        }
                        ?>
                    <p class="card-description">
                    <!-- Add class <code>.table</code> -->
                       
                    </p>

                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Level</th>
                                        <?php if ($_SESSION['level'] == "Admin") { ?>
                                        <th>Pilihan</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $no = 1;    
                                    $sql = $koneksi->query("SELECT * FROM user");
                                    while ($data= $sql->fetch_assoc()) {
                                        
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['username']; ?></td>
                                    <td><?php echo $data['password']; ?></td>
                                    <td><?php echo $data['level']; ?></td>
                                    <?php if ($_SESSION['level'] == "Admin") { ?>
                                    <td><a type='button' href='?page=edit-user&user_id=<?= $data['user_id']; ?>' class='btn btn-sm btn-warning'>Edit</a><a type='button' href='?page=hapus-user&user_id=<?= $data['user_id']; ?>' class='btn btn-sm btn-danger'>Delete</a></td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>