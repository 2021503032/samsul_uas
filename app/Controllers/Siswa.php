<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;

class Siswa extends BaseController
{
    protected $sm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->sm = new SiswaModel();
        $this->menu = [
          'beranda' => [
              'title' => 'Beranda',
              'link' => base_url(),
              'icon' => 'fa-solid fa-house-chimney',
              'aktif' => '',
          ],
          'guru' => [
              'title' => 'Data Guru',
              'link' => base_url() . '/guru',
              'icon' => 'fa-solid fa-chalkboard-user',
              'aktif' => '',
          ],
          'siswa' => [
              'title' => 'Data Siswa',
              'link' => base_url() . '/siswa',
              'icon' => 'fa-solid fa-users',
              'aktif' => 'active',
          ],
          'mapel' => [
              'title' => 'Data Pelajaran',
              'link' => base_url() . '/mapel',
              'icon' => 'fa-solid fa-address-card',
              'aktif' => '',
          ],
      ];
      $this->rules = [
        'id_siswa' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'ID Siswa gak boleh kosong',
          ]
        ],
        'id_guru' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'ID Guru gak boleh kosong',
          ]
        ],

        'nama_siswa' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'NAMA Siswa gak boleh kosong',
          ]
        ],
        'nama_kelas' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Nama Kelas gak boleh kosong',
          ]
        ],
        'alamat_siswa' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Alamat Siswa gak boleh kosong',
          ]
        ],
      ];
    }
    public function index()
    {
        $breadcrumb = ' <div class="col-sm-6">
        <h1 class="m-0">SISWA</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="'.base_url().'">Beranda</a></li>
          <li class="breadcrumb-item active">Siswa</li>
        </ol>
      </div>';
        $data ['menu'] = $this->menu;
        $data ['breadcrumb'] = $breadcrumb;
        $data ['title_card'] = "Data Siswa";

        $query = $this->sm->find();
        $data ['data_siswa'] = $query;
        return view('siswa/content',$data);
    }
    public function tambah()
    {
        $breadcrumb = ' <div class="col-sm-6">
        <h1 class="m-0">SISWA</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active"><a hre f="'.base_url().'">Beranda</a></li>
          <li class="breadcrumb-item active"><a href="'.base_url().'/siswa">Siswa</a></li>
          <li class="breadcrumb-item">Tambah Siswa</li>
        </ol>
      </div>';
        $data ['menu'] = $this->menu;
        $data ['breadcrumb'] = $breadcrumb;
        $data ['title_card'] = "Tambah Siswa";
        $data ['action'] = base_url() . '/siswa/simpan';
        return view('siswa/input',$data);
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
        $simpan = $this->sm->insert($dt);

        return redirect()->to('siswa')->with('success','Data Berhasil Di Simpan' );
      } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        
        return redirect()->to('siswa')->with('error', $e->getMessage());
        return redirect()->back()->withInput();
      }
    }

    public function hapus($id)
    {
      if (empty($id)) {
        return redirect()->back()->with('error','hapus data gagal dilakukan parameter tidak valid');
      }

      try {
        $this->sm->delete($id);
        return redirect()->to('siswa')->with('success','Data guru dengan kode'. $id .'Berhasil Dihapus' );
      } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        return redirect()->to('siswa')->with('error', $e->getMessage());
      }
     
    }
    public function edit ($id) 
    {
      $breadcrumb = ' <div class="col-sm-6">
      <h1 class="m-0">Siswa</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a hre f="'.base_url().'">Beranda</a></li>
        <li class="breadcrumb-item active"><a href="'.base_url().'/siswa">Siswa</a></li>
        <li class="breadcrumb-item active">Edit Siswa</li>
      </ol>
    </div>';
      $data ['menu'] = $this->menu;
      $data ['breadcrumb'] = $breadcrumb;
      $data ['title_card'] = "Edit Siswa";
      $data ['action'] = base_url() . '/siswa/update';
      $data ['edit_data'] = $this->sm->find($id);
      return view('siswa/input',$data);
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
        $this->sm->update($param,$dtEdit);
        return redirect()->to('siswa')->with('success','Data Berhasil Di Update' );
      } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        return redirect()->to('siswa')->with('error', $e->getMessage());
      } 
    }
}
