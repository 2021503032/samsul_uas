<?php 
echo $this->extend('template/index');
echo $this->section('content');
?>

<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
              </div>
              <div class="card-body">
                <?php if (session()->getFlashdata('success')) {
                ?>
                  <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <h5><i class="icon fas fa-check"></i> Success</h5>
                  <?php echo  session()->getFlashdata('success') ; ?>
                </div> 
                <?php 
                } 
                ?>

                <?php if (session()->getFlashdata('error')) {
                ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <h5><i class="icon fas fa-check"></i> Error</h5>
                  <?php echo  session()->getFlashdata('error') ; ?>
                </div>
                <?php 
                } 
                ?>

                <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>/mapel/tambah"><i class="fa-solid fa-circle-plus"></i>&nbsp; Tambah Mapel</a>
              <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>ID MAPEL</th>
                      <th>ID GURU</th>
                      <th>NAMA MAPEL</th>
                      <th>NAMA PENGAJAR</th>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php 
                   $no=1;
                   foreach ($data_mapel as $r) {
                   ?>
                   <tr>
                    <td><?= $no; ?></td>
                    <td><?= $r ['id_mapel']; ?></td>
                    <td><?= $r ['id_guru']; ?></td>
                    <td><?= $r ['nama_mapel']; ?></td>
                    <td><?= $r ['nama_pengajar']; ?></td>
                    <td>
                      <a class="btn btn-xs btn-info" href="<?php echo base_url(); ?>/mapel/edit/<?php echo $r['id_mapel']; ?>"><i class="fa-solid fa-edit"></i>&nbsp; Ubah</a> 
                      <a class="btn btn-xs btn-danger" href="#" onclick="return hapusConfig(<?php echo $r['id_mapel']; ?>)"><i class="fa-solid fa-trash"></i>&nbsp; Hapus</a>
                    </td>
                   </tr>
                   <?php 
                   $no++;
                   }
                   ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
        </div>
</div>
<script>
 function hapusConfig(id) {
  Swal.fire({
  title: 'Anda yakin akan hapus data ini ?',
  text: "Data akan di hapus secara permanen",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
      window.location.href="<?php echo base_url(); ?>/mapel/hapus/" + id;
  }
  })
  }
</script>
<?php 
echo $this->endSection();
?>