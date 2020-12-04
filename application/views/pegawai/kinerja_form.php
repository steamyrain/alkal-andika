<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>

	<?php echo form_open_multipart('pegawai/kinerja/input_aksi'); ?>
		<div class="form-group">
			<label> Nama Lengkap :</label>
			<select name="nama" class="form-control" value="<?php echo $k->nama?>">
			<option>Ahmad Jaelani</option>
			<option>Andi Sada</option>
			<option>Asep Saefullah</option>
			<option>Bastoni</option>
			<option>Bima Nur Kusuma</option>
			<option>Dalim</option>
			<option>Darwin Harahap</option>
			<option>Edi Supriyadi</option>
			<option>Erwin</option>
			<option>Farian</option>
			<option>Fikih Gumilang</option>
			<option>Fredy Pasaribu</option>
			<option>I Ketut Komarudin</option>
			<option>I Made Gede Solihin</option>
			<option>Ika Iskandar</option>
			<option>Jabidi</option>
			<option>Kamal</option>
			<option>Karyoto</option>
			<option>Kurnia</option>
			<option>Farian</option>
			<option>M Rizal Firmansyah</option>
			<option>Mibakhul Choir</option>
			<option>Mujiharto</option>
			<option>Nurahman Septianto</option>
			<option>Nurjaman</option>
			<option>Onda Juanda</option>
			<option>Pebri Saputra</option>
			<option>Robi Dwi Pangga</option>
			<option>Saeful Hidayat</option>
			<option>Saut Maruli Pasaribu</option>
			<option>Sidik Saleh</option>
			<option>Sugiarto</option>
			<option>Sukendar</option>
			<option>Sutan Mangalangar Harahap</option>
			<option>Syamsudin</option>
			<option>Toto Hanto</option>
			<option>Yohan Supandi</option>
			<option>Alipin</option>
			<option>Bawon</option>
			<option>Hendri Agus Prasetyo</option>
			<option>I Made Kodir</option>
			<option>Syamsul Arif</option>
			<option>Roni Pasrah	</option>
			<option>Zamronih</option>
			<option>Kasturi</option>
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
 		<input type="radio" id="Pengemudi Alat Berat" name="bidang" value="Pengemudi Alat Berat">
 		<label for="Pengemudi Alat Berat">Operator Alat Berat</label><br>
			<?php echo form_error('bidang', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>Kegiatan</label>
			<label> Pilih Kegiatan :</label>
			<select name="kegiatan" class="form-control" value="<?php echo $k->kegiatan?>">
			<option>Pagi - Apel Pagi dan Pengarahan dari Pimpinan</option>
			<option>Pagi - Melakukan Persiapan Alat Berat</option>
			<option>Pagi - Melakukan Pemanasan Alat Berat</option>
			<option>Pagi - Melakukan Pengisian Bahan Bakar Minyak Pada Alat Berat</option>
			<option>Pagi - Melakukan Pembersihan Trotoar Pejalan Kaki</option>
			<option>Pagi - Membantu Pekerjaan Bersih-Bersih di Lokasi</option>
			<option>Pagi - Melakukan Pembersihan Fasilitas dan Sarana Kantor</option>
			<option>Pagi - Melakukan Perapihan Bongkaran</option>
			<option>Pagi - Melakukan Perapihan dan Pemasangan MCB</option>
			<option>Pagi - Melakukan Perapihan dan Angkut Material Kantor</option>
			<option>Pagi - Melakukan Perapihan dan Membantu Angkut Material</option>
			<option>Pagi - Melakukan Mobilisasi Alat</option>
			<option>Pagi - Melakukan Pematangan Lahan</option>
			<option>Pagi - Melakukan Perapihan Lahan</option>
			<option>Pagi - Menggali Lubang di Lokasi</option>
			<option>Pagi - Membantu Meratakan Tanah</option>
			<option>Siang - Membantu Mekanik dalam Perbaikan Alat Berat</option>
			<option>Siang - Melakukan Pembersihan Trotoar Pejalan Kaki</option>
			<option>Siang - Membantu Pekerjaan Bersih-Bersih di Lokasi</option>
			<option>Siang - Melakukan Pembersihan Fasilitas dan Sarana Kantor</option>
			<option>Siang - Melakukan Peraphian Bongkaran</option>
			<option>Siang - Melakukan Perapihan dan Pemasangan MCB</option>
			<option>Siang - Melakukan Perapihan dan Angkut Material Kantor</option>
			<option>Siang - Melakukan Perapihan dan Membantu Angkut Material</option>
			<option>Siang - Melakukan Mobilisasi Alat</option>
			<option>Siang - Melakukan Pematangan Lahan</option>
			<option>Siang - Melakukan Perapihan Lahan</option>
			<option>Siang - Menggali Lubang di Lokasi</option>
			<option>Siang - Membantu Meratakan Tanah</option>
			<option>Sore - Melakukan Penertiban Reklame</option>
			<option>Sore - Melakukan Pembersihan Trotoar Pejalan Kaki</option>
			<option>Sore - Membantu Pekerjaan Bersih-Bersih di Lokasi</option>
			<option>Sore - Melakukan Pembersihan Fasilitas dan Sarana Kantor</option>
			<option>Sore - Melakukan Peraphian Bongkaran</option>
			<option>Sore - Melakukan Perapihan dan Pemasangan MCB</option>
			<option>Sore - Melakukan Perapihan dan Angkut Material Kantor</option>
			<option>Sore - Melakukan Perapihan dan Membantu Angkut Material</option>
			<option>Sore - Melakukan Mobilisasi Alat</option>
			<option>Sore - Melakukan Pematangan Lahan</option>
			<option>Sore - Melakukan Perapihan Lahan</option>
			<option>Sore - Menggali Lubang di Lokasi</option>
			<option>Sore - Membantu Meratakan Tanah</option>

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