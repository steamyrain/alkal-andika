<div class="container-fluid" ng-app="myApp" ng-controller="appCtrl">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

         <div class="col-lg-6">
       <div class="alert alert-success" role="alert">

       <h4 class="h3 mb-0 text-gray">  <i class="fas fa-clipboard"></i>  Tambah data (Surat Masuk) </h4>
    </div>
       </div>

    </div>

  
    
 <?php
    if($this->session->flashdata('error')){
        ?>
    
            <div class="alert alert-danger"><?=$this->session->flashdata('error')?></div>
    <?php
    }
    ?>
    <div class="card" style="width: 50%;">
        <div class="card-body">

            <form id="my-form" method="POST" enctype="multipart/form-data"
                action="<?php echo base_url ('administrator/smart_filing_in/tambah_data_aksi') ?>">

                <div class="form-group">
                    <label>Pengirim</label>
                    <input type="text" name="pengirim" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label>No Surat</label>
                    <input type="text" name="no_surat" class="form-control" required="">
                </div>

                 <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input type="date" name="tgl_surat" class="form-control" required="">
                </div>

                 <div class="form-group">
                    <label>Perihal</label>
                    <input type="text" name="perihal" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label>Tanggal Terima</label>
                    <input type="date" name="tgl_terima" class="form-control" required="">
                </div>

                 <div class="form-group">
                    <label>File Surat</label>
                    <input type="file" name="file_surat" class="form-control" required="">
                </div>

                <div class="form-group">
          <!--           <input type="hidden" name="tgl" class="form-control" required="" value=" ">
                    <input type="hidden" name="kepada" class="form-control" required="" value=" ">
                    <input type="hidden" name="file" class="form-control" required="" value=" "> -->
                    <input type="hidden" name="penginput"  value="<?php echo $this->session->userdata('username') ?>">
                </div>

                <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
            </form>
        </div>
    </div>

<!-- nama dbnya

pengirim
no_surat
tgl_surat
perihal
tgl_terima
file_surat
tgl
kepada
file
penginput
 -->

               