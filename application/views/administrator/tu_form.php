<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>

	<?php echo form_open_multipart('administrator/pmj/input_aksi'); ?>
		<div class="form-group">
			<label> Nama Lengkap :</label>
			<select name="nama" class="form-control" value="<?php echo $k->nama?>">
			<option>Bagus Setia A. K</option>
			<option>Dwi Fitri Meiranda</option>
			<option>Recky Pratama Putra</option>
			<option>Soni Herawan</option>
			<option>Vicky Ambiyah</option>
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
			<option>Siang - Melaksanakan Perintah Atasan</option>
			<option>Sore - Melaksanakan Perintah Atasan</option>
			<option>Pagi - Apel Pagi Persiapan Kerja</option>
			<option>Monitoring Absensi</option>
			<option>Membuat Surat Cuti</option>
			<option>Memproses Proses Gaji di Sistem E-PJLP</option>
			<option>Memproses Penilaian Kinerja di Sistem E-PJLP</option>
			<option>Merekap Cuti Bulanan Untuk di Kirim ke Dinas</option>
			<option>Menerima & Membukukan Surat Masuk</option>
			<option>Mencatat, Menomori & Membukukan Surat Keluar</option>
			<option>Membuat Surat</option>
			<option>Merekap Surat & Merapikan Arsip Surat Masuk dan Surat Keluar</option>
			<option>Memberi Disposisi, Mencatat & Memberi Referensi Surat Yang Sudah di Disposisi Oleh KA Unit & Kasubag Tu Unit Alkal DBM</option>
			<option>Mengurus Gaji, BPJS Kesehatan, BPJS Ketenagakerjaan</option>
			<option>Membuat Surat Tugas</option>
			<option>Membuat Lampiran Surat Tugas</option>
			<option>Membuat RAB</option>
			<option>Membuat DRRPAB Gaji</option>
			<option>Membuat Listing Gaji</option>
			<option>Membuat Rekap Rincian Gaji</option>
			<option>Membuat Rekap Keseluruhan Gaji</option>
			<option>Membuat Daftar Potongan PPH 21</option>
			<option>Membuat Penghitungan Potongan PPH 21</option>
			<option>Membuat Form Potongan PPH 21</option>
			<option>Membuat Lampiran Format Gaji Untuk Kepala Dinas</option>
			<option>Membuat SPP Gaji</option>
			<option>Membuat PPA Gaji</option>
			<option>Membuat Berita Acara Serah Terima Gaji</option>
			<option>Membuat Kwitansi Intern & Global Tagihan Gaji</option>
			<option>Membuat Berita Acara Pemotongan Gaji</option>
			<option>Membuat Form Verifikasi & Penghimpunan SPJ</option>
			<option>Membuat & Menyusun Tagihan dari BPJS Kesehatan</option>
			<option>Membuat DRRPAB Tagihan BPJS KEsehatan</option>
			<option>Membuat Listing Tagihan BPJS Kesehatan</option>
			<option>Membuat Rekap Tagihan BPJS Kesehatan</option>
			<option>Membuat SPP Tagihan BPJS Kesehatan</option>
			<option>Membuat PPA Tagihan BPJS Kesehatan</option>
			<option>Membuat Form Pengajuan BPJS Kesehatan</option>
			<option>Menghitung Iuran Perbulan dan Memfinalisasi Melalui Sistem SIPP BPJS KetenagaKerjaan</option>
			<option>Mencetak Daftar Upah dan Daftar Rincian Iuran Melalui Sistem SIPP BPJS Ketenagakerjaan</option>
			<option>Membuat DRRPAB Tagihan BPJS Ketenaga Kerjaan</option>
			<option>Membuat Rekapitulasi Tagihan BPJS Ketenaga Kerjaan</option>
			<option>Membuat Listing Tagihan BPJS Ketenaga Kerjaan</option>
			<option>Membuat SPP Tagihan BPJS Ketenaga Kerjaan</option>
			<option>Membuat PPA Tagihan BPJS Ketenaga Kerjaan</option>
			<option>Membuat Penerbitan SPP LS Tagihan BPJT Ketenaga Kerjaan</option>
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