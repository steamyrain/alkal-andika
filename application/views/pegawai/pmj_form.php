<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>

	<?php echo form_open_multipart('pegawai/pmj/input_aksi'); ?>
		<div class="form-group">
			<label> Nama Lengkap :</label>
			<select name="nama" class="form-control" value="<?php echo $k->nama?>">
			<option>Agung Permana</option>
			<option>Ahmad Baktiar</option>
			<option>Ahmad Yapie Ta'as</option>
			<option>Akhmad Rafik Cahyadi</option>
			<option>Aminudin</option>
			<option>Deni Wahyudi</option>
			<option>Didit Triady</option>
			<option>Fedo Alviansyah</option>
			<option>Firman</option>
			<option>Halimi</option>
			<option>Heru Susanto</option>
			<option>Husni Safar</option>
			<option>Indra Sucianto</option>
			<option>Indra Suyono</option>
			<option>Iswahyudi</option>
			<option>M. Ali Agung</option>
			<option>M. Yunus</option>
			<option>Moch Rizqi Hafian S</option>
			<option>Mohamad Yusup</option>
			<option>Raiman</option>
			<option>Renaldi</option>
			<option>Riyanto</option>
			<option>Roni Sugiartono</option>
			<option>Rudi Sugiarto</option>
			<option>Riyan Nurman Wardaya</option>
			<option>Sandy Aditya Gunawan</option>
			<option>Santoso</option>
			<option>Sugiono</option>
			<option>Syaifudin</option>
			<option>Toto Pranoto</option>
			<option>U. Santoso</option>
			<option>Wahyu Setiaji</option>
			<option>Wawan Setiawan</option>
			<option>Aulia Mursalin</option>
			<option>Nana Supriyatna<option>
			<option>Ahmad Zulfikar</option>
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
 		<label for="Petugas Pemeliharaan Jalan dan Jembatan">Petugas Pemeliharaan Jalan dan Jembatan</label><br>
			<?php echo form_error('bidang', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>Kegiatan</label>
			<label> Pilih Kegiatan :</label>
			<select name="kegiatan" class="form-control" value="<?php echo $k->kegiatan?>">
			<option>Pagi - Apel Pagi Persiapan Kerja</option>
			<option>Pagi - Melaksanakan Perintah Atasan</option>
			<option>Pagi - Apel Pagi Persiapan Kerja</option>
			<option>Pagi - Membantu Perapihan Lahan</option>
			<option>Pagi - Membantu Pemadatan Lahan</option>
			<option>Pagi - Membantu Pergantian Spare Part</option>
			<option>Pagi - Membantu Perbaikan Alat</option>
			<option>Pagi - Membantu Bersih-Bersih Kendaraan dan Alat</option>
			<option>Pagi - Membantu Antar Muat Puing Atau Scrap</option>
			<option>Pagi - Membantu Jetting Pembersihan Trotoar</option>
			<option>Pagi - Membantu Pekerjaan Jetting Di Lokasi</option>
			<option>Pagi - Membantu Perapihan dan Pemsangan MCB</option>
			<option>Pagi - Membantu Perapihan Bongkaran
			<option>Pagi - Membantu Menghantarkan Scrap</option>
			<option>Pagi - Membantu Mobilisasi Alat</option>
			<option>Pagi - Membantu Perapihan Material</option>
			<option>Siang - Melaksanakan Perintah Atasan</option>
			<option>Siang - Apel Pagi Persiapan Kerja</option>
			<option>Siang - Membantu Perapihan Lahan</option>
			<option>Siang - Membantu Pemadatan Lahan</option>
			<option>Siang - Membantu Pergantian Spare Part</option>
			<option>Siang - Membantu Perbaikan Alat</option>
			<option>Siang - Membantu Bersih-Bersih Kendaraan dan Alat</option>
			<option>Siang - Membantu Antar Muat Puing Atau Scrap</option>
			<option>Siang - Membantu Jetting Pembersihan Trotoar</option>
			<option>Siang - Membantu Pekerjaan Jetting Di Lokasi</option>
			<option>Siang - Membantu Perapihan dan Pemsangan MCB</option>
			<option>Siang - Membantu Perapihan Bongkaran
			<option>Siang - Membantu Menghantarkan Scrap</option>
			<option>Siang - Membantu Mobilisasi Alat</option>
			<option>Siang - Membantu Perapihan Material</option>
			<option>Sore - Melaksanakan Perintah Atasan</option>
			<option>Sore - Apel Pagi Persiapan Kerja</option>
			<option>Sore - Membantu Perapihan Lahan</option>
			<option>Sore - Membantu Pemadatan Lahan</option>
			<option>Sore - Membantu Pergantian Spare Part</option>
			<option>Sore - Membantu Perbaikan Alat</option>
			<option>Sore - Membantu Bersih-Bersih Kendaraan dan Alat</option>
			<option>Sore - Membantu Antar Muat Puing Atau Scrap</option>
			<option>Sore - Membantu Jetting Pembersihan Trotoar</option>
			<option>Sore - Membantu Pekerjaan Jetting Di Lokasi</option>
			<option>Sore - Membantu Perapihan dan Pemsangan MCB</option>
			<option>Sore - Membantu Perapihan Bongkaran
			<option>Sore - Membantu Menghantarkan Scrap</option>
			<option>Sore - Membantu Mobilisasi Alat</option>
			<option>Sore - Membantu Perapihan Material</option>
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