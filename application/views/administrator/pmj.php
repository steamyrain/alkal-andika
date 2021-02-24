<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
  <i class="fas fa-clipboard"></i> Kinerja Petugas Pemeliharaan Jalan dan Jembatan
  </div>

  <?php 
    echo anchor(
        'administrator/pmj/input',
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
    ) 
    ?>
    <?php
    echo anchor(
        'administrator/pmj/print_form',
        '<button class="btn btn-sm btn-info mb-3">
            <i class="fa fa-print"></i> 
            Print
        </button>'
    ) 
    ?>
    <?php
    echo anchor(
        'administrator/pmj/excel',
        '<button class="btn btn-sm btn-success mb-3">
            <i class="far fa-file-excel"></i>
            Jadikan Excel
        </button>'
    ) 
    ?>

  <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
      <tr>
      <th>Tanggal Penginputan</th>
      <th>Tanggal</th>
  		<th>No</th>
  		<th colspan="2">Waktu</th>
      <th>Nama</th>
  		<th>Bidang</th>
  		<th>Kegiatan</th>
      <th>Lokasi</th>
  		<th>Dokumentasi</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  	<?php $no=1; foreach($pmj as $k) : ?>
  		<tr>
        <td><?php echo $k->tanggal ?></td>
        <td><?php echo $k->tgl ?></td>
  			<td width="20px"><?php echo $no++ ?></td>
        <td><?php echo $k->waktu ?></td>
        <td><?php echo $k->pulang ?></td>
  			<td><?php echo $k->nama ?></td>
  			<td><?php echo $k->bidang ?></td>
  			<td><?php echo $k->kegiatan ?></td>
        <td><?php echo $k->lokasi ?></td>
            <td>
                    <img width="60px" src="<?php echo base_url().'assets/upload/'.$k->dokumentasi ?>">    
                  </td>
        <td onclick="javascript: return confirm('Yakin Hapus?')"><?php echo anchor('administrator/pmj/hapus/'.$k->no, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?></td>
  		</tr>
  	<?php endforeach; ?>
  </table>
  </tbody>
</div>
<script type="text/JavaScript">
$(document).ready(function() 
{
    // initialize data table & its necessary config
    var table = $("#data-tabel").DataTable({

        order: [[0, "desc"]],
        dom: "lBfrtip",
        buttons: [
          {
            extend: "collection",
            text: "Table controls",
            buttons: [
              {
                extend: "print",
                //title: "<h4 style="text-align:center;">Kinerja PJLP</h4>",
                messageTop: 'UNIT ALKAL BINA MARGA PROVINSI DKI JAKARTA',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5]
                }
              },
              {
                extend: "copyHtml5",
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5]
                }
              },
              {
                extend: "excelHtml5",
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
              },
              {
                extend: "csvHtml5",
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5]
                }
              },
              {
                extend: "pdfHtml5",
                exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5]
                }
              },
              {
                extend: "colvis",
                //text: 'Column Selection',
                collectionLayout: "fixed two-column",
                collectionTitle: "Select Columns to Display",
                postfixButtons: ["colvisRestore"],
                columnText: function(dt, idx, title) {
                  return idx + 1 + ": " + title;
                }
              }
            ]
        }]
    });

    // append data table's button container for button collection
    table
    .buttons()
    .container()
    .appendTo($(".col-md-6:eq(0)", table.table().container()));
});
</script>
