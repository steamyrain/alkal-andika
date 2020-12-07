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
    <div style="overflow-x: auto;">
  <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
  	<tr>
  		<th class="text-center">Aksi</th>
  		<th class="text-center">Nomor Polisi</th>
  		<th class="text-center">Tipe</th>
  		<th class="text-center">Kapasitas</th>
  		<th class="text-center">Merek</th>
  		<th class="text-center">Tahun</th>
  		<th class="text-center">Nomer Rangka</th>
  		<th class="text-center">Nomer Mesin</th>
  		<th class="text-center">Aktif</th>
  		<th class="text-center">Keterangan</th>
  		<th class="text-center">Lokasi</th>
    </tr>
    </thead>
    <tbody>
  	<?php $no=1; foreach($dumpTruck as $dt) : ?>
  		<tr>
            <td>
                <div class="aksi" style="display: inline-grid; grid-gap: 5px;">
                    <div class="btn btn-danger btn-sm" onclick="javascript: return confirm('Yakin Hapus?')">
                        <i class="fa fa-trash"></i>
                        <a href="<?php echo 'administrator/dumptruck/hapus_aksi/'.$dt->plate_number; ?>"></a>
                    </div> 
                    <div class="btn btn-warning btn-sm" onclick="javascript: return confirm('Yakin Hapus?')">
                        <i class="fa fa-edit"></i>
                        <a href="<?php echo'administrator/dumptruck/hapus_aksi'; ?>"></a>
                    </div> 
                </div>
            </td>
  			<td width="20px"><?php echo $dt->plate_number ?></td>
  			<td><?php echo $dt->type ?></td>
  			<td><?php echo $dt->category ?></td>
  			<td><?php echo $dt->brand ?></td>
  			<td><?php echo $dt->year ?></td>
  			<td><?php echo $dt->chassis_number ?></td>
  			<td><?php echo $dt->engine_number ?></td>
  			<td><?php echo $dt->active ?></td>
  			<td><?php echo $dt->condition_info ?></td>
  			<td><?php echo $dt->location ?></td>
  		</tr>
  	<?php endforeach; ?>
    </tbody>
  </table>
</div>
</div>
<script>
<script>
