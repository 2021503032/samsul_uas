<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MapelModel;

class Mapel extends BaseController
{
    protected $mm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->mm = new MapelModel();
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
              'aktif' => '',
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
              'aktif' => 'active',
          ],
      ];
      $this->rules = [
        'id_mapel' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'ID MAPEL gak boleh kosong',
          ]
        ],
        'id_guru' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'ID GURU gak boleh kosong',
          ]
        ],

        'nama_mapel' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'NAMA MAPEL gak boleh kosong',
          ]
        ],
      ];
    }
    public function index()
    {
        $breadcrumb = ' <div class="col-sm-6">
        <h1 class="m-0">Mapel</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="'.base_url().'">Beranda</a></li>
          <li class="breadcrumb-item active">Mapel</li>
        </ol>
      </div>';
        $data ['menu'] = $this->menu;
        $data ['breadcrumb'] = $breadcrumb;
        $data ['title_card'] = "Data Mapel";

        $query = $this->mm->find();
        $data ['data_mapel'] = $query;
        return view('mapel/content',$data);
    }
    public function tambah()
    {
        $breadcrumb = ' <div class="col-sm-6">
        <h1 class="m-0">Mapel</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a hre f="'.base_url().'">Beranda</a></li>
          <li class="breadcrumb-item active"><a href="'.base_url().'/mapel">Mapel</a></li>
          <li class="breadcrumb-item active">Tambah Mapel</li>
        </ol>
      </div>';
        $data ['menu'] = $this->menu;
        $data ['breadcrumb'] = $breadcrumb;
        $data ['title_card'] = "Tambah Mapel";
        $data ['action'] = base_url() . '/mapel/simpan';
        return view('mapel/input',$data);
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
        $simpan = $this->mm->insert($dt);

        return redirect()->to('mapel')->with('success','Data Berhasil Di Simpan' );
      } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        
        return redirect()->to('mapel')->with('error', $e->getMessage());
        return redirect()->back()->withInput();
      }
    }

    public function hapus($id)
    {
      if (empty($id)) {
        return redirect()->back()->with('error','hapus data gagal dilakukan parameter tidak valid');
      }

      try {
        $this->mm->delete($id);
        return redirect()->to('mapel')->with('success','Data Mapel dengan kode'. $id .'Berhasil Dihapus' );
      } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        return redirect()->to('mapel')->with('error', $e->getMessage());
      }
     
    }
    public function edit ($id) 
    {
      $breadcrumb = ' <div class="col-sm-6">
      <h1 class="m-0">Mapel/h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a hre f="'.base_url().'">Beranda</a></li>
        <li class="breadcrumb-item active"><a href="'.base_url().'/mapel">Mapel</a></li>
        <li class="breadcrumb-item active">Edit Mapel</li>
      </ol>
    </div>';
      $data ['menu'] = $this->menu;
      $data ['breadcrumb'] = $breadcrumb;
      $data ['title_card'] = "Edit Mapel";
      $data ['action'] = base_url() . '/mapel/update';
      $data ['edit_data'] = $this->mm->find($id);
      return view('mapel/input',$data);
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
        $this->mm->update($param,$dtEdit);
        return redirect()->to('mapel')->with('success','Data Berhasil Di Update' );
      } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        return redirect()->to('mapel')->with('error', $e->getMessage());
      } 
    }
}
