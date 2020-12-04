<div class="container-fluid">

	<div class="alert alert-success" role="alert">
		<i class="fas fa-university"></i> ATPM
	</div>

	<?php echo anchor('administrator/atpm/tambah_atpm','<button class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus fa-sm"></i> Tambah Data</button>') ?>

	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th>Nomor</th>
			<th>Nama ATPM</th>
			<th>Alamat Kantor</th>
			<th>Jenis Pemeliharaan</th>
			<th>Nomor Kontak</th>
			<th colspan="2">AKSI</th>
		</tr>

		<?php
		$id_atpm=1;
		foreach($atpm as $at): ?>
				<tr>
					<td><?php echo $id_atpm++ ?></td>
					<td><?php echo $at->nama_atpm ?></td>
					<td><?php echo $at->alamat_kantor ?></td>
					<td><?php echo $at->jenis_pemeliharaan ?></td>
					<td><?php echo $at->no_kontak ?></td>
					<td width="20px"><?php echo anchor('administrator/atpm/update/'.$at->id_atpm,'<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
					<td width="20px"><?php echo anchor('administrator/atpm/delete/'.$at->id_atpm,'<div class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></div>') ?></td>
		<?php endforeach; ?>
	</table>