<div class="container-fluid">

	<div class="alert alert-success" role="alert">
		<i class="fas fa-truck"></i> Form Input ATPM
		</div>

		<form method="post" action="<?php echo base_url('administrator/atpm/tambah_atpm_aksi') ?>">
			<div class="form-group">
			<label>Nomor</label>
			<input type='text' name='id_atpm' placeholder="Masukkan Nomor ATPM" class="form-control">
			<?php echo form_error('id_atpm', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>Nama ATPM</label>
			<input type='text' name='nama_atpm' placeholder="Masukkan Nama ATPM" class="form-control">
			<?php echo form_error('nama_atpm', '<div class="text-danger small" ml-3>') ?>
		</div>
		
		<div class="form-group">
			<label>Alamat Kantor</label>
			<input type='text' name='alamat_kantor' placeholder="Masukkan Alamat Kantor" class="form-control">
			<?php echo form_error('alamat_kantor', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group">
			<label>Jenis Pemeliharaan</label>
			<input type='text' name='jenis_pemeliharaan' placeholder="Masukkan Jenis Pemeliharaan" class="form-control">
			<?php echo form_error('nama_atpm', '<div class="text-danger small" ml-3>') ?>
		</div>

		<div class="form-group">
			<label>Nomor Kontak</label>
			<input type='text' name='no_kontak' placeholder="Masukkan Nomor Kontak" class="form-control">
			<?php echo form_error('no_kontak', '<div class="text-danger small" ml-3>') ?>
		</div>
		<button type="submit" class="btn btn-primary mb-5 mt-3">Simpan</button>
	<?php echo form_close(); ?>
</div>