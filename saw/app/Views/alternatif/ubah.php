<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Ubah Data Alternatif</h3>
    </div>
    <form class="form-horizontal" action="<?php echo base_url('alternatif/ubah/' . $alternatif['id_alternatif']);; ?>" method="post">
        <?= csrf_field() ?>
        <div class="box-body">

            <?= service('validation')->listErrors('my_list') ?>

            <div class="form-group">
                <label for="kode_alternatif" class="col-sm-2 control-label">Kode Alternatif</label>
                <div class="col-sm-4">
                    <input name="kode_alternatif" id="kode_alternatif" class="form-control" required type="text" value="<?php echo old('kode_alternatif', $alternatif['kode_alternatif']); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_alternatif" class="col-sm-2 control-label">Nama Alternatif</label>
                <div class="col-sm-4">
                    <input name="nama_alternatif" id="nama_alternatif" class="form-control" required type="text" value="<?php echo old('nama_alternatif', $alternatif['nama_alternatif']); ?>">
                </div>
            </div>

            <?php foreach ($kriteria as $row) : ?>

                <div class="form-group">
                    <label for="kriteria<?php echo $row['id_kriteria']; ?>" class="col-sm-2 control-label"><?php echo $row['nama_kriteria']; ?></label>
                    <div class="col-sm-4">
                        <select class="form-control" name="kriteria<?php echo $row['id_kriteria']; ?>" required>
                            <option value="">Pilih...</option>

                            <?php foreach ($sub[$row['id_kriteria']] as $row_sub) : ?>
                                <option value="<?php echo $row_sub['id_subkriteria']; ?>" <?php echo old('kriteria' . $row['id_kriteria'], $alt[$row['id_kriteria']]) == $row_sub['id_subkriteria'] ? 'selected' : ''; ?>><?php echo $row_sub['nama_subkriteria']; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
        <div class="box-footer">
            <div class="text-center col-sm-6">
                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                <a href="<?php echo base_url('alternatif'); ?>" class="btn btn-default">Batal</a>
            </div>
        </div>
    </form>
</div>

<?= view('template/footer'); ?>