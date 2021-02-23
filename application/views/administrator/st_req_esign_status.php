<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Request ESign Surat Tugas 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <?php 
    echo anchor(
        base_URL('administrator/surattugas/'),
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Request Esign 
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
            <td style="text-align: center">
                <form 
                    id="<?php echo 'form-document-'.$i; ?>" 
                    method="post" 
                    action="<?php echo base_URL('administrator/surattugas/print_surat')?>"
                > 
                    <input style="display: none" type="text" name="id" value="<?php echo $st->stId; ?>">
                    <button 
                        type="submit" 
                        name="submit" 
                        value="submit"
                        class="btn btn-primary btn-sm"
                    >
                        <span>
                            <i class="fa fa-file"></i>
                            Dokumen
                        <span>
                    </button>
                </form>
            </td>
  			<td><?php echo $st->reqByName?></td>
  			<td><?php echo $st->reqDate?></td>
  			<td><?php echo $st->status?></td>
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
