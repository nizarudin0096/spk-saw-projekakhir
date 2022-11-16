<?= view('template/header'); ?>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Penilaian</h3>
    </div>
    <div class="box-body">
        <?php if (!empty($message)) : ?>
            <div class="alert bg-warning" role="alert"><?= $message ?></div>
        <?php else : ?>
            <div class='table-responsive'>
                <table class='table table-bordered tabel-header'>
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Alternatif</th>
                            <?php foreach ($kriteria as $row) : ?>
                                <th><?php echo $row['nama_kriteria']; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatif as $row) : ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo $row['nama_alternatif']; ?></td>
                                <?php foreach ($kriteria as $row2) : ?>
                                    <td class="text-center"><?php echo $sub[$row['id_alternatif']][$row2['id_kriteria']]; ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class='table-responsive'>
                <table class='table table-bordered tabel-header'>
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Alternatif</th>
                            <?php foreach ($kriteria as $row) : ?>
                                <th><?php echo $row['kode_kriteria']; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatif as $row) : ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td width="200"><?php echo $row['kode_alternatif']; ?></td>
                                <?php foreach ($kriteria as $row2) : ?>
                                    <td class="text-center"><?php echo $bobot[$row['id_alternatif']][$row2['id_kriteria']]; ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php echo empty($rumus) ? '' : $rumus; ?>
            <br>

            <h3 class="page-header">Hasil</h3>
            <div class='table-responsive'>
                <table class='table table-bordered tabel-header'>
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Kode Alternatif</th>
                            <th>Nama Alternatif</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($hasil)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($hasil as $row) : ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?php echo $row['kode_alternatif']; ?></td>
                                    <td><?php echo $row['nama_alternatif']; ?></td>
                                    <td class="text-center"><?php echo $row['nilai']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= view('template/footer'); ?>