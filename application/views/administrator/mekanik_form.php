<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>

	<?php echo form_open_multipart('administrator/mekanik/input_aksi'); ?>
		<div class="form-group">
			<label> Nama Lengkap :</label>
			<select name="nama" class="form-control" value="<?php echo $k->nama?>">
			<option>Ambar Wisetyo</option>
			<option>Fajar Adytia Ramadan</option>
			<option>Frayogi Rizcha</option>
			<option>Jon Faizal</option>
			<option>Khrisna Bayu Aji</option>
			<option>Markoni</option>
			<option>Muhammad Hafiz</option>
			<option>Muhammad Syafi'I</option>
			<option>Achmad Rizky</option>
			<option>Ade Adam Hanifianto</option>
			<option>Agung Permana</option>
			<option>Agung Pramono</option>
			<option>Ahmad Baktiar</option>
			<option>Ahmad Yapie Ta'as</option>
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
 		<input type="radio" id="Petugas Mekanikal Elektrikal" name="bidang" value="Petugas Mekanikal Elektrikal">
 		<label for="Petugas Mekanikal Elektrikal">Petugas Mekanikal Elektrikal</label><br>
			<?php echo form_error('bidang', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>Kegiatan</label>
			<label> Pilih Kegiatan :</label>
			<select name="kegiatan" class="form-control" value="<?php echo $k->kegiatan?>">
			<option>Pagi - Apel Pagi Persiapan Kerja</option>
			<option>Melakukan Pengecekan Kendaraan dan Alat</option>
			<option>Melakukan Penggantian Sparepart Kendaraan dan Alat</option>
			<option>Melakukan Perbaikan Kendaraan dan Alat</option>
			<option>Melakukan Storing dan Perbaikan Alat</option>
			<option>Membantu Pekerjaan Lapangan</option>
			<option>Menjalankan Perintah Atasan</option>
			<option>Memperbaiki Fasilitas dan Sarana Kantor</option>
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