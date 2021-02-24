<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>

	<?php echo form_open_multipart('administrator/kinerja/input_aksi'); ?>
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
            <label>Tanggal :</label>
            <input 
                type="date" 
                name="tgl"
                id="tgl"
                class="form-control"
            />
            <div style="display: none" class="text-danger small ml-3" id="tgl"></div>
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
 		<input type="radio" id="Pengemudi Alat Berat" name="bidang" value="Pengemudi Alat Berat">
 		<label for="Pengemudi Alat Berat">Operator Alat Berat</label><br>
			<?php echo form_error('bidang', '<div class="text-danger small" ml-3>') ?>
		</div>
	<div class="form-group">
			<label>Kegiatan</label>
			<label> Pilih Kegiatan :</label>
			<select name="kegiatan" class="form-control" value="<?php echo $k->kegiatan?>">
			<option>Apel dan Pengarahan dari Pimpinan</option>
			<option>Melakukan Persiapan Alat Berat</option>
			<option>Melakukan Pemanasan Alat Berat</option>
			<option>Melakukan Pengisian Bahan Bakar Minyak Pada Alat Berat</option>
			<option>Melakukan Pembersihan Trotoar Pejalan Kaki</option>
			<option>Membantu Pekerjaan Bersih-Bersih di Lokasi</option>
			<option>Melakukan Pembersihan Fasilitas dan Sarana Kantor</option>
			<option>Melakukan Perapihan Bongkaran</option>
			<option>Melakukan Perapihan dan Pemasangan MCB</option>
			<option>Melakukan Perapihan dan Angkut Material Kantor</option>
			<option>Melakukan Perapihan dan Membantu Angkut Material</option>
			<option>Melakukan Mobilisasi Alat</option>
			<option>Melakukan Pematangan Lahan</option>
			<option>Melakukan Perapihan Lahan</option>
			<option>Menggali Lubang di Lokasi</option>
			<option>Membantu Meratakan Tanah</option>
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