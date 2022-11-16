<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Subkriteria</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td width="150">Nama Kriteria</td>
                    <td>: <?php echo $kriteria['kode_kriteria'] . " - " . $kriteria['nama_kriteria']; ?></td>
                </tr>
                <tr>
                    <td width="150">Bobot </td>
                    <td>: <?php echo $kriteria['bobot']; ?></td>
                </tr>
                <tr>
                    <td width="150">Tipe </td>
                    <td>: <?php echo $kriteria['tipe']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('kriteria'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a> &nbsp;
                        <a href="<?php echo base_url('subkriteria/tambah/' . $kriteria['id_kriteria']); ?>" class="btn btn-primary">Tambah Subkriteria</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <?php echo session()->getFlashdata('pesan'); ?>
            <table class="table table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Subkriteria</th>
                        <th>Bobot</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subkriteria as $row) : ?>
                        <tr>
                            <td></td>
                            <td><?php echo $row['nama_subkriteria']; ?></td>
                            <td><?php echo $row['bobot']; ?></td>
                            <td>
                                <a href="<?php echo base_url('subkriteria/ubah/' . $kriteria['id_kriteria'] . '/' . $row['id_subkriteria']); ?>" class="btn btn-success btn-xs" title="Ubah">Ubah</a> &nbsp;
                                <a href="#" data-href="<?php echo base_url('subkriteria/hapus/' . $kriteria['id_kriteria'] . '/' . $row['id_subkriteria']); ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('template/footer'); ?>