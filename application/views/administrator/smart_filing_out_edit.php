    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="<?=base_url('assets/input-tag')?>/src/jquery.tagsinput-revisited.js"></script>
     <link rel="stylesheet" href="<?=base_url('assets/input-tag')?>/src/jquery.tagsinput-revisited.css" />

<div class="container-fluid" ng-app="myApp" ng-controller="appCtrl">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

         <div class="col-lg-6">
       <div class="alert alert-success" role="alert">

       <h4 class="h3 mb-0 text-gray">  <i class="fas fa-clipboard"></i> Edit data (Surat Keluar) </h4>
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
                action="<?php echo base_url ('administrator/smart_filing_out/update_data_edit') ?>">

                <div class="form-group">
                    <label>Dikirim Kepada</label>
                    <input type="text" name="dikirim_kpd" value="<?=$smartfiling->dikirim_kpd?>" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label>No Surat</label>
                    <input type="text" name="no_surat" value="<?=$smartfiling->no_surat?>" class="form-control" required="">
                </div>

                 <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input type="date" name="tgl_surat" class="form-control" value="<?=$smartfiling->tgl_surat?>" required="">
                </div>

                 <div class="form-group">
                    <label>Perihal</label>
                    <input type="text" name="perihal" class="form-control" value="<?=$smartfiling->perihal?>" required="">
                </div>

                <div class="form-group">
                    <label>Tanggal Kirim</label>
                    <input type="date" name="tgl_kirim" class="form-control" value="<?=$smartfiling->tgl_kirim?>" required="">
                </div>

                 <div class="form-group">
                    <label>File Surat</label>
                    <input type="file" name="file_surat" class="form-control" value="<?=$smartfiling->file_surat?>" >
                </div>

                <div class="form-group">
                    <label>Tanda Terima</label>
                    <input type="text" name="td_terima" class="form-control" value="<?=$smartfiling->td_terima?>" required="">
                </div>


                <div class="form-group">
                    <label>Tanggal Disposisi</label>
                    <input type="date" name="tgl" class="form-control" value="<?=$smartfiling->tgl?>" >
                   
                   <!--  <input type="hidden" name="penginput"  value="<?php echo $this->session->userdata('username') ?>"> -->
                    <input type="hidden" name="id" value="<?=$smartfiling->id?>">
                </div>
                <div class="form-group">
                    <label>Kepada</label>
                     <input type="text" name="kepada" id="example" class="form-control" value="<?=$smartfiling->kepada?>">
                    
                </div>

                <div class="form-group">
                     <label>file</label>
                    <input type="file" name="file_disposisi" class="form-control" value="<?=$smartfiling->file?>">
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