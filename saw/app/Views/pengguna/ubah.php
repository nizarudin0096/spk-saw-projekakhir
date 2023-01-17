<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah Data Pengguna</h3>
    </div>
    <form class="form-horizontal" action="<?php echo base_url('pengguna/ubah/' . $pengguna['id_pengguna']); ?>" method="post">
        <div class="box-body">
            <?= csrf_field() ?>

            <?= service('validation')->listErrors('my_list') ?>

            <div class="form-group">
                <label for="nama_lengkap" class="col-sm-2 control-label">Nama Lengkap</label>
                <div class="col-sm-4">
                    <input name="nama_lengkap" id="nama_lengkap" class="form-control" required type="text" value="<?php echo old('nama_lengkap', $pengguna['nama_lengkap']); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-4">
                    <input name="username" id="username" class="form-control" required type="text" value="<?php echo old('username', $pengguna['username']); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="level" class="col-sm-2 control-label">Level</label>
                <div class="col-sm-4">
                    <select class="form-control" name="level" id="level" required>
                        <option value="">Pilih...</option>
                        <option value="Admin" <?php echo old('level', $pengguna['level']) == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="User" <?php echo old('level', $pengguna['level']) == 'User' ? 'selected' : ''; ?>>User</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="text-center col-sm-6">
                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                <a href="<?php echo base_url('pengguna'); ?>" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>
</div>

<?= view('template/footer'); ?>