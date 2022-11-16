<?php

namespace App\Models;

use CodeIgniter\Model;

class AlternatifModel extends Model
{
    protected $table            = 'alternatif';
    protected $primaryKey       = 'id_alternatif';
    protected $allowedFields    = ['kode_alternatif', 'nama_alternatif'];
}
