<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlternatifKriteriaModel;
use App\Models\AlternatifModel;
use App\Models\HasilModel;
use App\Models\KriteriaModel;
use App\Models\SubkriteriaModel;

class Penilaian extends BaseController
{
    protected $alternatif;
    protected $alternatif_kriteria;
    protected $kriteria;
    protected $subkriteria;
    protected $hasil;

    public function __construct()
    {
        $this->alternatif = new AlternatifModel();
        $this->alternatif_kriteria = new AlternatifKriteriaModel();
        $this->kriteria = new KriteriaModel();
        $this->subkriteria = new SubkriteriaModel();
        $this->hasil = new HasilModel();
    }

    public function index()
    {
        $data['alternatif'] = $this->alternatif->findAll();
        $data['kriteria'] = $this->kriteria->findAll();
        $alternatif_kriteria = $this->alternatif_kriteria->findAll();

        $jml_data = count($data['alternatif']) * count($data['kriteria']);
        if ($jml_data == count($alternatif_kriteria)) {
            if (count($data['alternatif']) > 0) {

                foreach ($data['alternatif'] as $row_alt) {
                    foreach ($data['kriteria'] as $row) {
                        $alt = $this->alternatif_kriteria->where('id_kriteria', $row['id_kriteria'])
                            ->where('id_alternatif', $row_alt['id_alternatif'])->first();
                        $sub = empty($alt) ? '' : $this->subkriteria->find($alt['id_subkriteria']);

                        $data['sub'][$row_alt['id_alternatif']][$row['id_kriteria']] = empty($sub) ? '' : $sub['nama_subkriteria'];
                        $data['bobot'][$row_alt['id_alternatif']][$row['id_kriteria']] = empty($sub) ? '' : $sub['bobot'];
                    }
                }

                // panggil hasil perhitungan metode SAW
                $hasil = $this->saw($data['alternatif'], $data['kriteria']);
                $data['hasil'] = $hasil['saw'];
                $data['rumus'] = $hasil['rumus'];
            }
        } else {
            $data['message'] = 'Data alternatif belum lengkap';
        }

        return view('penilaian', $data);
    }

    // perhitungan metode SAW
    public function saw($alternatif, $kriteria)
    {
        $var_rumus = ''; // variabel untuk menampilkan langkah perhitungan

        // mencari nilai matriks keputusan X
        foreach ($alternatif as $row_alt) {
            foreach ($kriteria as $row) {
                $alt = $this->alternatif_kriteria->where('id_kriteria', $row['id_kriteria'])
                    ->where('id_alternatif', $row_alt['id_alternatif'])->first();
                $sub = empty($alt) ? '' : $this->subkriteria->find($alt['id_subkriteria']);

                $arr_X[$row_alt['id_alternatif']][$row['id_kriteria']] = empty($sub) ? 0 : $sub['bobot'];
            }
        }

        // mencari nilai matriks R
        $var_rumus .= '<h3 class="page-header">Normalisasi Matriks</h3>';
        $i = 0;
        foreach ($kriteria as $row_k) {
            $var_rumus .= '<h4>Kriteria ' . $row_k['kode_kriteria'] . '</h4>';
            $j = 0;
            foreach ($alternatif as $row) {
                $show_j = $j + 1; // untuk kebutuhan menampilkan langkah perhitungan
                $show_i = $i + 1; // untuk kebutuhan menampilkan langkah perhitungan
                $show_array = implode("; ", array_column($arr_X, $row_k['id_kriteria'])); // untuk kebutuhan menampilkan langkah perhitungan

                if ($row_k['tipe'] == 'Cost') {
                    $min = min(array_column($arr_X, $row_k['id_kriteria']));
                    $arr_R[$row['id_alternatif']][$row_k['id_kriteria']] = $min / $arr_X[$row['id_alternatif']][$row_k['id_kriteria']];

                    // untuk kebutuhan menampilkan langkah perhitungan
                    $var_rumus .= "r<sub>" . $show_j . "" . $show_i . "</sub> = ";
                    $var_rumus .= "min{" . $show_array . "} / " . $arr_X[$row['id_alternatif']][$row_k['id_kriteria']] . " = ";
                    $var_rumus .= $min . " / " . $arr_X[$row['id_alternatif']][$row_k['id_kriteria']] . " = " . round($arr_R[$row['id_alternatif']][$row_k['id_kriteria']], 4);
                } elseif ($row_k['tipe'] == 'Benefit') {
                    $max = max(array_column($arr_X, $row_k['id_kriteria']));
                    $arr_R[$row['id_alternatif']][$row_k['id_kriteria']] = $arr_X[$row['id_alternatif']][$row_k['id_kriteria']] / $max;

                    // untuk kebutuhan menampilkan langkah perhitungan
                    $var_rumus .= "r<sub>" . $show_j . "" . $show_i . "</sub> = ";
                    $var_rumus .= $arr_X[$row['id_alternatif']][$row_k['id_kriteria']] . " / max{" . $show_array . "} = ";
                    $var_rumus .= $arr_X[$row['id_alternatif']][$row_k['id_kriteria']] . " / " . $max . " = " . round($arr_R[$row['id_alternatif']][$row_k['id_kriteria']], 4);
                }

                $var_rumus .= "<br>";
                $j++;
            }
            $i++;
        }

        $tampil_hasil = ''; // digunakan untuk kebutuhan menampilkan langkah perhitungan
        $tampil_hasil = '<table class="table table-bordered"><tbody>';
        foreach ($alternatif as $row) {
            $tampil_hasil .= '<tr>';
            foreach ($kriteria as $row_k) {
                $tampil_hasil .= '<td class="text-center">' . round($arr_R[$row['id_alternatif']][$row_k['id_kriteria']], 4) . '</td>';
            }
            $tampil_hasil .= '</tr>';
        }
        $tampil_hasil .= '</tbody></table>';

        $var_rumus .= '<br><h3 class="page-header">Hasil Matriks Normalisasi</h3>';
        $var_rumus .= $tampil_hasil;

        $var_rumus .= '<br><h3 class="page-header">Bobot Preferensi W</h3>';
        $var_rumus .= 'W = [';

        // mencari nilai bobot preferensi W
        foreach ($kriteria as $row) {
            $bobot[$row['id_kriteria']] = $row['bobot'];
            $var_rumus .= $bobot[$row['id_kriteria']] . ", ";
        }

        $var_rumus = substr($var_rumus, 0, -2);
        $var_rumus .= '] <br>';

        $var_rumus .= '<br><h3 class="page-header">Menghitung Nilai V</h3>';
        $var_rumus .= '<table class="table table-bordered"><tbody>';

        // mencari nilai v
        foreach ($alternatif as $row) {
            $nilai_v = 0;
            $var_rumus .= '<tr>';
            $var_rumus .= '<td>' . $row['kode_alternatif'] . '</td>';

            $string_tampil = ''; // untuk kebutuhan menampilkan langkah perhitungan
            foreach ($kriteria as $row_k) {
                $nilai_v += $bobot[$row_k['id_kriteria']] * $arr_R[$row['id_alternatif']][$row_k['id_kriteria']];
                $string_tampil .= '(' . $bobot[$row_k['id_kriteria']] . ')(' . round($arr_R[$row['id_alternatif']][$row_k['id_kriteria']], 4) . ') + ';
            }
            $v[$row['id_alternatif']]['kode_alternatif'] = $row['kode_alternatif'];
            $v[$row['id_alternatif']]['nama_alternatif'] = $row['nama_alternatif'];
            $v[$row['id_alternatif']]['nilai'] = round($nilai_v, 4);

            $string_tampil = substr($string_tampil, 0, -2);
            $var_rumus .= '<td>' . $string_tampil . '</td>';
            $var_rumus .= '<td>' . $v[$row['id_alternatif']]['nilai'] . '</td>';
            $var_rumus .= '</tr>';

            // masukkan ke tabel hasil
            $hasil = $this->hasil->where('id_alternatif', $row['id_alternatif'])->first();
            $params = [
                'id_hasil' => empty($hasil) ? null : $hasil['id_hasil'],
                'id_alternatif' => $row['id_alternatif'],
                'nilai' => $v[$row['id_alternatif']]['nilai'],
            ];
            $this->hasil->save($params);
        }

        $var_rumus .= '</tbody></table>';

        // urutkan berdasarkan nilai terbesar
        $this->array_sort_by_column($v, 'nilai');

        $hasil['rumus'] = $var_rumus;
        $hasil['saw'] = $v;

        return $hasil;
    }

    // fungsi untuk mengurutkan data berdasarkan nilai terbesar
    public function array_sort_by_column(&$arr, $col, $dir = SORT_DESC)
    {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }
        return array_multisort($sort_col, $dir, $arr);
    }
}
