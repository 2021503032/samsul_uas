<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'siswa';
    protected $primaryKey       = 'id_siswa';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['id_siswa','id_guru','nama_siswa', 'nama_kelas','alamat_siswa'];

}
