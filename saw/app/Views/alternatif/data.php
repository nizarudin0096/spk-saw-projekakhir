<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Alternatif</h3>
        <div class="box-tools">
            <a href="<?php echo base_url('alternatif/tambah'); ?>" class="btn btn-primary">Tambah Alternatif</a>
        </div>
    </div>
    <div class="box-body">
        <?php echo session()->getFlashdata('pesan'); ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Alternatif</th>
                        <th>Nama Alternatif</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alternatif as $row) : ?>
                        <tr>
                            <td></td>
                            <td><?php echo $row['kode_alternatif']; ?></td>
                            <td><?php echo $row['nama_alternatif']; ?></td>
                            <td>
                                <a href="<?php echo base_url('alternatif/detail/' . $row['id_alternatif']); ?>" class="btn btn-info btn-xs" title="Detail">Detail</a> &nbsp;
                                <a href="<?php echo base_url('alternatif/ubah/' . $row['id_alternatif']); ?>" class="btn btn-success btn-xs" title="Ubah">Ubah</a> &nbsp;
                                <a href="#" data-href="<?php echo base_url('alternatif/hapus/' . $row['id_alternatif']); ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('template/footer'); ?>