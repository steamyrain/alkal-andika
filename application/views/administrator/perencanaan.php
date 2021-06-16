<div class="container-fluid" ng-app="myApp" ng-controller="appCtrl">

  <div class="row">
    <div class="col-lg-12">
       <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Perencanaan & Pelaksanaan
    </div>

    

    <div class="card mb-3">
      <div class="card-header" style="background: yellow; color: black;"> Cetak & 
        Tambah Data
      </div>
      <div class="card-body">

        <form class="form-inline">
             <div class="from-group ">
                 <a class="btn btn-primary  mb-2 mr-2 " href="<?php echo base_url('administrator/perencanaan/tambah_data') ?>"><i class="fas fa-plus"> Tambah Data</i></a>
           </div>
          
           <button type="button" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#cetakPerencanaan">
              <i class="fas fa-print"></i> Exel
            </button> 

            <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#cetakPerencanaanpdf">
              <i class="fas fa-print"></i> Pdf
            </button> 
<!--
            <div class="form-group mb-2">
                          <label> Tanggal &nbsp</label>
                          <input type="date" name="tanggal"class="form-control" required/>
                        </div> -->
           
        </form>
        
      </div>
    </div>
 


    <?php echo $this->session->flashdata('pesan') ?>
  <!--   <table class="table table-bordered teble-striped"> -->

    

    <div class="table-responsive">
    <table id="data-tabel" class="table table-bordered table-striped" >
      <thead>
      <tr>
        <th class="text-center" rowspan="2">No</th>
        <th class="text-center" rowspan="2">Tanggal</th>
        <th class="text-center" colspan="5" style="background: red; color: #fff">Perencanaan</th>
        <th class="text-center" rowspan="2" >Action</th>
        <th class="text-center" colspan="5"  style="background: green; color: #fff">Pelaksanaan</th>
      </tr>
      <tr>
        <th class="text-center">Lokasi</th>
        <th class="text-center">Alat Kendaraan</th>
        <th class="text-center">No Indentitas</th>
        <th class="text-center">Pengguna</th>
        <th class="text-center">Perencanaan BBM</th>
        <th class="text-center">Lokasi</th>
        <th class="text-center">Pengguna</th>
        <th class="text-center">Pelaksanaan BBM</th>
        <th class="text-center">Status</th>
        <th class="text-center">Keterangan</th>
        <th></th>

        
      </tr>
      </thead>
      <tbody>
      <?php $i=1; foreach($perencanaan as $pr) : ?>
          
      <tr>
          <td><?php echo $i ?></td>
          <!--<td><?php echo date('d F Y', strtotime( $pr->tanggal)); ?></td>-->
          <td><?php echo $pr->tanggal ?></td>
          <td><?php echo $pr->lokasi ?></td>
          <td><?php echo $pr->kendaraan ?></td>
          <td><?php echo $pr->serial ?></td>
          <td><?php echo $pr->operator ?></td>
          <td><?php echo $pr->pr_bbm ?></td>
           <td>
              <center>
                  <a class="btn btn-sm btn-primary " href="<?php echo base_url('administrator/perencanaan/update_data/'.$pr->id_pr) ?>"><i class="fas fa-edit"></i></a>
                  <a onclick="return confirm('Yakin Hapus ?')" class="btn btn-sm btn-danger " href="<?php echo base_url('administrator/perencanaan/delete_data/'.$pr->id_pr) ?>"><i class="fas fa-trash"></i></a>
              </center>
          </td>
          <td><?php echo $pr->lokasi_baru ?></td>
          <td><?php echo $pr->operator_baru ?></td>
          <td><input style="width:100px " type="number" value="<?=$pr->pk_bbm?>" id="idx-<?=$pr->id_pr?>" onchange="updatePr('<?=$pr->id_pr?>')" /></td>
          
           <td style="vertical-align:middle">
            <?php if($pr->status == 1) { ?>
            <a href="<?=base_url();?>administrator/perencanaan/status/0/<?=$pr->id_pr;?>" class="btn btn-success"><i class="fas fa-check"></i></a>
            <?php } else { ?>
            <a href="<?=base_url();?>administrator/perencanaan/status/1/<?=$pr->id_pr;?>" class="btn btn-danger"><i class="fas fa-times"></i></a>
            <?php } ?>
            </td>

          <td><?php echo $pr->keterangan ?></td> 
          <td></td>
      </tr>
     

  <?php $i++; endforeach; ?>
  </tbody> 
  </table>
  
  </div>
    </div>
  </div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="cetakPerencanaan" tabindex="-1" aria-labelledby="cetakPerencanaan" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cetak Perencanaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card shadow mb-4">
              <!-- Card Header - Accordion -->
              <a href="#collapseCardExample_1" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample_1">
                  <h6 class="m-0 font-weight-bold text-primary">Download Perencanaan & Pelaksanaan</h6>
              </a>
              <!-- Card Content - Collapse -->
              <div class="collapse" id="collapseCardExample_1" style="">
                  <div class="card-body">
                      <form action="<?php echo base_url('administrator/perencanaan/download_excel') ?>" method="post">
                        <div class="form-group">
                          <label> Tanggal </label>
                          <input type="date" name="tanggal"class="form-control" required/>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> &nbspDownload Perencanaan & Pelaksanaan</button>
                      </form>
                  </div>
              </div>
          </div>

          <div class="card shadow mb-4">
              <!-- Card Header - Accordion -->
              <a href="#collapseCardExample_2" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample_2">
                  <h6 class="m-0 font-weight-bold text-primary">Download Perencanaan</h6>
              </a>
              <!-- Card Content - Collapse -->
              <div class="collapse" id="collapseCardExample_2" style="">
                  <div class="card-body">
                      <form action="<?php echo base_url('administrator/perencanaan/download_excel_perencanaan') ?>" method="post">
                        <div class="form-group">
                          <label> Tanggal </label>
                          <input type="date" name="tanggal"class="form-control" required/>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> &nbspDownload Perencanaan</button>
                      </form>
                  </div>
              </div>
          </div>
        
          <!-- <div class="form-group">
           <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> &nbspCetak Perencanaan</button>
          </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal PDF -->
<div class="modal fade" id="cetakPerencanaanpdf" tabindex="-1" aria-labelledby="cetakPerencanaanpdf" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cetak Perencanaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card shadow mb-4">
              <!-- Card Header - Accordion -->
              <a href="#collapseCardExample_1" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample_1">
                  <h6 class="m-0 font-weight-bold text-primary">Download Perencanaan & Pelaksanaan</h6>
              </a>
              <!-- Card Content - Collapse -->
              <div class="collapse" id="collapseCardExample_1" style="">
                  <div class="card-body">
                      <form action="<?php echo base_url('administrator/perencanaan/printpdf_pelaksanaan') ?>" method="post">
                        <div class="form-group">
                          <label> Tanggal </label>
                          <input type="date" name="tanggal"class="form-control" required/>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> &nbspDownload Perencanaan & Pelaksanaan</button>
                      </form>
                  </div>
              </div>
          </div>

          <div class="card shadow mb-4">
              <!-- Card Header - Accordion -->
              <a href="#collapseCardExample_2" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample_2">
                  <h6 class="m-0 font-weight-bold text-primary">Download Perencanaan</h6>
              </a>
              <!-- Card Content - Collapse -->
              <div class="collapse" id="collapseCardExample_2" style="">
                  <div class="card-body">
                      <form action="<?php echo base_url('administrator/perencanaan/printpdf') ?>" method="post">
                        <div class="form-group">
                          <label> Tanggal </label>
                          <input type="date" name="tanggal"class="form-control" required/>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> &nbspDownload Perencanaan</button>
                      </form>
                  </div>
              </div>
          </div>
        
          <!-- <div class="form-group">
           <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> &nbspCetak Perencanaan</button>
          </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css"></script>


<script type="text/JavaScript">
  $(document).ready(function() {
    var table = $('#data-tabel').DataTable( {
        
         buttons: [ 'colvis' ]
        
        
    } );
 
    table.buttons().container()
        .appendTo( '#data-tabel_wrapper .col-md-6:eq(0)' );
} );
</script>