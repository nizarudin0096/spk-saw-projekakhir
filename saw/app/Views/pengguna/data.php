<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Data Pengguna</h3>
        <div class="box-tools">
            <a href="<?php echo base_url('pengguna/tambah'); ?>" class="btn btn-primary">Tambah Pengguna</a>
        </div>
    </div>
    <div class="box-body">
        <?php echo session()->getFlashdata('pesan'); ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTables1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pengguna as $row) : ?>
                        <tr>
                            <td></td>
                            <td><?php echo $row['nama_lengkap']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['level']; ?></td>
                            <td>
                                <a href="<?php echo base_url('pengguna/ubah/' . $row['id_pengguna']); ?>" class="btn btn-success btn-xs" title="Ubah">Ubah</a> &nbsp;
                                <?php if ($row['username'] != session('username')) : ?>
                                    <a href="#" data-href="<?php echo base_url('pengguna/hapus/' . $row['id_pengguna']); ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus">Hapus</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('template/footer'); ?>