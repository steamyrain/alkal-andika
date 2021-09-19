<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="<?=base_url('assets/input-tag')?>/src/jquery.tagsinput-revisited.js"></script>
    <link rel="stylesheet" href="<?=base_url('assets/input-tag')?>/src/jquery.tagsinput-revisited.css" />


<div class="container-fluid" ng-app="myApp" ng-controller="appCtrl">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      
         <div class="col-lg-6">
       <div class="alert alert-success" role="alert">
       <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-clipboard"></i> Tambah data (Surat Keluar)</h1>
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
                action="<?php echo base_url('administrator/smart_filing_out/tambah_data_aksi') ?>">

                <div class="form-group">
                    <label>Dikirim Kepada</label>
                    <input type="text" name="dikirim_kpd" id="example" class="form-control" required="">
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
                    <label>Tanggal Kirim</label>
                    <input type="date" name="tgl_kirim" class="form-control" required="">
                </div>

                 <div class="form-group">
                    <label>File Surat</label>
                    <input type="file" name="file_surat" class="form-control" required="">
                </div>

                 <div class="form-group">
                    <label>Tanda Terima</label>
                    <input type="txt" name="td_terima" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
            </form>
        </div>
    </div>
    
    <script type="text/javascript">
    $('#example').tagsInput({

  // min/max number of characters
  minChars: 0,
  maxChars: null,

  // max number of tags
  limit: null,

  // RegExp
  validationPattern: null,

  // duplicate validation
  unique: true
  
});

</script>


               