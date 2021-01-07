<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Alat Berat 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>
    <?php 
    echo anchor(
        base_URL('administrator/alatberat/input'),
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
    ) 
    ?>
  <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
  	<tr>
  		<th class="text-center">Aksi</th>
  		<th class="text-center">S/N</th>
  		<th class="text-center">Nomor Polisi</th>
  		<th class="text-center">Kategori</th>
  		<th class="text-center">Sub Kategori</th>
  		<th class="text-center">Merek</th>
  		<th class="text-center">Tipe</th>
  		<th class="text-center">Aktif</th>
    </tr>
    </thead>
    <tbody>
  	<?php $no=1; foreach($alatBerat as $a) : ?>
  		<tr>
            <td>
                <div style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 5px;">
                <form style="display: none;" id="form-hapus-<?php echo $a->id; ?>" method="post" action="<?php echo base_URL('administrator/alatberat/hapus_aksi'); ?>">
                    <input type="number" name="id" value="<?php echo $a->id; ?>" readonly />
                </form>
                    <a
                    onclick="document.getElementById('form-hapus-<?php echo $a->id; ?>').submit()"
                    >
                        <div class="btn btn-danger btn-sm" onclick="javascript: return confirm('Yakin Hapus?')">
                            <i class="fa fa-trash"></i>
                        </div>
                    </a>
                    <a
                        href="<?php echo base_URL('administrator/alatberat/edit/').$a->id; ?>"
                    >
                        <div class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </div>
                    </a>
                </div>
            </td>
  			<td><?php echo $a->serial_number?></td>
  			<td><?php echo $a->plate_number?></td>
  			<td><?php echo $a->category ?></td>
  			<td><?php echo $a->sub_category ?></td>
  			<td><?php echo $a->brand ?></td>
  			<td><?php echo $a->type ?></td>
  			<td><?php echo $a->active ?></td>
  		</tr>
  	<?php endforeach; ?>
    </tbody>
  </table>
</div>
<script type="text/JavaScript">
$(document).ready(function() 
{
    // initialize data table & its necessary config
    var table = $("#data-tabel").DataTable({

        order: [[1, "desc"]],
        dom: "lBfrtip",
        buttons: [
            {
                extend: "collection",
                text: "Print",
                buttons: [
                    {
                        extend: "print",
                        text: "Print Table",
                        //title: "<h4 style="text-align:center;">Kinerja PJLP</h4>",
                        messageTop: 'UNIT ALKAL BINA MARGA PROVINSI DKI JAKARTA',
                        exportOptions: {
                          columns: [1, 2, 3, 4, 5,6,7]
                        }
                    }
                ]
            },
            {
                extend: "collection",
                text: "Export",
                buttons: [
                    {
                        extend: "csvHtml5",
                        text: "As CSV",
                        exportOptions: {
                          columns: [1, 2, 3, 4, 5,6,7]
                        }
                    }
                ]
            }
        ]
    });

    // append data table's button container for button collection
    table
    .buttons()
    .container()
    .appendTo($(".col-md-6:eq(0)", table.table().container()));
});
</script>
