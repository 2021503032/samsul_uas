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
                <form action="<?php echo $action; ?>" method="post" autocomplete="0ff">
                <div class="card-body">
                <?php if(validation_errors()) {
                 ?>
                 <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  <?php echo validation_list_errors(); ?>
                </div>
                <?php 
                } 
                ?>
                <?php echo csrf_field() ?>
                <?php 
                if (current_url(true)->getSegment(2) == "edit") {
                  ?>
                  <input type="hidden" name="param" id="param" value="<?php echo $edit_data['id_siswa']; ?>">
                  <?php
                }
                ?>
                <div class="form-group">
                  <label for="id_siswa">ID SISWA</label>
                  <input  type="text" name="id_siswa" id="id_siswa" value="<?php echo empty(set_value('id_siswa')) ? (empty($edit_data['id_siswa']) ? "": $edit_data['id_siswa']) : set_value('id_siswa'); ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label for="id_guru">ID GURU</label>
                  <input type="text" name="id_guru" id="id_guru" value="<?php echo  empty(set_value('id_siswa')) ? (empty($edit_data['id_guru']) ? "": $edit_data['id_guru']) : set_value('id_guru'); ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label for="nama_siswa">NAMA SISWA</label>
                  <input type="text" name="nama_siswa" id="nama_siswa" value="<?php  echo empty(set_value('id_siswa')) ? (empty($edit_data['nama_siswa']) ? "": $edit_data['nama_siswa']) : set_value('nama_siswa'); ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label for="nama_kelas">NAMA KELAS</label>
                  <input type="text" name="nama_kelas" id="nama_kelas" value="<?php  echo empty(set_value('id_siswa')) ? (empty($edit_data['nama_kelas']) ? "": $edit_data['nama_kelas']) : set_value('nama_kelas'); ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label for="alamat_siswa">ALAMAT SISWA</label>
                  <input type="text" name="alamat_siswa" id="alamat_siswa" value="<?php echo empty(set_value('id_siswa')) ? (empty($edit_data['alamat_siswa']) ? "": $edit_data['alamat_siswa']) : set_value('alamat_siswa'); ?>" class="form-control">
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                </div>
              </form>
              </div>
          </div>
          </div>
</div>

<?php 
echo $this->endSection();
?>