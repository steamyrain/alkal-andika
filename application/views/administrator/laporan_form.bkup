<div class="container-fluid">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <script src="assets/js/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<?php echo form_open_multipart('administrator/laporan/input_aksi'); ?>
		<div class="form-group">
			<label> Nama Operator :</label>
			<select name="nama" class="form-control">
                <option>Ahmad Jaelani</option>
                <option>Ahmad Rozali</option>
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
                <option>Ika Iskandar</option>
                <option>Jabidi</option>
                <option>Kamal</option>
                <option>Karyoto</option>
                <option>Kurnia</option>
                <option>M Rizal Firmansyah</option>
                <option>Mibakhul Choir</option>
                <option>Mujiharto</option>
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
                <option>Roni Pasrah</option>
                <option>Zamronih</option>
                <option>Kasturi</option>
                <option>Adar Suhendar</option>
                <option>Ainal Yakin</option>
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
                <option>Rahmat Wijianto</option>
                <option>Rudy Hartanto</option>
                <option>Samsuri Musa</option>
                <option>Saprudin</option>
                <option>Sobirin</option>
                <option>Sumar Wijaya</option>
                <option>Wahyu Hidayat</option>
                <option>Wahyuddin</option>
                <option>Wawan Kurniawan</option>
                <option>Budy Nurcahyo</option>
                <option>Daniel Kailo</option>
                <option>Hadi Sumadi</option>
                <option>Muhammad Ridwan</option>
                <option>Doddy Mardjono</option>
                <option>Dedy Gariyanto</option>
  			</select>
			<?php echo form_error('nama', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label> Lokasi Kerja :</label>
			<select name="lokasi" class="form-control" value="<?php echo $k->lokasiKerja?>">
			<option>Rorotan</option>
			<option>Bedeng Selatan</option>
			<option>Waduk Pondok Rangon</option>
			<option>Kemang Selatan</option>
			<option>Pondok Labu</option>
			<option>Gedung Cempaka Putih</option>
			<option>Kebun Jeruk</option>
			<option>Cideng</option>
			<option>Bedeng Timur</option>
			<option>Pinangsia</option>
			<option>Kebon Kacang, Tanah Abang</option>
			<option>Taman BMW, Jakarta Utara</option>
			<option>Kebon Melati, Tanah Abang</option>
			<option>Bengkel Isuzu, Warung Buncit</option>
			<option>Kodam Jaya</option>
			<option>Kodamar</option>
		</select>
		</div>
		<div class="form-group">
			<label>Masukkan Jenis Alat/ Dump Truck :</label>
			<input type="text" name="nopol"
			placeholder="Contoh : Excavator Standart Hyundai / R220-9 SH(9999) / Isuzu(B 9999 POQ) " class="form-control">
			<?php echo form_error('nopol', '<div class="text-danger small" ml-3>') ?>
		</div>
		<div class="form-group">
			<label>KM Awal/HM Awal :</label>
            <input 
                type="number" 
                name="kmawal"
                id="kmawal"
                placeholder="Masukkan KM Awal"
                class="form-control"
            >
			<?php echo form_error('kmawal', '<div class="text-danger small" ml-3>') ?>
        </div>
        <div>
            <label>KM Akhir/HM Akhir :</label>
            <input 
                type="number" 
                name="kmakhir"
                id="kmakhir"
                placeholder="Masukkan KM Akhir" 
                class="form-control"
            >
			<?php echo form_error('kmakhir', '<div class="text-danger small" ml-3>') ?>
		</div>
	   <div class="form-group">
        <label class="col-lg-3 control-label">Jarak</label>
        <div class="col-lg-3">
            <input type="text" name="jarak" id="jarak" class="form-control" Readonly value="0">
        </div>
		<div class="form-group">
			<label>BBM :</label>
			<input type="text" name="bbm"
			placeholder="Isi 0" class="form-control">
			<?php echo form_error('bbm', '<div class="text-danger small" ml-3>') ?>
		</div>
        <button 
            type="submit" 
            name="submit"
            class="btn btn-primary mb-5 mt-3"
        >
            Simpan
        </button>
	 <?php echo "</form>"; ?>
</div>

<script type="text/javascript">
    $("#kmawal").keyup(function(){   
   var a = parseInt($("#kmawal").val());
   var b = parseInt($("#kmakhir").val());
   var c = b-a;
   $("#jarak").val(c);
 });
 
 $("#kmakhir").keyup(function(){
   var a = parseInt($("#kmawal").val());
   var b = parseInt($("#kmakhir").val());
   var c = b-a;
   $("#jarak").val(c);
 });
</script>