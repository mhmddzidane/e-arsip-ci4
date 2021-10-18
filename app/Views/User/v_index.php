<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Data user</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <a href="<?= base_url('user/add') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus">Add</i></a>
                </div>

                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php
                if (session()->getFlashData('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h6><i class="icon fas fa-check"></i> Success! - ';
                    echo session()->getFlashData('pesan');
                    echo '</h6> </div>';
                }
                ?>
                <table class="table table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th width="80px">No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Foto</th>
                            <th>Departemen</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($user as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['nama_user']; ?></td>
                                <td><?= $value['email']; ?></td>
                                <td><?= $value['password']; ?></td>
                                <td><?php if ($value['level'] == 1) {
                                        echo 'Admin';
                                    } else {
                                        echo 'User';
                                    }  ?></td>
                                <td class="text-center"><img src="<?= base_url('foto/' . $value['foto']) ?>" width="40px" alt=""></td>
                                <td><?= $value['nama_dept']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('user/edit/' . $value['id_user']) ?>" class="btn btn-sm btn-warning" <?= $value['id_user'] ?>>Edit</a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete<?= $value['id_user'] ?>">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>


<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="modal-delete<?= $value['id_user']; ?>">
        <div class=" modal-dialog  ">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus <?= $value['nama_user']; ?> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('user/delete/' . $value['id_user']) ?>" type="submit" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>