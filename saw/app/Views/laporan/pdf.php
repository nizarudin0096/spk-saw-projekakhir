<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Hasil Penilaian Metode SAW</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
        }

        th {
            height: 30px;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 3px;
        }

        thead {
            background: lightgray;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2 class="center">HASIL PENILAIAN METODE SAW</h2>
    <table>
        <thead>
            <tr>
                <th width="50">No</th>
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
                    <td class="center"><?= $no++ ?></td>
                    <td class="center"><?= $row['kode_alternatif'] ?></td>
                    <td><?= $row['nama_alternatif'] ?></td>
                    <td class="center"><?= $row['nilai'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>