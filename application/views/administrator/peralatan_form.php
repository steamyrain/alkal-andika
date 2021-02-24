<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>

	<?php echo form_open_multipart('administrator/peralatan/input_aksi'); ?>
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
			<option>Tri Yanto</option>
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
			<option>Siang - Melaksanakan Perintah Atasan</option>
			<option>Sore - Melaksanakan Perintah Atasan</option>
			<option>Pagi - Apel Pagi Persiapan Kerja</option>
			<option>Menginput KM/HM Alat Berat dan Dump Truck</option>
			<option>Koordinasi dengan Koordinator Pengemudi Dump Truck</option>
			<option>Koordinasi dengan Koordinator Pengemudi Alat Berat</option>
            <option>Dokumentasi Kegiataan</option>
            <option>Perencanaan BBM</option>
            <option>Monitoring Kegiatan</option>
            <option>Editing Video</option>
            <option>Melakukan Backup File</option>
            <option>Mengembangkan Aplikasi</option>
            <option>Perencanaan Kegiatan</option>
            <option>Monitoring tim IT</option>
            <option>Mencatat Rekapitulasi Pelaksanaan Kegiatan Harian</option>
            <option>Membantu Melakukan Perencanaan Kegiatan</option>
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