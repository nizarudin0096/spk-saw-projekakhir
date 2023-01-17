<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Laporan</h3>
    </div>
    <div class="box-body">
        <a href="<?php echo base_url('laporan/pdf'); ?>" target='blank' class='btn btn-default'><img src="<?php echo base_url('assets/images/pdf.png'); ?>">&nbsp; Cetak PDF</a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Alternatif</th>
                        <th>Nama Alternatif</th>
                        <th>Nilai SAW</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($hasil as $row) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['kode_alternatif']; ?></td>
                            <td><?php echo $row['nama_alternatif']; ?></td>
                            <td><?php echo $row['nilai']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('template/footer'); ?>