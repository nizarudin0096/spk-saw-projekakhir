<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah Data Kriteria</h3>
    </div>
    <form class="form-horizontal" action="<?php echo base_url('kriteria/ubah/' . $kriteria['id_kriteria']); ?>" method="post">
        <?= csrf_field() ?>
        <div class="box-body">

            <?= service('validation')->listErrors('my_list') ?>

            <div class="form-group">
                <label for="kode_kriteria" class="col-sm-2 control-label">Kode Kriteria</label>
                <div class="col-sm-4">
                    <input name="kode_kriteria" id="kode_kriteria" class="form-control" required type="text" value="<?php echo old('kode_kriteria', $kriteria['kode_kriteria']); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_kriteria" class="col-sm-2 control-label">Nama Kriteria</label>
                <div class="col-sm-4">
                    <input name="nama_kriteria" id="nama_kriteria" class="form-control" required type="text" value="<?php echo old('nama_kriteria', $kriteria['nama_kriteria']); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="bobot" class="col-sm-2 control-label">Bobot</label>
                <div class="col-sm-4">
                    <input name="bobot" id="bobot" required type="number" step="0.01" class="form-control" value="<?php echo old('bobot', $kriteria['bobot']); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="tipe" class="col-sm-2 control-label">Tipe</label>
                <div class="col-sm-4">
                    <select class="form-control" name="tipe" id="tipe" required>
                        <option value="">Pilih...</option>
                        <option value="Cost" <?php echo old('tipe', $kriteria['tipe']) == 'Cost' ? 'selected' : ''; ?>>Cost</option>
                        <option value="Benefit" <?php echo old('tipe', $kriteria['tipe']) == 'Benefit' ? 'selected' : ''; ?>>Benefit</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="text-center col-sm-6">
                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                <a href="<?php echo base_url('kriteria'); ?>" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>
</div>

<?= view('template/footer'); ?>