<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Request ESign Surat Tugas 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <div style="overflow-x: auto;">
  <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
  	<tr>
  		<th class="text-center">Tanggal</th>
  		<th class="text-center">Lokasi</th>
        <th class="text-center">Pekerjaan</th>
  		<th class="text-center">Dokumen</th>
  		<th class="text-center">Pemohon</th>
  		<th class="text-center">Tanggal Permohonan</th>
  		<th class="text-center">ESign</th>
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
                    id="<?php echo 'form-document-'.$i; ?>" 
                    style="display: none;" 
                    method="post" 
                    action="<?php echo base_URL('administrator/surattugas/print_surat')?>"
                > 
                    <input type="text" name="id" value="<?php echo $st->stId; ?>">
                </form>
                <a 
                    href="#"
                    onclick="event.preventDefault();document.getElementById('form-document-<?php echo $i; ?>').submit()"
                >
                    detail dokumen
                </a>
            </td>
  			<td><?php echo $st->reqByName?></td>
  			<td><?php echo $st->reqDate?></td>
            <td style="text-align=center;">
                <div class="aksi" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 5px;">
                <form 
                    id="<?php echo 'form-req-'.$i; ?>" 
                    style="display: none;" 
                    method="post" 
                    action=""
                > 
                    <input type="text" name="id" value="<?php echo $st->stId; ?>">
                </form>
                <a 
                    href="#"
                    style="display:grid;"
                    onclick="
                        javascript: 
                        if(confirm('Yakin Konfirmasi Esign?')){
                            event.preventDefault();
                            document.getElementById('form-req-<?php echo $i; ?>').submit();
                        } else {
                            event.preventDefault();
                        }
                    "
                >
                    <div class="btn btn-success btn-sm">
                        <i class="fa fa-check"></i>
                    </div>
                </a>
                <a 
                    href="#"
                    style="display:grid;"
                    onclick="
                        javascript: 
                        if(confirm('Yakin Batalkan Esign?')){
                            event.preventDefault();
                            document.getElementById('form-req-<?php echo $i; ?>').submit();
                        } else {
                            event.preventDefault();
                        }
                    "
                >
                    <div class="btn btn-danger btn-sm">
                        <i class="fa fa-times"></i>
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
        ]
    });

    // append data table's button container for button collection
    table
    .buttons()
    .container()
    .appendTo($(".col-md-6:eq(0)", table.table().container()));
});
</script>
