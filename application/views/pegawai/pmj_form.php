<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>

	<?php echo form_open_multipart('pegawai/pmj/input_aksi'); ?>
		<div class="form-group">
			<label> Nama Lengkap :</label>
			<select name="nama" class="form-control" value="<?php echo $k->nama?>">
			<option>Agung Permana</option>
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
			 <p>Pilih Jam Mulai :</p>
 		<input type="time" id="waktu" name="waktu">
			<?php echo form_error('waktu', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			 <p>Pilih Jam Selesai :</p>
 		<input type="time" name="pulang">
			<?php echo form_error('pulang', '<div class="text-danger small" ml-3>') ?>
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
			<option>Apel Pagi Persiapan Kerja</option>
			<option>Melaksanakan Perintah Atasan</option>
			<option>Membantu Perapihan Lahan</option>
			<option>Membantu Pemadatan Lahan</option>
			<option>Membantu Pergantian Spare Part</option>
			<option>Membantu Perbaikan Alat</option>
			<option>Membantu Bersih-Bersih Kendaraan dan Alat</option>
			<option>Membantu Antar Muat Puing Atau Scrap</option>
			<option>Membantu Jetting Pembersihan Trotoar</option>
			<option>Membantu Pekerjaan Jetting Di Lokasi</option>
			<option>Membantu Perapihan dan Pemsangan MCB</option>
			<option>Membantu Perapihan Bongkaran
			<option>Membantu Menghantarkan Scrap</option>
			<option>Membantu Mobilisasi Alat</option>
			<option>Membantu Perapihan Material</option>
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