<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>

	<?php echo form_open_multipart('pegawai/operator/input_aksi'); ?>
		<div class="form-group">
			<label> Nama Lengkap :</label>
			<select name="nama" class="form-control" value="<?php echo $k->nama?>">
			<option>Adar Suhendar</option>
			<option>Ainal Yakin</option>
			<option>Antonih</option>
			<option>Asep Efendi</option>
			<option>Asep Sanin</option>
			<option>Boby Sholayita</option>
			<option>Hendri Prima Pasaribu</option>
			<option>Irfan Faluvi</option>
			<option>Irwan</option>
			<option>Juni Purnama</option>
			<option>Khaerudin</option>
			<option>M Erif Supriyanto</option>
			<option>Misra</option>
			<option>Mohammad Sarifudin</option>
			<option>Muhamad Sahri</option>
			<option>Muhammad Soleh</option>
			<option>Petrus Wila Rihi</option>
			<option>Rachmat Wijianto</option>
			<option>Rudy Hartanto</option>
			<option>Samsuri Musa</option>
			<option>Saprudin</option>
			<option>Sobirin</option>
			<option>Sudarno</option>
			<option>Sumar Wijaya</option>
			<option>Wahyu Hidayat</option>
			<option>Wahyuddin</option>
			<option>Wawan Kurniawan</option>
			<option>Budi Nurcahyo</option>
			<option>Abdul Rohman</option>
			<option>Daniel Kailo</option>
			<option>Hadi Sumadi</option>
			<option>Muhammad Ridwan</option>
			<option>Muhammad Usman Abdillah</option>
			<option>Doddy Mardjono</option>
			<option>Dedi Gariyanto</option>
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
			<option>Akhmad Rafik Cahyadi</option>
			<option>Aminudin</option>
			<option>Andy Setiawan</option>
			<option>Anindya Indriasari</option>
			<option>Bagus Setia A. K</option>
			<option>Deni Wahyudi</option>
			<option>Didit Triady</option>
			<option>Dwi Fitri Meiranda</option>
			<option>Fedo Alviansyah</option>
			<option>Firman</option>
			<option>Halimi</option>
			<option>Harun Al Rasyid</option>
			<option>Heru Susanto</option>
			<option>Husni</option>
			<option>Husni Safar</option>
			<option>Indra Sucianto</option>
			<option>Indra Suyono</option>
			<option>Ismail Marjuki</option>
			<option>Iswahyudi</option>
			<option>M. Ali Agung</option>
			<option>M. Yunus</option>
			<option>Moch Rizqi Hafian S</option>
			<option>Mohamad Yusup</option>
			<option>Raiman</option>
			<option>Rangga Marettayasa</option>
			<option>Recky Pratama Putra</option>
			<option>Renaldi</option>
			<option>Rio Danar Prawito</option>
			<option>Riyanto</option>
			<option>Roni Sugiartono</option>
			<option>Rudi Sugiarto</option>
			<option>Riyan Nurman Wardaya</option>
			<option>Sandy Aditya Gunawan</option>
			<option>Santoso</option>
			<option>Soni Herawan</option>
			<option>Sri Muliati</option>
			<option>Sugiono</option>
			<option>Syaifudin</option>
			<option>Toto Pranoto</option>
			<option>Tri Yanto</option>
			<option>U. Santoso</option>
			<option>Vicky Ambiyah</option>
			<option>Wahyu Setiaji</option>
			<option>Wawan Setiawan</option>
			<option>Aulia Mursalin</option>
			<option>Muhammad Faisal Ridho</option>
			<option>Nana<option> Supriyatna</option>
			<option>Ahmad Zulfikar</option>
			<option>Reinhard Aditya Petradi</option>
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
 		<input type="radio" id="Kendaraan Operasional Lapangan" name="bidang" value="Kendaraan Operasional Lapangan">
 		<label for="Kendaraan Operasional Lapangan">Kendaraan Operasional Lapangan</label><br>
			<?php echo form_error('bidang', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>Kegiatan</label>
			<label> Pilih Kegiatan :</label>
			<select name="kegiatan" class="form-control" value="<?php echo $k->kegiatan?>">
			<option>Pagi - Apel Pagi dan Pengarahan dari Pimpinan</option>
			<option>Pagi - Melakukan Persiapan Kendaraan</option>
			<option>Pagi - Melakukan Pemanasan Kendaraan</option>
			<option>Pagi - Melakukan Pengisian Bahan Bakar Minyak di SPBU</option>
			<option>Pagi - Melakukan Pengisian Bahan Bakar Minyak Menggunakan Jerigen</option>
			<option>Siang - Membantu Mekanik dalam Perbaikan Alat Berat</option>
			<option>Siang - Melakukan Pengiriman Bahan Material</option>
			<option>Sore - Melakukan Pengiriman Bahan Material</option>
			<option>Pagi - Melaksanakan Perintah Atasan</option>
			<option>Siang - Melaksanakan Perintah Atasan</option>
			<option>Sore - Melaksanakan Perintah Atasan</option>
			<option>Pagi - Melakukan Pengantaran Kru Ke Lokasi Pekerjaan</option>
			<option>Pagi - Melakukan Pengantaran Kendaraan Untuk Service</option>
			<option>Pagi - Melakukan Pematangan Lahan</option>
			<option>Siang - Membantu Pematangan Lahan</option>
			<option>Sore - Membantu Pematangan Lahan</option>	
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