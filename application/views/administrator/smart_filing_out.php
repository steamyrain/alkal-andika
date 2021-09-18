<div class="container-fluid" ng-app="myApp" ng-controller="appCtrl">

  <div class="row">
    <div class="col-lg-12">
       <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Smart Filing (Surat Keluar)
    </div>

    

   
            <div class="from-group ">
                 <a class="btn btn-primary  mb-3 ml-2 " href="<?php echo base_url('administrator/smart_filing_out/tambah_data') ?>">
              <i class="fas fa-folder"> &nbspTambah Data</i></a>
           </div>
    

 


    <?php echo $this->session->flashdata('pesan') ?>
  <!--   <table class="table table-bordered teble-striped"> -->

    

    <div class="table-responsive">
    <table id="data-tabel" class="table table-bordered table-striped" >
      <thead>
      <tr>
        <th class="text-center" rowspan="2">No</th>
        <th class="text-center" colspan="7" style="background: #66CDAA; color: black;">SURAT KELUAR</th>
        <th class="text-center" rowspan="2">Action</th>
        <th class="text-center" colspan="3" style="background: #66CDAA; color: black;">DISPOSISI</th>
      </tr>
      <tr>
        <th class="text-center">Dikirim Kepada</th>
        <th class="text-center">No Surat</th>
        <th class="text-center">Tanggal Surat</th>
        <th class="text-center">Perihal</th>
        <th class="text-center">Tanggal dikirim</th>
        <th class="text-center">File Surat</th>
        <th class="text-center">Tanda Terima</th>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Kepada</th>
        <th class="text-center">File</th>   
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
                  
                  <td class="text-center">
                    <ul>
                      <?php

                    $dikirim_kpd = "";
                    if(!empty($value->dikirim_kpd)){
                      $dikirim_kpd=explode(",", $value->dikirim_kpd);
                      for($i=0;$i<count($dikirim_kpd);$i++){
                        echo "<li>".$dikirim_kpd[$i]."</li>";
                      }
                    }

                  ?>
                </ul>
                    
                  </td>
                  
                  
                  
                  
                  <!--<td class="text-center"><?=$value->dikirim_kpd?></td>-->
                  <td class="text-center"><?=$value->no_surat?></td>
                  <td class="text-center"><?=$value->tgl_surat?></td>
                  <td class="text-center"><?=$value->perihal?></td>
                  <td class="text-center"><?=$value->tgl_kirim?></td>
                  <td class="text-center">
                    <a target="_blank" href="<?=base_url('/assets/uploads/'.$value->file_surat)?>">Download</a>
                  </td>


                  <td class="text-center"><?=$value->td_terima?></td>
                  <td class="text-center">
                    <a href="<?=base_url('administrator/smart_filing_out/edit/'.$value->id)?>" class="btn btn-info btn-sm mb-2" >Edit</a>
                    <a onclick="return confirm('Yakin data ini mau di hapus?')" href="<?=base_url('administrator/smart_filing_out/delete/'.$value->id)?>" class="btn btn-danger btn-sm" >Hapus</a>

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
                 <!--  <td class="text-center"><?=$value->penginput?></td> -->
    
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
