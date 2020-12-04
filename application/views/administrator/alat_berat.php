<div class="container-fluid">

	 <div class="alert alert-success" role="alert">
      <i class="fas fa-clipboard"></i> Alat Berat 
    </div>

    <?php echo $this->session->flashdata('pesan') ?>
    <!-- tambah data 
    <?php 
    echo anchor(
        base_URL('administrator/alatberat/input'),
        '<button class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-plus fa-sm"></i> 
            Tambah Data
        </button>'
    ) 
    ?>
    -->
  <table id="data-tabel" class="table table-bordered table-striped" style="width:100%">
    <thead>
  	<tr>
  		<th class="text-center">ID</th>
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
  			<td width="20px"><?php echo $a->id ?></td>
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
