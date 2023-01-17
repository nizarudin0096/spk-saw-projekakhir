<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah Password</h3>
    </div>
    <form class="form-horizontal" action="<?php echo base_url('password'); ?>" method="post">
        <div class="box-body">
            <?= csrf_field() ?>

            <?= service('validation')->listErrors('my_list') ?>

            <?php echo session()->getFlashdata('pesan'); ?>

            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password Lama</label>
                <div class="col-sm-4">
                    <input name="password" id="password" class="form-control" required type="password">
                </div>
            </div>
            <div class="form-group">
                <label for="password_baru" class="col-sm-2 control-label">Password Baru</label>
                <div class="col-sm-4">
                    <input name="password_baru" id="password_baru" class="form-control" required type="password">
                </div>
            </div>
            <div class="form-group">
                <label for="ulangi" class="col-sm-2 control-label">Ulangi Password Baru</label>
                <div class="col-sm-4">
                    <input name="ulangi" id="ulangi" class="form-control" required type="password">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="text-center col-sm-6">
                <button type="submit" name="save" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>
</div>

<?= view('template/footer'); ?>