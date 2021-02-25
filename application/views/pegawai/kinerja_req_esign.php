<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Request ESign Surat Tugas 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <div style="overflow-x: auto;">
  <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
  	<tr>
  		<th class="text-center">Operator</th>
  		<th class="text-center">Tanggal Awal Kinerja</th>
  		<th class="text-center">Tanggal Akhir Kinerja</th>
  		<th class="text-center">Dokumen Kinerja</th>
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
                    action="<?php echo base_URL('pegawai/esign/print_dinas')?>"
                > 
                    <input style="display: none" type="text" name="username" value="<?php echo $ek->uName; ?>">
                    <input style="display: none" type="date" name="date_start" value="<?php echo $ek->ekin_start; ?>">
                    <input style="display: none" type="date" name="date_end" value="<?php echo $ek->ekin_end; ?>">
                    <input style="display: none" type="text" name="job_id" value="<?php echo $ek->job_id; ?>">
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
            <td style="text-align=center;">
                <div class="aksi" style="text-align: center">
                    <?php if ($ek->status == 'signed') { ?>
                        <?php echo 'signed'; ?>
                    <?php } else if ($ek->status == 'pending') { ?>
                        <form 
                            id="<?php echo 'form-confirm-'.$i; ?>" 
                            style="display:grid"
                            method="post" 
                            action="<?php echo base_URL('pegawai/esign/confirm'); ?>"
                        > 
                            <input type="text" name="id" style="display: none" value="<?php echo $ek->uId; ?>">
                            <input style="display: none" type="date" name="date_start" value="<?php echo $ek->ekin_start; ?>">
                            <input style="display: none" type="date" name="date_end" value="<?php echo $ek->ekin_end; ?>">
                            <button 
                                style="display:grid" 
                                type="submit" 
                                class="btn btn-success btn-sm"
                            >
                                <i class="fa fa-check"></i>
                            </button>
                        </form>
                    <?php } ?>
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
