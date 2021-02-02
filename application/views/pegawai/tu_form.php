<div class="container-fluid">

	<div class="alert alert-success" role="alert">
  	<i class="fas fa-clipboard"></i> Form Input Kinerja
  	</div>

	<?php echo form_open_multipart('administrator/pmj/input_aksi'); ?>
		<div class="form-group">
			<label> Nama Lengkap :</label>
			<select name="nama" class="form-control" value="<?php echo $k->nama?>">
			<option>Andy Setiawan</option>
			<option>Anindya Indriasari</option>
			<option>Husni</option>
			<option>Sri Muliati</option>
			<option>Ahmad Baktiar</option>
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
			 <p>Pilih Datang :</p>
 		<input type="time" id="waktu" name="waktu">
			<?php echo form_error('waktu', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			 <p>Pilih Pulang :</p>
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
			<option>Rekapitulasi Struk BBM</option>
			<option>Pengumpulan Struk BBM</option>
			<option>Pembuatan Berkas Deposit</option>
			<option>Membantu Pembuatan SPJ BBM</option>
			<option>Penggandaan Struk BBM</option>
			<option>Pendataan Stok Opname</option>
			<option>Membuat Surat Kerja Bengkel</option>
			<option>Membuat Surat Permohonan Pengeluaran Barang</option>
			<option>Membuat Surat Jalan Mobil Keluar Kantor</option>
			<option>Membuat Pekerjaan Pool</option>
			<option>Rekapitulasi Kilo Meter dan Hour Meter</option>
			<option>Rekapitulasi Surat Kerja Bengkel (Bulanan)</option>
			<option>Membuat Kontrak Untuk Pemeliharaan dan Pengadaan Alat-Alat Berat Unit Alkal Bina Marga</option>
			<option>Membuat Semua Tagihan Kontrak Untuk Pemeliharaan & Pengadaan Alat Alat Berat Unit Alkal BM</option>
			<option>Membuat SK Pejabat PPHP, PPJB, PJPHP</option>
			<option>Membuat Laporan Akhir Tahun (DHP) Untuk Semua Kontrak Penggadaan</option>
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