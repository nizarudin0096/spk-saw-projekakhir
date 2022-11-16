<?php

namespace App\Models;

use CodeIgniter\Model;

class AlternatifKriteriaModel extends Model
{
    protected $table            = 'alternatif_kriteria';
    protected $primaryKey       = 'id_alternatif_kriteria';
    protected $allowedFields    = ['id_alternatif', 'id_kriteria', 'id_subkriteria'];
}
