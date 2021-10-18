<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit user</h3>

                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <?php
                $errors = session()->getFlashData('errors');
                if (!empty($errors)) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <h5>Ada Kesalahan</h5>
                        <ul>
                            <?php foreach ($errors as $key => $value) { ?>
                                <li><?= esc($value) ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <?= form_open_multipart('user/update/' . $user['id_user']); ?>
                <div class="form-group">
                    <label>Nama User</label>
                    <input class="form-control" value="<?= $user['nama_user'] ?>" name="nama_user" placeholder="Enter User" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" value="<?= $user['email'] ?>" name="email" placeholder="Enter Email" required readonly>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" value="<?= $user['password'] ?>" name="password" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select name="level" class="form-control" id="">
                        <option value="<?= $user['level'] ?>"><?php if ($user['level'] == 1) {
                                                                    echo 'Admin';
                                                                } else {
                                                                    echo 'User';
                                                                } ?></option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Departemen</label>
                    <select name="id_dept" class="form-control" id="">
                        <option value="<?= $user['id_dept'] ?>"><?= $user['nama_dept'] ?></option>
                        <?php foreach ($dept as $key => $value) { ?>
                            <option value="<?= $value['id_dept'] ?>"><?= $value['nama_dept'] ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="row">
                    <div class="col-sm-4">
                        <label for="">Foto User</label>
                        <img src="<?= base_url('foto/' . $user['foto']) ?>" width="100px" alt="" srcset="">
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Ganti Foto</label>
                            <input class="form-control" name="foto" type="file">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <br>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('user') ?>" class="btn btn-warning">Kembali</a>
                </div>
                <?= form_close(); ?>

            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>