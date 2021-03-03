<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Request ESign E-Kinerja PJLP 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <div style="overflow-x: auto;">
  <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
  	<tr>
  		<th class="text-center">PJLP</th>
  		<th class="text-center">Tanggal Awal</th>
        <th class="text-center">Tanggal Akhir</th>
  		<th class="text-center">Dokumen</th>
  		<th class="text-center">Pemohon</th>
  		<th class="text-center">Tanggal Permohonan</th>
  		<th class="text-center">ESign</th>
    </tr>
    </thead>
    <tbody>
  	<?php $i=0; foreach($eKinerja as $ek) : ?>
        <?php $i++; ?>
  		<tr>
            <td><?php echo $ek->uName?></td>
  			<td><?php echo $ek->ekin_start?></td>
  			<td><?php echo $ek->ekin_end?></td>
            <td style="text-align: center">
                <form 
                    id="<?php echo 'form-document-'.$i; ?>" 
                    method="post" 
                    action="<?php echo base_URL('')?>"
                > 
                    <input style="display: none" type="text" name="uId" value="<?php echo $ek->uId; ?>">
                    <input style="display: none" type="date" name="dateStart" value="<?php echo $ek->ekin_start; ?>">
                    <input style="display: none" type="date" name="dateEnd" value="<?php echo $ek->ekin_end; ?>">
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
  			<td><?php echo $ek->reqByName?></td>
  			<td><?php echo $ek->reqDate?></td>
           <td style="text-align: center;">
                <div class="aksi" style="text-align: center;">
                <form 
                    id="<?php echo 'form-confirm-'.$i; ?>" 
                    style="display:grid"
                    method="post" 
                    action="<?php echo base_URL('administrator/esign/confirm_esign_ekinerja'); ?>"
                > 
                    <input style="display: none" type="text" name="uId" value="<?php echo $ek->uId; ?>">
                    <input style="display: none" type="date" name="dateStart" value="<?php echo $ek->ekin_start; ?>">
                    <input style="display: none" type="date" name="dateEnd" value="<?php echo $ek->ekin_end; ?>">
                    <button 
                        style="display:grid" 
                        type="submit" 
                        class="btn btn-success btn-sm"
                    >
                        <i class="fa fa-check"></i>
                    </button>
                </form>
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
