<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Alat Berat 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <?php 
    echo anchor(
        base_URL('administrator/surattugas/input'),
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
    ) 
    ?>

    <div style="overflow-x: auto;">
  <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
  	<tr>
  		<th class="text-center">Tanggal</th>
  		<th class="text-center">Lokasi</th>
        <th class="text-center">Pekerjaan</th>
  		<th class="text-center">Subjek</th>
  		<th class="text-center">Alat Berat</th>
  		<th class="text-center">Dump Truck</th>
  		<th class="text-center">Dokumen</th>
  		<th class="text-center">Aksi</th>
    </tr>
    </thead>
    <tbody>
  	<?php $i=0; foreach($suratTugas as $st) : ?>
        <?php $i++; ?>
  		<tr>
            <td><?php echo $st->date?></td>
  			<td><?php echo $st->location?></td>
  			<td><?php echo $st->job_desc?></td>
            <td>
                <form 
                    id="<?php echo 'form-subject-'.$i; ?>" 
                    style="display: none;" 
                    method="post" 
                    action="<?php echo base_URL('administrator/surattugas/detail_subjek')?>"
                > 
                    <input type="text" name="id" value="<?php echo $st->id; ?>">
                </form>
                <a 
                    href="#"
                    onclick="event.preventDefault();document.getElementById('form-subject-<?php echo $i; ?>').submit()"
                >
                    detail subjek
                </a>
            </td>
            <td>
                <form 
                    id="<?php echo 'form-heavy-'.$i; ?>" 
                    style="display: none;" 
                    method="post" 
                    action="<?php echo base_URL('administrator/surattugas/detail_heavy')?>"
                > 
                    <input type="text" name="id" value="<?php echo $st->id; ?>">
                </form>
                <a 
                    href="#"
                    onclick="event.preventDefault();document.getElementById('form-heavy-<?php echo $i; ?>').submit()"
                >
                    detail alat berat
                </a>
            </td>
            <td>
                <form 
                    id="<?php echo 'form-dt-'.$i; ?>" 
                    style="display: none;" 
                    method="post" 
                    action="<?php echo base_URL('administrator/surattugas/detail_dt')?>"
                > 
                    <input type="text" name="id" value="<?php echo $st->id; ?>">
                </form>
                <a 
                    href="#"
                    onclick="event.preventDefault();document.getElementById('form-dt-<?php echo $i; ?>').submit()"
                >
                    detail dumptruck
                </a>
            </td>
            <td>
                <form 
                    id="<?php echo 'form-document-'.$i; ?>" 
                    style="display: none;" 
                    method="post" 
                    action="<?php echo base_URL('administrator/surattugas/print_surat')?>"
                > 
                    <input type="text" name="id" value="<?php echo $st->id; ?>">
                </form>
                <a 
                    href="#"
                    onclick="event.preventDefault();document.getElementById('form-document-<?php echo $i; ?>').submit()"
                >
                    detail dokumen
                </a>
            </td>
            <td style="text-align=center;">
                <div class="aksi" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 5px;">
                <form 
                    id="<?php echo 'form-surat-'.$i; ?>" 
                    style="display: none;" 
                    method="post" 
                    action="<?php echo base_URL('administrator/surattugas/hapus_surat'); ?>"
                > 
                    <input type="text" name="id" value="<?php echo $st->id; ?>">
                </form>
                <a 
                    href="<?php echo base_URL('administrator/surattugas/detail_surat/').$st->id; ?>"
                    style="display:grid;"
                >
                    <div class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </div>
                </a>
                <a 
                    href="#"
                    style="display:grid;"
                    onclick="document.getElementById('form-surat-<?php echo $i; ?>').submit()"
                >
                    <div class="btn btn-danger btn-sm" onclick="javascript: return confirm('Yakin Hapus?')">
                        <i class="fa fa-trash"></i>
                    </div>
                </a>
                </div>
            </td>
  		</tr>
  	<?php endforeach; ?>
    </tbody>
  </table>
</div>
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
                text: "Print",
                buttons: [
                    {
                        extend: "print",
                        text: "Print Table",
                        //title: "<h4 style="text-align:center;">Kinerja PJLP</h4>",
                        messageTop: 'UNIT ALKAL BINA MARGA PROVINSI DKI JAKARTA',
                        exportOptions: {
                          columns: [0, 1]
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
                          columns: [1, 2]
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
