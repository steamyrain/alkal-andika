<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Request ESign Kinerja Operator 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <?php 
    echo anchor(
        base_URL('administrator/kinerja/request_esign_form'),
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
        <th class="text-center">Operator</th>
  		<th class="text-center">Tanggal Awal Kinerja</th>
  		<th class="text-center">Tanggal Akhir Kinerja</th>
  		<th class="text-center">Pemohon</th>
  		<th class="text-center">Tanggal Permohonan</th>
    </tr>
    </thead>
    <tbody>
  	<?php $i=0; foreach($eKinerja as $ek) : ?>
        <?php $i++; ?>
  		<tr>
            <td><?php echo $ek->uName?></td>
            <td><?php echo $ek->ekin_start?></td>
  			<td><?php echo $ek->ekin_end?></td>
  			<td><?php echo $ek->reqByName?></td>
  			<td><?php echo $ek->reqDate?></td>
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
