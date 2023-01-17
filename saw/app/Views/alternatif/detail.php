<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Detail Data Alternatif</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td width="200">Kode Alternatif</td>
                    <td>: <?php echo $alternatif['kode_alternatif']; ?></td>
                </tr>
                <tr>
                    <td>Nama Alternatif</td>
                    <td>: <?php echo $alternatif['nama_alternatif']; ?></td>
                </tr>
                <?php foreach ($kriteria as $row) : ?>
                    <tr>
                        <td><?php echo $row['nama_kriteria']; ?></td>
                        <td>: <?php echo $sub[$row['id_kriteria']]; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('alternatif'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?= view('template/footer'); ?>