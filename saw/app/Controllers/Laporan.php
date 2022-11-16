<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HasilModel;
use Dompdf\Dompdf;

class Laporan extends BaseController
{
    protected $hasil;

    public function __construct()
    {
        $this->hasil = new HasilModel();
    }

    public function index()
    {
        $data['hasil'] = $this->hasil->join('alternatif', 'alternatif.id_alternatif = hasil.id_alternatif')
            ->orderBy('nilai', 'DESC')->findAll();

        return view('laporan/data', $data);
    }

    public function pdf()
    {
        $data['hasil'] = $this->hasil->join('alternatif', 'alternatif.id_alternatif = hasil.id_alternatif')
            ->orderBy('nilai', 'DESC')->findAll();
        $html = view('laporan/pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('hasil-penilaian.pdf', array('Attachment' => FALSE));
    }
}
