<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>

	<?php echo form_open_multipart('pegawai/pmj/input_aksi'); ?>
		<div class="form-group">
			<label> Nama Lengkap :</label>
			<select name="nama" class="form-control" value="<?php echo $k->nama?>">
			<option>Ade Adam Hanifianto</option>
			<option>Agung Pramono</option>
			<option>Harun Al Rasyid</option>
			<option>Ismail Marjuki</option>
			<option>Rio Danar Prawito</option>
			<option>Muhammad Faisal Ridho</option>
			<option>Reinhard Aditya Petradi</option>
			<option>Muhamad Andyka Bakry</option>
 		    <option></option>
  			</select>
		</div>
	<div class="form-group">
			 <p>Pilih Waktu :</p>
 		<input type="radio" id="Pagi" name="waktu" value="Pagi">
 		<label for="Pagi">Pagi</label><br>
 		<input type="radio" id="Siang" name="waktu" value="Siang">
 		<label for="Siang">Siang</label><br>
 		<input type="radio" id="Sore" name="waktu" value="Sore">
 		<label for="Sore">Sore</label><br>
			<?php echo form_error('waktu', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			 <p>Pilih Bidang :</p>
 		<input type="radio" id="Petugas Pemeliharaan Jalan dan Jembatan" name="bidang" value="Petugas Pemeliharaan Jalan dan Jembatan">
 		<label for="Petugas Pemeliharaan Jalan dan Jembatan">Admin Peralatan</label><br>
			<?php echo form_error('bidang', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>Kegiatan</label>
			<label> Pilih Kegiatan :</label>
			<select name="kegiatan" class="form-control" value="<?php echo $k->kegiatan?>">
			<option>Pagi - Apel Pagi Persiapan Kerja</option>
			<option>Pagi - Apel Pagi Persiapan Kerja</option>
			<option>Pagi - Melaksanakan Perintah Atasan</option>
			<option>Siang - Melaksanakan Perintah Atasan</option>
			<option>Sore - Melaksanakan Perintah Atasan</option>
			<option>Pagi - Apel Pagi Persiapan Kerja</option>
		</select>
			<?php echo form_error('kegiatan', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>Masukkan Lokasi :</label>
			<input type="text" name="lokasi"
			placeholder="Masukkan Lokasi " class="form-control">
			<?php echo form_error('lokasi', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>Dokumentasi</label>
			<input type='file' name='dokumentasi' class="form-control">
		</div>
		
		<button type="submit" class="btn btn-primary mb-5 mt-3">Simpan</button>
	<?php echo form_close(); ?>
</div>