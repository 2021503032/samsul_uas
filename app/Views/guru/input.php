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
                  <h5><i class="icon fas fa-ban"></i> warning</h5>
                  <?php echo validation_list_errors(); ?>
                </div>
                <?php 
                } 
                ?>
                <?php echo csrf_field() ?>
                <?php 
                if (current_url(true)->getSegment(2) == "edit") {
                  ?>
                  <input type="hidden" name="param" id="param" value="<?php echo $edit_data['id_guru']; ?>">
                  <?php
                }
                ?>
                <div class="form-group">
                  <label for="id_guru">ID GURU</label>
                  <input type="text" name="id_guru" id="id_guru" value="<?php echo empty(set_value('id_guru')) ? (empty($edit_data['id_guru']) ? "": $edit_data['id_guru']) : set_value('id_guru'); ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label for="id_mapel">ID MAPEL</label>
                  <input type="text" name="id_mapel" id="id_mapel" value="<?php echo  empty(set_value('id_guru')) ? (empty($edit_data['id_mapel']) ? "": $edit_data['id_mapel']) : set_value('id_mapel'); ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label for="nama_guru">NAMA GURU</label>
                  <input type="text" name="nama_guru" id="nama_guru" value="<?php  echo empty(set_value('id_guru')) ? (empty($edit_data['nama_guru']) ? "": $edit_data['nama_guru']) : set_value('nama_guru'); ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label for="alamat_guru">ALAMAT GURU</label>
                  <input type="text" name="alamat_guru" id="alamat_guru" value="<?php echo empty(set_value('id_guru')) ? (empty($edit_data['alamat_guru']) ? "": $edit_data['alamat_guru']) : set_value('alamat_guru'); ?>" class="form-control">
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