<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Dump Truck 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>
    <?php 
    echo anchor(
        base_URL('administrator/dumptruck/input'),
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
    ) 
    ?>
  <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
  	<tr>
  		<th class="text-center">Nomor Polisi</th>
  		<th class="text-center">Tipe</th>
  		<th class="text-center">Kapasitas</th>
  		<th class="text-center">Merek</th>
  		<th class="text-center">Tahun</th>
  		<th class="text-center">Nomer Rangka</th>
  		<th class="text-center">Nomer Mesin</th>
  		<th class="text-center">Aktif</th>
    </tr>
    </thead>
    <tbody>
  	<?php $no=1; foreach($dumpTruck as $dt) : ?>
  		<tr>
  			<td width="20px"><?php echo $dt->plate_number ?></td>
  			<td><?php echo $dt->type ?></td>
  			<td><?php echo $dt->size_cubic_meter ?></td>
  			<td><?php echo $dt->brand ?></td>
  			<td><?php echo $dt->year ?></td>
  			<td><?php echo $dt->chassis_number ?></td>
  			<td><?php echo $dt->engine_number ?></td>
  			<td><?php echo $dt->active ?></td>
  		</tr>
  	<?php endforeach; ?>
    </tbody>
  </table>
</div>
