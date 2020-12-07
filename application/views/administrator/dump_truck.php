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
  		<th class="text-center">Nomor Pintu</th>
  		<th class="text-center">Tipe</th>
  		<th class="text-center">Kategori/Kapasitas</th>
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
  	<?php foreach($dumpTruck as $dt) : ?>
  		<tr>
            <td>
                <div class="aksi" style="display: inline-grid; grid-gap: 5px;">
                    <form style="display: none;" id="form-hapus" method="post" action=<?php echo base_URL('administrator/dumptruck/hapus_aksi') ?>>
                        <input type="text" name="id" value="<?php echo $dt->id; ?>">
                    </form>
                    <form style="display: none;" id="form-edit" method="post" action=<?php echo base_URL('administrator/dumptruck/edit') ?>>
                        <input type="text" name="id" value="<?php echo $dt->id; ?>">
                    </form>
                    <a 
                        onclick="document.getElementById('form-hapus').submit()"
                    >
                        <div class="btn btn-danger btn-sm" onclick="javascript: return confirm('Yakin Hapus?')">
                            <i class="fa fa-trash"></i>
                        </div>
                    </a>
                    <a 
                        onclick="document.getElementById('form-edit').submit()"
                    >
                        <div class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </div>
                    </a>
                </div>
            </td>
  			<td width="20px"><?php echo $dt->plate_number ?></td>
  			<td width="20px"><?php echo $dt->door_number ?></td> 
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
