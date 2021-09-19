<div class="container-fluid" ng-app="myApp" ng-controller="appCtrl">

  <div class="row">
    <div class="col-lg-12">
       <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Smart Filing (Surat Masuk)
    </div>

    

   
            <div class="from-group ">
                 <a class="btn btn-primary  mb-3 ml-2 " href="<?php echo base_url('administrator/smart_filing_in/tambah_data') ?>">
              <i class="fas fa-folder"> &nbspTambah Data</i></a>
           </div>
    

   <?php
    if($this->session->flashdata('success')){
        ?>
    
            <div class="alert alert-success"><?=$this->session->flashdata('success')?></div>
    <?php
    }
    ?>

        <?php
    if($this->session->flashdata('error')){
        ?>
    
            <div class="alert alert-danger"><?=$this->session->flashdata('error')?></div>
    <?php
    }
    ?>

<!-- 
    <?php echo $this->session->flashdata('pesan') ?> -->
  <!--   <table class="table table-bordered teble-striped"> -->

    

    <div class="table-responsive">
    <table id="data-tabel" class="table table-bordered table-striped" >
      <thead>
      <tr>
        <th class="text-center" rowspan="2">No</th>
        <th class="text-center" colspan="6" style="background: #66CDAA; color: black;">SURAT MASUK</th>
        <th class="text-center" rowspan="2">Action</th>
        <th class="text-center" colspan="4" style="background: #66CDAA; color: black;">DISPOSISI</th>
      </tr>
      <tr>
        <th class="text-center">Pengirim</th>
        <th class="text-center">No Surat</th>
        <th class="text-center">Tanggal Surat</th>
        <th class="text-center">Perihal</th>
        <th class="text-center">Tanggal Terima</th>
        <th class="text-center">File Surat</th>   
        <th class="text-center">Tanggal</th>
        <th class="text-center">Kepada</th>
        <th class="text-center">File</th>
        <th class="text-center">Penginput</th>
      </tr>

      </thead>
      <tbody>
        <?php
          if($smartfiling){
            $no=1;
            foreach ($smartfiling as $key => $value) {
              ?>
                 <tr>
                    <td class="text-center"><?=$no++?></td>
                    <td class="text-center"><?=$value->pengirim?></td>
                  <td class="text-center"><?=$value->no_surat?></td>
                  <td class="text-center"><?=$value->tgl_surat?></td>
                  <td class="text-center"><?=$value->perihal?></td>
                  <td class="text-center"><?=$value->tgl_terima?></td>
                  <td class="text-center">
                    <a target="_blank" href="<?=base_url('/assets/uploads/'.$value->file_surat)?>">Download</a>
                  </td>
                  <td class="text-center">
                    <a href="<?=base_url('administrator/smart_filing_in/edit/'.$value->id)?>" class="btn btn-info btn-sm mb-2" >Edit</a>
                    <a onclick="return confirm('Yakin data ini mau di hapus?')" href="<?=base_url('administrator/smart_filing_in/delete/'.$value->id)?>" class="btn btn-danger btn-sm" >Hapus</a>

                  </td>  
                  <td class="text-center"><?=$value->tgl?></td>   
                  <td class="text-center">
                    <ul>
                      <?php

                    $kepada = "";
                    if(!empty($value->kepada)){
                      $kepada =explode(",", $value->kepada);
                      for($i=0;$i<count($kepada);$i++){
                        echo "<li>".$kepada[$i]."</li>";
                      }
                    }

                  ?>
                </ul>
                    
                  </td>
                   <td class="text-center">
                   <?php
                   if (!empty($value->file)) {
                     ?>
                      <a target="_blank" href="<?=base_url('/assets/uploads/'.$value->file)?>">Download</a>
                     <?php
                   }
                   ?>
                  </td>
                  <td class="text-center"><?=$value->penginput?></td>
    
                </tr>
              <?php
            }
          }
        ?>

      </tbody>
    </table>
  </div>
</div>
</div>
</div>
</div>


<script src="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css"></script>


<script type="text/JavaScript">
  $(document).ready(function() {
    var table = $('#data-tabel').DataTable( {
        
       
        
        
    } );
 
    table.buttons().container()
        .appendTo( '#data-tabel_wrapper .col-md-6:eq(0)' );
  });


  function editstatus(value,id){
   $.ajax({
    url:"<?=base_url();?>administrator/perencanaan/status/"+value+"/"+id,
    type:"get",
    success:function(res){
      console.log(res)
    },error:function(err){
       console.log(err)
    }
   })
  }
</script>
