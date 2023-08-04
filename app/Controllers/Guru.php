<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;

class Guru extends BaseController
{
    protected $gm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->gm = new GuruModel();
        $this->menu = [
          'beranda' => [
              'title' => ' Beranda',
              'link' => base_url(),
              'icon' => 'fa-solid fa-house-chimney',
              'aktif' => '',
          ],
          'guru' => [
              'title' => 'Data Guru',
              'link' => base_url() . '/guru',
              'icon' => 'fa-solid fa-chalkboard-user',
              'aktif' => 'active',
          ],
          'siswa' => [
              'title' => 'Data Siswa',
              'link' => base_url() . '/siswa',
              'icon' => 'fa-solid fa-users',
              'aktif' => '',
          ],
          'mapel' => [
              'title' => 'Data Pelajaran',
              'link' => base_url() . '/mapel',
              'icon' => 'fa-solid fa-address-card',
              'aktif' => '',
          ],
      ];
      $this->rules = [
        'id_guru' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'ID GURU gak boleh kosong',
          ]
        ],
        'id_mapel' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'ID MAPEL gak boleh kosong',
          ]
        ],

        'nama_guru' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'NAMA GURU gak boleh kosong',
          ]
        ],
        'alamat_guru' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'ALAMAT GURU gak boleh kosong',
          ]
        ],
      ];
    }
    public function index()
    {
        $breadcrumb = ' <div class="col-sm-6">
        <h1 class="m-0">Guru</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="'.base_url().'">Beranda</a></li>
          <li class="breadcrumb-item active">Guru</li>
        </ol>
      </div>';
        $data ['menu'] = $this->menu;
        $data ['breadcrumb'] = $breadcrumb;
        $data ['title_card'] = "Data Guru";

        $query = $this->gm->find();
        $data ['data_guru'] = $query;
        return view('guru/content',$data);
    }
    public function tambah()
    {
        $breadcrumb = ' <div class="col-sm-6">
        <h1 class="m-0">Guru</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a hre f="'.base_url().'">Beranda</a></li>
          <li class="breadcrumb-item active"><a href="'.base_url().'/guru">Guru</a></li>
          <li class="breadcrumb-item active">Tambah Prodi</li>
        </ol>
      </div>';
        $data ['menu'] = $this->menu;
        $data ['breadcrumb'] = $breadcrumb;
        $data ['title_card'] = "Tambah Guru";
        $data ['action'] = base_url() . '/guru/simpan';
        return view('guru/input',$data);
    }
    public function simpan()
    {
  
      if (strtolower($this->request->getMethod()) !== 'post') {
        return redirect()->back()->withInput();
      }

      if (!$this->validate($this->rules)) {
       
        return redirect()->back()->withInput();
      }

      $dt = $this->request->getPost();
      try {
        $simpan = $this->gm->insert($dt);

        return redirect()->to('guru')->with('success','Data Berhasil Di Simpan' );
      } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        
        return redirect()->to('guru')->with('error', $e->getMessage());
        return redirect()->back()->withInput();
      }
    }

    public function hapus($id)
    {
      if (empty($id)) {
        return redirect()->back()->with('error','hapus data gagal dilakukan parameter tidak valid');
      }

      try {
        $this->gm->delete($id);
        return redirect()->to('guru')->with('success','Data guru dengan kode'. $id .'Berhasil Dihapus' );
      } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        return redirect()->to('guru')->with('error', $e->getMessage());
      }
     
    }
    public function edit ($id) 
    {
      $breadcrumb = ' <div class="col-sm-6">
      <h1 class="m-0">Guru</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a hre f="'.base_url().'">Beranda</a></li>
        <li class="breadcrumb-item active"><a href="'.base_url().'/guru">Guru</a></li>
        <li class="breadcrumb-item active">Edit Prodi</li>
      </ol>
    </div>';
      $data ['menu'] = $this->menu;
      $data ['breadcrumb'] = $breadcrumb;
      $data ['title_card'] = "Edit Guru";
      $data ['action'] = base_url() . '/guru/update';
      $data ['edit_data'] = $this->gm->find($id);
      return view('guru/input',$data);
    }
    public function update()
    {
      $dtEdit = $this->request->getPost();
      $param = $dtEdit['param'];
      unset($dtEdit['param']);
 
      if (!$this->validate($this->rules)) {
        return redirect()->back()->withInput();
      }
      try {
        $this->gm->update($param,$dtEdit);
        return redirect()->to('guru')->with('success','Data Berhasil Di Update' );
      } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        return redirect()->to('guru')->with('error', $e->getMessage());
      } 
    }
}
