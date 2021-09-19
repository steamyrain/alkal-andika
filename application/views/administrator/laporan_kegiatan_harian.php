<div class="container-fluid">
  <div class="alert alert-success" role="alert">
    <i class="fas fa-clipboard"></i> Laporan Kegiatan Harian
  </div>
  <?php echo $this->session->flashdata('pesan') ?>
  <?php 
    echo anchor(
      base_url('administrator/laporankegiatanharian/input'),
      '<button class="btn btn-sm btn-primary mb-3">
          <i class="fas fa-plus fa-sm"></i> 
          Tambah Data
      </button>'
    ) 
  ?>
  <?php
    echo anchor(
      base_URL('administrator/laporankegiatanharian/print'),
      '<button class="btn btn-sm btn-info mb-3">
          <i class="fa fa-print"></i> 
          Print
      </button>'
    ) 
  ?>
  <div style="overflow-x:auto;">
    <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
      <thead>
        <tr>
          <th class="text-center" rowspan="2">KegiatanId</th>
          <th class="text-center" colspan="2">Tanggal dan Waktu Kegiatan</th>
          <th class="text-center" rowspan="2">Uraian</th>
          <th class="text-center" rowspan="2">Lokasi</th>
          <th class="text-center" rowspan="2">Keterangan</th>
          <th class="text-center" rowspan="2">Aksi</th>
        </tr>
        <tr>
          <th class="text-center">Awal</th>
          <th class="text-center">Akhir</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<script type="text/JavaScript">
  let table;
  let laporanKegiatanHarian = [];

  function getLaporanKegiatanHarian() {
    return $.ajax({
        type: 'GET',
        url: '<?php echo base_url('administrator/laporankegiatanharian/api')?>',
        dataType: 'json',
        success: function (r){
            table.clear();
            table.rows.add(r).draw();
        }
    });
  }

  $(document).ready(function() {
    // initialize data table & its necessary config
    getLaporanKegiatanHarian() 
    table = $("#data-tabel").DataTable({
      responsive: true,
      dom: "lfrtip",
      columns: [
        {"data":"KegiatanId","visible":false,"searchable":false},
        {"data":"TanggalWaktuAwal"},
        {"data":"TanggalWaktuAkhir"},
        {"data":"Uraian"},
        {"data":"Lokasi"},
        {"data":"Keterangan"}
      ]
    });
  });

</script>
