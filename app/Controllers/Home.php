<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda' => [
                'title' => ' Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house-chimney',
                'aktif' => 'active',
            ],
            'guru' => [
                'title' => 'Data Guru',
                'link' => base_url(). '/guru',
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
                'aktif' => '',
            ],
        ];
        $breadcrumb = ' <div class="col-sm-6">
        <h1 class="m-0">Beranda</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Beranda</li>
        </ol>
      </div>';
        $data ['menu'] = $menu;
        $data ['breadcrumb'] = $breadcrumb;
        $data ['title_card'] = "Welcome To My Site";
        $data ['selamat_datang'] = "Selamat Datang di Aplikasi Sederhana";
        return view('template/content',$data);
    }
}
