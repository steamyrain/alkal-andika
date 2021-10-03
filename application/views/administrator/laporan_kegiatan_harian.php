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
  <div style="overflow-x:auto;">
    <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
      <thead>
        <tr>
          <th class="text-center" rowspan="2">KegiatanId</th>
          <th class="text-center" colspan="2">Tanggal dan Waktu Kegiatan</th>
          <th class="text-center" rowspan="2">Uraian</th>
          <th class="text-center" rowspan="2">Lokasi</th>
          <th class="text-center" rowspan="2">Keterangan</th>
          <th class="text-center" rowspan="2">Print</th>
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

  function base64ToArrayBuffer(base64){
      let binaryString = window.atob(base64);
      let binaryLen = binaryString.length;
      let bytes = new Uint8Array(binaryLen);
      for (var i = 0; i < binaryLen; i++) {
          var ascii = binaryString.charCodeAt(i);
          bytes[i] = ascii;
      }
      return bytes;
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
        {"data":"Keterangan"},
        {
            "data":"",
            "render":function(data,type,row,meta){    
                return '<div style="display: grid; place-items:center;"><button class="btn btn-sm btn-secondary btn-print" id="print-'+meta.row+'"><i class="fa fa-print"></i></button></div>'
            }
        },
        {
            "data":"",
            "render":function(data,type,row,meta){    
                return '<div style="display: grid;grid-template-columns: 1fr 1fr;grid-gap: 5px"><button class="btn btn-sm btn-danger btn-delete" id="del-'+meta.row+'"><i class="fa fa-trash"></i></button><button class="btn btn-sm btn-warning btn-edit" id="edt-'+meta.row+'"><i class="fa fa-edit"></i></button></div>'
            }
        }
      ]
    });
    $("#data-tabel>tbody").on('click','.btn-print',function(){
        let id = $(this).attr("id").match(/\d+/)[0];
        let KegiatanId = table.row(id).data()['KegiatanId'];
        let base_url = "<?php echo base_url('administrator/laporankegiatanharian/printapi'); ?>"
        $.ajax({
          type: 'GET',
          url: base_url+'?kegiatanid='+KegiatanId,
          statusCode: {
              200: function(r) {
                  let b = base64ToArrayBuffer(r);
                  let blob = new Blob([b],{type: "application/pdf"})
                  let link=document.createElement('a');
                  link.href=window.URL.createObjectURL(blob);
                  let today = new Date();
                  let dd = String(today.getDate()).padStart(2,'0');
                  let mm = String(today.getMonth()+1).padStart(2,'0');
                  let yyyy = today.getFullYear();
                  link.download=`laporan-kegiatan-harian-${dd+'/'+mm+'/'+yyyy}.pdf`;
                  link.click();
              }
          }
        });
    })
    $("#data-tabel>tbody").on('click','.btn-delete',function(){
        let id = $(this).attr("id").match(/\d+/)[0];
        let KegiatanId = table.row(id).data()['KegiatanId'];
        let base_url = "<?php echo base_url('administrator/laporankegiatanharian/api'); ?>"
        if(confirm('Yakin Hapus?')){
            $.ajax({
                type: 'DELETE',
                url: base_url+'?kegiatanid='+KegiatanId,
                success: function (){
                  location.reload()
                },
                fail: function(){
                  location.reload()
                }
            });
        }
    })
    $("#data-tabel>tbody").on('click','.btn-edit',function(){
        let id = $(this).attr("id").match(/\d+/)[0];
        let KegiatanId = table.row(id).data()['KegiatanId'];
        let base_url = "<?php echo base_url('administrator/laporankegiatanharian/edit'); ?>"
        window.location.href = base_url+`/${KegiatanId}`
    })
  });

</script>
