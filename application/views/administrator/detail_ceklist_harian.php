<div class="container-fluid" ng-app="myApp" ng-controller="appCtrl">

  <div class="row">
    <div class="col-lg-12">
       <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> E- Ceklist (Detail Laporan Harian)  
    </div>

        <form class="form-inline">
          
            <button type="button" class="btn btn-dark mb-2" data-toggle="modal" data-target="#cetakPerencanaan">
              <i class="fas fa-print"></i> Cetak
            </button> 
        </form>
        
      </div>
    </div>
 


    <?php echo $this->session->flashdata('pesan') ?>
  <!--   <table class="table table-bordered teble-striped"> -->

    

    <div class="table-responsive">
    <table id="data-tabel" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th class="text-center">No</th>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Nama Mekanik</th>
        <th class="text-center">Kendaraan</th>
        <th class="text-center">No Identitas</th>
        <th class="text-center">Item Ceklist</th>
        <th class="text-center">Kondisi</th>
        <th class="text-center">Keterangan</th>
      </tr>

      </thead>
      <tbody>
      <?php $no =1;foreach ($laphar as $value): ?>
        <tr >
          <td><?= $no++; ?></td>
          <td><?= $value->tanggal; ?> </td>
          <td><?= $value->nama_mekanik; ?></td>
          <td><?= $value->kendaraan; ?></td>
          <td><?= $value->serial; ?></td>
          <td><?= $value->nama_item; ?></td>
          <td><?= $value->kondisi; ?></td>
          <td><?= $value->keterangan; ?></td>
        </tr>
    <?php endforeach ?>
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
        <h5 class="modal-title">Cetak Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card shadow mb-4">
              <!-- Card Header - Accordion -->
              <a href="#collapseCardExample_1" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample_1">
                  <h6 class="m-0 font-weight-bold text-primary">Download Laporan Harian</h6>
              </a>
              <!-- Card Content - Collapse -->
              <div class="collapse" id="collapseCardExample_1" style="">
                  <div class="card-body">
                      <form action="<?php echo base_url('administrator/Ceklist_harian/printpdf/'.$this->uri->segment(4)) ?>" method="post">
                        <div class="form-group">
                          <label> Tanggal </label>
                          <input type="date" name="tanggal"class="form-control" required/>
                        </div>

                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Alat / Kendaraan</label><br>
                          <select type="text" class="form-control select2" id="exampleFormControlSelect1" name="kendaraan" style="width: 100%;height: 60px">
                            <option value="">Pilih</option>
                                  <?php foreach ($kendaraan as $k) : ?>
                                  <option value="<?php echo $k->category ?> <?php echo $k->type ?>"><?php echo $k->category ?>
                                      <?php echo $k->type ?></option>

                                  <?php endforeach; ?>
                                 <!--  <hr>

                                  <option value="">--- Dump Truck ---</strong></option>
                                  <?php foreach ($dump_truck as $d) : ?>
                                  <option value="Dump Truck <?php echo $d->category ?>"> Dump Truck <?php echo $d->category ?>
                                  </option>

                                      <?php endforeach; ?> -->
                            </select>
                          </div>

                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Nomer Identitas</label>
                         <select class="form-control select2" id="serial" name="serial" style="width: 100%;height: 60px">
     <option value="">Pilih No</option>
     <?php foreach ($serial as $s) : ?>

      <?php 
      if($s->serial_number == ''){
          echo '<option value="'.$s->plate_number.'">'.$s->plate_number.'</option>';
      }else if($s->plate_number == ''){
          echo '<option value="'.$s->serial_number.'">'.$s->serial_number.'</option>';
    }else {
                    
    }
      
     ?>

    <?php endforeach; ?>
  </select>
                          </div>

                        <button type="submit" class="btn btn-danger"><i class="fas fa-download"></i> &nbsp PDF</button>
                      </form>
                  </div>
              </div>
          </div>

          <div class="card shadow mb-4">
              <!-- Card Header - Accordion -->
              <a href="#collapseCardExample_2" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample_2">
                  <h6 class="m-0 font-weight-bold text-primary">Download Laporan Berskala</h6>
              </a>
              <!-- Card Content - Collapse -->
              <div class="collapse" id="collapseCardExample_2" style="">
                  <div class="card-body">
                      <form action="<?php echo base_url('administrator/perencanaan/download_excel_perencanaan') ?>" method="post">
                        <div class="form-group">
                          <label> Tanggal Awal </label>
                          <input type="date" name="tanggal"class="form-control" required/>
                        </div>
                        <div class="form-group">
                          <label> Tanggal Akhir </label>
                          <input type="date" name="tanggal"class="form-control" required/>
                        </div>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-download"></i> &nbsp PDF</button>
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

     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/JavaScript">
  $(document).ready(function() {
    var table = $('#data-tabel').DataTable( {
        lengthChange: false,
         buttons: [
            {
            //     extend: 'print',
            //     exportOptions: {
            //         columns: ':visible'
            //     }
            // },
            //  {
            //     extend: 'pdf',
            //     exportOptions: {
            //         columns: ':visible'
            //     }
            // },
            //  {
            //     extend: 'excel',
            //     exportOptions: {
            //         columns: ':visible'
            //     }
            },
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: false
        } ]
    } );
 
    table.buttons().container()
        .appendTo( '#data-tabel_wrapper .col-md-6:eq(0)' );


  $('.select2').select2({
            allowClear:true,
  });



} );
</script>