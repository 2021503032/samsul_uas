<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'guru';
    protected $primaryKey       = 'id_guru';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['id_guru','id_mapel','nama_guru','alamat_guru'];

}
