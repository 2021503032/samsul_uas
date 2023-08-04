<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mapel';
    protected $primaryKey       = 'id_mapel';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['id_mapel','id_guru','nama_mapel', 'nama_pengajar'];

}
