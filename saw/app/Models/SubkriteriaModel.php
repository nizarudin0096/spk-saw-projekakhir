<?php

namespace App\Models;

use CodeIgniter\Model;

class SubkriteriaModel extends Model
{
    protected $table            = 'subkriteria';
    protected $primaryKey       = 'id_subkriteria';
    protected $allowedFields    = ['id_kriteria', 'nama_subkriteria', 'bobot'];
}
