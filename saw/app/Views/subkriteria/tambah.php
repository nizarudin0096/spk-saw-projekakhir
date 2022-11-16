<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah Data Subkriteria</h3>
    </div>
    <form class="form-horizontal" action="<?php echo base_url('subkriteria/tambah/' . $id_kriteria); ?>" method="post">
        <?= csrf_field() ?>
        <div class="box-body">

            <?= service('validation')->listErrors('my_list') ?>

            <div class="form-group">
                <label for="nama_subkriteria" class="col-sm-2 control-label">Nama Subkriteria</label>
                <div class="col-sm-4">
                    <input name="nama_subkriteria" id="nama_subkriteria" class="form-control" required type="text" value="<?php echo old('nama_subkriteria'); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="bobot" class="col-sm-2 control-label">Bobot</label>
                <div class="col-sm-4">
                    <input name="bobot" id="bobot" required type="number" class="form-control" value="<?php echo old('bobot'); ?>">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="text-center col-sm-6">
                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                <a href="<?php echo base_url('subkriteria/' . $id_kriteria); ?>" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>
</div>

<?= view('template/footer'); ?>